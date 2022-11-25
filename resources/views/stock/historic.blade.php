@extends('layouts.app')

@section('content')

<style>
  a{
  text-decoration: none;
}
a:hover {
  text-decoration:underline;
}
</style>


<title>Stock | <?php echo $productName; ?></title>
<div class="container">
@if(session()->has('message'))

<div class="alert alert-success">
    {{ session()->get('message') }}
</div>

@endif
  <div class="row">

    <div class="col-sm">
      <div class="col-sm left">
      <a href="{{Route('stock.AddedData')}}" class="btn btn-secondary"  style='float:left; width:20%; font-size:20px;'>Retour</a><br><br>

    </div>
    </div>

    <div class="col-sm">
      <div class="col-sm right">
        <a href="{{Route('stock.dashboard')}}" class="btn btn-secondary"  style='float:right; width:20%; font-size:20px;'>Accueill</a><br><br>
      
         
        <form method="post" action="{{Route('stock.editprice',['id'=>$edit_product['id']])}}">
        @csrf
            <div class="row">
            <div class=" selling_price" style=" ">
              <label for="">Prix de vente</label>
              <input type="number" name="new_price"  value="{{$edit_product['selling_price']}}">
              <button class="btn btn-primary ">Changer nouveau PV</button>
            </div>
            </div>
        </form>
      </div>
      </div>

</div>
  
 
  
 <h2> <b><p> Historique : <?php echo $productName;?> <br>Prix de vente(PV): <span style="color:green;"> {{$edit_product['selling_price']}} fc</span> </h2></p>
  

  <table class="table" >
    <thead>
    <th>date</th>
    <th>Nombre</th>
    <th>prix d'achat unitaire</th>
    <th>prix d'achat total</th>
    <th>libelé</th>
    </thead>
    <?php
      foreach($query as $row){
    ?>
    <tr>
      <td>{{date('d,M,Y à H:i:s',strtotime($row->created_at))}}</td>
      <td>{{$row->number}}</td>
      <td>{{$row->price}}</td>
      <td>{{$row->prixtotal}}</td>
      <td>{{$row->comment}}</td>

    
    </tr>
    <?php
      }
  ?>
  </table>
 

</div>


@endsection