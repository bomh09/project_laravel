<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeShipping extends Model
{
    use HasFactory;
    public $timestamp = false;
    protected $fillable = ['province_id', 'district_id', 'ward_id', 'fee_shipping'];
    protected $primaryKey = 'feeshipping_id';
    protected $table = 'tbl_feeshipping';

    public function provinces(){
        return $this->belongsTo('App\Models\Province', 'province_id');
    }

    public function districts(){
        return $this->belongsTo('App\Models\District', 'district_id');
    }

    public function wards(){
        return $this->belongsTo('App\Models\Ward', 'ward_id');
    }
}
