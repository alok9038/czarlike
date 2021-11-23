<?php

use App\Models\Category;
use App\Models\SubCategory;

if(!function_exists('categories')){
    function categories($limit = null){
        if($limit !== null){
            return Category::where('status','=','1')->limit($limit)->get();
        }
        else{
            return Category::where('status','=','1')->get();
        }
    }
}


if(!function_exists('all_categories')){
    function all_categories(){
        return Category::get();
    }
}


if(!function_exists('Subcategories')){
    function subcategories($id){
        return SubCategory::where('parent_cat',$id)->get();
    }
}

if(!function_exists('allSubcategories')){
    function allSubcategories(){
        return SubCategory::get();
    }
}

?>
