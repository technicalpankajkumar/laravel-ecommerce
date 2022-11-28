<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Products::with('getBrandsData')->get()->toArray();
        // echo"<pre>";
        // print_r($products);
        // die;
        return view('Admin.productlist_admin',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands=Brands::all();
        $configs=Config::get('add_function_admin');
        // echo"<pre>";
        // print_r($configs);
        // die;
        return view('Admin.add_product_admin',compact('brands','configs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|min:2|max:50',
            'price'=>'required',
            'sale_price'=>'required',
            'color'=>'required',
            'brand_id'=>'required',
            'gender'=>'required|in:Male,Female,Children,All',
            'product_code'=>'required',
            'description'=>'required|min:5|max:500|string',
            'function'=>'required',
            'stock'=>'required',
            'image'=>'required'
            ]);
    
            $products=$request->except(['_token','add_product']);
            $imageName=$request->name.".".$request->image->extension();
            // $request->file('profile')->storeAs('uploads',$imageName); //upload image in storage folder
            $request->image->move(public_path('products/'),$imageName);
           
            $products['image']=$imageName;
            Products::create($products);
            return back()->with('success','Product add successfully!!!');
            
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(Products $products,$id)
    {
        $product=Products::find($id);
        $brands=Brands::all();
        $configs=Config::get('add_function_admin');
        return view('Admin.show_product_admin',compact('product','brands','configs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Products $products,$id)
    {
        $request->validate([
            'name'=>'required|min:2|max:50',
            'price'=>'required',
            'sale_price'=>'required',
            'color'=>'required',
            'brand_id'=>'required',
            'gender'=>'required|in:Male,Female,Children,All',
            'product_code'=>'required',
            'description'=>'required|min:5|max:500|string',
            'function'=>'required',
            'stock'=>'required',
            ]);

            $product=$request->except(['_token','Update','_method']);
            $products=Products::find($id);
            // echo"<pre>";
            // print_r($products);
            // die;
            $products->update($product);
            return redirect()->route('product.index')->with('success','Product Successfully Updated!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Products $products)
    {
        //
    }
    public function changeProductImage(Request $request,$id){
        
        $requestData=$request->except(['_token','update']);
        $product=Products::find($id);
        $image=$product->name.".".$request->image->extension();
        $request->image->move(public_path('products/'),$image);
        $requestData['image']=$image;
        $exitingImage=$product->image;

        $product->update($requestData);

        $exitingImageUnlink=public_path("products/$exitingImage");
        
        if(file_exists($exitingImageUnlink))
        {
          unlink("products/$exitingImage");
        }
        return back()->with('success','image update succesfully!!!');

    }
public function changeProductStatus(Request $request,$id,$status=1)
{
        $product=Products::find($id);
        if(!empty($product)){
            $product->action=$status;
            $product->save();

            if($status==0){
            return back()->with('danger','deactivated successfull!!!');
            }
            else{
                return back()->with('success','activated successfull!!!');
            }
        }
        else{
          return back()->with('danger','user not fund !!!');
        }
    }
}