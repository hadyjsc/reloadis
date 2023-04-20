<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Type;
use App\Models\SubCategory;
use App\Models\Provider;
use App\Models\Product;
use App\Models\ProductItem;
use App\Models\Bank;
use App\Http\Resources\SubCategoryResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Exports\TransactionExport;
use Maatwebsite\Excel\Facades\Excel;

class TransactionController extends Controller
{
    public function index(Request $req)
    {
        $query = DB::table('products')
        ->selectRaw('products.id, products.provider_id,providers.name, providers.color, products.price, products.fund,
            (products.fund * COUNT(CASE WHEN product_items.is_sold = true THEN product_items.id END)) as total_fund,
            COUNT(product_items.id) AS stock,
            COUNT(CASE WHEN product_items.is_sold = true THEN product_items.id END) AS sold,
            COUNT(product_items.id) - COUNT(CASE WHEN product_items.is_sold = true THEN product_items.id END) AS last_stock,
            (products.price - products.fund) * COUNT(CASE WHEN product_items.is_sold = true THEN product_items.id END) AS profit')
        ->join('product_items', 'products.id', '=', 'product_items.product_id')
        ->leftJoin('providers', 'products.provider_id', '=', 'providers.id');

        $soldAt = !is_null($req['transaction-date']) ? $req['transaction-date'] : Carbon::now()->toDateString();
        $query->whereDate('product_items.sold_at', '=', $soldAt);

        $typeID = !is_null($req['type-id']) ? $req['type-id'] : null;
        if ($typeID) {
            $query->where('categories.type_id', '=', $typeID)->join('categories', 'products.category_id', '=', 'categories.id');
        }

        $categoryID = !is_null($req['category-id']) ? $req['category-id'] : null;
        if ($categoryID) {
            $query->where('products.category_id', '=', $categoryID);
        }

        $data = $query->groupBy(['products.id', 'products.provider_id', 'products.price', 'products.fund'])
        ->orderBy('products.provider_id')
        ->get();

        $categories = Category::get();
        $types = Type::get();

        return view('transaction.index',  compact(['categories', 'types', 'soldAt', 'typeID', 'categoryID', 'data']));
    }

    public function export(Request $req)
    {
        $fileName = 'transaction-'.Carbon::now()->toDateTimeString();
        if ($req['type'] == 'xlsx') {
            $soldAt = !is_null($req['transaction-date']) ? $req['transaction-date'] : Carbon::now()->toDateString();
            $typeID = !is_null($req['type-id']) ? $req['type-id'] : null;
            $categoryID = !is_null($req['category-id']) ? $req['category-id'] : null;

            return Excel::download(new TransactionExport($soldAt, $typeID, $categoryID), $fileName.'.xlsx');
        }

        if ($req['type'] == 'pdf') {
            return Excel::download(new TransactionExport, $fileName.'.xlsx');
        }
    }

    public function selling()
    {
        $query = DB::table('categories')
            ->selectRaw('categories.id, categories.name, types.name as type, COUNT(DISTINCT CASE WHEN product_items.is_sold = true THEN product_items.id END) as sold, COUNT(DISTINCT CASE WHEN product_items.is_sold = false THEN product_items.id END) as unsold')
            ->leftjoin('products', 'categories.id', '=', 'products.category_id')
            ->leftjoin('product_items', 'products.id', '=', 'product_items.product_id')
            ->join('types', 'types.id', '=', 'categories.type_id')
            ->groupBy(['categories.id', 'categories.name'])
            ->get();

        $category = [];
        foreach ($query as $data) {
            $category[$data->type][] = ['id' => $data->id, 'name' => $data->name, 'type' => $data->type, 'sold' => $data->sold, 'available' => $data->unsold];
        }

        if(Auth::user()->hasRole(['Counter', 'counter'])) {
            return view('transaction.counter-selling', compact(['category']));
        }

        return view('transaction.selling', compact(['category']));
    }

    public function out(Request $req)
    {

        $categoryID = $req["category-id"];
        $subCategoryID = $req["sub-category-id"];

        $provider = Provider::get();
        $subCategory = SubCategory::where('category_id', '=', $categoryID)->get();

        return view('transaction.out', compact(['subCategory', 'provider']));
    }

    public function getSubCategory(Request $req)
    {
        $categoryID = $req['category-id'];

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

        return view('transaction.create', compact('data', 'category'));
    }

    public function getProvider(Request $req)
    {
        $subCategory = $req['sub-category-id'];
        $provider = Provider::where('sub_category_id', '=', $subCategory)->get(['id', 'name', 'logo', 'color']);

        $data = [];
        foreach ($provider as $key => $value) {
            $data[] = ['id' => $value->id, 'sub_category_id' => $subCategory, 'name' => $value->name,  'logo' => $value->logo, 'color' => $value->color,];
        }

        if ($data) {
            return $this->sendResponse($data);
        }

        return $this->sendError("Not Found!", "Data tidak tersedia, silahkan hubungi admin.", [], 200);
    }

    public function stock(Request $req)
    {
        $category = $req['category'];
        $subcategory = $req['sub-category'];
        $provider = $req['provider'];

        $getAvailable = Product::selectRaw('COUNT(product_items.id) AS total_available_quantity')
            ->join('product_items', 'products.id', '=', 'product_items.product_id')
            ->where('products.category_id', '=', $category)
            ->where('products.sub_category_id', '=', $subcategory)
            ->where('products.provider_id', '=', $provider)
            ->where('product_items.is_sold', '=', false)
            ->pluck('total_available_quantity');

        if ($getAvailable) {
            return $this->sendResponse($getAvailable);
        }

        return $this->sendError("Not Found!", "Data tidak tersedia, silahkan hubungi admin.", [], 200);
    }

    public function items(Request $req)
    {
        $category = $req['category'];
        $subcategory = $req['sub-category'];
        $provider = $req['provider'];

        $getItem = Product::selectRaw('products.id, products.quota ,products.unit, products.description , products.price, COUNT(product_items.id) AS available')
            ->join('product_items', 'products.id', '=', 'product_items.product_id')
            ->where('products.category_id', '=', $category)
            ->where('products.sub_category_id', '=', $subcategory)
            ->where('products.provider_id', '=', $provider)
            ->where('products.stocked', '=', true)
            ->where('products.is_deleted', '=', false)
            ->where('product_items.is_sold', '=', false)
            ->groupBy(['products.id'])
            ->get();

        $data = [];
        foreach ($getItem as $key => $value) {
            $data[] = [
                'id' => $value->id,
                'quota' => $value->quota,
                'unit' => $value->unit,
                'description' => $value->description,
                'price' => $value->price,
                'available' => $value->available
            ];
        }

        if ($data) {
            return $this->sendResponse($data);
        }

        return $this->sendError("Not Found!", "Data tidak tersedia, silahkan hubungi admin.", [], 200);
    }

    public function insert(Request $req, Product $model)
    {
        $userId = Auth::user()->id;
        $req->validate([
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'provider_id' => 'required',
            'product_id' => 'required'
        ]);

        DB::beginTransaction();
        try {
            $model = Product::where('id', '=', $req->product_id)->where('stocked', '=', true)->exists();

            if($model) {
                $item = ProductItem::where('product_id', '=', $req->product_id)->where('is_sold', '=', false)->first();
                if ($item) {
                    $item->is_sold = true;
                    $item->sold_by = $userId;
                    $item->sold_at = now();
                    $item->updated_at = now();
                    $item->updated_by = $userId;
                    $item->save();

                    DB::commit();

                    return $this->sendResponse(['product_id' => $req->product_id]);
                } else {
                    $model = Product::where('id', '=', $req->product_id)->where('stocked', '=', true)->first();
                    if($model) {
                        $model->stocked = false;
                        $model->updated_by = $userId;
                        $model->updated_at = now();
                        $model->save();

                        DB::commit();
                    }
                    return $this->sendError( "invalid request", ["error"=> "Tidak ada stok produk."], 200);
                }
            }

            DB::commit();

            return $this->sendError( "invalid request", ["error"=> "Produk tidak ditemukan."], 200);
        } catch (Exception $e) {
            DB::rollback();
            return $this->sendError( "invalid request", ["error"=> "Tidak dapat melakukan permintaan."], 200);
        }
    }
}
