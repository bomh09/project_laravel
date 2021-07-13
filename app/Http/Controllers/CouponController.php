<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;
use App\Http\Requests;

session_start();

class CouponController extends Controller
{
    // check login admin
     public function AuthLogin(){
        $admin_id = session::get('admin_id');
        if($admin_id){
            return redirect::to('dashboard');
        }else{
            return redirect::to('admin')->send();
        }
    }

    // add coupon
    public function add_coupon(){
        $this->AuthLogin();
        return view('admin.coupon.add_coupon');
    }

    public function save_coupon(Request $request){
        $this->AuthLogin();
        $data = $request->all();
        $data = $request->validate([
            'coupon_name' => 'required|min:10|max:255',
            'coupon_code' => 'required|min:8|max:16|unique:tbl_coupon,coupon_code',
            'coupon_qty' => 'required|min:1|numeric',
            'coupon_condition' => 'required',
            'coupon_number' => 'required|numeric'
        ]);
        $coupon = new Coupon();
        $coupon->coupon_name = $data['coupon_name'];
        $coupon->coupon_code = $data['coupon_code'];
        $coupon->coupon_qty = $data['coupon_qty'];
        $coupon->coupon_condition = $data['coupon_condition'];
        $coupon->coupon_number = $data['coupon_number'];
        $coupon->save();

        Session::put('message', 'Thêm mã giảm giá thành công');
        return redirect::to('add-coupon');
        Session::forget('message');

    }

    public function manage_coupon(){
        $this->AuthLogin();
        $all_coupon = Coupon::orderBy('coupon_id', 'DESC')->get();
        $manage_coupon = view('admin.coupon.manage_coupon')->with(compact('all_coupon'));
        return view('admin_layout')->with(compact('manage_coupon'));
    }

    public function del_coupon($coupon_id){
        $this->AuthLogin();
        Coupon::find($coupon_id)->delete();
        Session::put('message', 'Xóa mã giảm giá thành công');
        return redirect::to('manage-coupon');

    }

    public function unset_coupon(){
        $coupon = Session::get('coupon');
        if($coupon == true){
            Session::forget('coupon');
            return redirect::back();
        }
    }
}
