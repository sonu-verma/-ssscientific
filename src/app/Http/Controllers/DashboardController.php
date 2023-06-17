<?php

namespace App\Http\Controllers;

use App\Models\Admin\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard(){
        $totalQuotes = Quote::where('status',Quote::STATUS_ACTIVE)->get()->count();
        $approvedQuotes = Quote::where('action_type',Quote::ACTION_STATUS_APPROVED)->get()->count();
        $rejectedQuotes = Quote::where('action_type',Quote::ACTION_STATUS_REJECTED)->get()->count();
        $otherQuotes = Quote::whereNotIn('action_type',[Quote::ACTION_STATUS_APPROVED,Quote::ACTION_STATUS_REJECTED])->get()->count();

        if(Auth::user()->role_id != 1){
            $totalQuotes = $totalQuotes->where('created_by',Auth::user()->id)->get()->count();
            $approvedQuotes = Quote::where('created_by',Auth::user()->id)->where('action_type',Quote::ACTION_STATUS_APPROVED)->get()->count();
            $rejectedQuotes = Quote::where('created_by',Auth::user()->id)->where('action_type',Quote::ACTION_STATUS_REJECTED)->get()->count();
            $otherQuotes = Quote::where('created_by',Auth::user()->id)->whereNotIn('action_type',[Quote::ACTION_STATUS_APPROVED,Quote::ACTION_STATUS_REJECTED])->get()->count();
        }
        return view('admin.dashboard',[
            'totalQuotes' => $totalQuotes,
            'approvedQuotes' => $approvedQuotes,
            'rejectedQuotes' => $rejectedQuotes,
            'otherQuotes' => $otherQuotes
        ]);
        // return view('admin.pdf.proposal');
    }
}
