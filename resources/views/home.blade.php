@extends('layouts.app')

@section('content')

<div class="container-fluid">
<form action="{{route('restaurant.buscar')}}" method="post">
        {{csrf_field()}}
        <div class="row bg-intro d-flex justify-content-center align-items-center">
            <div class="col-5">
                <div class="input-group mb-3">
                    <input type="text" name="name" class="form-control form-control-lg" placeholder="Busca restaurantes por su nombre" >
                    <div class="input-group-append">
                        <button class="btn btn-primary btn-lg" name="buscar" type="submit">Buscar</button>
                    </div>
                </div>
            </div>
        </div>

    </form>
</div>

<div class="container my-4">

    <div class="row">
        <div class="col-12 ">
            <h5>Restaurantes para tí</h5>
        </div>
    </div>

    @isset ($resultado)
        <div class="row">
            <div class="col-12 ">
                <div class="alert alert-success">
                        <strong> {{$resultado}} <a href="{{route('home')}}">Ver todos</a></strong>
                </div>
            </div>
        </div>
    @endisset

    <div class="row mt-1">
        @foreach ( $restaurants as $restaurant )
            <div class="col-12 col-md-6 col-lg-4 mb-2">
                <div class="card card-restaurant">
                    @include('includes.image_restaurante')
                    <div class="card-body p-0 px-3 pt-2 pb-5">
                        <p class="card-title card-title-restaurant my-0">{{$restaurant->name}}</p>
                        <p class="card-text my-2"><img src="https://img.icons8.com/ios/50/000000/place-marker.png" width="14">  {{$restaurant->address}}</p>
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