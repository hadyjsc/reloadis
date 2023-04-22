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
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\CashWithdrawalController;
use App\Http\Controllers\TopUpController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\WebHookController;
use App\Http\Controllers\TelegramController;

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

Route::group(['namespace' => 'App\Http\Controllers'], function()
{
    Route::group(['middleware' => ['guest']], function() {
        Route::controller(LoginController::class)->prefix('login')->as('login.')->group(function(){
            Route::get("/", "index")->name('index');
            Route::post("/", "perform")->name('perform');
        });

        Route::controller(WebHookController::class)->prefix('webhook')->as('webhook.')->group(function() {
            Route::post("/telegram", "telegram")->name('telegram');
        });
    });


    Route::group(['middleware' => ['auth', 'permission']], function() {
        Route::controller(DashboardController::class)->prefix('')->as('.')->group(function(){
            Route::get("/", "index");
            Route::get("/dashboard","index");
        });

        Route::controller(UserController::class)->prefix('users')->as('users.')->group(function() {
            Route::get("/", "index")->name("index");
            Route::get("/create", "create")->name("create");
            Route::get("/{id}/edit", "edit")->name('edit');

            Route::post("/insert", "insert")->name("insert");
            Route::put("/{id}/update", "update")->name('update');
            Route::get("/logout", "logout")->name("logout");
        });

        Route::resource('roles', RolesController::class);
        Route::resource('permissions', PermissionsController::class);

        Route::controller(DashboardController::class)->prefix('dashboard')->as('dashboard.')->group(function() {
            Route::get("/product", "product")->name("product");
            Route::get("/counter", "counter")->name("counter");
        });

        Route::controller(TransactionController::class)->prefix('transactions')->as('transactions.')->group(function() {
            Route::get("/index", "index")->name("index");
            Route::get("/selling", "selling")->name("selling");
            Route::get("/selling/out", "out")->name("out");
            Route::get("/subcategory", "getSubCategory")->name("getSubCategory");
            Route::get("/provider", "getProvider")->name("getProvider");
            Route::get("/stock", "stock")->name("stock");
            Route::get("/items", "items")->name("items");
            Route::get("/export/{type}", "export")->name("export");

            Route::post("/insert", "insert")->name("insert");
        });

        Route::controller(TransferController::class)->prefix('transfers')->as('transfers.')->group(function(){
            Route::get("/", "index")->name("index");
            Route::get("/{uuid}/show", "show")->name("show");

            Route::post("/", "store")->name('store');
            Route::put("/{uuid}/update", "update")->name('update');
            Route::put("/{uuid}/status", "status")->name('status');
        });

        Route::controller(CashWithdrawalController::class)->prefix('cash-withdrawals')->as('cash-withdrawals.')->group(function() {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
        });

        Route::controller(TopUpController::class)->prefix('topup')->as('topup.')->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get("/items", "getItem")->name('getItem');

            Route::post("/", "store")->name("store");
        });

        Route::controller(BillController::class)->prefix('bill')->as('bill.')->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('items', 'getItem')->name('getItem');

            Route::post('/', 'store')->name('store');
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

        Route::controller(BranchController::class)->prefix('branches')->as('branches.')->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('/{id}/show', 'show')->name('show');
            Route::get('/create', 'create')->name('create');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::post("/", "store")->name('store');
            Route::put("/{id}/update", "update")->name('update');
            Route::delete("/", "destroy")->name('destroy');
        });

        Route::controller(ScheduleController::class)->prefix('schedules')->as('schedules.')->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('/{id}/show', 'show')->name('show');
            Route::get('/create', 'create')->name('create');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::post("/", "store")->name('store');
            Route::put("/{id}/update", "update")->name('update');
            Route::delete("/", "destroy")->name('destroy');
        });

        Route::controller(TelegramController::class)->prefix('telegram-notif')->as('telegram-notif.')->group(function(){
            Route::get('/send', 'send')->name('send');
            Route::post('/request', 'request')->name('request');
        });
    });
});
