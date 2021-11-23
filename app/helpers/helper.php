<?php

use App\Models\Brand;
use App\Models\Cart;
use App\Models\Color;
use App\Models\Config;
use App\Models\Country;
use App\Models\Order;
use App\Models\Page;
use App\Models\Product;
use App\Models\Rating;
use App\Models\ShippingSetting;
use App\Models\SiteSetting;
use App\Models\Size;
use App\Models\Slider;
use App\Models\Store;
use App\Models\UserPermission;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

if(!function_exists('makeAvatar')){

        function makeAvatar($fontPath, $dest, $char){
            $path = $dest;
            $image = imagecreate(250,250);
            $red = rand(0,255);
            $green = rand(0,255);
            $blue = rand(0,255);
            imagecolorallocate($image,$red,$green,$blue);
            $textcolor = imagecolorallocate($image,255,255,255);
            imagettftext($image,100,0,70,170,$textcolor,$fontPath,$char);
            imagepng($image,$path);
            imagedestroy($image);
            return $path;
        }
    }

    if(!function_exists('countries')){
        function countries(){
            $country = Country::all();
            return $country;
        }
    }

    if(!function_exists('brands')){
        function brands(){
            $country = Brand::where('status','active')->get();
            return $country;
        }
    }

    if(!function_exists('stores')){
        function stores(){
            $store = Store::where('status','1')->get();
            return $store;
        }
    }


    if(!function_exists('permissions')){
        function permissions(){
            $permission = UserPermission::where('user_id',Auth::id())->first();
            return $permission;
        }
    }
    if(!function_exists('check_permission')){
        function check_permission($field){
            $permission = UserPermission::where([['user_id',Auth::id()],[$field,1]])->count();
            return $permission;
        }
    }

    if(!function_exists('related_products')){
        function related_products($cat_id , $pro_id){
            $product = Product::where([['category_id',$cat_id],['id','!=',$pro_id],['status',1]])->limit(4)->get();
            return $product;
        }
    }


    if(!function_exists('cart_count')){
        function cart_count(){
            $cart = Cart::where([['user_id',Auth::id()],['ordered',false]])->count();
            return $cart;
        }
    }

    if(!function_exists('wishlist')){
        function wishlist(){
            $cart = Wishlist::where('user_id',Auth::id())->get();
            return $cart;
        }
    }

    if(!function_exists('cart_amount')){
        function cart_amount(){
            $orders = Order::where([['user_id',Auth::id()],['ordered',false]])->first();
            $total_price = 0;
            if($orders !== null){
                foreach($orders->cart_item as $item){
                    $total_price += $item->cartItems->offer_price * $item->qty;
                }
            }
            return $total_price ;
        }
    }

    if(!function_exists('sliders')){
        function sliders(){
            $slider = Slider::where('status','active')->get();
            return $slider;
        }
    }

    if(!function_exists('rating')){
        function rating($pro_id){
            $rating = Rating::where('product_id',$pro_id)->get();
            return $rating;
        }
    }

    if(!function_exists('count_ratings')){
        function count_ratings($cond){
            // $rating = Rating::where($cond)->toSql();
            $ratings = Rating::where($cond)->orderBy('id','desc')->get();
            // return print_r($rating);
            return $ratings;
        }
    }

    if(!function_exists('payment_config')){
        function payment_config(){
            // $rating = Rating::where($cond)->toSql();
            $config = Config::first();
            // return print_r($rating);
            return $config;
        }
    }

    if(!function_exists('ship_set')){
        function ship_set(){
            // $rating = Rating::where($cond)->toSql();
            $config = ShippingSetting::first();
            // return print_r($rating);
            return $config;
        }
    }

    if(!function_exists('site')){
        function site(){
            $site = SiteSetting::first();
            return $site;
        }
    }


    if(!function_exists('sizes')){
        function sizes(){
            $size = Size::where('status',true)->get();
            return $size;
        }
    }

    if(!function_exists('colors')){
        function colors(){
            $color = Color::where('status',true)->get();
            return $color;
        }
    }

    if(!function_exists('pages')){
        function pages(){
            $color = Page::first();
            return $color;
        }
    }




?>
