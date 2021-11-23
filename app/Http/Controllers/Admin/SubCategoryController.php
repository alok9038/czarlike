<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SubCategoryController extends Controller
{
        // subcategories fuctions

        public function fetchSubcat(Request $request){
            $cat_id = $request->cat_id;
            $data['subcats'] = SubCategory::where([['parent_cat',$cat_id],['status','!=',0]])->get();

            return response()->json($data);
        }

        public function viewSubCategories(){
            $data['subcategories'] = SubCategory::all();
            return view('admin.products.subcategories',$data);
        }

        public function viewSubCreateCategory(){
            return view('admin.products.addsubCategory');
        }

        public function storeSubCategory(Request $request){
            $request->validate([
                'category'=>'required',
                'subcategory'=>'required',
            ]);


            $status =  $request->status;

            if($request->has('image')){
                $image = time(). "." . $request->image->extension();
                $request->image->move(public_path("images/category"),$image);

            }else{
                $image = null;
            }
            $category = new SubCategory();
            $category->title = $request->subcategory;
            $category->parent_cat = $request->category;
            $category->description = $request->description;
            $category->status = $status;
            $category->image = $image;
            $category->position = (SubCategory::count() + 1);
            $category->save();

            Alert::toast('Sub Category Has Been Added!','success');
            return redirect()->route('super.admin.subcategory.view');

        }

        public function updateSubCategory(Request $request){
            $request->validate([
                'parent_cat'=>'required',
                'subcategory'=>'required',
            ]);


            $category = SubCategory::where('id',$request->sub_cat_id)->first();
            $category->title = $request->subcategory;
            $category->parent_cat = $request->parent_cat;
            $category->description = $request->description;
            if($request->has('image')){
                $image = time(). "." . $request->image->extension();
                $request->image->move(public_path("images/category"),$image);
                $category->image = $image;
            }
            $category->position = (SubCategory::count() + 1);
            $category->save();

            Alert::toast('SubCategory Has Been updated!','success');
            return redirect()->route('super.admin.subcategory.view');

        }

        public function changeStatus(Request $request){
            $id = $request->sub_category_id;

            if($request->status == '1'){
                SubCategory::where('id',$id)->update([
                    'status'=>'0',
                ]);
                Alert::toast('SubCategory successfully Deactivated!','success');
            }elseif($request->status == '0'){
                SubCategory::where('id',$id)->update([
                    'status'=>'1',
                ]);
                Alert::toast('SubCategory successfully Deactivated!','success');
            }else{
                Alert::toast('Something Went Wrong!','error');
            }

            return redirect()->back();

        }

        public function deleteSubCategory(Request $request){
            $request->validate(['cat_id'=>'required']);

            $id = $request->cat_id;
            $delete = SubCategory::where('id',$id)->delete();

            if($delete){
                Alert::toast('SubCategory Has Been Deleted!','success');
                return redirect()->route('super.admin.subcategory.view');
            }
            else{
                Alert::toast('Something went Wrong!','error');
                return redirect()->route('super.admin.subcategory.view');
            }
        }
}
