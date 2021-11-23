<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\UserRegister;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;

class DriverController extends Controller
{
    public function home(){
        $data['drivers'] = Driver::get();
        return view('admin.driver',$data);
    }

    public function add_driver(){
        return view('admin.add_driver');
    }

    public function storeDriver(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'id_proof' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|size:10',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $id = time(). "." . $request->id_proof->extension();
        $request->id_proof->move(public_path("images/drivers/documents"),$id);

        if($request->hasFile('image')){
            $picture = time(). "." . $request->image->extension();
            $request->image->move(public_path("images/drivers/"),$picture);
        }else{
            $path = public_path('images/drivers/');
            $fontPath = public_path('fonts/Oliciy.ttf');
            $char = strtoupper($request->name[0]);
            $newAvatarName = rand(12,34353).time().'_avatar.png';
            $dest = $path.$newAvatarName;

            $createAvatar = makeAvatar($fontPath,$dest,$char);
            $picture = $createAvatar == true ? $newAvatarName : '';
        }

        $user = new Driver();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->contact = $request->phone;
        $user->country_id = $request->country;
        $user->address = $request->address;
        $user->state_id = $request->state;
        $user->city_id = $request->city;
        $user->id_proof = $id;
        $user->image = $picture;
        $user->added_by = Auth::id();
        $user->password =  Hash::make($request->password);
        $user->save();

        if($user){
            $details = [
                'email' => $request->email,
                'name' => $request->name,
                'password'=> $request->password,
            ];

            $mail = Mail::to($request->email)->send(new UserRegister($details));
        }

        toast('Driver has been Successfully Added!','success');
        return redirect()->back();
    }

    public function deleteDriver(Request $request){
        $id = $request->driver_id;

        $query = Driver::where('id',$id)->delete();
        if($query){
            toast('Driver has been Deleted!','success');
        }
        else{
            toast('Something went Wrong!','error');
        }

        return redirect()->back();
    }

    public function active_deactive(Request $request){
        $request->validate([
            'driver_id'=>'required'
        ]);

        $id = $request->driver_id;

        $user = Driver::where('id',$id)->first();
        if($user->status == true){
            $query = Driver::where('id',$id)->update(['status'=>false]);
            if($query){
                toast("account has been deactivated",'info');
            }else{
                toast("something went Wrong",'error');
            }
        }
        else{
            $query = Driver::where('id',$id)->update(['status'=>true]);
            if($query){
                toast("account has been activated",'success');
            }else{
                toast("something went Wrong",'error');
            }
        }

        return redirect()->back();
    }
}
