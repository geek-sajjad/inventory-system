<?php

namespace App\Http\Controllers;

use App\BuyingList;
use Illuminate\Http\Request;

class DeputyController extends Controller
{
    public function index(){
        return redirect('deputy/buyingList');
    }

    public function buyingList(){
        $buyingLists = BuyingList::all();
        return view('deputy.buying_list', compact('buyingLists'));
    }

    public function buyingListApprove(BuyingList $buyingList){
//        $buyingList->orderItem->status = 3;
//        $buyingList->orderItem->save();
//        return $buyingList->orderItem->status;

        if($buyingList->status == 'Checking By Deputy'){
            $buyingList->status = 4;

            $buyingList->orderItem->status = 3;
            $buyingList->save();
            $buyingList->orderItem->save();

            return redirect()->back()->with('status', 'status updated successfully');
        }

        return redirect()->back()->with('error', 'something sent wrong');

    }

    public function buyingListCancel(BuyingList $buyingList){
        if($buyingList->status == 'Checking By Deputy'){
            $buyingList->status = 3; // cancel status

            $buyingList->orderItem->status = 5; // canceled status
            $buyingList->save();
            $buyingList->orderItem->save();

            return redirect()->back()->with('status', 'status updated successfully');
        }

        return redirect()->back()->with('error', 'something sent wrong');
    }
}
