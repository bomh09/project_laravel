<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    public $timestamp = false;
    protected $fillable = ['district_name', 'district_type', 'province_id'];
    protected $primaryKey = 'district_id';
    protected $table = 'tbl_district';

    // public function provinces(){
    //     return $this->belongsTo('App\Models\Province', 'district_id', 'district_id');
    // }
}
