<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TypeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('stisla-dashboard');
});


Route::controller(TypeController::class)
    ->prefix('types')
    ->as('types.')
    ->group(function() {
        Route::get("", "index");
        Route::get("/{id}", "detail");
        Route::post("", "create");
        Route::put("/{id}", "update");
        Route::delete("/{id}", "delete");
});
