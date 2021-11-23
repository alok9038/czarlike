<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Validation\Rules;

class ProfileController extends Controller
{
    public function profile(){
        return view('seller.profile');
    }
    public function admin_profile(){
        return view('admin.profile');
    }
    public function updateDetails(Request $request){
        $request->validate([
            'name'=>'required',
            'phone'=>'required',
            'email'=>'required',
        ]);

        $user = User::where('id',Auth::id())->first();
        $user->user_name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();

        if($user){
            toast('Details Updated!','success');
            return redirect()->back();
        }else{
            toast('something went Wrong!','error');
            return redirect()->back();
        }
    }

    public function changePassword(Request $request){
        $request->validate([
            'current_password'=>'required',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error_msg', 'Current password does not match!');
        }

        $user =User::find(Auth::id());
        $user->password = Hash::make($request->password);
        $user->save();

        toast('Password Successfully updated!','success');
        return redirect()->back();

    }

    public function updateDp(Request $request){
        File::delete('images/students/'.Auth::user()->image);

        if($request->hasFile('image')){
            $image = time() . "." . $request->image->extension();
            $request->image->move(public_path("users/images/"),$image);

            $user = User::where('id',Auth::id())->first();
            $user->image = $image;
            $user->save();

            toast('Profile Image Updated','success');
        }
        else{
            toast('something went wrong!','error');
        }

        return redirect()->back();

    }
}
