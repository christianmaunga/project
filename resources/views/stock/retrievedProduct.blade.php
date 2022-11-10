@extends('layouts.app')

@section('content')


<div class="container">

<a href="{{Route('stock.dashboard')}}" class="btn btn-secondary" style='float:right; font-size:20px; '>Accueill</a>

  <table>
    <thead>
      <th>date</th>
    </thead>
    <?php

    foreach($query as $row){
      
      
    ?>
    <tr>
      <td>{{ $row->created_at}}</td>
    </tr>
    <?php
    }
    ?>
  </table>

</div>


@endsection