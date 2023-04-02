<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $dashboard = "Dashboard";
        return view('stisla-dashboard', compact('dashboard'));
    }

    public function product()
    {
        return view('dashboard.product');
    }

    public function counter()
    {
        return view('dashboard.counter');
    }
}
