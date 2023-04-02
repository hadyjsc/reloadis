<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Provider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
        $category = Category::get(['id', 'name']);
        $provider = Provider::get(['id', 'name']);
        return view('products.detail', compact(['model', 'category', 'provider']));
    }

    public function create()
    {
        $model = Product::class;
        $category = Category::get(['id', 'name']);
        $subcategory = SubCategory::get(['id', 'name']);
        $provider = Provider::get(['id', 'name']);
        return view('products.create', compact(['model', 'category', 'subcategory', 'provider']));
    }

    public function edit($id)
    {
        $model = Product::class;
        return view('products.update', compact('model'));
    }

    public function insert(Request $req)
    {
        $user = Auth::user();
        DB::beginTransaction();
        try {
            $req->validate([
                'category_id' => 'required',
                'quota' => 'required',
                'unit' => 'required',
                'price' => 'required',
                'fund' => 'required',
                'fund_date' => 'required',
            ]);

            Product::create([
                'category_id' => $req->category_id,
                'sub_category_id' => $req->sub_category_id,
                'provider_id' => $req->provider_id,
                'quota' => $req->quota,
                'unit' => $req->unit,
                'price' => $req->price,
                'description' => $req->description,
                'fund' => $req->fund,
                'fund_date' => $req->fund_date,
                'stocked' => 1,
                'created_by' => $user->id,
            ]);
            DB::commit();
            return redirect(route('products.create'))->with('success', 'Data berhasil disimpan.');
        } catch (Exception $e) {
            return redirect(route('products.create'))->with('error', 'Gagal menyimpan data.'. $e->getMessage());
        }

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
