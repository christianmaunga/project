@extends('layouts.app')

@section('content')
<style>
  th{
    font-size: 20px;
  }

table {
  
  border-radius: 10px;
}

a{
  text-decoration: none;
}
a:hover {
  text-decoration:underline;
}

</style>
<title>Stock | Accueil</title>
<div class="container">
   @if(session()->has('message'))

            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>

  @endif


<a href="{{Route('stock.addNewproduct')}}" class="btn btn-primary" style="font-size: 20px;" >Ajouter produit</a>
<a href="{{Route('stock.retreiveProductView')}}" class="btn btn-danger" style="float: right; font-size: 20px;"> retirer produit</a>

<div class="row" style="margin-top: 50px;">

    <div class="col-sm">
     

      <h2><p>Produits récement ajouter | <a  href="{{Route('stock.AddedData')}}">voir plus...</a></p></h2>
     <table class="table table-striped" style="background-color:rgb(146, 247, 247);">
    
       <thead>
         
           <th>Nom</th>
            <th>#Nombre</th>
            <th>Jour & Heure d'ajout</th>
         
       </thead>
       <?php
        

          foreach($addedProducts as $row){

            
        ?>
       
         <tr>
           <td>{{$row->product_name}}</td>
           <td>{{$row->number}}</td>
           <td>{{ date('d,M,Y à H:i:s',strtotime($row->created_at))}}</td>
         </tr>
       
       <?php
          }
       ?>
     </table>

    </div>
    <div class="col-sm">

      <h2><p>Produit récement retirer | <a class="link" href="{{Route('stock.RetreivedData')}}">voir plus...</a></p></h2>
    
    <table class="table table-striped" style="background-color:#fc8181;">
      <thead>
         
           <th>Nom</th>
            <th>#nombre</th>
            <th>Jour & Heure  de retrait</th>

       </thead>
       <?php
        

          foreach($retreivedProducts as $row1){

            
        ?>
       
       <tr>
           <td>{{$row1->product_name}}</td>
           <td>{{$row1->productNumbers}}</td>
           <td>{{ date('d,M,Y à H:i:s',strtotime($row1->created_at))}}</td>
         </tr>

       
       <?php
          }
       ?>
     </table>

    </div>

</div>


</div>
@endsection
