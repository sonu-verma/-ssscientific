<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(){
        return view('admin.dashboard');
        // return view('admin.pdf.proposal');
    }
}
