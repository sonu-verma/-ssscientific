<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function download(){
        $page = 'admin.pdf.proposal';
        $prefix='Proposal';
        $var = [
            'data' => 'test'
        ];
        $type = 'pdf';
        if($type == 'pdf'){
            $pdf = \App::make('dompdf.wrapper');
            $pdf->getDomPDF()->set_option("enable_php", true);
            $pdf->loadView($page, $var);
            return $pdf->download(strtoupper($prefix).'- test'. '.pdf');

        }else{
            return view($page, $var);
        }
    }
}
