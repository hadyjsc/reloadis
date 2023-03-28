<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    public function create()
    {
        return view('users.create');
    }

    public function insert(Request $req)
    {
        $req->validate([
            'name' => 'required',
            'email' => 'required|email:rfc,dns|unique:users,email',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password'
        ]);

        User::create($req->post());

        return redirect(route('users.create'))->with('success', 'Data berhasil disimpan.');
    }

    public function edit()
    {
        # code...
    }
}