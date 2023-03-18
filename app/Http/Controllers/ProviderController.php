<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Provider;

class ProviderController extends Controller
{
    public function index()
    {

        $model = Provider::orderBy('id', 'desc')->paginate(10);
        return view('providers.index', compact('model'));
    }

    public function show($id)
    {
        $model = Provider::find($id);
        return view('providers.detail', compact('model'));
    }

    public function create()
    {
        $model = Provider::class;
        return view('providers.create', compact('model'));
    }

    public function edit($id)
    {
        $model = Provider::find($id);
        return view('providers.edit', compact(['model']));
    }

    public function update(Request $req, Provider $model)
    {
        $req->validate(['name' => 'required']);

        $model = Provider::find($req->id);
        $model->name = $req->name;
        $model->updated_at = now();
        $model->save();

        return redirect(route('providers.edit', $req->id))->with('success', 'Data berhasil diubah.');
    }

    public function delete($id)
    {
        $model = Provider::class;
        return view('providers.index', compact('model'));
    }

    public function insert(Request $req)
    {
        $req->validate(['name'=>'required']);

        Provider::create($req->post());

        return redirect(route('providers.create'))->with('success', 'Data berhasil disimpan.');
    }
}
