<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
   public function index(){
        return view('admin.invoices.index');
   }
   public function create(Request $request){
        return view('admin.invoices.create');
   }
}
