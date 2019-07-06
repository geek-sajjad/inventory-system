<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuyingList extends Model
{
    protected $table = 'buying_list';

    public function product(){
        return $this->belongsTo('App\Product', 'product_id');
    }

    public function orderItem(){
        return $this->belongsTo('App\OrderItem', 'order_id', 'id');
    }
}
