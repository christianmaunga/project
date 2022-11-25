@extends('layouts.app')

@section('content')

<style>
  a{
  text-decoration: none;
}
a:hover {
  text-decoration:underline;
}
</style>

<title>Stock | List</title>
<link rel="stylesheet" href="">

<div class="container">

   <a href="{{Route('stock.dashboard')}}" class="btn btn-secondary" style='float:right; font-size:20px; '>Accueill</a>
  
  <h2><p for="">Liste des produits en stock</p></h2>


<table class="table">
    <thead>
      
        <th>Nom</th>
        <th>Restant</th>
        <th>historique</th>

    </thead>

    <?php
      foreach($query as $row){
    ?>

    <tr>

      <td>{{$row->product_name}}</td>
      <td>{{$row->totalInStock}}</td>
      <td><a href="{{Route('stock.historic',['id' => $row->product_id])}}">historique </a></td>

    </tr>
    <?php
    }
?>

</table>


</div>



@endsection