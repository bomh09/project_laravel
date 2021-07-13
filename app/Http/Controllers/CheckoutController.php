<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Customer;
use App\Models\Shipping;
use App\Models\Province;
use App\Models\District;
use App\Models\Ward;
use App\Models\FeeShipping;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Cart;
session_start();

class CheckoutController extends Controller
{
    public function login_checkout(){
        // $cat = Category::with('products')->get();
        // $brand = Brand::with('products')->get();
        return view('pages.checkout.login_checkout');
    }

     public function logout_checkout(){
        Session::forget('customer_id');
        Session::forget('customer_email');
        Session::forget('customer_name');
        Session::forget('customer_password');
        Session::forget('customer_phone');
        return redirect::to('/login-checkout');
    }

    public function register_customer(){
        return view('pages.checkout.register_customer');
    }

    public function add_customer(Request $request){
        $data = $request->all();
        $data = $request->validate([
            'customer_name' => 'required|min:10|max:255',
            'customer_email' => 'required|email|unique:tbl_customer,customer_email',
            'customer_password' => 'required|min:8',
            'customer_phone' => 'required|min:10|numeric'
        ]);
        $customer = new Customer();
        $customer->customer_name = $data['customer_name'];
        $customer->customer_email = $data['customer_email'];
        $customer->customer_password = md5($data['customer_password']);
        $customer->customer_phone = $data['customer_phone'];
        $customer->save();
        $customer->customer_id;
        $customer_id = Customer::find($customer->customer_id);
        Session::put('customer_id', $customer_id->customer_id);
        Session::put('customer_name', $customer->customer_name);
        return redirect::to('/show-checkout');
    }

    public function show_checkout(){
        $cat = Category::with('products')->get();
        $brand = Brand::with('products')->get();
        $province = Province::orderby('province_id', 'ASC')->get();
        $district = District::orderby('district_id', 'ASC')->get();
        $ward = Ward::orderby('ward_id', 'ASC')->get();
        $feeshipping = FeeShipping::orderby('feeshipping_id', 'ASC')->get();
        return view('pages.checkout.show_checkout')->with(compact('cat', 'brand', 'province', 'district', 'ward', 'feeshipping'));
    }

    public function login_customer(Request $request){
        $data = $request->validate([
            'customer_email' => 'required',
            'customer_password' => 'required|min:8'
        ]);

        // $customer_name = $request->customer_name;
        $customer_email = $request->customer_email;
        $customer_password = md5($request->customer_password);

        $result = Customer::where(['customer_email' => $customer_email, 'customer_password' => $customer_password])->first();

        if($result){
            Session::put('customer_email', $result->customer_email);
            Session::put('customer_id', $result->customer_id);
            Session::put('customer_name', $result->customer_name);
            Session::put('customer_password', $result->customer_password);
            Session::put('customer_phone', $result->customer_phone);
            echo $result;
            return redirect('/show-checkout');
        }else{
            // Session::put('error', 'Email hoặc mật khẩu không đúng!');
            return redirect('/login-checkout')->with('error', 'Email hoặc mật khẩu không đúng!');
        }
    }

    public function confirm_order(Request $request){

        $data = $request->all();
        // $data = $request->validate([
        //     'shipping_name' => 'required',
        //     'shipping_email' => 'required',
        //     'shipping_address' => 'required',
        //     'shipping_phone' => 'required',
        //     'shipping_note' => '',
        // ]);
        $shipping = new Shipping();
        $shipping->shipping_name = $data['shipping_name'];
        $shipping->shipping_email = $data['shipping_email'];
        $shipping->shipping_address = $data['shipping_address'];
        $shipping->shipping_phone = $data['shipping_phone'];
        $shipping->shipping_note = $data['shipping_note'];
        $shipping->payment_method = $data['payment_method'];
        $shipping->save();
        $shipping_id = $shipping->shipping_id;

        $order = new Order();
        $order_code = substr(md5(microtime()), rand(0, 26), 5);
        $order->customer_id = Session::get('customer_id');
        $order->shipping_id = $shipping_id;
        $order->order_code = $order_code;
        $order->order_status = 1;
        $order->order_total = Session::get('total');
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $order->created_at = now();
        $order->save();


        if(Session::has('cart')){
            foreach(Session::get('cart') as $key => $cart){
                $order_details = new OrderDetails();
                $order_details->order_code = $order_code;
                $order_details->product_id = $cart['product_id'];
                $order_details->product_name = $cart['product_name'];
                $order_details->product_price = $cart['product_price'];
                $order_details->product_sales_qty = $cart['product_qty'];
                $order_details->coupon_code = $data['order_coupon'];
                $order_details->fee_shipping = $data['order_fee_shipping'];
                $order_details->save();
            }
        }

        Session::forget('cart');
        Session::forget('coupon');
        Session::forget('fee');
    }

    public function payment(){
        $cat = DB::table('tbl_cat')->where('cat_status', '1')->get();
        $brand = DB::table('tbl_brand')->where('brand_status', '1')->get();
        return view('pages.checkout.payment')->with(compact('cat', 'brand'));
    }


    // select delivery checkout
    public function select_delivery_home(Request $request){
        $data = $request->all();
        if($data['action']){
            $output = '';
            if($data['action'] == 'province'){
                $select_district = District::where('province_id', $data['province_id'])->orderby('district_id', 'ASC')->get();
                $output .= '<option value="0">---- Chọn quận huyện -----</option>';
                foreach($select_district as $district){
                    $output .= '<option value="'. $district->district_id .'">'. $district->district_name .'</option>';
                }
            }else{
                $select_ward = Ward::where('district_id', $data['province_id'])->orderby('ward_id', 'ASC')->get();
                $output .= '<option value="0">---- Chọn xã phường -----</option>';
                foreach($select_ward as $ward){
                    $output .= '<option value="'. $ward->ward_id .'">'. $ward->ward_name .'</option>';
                }
            }
        }
        echo $output;
    }

    // calculate fee shipping
    public function calculate_fee_shipping(Request $request){
        $data = $request->all();
        if($data['province_id'] == true && $data['district_id'] == true && $data['ward_id'] == true){
            $fee_shipping = FeeShipping::where('province_id', $data['province_id'])->where('district_id', $data['district_id'])
            ->where('ward_id', $data['ward_id'])->get();
            if($fee_shipping){
                $count_fee_shipping = $fee_shipping->count();
                if($count_fee_shipping > 0){
                    foreach ($fee_shipping as $key => $fee){
                        Session::put('fee', $fee->fee_shipping);
                        Session::save();
                    }
                }else{
                    Session::put('fee', 50000);
                    Session::save();
                }
            }
        }
    }

    // delete fee shipping
    public function delete_fee_shipping(){
        Session::forget('fee');
        return redirect::back();
    }
}
