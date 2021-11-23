<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChildCategory;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ChildCategoryController extends Controller
{
        // child category functions

        public function fetchChildcat(Request $request){
            $subcat_id = $request->subcat_id;
            $data['childcats'] = ChildCategory::where([['parent_sub_cat',$subcat_id],['status','!=',0]])->get();

            return response()->json($data);
        }

        public function viewChildCategories(){
            $data['childcategories'] = ChildCategory::all();
            return view('admin.products.childCategories',$data);
        }

        public function viewChildCreateCategory(){
            return view('admin.products.addChildCategory');
        }

        public function storeChildCategory(Request $request){
            $request->validate([
                'category'=>'required',
                'sub_category'=>'required',
                'childcategory'=>'required',
                'status'=>'required',
            ]);
            $status =  $request->status;

            if($request->has('image')){
                $image = time(). "." . $request->image->extension();
                $request->image->move(public_path("images/category"),$image);

            }else{
                $image = null;
            }
            $category = new ChildCategory();
            $category->title = $request->childcategory;
            $category->parent_cat = $request->category;
            $category->parent_sub_cat = $request->sub_category;
            $category->description = $request->description;
            $category->status = $status;
            $category->image = $image;
            $category->position = (ChildCategory::count() + 1);
            $category->save();

            Alert::toast('ChildCategory Has Been Added!','success');
            return redirect()->route('super.admin.child.category.view');

        }

        public function updateChildCategory(Request $request){
            $request->validate([
                'category'=>'required',
                'sub_category'=>'required',
                'childcategory'=>'required',
            ]);

            $category = ChildCategory::find($request->child_cat_id);
            $category->title = $request->childcategory;
            $category->parent_cat = $request->category;
            $category->parent_sub_cat = $request->sub_category;
            $category->description = $request->description;
            if($request->has('image')){
                $image = time(). "." . $request->image->extension();
                $request->image->move(public_path("images/category"),$image);
                $category->image = $image;
            }
            $category->save();

            Alert::toast('ChildCategory Has Been Added!','success');
            return redirect()->route('super.admin.child.category.view');

        }

        public function deleteChildCategory(Request $request){
            $request->validate(['child_cat_id'=>'required']);

            $id = $request->cat_id;
            $delete = ChildCategory::where('id',$id)->delete();

            if($delete){
                Alert::toast('Child Category Has Been Deleted!','success');
                return redirect()->route('super.admin.child.category.view');
            }
            else{
                Alert::toast('Something went Wrong!','error');
                return redirect()->route('super.admin.child.category.view');
            }
        }

        public function changeStatus(Request $request){
            $id = $request->child_category_id;

            if($request->status == '1'){
                ChildCategory::where('id',$id)->update([
                    'status'=>'0',
                ]);
                Alert::toast('Childcategory successfully Deactivated!','success');
            }elseif($request->status == '0'){
                ChildCategory::where('id',$id)->update([
                    'status'=>'1',
                ]);
                Alert::toast('Childcategory successfully activated!','success');
            }else{
                Alert::toast('Something Went Wrong!','error');
            }

            return redirect()->back();

        }
}
