@extends('layouts.app')

@section('content')

<div class="container">
<a href="{{Route('stock.dashboard')}}" class="btn btn-secondary" style="float: right; font-size: 20px;"> Accueil</a>

<p>Liste des produits plus en stock</p>

<table class="table">
  <tr>
    <th>Nom du produit</th>
    <th> #</th>
    <th>status</th>
  </tr>
  
    <?php
      foreach($query_finidhed_product as $row){

          
    ?>

    <tr>

    <td style="width: 30%;">{{$row->product_name}}</td>
    <td>{{$row->totalInStock }}</td>
      

          @if($row->status==0)
           <td><a style="color: red;" href="{{Route('stock.checked',['product_name'=>$row->product_name])}}">coucher ✔ </a></td>
           
          @else
            <td style="color: green;">vu</td>

           @endif


    <?php
      
        }
    ?>
  </tr>
</table>

</div>


@endsection
