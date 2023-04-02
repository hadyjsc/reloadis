<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CashWithdrawal;
use App\Models\Bank;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CashWithdrawalController extends Controller
{
    public function index()
    {
        $banks = Bank::get(['id', 'name', 'logo']);
        return view('cash-withdrawals.index', compact('banks'));
    }

    public function store(Request $req, CashWithdrawal $model)
    {
        $req->validate([
            'bank_id' => 'required',
            'amount' => 'required|numeric',
            'external_fee' => 'numeric',
            'internal_fee' => 'numeric'
        ]);

        $user = Auth::user();
        DB::beginTransaction();
        try {
            CashWithdrawal::create([
                'bank_id' => $req->bank_id,
                'amount' => $req->amount,
                'external_fee' => $req->external_fee,
                'internal_fee' => $req->internal_fee,
                'created_at' => now(),
                'created_by' => $user->id,
            ]);

            DB::commit();
            return $this->createdResponse();
        } catch (Exception $e) {
            DB::rollback();
            return $this->sendError( "invalid request", ["error"=> "Tidak dapat melakukan permintaan."], 200);
        }
    }
}
