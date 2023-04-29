<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Role;

class RolesController extends Controller
{
    public function index(){
        $roles = Role::all();
        return view('admin.roles.index',[
            'roles' => $roles
        ]);
    }
}
