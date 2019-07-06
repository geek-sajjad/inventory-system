<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderItem;
use App\Product;
use App\ProductCategory;
use http\Env\Response;
use Illuminate\Http\Request;

class SuppliantController extends Controller
{
// ---------- index page ----------
    public function index(){
        return view('suppliant.index');
    }


// ---------- all orders ----------
    public function orders(){
        //TODO research this
        $orders = Order::where('user_id', auth()->id())->paginate(2);
        return view('suppliant.orders', compact('orders'));
    }

    public function order(Order $order){
        return view('suppliant.order_detail', compact('order'));
    }


    public function newOrder(){
        $categories = ProductCategory::all();
        return view('suppliant.new_order', compact('categories'));
    }

    public function productPage(ProductCategory $category, Request $request){



        $orderItems=null;

        if($request->session()->get('isProductAdded')){
            $order = Order::find($request->session()->get('isProductAdded'));
            $orderItems = $order->orderItems;
        }



        $products = $category->products;


        return view('suppliant.product_page', compact('products', 'orderItems'));
    }

    public function addProduct(Product $product, Request $request){
        //$request->session()->forget('isProductAdded');

        $validatedData = $request->validate([
            'qty' => 'required|numeric|min:1',
        ]);

        //if(!$request->session()->get('isProductAdded')){
            if(!$request->session()->get('isProductAdded')){
            $order = new Order();
            $order->user_id = auth()->id();
            $order->save();
            $request->session()->put('isProductAdded',$order->id);


            $orderItem = new OrderItem();
            $orderItem->product_id = $product->id;
            $orderItem->order_id = $order->id;
            $orderItem->qty = $request->input('qty');
            $orderItem->save();
            return redirect()->back()->with('status', 'product added successfully ');
        }

        $orderId =($request->session()->get('isProductAdded'));

        $orderItem = new OrderItem();
        $orderItem->product_id = $product->id;
        $orderItem->order_id = $orderId;
        $orderItem->qty = $request->input('qty');
        $orderItem->save();

        return redirect()->back()->with('status', 'product added successfully ');

    }


    public function deleteOrderItem(OrderItem $orderItem, Request $request){
        $orderId = $request->session()->get('isProductAdded');
        if(!$orderId){
            return response(404);
        }
        $orderItems = Order::findOrFail($request->session()->get('isProductAdded'))->orderItems;
        if(count($orderItems)==1){

            $order = Order::find($request->session()->get('isProductAdded'));
            $orderItem->delete();
            $order->delete();
            $request->session()->forget('isProductAdded');

            return redirect()->back()->with('status', 'order item deleted successfully');
        }
        $orderItem->delete();


        return redirect()->back()->with('status', 'order item deleted successfully');
    }


















//
//    public function newOrder(){
//        $products = Product::all();
//        return view('suppliant.products', compact('products'));
//    }
//
//    public function productPage(Product $product){
//        return view('suppliant.product_page', compact('product'));
//    }
//
//    public function submitOrder(Request $request, Product $product){
//        $validatedData = $request->validate([
//            'qty' => 'required|numeric|min:2',
//        ]);
//
//        if($validatedData){
//            $order = new Order();
//            $order->qty = $request->qty;
//            $order->user_id = auth()->id();
//            $order->product_id = $product->id;
//
//            $order->save();
//        }
//
//
//        return redirect()->back()->with('status', 'your order submitted');
//
//    }
//
//    public function allOrders(){
//        $orders = Order::all();
//
//        return view('suppliant.my_orders', compact('orders'));
//    }
}
