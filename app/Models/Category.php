<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes; // ✅ Correct namespace
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use  HasFactory,SoftDeletes;
     protected $fillable = [
        'user_id',
        'category_name',
    
    ];
     // Optional: Explicitly define deleted_at column
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];  // Prevent mass assignment on ID

    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }



}
