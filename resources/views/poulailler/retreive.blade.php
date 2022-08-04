@extends('layouts.app')

@section('content')

<div class="container">

      <h2   >Retrait </h2>
      <h2><a   href="{{Route('poulailler.retreivehistory',$id)}}"  >Historique des retraits précedents</a></h2><br>

      <form action="{{ Route('poulailler.retreive')}}" method="post">
        @csrf 
            <div class="row">
            @if(session()->has('message'))
            <div class="alert alert-danger">
                {{ session()->get('message') }}
            </div>
          @endif

                  <div class="form-group" >
                    <label for=""> Nombre des poules retirés </label>
                    <input type="Number" class="form-control" name="number" style="width: 50%;" min="1" required ><br>
                  </div>

                  <div class="form-group">
                    <label for="">Détails/causes</label>
                    <textarea type="text" class="form-control" name="details" style="width: 70%;" rows="5" required></textarea><br>
                  </div>

                  <input type="hidden" value="{{$id}}" name="stockpoulailler"><br>
                  <input type="hidden" value="{{ Auth::user()->id }}" name="poulaillerId"><br>

                  <div>
                    <button > Enregistrer</button>
                  </div>

            </div>
      </form>

</div>


@endsection