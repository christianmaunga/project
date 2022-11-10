<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Products;
use App\Models\ProductsAdded;
use App\Models\transferredProducts;
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
                                    WHERE table_of_products.id=product_added.product_id AND table_of_products.stockID='$user' AND product_added.stock_id='$user'
                                    ORDER BY  created_at DESC LiMIT 11");

            $retreivedProducts=DB::SELECT("SELECT table_of_products.product_name, transferred_products.productNumbers, transferred_products.created_at 
                FROM table_of_products, transferred_products
                WHERE table_of_products.id=transferred_products.product_id AND table_of_products.stockID='$user' AND transferred_products.stock_id='$user'
                ORDER BY  created_at DESC LiMIT 11 ");

        
        
            return view('stock/home',['addedProducts'=>$addedProducts],['retreivedProducts'=>$retreivedProducts]);
    }



    function addNewProduct(){

        return view('stock/newproduct');

    }

    function insertProduct(Request $request){



        $product_added=new ProductsAdded();
        $products=new Products();
        
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
            
            // if the product doesn't exits in the system already do the following
            

            $products->product_name=$request->nom;
        
            $products->manufacturer_name=$request->fabricant;
            $products->stockID=$request->stockID;

            $products->totalInStock=$request->nombre;

            $products->save();


            $product_added->product_id= $products->id;
            
            $product_added->stock_id=$request->stockID;
                
            $product_added->price=$request->prix;
            
            $product_added->number=$request->nombre;

            $product_added->remaining=$request->nombre;
            

            $product_added->prixtotal=$request->prixtotal;

            $product_added->dateExpiration=$request->dateExpiration;  
                    
            $product_added->comment=$request->comment;

            $save_product_delails=$product_added->save();

            

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


                           $Instock = DB::table('table_of_products')
                           ->where('product_name', '=',$request->nom)
                           ->where('manufacturer_name', '=', $request->fabricant)
                           ->value('totalInStock');
                        

                          
                            $update= $Instock+$request->nombre;
                        
                        $update=Products::Where('product_name',$request->nom)
                                ->Where('manufacturer_name',$request->fabricant)
                                ->update(['totalInStock' =>$update ]);
                            
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

      return view('stock/retreiveproduct');
      
    }


    public function DataLiveSearch ($stockId){
   

        $product_=DB::select(
        "SELECT table_of_products.product_name, table_of_products.totalInStock, table_of_products.id, product_added.number, product_added.remaining ,product_added.price 
        FROM product_added, table_of_products 
        WHERE product_added.product_id= table_of_products.id  AND table_of_products.totalInStock > 0 AND product_added.stock_id='$stockId'");
        return response()->json($product_);
        
    }

    function TransferredProduct(Request $request){

        
        $updateStock=DB::select("SELECT remaining FROM product_added WHERE product_id='$request->stockID' AND stock_id='$request->stockID'");
        
        $products=new Products();
      // return $request->product_name;


           $Instock = DB::table('table_of_products')
                        ->where('id', '=',$request->product_id)
                        ->where('stockID', '=', $request->stockID)
                        ->value('totalInStock');


            $request->validate([
                'product_name'=>'required|exists:table_of_products',
                'retreived_product'=>'required|lte:'.(int)$Instock,
                'comment'=>'required',
                'destination'=>'required|min:4'
            ]
          );
            // if it is valid, the code will proced
            //if it not it will trow a validation exeption
            $update=$Instock-$request->retreived_product;


            $update=Products::Where('id',$request->product_id)
                            ->Where('stockID',$request->stockID)
                            ->update(['totalInStock' =>$update ]);
        

       $transferred_products =new transferredProducts();

        $transferred_products->product_id=$request->product_id;
        $transferred_products->stock_id=$request->stockID;
        $transferred_products->productNumbers=$request->retreived_product;
        $transferred_products->destination=$request->destination;
        $transferred_products->comment=$request->comment;

        $save_transfert_details=$transferred_products->save();

        if($save_transfert_details){
            return  redirect()->back()->with('message', $request->retreived_product.' '.$request->name." vers: ".$request->destination);
          }else{
              return  redirect()->back()->with('message',' Transaction impossible');
          }

    }

        function AddedData(){
            $user=Auth::id();

            $query=DB::table("table_of_products")
            ->where('stockID',$user)
            ->get();

            
            return view('stock/addedProduct',['query'=>$query]);
        }
        

        function RetreivedData(){
           
                $user=Auth::id();
    
                $query=DB::table("transferred_products")
                ->where('stock_id',$user)
                ->distinct()
                ->orderByDesc('created_at')
                ->get('created_at');
    
                $query1=DB::select("SELECT DISTINCT DAY(created_at),MONTH(created_at),YEAR(created_at) FROM transferred_products  ");
                
                return view('stock/retrievedProduct',['query'=>$query]);
            
            
            //return view('stock/retrievedProduct');
           
        }
        function historicAdded($id){
            $stock_id=Auth::id();
            $product_id=$id;

            $query=DB::SELECT("SELECT table_of_products.product_name,product_added.number,product_added.price, product_added.comment,product_added.created_at 
            FROM table_of_products, product_added 
            WHERE table_of_products.id= '$product_id'
            AND product_added.product_id= '$product_id'
            AND product_added.stock_id= '$stock_id'ORDER BY  created_at DESC");
           
           return view('stock/historic',['query'=>$query]);
           
        }
}
