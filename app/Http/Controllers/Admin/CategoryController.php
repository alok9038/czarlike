<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:manage_product','permission:categories','permission:category']);
        // $this->middleware();
    }
    public function viewCategories(){
        $data['categories'] = Category::all();
        return view('admin.products.categories',$data);
    }

    public function viewCreateCategory(){
        return view('admin.products.addCategory');
    }

    public function storeCategory(Request $request){
        $request->validate([
            'category'=>'required',
            'status'=>'required',
        ]);
        $status =  $request->status;

        if($request->has('image')){
            $image = time(). "." . $request->image->extension();
            $request->image->move(public_path("images/category"),$image);

        }else{
            $image = null;
        }
        $category = new Category();
        $category->title = $request->category;
        $category->description = $request->description;
        $category->status = $status;
        $category->image = $image;
        $category->position = (Category::count() + 1);
        $category->save();

        Alert::toast('Category Has Been Added!','success');
        return redirect()->route('super.admin.category.view');

    }

    public function updateCategory(Request $request){
        $request->validate([
            'category'=>'required',
        ]);
        $status =  $request->status;


        $category = Category::where('id',$request->category_id)->first();
        $category->title = $request->category;
        $category->description = $request->description;
        if($request->has('image')){
            $image = time(). "." . $request->image->extension();
            $request->image->move(public_path("images/category"),$image);
            $category->image = $image;
        }
        $category->position = (Category::count() + 1);
        $category->save();

        Alert::toast('Category Has Been Update!','success');
        return redirect()->route('super.admin.category.view');

    }

    public function deleteCategory(Request $request){
        $request->validate(['cat_id'=>'required']);

        $id = $request->cat_id;
        $delete = Category::where('id',$id)->delete();

        if($delete){
            Alert::toast('Category Has Been Deleted!','success');
            return redirect()->route('super.admin.category.view');
        }
        else{
            Alert::toast('Something went Wrong!','error');
            return redirect()->route('super.admin.category.view');
        }
    }

    public function changeStatus(Request $request){
        $id = $request->category_id;

        if($request->status == '1'){
            Category::where('id',$id)->update([
                'status'=>'0',
            ]);
            Alert::toast('Category successfully Deactivated!','success');
        }elseif($request->status == '0'){
            Category::where('id',$id)->update([
                'status'=>'1',
            ]);
            Alert::toast('Category successfully Deactivated!','success');
        }else{
            Alert::toast('Something Went Wrong!','error');
        }

        return redirect()->back();

    }

}
