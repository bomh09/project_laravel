<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class BrandProduct extends Controller
{
    public function AuthLogin(){
        $admin_id = session::get('admin_id');
        if($admin_id){
            return redirect::to('dashboard');
        }else{
            return redirect::to('admin')->send();
        }
    }

    public function add_brand(){
        $this->AuthLogin();
        return view('admin.brand.add_brand');
    }

    public function save_brand(Request $request){
        $this->AuthLogin();
        $data = $request->all();
        $data = $request->validate([
            'brand_name' => 'required',
            'brand_desc' => '',
            'brand_status' => ''
        ]);
        $brand = new Brand();
        $brand->brand_name = $data['brand_name'];
        $brand->brand_desc = $data['brand_desc'];
        $brand->brand_status = $data['brand_status'];
        $str = strtolower($brand->brand_name);
        $brand->brand_slug = preg_replace('/\s+/', '-', $str);
        $brand->save();

        return redirect::to('add-brand')->with('message', 'Thêm thương hiệu sản phẩm thành công!');
    }

    public function all_brand(){
        $this->AuthLogin();
        $all_brand = Brand::orderBy('brand_id', 'DESC')->get();
        $manager_brand = view('admin.brand.all_brand')->with('all_brand', $all_brand);
        return view('admin_layout')->with('all_brand', $manager_brand);
    }

    public function show_brand($brand_id){
        $this->AuthLogin();

        Brand::find($brand_id)->update(['brand_status'=>1]);

        // session::put('message', 'Hiển thị thương hiệu sản phẩm thành công!');
        return redirect::to('all-brand')->with('message', 'Hiển thị thương hiệu sản phẩm thành công!');
    }

    public function hidden_brand($brand_id){
        $this->AuthLogin();

        Brand::find($brand_id)->update(['brand_status'=>0]);

        // session::put('message', 'Ẩn thị thương hiệu sản phẩm thành công!');
        return redirect::to('all-brand')->with('message', 'Ẩn thị thương hiệu sản phẩm thành công!');

    }

    public function edit_brand($brand_id){
        $this->AuthLogin();

        $edit_brand = Brand::find($brand_id);

        $manager_brand = view('admin.brand.edit_brand')->with('edit_brand', $edit_brand);
        return view('admin_layout')->with('admin.brand.edit_brand',$manager_brand);
    }

    public function update_brand(Request $request, $brand_id){
        $this->AuthLogin();

        $data = $request->all();
        $brand = Brand::find($brand_id);
        $brand->brand_name = $data['brand_name'];
        $brand->brand_desc = $data['brand_desc'];
        // $brand->brand_status = $data['brand_status'];
        $str = strtolower($brand->brand_name);
        $brand->brand_slug = preg_replace('/\s+/', '-', $str);
        $brand->save();

        // session::put('message', 'Cập nhật thương hiệu sản phẩm thành công!');
        return redirect::to('all-brand')->with('message', 'Cập nhật thương hiệu sản phẩm thành công!');
    }

    public function del_brand($brand_id){
        $this->AuthLogin();
        Brand::find($brand_id)->delete();
        // session::put('message', 'Xóa thương hiệu sản phẩm thành công!');
        return redirect::to('all-brand')->with('message', 'Xóa thương hiệu sản phẩm thành công!');
    }

    //show product by brand
    public function show_product_by_brand($brand_slug){
        $cat = DB::table('tbl_cat')->where('cat_status', '1')->get();
        $brand = DB::table('tbl_brand')->where('brand_status', '1')->get();
        $product = DB::table('tbl_product')->where('product_status', '1')->inRandomOrder()->get();
        $brand_name = DB::table('tbl_brand')->where('tbl_brand.brand_slug', $brand_slug)->limit(1)->get();

        $product_by_brand = DB::table('tbl_product')->join('tbl_brand', 'tbl_product.brand_id', '=', 'tbl_brand.brand_id')
        ->where('tbl_brand.brand_slug', $brand_slug)->where('product_status', '1')->get();

        return view('pages.brand.product_by_brand')
        ->with(compact('cat', 'brand', 'product', 'product_by_brand', 'brand_name'));

    }
}
