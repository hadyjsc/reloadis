<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ProductItem;

class TopUpController extends Controller
{
    public function index(Request $req)
    {
        $categoryID = $req["category-id"];

        $query = DB::table('sub_categories')
            ->selectRaw('sub_categories.id, sub_categories.name, COUNT(DISTINCT CASE WHEN product_items.is_sold = true THEN product_items.id END) as sold, COUNT(DISTINCT CASE WHEN product_items.is_sold = false THEN product_items.id END) as unsold')
            ->join('products', 'sub_categories.id', '=', 'products.sub_category_id')
            ->join('product_items', 'products.id', '=', 'product_items.product_id')
            ->groupBy(['sub_categories.id', 'sub_categories.name'])
            ->where('products.category_id', '=', $categoryID )
            ->get();

        $data = [];
        foreach ($query as $key => $value) {
            $data[] = ['id'=> $value->id, 'category_id' => $categoryID, 'name'=>$value->name, 'sold' => $value->sold, 'unsold' => $value->unsold];
        }

        $category = Category::where('id', '=', $categoryID)->get(['id', 'name'])->first();

        return view('topup.index', compact(['data', 'category']));
    }

    public function getItem(Request $req)
    {
        $id = $req['sub-category-id'];

        $query = DB::table('sub_categories')
            ->selectRaw('products.id, sub_categories.id as sub_category, sub_categories.name, products.quota, products.price, products.description, COUNT(DISTINCT CASE WHEN product_items.is_sold = true THEN product_items.id END) as sold, COUNT(DISTINCT CASE WHEN product_items.is_sold = false THEN product_items.id END) as available')
            ->join('products', 'sub_categories.id', '=', 'products.sub_category_id')
            ->join('product_items', 'products.id', '=', 'product_items.product_id')
            ->groupBy(['products.id', 'sub_categories.id', 'sub_categories.name', 'products.quota'])
            ->where('products.sub_category_id', '=', $id )
            ->get()->toArray();

        if ($query) {
            return $this->sendResponse($query);
        }

        return $this->sendError("Not Found!", "Data tidak tersedia, silahkan hubungi admin.", [], 200);
    }

    public function store(Request $req)
    {
        $user = Auth::user();

        if ($req->product_id) {
            $req->validate([
                'product_id' => 'required|integer',
                'sub_category_id' => 'required',
                'product_id' => 'required'
            ]);

            DB::beginTransaction();
            try {
                $model = Product::where('id', '=', $req->product_id)->where('stocked', '=', true)->exists();

                if($model) {
                    $item = ProductItem::where('product_id', '=', $req->product_id)->where('is_sold', '=', false)->first();
                    if ($item) {
                        $item->is_sold = true;
                        $item->sold_by = $user->id;
                        $item->sold_at = now();
                        $item->updated_at = now();
                        $item->updated_by = $user->id;
                        $item->save();

                        DB::commit();

                        return $this->sendResponse(['product_id' => $req->product_id], null, "Berhasil melaporkan penjualan.");
                    } else {
                        $model = Product::where('id', '=', $req->product_id)->where('stocked', '=', true)->first();
                        if($model) {
                            $model->stocked = false;
                            $model->updated_by = $user->id;
                            $model->updated_at = now();
                            $model->save();

                            DB::commit();
                        }
                        return $this->sendError( "Invalid Request", "Tidak ada stok produk.", [], 200);
                    }
                }
                DB::commit();
                return $this->sendError("Invalid Request", "Produk tidak ditemukan.", [], 200);
            } catch (Exception $e) {
                DB::rollback();
                return $this->sendError("Invalid Request", "Tidak dapat melakukan permintaan.", ["error"=> $e->getMessage()], 200);
            }
        } else {
            $req->validate([
                'name' => 'required',
                'category_id' => 'required|integer',
                'quota' => 'required|numeric',
                'unit' => 'required',
                'price' => 'required|numeric'
            ]);

            DB::beginTransaction();
            try {
                // check sub category exist = select, !exist = insert
                $get = SubCategory::where('category_id', '=', $req->category_id)->where('name', 'like', $req->name)->first();
                $subId = 0;
                if ($get == null) {
                    $subId = SubCategory::create([
                        'category_id' => $req->category_id,
                        'name' => $req->name,
                        'created_at' => now()
                    ])->id;
                } else {
                    $subId = $get->id;
                }

                // check related product id by description or amount
                $product = Product::where([
                    ['category_id', '=', $req->category_id],
                    ['sub_category_id', '=', $subId],
                    ['quota', '=', $req->quota],
                ])->orWhere('description', 'like', '%'.$req->description.'%')->first();

                $productId = 0;
                if ($product == null) {
                    $productId = Product::create([
                        'category_id' => $req->category_id,
                        'sub_category_id' => $subId,
                        'quota' => $req->quota,
                        'unit' => $req->unit,
                        'price' => $req->price,
                        'stocked' => 0,
                        'description' => $req->description,
                        'created_by' => $user->id,
                        'created_at' => now()
                    ])->id;
                } else {
                    $productId = $product->id;
                }

                // insert to product item
                ProductItem::create([
                    'product_id' => $productId,
                    'serial_number' => $req->name.''.rand(1, 99),
                    'is_sold' => 1,
                    'sold_at' => now(),
                    'sold_by' => $user->id,
                    'created_by' => $user->id,
                    'created_at' => now()
                ]);

                DB::commit();
                return $this->createdResponse([], "Successfully!",  "Berhasil melaporkan penjualan.");
            } catch (Exception $e) {
                DB::rollback();
                return $this->sendError("Invalid Request", "Tidak dapat melakukan permintaan.", ["error"=> $e->getMessage()], 200);
            }
        }
    }
}
