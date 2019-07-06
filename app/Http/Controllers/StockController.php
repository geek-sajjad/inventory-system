<?php

namespace App\Http\Controllers;

use App\BuyingList;
use App\Order;
use App\OrderItem;
use App\Product;
use App\ProductCategory;
use App\ProductImage;
use Illuminate\Http\Request;


class StockController extends Controller
{
    public function index(){
        $orders = Order::all();
        return view('stock.index', compact('orders'));
    }

    public function showOrder(Order $order){
        return view('stock.order_page', compact('order'));
    }




    // ----------- All Categories -----------
    public function categories(){
//        return ProductCategory::
//        return $categories = ProductCategory::with('Product')->get();//->paginate(2);
        $categories = ProductCategory::paginate(2);

        return view('stock.categories',compact('categories'));
    }

    // ----------- Add Category -----------
    public function newCategory(Request $request){
        $validatedData = $request->validate([
            'category' => 'required',
        ]);
        if($validatedData){
            $cat = new ProductCategory();
            $cat->name = $request->category;
            $cat->save();
            return redirect()->back()->with('status', 'new category created successfully');
        }
        return redirect()->back()->with('error', 'something sent wrong');
    }

    // ----------- Edit Category -----------
    public function editCategory(ProductCategory $category, Request $request){

        if ($request->isMethod('post')) {
            $validatedData = $request->validate([
                'category' => 'required',
            ]);
            if($validatedData){
                $category->name = $request->category;
                $category->save();
                return redirect()->back()->with('status', 'the category updated successfully');
            }else{
                return redirect()->back()->with('error', 'something sent wrong');
            }
        }


        return view('stock.edit_category', compact('category'));
    }


//    public function product(ProductCategory $productCategory){
//        return $productCategory;
//    }




// ----------- Add Product -----------
    public function products(Request $request ){

        if($request->isMethod('Post')){
            $this->validate($request, [
                'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'product_name' => 'required',
                'Quantity' => 'required|numeric|min:1',
            ]);
            $product = new Product();
            $product->name = $request->product_name;
            $product->quantity = $request->Quantity;
            //TODO write this better
            $cat = ProductCategory::where('name', $request->category)->firstOrFail();

            $product->category_id = $cat->id;
            $product->save();
            if($request->hasfile('image')){
                foreach($request->file('image') as $image)
                {
                    $name= time() . '.' . $image->getClientOriginalName();
                    $image->move(public_path().'/images/', $name);
                    $productImage = new ProductImage();
                    $productImage->image = $name;
                    //TODO make this dynamic
                    $productImage->product_id = $product->id;
                    $productImage->save();
                }
            }
            return redirect()->back()->with('status', 'new product created successfully');
        }
        $categories = ProductCategory::all();
        $products = Product::paginate(10);
        return view('stock.products', compact('categories', 'products'));
    }

// ----------- Edit Category -----------
    public function editProduct(Product $product){
        return view('stock.edit_product', compact('product'));
    }

    public function editSaveProduct(Product $product, Request $request){
        $validated = $this->validate($request, [
            'product_name' => 'required',
            'Quantity' => 'required|numeric|min:1',
        ]);

        if($validated){
            $product->name = $request->product_name;
            $product->quantity = $request->Quantity;
            // if that has new image
            if($request->hasfile('image')){
                foreach($request->file('image') as $image)
                {
                    $name= time() . '.' . $image->getClientOriginalName();
                    $image->move(public_path().'/images/', $name);
                    $productImage = new ProductImage();
                    $productImage->image = $name;
                    //TODO make this dynamic
                    $productImage->product_id = $product->id;
                    $productImage->save();
                }
            }

            if($product->save()){
                return redirect()->back()->with('status', 'product updated successfully');
            }

        }

        return redirect()->back()->with('error', 'something sent wrong');

    }

    public function orders(){

        $orders = Order::where('status', 'open')->get();

        return view('stock.orders', compact('orders'));
    }

    public function orderDetail(Order $order, Request $request){
        $orderItems = $order->orderItems;
        return view('stock.order_detail', compact('orderItems', 'order'));
    }

    public function confirm(OrderItem $orderItem){
        $approvedItems =  auth()->user()->orders()->orderBy('id', 'desc')->first()->orderItems()->where('status', 'Approved')->count();
        $canceledItems =  auth()->user()->orders()->orderBy('id', 'desc')->first()->orderItems()->where('status', 'Canceled')->count();

        if($canceledItems + $approvedItems == auth()->user()->orders()->orderBy('id', 'desc')->first()->orderItems()->count() -1){
            $order = auth()->user()->orders()->orderBy('id', 'desc')->first();
            $order->status = 2;// close
            $order->save();
        }
        if($orderItem->status == 'Approved'){
            return  redirect()->back()->withErrors(['The order is confirmed before']);
        }
        $product = $orderItem->product;
        if($product->quantity >= $orderItem->qty){
            //TODO: explain this
            $product->quantity -= $orderItem->qty;
            $product->save();

            $orderItem->status = 4; // approved
            $orderItem->save();
            return  redirect()->back()->with('status', 'order confirmed');
        }
        return response(404);
    }

    public function cancel(OrderItem $orderItem){
        if($orderItem->status == 'Canceled'){
            return  redirect()->back()->withErrors(['The order is canceled before']);
        }
        $orderItem->status = 5; // canceled
        $orderItem->save();
        return  redirect()->back()->with('status', 'order canceled');
    }

    public function submitComment(OrderItem $orderItem, Request $request){
        $validated = $this->validate($request, [
            'comment'=>'required'
        ]);
        if($validated){
            $orderItem->comment = $request->comment;
            $orderItem->save();
            return redirect()->back()->with('status', 'comment sent successfully');
        }
        return redirect()->back()->with('error', 'something sent wrong');

    }

    public function requestForBuying(OrderItem $orderItem){
//        return $orderItem->qty - $orderItem->product->quantity;
//        dd( ! ($orderItem->status =='Checking By Deputy'));

        if(!($orderItem->status=='Checking By Deputy')){
            $buyingList = new BuyingList();
            $buyingList->product_id = $orderItem->product->id;
            $buyingList->need_qty = $orderItem->qty - $orderItem->product->quantity;
            $buyingList->order_id = $orderItem->id;
            $buyingList->save();
            $orderItem->status = 2;
            $orderItem->save();
            return redirect()->back()->with('status', 'added to buying list. wait for approve by deputy');
        }
        return redirect()->back()->with('error', 'something sent wrong');

//        return view('stock.request_for_buying');
    }

}
