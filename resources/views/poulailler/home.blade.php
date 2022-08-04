@extends('layouts.app')

@section('content')
<head>
<link rel="stylesheet" href="/css/poulaillerHome.css">
</head>
<div class="container">

        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
          @endif

        <a href="{{Route('poulailler.newstock')}}" class="btn btn-primary" style="margin:10px;"> Nouveau stock de poussin</a>


        <?php 

        $numOfCols = 4;
        $rowCount = 0;
        $bootstrapColWidth = 12 / $numOfCols;

        ?>
      <div class="row">
        <?php
        foreach($data as $row){

          ?>

          <div class="col-md-<?php echo $bootstrapColWidth; ?> mb-4">

              <div class="thumbnail card text-center shadow-sm">

                  <div class="card-body">
                    
                    <p>Stock initial: <span style=" font-weight: bold; ">{{$row['number_of_chicken']}}</span></p>
                    @if($row['poules_restantes']==0)
                    <p> Stock actuel: <span style="color: red;  font-weight: bold;">{{$row['poules_restantes']}}</span></p>
                    @else
                    <p >Stock actuel: <span style=" font-weight: bold; ">{{$row['poules_restantes']}}</span></p>
                    @endif

                    <p >Créer le: <span style=" font-weight: bold; ">{{$row->created_at->format('d/m/Y')}}</span></p>
                    <a href="{{       
                                Route('getstockview',[
                               'id'=>$row['id']
                                      ])}}" class="btn btn-primary">acceder au stock</a>
                  </div>

              </div>
 
        </div>

        <?php

        $rowCount++;
        if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
        
        }

        ?>
</div>
@endsection
