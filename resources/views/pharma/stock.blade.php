@extends('layouts.app')
@section('content')
<title>Pharma | stoque</title>
<style>
  th{
    font-size: 20px;
  }

table {
  
  border-radius: 10px;
}

a{
  text-decoration: none;
}
a:hover {
  text-decoration:underline;
}
p{
  font-size: 30px;
}
</style>
<div class="container">
<a href="{{Route('pharma.dashboard')}}" class="btn btn-secondary" style='float:right; font-size:20px; '>Accueil</a>
<p>Product en stock</p>

    <div class="">
   
        <table class="table">
          
          <tr>
            <th>nom</th>
            <th>Produit restant</th>
            <th>details</th>
            
          </tr>
          <?php

          foreach($retrieved as $row){

          
          ?>

          <tr>
            <td>{{$row->product_name}}</td>
            <td>{{$row->number}}</td>
            <td><a href="{{Route('pharma.productreceived',['id'=>$row->product_id])}}">details</a></td>
          </tr>
            <?php
            }
            ?>
        </table>
    </div>

    <script>

    

    </script>

</div>


@endsection