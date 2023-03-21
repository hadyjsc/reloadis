<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductItemController;

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

Route::controller(DashboardController::class)->prefix('dashboard')->as('dashboard.')->group(function() {
    Route::get("/product", "product")->name("product");
});

Route::controller(ProviderController::class)
    ->prefix('providers')
    ->as('providers.')
    ->group(function() {
         // router for load view
         Route::get("/", "index")->name('index');
         Route::get("/{id}/show", "show")->name('show');
         Route::get("/create", "create")->name('create');
         Route::get("/{id}/edit", "edit")->name('edit');
         // router for query
         Route::post("/", "insert")->name('insert');
         Route::put("/{id}/update", "update")->name('update');
         Route::delete("/", "delete")->name('delete');
});

Route::controller(TypeController::class)
    ->prefix('types')
    ->as('types.')
    ->group(function() {
        // router for load view
        Route::get("/", "index")->name('index');
        Route::get("/{id}/show", "show")->name('show');
        Route::get("/create", "create")->name('create');
        Route::get("/{id}/edit", "edit")->name('edit');
        // router for query
        Route::post("/", "insert")->name('insert');
        Route::put("/{id}/update", "update")->name('update');
        Route::delete("/", "delete")->name('delete');
});

Route::controller(CategoryController::class)
    ->prefix('categories')
    ->as('categories.')
    ->group(function() {
        // router for load view
        Route::get("/", "index")->name('index');
        Route::get("/{id}/show", "show")->name('show');
        Route::get("/create", "create")->name('create');
        Route::get("/{id}/edit", "edit")->name('edit');
        // router for query
        Route::post("/", "insert")->name('insert');
        Route::put("/{id}/update", "update")->name('update');
        Route::delete("/", "delete")->name('delete');
});

Route::controller(SubCategoryController::class)
    ->prefix('sub-categories')
    ->as('sub-categories.')
    ->group(function() {
        // router for load view
        Route::get("/", "index")->name('index');
        Route::get("/{id}/show", "show")->name('show');
        Route::get("/create", "create")->name('create');
        Route::get("/{id}/edit", "edit")->name('edit');
        // router for query
        Route::post("/", "insert")->name('insert');
        Route::put("/{id}/update", "update")->name('update');
        Route::delete("/", "delete")->name('delete');
});

Route::controller(BankController::class)
    ->prefix('banks')
    ->as('banks.')
    ->group(function() {
        // router for load view
        Route::get("/", "index")->name('index');
        Route::get("/{id}/show", "show")->name('show');
        Route::get("/create", "create")->name('create');
        Route::get("/{id}/edit", "edit")->name('edit');
        // router for query
        Route::post("/", "insert")->name('insert');
        Route::put("/{id}/update", "update")->name('update');
        Route::delete("/", "delete")->name('delete');
});

Route::controller(ProductController::class)
    ->prefix('products')
    ->as('products.')
    ->group(function() {
        // router for load view
        Route::get("/", "index")->name('index');
        Route::get("/{id}/show", "show")->name('show');
        Route::get("/create", "create")->name('create');
        Route::get("/{id}/edit", "edit")->name('edit');
        // router for query
        Route::post("/", "insert")->name('insert');
        Route::put("/{id}/update", "update")->name('update');
        Route::delete("/", "delete")->name('delete');
    });

Route::controller(ProductItemController::class)
->prefix('product-items')
->as('product-items.')
->group(function() {
    // router for load view
    Route::get("/", "index")->name('index');
    Route::get("/{id}/show", "show")->name('show');
    Route::get("/create", "create")->name('create');
    Route::get("/{id}/edit", "edit")->name('edit');
    // router for query
    Route::post("/", "insert")->name('insert');
    Route::put("/{id}/update", "update")->name('update');
    Route::delete("/", "delete")->name('delete');
});
