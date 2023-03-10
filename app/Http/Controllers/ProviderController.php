<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Provider;

class ProviderController extends Controller
{
    public function index()
    {

        $model = Provider::orderBy('id', 'desc')->paginate(10);
        return view('providers.index', compact('model'));
    }

    public function detail($id)
    {
        $model = Provider::where('id', $id);
        return view('providers.detail', compact('model'));
    }

    public function create()
    {
        $model = Provider::class;
        return view('providers.create', compact('model'));
    }

    public function update($id)
    {
        $model = Provider::class;
        return view('providers.update', compact('model'));
    }

    public function delete($id)
    {
        $model = Provider::class;
        return view('providers.index', compact('model'));
    }
}
