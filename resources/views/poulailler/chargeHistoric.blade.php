@extends('layouts.app')

@section('content')

  <div class="container">

  @foreach($listcharge as $row)
  
  

    <a href="">{{$row->created_at}}</a><br>

    <table>
      
    </table>

  

  
  @endforeach



  </div>

@endsection