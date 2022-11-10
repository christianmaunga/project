@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/pharmadashboard.css') }}">
<div class="container">

    <div class="  left">

        <p>left</p>

    </div>


    <div class=" right">

            <a href=""><div class="sell">
                <p>vendre</p>
            </div></a>

            <a href=""><div class="historic">
                <p>historic</p>
            </div></a>

    </div>
   

</div>
@endsection
