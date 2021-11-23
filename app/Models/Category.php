<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function sub_cat(){
    	return $this->hasOne('App\Models\SubCategory','parent_cat','id');
    }
    
    public function subcategories(){
    	return $this->hasMany('App\Models\SubCategory','parent_cat','id');
    }
    
    public function products(){
        return $this->hasMany(Product::class,'category_id','id');
    }
}
