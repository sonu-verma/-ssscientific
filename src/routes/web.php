<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\QuoteController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CustomerController;
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
        Route::get('/quote/edit/{quote}', 'edit')->name('quote.edit');
        Route::post('/quote/downloadQuote', 'downloadQuote')->name('quote.download');
    });
    Route::controller(ProductController::class)->group(function () {
        Route::get('/product','getProduct')->name('getProduct');
    });
    Route::controller(CustomerController::class)->group(function () {
        Route::get('/customers','getCustomers')->name('customers');
        Route::get('/ajax/customers','getCustomers')->name('ajax.customers');
    });
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/download', [App\Http\Controllers\HomeController::class, 'download'])->name('download');


