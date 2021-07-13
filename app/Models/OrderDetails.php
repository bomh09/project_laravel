<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;
    public $timestamp = false;
    protected $fillable = [
        'order_code',
        'product_id',
        'product_name',
        'product_price',
        'product_sales_qty',
        'coupon_code',
        'fee_shipping'
    ];
    protected $primaryKey = 'order_details_id';
    protected $table = 'tbl_order_details';

    // public function order(){
    //     return $this->belongsTo('App\Models\Order', 'order_id');
    // }

    public function products(){
        return $this->belongsTo('App\Models\Product', 'product_id', 'product_id');
    }
}
