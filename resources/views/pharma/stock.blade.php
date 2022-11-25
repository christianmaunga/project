@extends('layouts.app')
@section('content')
<title>Pharma | stoque</title>

<div class="container">
<a href="{{Route('pharma.dashboard')}}" class="btn btn-secondary" style='float:right; font-size:20px; '>Accueil</a>


    <div class="">
    <caption>Product en stock</caption>
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
            <td><a href="">details</a></td>
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