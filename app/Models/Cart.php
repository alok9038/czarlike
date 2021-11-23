<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    public function cartItems(){
        return $this->hasOne(Product::class,'id','product_id');
    }

    public function Orders(){
        return $this->hasOne(Order::class,'id','order_id');
    }

    public function coupon(){
        return $this->hasOne(Coupon::class,'id','coupon_id');
    }

    public function orderColor(){
        return $this->hasOne(Color::class,'id','color_id');
    }

    public function orderSize(){
        return $this->hasOne(Size::class,'id','size_id');
    }


}
