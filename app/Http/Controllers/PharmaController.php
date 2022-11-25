<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\soldProduct;
use App\Models\tableOfProducts;
use Illuminate\Support\Facades\Redirect;

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
                            ORDER BY  sold_products.created_at DESC LiMIT 11 ");
        return view('pharma/home',['query'=>$query]);
    }

    public function sellingView(){

        return view('pharma/sell');
    }

    public function stockView(){

        $pharma_id=Auth::id();

        
        $retrieved=DB::select("SELECT table_of_products.product_name, pharma_counters.number 
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
        $user_id=Auth::id();
        
        $Instock = DB::table('pharma_counters')
                        ->where('product_id', $request->product_id)
                        ->where('stock_id',  $user_id)
                        ->value('number');
        
        $request->validate([
            'product_name'=>'required|exists:table_of_products',
            'number'=>'required|lte:'.(int)$Instock,
            'comment'=>'required',
        ]);

        $sold_product=new soldProduct();

        $pharma_id_=Auth::id();

 
        $sold_product->pharma_id=$pharma_id_;
        $sold_product->product_id=$request->product_id;
        $sold_product->number=$request->number;
        $sold_product->price=$request->price;
        $sold_product->totalprice=$request->totalprice;
        $sold_product->status=true;
        $sold_product->comment=$request->comment;

        $save= $sold_product->save();
        $new_stock=$Instock - $request->number;
        $update=DB::table('pharma_counters')
                    ->where('product_id', $request->product_id)
                    ->where('stock_id',  $user_id)
                    ->update(['number'=>$new_stock]);
        $product_name=DB::table('table_of_products')
                                ->where('id',$request->product_id)
                                ->value('product_name');
                    

        if($save){
                return redirect( )->back()->with('message','Vente de(s) '.$request->number.' '.$product_name.' enregistré');
                
        }else{
            return redirect()->back()->with('message','error');
        }

        



    }
}
