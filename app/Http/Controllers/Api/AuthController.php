<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    function register(Request $request){
        $validator = Validator::make($request->all(),[
            'user_name'=>'required',
            'password'=>'required',
            'country_id'=>'required',
            'state_id'=>'required',
            'city_id'=>'required',
            'phone'=>'required|digits:10',
            'email'=>'required|email|unique:users',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }

        $email = $request->email;
        $check = User::where('email',$email)->count();

        if($check > 0){
            return response()->json(['message'=>"user already exists!"]);
        }else{
            $user = new User;
            $user->user_name = $request->input('user_name');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $user->password = Hash::make($request->input('password'));
            $user->country_id = $request->input('country_id');
            $user->state_id = $request->input('state_id');
            $user->city_id = $request->input('city_id');
            $user->website = $request->input('website');
            $user->save();

            if($user){
                $token = $user->createToken('my-app-token')->plainTextToken;
                return response()->json([
                    'message'=>"user successfully Register!",
                    'token' => $token,
                    'user'=>$user
                ],200);
            }
        }

    }

    function login(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email'=>'required',
            'password'=>'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }

        $user= User::where('email', $request->email)->first();
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response([
                    'message' => ['These credentials do not match our records.']
                ], 404);
            }

            $token = $user->createToken('my-app-token')->plainTextToken;

            return response()->json(['token'=>$token, 'message'=>'login Successfully','user'=>$user],200);
    }

    function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message'=>'logout successfully!'],200);
    }

}
