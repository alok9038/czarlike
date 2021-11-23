<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function product_cat(){
    	return $this->hasOne('App\Models\Category','id','category_id');
    }

    public function product_brand(){
    	return $this->hasOne('App\Models\Brand','id','brand_id');
    }

    public function store(){
    	return $this->hasOne('App\Models\Store','id','store_id');
    }

    public function seller(){
        return $this->hasOne(User::class,'id','vender_id');
    }
    public function images(){
        return $this->hasMany(ProductImages::class,'product_id','id');
    }

    public function ratings(){
        return $this->hasMany(Rating::class,'product_id','id');
    }

    public function colors(){
        return $this->hasMany(ProductColor::class,'product_id','id');
    }
    public function sizes(){
        return $this->hasMany(ProductSize::class,'product_id','id');
    }

    public function coupons(){
        return $this->hasMany(Coupon::class,'product_id','id')->where('status',true);
    }
    public function variants(){
        return $this->hasMany(Variant::class,'product_id','id');
    }
}
