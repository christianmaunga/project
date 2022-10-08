@extends('layouts.app')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

 <!-- Compiled and minified CSS -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
     


<script src="{{ asset('js/retreiveproduct.js') }}"></script>
<script src="{{ asset('jqueryui/jquery-ui.js') }}"></script>


<div class="container">

<div >
  <h4 style="width:50%;">Rétrait<h4>
<a href="{{Route('stock.dashboard')}}" class="btn btn-primary" style='float:right; '>Accueill</a>

</div>

  <form action="{{Route('stock.transfertProduct')}}" autocomplete="off">
  @csrf

          <div class="row">


              <div class="form-group  input-field" >
                
              

                <label for="">Nom du produit</label>         
                <input type="text" class="form-control " name="nom"  min="100" id="ProductName" name="name" style="width: 70%;" autofocus="autofocus"required><br>

              </div>      

            <div class="form-group  " >  

                <label for="">Prix</label>         
                <input type="number" class="form-control " name="price"  min="100" id="price" style="width: 70%;" readonly required><br>

            </div>


            <div class="form-group  " >  

                <label for="">Produits restants</label>         
                <input type="number" class="form-control " name="remaing_products"  min="100" id="remaing_products" style="width: 70%;" readonly required><br>

            </div>

            <div class="form-group " >  

                <label for="">Produit rétiré</label>         
                <input type="text" class="form-control " name="retreived_product"  min="100" id="retreived_product" style="width: 70%;" required><br>

            </div>

            <div class="form-group " >  

                <label for="">Valeur des produits pris</label>         
                <input type="text" class="form-control " name="total_price"  min="100" id="total_price"  style="width: 70%;" readonly required><br>

            </div>

            <div class="form-group " >  
              <label for="">Destination</label>
              <select name="" id="" class="form-control " style="width: 70%;">
                <option >---</option>
                <option value="">Pharmacie</option>
                <option value="">Autre</option>
              </select><br> 
            </div>


            <div class="form-group col-md-4">
              <label for="">comment</label>
              <textarea name="comment" id="comment"class="form-control " clo rows="6"></textarea><br>
            </div>

            <div class="form-group">
              <button class="btn btn-danger" style="float: right;">Enregistrer sortie</button>
              
            </div>
            <input type="hidden" value="{{Auth::user()->id}}" id="stockid"name="stockID">  


          </div>
 </form>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">-
    <!--Compiled and minified JavaScript -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script> 

</div> 

@endsection