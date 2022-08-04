<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Poulailler;
use App\Models\StockPoulailler;
use App\Models\Retrait;
use App\Models\Charge;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;

class PoulaillerController extends Controller

{
                /**
                 * Create a new controller instance.
                 *
                 * @return void
                 */
                public function __construct()
                {
                    $this->middleware('auth:poulailler');
                }




                /**
                 * Show the application dashboard.
                 *
                 * @return \Illuminate\Contracts\Support\Renderable
                 */
                function index()

                    {
                        $data=StockPoulailler::orderBy('created_at','desc')->get();
                        return view('poulailler/home')->with('data', $data);
                    }



                    public function newstock(){

                        return view('poulailler/newStock');
                    }



                function AddStockPoulailler(Request $request){

                        $poulailler= new StockPoulailler();

                        $poussin=$request->number;
                        $mort=$request->mort;

                        $remaining=$poussin-$mort;

                        $poulailler->number_of_chicken=$request->number;
                        $poulailler->poulailler_id_fk=$request->poulailerID;
                        $poulailler->prix_unitaire=$request->pric_unitaire;
                        $poulailler->poules_restantes=$remaining;
                        $poulailler->morts=$request->mort; 

                        $save=$poulailler->save();
                        
                        if($save){
                            return redirect ()->route('poulailler.dashboard')->with('message',' Enregistrement éffectué');
                        }else
                            {   
                                return redirect ()->route('poulailler.newstock')->with('message',' Echec');
                            }
                        
                    
                    }




                    function poulaillerSpecificStock($id){

                            $stock= StockPoulailler::find($id);
                            return view('poulailler/poulaillerStock',['stock'=>$stock]);
                        }




                    function retreive($id){

                            return view('poulailler/retreive')->with('id',$id);
                        }




                    function retreivepostData( Request $request){

                    
                    $retreive=new Retrait();

                    $retreive->poulailler_id=$request->poulaillerId;
                    $retreive->stock_poulailler_id=$request->stockpoulailler;
                    $retreive->number=$request->number;
                    $retreive->details=$request->details;

                    $save=$retreive->save();

                    

                    $id=$request->stockpoulailler;

                    $poulailleStock= StockPoulailler::find($id);

                    $stock_actuel=$poulailleStock->poules_restantes;

                    $retreivedchicken=$request->number;
                   

                    if($stock_actuel==0){

                        return redirect()->back()->with('message','Ce stock est vide');

                    }else

                        if($stock_actuel < $retreivedchicken){
                            return redirect()->back()->with('message',"Vous n'avez pas assez des poules pour accomplir cette opération");

                        }

                        else{
                    $remaining=$stock_actuel-$retreivedchicken;

                    $poulailleStock->poules_restantes=$remaining;
                    
                    $save1=$poulailleStock->save();



                    if($save && $save1){

                       return  redirect()->route('getstockview',$id)->with('message','retrait engeregistrer avec succé');

                    }
                    else{
                        return view('retreive')->with('fail', "Echec d'enregistrement");
                    }
                    
                }

                }




                function getVenteForm($id){

                    return view('poulailler/vente')->with('id',$id);

                }



                function getChargeview($id){
                    return view('poulailler/charge')->with('id',$id);

                }

                function historyView($id){
                    $history= DB::select("SELECT * FROM retraits WHERE stock_poulailler_id='$id' ");
                   //return $history;
                    return view('poulailler/historicRetreive',compact('history'));


                }

                function insertcharges(Request $request, $id){
                   

                 $chargename=$request->charge_intutilé;
                         //return $chargename;
                $price=$request->montant;
                $details=$request->details;
                $poulailler=$request->poulailler;
                $date = date('Y-m-d H:i:s');


                

                for($i=0;$i<count($chargename);$i++)
                {
                    $datasave=[

                        'poulailler_id'=>$poulailler,
                        'poulailler_stock_id'=>$id,
                        'charge_name'=>$request->charge_intutilé[$i],
                        'price'=>$request->montant[$i],
                        'details'=>$request->details[$i],
                        'created_at'=>$date,
                        'updated_at'=>$date,

                    ];
                  
                    DB::table('charges')->insert($datasave);
                }
               return redirect()->route('getstockview',$id)->with('message','Charge(s) Enregistrer');
                     
                }


            function getchargesList($id)
            {
                $listcharge=DB::select("SELECT * FROM charges WHERE poulailler_stock_id ='$id' ");
                //$charge=Charge::find($id);

                

                return view('/poulailler/chargeHistoric',compact('listcharge'));

            }

                
   
}
