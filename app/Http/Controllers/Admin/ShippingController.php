<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShippingSetting;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    public function view(){
        return view('admin.shipping_setting');
    }

    public function store(Request $request){
        $ship = new ShippingSetting();
        $ship->cod_charge = $request->cod_charge;
        $ship->shipping_charge = $request->shipping_charge;
        $ship->max_cart_amount = $request->max_cart_amount;
        $ship->save();

        toast('setting updated','success');
        return redirect()->back();
    }

}
