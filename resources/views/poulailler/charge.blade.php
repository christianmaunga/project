@extends('layouts.app')

@section('content')
<script src="/js/charge.js"></script>
<div class="container">
    <h2>Charge section</h2><br>
    <h2><a href="{{Route('poulailler.Chargehistoric',$id)}}" >Charges précedentes</a></h2><br>
    
    <div class="row my-y">
      <!-- <div class="col-lg-10 mx-auto"> -->

        <div class="card ">
          <h4>Nouvelles charges</h4>
        </div>

        <!-- <div class="card-body p-4"> -->

          <form action="{{Route('poulailler.insertcharges', $id)}}" id="add_form" method="POST" autocomplete="off">
          @csrf

          <div id="show_item">
            <div class="row">

                <div class="col-md-4 mb-3">
                  <label for="">Intitulé</label>
                  <input type="text" name="charge_intutilé[]" class="form-control"  required> 

                </div>

                <div class="col-md-2 mb-3">
                  <label for="">Montant</label>
                  <input type="number" name="montant[]"  min="100" class="form-control"  required> 

                </div>

                <div class="col-md-4 mb-3">
                  <label for="">Details</label>
                  <textarea id="" class="form-control" rows="3" name="details[]" required></textarea> 

                </div>

                <div class="col-md-2 mb-2 ">

                  <button class="btn btn-success add_item_btn">Ajouter plus</button>

                </div>
                <!-- <input type="hidden" name="poulailler" value="{{ Auth::user()->id }}"> -->
                <input type="hidden" name="poulailler"  value="{{Auth::guard('poulailler')->user()->id}}"> 

            </div>

          </div>

          <div>
            <input type="submit" value="Enregistrer" class="btn btn-primary w-21" id="add_btn">
          </div>

          </form>

        <!-- </div> -->

      <!-- </div> -->

    </div>
</div>


@endsection