@extends('layouts.app')
@section('scripts')
    <style media="screen">
        input[type=checkbox]{
            display: none;
        }
    </style>
@endsection

@section('content')

@if (session('vacio'))
    <?php echo "<script>alert('".session('vacio')."');</script>" ?>
@endif

<div class="container-fluid">
    <form action="{{route('carrito.add')}}" method="post">
            {{csrf_field()}}
        <div class="row bg-intro d-flex justify-content-center align-items-center">
            <div class="col-12 col-sm-8 col-md-5">
                <div class="input-group mb-3">
                    <input type="text" name="name" class="form-control form-control-lg" placeholder="¿Qué se te antoja comer hoy?" required>
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
            <strong class="navbar-brand">Busca entre {{count($platos)}} platos para tí</strong>
        </div>
    </div>

    @isset ($resultado)
        <div class="row">
            <div class="col-12 ">
                <div class="alert alert-success">
                    <strong> {{$resultado}} <a href="{{route('getAllDishes')}}">Ver todos</a></strong>
                </div>
            </div>
        </div>
    @endisset

    <div class="row mt-1">
        @foreach ( $platos as $dish )
        <div class="col-6 col-md-4 col-lg-3 mb-4">
            <a href="{{ route('restaurant.detalle',["id"=>$dish->restaurante_id,"nombre"=> strtolower(str_replace(" ","-",trim($dish->restaurante)))])}}">
            <label for="{{$dish->id}}">
                <div  class="card card-plato cursor-pointer">
                    <img id="{{$dish->id}}" src="{{ route('dish.image',['filename'=>$dish->image]) }}" class="card-img-top img-card-plato" alt="{{$dish->name}}">
                    <div id="{{$dish->id}}" class="card-body p-0 px-3 pt-2 pb-3">
                        <h5 class="card-title card-title-plato mb-1" >
                            @if (strlen($dish->name)>30)
                                {{substr($dish->name,0,30)}}...
                            @else
                                {{$dish->name}}
                            @endif
                        </h5>
                        <p class="card-text card-text-plato m-0">{{$dish->restaurante}} </p>
                        <p class="card-text card-text-plato m-0">{{$dish->time}} Min.</p>
                        <p class="card-text card-text-plato m-0">S/. {{$dish->price}}</p>
                        <input class="form-check-input" id="{{$dish->id}}" type="checkbox" value="{{$dish->id}}" name="checkDish[]" >
                    </div>
                </div>
            </label>
            </a>
        </div>
        @endforeach
    </div>


</div>

@include('includes/footer')

@endsection
