@extends('layouts.app')

@section('content')
<div class="container">
  <h2>Historique</h2>
  <div>

    <table class="table table-striped">

      <thead >
        <th scope="col">Date</th>
        <th scope="col">Nombre</th>
        <th scope="col">détails</th>
      </thead>
      @foreach($history as $row)
      <tbody>
        <tr>
            <td>{{$row->created_at}}</td>
            <td>{{$row->number}}</td>
            <td>{{$row->details}}</td>
          
        </tr>
        
      @endforeach  
      </tbody>
    </table>

  </div>
</div>
@endsection