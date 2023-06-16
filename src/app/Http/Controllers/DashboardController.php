<?php

namespace App\Http\Controllers;

use App\Models\Admin\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard(){
        $totalQuotes = Quote::where('status',Quote::STATUS_ACTIVE);
        if(Auth::user()->role_id != 1){
            $totalQuotes = $totalQuotes->where('created_by',Auth::user()->id);
        }
        $totalQuotes = $totalQuotes->count();
        return view('admin.dashboard',[
            'totalQuotes' => $totalQuotes
        ]);
        // return view('admin.pdf.proposal');
    }
}
