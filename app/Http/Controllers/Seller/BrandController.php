<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class BrandController extends Controller
{
    public function viewBrands(){
        $data['brands'] = Brand::where('user_id',Auth::id())->get();
        return view('seller.products.brands',$data);
    }

    public function viewCreateBrand(){
        return view('seller.products.add_brand');
    }

    public function createBrand(Request $request){
        $request->validate([
            'brand_name'=>'required',
            'brand_logo'=>'required',
            'category'=>'required',
        ]);

        if($request->hasFile('brand_logo')){
            $brand_logo = rand(12,34353).'_'.time(). "." . $request->brand_logo->extension();
            $request->brand_logo->move(public_path("images/brand/"),$brand_logo);
        }else{
            $path = public_path('images/brand/');
            $fontPath = public_path('fonts/Oliciy.ttf');
            $char = strtoupper($request->brand_name[0]);
            $newAvatarName = rand(12,34353).time().'_brand.png';
            $dest = $path.$newAvatarName;

            $createAvatar = makeAvatar($fontPath,$dest,$char);
            $brand_logo = $createAvatar == true ? $newAvatarName : '';
        }

        $brand = new Brand();
        $brand->brand_name = $request->brand_name;
        $brand->brand_logo = $brand_logo;
        $brand->user_id = Auth::id();
        $brand->category = $request->category;
        $brand->is_requested = 1;
        $brand->save();

        if($brand){
            Alert::toast('Brand has been Inserted!', 'success');
            return redirect()->route('seller.brand.view');
        }else{
            Alert::toast('Something Went Wrong!', 'error');
            return redirect()->back();

        }
    }
}
