@extends('layouts.app')

@section('content')

<style>
  td{
    font-weight: bold;
    font-size: 20px;
  }
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
      @if($row->totalInStock==0)  
      <td style="color: red; ">{{$row->totalInStock}}</td>
      @else
      <td >{{$row->totalInStock}}</td>
      @endif
      <td><a href="{{Route('stock.historic',['id' => $row->product_id])}}">historique </a></td>

    </tr>
    <?php
    }
?>

</table>


<div class="row">
  <div class="col-sm">

  <div class="col-sm left">
    
    </div>
    <div class="col-sm right">
    
    </div>
  </div>
</div>

</div>



@endsection