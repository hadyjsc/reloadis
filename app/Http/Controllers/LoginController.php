<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function perform(LoginRequest $req)
    {
        $req->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credential = $req->getCredentials();

        if(!Auth::validate($credential)) {
            return redirect()->to('login')->withErrors('failed', 'Username and Password not match');
        }

        $user = Auth::getProvider()->retrieveByCredentials($credential);
        Auth::login($user);

        return $this->authenticated($req, $user);
    }

    /**
     * Handle response after user authenticated
     *
     * @param Request $request
     * @param Auth $user
     *
     * @return \Illuminate\Http\Response
     */
    protected function authenticated(Request $request, $user)
    {
        if($user->hasRole("admin") || $user->hasRole("Admin")) {
            return redirect()->intended();
        }

        return redirect()->route('transactions.selling');
    }
}
