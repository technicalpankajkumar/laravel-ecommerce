<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeMail;
use App\Models\Brands;
use App\Models\CountryModel;
use App\Models\Lineitem;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;

class AdminController extends Controller
{
    public function dashboard(Request $request){
        $totalUsers=User::get('id')->count();
        $totalBrands=Brands::get('id')->count();
        $totalOrders=Order::get('id')->count();
        $totalSaleAmounts=Order::get('total_amount')->sum('total_amount');
     //    echo"<pre>";
     //    print_r($totalSaleAmount);
     //    exit;
        return view('Admin.index_admin',compact('totalUsers','totalBrands','totalOrders','totalSaleAmounts'));
    }


//    Admin Profile is start here
public function profileAdmin(Request $request)
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
        return view('Admin.profile_admin',compact(['country','user','lineItemsData']));
    }
    public function profileAdminUpdate(Request $request)
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
       
        return redirect()->route('admin_profile');
    }

    public function imageAdminUpdate(Request $request)
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
        return redirect()->route('admin_profile');

    }
//    Admin profile is end here

    public function userList(Request $request){
        $users=User::with('getCountry')->get();
        
        return view('Admin.userlist_admin',compact('users'));
    }
    public function editUsers(Request $request,$id){
        $user=User::find($id);
        $country=CountryModel::all();
        return view('Admin.user_show_admin',compact('user','country'));
    }
    public function updateUsers(Request $request,$id){

        $request->validate([
            'first_name'=>'required|min:3|max:20',
            'last_name'=>'min:3|max:30|nullable',
            'contact'=>'required|numeric',
            'gender'=>'required|in:Male,Female,Other',
            'role_id'=>'required|in:0,1',
            'address'=>'required|min:10|max:60|string',
            'country'=>'required',
            ]);
        $userUpdate=$request->except(['_token','update']);
        $users=User::find($id);
        //  dd($user);
        // die;
        $users->update($userUpdate);
        return back()->with('success','Users update successfully!!');
    }

    public function updateUserProfile(Request $request,$id)
    {
        $requestData=$request->except(['_token','update']);
        
        $image='lv'.rand().".".$request->profile->extension();
        $request->profile->move(public_path('uploads/'),$image);
        $requestData['profile']=$image;

        $user=User::find($id);
        $exitstingProfile=$user->profile;
        $user->update($requestData);
        
        $fileExits=public_path("uploads/$exitstingProfile");
        
        if(file_exists($fileExits))
        {
          unlink("uploads/$exitstingProfile");
        }
        return back()->with('success','Profile updated!!!');
    }
// Add user by admin form
   public function addUser(Request $request){
      $country=CountryModel::all();
    return view('Admin.add_user_admin',compact('country'));
   }

   public function storeUser(Request $request){

    $request->validate([
        'first_name'=>'required|min:3|max:20',
        'last_name'=>'min:3|max:30|nullable',
        'email'=>'required|unique:users,email',
        'password'=>'required|min:8|max:20',
        'contact'=>'required|numeric',
        'gender'=>'required|in:Male,Female,Other',
        'role_id'=>'required|in:1,0',
        'address'=>'required|min:10|max:60|string',
        'country'=>'required',
        'profile'=>'required|mimes: jpg,jpeg,png'
        ]);

        $userData=$request->except(['_token','register']);

        $imageName='Lv_'.rand().".".$request->profile->extension();
        // $request->file('profile')->storeAs('uploads',$imageName); //upload image in storage folder
        $request->profile->move(public_path('uploads/'),$imageName);
        $userData['profile']=$imageName;
        $userData['password']=Hash::make($request->password);
        $email=$request->email;
        event(new WelcomeMail($email));
        // echo"<pre>";
        // print_r($email);
        // exit;
        User::create($userData);

        return back()->with('success','User add successfully!!!');
        
   }
//admin action for users

   public function userAction(Request $request, $id, $status=1){
      $user=User::find($id);
      if(!empty($user)){
          $user->action=$status;
          $user->save();
          return back()->with('success','deactivate successfull!!!');
      }
      else{
        return back()->with('danger','user not fund !!!');
      }
   }
}
