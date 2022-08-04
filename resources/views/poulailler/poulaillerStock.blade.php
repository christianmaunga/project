@extends('layouts.app')

@section('content')

<head>
  <link rel="stylesheet" href="/css/poulaillerStock.css">
</head>

    <div class="container">
      
    @if(session()->has('message'))
      
    <div class="alert alert-success">
        {{ session()->get('message') }}
     </div>

      @endif
      
    <div class="infoStock">
    <h1> Créer le {{$stock->created_at->format('d/m/Y')}}</h1>
    <h2  >Stock initial: <span style="color:green;">{{$stock['number_of_chicken']}}</span>  poules</h2>
    <h1 >Stock actuel:   <span style="color:red;">{{$stock['poules_restantes']}}</span>  poules</h1>
    
    </div>

    <div class="button">
    <a href="{{Route('poulailler.charge',['id'=>$stock['id']])}}" class="btn btn-danger"><span style="font-size: 20px;">charger</span></a><br>
    <a href="{{Route('poulailler.vente',['id'=>$stock['id']])}}" class="btn btn-secondary"> <span style="font-size: 20px;">vente</span></a><br>
    <a href="{{Route('retreive',['id'=>$stock['id']])}}" class="btn btn-info"> <span style="font-size: 20px;">retrait/mort</span></a><br>


    </div>



    </div>

@endsection