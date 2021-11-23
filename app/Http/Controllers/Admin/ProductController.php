<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductImages;
use App\Models\ProductSize;
use App\Models\Size;
use App\Models\Store;
use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:manage_product');
        // $this->middleware();
    }
    public function viewProducts(){
        if(Auth::user()->user_type === 'admin' && permissions()->products !== 1){
            return redirect()->back();
        }
        if(Auth::user()->user_type == 'superAdmin'){
            $data['products'] = Product::all();
        }else{
            $data['products'] = Product::where('vender_id',Auth::id())->get();
        }
        return view('admin.products.products',$data);
    }

    public function viewCreateProduct(){
        if(Auth::user()->user_type === 'admin' && permissions()->products !== 1){
            return redirect()->back();
        }
        return view('admin.products.addProduct');
    }

    public function storeProduct(Request $request){
        $request->validate([
            'product_name'=>'required',
            'category'=>'required',
            'price'=>'required',
            'offer_price'=>'required',
            'image'=>'required',
        ]);

        // die;
        $slug = Str::slug($request->product_name,'-');

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
        $product->featured = $request->featured;
        $product->status = $request->status;
        $product->cancel_avl = $request->cancel_avl;
        $product->return_avbl = $request->return_avl;
        $product->codcheck = $request->codcheck;
        $product->deals_of_the_day = $request->deals_of_the_day;
        if($request->deals_of_the_day){
            $product->dealstime = $request->dealstime;
        }
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

        // size insertion
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

        return redirect()->route('super.admin.product.view');
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

        $product_id = $request->product_id;

        $slug = Str::slug($request->product_name,'-');

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
        $product->slug = $slug;
        $product->offer_price = $request->offer_price;
        $product->free_shipping = $request->free_shipping;
        $product->featured = $request->featured;
        $product->status = $request->status;
        $product->cancel_avl = $request->cancel_avl;
        $product->return_avbl = $request->return_avl;
        $product->codcheck = $request->codcheck;
        $product->deals_of_the_day = $request->deals_of_the_day;
        if($request->size_check == 1 && $request->has('size')){
            $product->is_size_available = true;
        }
        if($request->color_check == 1 && $request->has('color')){
            $product->is_color_available = true;
        }
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

        // size insertion
        if($request->color_check == 1 && $request->has('color')){
            $color = $request->color;

            $check = ProductColor::whereIn('color_id',$color)->where('product_id',$product_id)->get();
            foreach($check as $c){
                $color = array_diff($color,[$c->color_id]);
            }
            foreach ($color as $cl) {
                ProductColor::create([
                    'color_id'=>$cl,
                    'product_id'=>$request->product_id,
                    'status'=>true
                ]);
            }
        }

        if($request->size_check == 1 && $request->has('size')){
            $size = $request->size;

            $s_check = ProductSize::whereIn('size_id',$request->size)->where('product_id',$product_id)->get();
            foreach($s_check as $sc){
                $size = array_diff($size,[$sc->size_id]);
            }
            foreach ($size as $sz) {
                ProductSize::create([
                    'size_id'=>$sz,
                    'product_id'=>$product->id,
                    'status'=>true
                ]);
            }
        }
        // for color



        Alert::toast('Product successfully Updated!','success');
        // if(Auth::user()->user_type == 'seller'){
        //     return redirect()->route('seller.product.view');
        // }
        return redirect()->route('super.admin.product.view');
    }
    
    public function deleteProduct(Request $request){
        $query = Product::where('id',$request->product_id)->delete();

        if($query){
            Alert::toast('Product has been deleted!', 'success');
            return redirect()->route('super.admin.product.view');
        }else{
            Alert::toast('Something Went Wrong!', 'error');
            return redirect()->back();

        }
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
    public function variant_add(Request $request){

        $delete_variant = $request->delete_variant;

        if($delete_variant > 0){
            foreach($delete_variant as $dv){
                Variant::where('id',$dv)->delete();
            }
        }

        $pid = $request->product_id;
        $variant_id=$request->post('variant_id');
        $skuArr=$request->post('sku');
        $mrpArr=$request->post('mrp');
        $priceArr=$request->post('price');
        $qtyArr=$request->post('qty');
        $size_idArr=$request->post('size');
        $color_idArr=$request->post('color');
        if($skuArr < 1){
            return redirect()->back();
        }
        foreach($skuArr as $key=>$val){
            $productAttrArr['product_id']=$pid;
            $productAttrArr['sku']=$skuArr[$key];
            $productAttrArr['mrp']=$mrpArr[$key];
            $productAttrArr['price']=$priceArr[$key];
            $productAttrArr['qty']=$qtyArr[$key];

            if($size_idArr[$key]==''){
                $productAttrArr['size']=0;
            }else{
                $productAttrArr['size']=$size_idArr[$key];
            }

            if($color_idArr[$key]==''){
                $productAttrArr['color']=0;
            }else{
                $productAttrArr['color']=$color_idArr[$key];
            }

            // if($request->hasFile("image.$key")){
            //     $v_image = $request->file("image.$key");

            //     $image = time(). "." . $v_image->extension();
            //     $v_image->move(public_path("images/products/variants/"),$image);
            //     $productAttrArr['image'] = $image;
            // }else{
            //     $productAttrArr['image'] = "";
            // }


            if($variant_id[$key]!=''){
                Variant::where(['id'=>$variant_id[$key]])->update($productAttrArr);
                toast("Product variant updated!",'success');
            }else{
                Variant::insert($productAttrArr);
                toast("Product new variant Inserted!",'success');
            }
        }

        return redirect()->back();

    }
}
