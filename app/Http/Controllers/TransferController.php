<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transfer;
use App\Models\TransferHistory;
use App\Models\TransferAccountHistory;
use App\Models\Bank;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TransferController extends Controller
{
    public function index()
    {
        $banks = Bank::get(['id', 'name', 'logo']);
        return view('transfer.index', compact('banks'));
    }

    public function show(Request $req)
    {
        $user = Auth::user();
        $id = $req['uuid'];
        $transfer = Transfer::where('uuid', '=', $id )->join('banks', 'banks.id', '=', 'transfers.bank_id')->first();

        if (Str::lower($transfer->status) == "sent") {
            DB::beginTransaction();
            try {
                $transfer->status = "IN PROGRESS";
                $transfer->updated_by = $user->id;
                $transfer->updated_at = now();
                $transfer->save();

                TransferHistory::create([
                    'transfer_id' => $transfer->id,
                    'status' => $transfer->status,
                    'created_at' => now(),
                    'created_by' => $transfer->updated_by
                ]);

                DB::commit();
            } catch (Exception $e) {
                DB::rollback();
                throw new Exception("Error Processing Request", 1);
            }
        }

        return view('transfer.show', compact('transfer'));
    }

    public function update(Request $req)
    {
        return null;
    }

    public function status(Request $req)
    {
        $user = Auth::user();
        $uuid = $req['uuid'];
        try {
            DB::beginTransaction();
            $model = Transfer::where('uuid', '=', $uuid)->first();
            $model->status = "TRANSFERED";
            $model->updated_by = $user->id;
            $model->updated_at = now();
            $model->save();

            TransferHistory::create([
                'transfer_id' => $model->id,
                'status' => $model->status,
                'created_at' => now(),
                'created_by' => $model->updated_by
            ]);

            DB::commit();
            return redirect(route('transfers.show', $uuid))->with('success', 'Data berhasil disimpan.');
        } catch (Exception $e) {
            DB::rollback();
            return $this->sendError( "invalid request", ["error"=> "Tidak dapat melakukan permintaan."], 200);
        }
    }

    public function store(Request $req, Transfer $model)
    {
        $user = Auth::user();
        $req->validate([
            'bank_account' => 'required|numeric',
            'amount' => 'required|numeric'
        ]);

        DB::beginTransaction();
        try {
            $uuid = Str::uuid();

            $id = $model::create([
                'uuid' => $uuid,
                'bank_account' => $req->bank_account,
                'amount' => $req->amount,
                'sender' => $req->sender,
                'bank_id' => $req->bank_id,
                'note' => $req->note,
                'receiver' => $req->receiver,
                'status' => Str::upper('sent'),
                'created_at' => now(),
                'created_by' => $user->id,
            ])->id;

            TransferHistory::create([
                'transfer_id' => $id,
                'status' => Str::upper('sent'),
                'created_at' => now(),
                'created_by' => $user->id
            ]);

            TransferAccountHistory::create([
                'bank_id' => $req->bank_id,
                'name' => $req->receiver,
                'bank_account' => $req->bank_account,
                'created_at' => now(),
                'created_by' => $user->id
            ]);

            DB::commit();

            $bank = Bank::where('id', '=', $req->bank_id)->get(['id', 'name'])->first();

            $data = [
                "phone" => [ "+6285271404170", "+6285274729255" ],
                "bank_account" => $req->bank_account,
                'amount' => $req->amount,
                'bank_name' => $bank->name,
                'uuid' => $uuid,
                'url' => route('transfers.show', $uuid),
                'requestor' => $user->name,
            ];

            return $this->sendResponse($data, 'success');
        } catch (Exception $e) {
            DB::rollback();
            return $this->sendError( "invalid request", ["error"=> "Tidak dapat melakukan permintaan."], 200);
        }
    }
}
