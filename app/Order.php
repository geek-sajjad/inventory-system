<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
//    protected $fillable = ['name'];

    public function product(){
        return $this->hasOne('App\Product', 'id','product_id');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function orderItems(){
        return $this->hasMany('App\OrderItem');
    }

//    public function closeOrder(){
//        return $this->orderItems->where('status', 'Approved')->where('status', 'Canceled')->first();
//        if(!($this->status == 'close')){
//            $this->status = 'close'; // close
//            $this->save();
//            return true;
//        }
//        return false;
//    }
//
//    public function openOrder(){
//        if(!($this->status == 'open')){
//            $this->status = 'open'; // open
//            $this->save();
//            return true;
//        }
//        return false;
//    }



}
