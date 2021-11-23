<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:manage_product','permission:brand']);
        // $this->middleware();
    }
    public function viewBrands(){
        $data['brands'] = Brand::all();
        return view('admin.products.brands',$data);
    }

    public function viewCreateBrand(){
        return view('admin.products.addBrand');
    }

    public function createBrand(Request $request){
        $request->validate([
            'brand_name'=>'required',
            // 'brand_logo'=>'required',
            'category'=>'required',
        ]);

        if($request->hasFile('brand_logo')){
            $brand_logo = rand(12,34353).'_'.time(). "." . $request->brand_logo->extension();
            $request->brand_logo->move(public_path("images/brand/"),$brand_logo);
        }
        else{
            $brand_logo = null;
        }

        $brand = new Brand();
        $brand->brand_name = $request->brand_name;
        $brand->brand_logo = $brand_logo;
        $brand->category = $request->category;
        $brand->status = $request->status;
        $brand->save();

        if($brand){
            Alert::toast('Brand has been Inserted!', 'success');
            return redirect()->route('super.admin.brand.view');
        }else{
            Alert::toast('Something Went Wrong!', 'error');
            return redirect()->back();

        }
    }

    public function deleteBrand(Request $request){
        $query = Brand::where('id',$request->brand_id)->delete();

        if($query){
            Alert::toast('Brand has been deleted!', 'success');
            return redirect()->route('super.admin.brand.view');
        }else{
            Alert::toast('Something Went Wrong!', 'error');
            return redirect()->back();

        }
    }

    public function updateBrand(Request $request){
        $request->validate([
            'brand_name'=>'required',
        ]);

        $brand = Brand::find($request->brand_id);
        $brand->brand_name = $request->brand_name;

        if($request->hasFile('brand_logo')){
            $brand_logo = rand(12,34353).'_'.time(). "." . $request->brand_logo->extension();
            $request->brand_logo->move(public_path("images/brand/"),$brand_logo);
            $brand->brand_logo = $brand_logo;
        }
        $brand->status = $request->status;
        $brand->category = $request->category;
        $brand->save();

        if($brand){
            Alert::toast('Brand has been Updated!', 'success');
            return redirect()->route('super.admin.brand.view');
        }else{
            Alert::toast('Something Went Wrong!', 'error');
            return redirect()->back();

        }
    }

    public function changeStatus(Request $request){
        $id = $request->category_id;

        if($request->status == '1'){
            Brand::where('id',$id)->update([
                'status'=>'deactive',
            ]);
            Alert::toast('Brand successfully Deactivated!','success');
        }elseif($request->status == '0'){
            Brand::where('id',$id)->update([
                'status'=>'active',
            ]);
            Alert::toast('Brand successfully Deactivated!','success');
        }else{
            Alert::toast('Something Went Wrong!','error');
        }

        return redirect()->back();

    }
}
