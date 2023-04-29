<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function getCustomers(){
        $customers = User::where('status',1)->get()->all();
        return view('admin.customers.index',[
            'customers' => $customers
        ]);
    }
}
