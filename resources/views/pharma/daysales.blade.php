@extends('layouts.app')

@section('content')


<style>
  #sum{
    font-weight: bold;
    font-size: 20px;
  }
  td{
    font-weight: bold;
    font-size: 20px;
  }
</style>
<div class="container">

<div class="row">
    <div class="col-sm">
      <div class="col-sm left">
        <h1><a class="btn btn-secondary" style="font-size: 20px;" href="{{Route('pharma.saleslist')}}">Retour</a></h1>
      </div>
    </div>

    <div class="col-sm">
      <div class="col-sm  right">
          <h1> <a href="{{Route('pharma.dashboard')}}" class="btn btn-secondary" style="font-size: 20px; float:right;" >Accueill</a></h1>
      </div>
    </div>
  </div>

  <h2>Vente du {{$date}}</h2>

<table class="table">
  <thead>

    <th>Heure</th>
    <th>Nom</th>
    <th>Nombre</th>
    <th>Prix</th>
    <th  style="text-align:right;">Prix total</th>
    <th style="text-align:right;"> Plus</th>
    
  </thead>
  <?php 
      foreach($query as $row){
    ?>
  <tr>
    <td>{{ date(' H:i',strtotime($row->created_at))}}</td>
    <td>{{$row->product_name}}</td>
    <td >{{number_format($row->number)}}</td>
    <td style="text-align:center;">{{number_format($row->price)}}</td>
    <td style="text-align:right;">{{number_format($row->totalprice)}}</td>
    <td style="text-align:right;"><a href="">plus</a></td>
    
    
  </tr>
  <?php 
 
    }
     
    $sum=0;
    foreach($query as $row){
      $sum+=$row->totalprice;
    }
 
    ?>
    <b><tr>
      <td  id="sum"></td>
      <td></td>

      <?php 
 
          $total_number=0;
          foreach($query as $row){
          $total_number+=$row->number;
          }

      ?>

      <td style=" color:green;">  {{number_format($total_number)}}</td>
      <td></td>
      <td  style="text-align:right; color:green;" id="sum"> {{number_format($sum)}}</td>
    </tr></b>
</table>


</div>


@endsection