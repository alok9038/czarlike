<?php

namespace App\Http\Controllers;

use App\Models\Assign;
use App\Models\Driver;
use Illuminate\Http\Request;

class AssignController extends Controller
{
    public function assignOrder(Request $request){
        $request->validate([
            'driver_id' => 'required',
            'order_id'  => 'required'
        ]);

        $driver = Driver::where('id',$request->driver_id)->get();

        if($driver->count() > 0){
            $assign = new Assign();
            $assign->driver_id = $request->driver_id;
            $assign->order_id = $request->order_id;
            $assign->notes = $request->notes;
            $assign->status = 'pending';
            $assign->save();

            if($assign){
                toast('Order assinged to '.$driver[0]->name.' successfully!','success');
                return redirect()->back();
            }
        }
        else{
            toast('Driver not Found','error');
            return redirect()->back();
        }

    }
}
