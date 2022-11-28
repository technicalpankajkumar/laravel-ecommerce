<?php

namespace App\Http\Controllers;

use App\Events\WelcomeEvent;
use App\Mail\sendForgetPasswordEmail;
use App\Models\CountryModel;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Str;
use Stringable;

class AuthenticationController extends Controller
{
    public function register(Request $request)
    {
        $country=CountryModel::all();
        return view('register_user',compact('country'));
    }
    public function userStore(Request $request)
    {
        $request->validate([
        'first_name'=>'required|min:3|max:20',
        'last_name'=>'min:3|max:30|nullable',
        'email'=>'required|unique:users,email',
        'password'=>'required|min:8|max:20',
        'contact'=>'required|numeric',
        'gender'=>'required|in:Male,Female,Other',
        'address'=>'required|min:10|max:60|string',
        'country'=>'required',
        'profile'=>'required|mimes: jpg,jpeg,png'
        ]);

        $userData=$request->except(['_token','register']);

        $imageName='Lv_'.rand().".".$request->profile->extension();
        // $request->file('profile')->storeAs('uploads',$imageName); //upload image in storage folder
        $request->profile->move(public_path('uploads/'),$imageName);
        $userData['profile']=$imageName;
        $userData['role_id']=User::userRole;
        $userData['password']=Hash::make($request->password);
        $email=$request->email;
        event(new WelcomeEvent($email));
        // echo"<pre>";
        // print_r($email);
        // exit;
        User::create($userData);
        
        return redirect()->route('register')->with('success','your data successfuly inserted!!');
        
    }

    public function login(Request $request)
    {
        return view('login_user');
    }

    public function Authenticate(Request $request)
    {
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);

        // $loginData=$request->all();
        // dd($loginData);
        // die;
        $loginCredential=$request->only('email','password');
        if(Auth::attempt($loginCredential))
        {
            if(auth()->user()->role_id==User::adminRole)
            {
               return redirect()->route('admin_dash',[],301)->with('success','welcome to admin!!');
            }
            else
            {
            return redirect()->route('index',[],301)->with('success','Login is successfully');
            }
        }
        else
        {
            return redirect()->route('login')->with('danger','somthing went wrong! plese try again');
        }
    }

    public function logout(Request $request)
    {
        session()->flush();
        Auth::logout();
        return redirect()->route('login');
    }

    //Forget password controller is here
    public function forgetPassword(Request $request)
    {
        return view('forgetpassword_user');
    }
    public function sendForgetPasswordEmail(Request $request)
    {
        $request->validate([
            'email'=>'required||exists:users,email'
        ]);
        $token=$request->_token;
        // $token= Str::random('30');
        $forgetpass=$request->except(['_token','forget_pass']);
        
        $forgetpass['token']=$token;
        // echo"<pre>";
        // print_r($forgetpass);
        // die;
        DB::table('password_resets')->insert($forgetpass); //Query builder Methods
        Mail::to($forgetpass['email'])->send(new sendForgetPasswordEmail($forgetpass));
        session()->flash('success','email send successfully!!!');
        return redirect()->route('sendForgetPasswordEmail'); 
    }

    public function resetPassword(Request $request, $token)
    {
        $checkData=DB::table('password_resets')->where('email',$request->email)->where('token',$token)->count();
        // dd($checkData);
        // exit;
        if($checkData>0)
        {
            $email=$request->email;
            return view('resetpassword_user',compact('email'));
        }
        else{
            session()->flash('danger','Invalid token !!!');
            return view('forgetpassword_user');
        }
        
    }
    public function resetPasswordData(Request $request,)
    {
       $request->validate([
        'password'=>'required|min:6',
        'password_confirm'=>'required|same:password'
       ]);
    //    dd($request-all());
       $user=User::where('email',$request->email)->update(['password'=>bcrypt($request->password)]);
       return redirect()->route('login')->with('success','password reset sucessfully !!!');
    }

}
