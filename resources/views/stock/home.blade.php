@extends('layouts.app')

@section('content')
<div class="container">
   @if(session()->has('message'))

            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>

  @endif


<a href="{{Route('stock.addNewproduct')}}" class="btn btn-primary">Ajouter produit</a>
<a href="{{Route('stock.retreiveProductView')}}" class="btn btn-danger" style="float: right;"> retirer produit</a>

<div class="row" style="margin-top: 50px;">

    <div class="col-sm">
     Produits ajouter récement
     <table class="table" style="background-color:rgb(146, 247, 247);">
       
       <thead>
         
           <th>Nom</th>
            <th>nombre()</th>
            <th>jour d'ajout</th>
         
       </thead>
       <tbody>
         <tr>
           <td>blablablq</td>
           <td>5</td>
           <td>le 5/03/2022</td>
         </tr>
       </tbody>
     </table>

    </div>
    <div class="col-sm">
      Produit retirer récement

    <table class="table" style="background-color:#fc8181;">
      <thead>
         
           <th>Nom</th>
            <th>nombre</th>
            <th>jour de retrait</th>

       </thead>
       <tbody>
       <tr>
           <td>blablablq</td>
           <td>5</td>
           <td>le 5/03/2022</td>
         </tr>

       </tbody>
     </table>

    </div>

</div>


</div>
@endsection
