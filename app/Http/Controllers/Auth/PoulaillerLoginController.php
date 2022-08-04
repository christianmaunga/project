<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PoulaillerLoginController extends Controller
{
    public function __conturst()
    {
        $this->middleware('guest:poulailler');
    }

    function showLoginForm(){
        return view('auth.poulailler-login');
    }
    function Login(Request $request){

        
        //validate the form data
        $this -> validate($request,[
            'email'=> 'required|email',
            'password' => 'required|min:6'
    
         ]);
    
         // Attempt to log the admin in
    
         if( Auth::guard('poulailler')->attempt(['email'=>$request->email,'password'=>$request->password], $request->remember)){
            //return view('admin');
    
            return redirect()->intended(route('poulailler.dashboard'));
    
         }
    
         return redirect()->back()->withInput($request->only('email','remember'));

    }
}
