<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\QuoteController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\ProductCartItemsController;
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


Auth::routes();

Route::get('/', function () {
    return redirect('/login');
});


Route::middleware(['auth'])->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'dashboard')->name('dashboard');
    });
    Route::controller(QuoteController::class)->group(function () {
        Route::get('/quotes', 'index')->name('quotes');
        Route::get('/ajax/quotes', 'index')->name('ajax.quotes');
        Route::get('/quote/create', 'create')->name('quote.add');
        Route::post('/quote/add', 'store')->name('quote.create');
        Route::post('/quote/update/{quote}', 'update')->name('quote.update');
        Route::get('/quote/edit/{id}', 'edit')->name('quote.edit');
        Route::get('/quote/downloadQuote/{quote_id}', 'downloadQuote')->name('quote.download');
    });
    Route::controller(ProductController::class)->group(function () {
        Route::get('/products','index')->name('products');
        Route::get('/ajax/product','getProduct')->name('ajax.product');
        Route::get('/ajax/products','getProducts')->name('ajax.products');
    });
    Route::controller(CustomerController::class)->group(function () {
        Route::get('/customers','getCustomers')->name('customers');
        Route::get('/add/customer','add')->name('create.customer');
        Route::post('/store/customer','updateCustomerForm')->name('store.customer');
        Route::get('/ajax/customers','getCustomers')->name('ajax.customers');
        Route::get('/edit/customer/{user}','edit')->name('edit.customer');
        Route::get('/delete/customer/{user}','deleteCustomer')->name('delete.customer');
    });
    Route::controller(RolesController::class)->group(function () {
        Route::get('/roles','index')->name('roles');
    });
    Route::controller(RolesController::class)->group(function () {
        Route::get('/categories','index')->name('categories');
    });

    Route::controller(ProductCartItemsController::class)->group(function(){
        Route::post('/product/additem','addCartItem')->name('product.additem');
        Route::get('/quote/items/{id}','getItems')->name('getItems');
    });
});

Route::post('/user/details', [App\Http\Controllers\HomeController::class, 'getUser'])->name('users');
Route::get('/user/info', [App\Http\Controllers\HomeController::class, 'getUserDetails'])->name('user.info');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/download', [App\Http\Controllers\HomeController::class, 'download'])->name('download');


