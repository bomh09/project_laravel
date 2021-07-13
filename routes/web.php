<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Back-End
Route::get('/admin', 'AdminController@index');
Route::get('/dashboard', 'AdminController@show_dashboard');
Route::post('/admin-dashboard', 'AdminController@dashboard');
Route::get('/logout', 'AdminController@logout');

// Front-End
Route::get('/', 'HomeController@index');
Route::get('/trang-chu', 'HomeController@index');
Route::post('/search', 'HomeController@search');

Route::get('cat/{cat_slug}', 'CategoryProduct@show_product_by_cat');
Route::get('/brand/{brand_slug}', 'BrandProduct@show_product_by_brand');
Route::get('/product-details/{product_slug}', 'ProductController@product_details');

// Category Product
Route::get('/add-cat', 'CategoryProduct@add_cat');
Route::get('/all-cat', 'CategoryProduct@all_cat');
Route::get('/edit-cat/{cat_id}', 'CategoryProduct@edit_cat');
Route::get('/del-cat/{cat_id}', 'CategoryProduct@del_cat');


Route::get('/hidden-cat/{cat_id}', 'CategoryProduct@hidden_cat');
Route::get('/show-cat/{cat_id}', 'CategoryProduct@show_cat');

Route::post('/save-cat', 'CategoryProduct@save_cat');
Route::post('/update-cat/{cat_id}', 'CategoryProduct@update_cat');

// Brand Product
Route::get('/add-brand', 'BrandProduct@add_brand');
Route::get('/all-brand', 'BrandProduct@all_brand');
Route::get('/edit-brand/{brand_id}', 'BrandProduct@edit_brand');
Route::get('/del-brand/{brand_id}', 'BrandProduct@del_brand');

Route::get('/show-brand/{brand_id}', 'BrandProduct@show_brand');
Route::get('/hidden-brand/{brand_id}', 'BrandProduct@hidden_brand');


Route::post('/save-brand', 'BrandProduct@save_brand');
Route::post('/update-brand/{brand_id}', 'BrandProduct@update_brand');

//Product
Route::get('/add-product', 'ProductController@add_product');
Route::get('/all-product', 'ProductController@all_product');
Route::get('/edit-product/{product_id}', 'ProductController@edit_product');
Route::get('/del-product/{product_id}', 'ProductController@del_product');

Route::get('/show-product/{product_slug}', 'ProductController@show_product');
Route::get('/hidden-product/{product_id}', 'ProductController@hidden_product');


Route::post('/save-product', 'ProductController@save_product');
Route::post('/update-product/{product_id}', 'ProductController@update_product');

//cart
Route::get('/show-cart', 'CartController@show_cart');
Route::post('/add-cart-ajax', 'CartController@add_cart_ajax');
Route::post('/update-cart', 'CartController@update_cart');
Route::get('/delete-cart/{session_id}', 'CartController@delete_cart');
Route::get('/delete-all-cart', 'CartController@delete_all_cart');

// Route::post('/save-cart', 'CartController@save_cart');
// Route::get('/del-cart/{rowId}', 'CartController@del_cart');
// Route::get('/cart-quantity-up/{rowId}', 'CartController@cart_quantity_up');
// Route::get('/cart-quantity-down/{rowId}', 'CartController@cart_quantity_down');

// Coupon
Route::get('/add-coupon', 'CouponController@add_coupon');
Route::get('/manage-coupon', 'CouponController@manage_coupon');
Route::get('/del-coupon/{coupon_id}', 'CouponController@del_coupon');
Route::post('/save-coupon', 'CouponController@save_coupon');

Route::post('/check-coupon', 'CartController@check_coupon');
Route::get('/unset-coupon', 'CouponController@unset_coupon');


//checkout
Route::get('/login-checkout', 'CheckoutController@login_checkout');
Route::get('/logout-checkout', 'CheckoutController@logout_checkout');
Route::get('/customer-info', 'HomeController@customer_info');
Route::post('/edit-customer/{customer_id}', 'HomeController@edit_customer');

Route::post('/add-customer', 'CheckoutController@add_customer');
Route::post('/login-customer', 'CheckoutController@login_customer');
Route::post('/save-checkout-customer', 'CheckoutController@save_checkout_customer');
Route::post('/login-customer', 'CheckoutController@login_customer');
Route::get('/register-customer', 'CheckoutController@register_customer');
Route::get('/show-checkout', 'CheckoutController@show_checkout');

Route::get('/payment', 'CheckoutController@payment');
Route::post('/confirm-order', 'CheckoutController@confirm_order');

Route::post('/select-delivery-home', 'CheckoutController@select_delivery_home');
Route::post('/calculate-fee-shipping', 'CheckoutController@calculate_fee_shipping');
Route::get('/delete-fee-shipping', 'CheckoutController@delete_fee_shipping');

//order
Route::get('/manage-order', 'OrderController@manage_order');
Route::get('/view-order/{order_code}', 'OrderController@view_order');
Route::get('/del-order/{order_id}', 'OrderController@del_order');


// fee shipping
Route::get('/delivery', 'DeliveryController@delivery');
Route::post('/select-delivery', 'DeliveryController@select_delivery');
Route::post('/insert-delivery', 'DeliveryController@insert_delivery');
Route::post('/fetch-fee-shipping', 'DeliveryController@fetch_fee_shipping');
Route::post('/update-fee-shipping', 'DeliveryController@update_fee_shipping');


