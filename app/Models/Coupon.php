<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    public function products(){
        return $this->hasOne(Product::class,'id','product_id');
    }
    public function category(){
        return $this->hasOne(Category::class,'id','cat_id');
    }
}
