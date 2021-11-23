<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function view(){
        $data['coupons'] = Coupon::orderBy('id','desc')->get();
        return view('admin.products.coupon.coupons',$data);
    }

    public function viewCreate(){
        $data['products'] = Product::where('status',1)->get();
        return view('admin.products.coupon.add_coupon',$data);
    }

    public function addCoupon(Request $request){
        $request->validate([
            'code'=>'required',
            'amount'=>'required'
        ]);

        $coupon = new Coupon();
        $coupon->code = $request->code;
        $coupon->amount = $request->amount;
        $coupon->cat_id = $request->cat_id;
        $coupon->product_id = $request->product_id;
        $coupon->min_amount = $request->min_amount;
        $coupon->expirydate = $request->expiry_date;
        $coupon->save();

        toast('Coupon Has been Added!','success');
        return redirect()->route('super.admin.coupons');
    }

    public function active_deactive(Request $request){
        $id = $request->coupon_id;

        $coupon = Coupon::where('id',$id)->first();

        if($coupon->status == 1){
            $deactive = Coupon::where('id',$id)->update(['status',false]);
            if($deactive){
                toast('Coupon has been deactivated!','success');
                return redirect()->back();
            }
            else{
                toast('Something went Wrong!','error');
                return redirect()->back();
            }
        }
        else{
            $active = Coupon::where('id',$id)->update(['status',true]);
            if($active){
                toast('Coupon has been activated!','success');
                return redirect()->back();
            }
            else{
                toast('Something went Wrong!','error');
                return redirect()->back();
            }
        }

        toast('Something went Wrong!','error');
        return redirect()->back();
    }

    public function viewEditCoupon($id){
        $data['products'] = Product::where('status',1)->get();
        $data['coupon'] = Coupon::where('id',$id)->first();
        return view('admin.products.coupon.edit_coupon',$data);
    }
    public function editCoupon(Request $request,$id){
        $request->validate([
            'code'=>'required',
            'amount'=>'required'
        ]);

        $coupon = Coupon::find($id);
        $coupon->code = $request->code;
        $coupon->amount = $request->amount;
        $coupon->cat_id = $request->cat_id;
        $coupon->product_id = $request->product_id;
        $coupon->min_amount = $request->min_amount;
        $coupon->expirydate = $request->expiry_date;
        $coupon->save();

        toast('Coupon Has been Updated!','success');
        return redirect()->route('super.admin.coupons');
    }

    public function deleteCoupon(Request $request){
        $id = $request->coupon_id;

        $coupon = Coupon::where('id',$id)->delete();
        if($coupon){
            toast('Coupon has been Deleted!','success');
            return redirect()->back();
        }
        else{
            toast('Something went Wrong!','error');
            return redirect()->back();
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

                    // return $order->cartItems;
                    // die;
                    // foreach($order as $u){
                    //     $cart[] = $u->cartItems->category_id;
                    // }

                    // $cat_check = Coupon::where(function($q) use ($cart)
                    // {
                    // foreach($cart as $u)
                    // {

                    //     $q->orWhere('cat_id',$u);
                    // }
                    // })->get();

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

