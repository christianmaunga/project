@extends('layouts.app')

@section('content')
<title>Stock | {{$date}}</title>
<div class="container">

<div class="row">
    <div class="col-sm">
      <div class="col-sm left">
        <h1><a class="btn btn-secondary" style="font-size: 20px;" href="{{Route('stock.RetreivedData')}}">Retour</a></h1>
      </div>
    </div>

    <div class="col-sm">
      <div class="col-sm  right">
          <h1> <a href="{{Route('stock.dashboard')}}" class="btn btn-secondary" style="font-size: 20px; float:right;" >Accueill</a></h1>
      </div>
    </div>
  </div>

  <h2>{{$date}}</h2>

<table class="table">
  <thead>
    <th>Nom</th>
    <th>Nombre</th>
    <th>Heure</th>
    <th>changer</th>
  </thead>
  <?php 
      foreach($query as $row){
    ?>
  <tr>
    
    <td>{{$row->product_name}}</td>
    <td>{{$row->productNumbers}}</td>
    <td>{{ date(' H:i',strtotime($row->created_at))}}</td>
    <td>{{$row->destination}}</td>
    
  </tr>
  <?php 
    }
    ?>
</table>


</div>
@endsection