<?php

namespace App\Http\Controllers\api;

use App\Http\Resources\OrderResource;
use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use mysql_xdevapi\Collection;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function index(){

        $user =  auth()->user();
        $orders =  $user->orders;

        return OrderResource::collection($orders);

    }

    public function create(Request $request){
//        return $request->all();


        $order = auth()->user()->orders()->create([]);
        $order->orderItems()->createMany($request->all());



//        $order->orderItems()->createMany([
//            [
//                'product_id'=>14,
//                'qty'=>14
//            ],
//            [
//                'product_id'=>3,
//                'qty'=>144
//            ]
//        ]);

        return new OrderResource($order);






//        return $request->all();
//        return  ($request->all());



        $productIds = explode(',',$request->product_id[0]);
        $productQtys = explode(',',$request->qty[0]);
//        $data = [
//            'ids'=>$productIds,
//            'qtys'=>$productQtys
//        ];
//        $this->validate($data,[
//            'ids' => 'required',
//            'qtys' => 'required|numeric'
//        ]);
        $orders = [];
        foreach($productIds as $index => $value){
            $orders[$index]['product_id']=$value;
            $orders[$index]['qty']=$productQtys[$index];
        }
//        dd($orders);
        $order = auth()->user()->orders()->create([]);

        $order->orderItems()->createMany($orders);

//        $order->orderItems()->createMany([
//            'product'=>[
//                'product_id'=>14,
//                'qty'=>14
//            ],
//            [
//                'product_id'=>3,
//                'qty'=>144
//            ]
//        ]);


        return new OrderResource($order);




//        return $request->all();
//        Order::create($request->all());
//        $user =  auth()->user();

    }
}
