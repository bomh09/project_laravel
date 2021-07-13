<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public $timestamp = false;
    protected $fillable = ['cat_name', 'cat_desc', 'cat_status'];
    protected $primaryKey = 'cat_id';
    protected $table = 'tbl_cat';

    public function products(){
        return $this->hasMany('App\Models\Product', 'cat_id');
    }
}
