@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="/css/addproduct.css">
<script src="{{ asset('js/addproduct.js') }}"></script>


<!--DATEPICKER STYLING-->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>


 <!-- Compiled and minified CSS -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>


  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <!-- <link rel="stylesheet" href="/resources/demos/style.css"> -->

  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <script src="{{ asset('jqueryui/jquery-ui.js') }}"></script>



<title>Stock | Nouveau</title>
<div class="container">

<div class="row">

    <div class="col-sm">
      <div class="col-sm left">
        <h2>Nouveau produit</h2>
      </div>
    </div>

    <div class="col-sm">
      <div class="col-sm right">
        <h1> <a href="{{Route('stock.dashboard')}}" class="btn btn-secondary" style="font-size: 20px;" >Accueill</a></h1>
      </div>

</div>
@if(session()->has('message'))

<div class="alert alert-success">
    {{ session()->get('message') }}
</div>

@endif

<form action="{{Route('stock.newproduct')}}" method="post" name="product"  autocomplete="off" >
  @csrf
<div id="show_item">
  <div class="row" style="margin-top:10px">
   
    
          <div class="col-md-4 mb-3 input-field">

              <label for="">Nom</label>
              <input type="text" name="nom" id='name' class="form-control"  autofocus="autofocus" required> 

          </div>


          <div class="col-md-2 mb-3">

            <label for="">Fourniseur</label>
            <input type="text" name="fabricant" id="fabricant" class="form-control" required> 

          </div>

          <div class="col-md-2 mb-3">

            <label for="">Prix d'achat</label>
            <input type="number" name="prix" id="prix"  min='1' min="100"  class="form-control"   required> 

          </div>

          <div class="col-md-2 mb-3">

            <label for="">Nombre </label>
            <input type="number" name="nombre" id="nombre"  min='1'  class="form-control"  required> 

          </div>

          <div class="col-md-2 mb-3">

            <label for="">Prix Total</label>
            <input type="number" name="prixtotal" id="prixtotal" min='1' class="form-control" readonly required> 

          </div>

          <div class="col-md-3 mb-3">
            <label for="">Medicament/Outil</label>

                <select name="type"  class="form-control input-lg dynamic"  id="">
                  <option value="">---</option>
                    <option value="medicine">Medicament</option>
                    <option value="tools">Outil</option>

                </select>
                <span style="color: red;">
                  @error('type')
                  {{$message}}
                  @enderror
                </span>

          </div>

          <div class="col-md-2 mb-3">

            <label for="">Date d'expiration</label>
            <input type="date" name="dateExpiration" id="date" class="form-control"    required> 

          </div>

          

          <div class="col-md-4 mb-3">

          <!-- <label for="">Libellé</label> -->
          <input type="hidden" name="comment" value="nouveau produit" class="form-control"  id="comment"  rows="5"> 

          </div>


    </div>
    <input type="hidden" value="{{Auth::user()->id}}" name="stockID">  
    
 
    </div>
    <button class="btn btn-success" style='float:right;font-size: 20px;'>Enregistrer</button><br>
    
    </form>


    <div id="panels">


  </div>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">-
    <!--Compiled and minified JavaScript -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script> 




@endsection