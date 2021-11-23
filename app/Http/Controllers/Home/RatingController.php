<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Rating;
use App\Models\ReviewImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;

class RatingController extends Controller
{

    public function review($slug, $id){
        $p_id = Crypt::decryptString($id);
        $user_id = Auth::id();

        $data['rating'] = Rating::where([['product_id',$p_id],['user_id',$user_id]])->first();;
        $data['order'] = Cart::where([['product_id',$p_id],['user_id',$user_id],['ordered',true]])->get();
        $data['product'] = Product::where('id',$p_id)->first();
        return view('home.review_rating',$data);
    }
    public function review_rating(Request $request){
        $request->validate([
            'rating'=> 'required',
            'description'=> 'required',
        ]);
        $user_id = Auth::id();
        $product_id = $request->product_id;

        $rating = new Rating;
        $rating->ratings = $request->rating;
        $rating->review_title = $request->title;
        $rating->body = $request->description;
        $rating->product_id = $product_id;
        $rating->user_id = $user_id;
        $rating->save();

        if($request->hasFile('review_image')){
            $files = $request->review_image;

            foreach ($files as $photo) {
                $m_image = $photo->getClientOriginalName();
                // . "." . $photo->extension();
                $photo->move(public_path("images/review_images"),$m_image);

                ReviewImage::create([
                    'rating_id' =>$rating->id,
                    'image' => $m_image
                ]);
            }
        }

        Alert::toast('Thank you so much. Your review has been saved', 'success');
        return redirect()->route('homepage');

    }
    public function review_rating_update(Request $request){
        $user_id = Auth::id();
        $product_id = $request->product_id;

        Rating::where([['product_id',$product_id],['user_id',$user_id]])->update([
        'ratings' => $request->rating,
        'review_title' => $request->title,
        'body' => $request->description,
        'product_id' => $product_id,
        'user_id' => $user_id
        ]);


        Alert::toast('Thank you so much. Your review has been saved', 'success');
        return redirect()->back();

    }
}
