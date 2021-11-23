<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\UserRegister;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function home(){
        $data['users'] = User::where('user_type','!=','super_admin')->get();
        $data['categories'] = Category::get();
        $data['products'] = Product::get();
        return view('admin.home',$data);
    }

    public function mail(){
        $details = [
            'email' =>'kumaralok1884@gmail.com',
            'name' => 'Yo yo ',
            'password'=> "123123",
        ];

        $mail = Mail::to('kumaralok1884@gmail.com')->send(new UserRegister($details));
        if($mail){

            return "email sent";
        }
    }
}
