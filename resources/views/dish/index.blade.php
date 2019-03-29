@extends('layouts.app')

@section('content')

@if (session('vacio'))
    <?php echo "<script>alert('".session('vacio')."');</script>" ?>
@endif

<div class="container">
    <form action="{{route('carrito.add')}}" method="post">
    {{csrf_field()}}

    <!-- Titulo Superior -->
    <div class="row">
        <div class="col-12 text-center">
            <h1>Platos del Restaurante: "{{$restaurant->name}}"</h1>
        </div>
    </div>

    <div class="row mt-3">
        @foreach ($dishes as $dish)
            <div class="col-6 col-md-4 col-lg-2 mb-4">
                <div class="card shadow ">
                    @include('includes.image_dish')
                    <div class="card-body ">
                        <h5 class="card-title">{{$dish->name}}</h5>
                        <p class="card-text">{{$dish->time}} Min.</p>
                        <p class="card-text">S/. {{$dish->price}}</p>
                        <input class="form-check-input" type="checkbox" value="{{$dish->id}}" name="checkDish[]" >
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="row">
        <div class="col-3">
            <input type="hidden" name="id_restaurant" value="{{$restaurant->id}}">
            <input type="submit" class="btn btn-primary"  name="addcarrito" value="Añadir al carrito">
        </div>
    </div>

    </form>
</div>

@endsection

