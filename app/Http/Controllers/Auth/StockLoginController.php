<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockLoginController extends Controller
{
    public function __conturst()
    {
        $this->middleware('guest:stock');
    }

    function showLoginForm(){
        return view('auth.stock-login');
    }
    

    function Login(Request $request){

        
        //validate the form data
        $this -> validate($request,[
            'email'=> 'required|email',
            'password' => 'required|min:6'
    
         ]);
    
         // Attempt to log the stock in
    
         if( Auth::guard('stockaccount')->attempt(['email'=>$request->email,'password'=>$request->password], $request->remember)){
            //return view('stock');
    
            return redirect()->intended(route('stock.dashboard'));
    
         }
    
         return redirect()->back()->withInput($request->only('email','remember'));

    }
}
