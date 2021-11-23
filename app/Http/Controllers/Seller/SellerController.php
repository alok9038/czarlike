<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerController extends Controller
{
    public function home(){
        $data['users'] = User::where('added_by',Auth::id())->get();
        $data['orders'] = Cart::where([['vendor_id',Auth::id()],['ordered',true]])->get();
        $data['products'] = Product::where('vender_id',Auth::id())->get();
        return view('seller.home',$data);
    }
}
