<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Models\soldProduct;
use App\Models\tableOfProducts;
use Illuminate\Support\Facades\Redirect;
use Mockery\Matcher\Type;

class PharmaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:pharma');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $pharma_id=Auth::id();
        $query=DB::select("SELECT table_of_products.product_name, sold_products.number,sold_products.price, sold_products.totalprice
                            FROM table_of_products,sold_products
                            WHERE table_of_products.id=sold_products.product_id
                            AND sold_products.pharma_id='$pharma_id'
                            ORDER BY  sold_products.created_at DESC LiMIT 10 ");
        return view('pharma/home',['query'=>$query]);
    }

    public function sellingView(){

        return view('pharma/sell');
    }

    public function stockView(){

        $pharma_id=Auth::id();

        
        $retrieved=DB::select("SELECT table_of_products.product_name, pharma_counters.number, pharma_counters.product_id
        FROM table_of_products, pharma_counters 
        WHERE table_of_products.id=pharma_counters.product_id
        AND pharma_counters.pharma_id ='$pharma_id'");
      
        return view('pharma/stock',['retrieved'=>$retrieved]);
    }
    public function serachproduct($id){

        $query=DB::select(" SELECT table_of_products.product_name, product_in_stock_counter.selling_price, product_in_stock_counter.product_id, pharma_counters.number 
                            FROM table_of_products, pharma_counters,product_in_stock_counter
                            WHERE table_of_products.id=pharma_counters.product_id
                            AND product_in_stock_counter.product_id=table_of_products.id
                            AND pharma_counters.number > 0
                            AND pharma_counters.pharma_id='$id' ");
        return response()->json($query);
    }

    public function submitsell(Request $request){
        
            $data = $request->input('selling');
            $pharma_id=Auth::id();
           
               
            $validatedData = [];
            
           foreach($data as $row){
              
            $Instock=[];
                $Instock = DB::table('pharma_counters')
                ->where('product_id', $row['product_id'])
                ->where('stock_id',  $pharma_id)
                ->value('number');

             
                $validatedRow = Validator::make($row, [
                    'product_name'=>'required|exists:table_of_products',
                    'number' => 'required|lte:'.(int)$Instock,
                    'price'=>'required',
                    'totalprice'=>'required',
                    'product_id'=>'required'
        
                  ]);

                  if ($validatedRow->fails()) {
                    
                    return redirect()->back()->withErrors($validatedRow)->withInput();

                  }

                  $validatedData[] = $row;

                
                $sold_product=new soldProduct();

                $sold_product->pharma_id=$pharma_id;
                $sold_product->product_id=$row['product_id'];
                $sold_product->number=$row['number'];
                $sold_product->price=$row['price'];
                $sold_product->totalprice=$row['totalprice'];
                $sold_product->status=1;
                $sold_product->comment='vente';
                $save = $sold_product->save();

                if($save){

                    return redirect( )->back()->with('message','Vente enregistré');
                        
                }else{
                    return redirect()->back()->with('message','error');
                }

                



                    }
                  

    }

    public function salesview(){

          $user=Auth::id();
    
                
                $dates = DB::table('sold_products')
                            ->where('pharma_id',$user)
                            ->select(DB::raw('DATE_FORMAT(created_at, "%d %M %Y") as days_formatted'))
                            ->distinct()
                            ->orderBy('created_at', 'DESC')
                            ->get();

              return view('/pharma/sales',['dates'=>$dates]);
       
    }


    public function daySales($date){

        $newdate=date("Y-m-d", strtotime($date));
        $pharma_id=Auth::id();
        
        $query=DB::select("SELECT table_of_products.product_name, sold_products.number, sold_products.price,  sold_products.totalprice,sold_products.created_at 
        FROM table_of_products, sold_products
        WHERE DATE_FORMAT(sold_products.created_at, '%Y-%m-%d') ='$newdate'
        AND table_of_products.id=sold_products.product_id
        And sold_products.pharma_id='$pharma_id'
        ORDER BY  created_at DESC ")
        ;
        $sum=DB::select("SELECT SUM(totalprice) 
        FROM sold_products
        WHERE DATE_FORMAT(created_at, '%Y-%m-%d')='$newdate'
        And pharma_id='$pharma_id'");

      return view('/pharma/daysales')->with('query',$query)->with('date',$date)->with('sum',$sum);
      //return $sum;

    }

     public function productDetails($id){
        $pharma_id=Auth::id();
        $name=DB::table('table_of_products')
                ->where('id',$id)
                ->value('product_name');
                
        $query=DB::table("transferred_products")
                        ->where('product_id',$id)
                        ->where('destination',$pharma_id)
                        ->get();
           // return $name;
            return view('/pharma/productdetails')->with('name',$name)->with('query',$query);
    }
}
