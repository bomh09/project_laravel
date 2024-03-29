<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;
    public $timestamp = false;
    protected $fillable = ['shipping_name', 'shipping_email', 'shipping_address', 'shipping_phone', 'shipping_note', 'payment_method'];
    protected $primaryKey = 'shipping_id';
    protected $table = 'tbl_shipping';

    // public function orders(){
    //     return $this->hasMany('App\Models\Order', 'shipping_id');
    // }
}
