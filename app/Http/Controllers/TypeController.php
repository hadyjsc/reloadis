<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Type;

class TypeController extends Controller
{
    public function index()
    {

        $types = Type::orderBy('id', 'desc')->paginate(10);
        return view('types.index', compact('types'));
    }

    public function show($id)
    {
        $model = Type::find($id);
        return view('types.detail', compact('model'));
    }

    public function create()
    {
        $types = Type::class;
        return view('types.create', compact('types'));
    }

    public function edit($id)
    {
        $model = Type::find($id);
        return view('types.edit', compact(['model']));
    }

    public function update(Request $req, Type $model)
    {
        $req->validate(['name' => 'required']);

        $model = Type::find($req->id);
        $model->name = $req->name;
        $model->updated_at = now();
        $model->save();

        return redirect(route('types.edit', $req->id))->with('success', 'Data berhasil diubah.');
    }

    public function delete($id)
    {
        $types = Type::class;
        return view('types.index', compact('types'));
    }

    public function insert(Request $req)
    {
        $req->validate(['name'=>'required']);

        Type::create($req->post());

        return redirect(route('types.create'))->with('success', 'Data berhasil disimpan.');
    }
}
