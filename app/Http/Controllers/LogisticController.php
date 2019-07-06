<?php

namespace App\Http\Controllers;

use App\BuyingList;
use App\Product;
use Illuminate\Http\Request;

class LogisticController extends Controller
{
    public function index(){
        $buyingLists = BuyingList::where('status', 'Checking by Logistic')->get();
        return view('logistic.buying_list', compact('buyingLists'));
    }

    public function bought(BuyingList $buyingList, Request $request){
        $this->validate($request,[
            'bought_qty' =>'required'
        ]);

        if($buyingList->status == 'Checking By Logistic'){
            $buyingList->status = 2; // bought

            $buyingList->save();
            $buyingList->orderItem->status = 1; // checking by stock

            $buyingList->orderItem->product->quantity += $request->input('bought_qty');
            $buyingList->orderItem->save();
            $buyingList->orderItem->product->save();
            return redirect()->back()->with('status', 'stock qty updated');
        }
        return redirect()->back()->with('error', 'something sent wrong');
    }

    public function cancel(BuyingList $buyingList){
        if($buyingList->status == 'Checking By Logistic'){
            $buyingList->status = 3; // cancel
            $buyingList->save();
            $buyingList->orderItem->status = 5; // cancel

            $buyingList->orderItem->save();
            return redirect()->back()->with('status', 'the buying list updated successfully');
        }
        return redirect()->back()->with('error', 'something sent wrong');
    }
}
