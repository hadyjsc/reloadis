<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bank;

class BankController extends Controller
{
    public function index()
    {

        $model = Bank::orderBy('id', 'desc')->paginate(10);
        return view('banks.index', compact('model'));
    }

    public function detail($id)
    {
        $model = Bank::where('id', $id);
        return view('banks.detail', compact('model'));
    }

    public function create()
    {
        $model = Bank::class;
        return view('banks.create', compact('model'));
    }

    public function update($id)
    {
        $model = Bank::class;
        return view('banks.update', compact('model'));
    }

    public function delete($id)
    {
        $model = Bank::class;
        return view('banks.index', compact('model'));
    }
}
