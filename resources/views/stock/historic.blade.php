@extends('layouts.app')

@section('content')


<div class="container">
  <a href="{{Route('stock.dashboard')}}" class="btn btn-secondary" style='float:right;'>Accueill</a><br><br>

 
  

  <p>Historique</p>

  <table class="table" >
    <thead>
    <th>date</th>
    <th>Nombre</th>
    <th>prix d'achat unitaire</th>
    <th>prix d'achat</th>
    </thead>
    <?php
      foreach($query as $row){
    ?>
    <tr>
      <td>{{date('d,M,Y à H:i:s',strtotime($row->created_at))}}</td>
      <td>{{$row->number}}</td>
      <td>{{$row->price}}</td>
      <td>{{$row->comment}}</td>

    
    </tr>
    <?php
      }
  ?>
  </table>
 

</div>


@endsection