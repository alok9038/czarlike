<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Payment\PaytmController;
use App\Http\Controllers\Payment\RazorPayController;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class CartController extends Controller
{
    public function viewCart(){
        $data['orders'] = Order::where([['user_id',Auth::id()],['ordered',false]])->first();
        return view('home.cart',$data);
    }

    public function addToCart(Request $request){
        $id = $request->product_id;
        $count = Product::where('id',$id)->get();
        $user =  Auth::id();

        // echo $request->color_id;
        // echo $request->size_id;

        // die;

        if(count($count) > 0){
            $order = Order::where([['user_id',$user],['ordered',false]])->get();
            if(count($order) > 0){
                $cond = [['ordered',false],['user_id',$user],['order_id',$order[0]->id],['product_id',$id],['vendor_id',$request->vendor_id]];
                $order_item = Cart::where($cond)->get();

                if(count($order_item) > 0){
                    $qty = $order_item[0]->qty+=1;
                    Cart::where($cond)->update(['qty'=>$qty]);
                    toast('Item Quantity Increased!','success');
                    return redirect()->back();
                }
                else{

                    $order_i = new Cart();
                    $order_i->ordered = false;
                    $order_i->user_id = $user;
                    $order_i->order_id = $order[0]->id;
                    $order_i->qty = 1;
                    $order_i->color_id = $request->color_id;
                    $order_i->size_id = $request->size_id;
                    $order_i->vendor_id = $request->vendor_id;
                    $order_i->product_id = $id;
                    $order_i->save();
                }
            }
            else{
                $order = new Order;
                $order->ordered = false;
                $order->user_id = $user;
                $order->coupon_id  = null;
                // $order->vendor_id = $request->vendor_id;
                $order->address_id = null;
                $order->save();

                $last_id = $order->id;

                $cart = new Cart();
                $cart->ordered = false;
                $cart->user_id = $user;
                $cart->order_id = $last_id;
                $cart->qty = 1;
                $cart->color_id = $request->color_id;
                $cart->size_id = $request->size_id;
                $cart->vendor_id = $request->vendor_id;
                $cart->product_id = $id;
                $cart->save();
            }

            toast('Item Added to Cart!','success');
            return redirect()->route('cart');
        }

    }


    public function decreaseCartItem(Request $request){
        $id = $request->product_id;
        $order = Order::where([['user_id',Auth::id()],['ordered',false]])->first();
        $cond = [['ordered',false],['user_id',Auth::id()],['order_id',$order->id],['product_id',$id]];
        $order_item = Cart::where($cond)->first();

        $qty = $order_item->qty -= 1;
        Cart::where($cond)->update(['qty'=>$qty]);

        toast('Item Quantity Decreased!','info');
        return redirect()->back();

    }

    public function removeItem(Request $request){
        $product_id = $request->product_id;

        $cart = Cart::where([['user_id',Auth::id()],['product_id',$product_id],['ordered',false]])->delete();

        if($cart){
            toast('Item removed From cart!','success');
        }
        else{
            toast('Something Went Wrong!','error');
        }

        return redirect()->back();
    }

    public function checkout(){
        $data['orders'] = Order::where([['user_id',Auth::id()],['ordered',false]])->first();
        $data['addresses'] = Address::where('user_id',Auth::id())->get();
        return view('home.checkout',$data);
    }
    public function payment(Request $request){

        if($request->address_check == null){
            toast('Please select address first!','info');
            return redirect()->back();
        }
        $validator = $request->validate([
            'order_id'=>'required',
            'address_check'=>'required',
        ]);
        if($request->has('address_check') && $request->address_check == "new_add"){

            // echo $request->address_check;
            // die;
            $request->validate([
                'first_name'=>'required',
                'last_name'=>'required',
                'address'=>'required',
                'city'=>'required',
                'state'=>'required',
                'zip_code'=>'required',
                'email'=>'required',
                'phone'=>'required',
            ]);

            $address = new Address();
            $address->first_name = $request->first_name;
            $address->user_id = Auth::id();
            $address->last_name = $request->last_name;
            $address->address = $request->address;
            $address->city = $request->city;
            $address->state = $request->state;
            $address->zip = $request->zip_code;
            $address->email = $request->email;
            $address->phone = $request->phone;
            $address->order_notes = $request->order_notes;
            $address->company_name = $request->company_name;
            $address->save();

            $order = Order::where('id',$request->order_id)->update(['address_id'=>$address->id]);
        }
        else{
            $order = Order::where('id',$request->order_id)->update(['address_id'=>$request->address_check]);
        }

        $data['orders'] = Order::where([['user_id',Auth::id()],['ordered',false]])->first();
        return view('home.payment',$data);
    }

    public function payment_redirect(Request $request){
        $payment_type = $request->payment_type;
        // $amount = $request->amount;
        $order_id =  Crypt::encrypt($request->order_id);
        $amount =  Crypt::encrypt($request->amount);

        // print_r($data);
        // die;
        $data=[
            'amount'=>$amount,
            'order_id'=>$order_id
        ];

        if($payment_type == "cod"){
            Order::where([['id',$request->order_id],['user_id',Auth::id()]])->update(['ordered'=>true, 'payment_status'=>'0','status'=>1]);
            Cart::where([['order_id',$request->order_id],['user_id',Auth::id()]])->update(['ordered'=>true, 'payment_status'=>'0','status'=>1]);

            toast("Order successfuly Placed",'success');
            return redirect()->route('my.orders');
        }elseif($payment_type == "paytm"){
            method_field("post");
            // return redirect()->route('paytm.payment')->withInput(Request::amount());
            return redirect()->action(
                [PaytmController::class, 'pay'], $data
            );
        }
    }

    public function cancelOrder(Request $request){
        $request->validate([
            'order_id'=>'required',
        ]);

        Order::where([['id',$request->order_id],['user_id',Auth::id()],['ordered',true]])->update(['status'=>3]);
        Cart::where([['order_id',$request->order_id],['user_id',Auth::id()],['ordered',true]])->update(['status'=>3]);

        toast("Order successfuly Canceled",'info');
        return redirect()->route('my.orders');

    }
}
