<?php

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Rating;
use App\Models\Store;
use App\Models\User;

if(!function_exists('order_count')){
    function order_count($vendor_id = null){
        if($vendor_id !== null){
            $orders = Cart::where([['ordered','!=',false],['vender_id',$vendor_id]])->get();
        }else{
            $orders = Cart::where('ordered','!=',false)->get();
        }
        return $orders;
    }
}

if(!function_exists('review_count')){
    function review_count($vendor_id = null){
        $review = Rating::get();
        return $review;
    }
}

if(!function_exists('new_users')){
    function new_users($user_type = null){
        if($user_type !== null){
            $users = User::where('user_type',$user_type)->orderBy('id','desc')->limit(10)->get();
        }else{
            $users = User::orderBy('id','desc')->limit(10)->get();
        }
        return $users;
    }
}

if(!function_exists('product_count')){
    function product_count(){

        $products = Product::where('status',true)->limit(10)->get();
        return $products;
    }
}


if(!function_exists('store_request')){
    function store_request(){

        $products = Store::where('is_requested',1)->get();
        return $products;
    }
}

