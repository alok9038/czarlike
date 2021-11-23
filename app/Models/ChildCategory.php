<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildCategory extends Model
{
    use HasFactory;

    public function cat(){
    	return $this->belongsTo('App\Models\Category','parent_cat','id');
    }

    public function subcat(){
    	return $this->belongsTo('App\Models\SubCategory','parent_sub_cat','id');
    }
}
