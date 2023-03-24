<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Provider;
use App\Http\Resources\SubCategoryResource;

class TransactionController extends Controller
{
    public function selling()
    {
        $category_model = Category::join('types', 'types.id', '=', 'categories.type_id')
        ->get(['categories.id', 'type_id', 'types.name as type', 'categories.name']);

        $category = [];
        foreach ($category_model as $data) {
            $category[$data->type][] = ['id' => $data->id, 'name' => $data->name, 'type' => $data->type];
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
        $subCategory = SubCategory::where('category_id', '=', $categoryID)->get(['id','name']);

        $data = [];
        foreach ($subCategory as $key => $value) {
            $data[] = ['id'=> $value->id, 'name'=>$value->name];
        }

        return view('transaction.create', compact('data'));
    }

    public function getProvider(Request $req)
    {
        $subCategory = $req['sub-category-id'];
        $provider = Provider::where('sub_category_id', '=', $subCategory)->get(['id', 'name', 'logo', 'color']);

        $data = [];
        foreach ($provider as $key => $value) {
            $data[] = ['id' => $value->id, 'name' => $value->name,  'logo' => $value->logo, 'color' => $value->color,];
        }

        return $this->sendResponse($data, 'success');
    }
}
