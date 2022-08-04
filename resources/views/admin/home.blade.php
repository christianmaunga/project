@extends('layouts.app')

@section('content')
<div class="container">

            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
    <div class="row justify-content-center">
        <!-- <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                 <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in as an admin!') }}
                </div> 
            </div>
        </div> -->
        
        <a href="{{route('admin.newAccount')}}"> Ajouter compte</a>
    </div>
</div>
@endsection