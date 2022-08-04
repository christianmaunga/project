@extends('layouts.app')

@section('content')

<div class="container">
@if(session()->has('message'))
    <div class="alert alert-danger">
        {{ session()->get('message') }}
    </div>
  @endif
  
  <div class="row">
             <h3>Nouveau stocks</h3>

            <form action="{{Route('addpoulailler')}}" method="post">
            @csrf

                            <div class="form-group  " >
                            
                              
                                <label for="">Nombre des poussins</label>
                                <input type="Number" class="form-control " name="number"  min="100" id="quantity" style="width: 50%;" required><br>

                            </div>

                            <div class="form-group ">

                                <label for="">Prix unitaire</label>
                                <input type="Number" class="form-control " step="0.01" min="0.5" max="2" name="pric_unitaire" id="quantity"  min="0" style="width: 50%;" required><br>

                            </div>

                            <div class="form-group ">

                                <label for="">poussins morts</label>
                                <input type="Number" class="form-control " name="mort" id="quantity" value="0"  min="0" style="width: 50%;" >

                            </div>

                         

                            <input type="hidden" name="poulailerID" value="{{Auth::guard('poulailler')->user()->id}}">

                            <div style=" text-align:right; margin-top:30px">

                          <button type="submit" class="col-sm col-lg-2 btn btn-success" >Enregistré</button><br>

                          </div>
              </form>              

   </div>


</div>  
@endsection