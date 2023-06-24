<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Role;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function getCustomers(){
        $customers = User::where('status',1)->with('role')->get()->all();
        return view('admin.customers.index',[
            'customers' => $customers
        ]);
    }

    public function deleteCustomer(User $user){
        if($user){
            $user->delete();
            return redirect()->back()->with('customerMsg','Customer deleted successfully.');
        }
    }

    public function add(){
        $roles = Role::where('status', 1)->get()->all();
        return view('admin.customers.create',[
            'roles' => $roles
        ]);
    }

    public function updateCustomerForm(Request $request){

        $customer = User::updateOrCreate(
            ['id' => $request->get('id')],
            [
                'first_name' => $request->get('first_name'),
                'last_name' => $request->get('last_name'),
                'phone_number' => $request->get('phone_number'),
                'email' => $request->get('email'),
                'role_id' => $request->get('role'),
                'status' => $request->get('status'),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
            ],
        );

        return redirect(route('customers'))->with('customerMsg',"Details added successfully");

    }

    public function edit(User $user){
        $roles = Role::where('status', 1)->get()->all();
        return view('admin.customers.edit',[
            'model' => $user,
            'roles' => $roles
        ]);
    }
}
