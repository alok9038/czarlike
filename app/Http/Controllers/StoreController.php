<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class StoreController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:store');
    }
    public function stores(){
        $data['stores'] = Store::all();
        return view('admin.stores',$data);
    }

    public function createStoreView(){
        $data['owners'] = User::where('user_type','!=','superAdmin')->get();
        return view('admin.addStore',$data);
    }

    public function createStore(Request $request){
        $request->validate([
            'store_owner'=>'required',
            'store_name'=>'required',
            'bussiness_email'=>'required',
            'store_phone'=>'required',
            'store_add'=>'required',
            'country'=>'required',
            'state'=>'required',
            'city'=>'required',
        ]);

        $status = $request->status;
        $verified = $request->verified;

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
        $store->store_owner = $request->store_owner;
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
        $store->status = $status;
        $store->is_verified = $verified;
        $store->save();

        if($store){
            Alert::toast('Store Successfully Created!', 'success');
            return redirect()->route('super.admin.stores.view');
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

    public function updateStoreView(Request $request){
        // $id = $_GET['store_id'];
        $id = $request->store_id;
        if($id == null){
            return redirect()->back();
        }
        $data['store'] = Store::where('id',$id)->first();
        return view('admin.updateStore',$data);
    }

    public function requestedStore(){
        $data['stores'] = Store::where('is_requested',1)->get();
        return view('admin.requested_store',$data);
    }
}
