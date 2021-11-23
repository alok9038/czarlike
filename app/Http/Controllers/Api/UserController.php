<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function wishlist(Request $request){
        $id = $request->user()->id;
        $data['wishlist'] = Wishlist::where('user_id',$id)->with('product')->get();
        return response()->json($data);
    }

    public function addWishlist(Request $request){
        $validator = Validator::make($request->all(),[
            'product_id'=>'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }

        $user = $request->user()->id;
        $product_id = $request->product_id;

        $check = Wishlist::where([['user_id',$user],['product_id',$product_id]])->count();
        if($check > 0){
            return response()->json(['message'=>'Product Already in Your Wishlist!'],200);
        }
        else{
            $wishlist = new Wishlist();
            $wishlist->product_id = $request->product_id;
            $wishlist->user_id = $user;
            $wishlist->save();

            return response()->json(['message'=>'Product added to wishlist'],200);

        }

        return response()->json(['message'=>'Something went wrong'],401);

    }

    public function removeWishlist(Request $request){
        $validator = Validator::make($request->all(),[
            'wishlist_id'=>'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }

        $id = $request->wishlist_id;
        $query = Wishlist::where([['user_id',$request->user()->id],['id',$id]])->delete();

        if($query){
            return response()->json(['message'=>'Product remove from wishlist'],200);
        }
        else{
            return response()->json(['message'=>'Something went wrong'],401);

        }
    }
}
