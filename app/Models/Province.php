<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    public $timestamp = false;
    protected $fillable = ['province_name', 'province_type'];
    protected $primaryKey = 'province_id';
    protected $table = 'tbl_province';

    // public function districts(){
    //     return $this->hasMany('App\Models\District', 'province_id');
    // }
}
