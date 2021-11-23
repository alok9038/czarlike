<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    public function storeOwner(){
        return $this->hasOne('App\Models\User','id','store_owner');
    }
}
