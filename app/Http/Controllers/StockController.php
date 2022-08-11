<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Products;
use App\Models\ProductsAdded;
use Illuminate\Http\Request;

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
        return view('stock/home');
    }

    function addNewProduct(){

        return view('stock/newproduct');

    }

    function insertProduct(Request $request){



        $product_added=new ProductsAdded();
        $product=new Products();
        
        $manufacturer=DB::select('SELECT manufacturer_name FROM table_of_products');
        $name=DB::select('SELECT product_name FROM table_of_products');
        ///
        $productName=$request->nom;
        $manufacturer=$request->fabricant;
        


        $check = DB::table('table_of_products')
        ->where('product_name', '=',$request->nom)
        ->where('manufacturer_name', '=', $request->fabricant)
        ->first();


        if(is_null($check)){
            
            // if a product (as name and manufacturer) already exists 
            

            $product->product_name=$request->nom;
        
            $product->manufacturer_name=$request->fabricant;
            $product->stockID=$request->stockID;

            $product->save();


            $product_added->product_id= $product->id;
            
            $product_added->stock_id=$request->stockID;
                
            $product_added->price=$request->prix;
            
            $product_added->number=$request->nombre;

            $product_added->remaining=$request->nombre;

            $product_added->prixtotal=$request->prixtotal;

            $product_added->dateExpiration=$request->dateExpiration;  
                    
            $product_added->comment=$request->comment;

            $save_product_delails=$product_added->save();

            

            if($save_product_delails){
                return  redirect()->back()->with('message','Produit enregistré');
              }else{
                  return  redirect()->back()->with('message',' Erreur');
              }
           
       
        

        }else {
           
           //new product in database
           // ins
            
            $check1 = DB::table('table_of_products')
            ->where('product_name', '=',$request->nom)
            ->where('manufacturer_name', '=', $request->fabricant)
            ->get();
           // $array=(array)$check1;
            $array = json_decode(json_encode($check1), true);
           // print_r($array);

            foreach ($check1 as $key ) {

                
                            $product_added->product_id=$key->id;
                            
                            $product_added->stock_id=$request->stockID;
                            
                            $product_added->price=$request->prix;
                            
                            $product_added->number=$request->nombre;

                            $product_added->remaining=$request->nombre;

                            $product_added->prixtotal=$request->prixtotal;

                            $product_added->dateExpiration=$request->dateExpiration;  
                                    
                            $product_added->comment=$request->comment;

                            $save=$product_added->save();

                    if($save){
                        return  redirect()->back()->with('message','Produit enregistré');
                      }else{
                          return  redirect()->back()->with('message',' Erreur');
                      }
                        


            

       }

    }
        

    }

    function displayProduct() {
        //$getAllProduct=();
    
    }

    function getretreiveview($id){
        $product=DB::select("SELECT * FROM table_of_products WHERE StockID='$id'");
        return view('stock/retreiveproduct');
    }


}
