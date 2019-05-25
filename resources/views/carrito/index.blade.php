@extends('layouts.app')
@section('scripts')
    <script src="{{ asset('js/app.js') }}" defer></script>
@endsection
@section('content')
<form method="POST" action="{{route('pedidos.add')}}">
{{csrf_field()}}


<div class="container mt-4">

    <!--Titulo del carrito-->
    <div class="row mt-3">
        <div class="col-12 ">
            <strong class="navbar-brand">Mi Carrito
                @if (isset($_SESSION['carrito']) && count($_SESSION['carrito'])>=1)
                    <span class="badge badge-warning border border-secondary">{{count($_SESSION['carrito'])}}</span>
                @endif
            </strong>
        </div>
    </div>
    <!--Titulo del carrito-->


    <!--Tabla Carrito de compras-->
    <div class="row mt-4">
        <div class="col-12 col-sm-9">

            <table class="table table-responsive table-hover">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Imagen</th>
                        <th scope="col">Restaurante</th>
                        <th scope="col">Tipo</th>

                        <th scope="col">Plato</th>

                        <th scope="col">Precio</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Sub Total</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>

            @if (isset($_SESSION['carrito']) && count($_SESSION['carrito'])>=1)
                <?php $total=0; ?>
                 @foreach ($carrito as $indice=>$dish)
                 <?php $plato = $dish['plato']; ?>
                    <tr>
                    <th scope="row">
                        <img src="{{ route('dish.image',['filename'=>$plato->image]) }}" class="img-thumbnail shadow" width="50">
                    </th>
                    <td>{{$plato->restaurante}}</td>
                    <td class="text-capitalize">{{$plato->categoria_plato}}</td>
                    <td> @if($plato->name=="reserva") {{'-'}} @else {{$plato->name}}  @endif </td>
                    <td>{{$plato->price}}</td>
                    <th scope="row">
                        @if($plato->name!="reserva")
                        <a href="{{route('carrito.up',['indice'=>$indice])}}" class="btn btn-outline-success btn-sm rounded p-0 px-2 mb-1 mr-1">+</a>
                        @endif
                        {{$dish['unidades']}}
                        @if($plato->name!="reserva")
                        <a href="{{route('carrito.down',['indice'=>$indice])}}" class="btn btn-outline-success btn-sm rounded p-0 px-2 mb-1 ml-1">-</a>
                        @endif
                    </th>
                    <?php $subtotal= $plato->price*$dish['unidades']; ?>
                    <?php $total += $subtotal; ?>
                    <th scope="row">{{number_format($subtotal,2,'.',' ')}}</th>
                    <td><a href="{{route('carrito.deleteone',['indice'=>$indice])}}" class="btn btn-danger btn-sm">Quitar</a></td>
                    </tr>
                @endforeach
            @else
                <tr>
                <th scope="row">-</th>
                <th scope="row" colspan="6" class="text-center">Aún no has agregado productos</th>
                <td>-</td>
                </tr>
            @endif

            @if (isset($_SESSION['carrito']) && count($_SESSION['carrito'])>=1)
                <tr>
                    <td><a href="{{route('carrito.deleteall')}}">Vaciar Carrito</a></td>
                    <td colspan="4"></td>
                    <th class="text-right">Total: S/.</th>
                    <th>{{number_format($total,2,'.',' ')}}</th>
                    <th>
                        <a href="{{route('utils.auth')}}" name="validarAuth" id="continuar_carrito" class="btn btn-primary btn-sm" >Continuar</a>
                    </th>
                </tr>
            @endif

                </tbody>
            </table>

        </div>

        <!--Formulario Ocasión Especial-->
        <div class="col-12 mb-3 col-sm-3 @if (session('mostrarform')) {{''}} @else {{'d-none'}} @endif " id="formOcasionEspecial">
            <div class="card shadow p-4 bg-light">

                <div class="row">
                    <dt class="col-12">¿Alguna ocasión especial?</dt>
                </div>

                <div class="row mt-2">
                    <div class="col-12">
                        <select name="oca_special" class="form-control" id="">
                            <option value="ninguna" >Ninguna</option>
                            <option value="cumpleanos" >Cumpleaños</option>
                            <option value="aniversario" >Aniversario</option>
                            <option value="reunión" >Reunión</option>
                            {{-- <option value="otra" >Otra</option> --}}
                        </select>
                    </div>
                </div>

                <div class="row mt-2">
                    <dt class="col-12">¿Cuantas personas asistirán?</dt>
                </div>

                <div class="row mt-2">
                    <div class="col-12">
                        <input type="number" placeholder="Número de personas" value="1" class="form-control" name="n_people">
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-6">
                        <a href="" data-toggle="modal" data-target="#modalPago" class="btn btn-primary btn-sm">Reservar</a>
                    </div>
                </div>
            </div>
        </div>
        <!--Formulario Ocasión Especial-->

    </div>
    <!--Tabla Carrito de compras-->



      <!-- Modal Formulario de Pago -->
      <div class="modal fade" id="modalPago" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-body">
                <!--Formulario de Pago-->
                    <div class="row my-3">
                        <div class="col-12 col-sm-12">

                                <div class="row">
                                    <dt class="col-12">Nueva tarjeta de pago
                                        <hr>
                                    </dt>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-12">
                                        <input type="text" placeholder="Número de tarjeta" class="form-control" name="num_card" id="" required>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-4  pr-0">
                                        <select name="month" class="form-control" id="" required>
                                            <option value="" disabled selected>MM</option>
                                            @for ($i = 1; $i < 13; $i++)
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-4  pl-0">
                                        <select name="year" class="form-control" id="" required>
                                            <option value="" disabled selected>AAAA</option>
                                            @for ($i = 2020; $i < 2040; $i++)
                                                <option value="{{$i}}"  >{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <input type="text" placeholder="CVC" class="form-control" name="cvc" id="" required>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-12">
                                        <input type="text" placeholder="Nombre en la tarjeta" class="form-control" name="owner" id="" required>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-8 ">
                                        <select name="country" class="form-control" id="">
                                            <option value="per" >Perú</option>
                                            <option value="col" >Colombia</option>
                                            <option value="chi" >Chile</option>
                                            <option value="ecu" >Ecuador</option>
                                            <option value="mex" >México</option>
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <input type="text" placeholder="Código Postal" class="form-control" name="cod_postal" id="">
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-8 ">
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" checked name="recordarTarjeta" id="recordarTarjeta">
                                            <label class="form-check-label" for="recordarTarjeta">Recordar esta tarjeta</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-2 ">
                                    <div class="col-6">
                                        <button type="submit" class="btn btn-danger btn-block btn-lg">Realizar Pago</button>
                                    </div>
                                    <div class="col-6 ">
                                        <small class="form-text text-muted">Al completar la compra aceptas estas <a href="">Condiciones de uso</a></small>
                                    </div>
                                </div>

                        </div>
                    </div>
                <!--Formulario de Pago-->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancelar</button>
            </div>
          </div>
        </div>
      </div>
    <!-- Modal Formulario de Pago -->
</div>

{{-- @include('includes/footer') --}}

</form>

@endsection


