<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {

        $model = Product::orderBy('id', 'desc')->paginate(10);
        return view('products.index', compact('model'));
    }

    public function show($id)
    {
        $model = Product::where('id', $id);
        return view('products.detail', compact('model'));
    }

    public function create()
    {
        $model = Product::class;
        return view('products.create', compact('model'));
    }

    public function edit($id)
    {
        $model = Product::class;
        return view('products.update', compact('model'));
    }

    public function insert(Request $req)
    {
        return redirect(route('products.create'))->with('success', 'Data berhasil disimpan.');
    }

    public function update(Request $request, Product $model)
    {
        return redirect(route('products.edit', $request->id))->with('success', 'Data berhasil diubah.');
    }

    public function delete($id)
    {
        $model = Product::class;
        return view('products.index', compact('model'));
    }
}
