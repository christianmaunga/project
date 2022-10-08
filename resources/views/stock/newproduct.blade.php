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
  <a href="{{Route('stock.dashboard')}}" class="btn btn-primary" style='float:right;'>Accueill</a><br><br>
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
              <input type="text" name="nom" id='nom' class="form-control"  required> 

          </div>


          <div class="col-md-2 mb-3">

            <label for="">Fabricant</label>
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

          <!-- <div class="col-md-2 mb-3">

            <label for="">Unité de mesure</label>
            <input type="text" name="mesure" id="mesure" class="form-control"  required> 

          </div>

          <div class="col-md-2 mb-3">

            <label for="">Quantité</label>
            <input type="text" name="quantity" id="quantity" class="form-control"  required> 

          </div> -->

          <div class="col-md-4 mb-3">

          <label for="">Libellé</label>
          <textarea name="comment" class="form-control"  id="comment"  rows="5"></textarea>

          </div>

            <!-- <div class="col-md-2 mb-3">

              <button class="btn btn-primary" id="add">Ajouter plus</button>
              
            </div> -->

    </div>
    <input type="hidden" value="{{Auth::user()->id}}" name="stockID">  
    
    
    </div>
    <button class="btn btn-success" style='float:right;'>Enregistrer</button><br>
    
    </form>


    <div id="panels">


  </div>
  


<!-- <form action="{{Route('stock.newproduct')}}" method="post"> -->
  <!-- @csrf -->
<!-- <div class="row"> -->
                    
                    


                      <!-- <div class="col-sm col-lg-2" >

                        <label for="">Nom du produit</label>
                        <input type="text" class="form-control " id="nom" required>
                        
                      </div>

                      <div class="col-sm col-lg-2">

                        <label for="">fabricant</label>   
                        <input type="text"  class="form-control" id="fabricant"  required>

                      </div>

                      <div class="col-sm col-lg-2">
                        <label for="">Prix</label>
                        <input type="number"  class="form-control" id="prix" min="0" value="0"  required>
                        
                      </div>

                      <div class="col-sm col-lg-2">
                        <label for="">Nombre</label>
                        <input type="number"  class="form-control" id="nomnbre" min="0"  value="0" required>

                      </div>

                      <div class="col-sm col-lg-2">
                        <label for="">Prix total</label>
                        <input type="number"  class="form-control" id="total" min="0"  value="0" required readonly>

                      </div>

                      <div class="col-sm col-lg-2">

                        <label for="">Date d'expiration</label>
                        <input type="date" class="form-control " id="date" id="date_picker" required>

                      </div>

                      <div class="col-sm col-lg-2">
                            
                          <label for="">Unité de mesure</label>
                         <input type="text"  class="form-control " id="mesure" placeholder="kg,gramme /litre, millilitre" required>

                       </div>

                       <div class="col-sm col-lg-2">
                            
                          <label for="">quantité/piece unique</label>
                         <input type="text"  class="form-control " id="quantity" placeholder="quantité/piece unique" required>

                       </div>
                              
                        <div class="col-sm col-lg-3">
                             <label for="">libellé</label>
                             <textarea type="text"  class="form-control" id="comment" rows="3" required ></textarea>

                        </div>  -->

                        <!--</form>-->


                        <!-- <div class="col-sm col-lg-2">
                             
                          <button id="add" class="btn btn-primary" style="margin-top: 10px;"> Ajouter</button>
                                                  
                         </div>  -->



                         <!--TABLE-->

                         <!-- <table class="table table-bordered" border="solid 1px" id="mytable" style="margin-top:10px;">
                              <thead>
                              <tr>
                                
                                <th>Nom</th>
                                <th>Fabricant</th>
                                <th>Prix</th>
                                <th>Nombre</th>
                                <th>  total</th>
                                <th>expiration</th>
                                <th>Mesure</th>
                                <th>Quantité</th>
                                <th style="width: 200px; text-align:center;">libellé</th>
                                <th>Supprimé</th>
                              </tr>
                              
                              </thead>
                              <tbody>

                              </tbody> -->
                      <!-- </table>
                  
                      <div style=" text-align:right;">

                       <button type="submit" class="col-sm col-lg-2 btn btn-success" formnovalidate>Enregistré</button><br>

                      </div> -->
                    
                          
                 <!-- </div>
                 </form>
                 </div> -->


@endsection