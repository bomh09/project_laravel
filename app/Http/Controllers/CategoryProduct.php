<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Brand;
use App\Models\Category;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class CategoryProduct extends Controller
{
    public function AuthLogin(){
        $admin_id = session::get('admin_id');
        if($admin_id){
            return redirect::to('dashboard');
        }else{
            return redirect::to('admin')->send();
        }
    }

    public function add_cat(){
        $this->AuthLogin();
        return view('admin.category.add_cat');
    }

    public function save_cat(Request $request){
        $this->AuthLogin();
        $data = $request->all();
        $data = $request->validate([
            'cat_name' => 'required',
            'cat_status' => '',
            'cat_desc' => ''
        ]);
        $cate = new Category();
        $cate->cat_name = $data['cat_name'];
        $cate->cat_desc = $data['cat_desc'];
        $cate->cat_status = $data['cat_status'];
        $str = strtolower($cate->cat_name);
        $cate->cat_slug = preg_replace('/\s+/', '-', $str);
        $cate->save();

        // session::put('message', 'Thêm danh mục sản phẩm thành công!');
        return redirect::to('add-cat')->with('message', 'Thêm danh mục sản phẩm thành công!');
    }

    public function all_cat(){
        $this->AuthLogin();

        $all_cat = Category::orderBy('cat_id', 'DESC')->get();

        $manager_cat = view('admin.category.all_cat')->with('all_cat', $all_cat);
        return view('admin_layout')->with('admin.category.all_cat', $manager_cat);
    }

    public function hidden_cat($cat_id){
        $this->AuthLogin();
        Category::find($cat_id)->update(['cat_status'=>0]);

        // session::put('message', 'Ẩn danh mục sản phẩm thành công!');
        return redirect::to('all-cat')->with('message', 'Ẩn danh mục sản phẩm thành công!');
    }

    public function show_cat($cat_id){
        $this->AuthLogin();
        Category::find($cat_id)->update(['cat_status'=>1]);

        session::put('message', 'Hiển thị danh mục sản phẩm thành công!');
        return redirect::to('all-cat')->with('message', 'Hiển thị danh mục sản phẩm thành công!');
    }

    public function edit_cat($cat_id){
        $this->AuthLogin();
        $edit_cat = Category::find($cat_id);
        $manager_cat = view('admin.category.edit_cat')->with('edit_cat', $edit_cat);

        return view('admin_layout')->with('admin.category.edit_cat', $manager_cat);
    }

    public function update_cat(Request $request, $cat_id){
        $this->AuthLogin();

        $data = $request->all();
        $cate = Category::find($cat_id);
        $cate->cat_name = $data['cat_name'];
        $cate->cat_desc = $data['cat_desc'];
        // $cate->cat_status = $data['cat_status'];
        $str = strtolower($cate->cat_name);
        $cate->cat_slug = preg_replace('/\s+/', '-', $str);
        $cate->save();

        // session::put('message', 'Cập nhật mục sản phẩm thành công!');
        return redirect::to('all-cat')->with('message', 'Cập nhật mục sản phẩm thành công!');
    }

    public function del_cat($cat_id){
        $this->AuthLogin();
        Category::find($cat_id)->delete();

        // session::put('message', 'Xóa mục sản phẩm thành công!');
        return redirect::to('all-cat')->with('message', 'Xóa mục sản phẩm thành công!');
    }

    //show product by category
    public function show_product_by_cat($cat_slug){
        $cat = DB::table('tbl_cat')->where('cat_status', '1')->get();
        $brand = DB::table('tbl_brand')->where('brand_status', '1')->get();
        $product = DB::table('tbl_product')->where('product_status', '1')->inRandomOrder()->get();
        $cat_name = DB::table('tbl_cat')->where('tbl_cat.cat_slug', $cat_slug)->limit(1)->get();

        $product_by_cat = DB::table('tbl_product')->join('tbl_cat', 'tbl_product.cat_id', '=', 'tbl_cat.cat_id')
        ->where('tbl_cat.cat_slug', $cat_slug)->where('product_status', '1')->get();

        return view('pages.category.product_by_cat')
        ->with(compact('cat', 'product', 'brand', 'product_by_cat', 'cat_name'));

    }
}
