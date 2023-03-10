<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\BankController;

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
        Route::post("/", "insert")->name('insert');
        Route::get("/detail/{id}", "detail")->name('detail');
        Route::get("/create", "create")->name('create');
        Route::put("/update/{id}", "update")->name('update');
        Route::delete("/delete/{id}", "delete")->name('delete');
});

Route::controller(CategoryController::class)
    ->prefix('categories')
    ->as('categories.')
    ->group(function() {
        // router for load view
        Route::get("/", "index")->name('index');
        Route::get("/detail/{id}", "detail")->name('detail');
        Route::get("/create", "create")->name('create');
        Route::get("/edit/{id}", "edit")->name('edit');
        // router for query
        Route::post("/", "insert")->name('insert');
        Route::put("/", "update")->name('update');
        Route::delete("/", "delete")->name('delete');
});

Route::controller(SubCategoryController::class)
    ->prefix('sub-categories')
    ->as('sub-categories.')
    ->group(function() {
        Route::get("/", "index")->name('index');
        Route::post("/", "insert")->name('insert');
        Route::get("/detail/{id}", "detail")->name('detail');
        Route::post("/create", "create")->name('create');
        Route::put("/update/{id}", "update")->name('update');
        Route::delete("/delete/{id}", "delete")->name('delete');
});

Route::controller(BankController::class)
    ->prefix('banks')
    ->as('banks.')
    ->group(function() {
        Route::get("/", "index")->name('index');
        Route::post("/", "insert")->name('insert');
        Route::get("/detail/{id}", "detail")->name('detail');
        Route::post("/create", "create")->name('create');
        Route::put("/update/{id}", "update")->name('update');
        Route::delete("/delete/{id}", "delete")->name('delete');
});

Route::controller(ProviderController::class)
    ->prefix('providers')
    ->as('providers.')
    ->group(function() {
        Route::get("/", "index")->name('index');
        Route::post("/", "insert")->name('insert');
        Route::get("/detail/{id}", "detail")->name('detail');
        Route::post("/create", "create")->name('create');
        Route::put("/update/{id}", "update")->name('update');
        Route::delete("/delete/{id}", "delete")->name('delete');
});
