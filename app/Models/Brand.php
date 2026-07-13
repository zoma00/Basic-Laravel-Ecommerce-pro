<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // ✅ Correct namespace
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'brand_name',
        'brand_image',
        'deleted_at',

    ];

    protected $dates = ['deleted_at'];
}
