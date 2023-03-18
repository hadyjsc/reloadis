<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductItem;

class ProductItemController extends Controller
{
    public function index()
    {

        $model = ProductItem::orderBy('id', 'desc')->paginate(10);
        return view('product-items.index', compact('model'));
    }

    public function show($id)
    {
        $model = ProductItem::where('id', $id);
        return view('product-items.detail', compact('model'));
    }

    public function create()
    {
        $model = ProductItem::class;
        return view('product-items.create', compact('model'));
    }

    public function edit($id)
    {
        $model = ProductItem::class;
        return view('product-items.update', compact('model'));
    }

    public function insert(Request $req)
    {
        return redirect(route('product-items.create'))->with('success', 'Data berhasil disimpan.');
    }

    public function update(Request $request, ProductItem $model)
    {
        return redirect(route('product-items.edit', $request->id))->with('success', 'Data berhasil diubah.');
    }

    public function delete($id)
    {
        $model = ProductItem::class;
        return view('product-items.index', compact('model'));
    }
}
