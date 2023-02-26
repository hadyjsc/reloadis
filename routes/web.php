<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
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

Route::controller(DashboardController::class)->prefix('')->as('.')->group(function(){
    Route::get("", "index");
    Route::get("/dashboard","index");
});


Route::controller(TypeController::class)
    ->prefix('types')
    ->as('types.')
    ->group(function() {
        Route::get("/", "index")->name('index');
        Route::get("/{id}", "detail")->name('detail');
        Route::post("/", "create")->name('create');
        Route::put("/{id}", "update")->name('update');
        Route::delete("/{id}", "delete")->name('delete');
});
