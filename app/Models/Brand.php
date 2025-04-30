<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes; // ✅ Correct namespace

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use  HasFactory,SoftDeletes;
    protected $fillable = [
        'brand_name',
        'brand_image',
        'deleted_at',
    
    ];
        protected $dates = ['deleted_at'];

}




