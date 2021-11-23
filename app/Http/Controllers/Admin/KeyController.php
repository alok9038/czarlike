<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Config;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;

class KeyController extends Controller
{
    public function __construct()
    {
        $this->config = Config::first();
    }

    public function index(){
        $data['config'] = $this->config;
        return view('admin.payment_gateway',$data);
    }

    public function updatePaytm(Request $request)
    {
        $input = $request->all();

        $env_keys_save = DotenvEditor::setKeys([
            'PAYTM_ENVIRONMENT' => $input['PAYTM_ENVIRONMENT'],
            'PAYTM_MERCHANT_ID' => $input['PAYTM_MERCHANT_ID'],
            'PAYTM_MERCHANT_KEY' => $input['PAYTM_MERCHANT_KEY'],
        ]);

        $env_keys_save->save();

        $this->config->paytm_enable = isset($request->paytmchk) ? true : false;

        $this->config->save();

        Alert::toast('Paytm settings has been updated !','success');
        return redirect()->back();
    }

    public function updaterazorpay(Request $request)
    {
        $input = $request->all();

        $env_keys_save = DotenvEditor::setKeys([
            'RAZOR_PAY_KEY' => $input['RAZOR_PAY_KEY'],
            'RAZOR_PAY_SECRET' => $input['RAZOR_PAY_SECRET'],
        ]);

        $env_keys_save->save();

        $this->config->razorpay_enable = isset($request->rpaycheck ) ? 1 : 0;
        $this->config->save();

        Alert::toast('RazorPay settings has been updated !','success');
        return redirect()->back();
    }

    public function updateStripe(Request $request)
    {
        $input = $request->all();

        $env_keys_save = DotenvEditor::setKeys([
            'STRIPE_KEY' => $input['STRIPE_KEY'],
            'STRIPE_SECRET' => $input['STRIPE_SECRET'],
        ]);

        $env_keys_save->save();

        $this->config->stripe_enable = isset($request->stripecheck ) ? 1 : 0;

        $this->config->save();

        Alert::toast('RazorPay settings has been updated !','success');
        return redirect()->back();
    }
}
