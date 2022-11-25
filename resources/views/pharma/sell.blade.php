@extends('layouts.app')

@section('content')
</style>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

 <!-- Compiled and minified CSS -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<title>Pharmacie | vendre</title>

<script src="{{ asset('js/sellProductPharma.js') }}"></script>


<script src="{{ asset('jqueryui/jquery-ui.js') }}"></script>

    <div class="container">

    @if(session()->has('message'))

    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>

    @endif

        <a href="{{Route('pharma.dashboard')}}" class="btn btn-secondary" style='float:right; font-size:20px; '>Accueil</a>
        
        <div>
        <h3>Vendre Produits</h3 >
        </div>


      <form action="{{Route('pharma.sellProduct')}}" method="POST" autocomplete="off">
      @csrf
        <div class="row ">
          
                <div class="form-group  input-field">
                  <p>Nom</p> 
                  <input type="text" name="product_name" id="ProductName" class="form-control" required>

                  <span style="color: red;">
                        @error('product_name')
                      {{$message}}
                      @enderror
                   </span>
                </div>

                
                <div class="form-group">
                  <p>Prix unitaire</p>
                  <input type="text" name="price" id="selling_price" class="form-control"  readonly>
                </div>
                
                <div class="form-group">
                  <p>Disponible en stocks</p>
                  <input type="text" name="instock" id="instock" class="form-control"  readonly>
                </div>

                <div class="form-group"">
                  <p>Nombre</p>
                  <input type="number" name="number" id="boughtnumber" class="form-control"  required>
                  <span style="color: red;">
                        @error('number')
                          {{$message}}
                        @enderror
                 </span>
                </div>


                <div class="form-group">
                  <p>Prix total</p>
                  <input type="text" name="totalprice" id="total_price" class="form-control" readonly>
                </div>

                <div class="form-group">
                  <p>Libelle</p>
                  <textarea class="form-control" id="details" rows="3" name="comment" required></textarea> <br>
                  @error('details')
                          {{$message}}
                        @enderror
                </div>

                <div class="">
                <button class="btn btn-success" style="float:right; font-size: 30px;">Vendre</button>
                </div>
                <input type="hidden" id="pharmaId" value="{{Auth::id()}}" >
                <input type="hidden" name="product_id" id="product_id">
        </div>

        </form>

    </div>
    
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">-
    <!--Compiled and minified JavaScript -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script> 
@endsection