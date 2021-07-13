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

class ProductController extends Controller
{
    public function AuthLogin(){
        $admin_id = session::get('admin_id');
        if($admin_id){
            return redirect::to('dashboard');
        }else{
            return redirect::to('admin')->send();
        }
    }

    public function add_product(){
        $this->AuthLogin();

        $cat = Category::with('products')->get();
        $brand = Brand::with('products')->get();
        // $add_product =  Product::with('brand', 'category')->get();

        return view('admin.product.add_product')->with(compact('cat', 'brand'));
    }

    public function save_product(Request $request){
        $this->AuthLogin();
        $data = $request->all();
        $data = $request->validate([
            'product_name' => 'required',
            'product_price' => 'required',
            'product_image' => 'required',
            'product_desc' => 'required',
            'cat_id' => '',
            'brand_id' => '',
            'product_status' => ''
        ]);
        $product = new Product();
        $product->product_name = $data['product_name'];
        $product->cat_id = $data['cat_id'];
        $product->brand_id = $data['brand_id'];
        $product->product_price = $data['product_price'];
        // $product->product_quantity = $data['product_quantity'];
        $product->product_desc = $data['product_desc'];
        $product->product_status = $data['product_status'];
        $str = strtolower($product->product_name);
        $product->product_slug = preg_replace('/\s+/', '-', $str. '-' . $product->product_id);

        $get_image = $request->file('product_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0,99).'.'.$get_image->getClientOriginalExtension();

            $get_image -> move('public/uploads/product/',$new_image);
            $product->product_image = $data['product_image'] = $new_image;
            $product->save();
            // session::put('message', ' Thêm sản phẩm thành công!');
            return Redirect::to('add-product')->with('message', ' Thêm sản phẩm thành công!');
        }

        $product->product_image = $data['product_image']='';
        $product->save();
        // session::put('message', ' Thêm sản phẩm thành công!');
        return Redirect::to('add-product')->with('message', ' Thêm sản phẩm thành công!');

    }

    // liệt kê sản phẩm
    public function all_product(){
        $this->AuthLogin();

        $all_product = Product::with('brand','category')->orderby('product_id', 'desc')->get();

        $manager_product = view('admin.product.all_product')->with('all_product', $all_product);
        return view('admin_layout')->with('all_product', $manager_product);
    }

    //ẩn hiện sản phẩm
    public function show_product($product_id){
        $this->AuthLogin();

        Product::find($product_id)->update(['product_status'=>1]);
        // session::put('message', 'Hiển thị sản phẩm thành công!');
        return redirect::to('all-product')->with('message', 'Hiển thị sản phẩm thành công!');
    }

    public function hidden_product($product_id){
        $this->AuthLogin();
        Product::find($product_id)->update(['product_status'=>0]);
        // session::put('message', 'Ẩn sản phẩm thành công!');
        return redirect::to('all-product')->with('message', 'Ẩn sản phẩm thành công!');
    }

    // cập nhật
    public function edit_product($product_id){
        $this->AuthLogin();

        // $cat = DB::table('tbl_cat')->get();
        // $brand = DB::table('tbl_brand')->get();
        // $edit_product = DB::table('tbl_product')->where('product_id', $product_id)->get();

        $edit_product = Product::with('brand','category')->find($product_id);
        $cat = Category::with('products')->get();
        $brand = Brand::with('products')->get();

        $manager_product = view('admin.product.edit_product')->with(compact('edit_product', 'cat', 'brand'));
        return view('admin_layout')->with('admin.product.edit_product', $manager_product);
    }

    public function update_product(Request $request, $product_id){
        $this->AuthLogin();

        $data = $request->all();
        $product = Product::find($product_id);
        $product->product_name = $data['product_name'];
        $product->cat_id = $data['cat_id'];
        $product->brand_id = $data['brand_id'];
        $product->product_price = $data['product_price'];
        // $product->product_quantity = $data['product_quantity'];
        $product->product_desc = $data['product_desc'];
        $str = strtolower($product->product_name);
        $product->product_slug = preg_replace('/\s+/', '-', $str. '-' . $product->product_id);

        $get_image = $request->file('product_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0,99).'.'.$get_image->getClientOriginalExtension();

            $get_image -> move('public/uploads/product/',$new_image);
            $product->product_image = $data['product_image'] = $new_image;
            $product->save();
            // session::put('message', 'Cập nhật sản phẩm thành công!');
            return Redirect::to('all-product')->with('message', 'Cập nhật sản phẩm thành công!');
        }

        $product->save();
        // session::put('message', 'Cập nhật sản phẩm thành công!');
        return Redirect::to('all-product')->with('message', 'Cập nhật sản phẩm thành công!');
    }

    public function del_product($product_id){
        $this->AuthLogin();
        // DB::table('tbl_product')->where('product_id', $product_id)->delete();
        Product::find($product_id)->delete();
        // session::put('message', 'Xóa sản phẩm thành công!');
        return redirect::to('all-product')->with('message', 'Xóa sản phẩm thành công!');
    }

    //product details
    public function product_details($product_slug){
        $cat = Category::where('cat_status', '1')->get();
        $brand = Brand::where('brand_status', '1')->get();

        $details_product = DB::table('tbl_product')->join('tbl_cat', 'tbl_cat.cat_id', '=', 'tbl_product.cat_id')
        ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
        ->where('tbl_product.product_slug', $product_slug)->where('product_status', '1')->get();

        foreach($details_product as $key=>$value){
            $cat_id = $value->cat_id;
        }

        $related_product = Product::inRandomOrder()
        ->where('cat_id', $cat_id)->whereNotIn('product_slug', [$product_slug])->get();

        return view('pages.product.product_details')
        ->with(compact('cat', 'brand', 'details_product', 'related_product'));
    }

}
