@extends('layouts.app')

@section('content')

<form action="{{route('restaurant.buscar')}}" method="post">
<div class="container-fluid ">
            {{csrf_field()}}

        <div class="row bg-intro  d-flex justify-content-center align-items-center">
            <div class="col-12 col-sm-8 col-md-5 text-center">
                <div class="input-group mb-2">
                    <input type="text" name="name" class="form-control form-control-lg" placeholder="Busca restaurantes por su nombre" >
                    <div class="input-group-append">
                        <button class="btn btn-primary btn-lg" name="buscar" type="submit">Buscar</button>
                    </div>
                </div>
                <strong><a class="" href="/solicitud-unirse">¿Tienes un restaurante? Registrate aquí</a></strong>

            </div>
        </div>

</div>
</form>


<div class="container my-4">
    <form action="{{route('restaurants.filtro')}}" method="post">

    <div class="row">
        <div class="col-12 ">
            <h5>Busca entre {{count($restaurants)}} restaurantes para tí</h5>
        </div>
    </div>

    <div class="row mb-4 mt-2">
            {{csrf_field()}}
        <div class="col-6 col-lg-3 pt-2">
            <select name="categoria" class="form-control" id="">
                <option value="" disabled selected >Categorias</option>
                @foreach ($categorias as $categoria)
                    <option value="{{$categoria->id}}"   >{{$categoria->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-6 col-lg-3 pt-2">
            <select name="distrito" class="form-control" id="">
                <option value="" disabled selected >Distritos</option>
                @foreach ($distritos as $distrito)
                    <option value="{{$distrito->id}}">{{$distrito->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-6 col-lg-2  pt-2">
            <button class="btn btn-primary" name="filtrar" type="submit">Filtrar</button>
        </div>
        </form>
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

                        <div class="d-flex justify-content-between">
                            <p class="card-title card-title-restaurant my-0">{{$restaurant->name}}</p>
                            <div class="badge badge-success badge-restaurant mt-1 ">
                                <strong>{{$restaurant->categoria}}</strong>
                            </div>
                        </div>
                        <p class="my-2 font-weight-light">
                            <img class="mb-1" src="https://img.icons8.com/ios/50/000000/place-marker.png" width="14"> {{$restaurant->distrito}} - {{$restaurant->address}}</p>
                        <a href="{{ route('restaurant.detalle',["id"=>$restaurant->id,"nombre"=>strtolower(implode("-",explode(" ",$restaurant->name)))])}}" class="btn btn-primary stretched-link">Mirar platos</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>


    {{-- Paginación --}}
    <div class="row mt-4">
        <div class="col-12 d-flex justify-content-center">

            <nav aria-label="Page navigation example">
                <ul class="pagination">
                  <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                      <span aria-hidden="true">&laquo;</span>
                    </a>
                  </li>
                  <li class="page-item active"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                      <span aria-hidden="true">&raquo;</span>
                    </a>
                  </li>
                </ul>
              </nav>
        </div>
    </div>
    {{-- Paginación --}}

</div>

@include('includes/footer')

@endsection
