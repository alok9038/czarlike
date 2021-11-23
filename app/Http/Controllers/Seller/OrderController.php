<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function all(){
        $data['orders'] = Cart::where([['vendor_id',Auth::id()],['ordered',true]])->get();

        return view('seller.orders.all_orders',$data);
    }

    public function pending(){
        $data['orders'] = Cart::where([['ordered',true],['status',1],['vendor_id',Auth::id()]])->orderBy('id','desc')->get();
        return view('seller.orders.pending',$data);
    }

    public function returnOrders(){
        $data['orders'] = Cart::where([['ordered',true],['status',4],['vendor_id',Auth::id()]])->orderBy('id','desc')->get();
        return view('seller.orders.returned',$data);
    }

    public function cancel(){
        $data['orders'] = Cart::where([['ordered',true],['status',3],['vendor_id',Auth::id()]])->orderBy('id','desc')->get();
        return view('seller.orders.canceled',$data);
    }

    public function viewOrder($id){
        $data['order'] = Cart::where("id",$id)->first();
        return view('seller.orders.view_order',$data);
    }
}
