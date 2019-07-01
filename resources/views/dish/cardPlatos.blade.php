<div class="col-12 my-2 text-center">
    @if(count($dishes)==0)
        {{-- <div class="alert alert-warning"> --}}
            <strong class="navbar-brand">El restaurante aún no ha registrado platos para el día {{substr($dia_reserva,0,2)}} de {{$nombre_mes}}, pero puedes reservar tu lugar favorito. </strong>
            <br>
            <a id="btnReservar2" onclick="simularClick();"  class="btn btn-primary mb-2 text-white"><strong>Reservar mi lugar favorito</strong></a>
        {{-- </div> --}}
    @else
        <strong class="navbar-brand">¿Qué deseas comer el día {{substr($dia_reserva,0,2)}} de {{$nombre_mes}}?</strong>
    @endif
</div>


@foreach ($dishes as $dish)
<div class="col-6 col-md-4 col-lg-3 mb-4">
    <label for="{{$dish->id}}">
        <div class="card card-plato cursor-pointer">
            <img id="{{$dish->id}}i" src="{{ route('dish.image',['filename'=>$dish->image]) }}" class="card-img-top img-card-plato" alt="{{$dish->name}} en Nodrys">
            <div id="{{$dish->id}}c" class="card-body p-0 px-3 pt-2 pb-3">
                <h5 class="card-title card-title-plato mb-1">
                    @if (strlen($dish->name)>30)
                        {{substr($dish->name,0,30)}}...
                    @else
                        {{$dish->name}}
                    @endif
                </h5>

                <p class="card-text card-text-plato m-0"> <img class="mb-1" src="https://img.icons8.com/ios/50/000000/clock-filled.png" width="16"> {{$dish->time}} Min.</p>
                <p class="card-text card-text-plato m-0"><img class="mb-1" src="{{asset('images/icons/icono-dinero-carrito.png')}}" width="16"> S/. {{$dish->price}}</p>
                <input class="form-check-input" type="checkbox" id="{{$dish->id}}" onclick="seleccionar(this.id);" value="{{$dish->id}}" name="checkDish[]" >

            </div>
        </div>
    </label>
</div>
@endforeach

@if (count($dishes)!=0)
    <div class="col-12 mb-3">
        <input type="hidden" name="id_restaurant" value="{{$idrestaurant}}">
        <input type="hidden" name="dia_reserva" value="{{date('Y-m-d',strtotime($dia_reserva))}}">
        <input id="Añadir2" type="submit" class="btn btn-primary btn-block"  name="addcarrito" value="Añadir al carrito">
    </div>
@else
    <input id="Añadir" type="hidden">
@endif
