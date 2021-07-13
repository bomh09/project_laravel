<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Cart;
use App\Models\Coupon;
session_start();

class CartController extends Controller
{

    // add cart ajax
    public function add_cart_ajax(Request $request){
        $data = $request->all();
        $session_id = substr(md5(microtime()), rand(0, 26), 5);
        $cart = Session::get('cart');

        if($cart == true) {
            $is_available = 0;
            foreach($cart as $key => $val){
                if($val['product_id'] == $data['cart_product_id']){
                    $is_available++;
                }
            }
            if($is_available == 0){
                $cart[] = array (
                    'session_id' => $session_id,
                    'product_id' => $data['cart_product_id'],
                    'product_name' => $data['cart_product_name'],
                    'product_image' => $data['cart_product_image'],
                    'product_price' => $data['cart_product_price'],
                    'product_qty' => $data['cart_product_qty']
                );
                Session::put('cart', $cart);
            }
        }else{
            $cart[] = array (
                'session_id' => $session_id,
                'product_id' => $data['cart_product_id'],
                'product_name' => $data['cart_product_name'],
                'product_image' => $data['cart_product_image'],
                'product_price' => $data['cart_product_price'],
                'product_qty' => $data['cart_product_qty']
            );
            Session::put('cart', $cart);
        }
        Session::save();
    }

    // update cart
    public function update_cart(Request $request){
        $data = $request->all();
        $cart = Session::get('cart');
        if($cart == true){
            foreach($data['cart_qty'] as $key => $qty){
                foreach($cart as $session => $val){
                    if($val['session_id'] == $key){
                        $cart[$session]['product_qty'] = $qty;
                    }
                }
            }
            Session::put('cart', $cart);
            return redirect::back();
        }
    }

    // delete cart product
    public function delete_cart($session_id){
        $cart = Session::get('cart');
        if($cart == true){
            foreach($cart as $key => $val){
                if($val['session_id'] == $session_id){
                    unset($cart[$key]);
                }
            }
            Session::put('cart', $cart);
            return redirect::back();
        }
    }

    // delete all cart
    public function delete_all_cart(){
        $cart = Session::get('cart');
        if($cart == true){
            Session::forget('cart');
            Session::forget('coupon');
            Session::forget('fee');
            return redirect::back();
        }
    }

    // show cart
    public function show_cart(){
        $cat = DB::table('tbl_cat')->where('cat_status', '1')->get();
        $brand = DB::table('tbl_brand')->where('brand_status', '1')->get();
        return view('pages.cart.show_cart')->with(compact('cat', 'brand'));
    }

    // check coupon
    public function check_coupon(Request $request){
        $data = $request->all();
        $coupon = Coupon::where('coupon_code', $data['coupon'])->first();
        if($coupon){
            $count_coupon = $coupon->count();
            if($count_coupon > 0){
                $coupon_session = Session::get('coupon');
                if($coupon_session == true){
                    $is_available = 0;
                    if($is_available == 0){
                        $cou[] = array(
                            'coupon_code' => $coupon->coupon_code,
                            'coupon_condition' => $coupon->coupon_condition,
                            'coupon_number' => $coupon->coupon_number
                        );
                        Session::put('coupon', $cou);
                    }
                }else{
                    $cou[] = array(
                        'coupon_code' => $coupon->coupon_code,
                        'coupon_condition' => $coupon->coupon_condition,
                        'coupon_number' => $coupon->coupon_number
                    );
                    Session::put('coupon', $cou);
                }
                Session::save();
                return redirect::back();
            }
        }else{
            return redirect::back()->with('error', 'Mã giảm giá không đúng');
        }
    }


    // public function save_cart(Request $request){
    //     $productId = $request->product_id_hidden;
    //     $quantity = $request->qty;

    //     $product_info = DB::table('tbl_product')->where('product_id', $productId)->first();

    //     $data['id'] = $request->product_id_hidden;
    //     if( $quantity == null){
    //         $data['qty'] = 1;
    //     }else{
    //         $data['qty'] = $quantity;
    //     }
    //     $data['name'] = $product_info->product_name;
    //     $data['price'] = $product_info->product_price;
    //     $data['weight'] = '1';
    //     $data['options']['image'] = $product_info->product_image;
    //     Cart::add($data);
    //     return Redirect::to('show-cart');
    // }

    // public function del_cart($rowId){
    //     Cart::update($rowId, 0);
    //     return redirect::to('show-cart');
    // }

    // public function cart_quantity_up($rowId){
    //     $content = Cart::content();
    //     foreach($content as $key=>$row){
    //         Cart::update($rowId, $row->qty += 1);
    //     }
    //     return redirect::to('show-cart');
    // }

    // public function cart_quantity_down($rowId){
    //     $content = Cart::content();
    //     foreach($content as $key=>$row){
    //         Cart::update($rowId, $row->qty -= 1);
    //     }
    //     return redirect::to('show-cart');
    // }
}
