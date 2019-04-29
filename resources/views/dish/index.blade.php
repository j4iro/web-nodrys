@extends('layouts.app')

@section('content')

@if (session('vacio'))
    <?php echo "<script>alert('".session('vacio')."');</script>" ?>
@endif

<div class="container mt-5">
    <form action="{{route('carrito.add')}}" method="post">
    {{csrf_field()}}


    <div class="row ">
        <div class="col-12 col-sm-6">
            <img class="img-thumbnail shadow" src="{{route('restaurant.image',["filename"=>$restaurant->image])}}" width="100%" >
        </div>
        <div class="col-12 col-sm-6">
            <strong class="navbar-brand">{{$restaurant->name}}</strong><br>
            {{$restaurant->description}}
            <br>
            <strong class="navbar-brand pb-0">Distrito</strong>
            <br>
            {{$restaurant->district_id}}
            <br>
            <strong class="navbar-brand pb-0">Dirección</strong>
            <br>
            {{$restaurant->address}}
            <br>
            <strong class="navbar-brand pb-0">Telefono</strong>
            <br>
            {{$restaurant->telephone}}
            <br>
            <input type="submit" class="btn btn-primary mt-2"  name="addcarrito" value="Reservar lugar">
        </div>
    </div>



    <div class="row mt-3">
        @foreach ($dishes as $dish)
            <div class="col-6 col-md-4 col-lg-2 mb-4">
                <div class="card card-plato">
                    @include('includes.image_dish')
                    <div class="card-body p-0 px-3 pt-2 pb-3">
                        <h5 class="card-title card-title-plato mb-1">{{$dish->name}}</h5>
                        <p class="card-text card-text-plato m-0">{{$dish->time}} Min.</p>
                        <p class="card-text card-text-plato m-0">S/. {{$dish->price}}</p>
                        <input class="form-check-input" type="checkbox" value="{{$dish->id}}" name="checkDish[]" >
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @if (count($dishes)!=0)
        <div class="row">
            <div class="col-3">
                <input type="hidden" name="id_restaurant" value="{{$restaurant->id}}">
                <input type="submit" class="btn btn-primary"  name="addcarrito" value="Añadir al carrito">
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-3">
            <input type="hidden" name="id_restaurant" value="{{$restaurant->id}}">
        </div>
    </div>

    </form>
</div>

@endsection
