<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function category(){
        return $this->belongsTo(\App\ProductCategory::class);
    }

    public function images(){
        return $this->hasMany(\App\ProductImage::class);
    }
}
