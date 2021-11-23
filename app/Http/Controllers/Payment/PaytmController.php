<?php

namespace App\Http\Controllers\Payment;

use Anand\LaravelPaytmWallet\Facades\PaytmWallet;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Paytm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class PaytmController extends Controller
{
    public function pay(Request $request){

        $cart_order_id = Crypt::decrypt($request->order_id);
        $amount = Crypt::decrypt($request->amount);

        $userData = [
            'name' => Auth::user()->user_name, // Name of user
            'mobile' =>Auth::user()->phone, //Mobile number of user
            'email' => Auth::user()->email, //Email of user
            'amount' => $amount,
            'user_id'=>Auth::id(),
            'order_id' =>rand(1,999999), //Order id
            'cart_order_id' =>$cart_order_id //Order id
        ];

        Paytm::create($userData); // creates a new database record

        $payment = PaytmWallet::with('receive');

        $payment->prepare([
            'order' => $userData['order_id'],
            'user' => $userData['user_id'],
            'mobile_number' => $userData['mobile'],
            'email' => $userData['email'], // your user email address
            'amount' => $amount, // amount will be paid in INR.
            'callback_url' => route('paytm.callback') // callback URL
        ]);
        return $payment->receive();  // initiate a new payment
    }


    public function paytmcallback()
    {
        $user_id  = Auth::id();

        $transaction = PaytmWallet::with('receive');

        $response = $transaction->response();

        $order_id = $transaction->getOrderId(); // return a order id
        $transaction->getTransactionId(); // return a transaction id

        if ($transaction->isSuccessful()) {
            Paytm::where([['order_id', $order_id],['user_id',$user_id]])->update(['status' => 1, 'transaction_id' => $transaction->getTransactionId()]);
            $payment = Paytm::where('order_id',$order_id)->first();

            Order::where([['user_id',Auth::id()],['id',$payment->cart_order_id]])->update(['ordered'=>true, 'payment_status'=>'1','status'=>1]);
            Cart::where([['user_id',Auth::id()],['order_id',$payment->cart_order_id]])->update(['ordered'=>true, 'payment_status'=>'1','status'=>1]);
            
            toast('Payment of ₹ '.$payment->amount.' is successfully done!','success');
            return redirect()->route('homepage');

        } else if ($transaction->isFailed()) {
            Paytm::where('order_id', $order_id)->update(['status' => 0, 'transaction_id' => $transaction->getTransactionId()]);
            return view('paytm-fail')->with('message', "Your payment is failed.");

        } else if ($transaction->isOpen()) {
            Paytm::where('order_id', $order_id)->update(['status' => 2, 'transaction_id' => $transaction->getTransactionId()]);
            return view('paytm-fail')->with('message', "Your payment is processing.");
        }
        $transaction->getResponseMessage(); //Get Response Message If Available

        // $transaction->getOrderId(); // Get order id
    }

}
