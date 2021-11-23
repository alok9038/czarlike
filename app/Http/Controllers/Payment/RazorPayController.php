<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Razorpay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Razorpay\Api\Api;
use Exception;
use Illuminate\Support\Facades\Auth;

class RazorPayController extends Controller
{
    public function payment(Request $request)
    {
        $input = $request->all();

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $payment = $api->payment->fetch($input['razorpay_payment_id']);

        if(count($input)  && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount']));
            } catch (Exception $e) {
                return  $e->getMessage();
                // Session::put('error',$e->getMessage());
                toast($e->getMessage(),'error');
                return redirect()->back();
            }
        }

        $data = new Razorpay();
        $data->payment_id = $input['razorpay_payment_id'];
        $data->email = $payment['email'];
        $data->phone = $payment['contact'];
        $data->order_id = $request->order_id;
        $data->user_id = Auth::id();
        $data->status = true;
        $data->amount = $payment['amount'];
        $data->save();

        Order::where([['user_id',Auth::id()],['id',$request->order_id]])->update(['ordered'=>true, 'payment_status'=>'1','status',1]);
        Cart::where([['user_id',Auth::id()],['order_id',$request->order_id]])->update(['ordered'=>true, 'payment_status'=>'1','status',1]);

        toast('Payment of ₹ '.($payment['amount'] / 100).' is successfully done!','success');
        return redirect()->back();
    }
}
