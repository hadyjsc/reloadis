<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bank;

class BankController extends Controller
{
    public function index()
    {
        $model = Bank::orderBy('id', 'desc')->paginate(10);
        return view('banks.index', compact('model'));
    }

    public function show($id)
    {
        $model = Bank::find($id);
        return view('banks.detail', compact('model'));
    }

    public function create()
    {
        $model = Bank::class;
        return view('banks.create', compact('model'));
    }

    public function edit($id)
    {
        $model = Bank::find($id);
        return view('banks.edit', compact(['model']));
    }

    public function update(Request $req, Bank $model)
    {
        $req->validate(['name' => 'required']);

        $model = Bank::find($req->id);
        $model->name = $req->name;
        $model->updated_at = now();
        $model->save();

        return redirect(route('banks.edit', $req->id))->with('success', 'Data berhasil diubah.');
    }

    public function delete($id)
    {
        $model = Type::class;
        return view('banks.index', compact('model'));
    }

    public function insert(Request $req)
    {
        $req->validate(['name'=>'required']);

        Bank::create($req->post());

        return redirect(route('banks.create'))->with('success', 'Data berhasil disimpan.');
    }
}
