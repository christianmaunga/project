@extends('layouts.app')

@section('content')

<style>
a{
  text-decoration: none;
}
a:hover{
  text-decoration:underline;
}

td{
  font-size: 23px;
}
</style>

<title>Stock | Ventes</title>

<div class="container">




  <div class="row">

    <div class="col-sm">
        <div class="col-sm left">
               <h2>Vente</h2>
        </div>
    </div>

    <div class="col-sm">
        <div class="col-sm right">
             <a href="{{Route('stock.dashboard')}}" class="btn btn-secondary" style='float:right; font-size:20px; '>Accueill</a><br><br>
        </div>
    </div>

  </div>

  
  <table>
    <thead>
      <th>Date</th>
    </thead>
    <?php

    foreach($dates as $row){
      
   
    ?>
    <tr>
     <td><a href="{{Route('stock.transfertSpecific',['date'=>$row->days_formatted])}}">Le {{$row->days_formatted}}</a></td>
     
  </tr>
    <?php
    }
    ?>
  </table>

</div>


@endsection