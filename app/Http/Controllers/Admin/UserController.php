<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\UserRegister;
use App\Models\User;
use App\Models\UserPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;
use Illuminate\Validation\Rules;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function users($user){
        if($user == 'customer'){
            if(Auth::user()->user_type === 'admin' && permissions()->customers !== 1){
                return redirect()->back();
            }
            $data['users'] = User::where([['id','!=',Auth()->id()],['user_type','user']])->get();
            $data['type']=1;
        }
        if($user == 'seller'){
            if(Auth::user()->user_type === 'admin' && permissions()->sellers !== 1){
                return redirect()->back();
            }
            $data['users'] = User::where('user_type','seller')->get();
            $data['type']=2;
        }
        if($user == 'admin'){
            if(Auth::user()->user_type === 'admin' && permissions()->admin !== 1){
                return redirect()->back();
            }
            $data['users'] = User::where('user_type','admin')->get();
            $data['type']=3;
        }
        return view('admin.users',$data);
    }

    public function viewCreateUser(){
        $data['type'] = $_GET['type'];

        return view('admin.add_user',$data);
    }

    public function createUser(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|size:10',
            'role' => 'required',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);


        if($request->hasFile('image')){
            $picture = time(). "." . $request->image->extension();
            $request->image->move(public_path("users/images/"),$picture);

        }else{
            $path = public_path('users/images/');
            $fontPath = public_path('fonts/Oliciy.ttf');
            $char = strtoupper($request->name[0]);
            $newAvatarName = rand(12,34353).time().'_avatar.png';
            $dest = $path.$newAvatarName;

            $createAvatar = makeAvatar($fontPath,$dest,$char);
            $picture = $createAvatar == true ? $newAvatarName : '';
        }

        $user = new User;
        $user->user_name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->country_id = $request->country;
        $user->state_id = $request->state;
        $user->city_id = $request->city;
        $user->website = $request->website;
        $user->user_type = $request->role;
        $user->image = $picture;
        $user->password =  Hash::make($request->password);
        $user->save();

        if($request->role != 'user'){
            $p = new UserPermission();
            $p->dashboard = $request->dashboard;
            $p->manage_users = $request->manage_users;
                $p->customers = $request->customers;
                $p->sellers = $request->sellers;
                $p->admin = $request->admin;
            $p->menu_management = $request->menu_management;
            $p->create_store = $request->create_store;
            $p->locations = $request->locations;
            $p->product_manage = $request->product_manage;
                $p->brand = $request->brand;
                $p->products = $request->products;
                $p->coupons = $request->coupons;
                $p->categories_manage = $request->categories_manage;
                    $p->category = $request->category;
                    $p->sub_category = $request->sub_category;
                    $p->child_category = $request->child_category;
            $p->orders = $request->orders;
            $p->all_orders = $request->all_orders;
            $p->pending_orders = $request->pending_orders;
            $p->cancel_orders = $request->cancel_order;
            $p->invoice_orders = $request->invoice;
            $p->returned_order = $request->returned_order;
            $p->ratings = $request->ratings;
            $p->locations = $request->locations;
            $p->slider = $request->slider;
            $p->user_id = $user->id;
            $p->save();

        }


        if($user){
            $details = [
                'email' => $request->email,
                'name' => $request->name,
                'password'=> $request->password,
            ];

            $mail = Mail::to($request->email)->send(new UserRegister($details));
        }


        // echo $user;
        toast('User Successfully Created!','success');
        return redirect()->back();
    }

    public function deleteUser(Request $request){
        $id = $request->user_id;

        $user = User::where('id',$id)->delete();

        if($user){
            Alert::toast('User Successfully Removed!', 'success');
            return redirect()->back();
        }
        else{
            toast('Something went Wrong!','error');
            return redirect()->back();
        }
    }

    public function updateUserView(Request $request){
        $id = $request->user_id;
        if($id == null){
            return redirect()->back();
        }
        $data['user'] = User::where('id',$id)->first();

        return view('admin.updateUser',$data);
    }

    public function updateUser(Request $request){
        $request->validate([
            'user_name'=>'required',
            'phone'=>'required',
            'email'=>'required',
        ]);
        $id = $request->user_id;
        $check = User::where('id',$id)->first();
        if($check->image !== null){
            File::delete("storage/users/multiple_images/".$check->image);
        }

        if($request->hasFile('image')){
            $picture = rand(12,34353).'_'.time(). "." . $request->image->extension();
            $request->image->move(public_path("users/images/"),$picture);
        }else{
            $path = public_path('users/images/');
            $fontPath = public_path('fonts/Oliciy.ttf');
            $char = strtoupper($request->user_name[0]);
            $newAvatarName = rand(12,34353).time().'_avatar.png';
            $dest = $path.$newAvatarName;

            $createAvatar = makeAvatar($fontPath,$dest,$char);
            $picture = $createAvatar == true ? $newAvatarName : '';

        }

        $user = User::where('id',$id)->update([
            'user_name' => $request->user_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'website' => $request->website,
            'country_id' => $request->country,
            'state_id' => $request->state,
            'city_id' => $request->city,
            'image' => $picture,
            'user_type' => $request->role
        ]);

        if($user){
            Alert::toast('User Successfully Updated!', 'success');
            return redirect()->back();
        }
        else{
            toast('Something went Wrong!','error');
            return redirect()->back();
        }
    }

    public function active_deactive(Request $request){
        $request->validate([
            'user_id'=>'required'
        ]);

        $id = $request->user_id;

        $user = User::where('id',$id)->first();
        if($user->status == 'active'){
            $query = User::where('id',$id)->update(['status'=>'deactive']);
            if($query){
                toast("account has been deactivated",'info');
            }else{
                toast("something went Wrong",'error');
            }
        }
        else{
            $query = User::where('id',$id)->update(['status'=>'active']);
            if($query){
                toast("account has been activated",'success');
            }else{
                toast("something went Wrong",'error');
            }
        }

        return redirect()->back();
    }
}
