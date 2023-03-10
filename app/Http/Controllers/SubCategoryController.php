<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubCategory;

class SubCategoryController extends Controller
{
    public function index()
    {

        $model = SubCategory::orderBy('id', 'desc')->paginate(10);
        return view('sub-categories.index', compact('model'));
    }

    public function detail($id)
    {
        $model = SubCategory::where('id', $id);
        return view('sub-categories.detail', compact('model'));
    }

    public function create()
    {
        $model = SubCategory::class;
        return view('sub-categories.create', compact('model'));
    }

    public function update($id)
    {
        $model = SubCategory::class;
        return view('sub-categories.update', compact('model'));
    }

    public function delete($id)
    {
        $model = SubCategory::class;
        return view('sub-categories.index', compact('model'));
    }
}
