<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{

    public function __conturst()
    {
        $this->middleware('guest:admin');
    }

    function showLoginForm(){
        return view('auth.admin-login');
    }

    function Login(Request $request){

        
        //validate the form data
        $this -> validate($request,[
            'email'=> 'required|email',
            'password' => 'required|min:6'
    
         ]);
    
         // Attempt to log the admin in
    
         if( Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password], $request->remember)){
            //return view('admin');
    
            return redirect()->intended(route('admin.dashboard'));
    
         }
    
         return redirect()->back()->withInput($request->only('email','remember'));

    }
}
