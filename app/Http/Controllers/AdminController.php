<?php

namespace App\Http\Controllers;
use app\Models\Admin;
use App\Models\Pharma;
use App\Models\Poulailler;
use App\Models\Stockaccount;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.home');
    }

    public function insertAccountview(){
        return view('admin.newaccount');
    }

    
    function insertNewAccount(Request $request){

        

        $request->validate([
                'username'=>'required',
                'email'=>'required|email|unique:stockaccounts,email|min:5|max:30',
                'localization'=>'required',
                'typeaccount'=>'required',
                'password'=>'required|min:5|max:30',
                'confirmPassword'=>'required|min:5|max:30|same:password'
            ]);

            $typeaccount=$_POST['typeaccount'];


            if($typeaccount=='stock'){

                $stock=new Stockaccount();

                $stock->name=$request->username;
                $stock->email=$request->email;
                $stock->localization=$request->localization;
                $stock->password= Hash::make($request->password);

                $save=$stock->save();

                    if($save){
                        return redirect()->route('admin.dashboard')->with('message','Enregistrement éffectuer');
                    }else
                        {
                            return redirect()->back()->with('fail','Échec');
                        }


            }else
                if($typeaccount=='pharma'){

                    $pharma=new Pharma();

                    $pharma->name=$request->username;
                    $pharma->email=$request->email;
                    $pharma->localization=$request->localization;
                    $pharma->password= Hash::make($request->password);

                    $save=$pharma->save();

                        if($save){
                            return redirect()->route('admin.dashboard')->with('message','Enregistrement éffectuer');
                        }else
                            {
                                return redirect()->back()->with('fail','Échec');
                            }


                }else
                if($typeaccount=='poulailler'){
                    
                    $poulailler=new Poulailler();

                    $poulailler->name=$request->username;
                    $poulailler->email=$request->email;
                    $poulailler->localization=$request->localization;
                    $poulailler->password= Hash::make($request->password);

                    $save=$poulailler->save();

                        if($save){
                            return redirect()->route('admin.dashboard')->with('message','Enregistrement éffectuer');
                        }else
                            {
                                return redirect()->back()->with('fail','Échec');
                            }


          }





    }
}
