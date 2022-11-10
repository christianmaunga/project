@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="/css/addproduct.css">
<script src="{{ asset('js/addproduct.js') }}"></script>


<!--DATEPICKER STYLING-->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>


  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <!-- <link rel="stylesheet" href="/resources/demos/style.css"> -->

  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <script src="{{ asset('jqueryui/jquery-ui.js') }}"></script>


<div class="container">
  <h2>Nouveau produit</h2>
  <a href="{{Route('stock.dashboard')}}" class="btn btn-secondary" style='float:right;'>Accueill</a><br><br>
@if(session()->has('message'))

<div class="alert alert-success">
    {{ session()->get('message') }}
</div>

@endif

<form action="{{Route('stock.newproduct')}}" method="post" name="product"  autocomplete="off" >
  @csrf
<div id="show_item">
  <div class="row" style="margin-top:10px">
   
    
          <div class="col-md-4 mb-3">

              <label for="">Nom</label>
              <input type="text" name="nom" id='name' class="form-control"  required> 

          </div>


          <div class="col-md-2 mb-3">

            <label for="">Fourniseur</label>
            <input type="text" name="fabricant" id="fabricant" class="form-control" required> 

          </div>

          <div class="col-md-2 mb-3">

            <label for="">Prix</label>
            <input type="number" name="prix" id="prix"  min='1'  class="form-control"   required> 

          </div>

          <div class="col-md-2 mb-3">

            <label for="">Nombre </label>
            <input type="number" name="nombre" id="nombre"  min='1'  class="form-control"  required> 

          </div>

          <div class="col-md-2 mb-3">

            <label for="">Prix Total</label>
            <input type="number" name="prixtotal" id="prixtotal" min='1' class="form-control" readonly required> 

          </div>

          <div class="col-md-2 mb-3">

            <label for="">Date d'expiration</label>
            <input name="dateExpiration" id="date" class="form-control" readonly  required> 

          </div>

          <div class="col-md-4 mb-3">

          <label for="">Libellé</label>
          <textarea name="comment" class="form-control"  id="comment"  rows="5"></textarea>

          </div>


    </div>
    <input type="hidden" value="{{Auth::user()->id}}" name="stockID">  
    
    
    </div>
    <button class="btn btn-success" style='float:right;'>Enregistrer</button><br>
    
    </form>


    <div id="panels">


  </div>
  




@endsection