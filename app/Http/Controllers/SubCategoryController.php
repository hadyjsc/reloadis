<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Provider;
use App\Models\Category;

class SubCategoryController extends Controller
{
    public function index()
    {
        $model = SubCategory::orderBy('id', 'desc')->paginate(10);
        return view('sub-categories.index', compact('model'));
    }

    public function show($id)
    {
        $model = SubCategory::find($id);
        return view('sub-categories.detail', compact('model'));
    }

    public function create()
    {
        $model = SubCategory::class;
        $provider = Provider::get(['id', 'name']);
        $type = Category::get(['id', 'name']);

        return view('sub-categories.create', compact(['model','provider','type']));
    }

    public function edit($id)
    {
        // $provider = Provider::
        $type = Category::get(['id', 'name']);
        $model = SubCategory::find($id);
        return view('categories.edit', compact(['model', 'type']));
    }

    public function insert(Request $req)
    {
        $req->validate([
            'name' => 'required',
            'category_id' => 'required'
        ]);

        SubCategory::create($req->post());

        return redirect(route('sub-categories.create'))->with('success', 'Data berhasil disimpan.');
    }

    public function update(Request $request, SubCategory $model)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
        ]);

        $model = SubCategory::find($request->id);
        $model->name = $request->name;
        $model->category_id = $request->category_id;
        $model->updated_at = now();
        $model->save();

        return redirect(route('sub-categories.edit', $request->id))->with('success', 'Data berhasil diubah.');
    }

    public function delete(Request $req)
    {
        $model = SubCategory::class;
        return view('sub-categories.index', compact('model'));
    }
}
