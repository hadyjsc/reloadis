<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Type;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $model = Category::orderBy('id', 'desc')->paginate(10);
        return view('categories.index', compact('model'));
    }

    public function show($id)
    {
        $model = Category::find($id);
        return view('categories.detail', compact('model'));
    }

    public function create()
    {
        $model = Category::class;

        $type = Type::get(['id', 'name']);

        return view('categories.create', compact(['model','type']));
    }

    public function edit($id)
    {
        $type = Type::get(['id', 'name']);
        $model = Category::find($id);
        return view('categories.edit', compact(['model', 'type']));
    }

    public function insert(Request $req)
    {
        $req->validate([
            'name' => 'required',
            'type_id' => 'required'
        ]);

        Category::create($req->post());

        return redirect(route('categories.create'))->with('success', 'Data berhasil disimpan.');
    }

    public function update(Request $request, Category $model)
    {
        $request->validate([
            'name' => 'required',
            'type_id' => 'required',
        ]);

        $model = Category::find($request->id);
        $model->name = $request->name;
        $model->type_id = $request->type_id;
        $model->updated_at = now();
        $model->save();

        return redirect(route('categories.edit', $request->id))->with('success', 'Data berhasil diubah.');
    }

    public function delete(Request $req)
    {
        $model = Category::class;
        return view('categories.index', compact('model'));
    }
}
