<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cartItem(Request $request){
        $data['items'] = Cart::where([['ordered',false],['user_id',$request->user()->id]])->with(
            array('cartItems' => function($query) {
                $query->select('id','name','offer_price','price','category_id')->with(
                    array('product_cat' => function($query){
                        $query->select('id','title');
                    })
                );
            })
        )->get();

        return response()->json($data);
    }

    public function addToCart(Request $request){
        $id = $request->product_id;
        $count = Product::where('id',$id)->get();
        $user =  $request->user()->id;

        if(count($count) > 0){
            $order = Order::where([['user_id',$user],['ordered',false]])->get();
            if(count($order) > 0){
                $cond = [['ordered',false],['user_id',$user],['order_id',$order[0]->id],['product_id',$id],['vendor_id',$request->vendor_id]];
                $order_item = Cart::where($cond)->get();

                if(count($order_item) > 0){
                    $qty = $order_item[0]->qty+=1;
                    Cart::where($cond)->update(['qty'=>$qty]);
                    return response()->json(['message'=>'product qty increases!'],200);
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
                    $order_i->variant_price = $request->variant_price;
                    $order_i->save();
                }
            }
            else{
                $order = new Order();
                $order->ordered = false;
                $order->user_id = $user;
                $order->coupon_id  = null;
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
                $cart->variant_price = $request->variant_price;
                $cart->save();
            }

            return response()->json(['message'=>'item added to cart!'],200);
        }

    }

    public function decreaseCartItem(Request $request){
        $id = $request->product_id;
        $user = $request->user()->id;

        $order = Order::where([['user_id',$user],['ordered',false]])->first();
        $cond = [['ordered',false],['user_id',$user],['order_id',$order->id],['product_id',$id]];
        $order_item = Cart::where($cond)->first();

        $qty = $order_item->qty -= 1;
        Cart::where($cond)->update(['qty'=>$qty]);

        return response()->json(['message'=>'Item Quantity Decreased!'],200);

    }

    public function removeItem(Request $request){
        $product_id = $request->product_id;
        $user = $request->user()->id;

        $cart = Cart::where([['user_id',$user],['product_id',$product_id],['ordered',false]])->delete();

        if($cart){
            return response()->json(['message'=>'Item removed from cart',],200);

        }
        else{
            return response()->json(['message'=>'Something went wrong!',],401);
        }

    }

    public function redeemCoupon(Request $request){
        $request->validate(['code'=>'required']);

        $order = Cart::where('id',$request->order_id)->first();

        $count = Coupon::where('code',"$request->code")->count();

        if($count > 0){
            $coupon = Coupon::where('code',$request->code)->first();

            if($coupon->product_id !== null){
                $cp = Coupon::where([['code',$request->code],['product_id',$request->product_id]])->get();

                if($cp->count() > 0){
                    $set_coup = Cart::where('id',$request->order_id)->update(['coupon_id'=>$cp[0]->id]);
                    if($set_coup){
                        toast('Coupon '.$coupon->code.' successfully Redeem!','success');
                        return redirect()->back();
                    }
                    else{
                        toast('something went Worng!','error');
                        return redirect()->back();
                    }

                }
            }

            if($coupon->expirydate != null){
                $mytime = Carbon::now();
                $date = $mytime->toDateString();
                $expiry_date = date('Y-m-d', strtotime($coupon->expirydate));

                if( $expiry_date <= $date){
                    toast('Coupon is expired!','error');
                    return redirect()->back();
                }
            }

            if($coupon->status == 1){
                if($coupon->cat_id !== null){
                    $cat_coupon = Coupon::where([['code',$request->code],['cat_id',$order->cartItems->category_id]])->get();
                    if($cat_coupon->count() > 0){
                        $add_coupon = Cart::where('id',$request->order_id)->update([
                            'coupon_id'=>$cat_coupon[0]->id
                        ]);
                        if($add_coupon){
                            toast('Coupon '.$coupon->code.' successfully added!','success');
                            return redirect()->back();
                        }
                        else{
                            toast('Coupon is not valid for these products!','warning');
                            return redirect()->back();
                        }
                    }
                    else{
                        toast('Coupon is not valid for these products!','warning');
                        return redirect()->back();
                    }


                }
                else{
                    $add_coupon = Cart::where('id',$request->order_id)->update([
                        'coupon_id'=>$coupon->id
                    ]);
                    if($add_coupon){
                        toast('Coupon '.$coupon->code.' successfully added!','success');
                        return redirect()->back();
                    }
                    else{
                        toast('Coupon is not valid for these products!','warning');
                        return redirect()->back();
                    }
                }
            }
            else{
                toast('Coupon is not active!','warning');
                return redirect()->back();
            }

        }
        else{
            toast('Please enter valid Coupon!','error');
            return redirect()->back();
        }
        // return $cat_check;
    }

    public function removeCoupon(Request $request){
        $order_id = $request->order_id;
        $coupon_id = $request->coupon_id;

        $query = Cart::where([['id',$order_id],['coupon_id',$coupon_id]])->update(['coupon_id'=>null]);
        if($query){
            toast("Coupon has been removed from this product!",'success');
        }
        else{
            toast('something went wrong!','error');
        }

        return redirect()->back();
    }


}
