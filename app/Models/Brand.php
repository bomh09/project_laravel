<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    public $timestamp = false;
    protected $fillable = ['brand_name', 'brand_desc', 'brand_status'];
    protected $primaryKey = 'brand_id';
    protected $table = 'tbl_brand';

    public function products(){
        return $this->hasMany('App\Models\Product', 'brand_id');
    }
}
