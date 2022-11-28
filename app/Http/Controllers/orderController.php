<?php

namespace App\Http\Controllers;

use App\Models\Lineitem;
use App\Models\Order;
use Illuminate\Http\Request;
use League\CommonMark\Extension\CommonMark\Node\Block\ListItem;

class orderController extends Controller
{
    public function ordreList()
    {
         $orders=Order::with('userData')->get();
        //  echo"<pre>";
        //  print_r($orders);
        //  die;

         return view('Admin.order_list_admin',compact('orders'));
    }

    public function changeOrderStatus(Request $request,$id)
    {

        //  echo"<pre>";
        //  print_r($request->all());
        //  die;

        Order::where('id',$id)->update(['status'=>$request->status]);
        return redirect()->back()->with('success','order status change succesfully!!!');
    }

    public function LineItems(Request $request,$id)
    {
        $ordersData=Order::with('getLineItems')->where('id',$id)->first();
        // $lineItemData=Lineitem::with('getUserData')->where('id',$id)->first()->toArray();
        // echo"<pre>";
        // print_r($lineItemData);
        // die;
        return view('Admin.list_item_admin',compact('ordersData'));
    }
}
