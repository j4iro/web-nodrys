@foreach ($dishes as $dish)
<div class="col-6 col-md-4 col-lg-2 mb-4">
    <div class="card card-plato cursor-pointer">
        <img src="{{ route('dish.image',['filename'=>$dish->image]) }}" class="card-img-top img-card-plato" alt="{{$dish->name}} en Nodrys">
        <div class="card-body p-0 px-3 pt-2 pb-3">
            <h5 class="card-title card-title-plato mb-1">{{$dish->name}}</h5>

            <p class="card-text card-text-plato m-0"> <img class="mb-1" src="https://img.icons8.com/ios/50/000000/clock-filled.png" width="16"> {{$dish->time}} Min.</p>
            <p class="card-text card-text-plato m-0"><img class="mb-1" src="{{asset('images/icons/icono-dinero-carrito.png')}}" width="16"> S/. {{$dish->price}}</p>
            <input class="form-check-input" type="checkbox" id="{{$dish->id}}" value="{{$dish->id}}" name="checkDish[]" >
            <label class="label-cliente d-none" for="{{$dish->id}}">Muestra precio</label>
        </div>
    </div>
</div>
@endforeach
