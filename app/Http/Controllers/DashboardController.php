<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
