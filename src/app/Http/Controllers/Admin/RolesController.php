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

    public function deleteRole(Role $role){
        try{
            if($role){
                $role->delete();
                return redirect()->back()->with('roleSuccessMsg',"Role deleted successfully.");
            }
        }catch(\Exception $e){
            return redirect()->back()->with('roleErrorMsg',"Role not found.");
        }
    }

    public function edit(Request $request){

    }
}
