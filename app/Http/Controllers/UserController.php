<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();

        return redirect('login');
    }

    public function create()
    {
        $roles = Role::get(['id','name'])->all();

        return view('users.create', compact('roles'));
    }

    public function insert(Request $req)
    {
        $req->validate([
            'name' => 'required',
            'email' => 'required|email:rfc,dns|unique:users,email',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
            'role_id' => 'required'
        ]);

        try {
            $user = User::create($req->post());
            $user->assignRole($req->role_id);

            return redirect(route('users.create'))->with('success', 'Data berhasil disimpan.');
        } catch (Exception $e) {
            return redirect(route('users.create'))->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $user = User::find($id)->join('roles', 'roles.id', '=', 'users.role_id')->select(['users.id', 'roles.id as roleId', 'roles.name as roleName', 'users.name', 'users.email'])->first();
        $roles = Role::get(['id', 'name'])->all();

        $userRole = $user->toArray()['roleName'];

        return view('users.edit', compact(['user','userRole' ,'roles']));
    }

    public function update(Request $req, User $user)
    {
        $req->validate([
            'name' => 'required',
            'email' => 'required|email',
            'role_id' => 'required'
        ]);


        $user = User::where('id', '=', $req->id)->first();
        $user->name = $req->name;
        $user->email = $req->email;
        $user->role_id = $req->role_id;
        $user->updated_at = now();
        $user->save();

        $user->syncRoles($req->role_id);

        return redirect(route('users.edit', $req->id))->with('success', 'Data berhasil diubah.');
    }
}
