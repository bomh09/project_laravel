<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Models\FeeShipping;
use App\Models\Shipping;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Customer;
use App\Models\Coupon;

Session_start();

class OrderController extends Controller
{
    public function AuthLogin(){
        $admin_id = session::get('admin_id');
        if($admin_id){
            return redirect::to('dashboard');
        }else{
            return redirect::to('admin')->send();
        }
    }

    //manage order
    public function manage_order(){
        $this->AuthLogin();
        $order = Order::orderby('created_at', 'DESC')->get();
        return view('admin.order.manage_order')->with(compact('order'));
    }

    public function view_order($order_code){
        $this->AuthLogin();
        $order_details = OrderDetails::where('order_code', $order_code)->get();
        $order = Order::where('order_code', $order_code)->get();

        foreach ($order as $key => $ord){
            $customer_id = $ord->customer_id;
            $shipping_id = $ord->shipping_id;
        }

        $customer = Customer::where('customer_id', $customer_id)->first();
        $shipping = Shipping::where('shipping_id', $shipping_id)->first();
        $order_details_pro = OrderDetails::with('products')->where('order_code', $order_code)->get();

        foreach($order_details as $key => $order_d){
            $coupon_code = $order_d->coupon_code;
            $fee_shipping = $order_d->fee_shipping;
        }
        if($coupon_code != 0){
            $coupon = Coupon::where('coupon_code', $coupon_code)->first();
            $coupon_condition = $coupon->coupon_condition;
            $coupon_number = $coupon->coupon_number;
        }else{
            $coupon_condition = 2;
            $coupon_number = 0;
        }
        // if($fee_shipping){
        //     $count_fee_shipping = $fee_shipping->count();
        //     if($count_fee_shipping > 0){
        //         $fee = FeeShipping::where('fee_shipping', $fee_shipping)->first();
        //         $fee_ship = $fee->fee_shipping;
        //     }else{
        //         $fee_ship = 50000;
        //     }
        // }

        return view('admin.order.view_order')
        ->with(compact('order_details', 'shipping', 'customer', 'order_details_pro', 'coupon_condition', 'coupon_number'));
    }

    public function del_order($order_id){
        $this->AuthLogin();
        $order = Order::find($order_id)->delete();
        return redirect::to('manage-order')->with('message', 'Xóa đơn hàng thành công!');
    }
}
