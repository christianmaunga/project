@extends('layouts.app')

@section('content')
<title>Pharmacie | Accueil</title>
<div class="container" style="margin-top: 20px;">
<div class="row">
<div class="col-sm" style="font-size:20px;">
<p>Dernieres ventes</p>
<h2><p> Dérnieres ventes | <a href="">voir plus...</a></p></h2>

    <table class="table"  style="width: 80%; ">
        <thead>
            <th>Nom</th>
            <th>nombre</th>
            <th>prix unitaire</th>
            <th>prix</th>
    
        </thead>
        <?php
            foreach($query as $row){

        ?>
        <tr>
            <td>{{$row->product_name}}</td>
            <td>{{$row->number}}</td>
            <td>{{$row->price}}</td>
            <td>{{$row->totalprice }}</td>
        </tr>
        <?php
            }
        ?>
    </table>
</div>


<div class="col-sm right" style="float:right; width: 50%; height:100px; ">
    
    <br><a type="button"  class="btn btn-success" style="font-size:50px; float:center;" href="{{Route('pharma.sell')}}">Vendre Produit(s)</a><br><br>
    <a type="button" class="btn btn-info" style="font-size:50px; margin-top:20px; float:center;" href="{{Route('pharma.stock')}}">Produit en stoque</a>
    

</div>

</div>
   

</div>
@endsection
