<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use Illuminate\Http\Request;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands=Brands::all();
        return view('Admin.brandlist_admin',compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.add_brand_admin');
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
            'name'=>'required|min:2|max:20',
            'description'=>'required|min:10|max:60|string',
            'image'=>'required|mimes: jpg,jpeg,png'
            ]);
    
            $userData=$request->except(['_token','add']);
            $imageName=$request->name.".".$request->image->extension();
            $request->image->move(public_path('brands/'),$imageName);
            $userData['image']=$imageName;
            Brands::create($userData);
            return redirect()->route('brand.index')->with('success','User add successfully!!!');
        }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Brands $brand)
    {
        return view("Admin.show_brand_admin",compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        // echo "<pre>";
        // print_r($id);
        // die;
        $request->validate
        ([
            'name'=>'required|min:2|max:60',
            'description'=>'required|min:10|max:60|string',
            ]);

         $data= $request->except(['_token','_method','update']);
         $brand=Brands::find($id);
        //  $brand->update($data);
         $brand->name=$request->name ?? $brand->name;
         $brand->description=$request->description ?? $brand->description;
         $brand->save();
         return redirect()->route('brand.index')->with('success','Data successfully updated!!');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function changeBrandImage(Request $request,$id){
        
        $requestData=$request->except(['_token','update']);
        $brand=Brands::find($id);
        $image=$brand->name.".".$request->image->extension();
        $request->image->move(public_path('brands/'),$image);
        $requestData['image']=$image;
        // echo"<pre>";
        // print_r($image);
        // die;
        $brand->update($requestData);
        return redirect()->route('brand.index')->with('success','image update succesfully!!!');

    }
    public function changeBrandStatus(Request $request,$id,$status=1){
        
        $brand=Brands::find($id);
        if(!empty($brand)){
            $brand->action=$status;
            $brand->save();
            
            return back()->with('success','deactivate successfull!!!');
        }
        else{
          return back()->with('danger','user not fund !!!');
        }
    }
}
