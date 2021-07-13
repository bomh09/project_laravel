<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;
    public $timestamp = false;
    protected $fillable = ['ward_name', 'ward_type', 'district_id'];
    protected $primaryKey = 'ward_id';
    protected $table = 'tbl_ward';
}
