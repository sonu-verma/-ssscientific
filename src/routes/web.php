<?php

use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\ProductCartItemsController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PurchaseOrderController;
use App\Http\Controllers\Admin\QuoteController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\DashboardController;
use \App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;

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
    Route::prefix('admin')->group(function () {
        Route::controller(ProductController::class)->group(function () {
            Route::get('/products','index')->name('products');
            Route::get('/ajax/product','getProduct')->name('ajax.product');
            Route::get('/ajax/products','getProducts')->name('ajax.products');
            Route::get('/delete/product/{product}','deleteProduct')->name('delete.product');
            Route::get('/product/create','create')->name('create.product');
            Route::post('/product/store','store')->name('store.product');
            Route::get('/edit/product/{product}','edit')->name('edit.product');
            Route::post('/product/update','update')->name('update.product');
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
            Route::get('/delete/role/{role}','deleteRole')->name('delete.role');
            Route::get('/edit/role/{role}','edit')->name('edit.role');
            Route::get('/role/create','create')->name('create.role');
            Route::post('/role/store','store')->name('store.role');
            Route::post('/role/update','update')->name('update.role');
        });
        Route::controller(CategoryController::class)->group(function () {
            Route::get('/categories','index')->name('categories');
            Route::get('/category/create','create')->name('create.category');
            Route::post('/category/store','store')->name('store.category');
            Route::get('/category/delete/{category}','destroy')->name('delete.category');
            Route::get('/category/edit/{category}','edit')->name('edit.category');
            Route::post('/category/update','update')->name('update.category');
        });
    });
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'dashboard')->name('dashboard');
    });
    Route::controller(QuoteController::class)->group(function () {
        Route::get('/quotes', 'index')->name('quotes');
        Route::get('/ajax/quotes', 'index')->name('ajax.quotes');
        Route::post('/quote/details', 'getQuote')->name('ajax.getQuote');
        Route::get('/quote/create', 'create')->name('quote.add');
        Route::post('/quote/add', 'store')->name('quote.create');
        Route::post('/quote/update/{quote}', 'update')->name('quote.update');
        Route::get('/quote/edit/{id}', 'edit')->name('quote.edit');
        Route::get('/quote/downloadQuote/{quote_id}', 'downloadQuote')->name('quote.download');
        Route::post('/quote/change-status/{quote_id}', 'changeStatus')->name('quote.changeStatus');
    });
    Route::controller(ProductCartItemsController::class)->group(function(){
        Route::post('/product/additem','addCartItem')->name('product.additem');
        Route::get('/quote/items/{id}','getItems')->name('getItems');
        Route::post('/remove/item','addCartItem')->name('item.remove');
    });
    Route::controller(InvoiceController::class)->group(function(){
        Route::get('/invoices','index')->name('invoices');
        Route::get('/invoice/create','create')->name('create.invoice');
        Route::post('/invoice/store','store')->name('store.invoice');
        Route::get('/invoice/edit/{invoice_id}','edit')->name('edit.invoice');
        Route::post('/invoice/update','update')->name('update.invoice');
        Route::get('/invoice/delete/{invoice}','destroy')->name('delete.invoice');
        Route::get('/invoice/download/{invoice_id}', 'downloadInvoice')->name('invoice.download');
    });
    Route::controller(PurchaseOrderController::class)->group(function(){
        Route::get('/purchase-orders','index')->name('purchase.orders');
        Route::get('/purchase-order/create','create')->name('create.purchase-order');
        Route::post('/purchase-order/store','store')->name('store.purchaseOrder');
        Route::get('/purchase-order/delete','destroy')->name('delete.purchaseOrder');
        Route::get('/purchase-order/edit/{purchaseOrderId}','edit')->name('edit.purchaseOrder');
        Route::post('/purchase-order/update/{purchaseOrder}','update')->name('update.purchaseOrder');
        Route::post('/purchase-order/details','getPurchseOrder')->name('po.getPurchseOrder');
        Route::get('/purchase-order/download/{po_id}', 'downloadPurchaseOrder')->name('po.download');
    });
});

Route::post('/user/details', [App\Http\Controllers\HomeController::class, 'getUser'])->name('users');
Route::get('/user/info', [App\Http\Controllers\HomeController::class, 'getUserDetails'])->name('user.info');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/download', [App\Http\Controllers\HomeController::class, 'download'])->name('download');


