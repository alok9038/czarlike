<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ChildCategory;
use App\Models\Variant;
use App\Models\Contact;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class HomeController extends Controller
{
    public function index(){
        $data['products'] = Product::where([['status',1],['deals_of_the_day',0]])->limit(8)->orderBy('created_at','desc')->get();
        $data['featureds'] = Product::where([['status',1],['featured',1]])->limit(16)->get();
        $data['dealsoftheday'] = Product::where([['status',1],['deals_of_the_day',1]])->limit(4)->get();
        return view('home.index',$data);
    }

    public function viewProduct($slug){
        if($_GET['pid'] == null){
            return redirect()->back();
        }
        $id = Crypt::decrypt($_GET['pid']);
        $product = $data['product'] = Product::where('id',$id)->first();

        $data['socialShare'] = \Share::page(
            'https://czarlike.com/product/'.$data['product']->slug.'?pid='.$_GET['pid'],

            "$product->name",

            ['class' => ' text-secondary', 'title' => "$product->name",'id'=>'sharebtn']

        )

        ->facebook()
        ->twitter()
        ->reddit()
        ->linkedin()
        ->whatsapp()
        ->telegram();


        return view('home.product_view',$data);
    }

    public function products(Request $request){
        $id = $request->cat_id;
        $sub_cat_id = $request->sub_cat_id;
        if($request->has('cat_id')){
            $data['url_cat'] = Category::where('id',$request->cat_id)->first();
            $data['products'] = Product::where([['category_id',$id],['status',1]])->paginate(9);
        }
        elseif($request->has('sub_cat_id')){
            $data['url_cat'] = SubCategory::where('id',$request->sub_cat_id)->first();
            $data['products'] = Product::where([['sub_cat_id',$sub_cat_id],['status',1]])->paginate(9);
        }
        elseif($request->has('child_cat_id')){
            $data['url_cat'] = ChildCategory::where('id',$request->child_cat_id)->first();
            $data['products'] = Product::where([['child_category_id',$request->child_cat_id],['status',1]])->paginate(9);
        }
        elseif($request->has('search')){
            $data['products'] = Product::where([['name','LIKE',"%$request->search%"],['status',1]])->paginate(9);
        }
        elseif($request->has('brand')){
            $data['products'] = Product::where([['brand_id',($request->brand/987654321)],['status',1]])->paginate(9);
        }
        elseif($request->has('sort')){
            if($request->sort == "low_to_high"){
                $data['products'] = Product::where('status',1)->orderBy('offer_price', 'asc')->paginate(9);
            }
            elseif($request->sort == "high_to_low"){
                $data['products'] = Product::where('status',1)->orderBy('offer_price','desc')->paginate(9);
            }
            elseif($request->sort == "newest"){
                $data['products'] = Product::where('status',1)->orderBy('created_at','desc')->paginate(9);
            }
            else{
                $data['products'] = Product::where('status',1)->paginate(9);
            }
        }
        else{
            $data['products'] = Product::where('status',1)->paginate(9);
        }
        return view('home.products',$data);
    }

    public function contact_us(Request $request){
        $request->validate([
            'name'=>'required',
            'phone'=>'required',
            'email'=>'required',
            'message'=>'required'
        ]);

        $contact = new Contact();
        $contact->name = $request->name;
        $contact->phone = $request->phone;
        $contact->email = $request->email;
        $contact->message = $request->message;
        $contact->save();

        toast('Thank you for contacting us we will reach you soon!','success');
        return redirect()->back();
    }
    
    
      public function variant_view(Request $request){
        $variant_id =  $request->variant_id/18841884;
        $product_id =  $request->product_id/92119211;

        $product = $data['product'] = Product::where('id',$product_id)->first();

        if($request->has('size')){
            $data['variant'] = Variant::where([['product_id',$product_id],['size',$request->size/921118849038]])->orwhere('id',$variant_id)->get();
        }
        elseif($request->has('storage')){
            $data['variant'] = Variant::where([['product_id',$product_id],['ram_rom',$request->storage/921118849038]])->orwhere('id',$variant_id)->get();
        }

        $data['socialShare'] = \Share::page(
            'https://czarlike.com/products-variants?slug='.$product->slug.'&product_id='.$request->product_id.'&size='.$request->size.'&variant_id='.$request->variant_id,

            "$product->name",

            ['class' => ' text-secondary', 'title' => "$product->name",'id'=>'sharebtn']

        )

        ->facebook()
        ->twitter()
        ->reddit()
        ->linkedin()
        ->whatsapp()
        ->telegram();
        // echo $data['variant']->size;
        // die;
        // $data['colors'] = Variant::where([['product_id',$product_id],['size',$data['variant']->size]])->get();
        return view('home.variant_view',$data);
    }
}
