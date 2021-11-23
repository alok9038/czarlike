<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MainController extends Controller
{
    public function categories(){
        // $data['categories'] = Category::where('status','1')->select('id','title')->with('subcategories','subcategories.childcat')->get();
        $data['categories'] = Category::where('status','1')->select('id','title')->with(
            array('subcategories' => function($query) {
                $query->select('id','title','parent_cat')->with(
                    array('childcat' => function($query){
                        $query->select('id','title','parent_cat','parent_sub_cat');
                    })
                );
            })
        )->get();

        return response()->json($data,200);
    }

    public function featured_products(){
        $data['featureds'] = Product::where([['status',1],['featured',1]])->select('id','name','category_id','image','price','offer_price')->
        with(array('product_cat' => function($query) {
            $query->select('id','title');
        }))
        ->get();
    
        return response()->json($data);
    }

    public function products(){
        $data['products'] = Product::where('status',1)->select('id','name','category_id','image','price','offer_price')->
        with(array('product_cat' => function($query) {
            $query->select('id','title');
        }))
        ->get();

        return response()->json($data);
    }

    public function deal_of_the_day(){
        $data['dealsoftheday'] = Product::where([['status',1],['deals_of_the_day',1]])->select('id','name','category_id','image','price','offer_price')->
        with(array('product_cat' => function($query) {
            $query->select('id','title');
        }))->get();

        return response()->json($data);

    }

    public function product(Request $request){
        $validator = Validator::make($request->all(),[
            'product_id'=>'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }

        $data['product'] = Product::where('id',$request->product_id)
        ->with(
            array('product_cat' => function($query) {
                $query->select('id','title');
            })
        )
        ->with(
            array('product_brand' => function($query) {
                $query->select('id','brand_name');
            })
        )
        ->with(
            array('store' => function($query) {
                $query->select('id','store_name');
            })
        )
        ->with(
            array('seller' => function($query) {
                $query->select('id','user_name');
            })
        )
        ->with(
            array('coupons' => function($query) {
                $query->select('id','code','amount','product_id','min_amount');
            })
        )
        ->with(
            array('variants' => function($query) {
                $query->select('*')
                ->with(
                    array('vSize' => function($query){
                        $query->select('id','size');
                    })
                )
                ->with(
                    array('vColor' => function($query){
                        $query->select('id','color','color_name');
                    })
                )
                ->with(
                    array('vStorage' => function($query){
                        $query->select('id','ram','storage');
                    })
                )
                ->with(
                    array('Images' => function($query){
                        $query->select('*');
                    })
                );
            })
        )
        ->with(
            array('ratings' => function($query) {
                $query->select('*');
            })
        )
        ->first();

        return response()->json($data,200);
    }
    
    // related products
    public function related_products(Request $request){
        $product_id = $request->product_id;
        $cat_id = $request->cat_id;

        $data['related_products'] = Product::where([['status',1],['id','!=',$product_id],['category_id',$cat_id]])->select('id','name','category_id','image','price','offer_price')->
        with(array('product_cat' => function($query) {
            $query->select('id','title');
        }))
        ->get();

        return response()->json($data);
    }

}
