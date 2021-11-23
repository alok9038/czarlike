<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(){
        $data['orders'] = Order::where([['user_id',Auth::id()],['ordered',true]])->get();
        return view('home.orders',$data);
    }

    public function details($id){
        $data['order'] = Cart::where('id',$id)->first();
        return view('home.order_details',$data);
    }
}
