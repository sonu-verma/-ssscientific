<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        return view('admin.products.index',[
            'products' => $products
        ]);
    }

    public function getProduct(Request $request){
        return view('admin.products.product');
    }
}
