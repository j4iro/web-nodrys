@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row ">

        @foreach ( $restaurants as $restaurant )

            <div class="col-12 col-md-6 col-lg-3 mb-4">
                <div class="card shadow">
                    @include('includes.image_restaurante')
                    <div class="card-body">
                        <h4 class="card-title">{{$restaurant->name}}</h4>
                        <p class="card-text">{{$restaurant->address}}</p>
                        <a href="{{ route('restaurant.detalle',["id"=>$restaurant->id])}}" class="btn btn-primary stretched-link">Mirar platos</a>
                    </div>
                </div>
            </div>
        
        @endforeach
    </div>
</div>
@endsection


{{-- <div class="card">
        <div class="card-header">{{$restaurant->$name}}</div>
        
        <div class="card-body">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
            
            You are logged in!
        </div>
    </div>
</div> --}}