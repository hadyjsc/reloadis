<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\ProductItem;
use Illuminate\Support\Str;

class BillController extends Controller
{
    public function index(Request $req)
    {
        $req->validate([
            'category-id' => 'required'
        ]);

        $categoryID = $req['category-id'];

        $subCategory = SubCategory::where('category_id', '=', $categoryID)->get();
        $category = Category::where('id', '=', $categoryID)->get(['id', 'name'])->first();
        $product = Product::where('category_id', '=', $categoryID)->get();

        return view('bill.index', compact(['subCategory', 'category', 'product']));
    }

    public function getItem()
    {
        # code...
    }

    public function store(Request $req)
    {
        $user = Auth::user();
        if ($req->product_id) {
            $req->validate([
                'category_id' => 'required',
            ]);

            $category = Category::where('id', '=', $req->category_id)->get(['id', 'name'])->first();

            DB::beginTransaction();
            try {
                ProductItem::create([
                    'product_id' => $req->product_id,
                    'serial_number' =>  Str::replace(' ', '', Str::ucfirst($category->name)).'-'.time(),
                    'is_sold' => 1,
                    'sold_at' => now(),
                    'sold_by' => $user->id,
                    'created_by' => $user->id,
                    'created_at' => now()
                ]);

                DB::commit();
                return $this->createdResponse([], "Successfully!",  "Berhasil melaporkan penjualan.");
            } catch(Exception $e) {
                DB::rollback();
                return $this->sendError("Invalid Request", "Tidak dapat melakukan permintaan.", ["error"=> $e->getMessage()], 200);
            }
        } else {
            $req->validate([
                'category_id' => 'required',
                'quota' => 'required|numeric',
                'price' => 'required|numeric'
            ]);

            $category = Category::where('id', '=', $req->category_id)->get(['id', 'name'])->first();

            DB::beginTransaction();
            try {

                $productId = Product::create([
                    'category_id' => $req->category_id,
                    'quota' => $req->quota,
                    'price' => $req->price,
                    'unit' => 'IDR',
                    'description' => $req->description ? $req->description : 'Token listrik prabayar',
                    'stocked' => 1,
                    'created_by' => $user->id,
                    'created_at' => now()
                ])->id;

                ProductItem::create([
                    'product_id' => $productId,
                    'serial_number' => Str::replace(' ', '', Str::ucfirst($category->name)).'-'.time(),
                    'is_sold' => 1,
                    'sold_at' => now(),
                    'sold_by' => $user->id,
                    'created_by' => $user->id,
                    'created_at' => now()
                ]);

                DB::commit();
                return $this->createdResponse([], "Successfully!",  "Berhasil melaporkan penjualan.");
            } catch(Exception $e) {
                DB::rollback();
                return $this->sendError("Invalid Request", "Tidak dapat melakukan permintaan.", ["error"=> $e->getMessage()], 200);
            }
        }
    }
}
