@extends('layouts.app')

@section('content')

<div class="container">
@if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
    <h2>Nouveau compte</h2>

    <div class="card-body"">
                <div class="row">
                <div class="col-md-9 offset-md-1">

                    <form action="{{Route('admin.insertNewAccount')}}" method="post">
                        @if(Session::get('success'))
                        <div class="alert alert-success">
                          {{Session::get('success')}}
                        </div>
                        @endif
                        @if(Session::get('fail'))
                        <div class="alert alert-fail">
                          {{Session::get('fail')}}
                        </div>
                        @endif

                    @csrf 

                              <!-- username-->
                              <div class="form-group">
                                <label for="">Nom d'utilsateur</label>
                                <input class="form-control" type="text" name="username" value="{{old('username')}}"  placeholder=""idate>
                                <span class="text-danger" >@error('username'){{$message}}@enderror</span>
                              </div>



                              <!-- Email-->
                              <div class="form-group">
                                <label for="">Email</label>
                                <input class="form-control" type="email" name="email" value="{{old('email')}}"  placeholder=""idate>
                                <span class="text-danger" >@error('email'){{$message}}@enderror</span>
                              </div>



                              <!-- Localization -->
                              <div class="form-group">
                                <label for="">Localisation</label>
                                <input class="form-control" type="text" name="localization" value="{{old('localization')}}" placeholder="" id="">
                                <span class="text-danger" >@error('localization'){{$message}}@enderror</span>
                              </div>



                              <!-- password-->
                              <div class="form-group">
                                <label for="">Mot de passe</label>
                                <input class="form-control" type="password" name="password" value="{{old('password')}}"  placeholder="" id="">
                                <span class="text-danger" >@error('password'){{$message}}@enderror</span>

                              </div>



                              <!-- confirm password-->
                              <div class="form-group">
                                <label for="">comfirmé le mot de passe</label>
                                <input class="form-control" type="password" name="confirmPassword" value="{{old('confirmPassword')}}"  placeholder="" id="">
                                <span class="text-danger" >@error('confirmPassword'){{$message}}@enderror</span>

                              </div>


                              
                                <!-- Selection-->
                              <div class="form-group">
                                <label for="">type de compte</label>
                                  <select  class="form-select" aria-label="Disabled select example" name="typeaccount" id="">
                                 
                                    <option value="stock">Stock</option>
                                    <option value="pharma">Pharma</option>
                                    <option value="poulailler">Poulailler</option>
                                  </select>
                                  <span class="text-danger" >@error('typeaccount'){{$message}}@enderror</span>

                              </div>

                              <!-- Button-->
                              <div class="form-group">
                                
                              <button type="" class="btn btn-primary"> Enregistrer</button>

                              </div>
                            
                              

                    </form>
                </div>
               </div>
    </div>
  </div>

@endsection