<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public function getUserDetails(Request $request){
        $id = $request->get('id');
        $user = User::where('id',$id)->get()->first();
        return response()->json($user);
    }

    public function getUser(Request $request) {
        $searchTerm = trim($request->get('term', ''));
        $page = trim($request->get('page', 1));
        $limit = 10;
        if ($page < 1) {
            $page = 1;
        }

        $currentPage = $page;
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });
        $userType = [];
        $tblUser = User::getTableName();
        $source = User::where('id','!=', Auth::user()->id)->where([$tblUser.'.status' => 1,$tblUser.'.role_id' => User::ROLE_CUSTOMER]);


        if ($searchTerm !== '' && strlen($searchTerm) > 0) {
            $source->where(function ($query) use ($searchTerm,$tblUser) {
                if (preg_match('/^[0-9]+$/', $searchTerm)) {
                    $query->where($tblUser.'.id', '=', $searchTerm);
                } else {
                    $query->where($tblUser.'.email', 'LIKE', $searchTerm.'%')
                        ->orWhere($tblUser.'.first_name', 'LIKE', $searchTerm . '%')
                        ->orWhere($tblUser.'.last_name', 'LIKE', $searchTerm . '%')
                        ->orWhere($tblUser.'.phone_number', 'LIKE', $searchTerm . '%');
                }
            });
        }
        $source->orderBy($tblUser.'.first_name', 'ASC')
            ->groupBy($tblUser.'.id');
        $rawSql = DB::raw('CONCAT(IFNULL('.$tblUser.'.first_name, \'\'), " ", IFNULL('.$tblUser.'.last_name, \'\')) AS full_name ');

        $result = $source->paginate($limit, ['users.id','users.first_name','users.last_name','users.email',$rawSql]);

        return response()->json($result);
    }

}
