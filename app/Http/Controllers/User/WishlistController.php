<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function view(){
        return view('home.wishlist');
    }

    public function add(Request $request){
        $user = Auth::id();
        $product_id = $request->product_id;

        $check = Wishlist::where([['user_id',$user],['product_id',$product_id]])->count();
        if($check > 0){
            toast('Product Already in Your Wishlist!','info');
            return redirect()->back();
        }
        else{
            $wishlist = new Wishlist();
            $wishlist->product_id = $request->product_id;
            $wishlist->user_id = $user;
            $wishlist->save();

            toast('Product added to Wishlist!','success');
            return redirect()->back();

        }

        toast('something went wrong!','error');
        return redirect()->back();
    }

    public function remove(Request $request){
        $id = $request->wishlist_id;

        $query = Wishlist::where([['user_id',Auth::id()],['id',$id]])->delete();

        if($query){
            toast('Removed from Wishlist','success');
            return redirect()->back();
        }
        else{
            toast('Something Went Wrong','error');
            return redirect()->back();

        }
    }
}
