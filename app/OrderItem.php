<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'product_id',
        'qty',
    ];
    public function product(){
        return $this->belongsTo('App\Product', 'product_id');
    }
}
