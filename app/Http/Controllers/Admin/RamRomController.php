<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Storage;
use Illuminate\Http\Request;

class RamRomController extends Controller
{
    public function view(){
        $data['sizes'] = Storage::all();
        return view('admin.products.attributes.ram_rom',$data);
    }

    public function store(Request $request){
        $request->validate([
            'storage' => 'required',
            'ram' => 'required',
        ]);

        $size = new Storage();
        $size->ram = $request->ram;
        $size->storage = $request->storage;
        if($request->has('status')){
            $size->status = $request->status;
        }
        $size->save();

        if($size){
            toast('Ram / storage inserted!!','success');
        }
        else{
            toast('Something went Wrong!!','error');
        }

        return redirect()->back();
    }

    public function update(Request $request){
        $request->validate([
            'storage' => 'required',
            'ram' => 'required',
        ]);

        $size = Storage::find($request->id);
        $size->ram = $request->ram;
        $size->storage = $request->storage;
        if($request->has('status')){
            $size->status = $request->status;
        }
        $size->save();

        if($size){
            toast('Ram / storage updated!!','success');
        }
        else{
            toast('Something went Wrong!!','error');
        }

        return redirect()->back();
    }


    public function delete(Request $request){
        $id = $request->id;

        if($id == null){
            return redirect()->back();
        }

        $query = Storage::where('id',$id)->delete();

        if($query){
            toast('Ram - Rom has been deleted!','success');
        }
        else{
            toast('something went wrong','error');
        }
        return redirect()->back();
    }

    public function active_deactive(Request $request){
        $id = $request->id;

        $query = Storage::where('id',$id)->first();

        if($query->status == true){
            $active = Storage::find($id)->update(['status'=>false]);

            if($active){
                toast('Ram - Rom has been Deactived!','success');
            }
            else{
                toast('something went wrong','error');
            }
        }
        else{
            $active = Storage::find($id)->update(['status'=>true]);

            if($active){
                toast('Ram - Rom has been actived!','success');
            }
            else{
                toast('something went wrong','error');
            }
        }

        return redirect()->back();

    }
}
