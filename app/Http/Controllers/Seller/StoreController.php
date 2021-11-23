<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class StoreController extends Controller
{
    public function stores(){
        $data['stores'] = Store::Where('store_owner',Auth::id())->get();
        return view('seller.stores',$data);
    }

    public function createStoreView(){
        return view('seller.add_store');
    }

    public function createStore(Request $request){
        $request->validate([
            'store_name'=>'required',
            'bussiness_email'=>'required',
            'store_phone'=>'required',
            'store_add'=>'required',
            'country'=>'required',
            'state'=>'required',
            'city'=>'required',
        ]);


        if($request->hasFile('store_logo')){
            $picture = rand(12,34353).'_'.time(). "." . $request->store_logo->extension();
            $request->store_logo->move(public_path("users/stores/"),$picture);
        }else{
            $path = public_path('users/stores/');
            $fontPath = public_path('fonts/Oliciy.ttf');
            $char = strtoupper($request->store_name[0]);
            $newAvatarName = rand(12,34353).time().'_avatar.png';
            $dest = $path.$newAvatarName;

            $createAvatar = makeAvatar($fontPath,$dest,$char);
            $picture = $createAvatar == true ? $newAvatarName : '';

        }

        $store = new Store();
        $store->store_owner = Auth::id();
        $store->user_id = Auth::id();
        $store->store_name = $request->store_name;
        $store->gst = $request->gst;
        $store->phone = $request->store_phone;
        $store->bussiness_email = $request->bussiness_email;
        $store->store_address = $request->store_add;
        $store->country = $request->country;
        $store->state = $request->state;
        $store->city = $request->city;
        $store->pincode = $request->pincode;
        $store->store_logo = $picture;
        $store->is_requested = 1;
        $store->save();

        if($store){
            Alert::toast('Store Successfully Created!', 'success');
            return redirect()->route('seller.stores.view');
        }
        else{
            toast('Something went Wrong!','error');
            return redirect()->back();
        }
    }

    public function deleteStore(Request $request){
        $id = $request->store_id;

        $user = Store::where('id',$id)->delete();

        if($user){
            Alert::toast('Store Successfully Removed!', 'success');
            return redirect()->back();
        }
        else{
            toast('Something went Wrong!','error');
            return redirect()->back();
        }
    }

}
