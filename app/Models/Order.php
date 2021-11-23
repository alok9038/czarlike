<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Razorpay\Api\Card;

class Order extends Model
{
    use HasFactory;

    public function cart_item(){
        return $this->hasMany(Cart::class);
    }

    public function payments(){
        return $this->hasOne(Paytm::class,'cart_order_id','id');
    }

    public function address(){
        return $this->hasOne(Address::class,'id','address_id');
    }
    public function coupon(){
        return $this->hasOne(Coupon::class,'id','coupon_id');
    }
}
