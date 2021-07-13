<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Order;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
Session_start();

class AdminController extends Controller
{
    public function AuthLogin(){
        $admin_id = session::get('admin_id');
        if($admin_id){
            return redirect::to('dashboard');
        }else{
            return redirect::to('admin')->send();
        }
    }

    public function index(){
        return view('admin_login');
    }

    public function show_dashboard(){
        $this->AuthLogin();
        $all_product = Product::get();
        $all_customer = Customer::get();
        $all_order = Order::get();
        return view('admin.dashboard')->with(compact('all_product', 'all_customer', 'all_order'));
    }

    public function dashboard(Request $request){
        $data = $request->validate([
            'admin_email' => 'required',
            'admin_password' => 'required'
        ]);
        $admin_email= $request->admin_email;
        $admin_password= md5($request->admin_password);

        $result = DB::table('tbl_admin')->where(['admin_email' => $admin_email,'admin_password' => $admin_password])->first();

        if($result){
            Session::put('admin_name', $result->admin_name);
            Session::put('admin_id', $result->admin_id);
            return redirect('/dashboard');
        }else{
            Session::flash('message', 'Email hoặc password không đúng. Vui lòng nhập lại!');
            return  redirect('/admin');
        }
    }

    public function logout(){
        $this->AuthLogin();
        session::put('admin_name',null);
        session::put('admin_id',null);
        return redirect('/admin');
    }
}
