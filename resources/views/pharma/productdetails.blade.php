@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">

      <div class="col-sm">
          <div class="col-sm left">
                <a href="{{Route('pharma.stock')}}" class="btn btn-secondary" style= 'font-size:20px; '>Retour</a><br><br>
          </div>
      </div>

      <div class="col-sm">
          <div class="col-sm right">
              <a href="{{Route('pharma.dashboard')}}" class="btn btn-secondary" style='float:right; font-size:20px; '>Accueill</a><br><br>
          </div>
      </div>

  </div>
  <h2>{{$name}} Reçu </h2>

  <div class="table" style="width: 60%;">
      <table class="table">
          <thead>
            <th>JOUR & Heure</th>
            <th>Nombre</th>

          </thead>
          <?php 
          foreach($query as $row){

          ?>  
          <tr>
            <td>{{date('d,M,Y à H:i:s',strtotime($row->created_at))}}</td>
            <td>{{$row->productNumbers}}</td>
            <td></td>
          </tr>
          <?php 
          }
          ?>
      </table>
  </div>
</div>
@endsection