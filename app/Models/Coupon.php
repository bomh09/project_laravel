<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    public $timestamp = false;
    protected $fillable = ['coupon_name', 'coupon_code', 'coupon_condition', 'coupon_number', 'coupon_qty'];
    protected $primaryKey = 'coupon_id';
    protected $table = 'tbl_coupon';
}
