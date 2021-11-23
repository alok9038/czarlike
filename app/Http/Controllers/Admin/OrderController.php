<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Driver;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function all(){
        $data['orders'] = Order::where('ordered','!=',false)->orderBy('id','desc')->get();
        return view('admin.orders.all_orders',$data);
    }

    public function pending(){
        $data['orders'] = Order::where([['ordered',true],['status',1]])->orWhere([['ordered',true],['status',null]])->orderBy('id','desc')->get();
        return view('admin.orders.pending',$data);
    }

    public function returnOrders(){
        $data['orders'] = Order::where([['ordered',true],['status',4]])->orderBy('id','desc')->get();
        return view('admin.orders.returned',$data);
    }

    public function cancel(){
        $data['orders'] = Order::where([['ordered',true],['status',3]])->orderBy('id','desc')->get();
        return view('admin.orders.canceled',$data);
    }

    public function viewOrder($id){
        $data['drivers'] = Driver::where('status',true)->get();
        $data['order'] = Cart::where("id",$id)->first();
        return view('admin.orders.view_order',$data);
    }
}
