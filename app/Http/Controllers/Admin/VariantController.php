<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImages;
use App\Models\Storage;
use App\Models\Variant;
use Illuminate\Http\Request;

class VariantController extends Controller
{
    public function variants($id){
        $data['variants'] = Variant::where('product_id',$id)->get();
        return view('admin.products.variant.variants',$data);
    }

    public function addVariants($id){
        $data['product'] = Product::where('id',$id)->first();
        $data['ram_rom'] = Storage::where('status',true)->get();
        return view('admin.products.variant.add_variants',$data);
    }

    public function storeVariant(Request $request){
        $request->validate([
            'sku'=>'required',
        ]);
        $variant = new Variant();
        $variant->sku = $request->sku;
        $variant->mrp = $request->mrp;
        $variant->price = $request->price;
        $variant->product_id = $request->product_id;
        $variant->qty = $request->qty;
        $variant->color = $request->color;
        $variant->ram_rom = $request->ram_rom;
        $variant->size = $request->size;
        $variant->features = $request->features;
        $variant->description = $request->description;
        $variant->save();

        if($request->hasFile('multiple_images'))
        {
            $files = $request->multiple_images;

            foreach ($files as $photo) {
                // $m_image = $photo->getClientOriginalName();
                $m_image = time()."_".rand(). "." . $photo->extension();
                // . "." . $photo->extension();
                $photo->move(public_path("images/products/variants/"),$m_image);

                ProductImages::create([
                    'variant_id' =>$variant->id,
                    'product_id' =>$request->product_id,
                    'image' => $m_image
                ]);
            }
        }

        if($variant){
            toast('Variant successfully added','success');
        }
        else{
            toast('Something went wrong','error');
        }

        return redirect()->route('super.admin.product.variant.view',['variant_id'=>$request->product_id]);

    }

    public function editVariants($id, $v_id){
        $data['ram_rom'] = Storage::where('status',true)->get();

        $data['product'] = Product::where('id',$id)->first();
        $data['variant'] = Variant::where('id',$v_id)->first();
        return view('admin.products.variant.edit_variants',$data);
    }

    public function updateVariant(Request $request){
        $request->validate([
            'sku'=>'required',
        ]);

        $variant = Variant::find($request->variant_id);
        $variant->sku = $request->sku;
        $variant->mrp = $request->mrp;
        $variant->price = $request->price;
        $variant->qty = $request->qty;
        $variant->color = $request->color;
        $variant->ram_rom = $request->ram_rom;
        $variant->size = $request->size;
        $variant->features = $request->features;
        $variant->description = $request->description;
        $variant->save();

        if($request->hasFile('multiple_images'))
        {
            $files = $request->multiple_images;

            foreach ($files as $photo) {
                // $m_image = $photo->getClientOriginalName();
                $m_image = time()."_".rand(). "." . $photo->extension();
                // . "." . $photo->extension();
                $photo->move(public_path("images/products/variants/"),$m_image);

                ProductImages::where('variant_id',$variant->id)->update([
                    'product_id' =>$request->product_id,
                    'image' => $m_image
                ]);
            }
        }

        if($variant){
            toast('Variant successfully udpated','success');
        }
        else{
            toast('Something went wrong','error');
        }

        return redirect()->route('super.admin.product.variant.view',['variant_id'=>$variant->product_id]);

    }

    public function deleteVariant(Request $request){
        $id = $request->variant_id;

        $query = Variant::where('id',$id)->delete();

        $query2 = ProductImages::where('variant_id',$id)->delete();

        if($query && $query2 ){
            toast('Variant successfully deleted','success');
        }
        else{
            toast('Something went wront','error');
        }

        return redirect()->back();
    }

    public function stockStatus(Request $request){
        $status = $request->s_status;

        if($status == 1){
            $v = Variant::where('id',$request->variant_id)->update(['stock_status'=>0]);
        }
        else{
            $v = Variant::where('id',$request->variant_id)->update(['stock_status'=>1]);
        }

        toast('Stock data Updated','success');
        return redirect()->back();
    }
}
