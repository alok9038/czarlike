<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    public function cat(){
    	return $this->belongsTo('App\Models\Category','parent_cat','id');
    }
    
    public function childcat(){
        return $this->hasMany(ChildCategory::class,'parent_sub_cat','id');
    }
    
    public function category(){
        return $this->hasOne(Category::class,'id','parent_cat');
    }
}
