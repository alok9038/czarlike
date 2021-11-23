<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    use HasFactory;

    public function product(){
        return $this->hasOne(Product::class,'id','product_id');
    }
    public function vSize(){
        return $this->hasOne(Size::class,'id','size')->where('status',true);
    }
    public function vColor(){
        return $this->hasOne(Color::class,'id','color')->where('status',true);
    }
    public function vStorage(){
        return $this->hasOne(Storage::class,'id','ram_rom');
    }
    public function Images(){
        return $this->hasMany(ProductImages::class,'variant_id','id');
    }
}
