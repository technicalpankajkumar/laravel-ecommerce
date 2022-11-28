<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use App\Models\CountryModel;
use App\Models\Lineitem;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{   
    public function profileUser(Request $request)
    {
        $country=CountryModel::all();
        //  dd($country);
        //   exit;
        $user=auth()->user();
        // $ordersData=Order::where('user_id',$user->id)->get('total_amount');
        $lineItemsData=Lineitem::where('user_id',$user->id)->orderBy('id','Desc')->get();
        // echo "<pre>";
        // print_r($ordersData->toArray());
        // die;
        return view('profile_user',compact(['country','user','lineItemsData']));
    }
    public function profileUserUpdate(Request $request)
    {
        $request->validate([
            'first_name'=>'required|min:3|max:20',
            'last_name'=>'min:3|max:30|nullable',
            'contact'=>'required|numeric',
            'gender'=>'required|in:Male,Female,Other',
            'address'=>'required|min:10|max:60|string',
            'country'=>'required',
            ]);
        $userUpdate=$request->except(['_token','_method','update']);
        $user=User::find(auth()->user()->id);
        //  dd($user);
        // die;
        $user->update($userUpdate);
       
        return redirect()->route('profileUser');
    }
    public function imageUserUpdate(Request $request)
    {
        $requestData=$request->except(['_token','update']);
        
        $image='lv'.rand().".".$request->profile->extension();
        $request->profile->move(public_path('uploads/'),$image);
        $requestData['profile']=$image;

        $user=User::find(auth()->user()->id);
        $exitstingProfile=$user->profile;
        $user->update($requestData);
        
        $fileExits=public_path("uploads/$exitstingProfile");
        
        if(file_exists($fileExits))
        {
          unlink("uploads/$exitstingProfile");
        }
        return redirect()->route('profileUser');

    }
}
