<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Products;
use App\Models\ProductsAdded;
use App\Models\pharmaCounter;
use App\Models\tableOfProducts;
use App\Models\finished_product;
use App\Models\transferredProducts;
use App\Models\ProductInStockCounter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPSTORM_META\type;

class StockController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:stockaccount');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
            $user = Auth::id();
            $addedProducts=DB::SELECT("SELECT table_of_products.product_name, product_added.number, product_added.created_at
                                    FROM table_of_products, product_added
                                    WHERE table_of_products.id=product_added.product_id  AND product_added.stock_id='$user'
                                    ORDER BY  created_at DESC LiMIT 11");

            $retreivedProducts=DB::SELECT("SELECT table_of_products.product_name, transferred_products.productNumbers, transferred_products.created_at 
                FROM table_of_products, transferred_products
                WHERE table_of_products.id=transferred_products.product_id  AND transferred_products.stock_id='$user'
                ORDER BY  created_at DESC LiMIT 11 ");

            $count=DB::select(" SELECT status from _finshed_product_status where stock_id = '$user' AND status=0 ");

        // foreach( $count as $rows){
        //     echo $rows->status;
        // }
            return view('stock/home')->with('addedProducts',$addedProducts)->with('retreivedProducts',$retreivedProducts)->with('count',$count);
    }



    function addNewProduct(){

        return view('stock/newproduct');

    }

    function insertProduct(Request $request){



        $product_added=new ProductsAdded();
        $products=new Products();
        $stock_counter=new ProductInStockCounter();
        
        $manufacturer=DB::select('SELECT manufacturer_name FROM table_of_products');
        $name=DB::select('SELECT product_name FROM table_of_products');

        $request->validate(['type'=>'required']);
        ///
        $productName=$request->nom;
        $manufacturer=$request->fabricant;
        
        $stockid=Auth::id();


        $check = DB::table('table_of_products')
        ->where('product_name', $request->nom)
        ->where('manufacturer_name', $request->fabricant)
        //->where('stockID',$stockid)
        ->first();


        if(is_null($check)){
            
            // if the product doesn't exits in the system already do the following
            

            $products->product_name=$request->nom;
            $products->manufacturer_name=$request->fabricant;
            

    

            $products->save();

            
           

            $product_added->product_id= $products->id;
            
            $product_added->stock_id=$request->stockID;
                
            $product_added->price=$request->prix;
            
            $product_added->number=$request->nombre;
            

            $product_added->prixtotal=$request->prixtotal;

            $product_added->dateExpiration=$request->dateExpiration;  

            $product_added->type=$request->type;
                    
            $product_added->comment=$request->comment;

            $save_product_delails=$product_added->save();


            $product_id = DB::table('table_of_products')
            ->where('product_name', $request->nom)
            ->where('manufacturer_name',  $request->fabricant)
            //->where('stockID',$stockid)
            ->value('id');

            //stock counter

            $stock_counter->stock_id=$request->stockID;
            $stock_counter->product_id=$product_id;
            $stock_counter->totalInStock=$request->nombre;
            $stock_counter->selling_price=$request->prix;
            $stock_counter->save();
            

            if($save_product_delails){
                return  redirect()->back()->with('message','Le nouveau produit '.$productName.' a été  enregistré');
              }else{
                  return  redirect()->back()->with('message',' Erreur');
              }
           
       
        

        }else {
           
           //if a product that has the same name and the same manufacturer exists in the system
           // ins
            
            $check1 = DB::table('table_of_products')
            ->where('product_name', '=',$request->nom)
            ->where('manufacturer_name', '=', $request->fabricant)
            ->get();

            
           // $array=(array)$check1;
            $array = json_decode(json_encode($check1), true);

           // print_r($array);

            foreach ($check1 as $key ) {

                        $product_id = DB::table('table_of_products')
                        ->where('product_name', '=',$request->nom)
                        ->where('manufacturer_name', '=', $request->fabricant)
                        //->where('stockID',$stockid)
                        ->value('id');
                        

                        //fetch product id in the counter table

                        $id_stock_counter = DB::table('product_in_stock_counter')
                                              ->where('product_id', $product_id )
                                              ->where('stock_id',  $request->stockID)
                                              ->value('id');
                        
                        if(is_null($id_stock_counter)){

                            $stock_counter->stock_id=$request->stockID;
                            $stock_counter->product_id=$product_id;
                            $stock_counter->totalInStock=$request->nombre;
                            $stock_counter->selling_price=$request->prix;
                            $stock_counter->save();

                        }else{

                                    //fetch number of product in the counter
                                $Instock = DB::table('product_in_stock_counter')
                                ->where('id', $id_stock_counter)
                                ->value('totalInStock');
                
            
                    
                                $update= $Instock+$request->nombre;
                            
                            //
                                $update=ProductInStockCounter::Where('id', $id_stock_counter)
                                ->update(['totalInStock' =>$update ]);

                        }
                      

                            
                           $product_added->product_id=$key->id;
                            
                            $product_added->stock_id=$request->stockID;
                            
                            $product_added->price=$request->prix;
                            
                            $product_added->number=$request->nombre;

                            $product_added->prixtotal=$request->prixtotal;

                            $product_added->dateExpiration=$request->dateExpiration;  
                            
                            $product_added->type=$request->type;

                            $product_added->comment=$request->comment;

                            $save=$product_added->save();
                           

                    if($save){
                        return  redirect()->back()->with('message', 'Ajout des '.$request->nombre.' '.$productName.' avec succès
                        ');
                      }else{
                          return  redirect()->back()->with('message',' Erreur');
                      }
                        


            

       }

    }
    
        

    }

    function displayProduct() {
        //$getAllProduct=();
    
    }

    function getretreiveview(){

        $pharmacy=DB::table('pharmas')
                        ->get();

      return view('stock/retreiveproduct',['pharmacy'=>$pharmacy]);
      
    }



    public function DataLiveSearch ($stockId){
   

        $product_=DB::select(
        "SELECT table_of_products.product_name, product_in_stock_counter.totalInStock,  product_in_stock_counter.selling_price, product_in_stock_counter.product_id
        FROM product_in_stock_counter, table_of_products 
        WHERE product_in_stock_counter.product_id= table_of_products.id  AND product_in_stock_counter.totalInStock > 0 AND product_in_stock_counter.stock_id='$stockId'");
        return response()->json($product_);
        
    }



    function TransferredProduct(Request $request){   
         
        $products=new Products();
      // return $request->product_name;
        $user_id=Auth::id();

           $Instock = DB::table('product_in_stock_counter')
                        ->where('product_id', $request->product_id)
                        ->where('stock_id',  $user_id)
                        ->value('totalInStock');


            $request->validate([
                'product_name'=>'required|exists:table_of_products',
                'retreived_product'=>'required|lte:'.(int)$Instock,
                'comment'=>'required',
                'destination'=>'required'
            ]
          );
            // if it is valid, the code will proced
            //if it not it will trow a validation exeption
            $update=$Instock-$request->retreived_product;


            $update=ProductInStockCounter::Where('product_id',$request->product_id)
                            ->Where('stock_id',$request->stockID)
                            ->update(['totalInStock' =>$update ]);
        

        //Update the counter Pharma

       

          $counter_id =DB::table('pharma_counters')
          ->where('product_id',$request->product_id)
          ->where('pharma_id',$request->destination)
          ->value('id');

            $pharma_account=DB::table('pharmas')
                            ->value('id');
            $Pharma_counter=new pharmaCounter();

            if($counter_id==null){

                $Pharma_counter->product_id=$request->product_id;
                $Pharma_counter->number=$request->retreived_product;
                $Pharma_counter->pharma_id=$request->destination;
                $Pharma_counter->stock_id=$request->stockID;
                $Pharma_counter->save();

            }else
            if($counter_id=!null){

                $counter_number =DB::table('pharma_counters')
                ->where('product_id',$request->product_id)
                ->where('pharma_id',$request->destination)
                ->value('number');

                $new_value=$counter_number+$request->retreived_product;
                
               

                $update_counter=pharmaCounter::Where('product_id',$request->product_id)
                                ->Where('stock_id',$request->stockID)
                                ->update(['number' =>$new_value ]);

                
            }


        //submit the transferts

       $transferred_products =new transferredProducts();

        $transferred_products->product_id=$request->product_id;
        $transferred_products->stock_id=$request->stockID;
        $transferred_products->productNumbers=$request->retreived_product;
        $transferred_products->destination=$request->destination;
        $transferred_products->comment=$request->comment;

        $save_transfert_details=$transferred_products->save();

        $destination_name=DB::table('pharmas')
                            ->where('id',$request->destination)
                            ->value('name');



        if($save_transfert_details){
                $check=DB::table('product_in_stock_counter')
                        ->where('product_id',$request->product_id)
                        ->where('stock_id',$user_id)
                        ->value('totalInStock');

                if($check==0){
                    self::finishedStock($user_id,$request->product_id);
                }
                

            return  redirect()->back()->with('message', $request->retreived_product.' '.$request->product_name." vers: ".$destination_name);
      
        }else{
              return  redirect()->back()->with('message',' Transaction impossible');
          }

    }




     public   function AddedData(){
            $user=Auth::id();

            $query=DB::select("SELECT table_of_products.product_name, product_in_stock_counter.totalInStock, product_in_stock_counter.product_id
                               FROM table_of_products, product_in_stock_counter
                               WHERE table_of_products.id=product_in_stock_counter.product_id AND product_in_stock_counter.stock_id='$user'")
            ;

            
            return view('stock/addedProduct',['query'=>$query]);
        }
        

        function RetreivedData(){
           
                $user=Auth::id();
    
                
                $dates = DB::table('transferred_products as cust')
                            ->where('stock_id',$user)
                            ->select(DB::raw('DATE_FORMAT(created_at, "%d %M %Y") as days_formatted'))
                            ->distinct()
                            ->orderBy('created_at', 'DESC')
                            ->get();

              return view('stock/retrievedProduct',['dates'=>$dates]);
            
           
        }



        function historicAdded($id){
            $stock_id=Auth::id();
            $product_id=$id;
            $edit_product=ProductInStockCounter::where('product_id',$product_id)->first( );
            $productName=tableOfProducts::where('id',$product_id)->value('product_name');
            $select=DB::select("SELECT product_name FROM table_of_products WHERE id='$product_id'");

            $query=DB::SELECT("SELECT table_of_products.product_name,product_added.number,product_added.price,product_added.prixtotal, product_added.comment,product_added.created_at 
            FROM table_of_products, product_added 
            WHERE table_of_products.id= '$product_id'
            AND product_added.product_id= '$product_id'
            AND product_added.stock_id= '$stock_id'
            ");
           // return $productName;
        // return view('stock/historic',['productName'=>$productName]);
          return view('stock/historic')->with('productName',$productName)
                                       ->with('query',$query)
                                       ->with('edit_product',$edit_product) ;
           
        }



        public function editPrice($id,Request $request){
            $editprice=ProductInStockCounter::where('id',$id)
                                        ->update(['selling_price'=>$request->new_price]);
           // $save=$editprice->save();
            
            if($editprice){
                return  redirect()->back()->with('message',' Changement éffectué');
            }else{
                return  redirect()->back()->with('message',' erreur');

            }
        }



        public function searchProductName(){

            $query=tableOfProducts::select('product_name','manufacturer_name')->get();
                        

            return  response()->json($query);
        }


        public function ShowTransferSpecificProduct($date){
                 $newdate=date("Y-m-d", strtotime($date));
                 $stock_id=Auth::id();
                 
                 $query=DB::select("SELECT  table_of_products.product_name, transferred_products.id, transferred_products.productNumbers,  pharmas.name,transferred_products.created_at 
                 FROM table_of_products, transferred_products, pharmas
                 WHERE DATE_FORMAT(transferred_products.created_at, '%Y-%m-%d') ='$newdate'
                 AND table_of_products.id=transferred_products.product_id
                 AND pharmas.id=transferred_products.destination
                 AND transferred_products.status=1
                 And transferred_products.stock_id='$stock_id'
                 ORDER BY  created_at DESC ")
                 ;

                 $query2=DB::select("SELECT  table_of_products.product_name, transferred_products.id, transferred_products.productNumbers,transferred_products.created_at 
                 FROM table_of_products, transferred_products
                 WHERE DATE_FORMAT(transferred_products.created_at, '%Y-%m-%d') ='$newdate'
                 AND table_of_products.id=transferred_products.product_id
                 AND transferred_products.destination=0
                 AND transferred_products.status=1
                 And transferred_products.stock_id='$stock_id'
                 ORDER BY  created_at DESC ")
                 ;

                return view('/stock/infoproducttransfer')->with('query',$query)->with('date',$date)->with('query2',$query2);

        }

        function Options($date,$id){

            
            $destination=DB::table('transferred_products')
                                ->where('id',$id)
                                ->value('destination');

             $query=DB::select("SELECT table_of_products.product_name, transferred_products.productNumbers, transferred_products.destination,transferred_products.comment,  pharmas.name, transferred_products.created_at 
             FROM table_of_products, transferred_products, pharmas
             WHERE transferred_products.id='$id'
             AND table_of_products.id=transferred_products.product_id
             AND pharmas.id= '$destination' ");

            $queryAutre=DB::select("SELECT table_of_products.product_name, transferred_products.productNumbers, transferred_products.destination, transferred_products.comment, transferred_products.created_at 
            FROM table_of_products, transferred_products
            WHERE transferred_products.id='$id'
            AND table_of_products.id=transferred_products.product_id
            AND transferred_products.destination= 0 ");

            $destination1=DB::select('SELECT id,name FROM pharmas ');
            
            return view('/stock/options')->with('date',$date)
                                        ->with('id',$id)
                                        ->with('query',$query)
                                        ->with('destination',$destination1)
                                        ->with('queryAutre',$queryAutre);
        }

        public function updateTransfer(Request $request,$id){
            $stock_id=Auth::id();

                $date=$request->date;
                $newdate=date("d F y", strtotime($date));
                 
                if($request->productNumbers!=null){

                    $product_id = DB::table('transferred_products')
                    ->where('id', $id)
                    ->value('product_id');
                       
                    $Instock = DB::table('product_in_stock_counter')
                    ->where('product_id', $product_id)
                    ->where('stock_id',  $stock_id)
                    ->value('totalInStock');
                         
                    $request->validate(['productNumbers'=>'required|lte:'.(int)$Instock]);
                    $updateNumber=DB::table('transferred_products')
                    ->where('id',$id)
                    ->update(['productNumbers'=>$request->productNumbers]); 

                    $Instock_pharma = DB::table('pharma_counters')
                    ->where('product_id', $product_id)
                    ->where('pharma_id',  $request->destination)
                    ->value('number');

                    // if($request->productNumbers>$Instock_pharma){
                        
                    // }
                }
                else
                if($request->comment!=null){
                    $updateComment=DB::table('transferred_products')
                    ->where('id',$id)
                    ->update(['comment'=>$request->comment]);  
                }  else

                 if($request->destination!=null){
                    $updateDestination=DB::table('transferred_products')
                    ->where('id',$id)
                    ->update(['destination'=>$request->destination]); 
  
                }

               return redirect()->back()->with('message','Modification éffectué');
            }

            public function finishedProductView(){
                $not_checked=DB::table('_finshed_product_status')
                        ->where('status',0)
                        ->get('status');

               

                $id=Auth::id();

                $query_finidhed_product=DB::select("SELECT table_of_products.product_name, product_in_stock_counter.totalInStock,_finshed_product_status.status 
                FROM table_of_products, product_in_stock_counter,_finshed_product_status
                WHERE table_of_products.id=product_in_stock_counter.product_id
                AND product_in_stock_counter.stock_id='$id'
                AND _finshed_product_status.stock_id='$id'
                AND _finshed_product_status.product_id=product_in_stock_counter.product_id
                AND _finshed_product_status.stock_id='$id'
                AND product_in_stock_counter.totalInStock=0");

                
                return view('/stock/finishedproduct')->with('query_finidhed_product',$query_finidhed_product)->with('not_checked',$not_checked);

            }



            public function finishedStock($Stock_id, $product_id){
                #update status the status

                $get_st=DB::table('_finshed_product_status')
                        ->where('Stock_id',$Stock_id)
                        ->where('product_id',$product_id)
                        ->value('id');
                        
                
                if($get_st==null){
                    $create_new=new finished_product();
                    $create_new->stock_id=$Stock_id;
                    $create_new->product_id=$product_id;
                    $create_new->save();
                }
                else{
                    $update=DB::table('_finshed_product_status')
                    ->where('id', $get_st)
                    ->update(['status' =>0 ]);
                }
                
            }

            public function viewed_finished_product($name){
                $stock_id=Auth::id();
                $product_id=DB::table('table_of_products')
                                    ->where('product_name',$name)
                                    ->value('id');
                $update_status=DB::table('_finshed_product_status')
                                    ->where('product_id',$product_id)
                                    ->where('stock_id',$stock_id)
                                    ->update(['status'=>1]);
                return redirect()->back()->with('message',' vue');

            }

            function cancelTransfer($id){
                #the agurment(id) above is the transfer id
                
                $stock_id=Auth::id();

                $date=DB::table('transferred_products')
                            ->where('id',$id)
                            ->value('created_at');
                #new format
                $newFomat=date("d F Y",strtotime($date));
               
                
                $destination=DB::table('transferred_products')
                            ->where('id',$id)
                            ->value('destination');

                #number of product transferred
                $number_of_product=DB::table('transferred_products')
                ->where('id',$id)
                ->value('productNumbers');

                #product id   from transferred_products
                $product_id=DB::table('transferred_products')
                ->where('id',$id)
                ->value('product_id');

                #stock product counter

                $instock=DB::table('product_in_stock_counter')->where('stock_id',$stock_id)
                ->where('product_id',$product_id)->value('totalInStock');

                $new_Stock=$instock+$number_of_product;
                
                # update stock counter 
                $update_Status_stock_counter_=DB::table('product_in_stock_counter')
                ->where('product_id',$product_id)->where('stock_id',$stock_id)
                ->update(['totalInStock'=>$new_Stock]);

                #Get in counter data
                $pharma_number_of_product=DB::table('pharma_counters')
                ->where('product_id',$product_id)
                ->where('stock_id',$stock_id)
                ->where('pharma_id',$destination)
                ->value('number');


                #update pharma counter

                $new_stock_pharma=$pharma_number_of_product-$number_of_product;
                $update_pharma_counter=DB::table('pharma_counters')
                ->where('product_id',$product_id)
                ->where('stock_id',$stock_id)
                ->where('pharma_id',$destination)
                ->update(['number'=>$new_stock_pharma]);

                #update status
                DB::table('transferred_products')->where('id',$id)->update(['status'=>0]);

                 return redirect()->route('stock.transfertSpecific',['date'=>$newFomat])->with('message',' transfert annuler');

            }

}