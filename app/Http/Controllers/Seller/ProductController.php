<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductImages;
use App\Models\ProductSize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function viewProducts(){

        $data['products'] = Product::where('vender_id',Auth::id())->get();
        return view('seller.products.products',$data);
    }

    public function viewCreateProduct(){
        // if(Auth::user()->user_type === 'admin' && permissions()->products !== 1){
        //     return redirect()->back();
        // }
        return view('seller.products.add_product');
    }

    public function storeProduct(Request $request){
        $request->validate([
            'product_name'=>'required',
            'category'=>'required',
            // 'subcategory'=>'required',
            'price'=>'required',
            'offer_price'=>'required',
            'image'=>'required',
        ]);

        $slug = Str::slug($request->name,'-');

        $image = time(). "." . $request->image->extension();
        $request->image->move(public_path("images/products"),$image);

        $product = new Product();
        $product->name = $request->product_name;
        $product->brand_id = $request->brand;
        $product->category_id = $request->category;
        $product->sub_cat_id = $request->subcategory;
        $product->child_category_id = $request->childcategory;
        $product->store_id = $request->store;
        $product->key_features = $request->features;
        $product->description = $request->description;
        $product->type = $request->type;
        $product->duration = $request->duration;
        $product->duration_type = $request->duration_type;
        $product->model = $request->model;
        $product->tags = $request->tags;
        $product->sku = $request->sku;
        $product->slug = $slug;
        $product->price = $request->price;
        $product->offer_price = $request->offer_price;
        $product->free_shipping = $request->free_shipping;
        $product->cancel_avl = $request->cancel_avl;
        $product->return_avbl = $request->return_avl;
        $product->codcheck = $request->codcheck;
        $product->image = $image;
        $product->vender_id = Auth::id();
        if($request->size_check == 1 && $request->has('size')){
            $product->is_size_available = true;
        }
        if($request->color_check == 1 && $request->has('color')){
            $product->is_color_available = true;
        }
        $product->save();

        if($request->hasFile('multiple_images'))
        {
            $files = $request->multiple_images;

            foreach ($files as $photo) {
                $m_image = $photo->getClientOriginalName();
                // . "." . $photo->extension();
                $photo->move(public_path("images/products/multiple_images"),$m_image);

                ProductImages::create([
                    'product_id' =>$product->id,
                    'image' => $m_image
                ]);
            }
        }

        if($request->size_check == 1 && $request->has('size')){
            foreach ($request->size as $size) {
                ProductSize::create([
                    'size_id'=>$size,
                    'product_id'=>$product->id,
                    'status'=>true
                ]);
            }
        }
        // for color
        if($request->color_check == 1 && $request->has('color')){
            foreach ($request->color as $color) {
                ProductColor::create([
                    'color_id'=>$color,
                    'product_id'=>$product->id,
                    'status'=>true
                ]);
            }
        }

        Alert::toast('Product successfully Inserted!','success');

        return redirect()->route('seller.product.view');
    }

    public function viewEditProduct($id){
        $data['product'] = Product::where('id',$id)->first();
        return view('admin.products.edit_product',$data);
    }

    public function editProduct(Request $request){
        $request->validate([
            'product_name'=>'required',
            'category'=>'required',
            // 'subcategory'=>'required',
            'price'=>'required',
            'offer_price'=>'required',
        ]);


        $product = Product::where('id',$request->product_id)->first();
        $product->name = $request->product_name;
        $product->brand_id = $request->brand;
        $product->category_id = $request->category;
        $product->sub_cat_id = $request->subcategory;
        $product->child_category_id = $request->childcategory;
        $product->store_id = $request->store;
        $product->key_features = $request->features;
        $product->description = $request->description;
        $product->type = $request->type;
        $product->duration = $request->duration;
        $product->duration_type = $request->duration_type;
        $product->model = $request->model;
        $product->tags = $request->tags;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->offer_price = $request->offer_price;
        $product->free_shipping = $request->free_shipping;
        $product->featured = $request->featured;
        $product->status = $request->status;
        $product->cancel_avl = $request->cancel_avl;
        $product->return_avbl = $request->return_avl;
        $product->codcheck = $request->codcheck;
        if($request->hasFile('image')){
            $image = time(). "." . $request->image->extension();
            $request->image->move(public_path("images/products"),$image);
            $product->image = $image;
        }
        $product->save();

        if($request->hasFile('multiple_images'))
        {
            $files = $request->multiple_images;

            foreach ($files as $photo) {
                $m_image = $photo->getClientOriginalName();
                // . "." . $photo->extension();
                $photo->move(public_path("images/products/multiple_images"),$m_image);

                ProductImages::create([
                    'product_id' =>$product->id,
                    'image' => $m_image
                ]);
            }
        }

        return redirect()->back()->with('success_msg','image uploaded');

        Alert::toast('Product successfully Updated!','success');
        if(Auth::user()->user_type == 'seller'){
            return redirect()->route('seller.product.view');
        }
        return redirect()->route('super.admin.product.view');
    }

    public function changeStatus(Request $request){
        $id = $request->product_id;

        if($request->has('status')){
            if($request->status == 1){
                Product::where('id',$id)->update([
                    'status'=>0,
                ]);
                Alert::toast('Product successfully Deactivated!','success');
            }elseif($request->status == 0){
                Product::where('id',$id)->update([
                    'status'=>1,
                ]);
                Alert::toast('Product successfully Deactivated!','success');
            }else{
                Alert::toast('Something Went Wrong!','error');
            }
        }

        if($request->has('featured')){
            if($request->featured == 1){
                Product::where('id',$id)->update([
                    'featured'=>0,
                ]);
                Alert::toast('Product Removed From featured!','success');
            }elseif($request->featured == 0){
                Product::where('id',$id)->update([
                    'featured'=>1,
                ]);
                Alert::toast('Product Added to Featured !','success');
            }else{
                Alert::toast('Something Went Wrong!','error');
            }
        }

        return redirect()->back();
    }
}
