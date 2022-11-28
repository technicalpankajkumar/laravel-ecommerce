<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Comments;
use App\Models\Lineitem;
use App\Models\Order;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=auth()->user();
        
        $cartData=Cart::with('getProductData')->where('user_id',$user->id)->get();

        $totalQuantity=0;
        $totalPrice=0;
        $shippingCharge=40;
        $tax=18; //this value is precentage
        $amount=0;

        //totalPrice or totalQuantity
        foreach($cartData as $cart){
            $productData=$cart->getProductData;
            $quantityData=$cart->quantity;

            $price=!empty($productData->sale_price)? $productData->sale_price : $productData->price;

            $totalPrice=$totalPrice+$price*$quantityData;
            $totalQuantity=$totalQuantity+$quantityData;
        }
        
        $includingTax=($totalPrice*$tax)/100;
        $amount=$totalPrice+$includingTax+$shippingCharge;
        // echo"<pre>";
        // print_r($includingTax);
        // exit;
         return view('cart_user',compact('cartData','user','totalPrice','totalQuantity','shippingCharge','includingTax','amount'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        // echo"<pre>";
        // print_r($request->all());
        // die;
         $message="card is null";
        //basically there is update query
        $requestData=$request->except(['_token']);

        //card update
        if(!empty($requestData['cartId'] ))
        {
        foreach($requestData['cartId'] as $key=>$id)
        {
          if($requestData['cartQty'][$key] < 1){
            Cart::where('id',$id)->delete();
          }
          else{
            Cart::where('id',$id)->update(['quantity'=>$requestData['cartQty'][$key] ?? 1]);
            $message="Card Updated!!!";
          }
        }
        }

        //comment update
        if(!empty($requestData['specialNotes'])){
            $comment=$requestData['specialNotes'];
            Comments::where('user_id',auth()->user()->id)->update(['comment'=>"$comment"]);
            // $update=Comments::find(1);
            // $update->update(['comment'=>"$comment"]);
            $message="Comment Updated!!!";
        }
        // echo"<pre>";
        // print_r($requestData);
        // die;
        return back()->with('success',$message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        //
    }

    public function addToCart(Request $request)
    {
        // echo"<pre>";
        // print_r($request->all());
        // die;
        $requestData=$request->except(['_token']);
        $requestData['user_id']=auth()->user()->id;
        Cart::create($requestData);

        return redirect()->route('cart.index')->with('success','Product successfully added!!');
    }

    //store order
    public function storeOrder(Request $request)
    {
        $requestData=$request->except(['_token']);
        $cartData=Cart::with('getProductData')->where('user_id',auth()->user()->id)->get();
        $comment=auth()->user()->getComment;
        $comment=$comment->comment ?? 'this is default comment';
        // echo"<pre>";
        // print_r($comment);
        // die;
        $totalQuantity=0;
        $totalPrice=0;
        $shippingCharge=40;
        $tax=18; //this value is precentage
        $totalAmount=0;
        $userId=auth()->user()->id;
        $lineItemData=[];

        //totalPrice or totalQuantity
        foreach($cartData as $cart){
            $productData=$cart->getProductData;
            $quantityData=$cart->quantity;

            $price=!empty($productData->sale_price)? $productData->sale_price : $productData->price;

            $totalPrice=$totalPrice+$price*$quantityData;
            $totalQuantity=$totalQuantity+$quantityData;
        }
        
        $includingTax=($totalPrice*$tax)/100;
        $totalAmount=$totalPrice+$includingTax+$shippingCharge;

        $orderData=Order::create([
        'user_id'=>$userId,
        'total_price'=>$totalPrice,
        'shipping_charge'=>$shippingCharge,
        'including_tax'=>$includingTax,
        'tax_rate'=>$tax,
        'total_amount'=>$totalAmount,
        'comment'=>$comment,
        'status'=>'Order placed'
        ]);
        
        foreach($cartData as $cart)
        {
            $productData=$cart->getProductData;
            $price=!empty($productData->sale_price)? $productData->sale_price : $productData->price;
       
            $lineItemData=Lineitem::create([
            'user_id'=>$userId,
            'order_id'=>$orderData->id,
            'product_id'=>$productData->id,
            'quantity'=>$quantityData,
            'price'=>$price,
            'total_price'=>$totalPrice
            ]);
        }

        Cart::where('user_id',$userId)->delete();
        Comments::where('user_id',$userId)->delete();

        return redirect()->back()->with('success','your order has been placed successfully!!!');
    }
}
