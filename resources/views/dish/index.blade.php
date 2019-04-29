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
            <input type="submit" class="btn btn-dark mt-2"  name="addcarrito" value="Reservar lugar">
        </div>
    </div>



    <strong class="navbar-brand mt-3">¿Qué desea comer?</strong>
    <div class="row ">
        @foreach ($dishes as $dish)
            <div class="col-6 col-md-4 col-lg-2 mb-4">
                <div class="card card-plato">
                    @include('includes.image_dish')
                    <div class="card-body p-0 px-3 pt-2 pb-3">
                        <h5 class="card-title card-title-plato mb-1">{{$dish->name}}</h5>
                        <p class="card-text card-text-plato m-0">{{$dish->time}} Min.</p>
                        <p class="card-text card-text-plato m-0">S/. {{$dish->price}}</p>
                        <input class="form-check-input" type="checkbox" id="{{$dish->id}}" value="{{$dish->id}}" name="checkDish[]" >
                         <label class="label-cliente" for="{{$dish->id}}">Muestra precio</label>
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

    <strong class="navbar-brand mt-3">Encuentranos en</strong>
    <div class="container mb-3 p-0 shadow ">
        <div class="row">
            <div class="col-12">
                   <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d124849.57143873717!2d-77.03340579999995!3d-12.074513599999994!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9105c8ecd3b32ed1%3A0xa63ff86b9b214929!2sParque+de+la+Reserva!5e0!3m2!1ses-419!2spe!4v1556545799747!5m2!1ses-419!2spe" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
        </div>
    </div>

</div>

@endsection
