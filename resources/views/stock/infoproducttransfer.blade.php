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

<title>Stock | {{$date}}</title>
<div class="container">

<a href=" {{Route('stock.RetreivedData')}}" class="btn btn-secondary" style="font-size: 20px;" >Retour</a>
<a href="{{Route('stock.dashboard')}}" class="btn btn-secondary" style="float: right; font-size: 20px;"> Accueil</a>
 


  <h2 style="margin-top: 3%;">Le {{$date}}</h2>
  <h2>Pharmacie Tableau</h2>

<table class="table">
  <thead>
    <th>Nom</th>
    <th>Nombre</th>
    <th>Heure</th>
    <th>Destination</th>
    <th> </th>
  </thead>
  <?php 
      foreach($query as $row){
    ?>
  <tr>
    
    <td>{{$row->product_name}}</td>
    <td>{{$row->productNumbers}}</td>
    <td>{{ date(' H:i',strtotime($row->created_at))}}</td>
    <td>{{$row->name}}</td>
     <td><a href="{{  url('stock/options/ ' . $date . '/' . $row->id )}}">Plus </a></td>

    
  </tr><?php
      }
  ?>

  <tr>
    <td ></td>
    <?php

      $number_of_product=0;

        foreach($query as $row_pharma){
          $number_of_product+=$row_pharma->productNumbers;
        }
  

    ?>
    <td style=" color:green;"> {{number_format($number_of_product)}}<td>  
  </tr>
 
</table>

<h2>Autre Tableau</h2>
<table class="table">
  <thead>
  <th>Nom</th>
  <th>Nombre</th>
  <th>Jour Heure</th>
  </thead>

  <tr>
    <?php 
      foreach($query2 as $row){
    ?>
    <td>{{$row->product_name}}</td>
    <td>{{$row->productNumbers}}</td>
    <td>{{ date(' H:i',strtotime($row->created_at))}}</td>
    <td><a href="{{  url('stock/options/ ' . $date . '/' . $row->id )}}"> Plus</a></td>
  </tr>
  <?php
      }

      
      $total_number=0;
      foreach($query2 as $row_num_other){
      $total_number+=$row_num_other->productNumbers;
      }
  ?>

  <tr>
        <td></td>
        <td style=" color:green;">{{number_format($total_number)}}</td>
  </tr>
</table>


</div>
@endsection