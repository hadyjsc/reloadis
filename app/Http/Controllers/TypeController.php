<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Type;

class TypeController extends Controller
{
    public function index()
    {

        $types = Type::orderBy('id', 'desc')->paginate(10);
        return view('types.index', compact('types'));
    }

    public function detail($id)
    {
        $types = Type::where('id', $id);
        return view('types.detail', compact('types'));
    }

    public function create()
    {
        $types = Type::class;
        return view('types.create', compact('types'));
    }

    public function update($id)
    {
        $types = Type::class;
        return view('types.update', compact('types'));
    }

    public function delete($id)
    {
        $types = Type::class;
        return view('types.index', compact('types'));
    }
}
