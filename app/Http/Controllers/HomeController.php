<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Customer;
session_start();

class HomeController extends Controller
{
    public function index(){
        $brand = Brand::withCount('products')->where('brand_status', '1')->get();
        $cat = Category::withCount('products')->where('cat_status', '1')->get();
        $product = Product::inRandomOrder()->where('product_status', '1')->paginate(12);

        $max_price = Product::max('product_price');
        $min_price = Product::min('product_price');

        return view('pages.home')->with(compact('cat', 'brand', 'product', 'max_price', 'min_price'));
    }

    public function search(Request $request){
        $keywords = $request->keywords_search;
        $cat = DB::table('tbl_cat')->where('cat_status', '1')->get();
        $brand = DB::table('tbl_brand')->where('brand_status', '1')->get();
        // $product = DB::table('tbl_product')->where('product_status', '1')->get();
        // $search_product = DB::table('tbl_product')
        // ->join('tbl_cat', 'tbl_cat.cat_id', '=', 'tbl_product.cat_id')
        // ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
        // ->where('cat_name', 'like', '%' . $keywords . '%')
        // ->orWhere('brand_name', 'like', '%' . $keywords . '%')
        // ->orWhere('product_name', 'like', '%' . $keywords . '%')->get();

        $search_product = Product::where('product_status', '1')
        ->where('product_name', 'like', '%' . $keywords . '%')->get();

        return view('pages.product.search')->with(compact('cat', 'brand', 'search_product'));
    }

    public function customer_info(){
        return view('pages.checkout.customer_info');
    }

    public function edit_customer(Request $request, $customer_id){
        $data = $request->all();
        $data = $request->validate([
            'customer_name' => 'required|max:255',
            'customer_email' => 'required|max:255',
            'customer_password' => 'required|min:8|max:255',
            'customer_phone' => 'required|min:10|numeric'
        ]);
        $customer = Customer::find($customer_id);
        $customer->customer_name = $data['customer_name'];
        $customer->customer_email = $data['customer_email'];
        $customer->customer_password = md5($data['customer_password']);
        $customer->customer_phone = $data['customer_phone'];
        $customer->save();

        Session::put('customer_email', $customer->customer_email);
        Session::put('customer_id', $customer->customer_id);
        Session::put('customer_name', $customer->customer_name);
        Session::put('customer_password', $customer->customer_password);
        Session::put('customer_phone', $customer->customer_phone);

        return Redirect::to('customer-info')->with('message', 'Cập nhật thông tin thành công!');
    }
}
