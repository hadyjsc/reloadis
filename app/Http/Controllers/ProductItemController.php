<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductItem;
use App\Models\Product;

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
        $product = Product::join('categories', 'categories.id', '=', 'products.category_id')
                    ->leftjoin('providers', 'providers.id', '=', 'products.provider_id')
                    ->get(['products.id', 'category_id','categories.name', 'provider_id', 'providers.name', 'quota', 'unit']);
        return view('product-items.create', compact(['model','product']));
    }

    public function edit($id)
    {
        $model = ProductItem::class;
        return view('product-items.update', compact('model'));
    }

    public function insert(Request $req)
    {
        $req->validate([
            'product_id' => 'required',
            'serial_number' => 'required'
        ]);

        $batchInsert = [];
        for ($i=0; $i < 10 ; $i++) {
            $temp = ['product_id'=> $req->product_id, 'serial_number' => $req->serial_number."-".$i];
            $batchInsert[$i] = $temp;
        }

        ProductItem::insert($batchInsert);

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
