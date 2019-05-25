@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="row mt-3">
        <div class="col-12 ">
            <strong class="navbar-brand">Mi Historial de pedidos</strong>
        </div>
    </div>

    <div class="row mt-3 d-none">
        <div class="col-2">
            <label for="form-label-control">Restaurante</label>
            <select class="form-control form-control-sm" name="" id="">
                <option value="1">El buen tomate</option>
                <option value="1">Norkys</option>
            </select>
        </div>
        <div class="col-2">
            <label for="form-label-control">Fecha</label>
            <input class="form-control form-control-sm" type="date" name="" id="">
        </div>
        <div class="col-2">
            <label for="form-label-control">Estado</label>
            <select class="form-control form-control-sm" name="" id="">
                <option value="1">Pendiente</option>
                <option value="1">Terminado</option>
            </select>
        </div>
    </div>

    <div class="row mt-3">

        <div class="col-12 col-sm-7 ">
            @if(session('result'))
                <div class="alert alert-success">
                    <strong>{{session('result')}}</strong>
                </div>
            @endif
            @if(session('respuesta'))
                <div class="alert alert-success">
                    <strong>{{session('respuesta')}}</strong>
                </div>
            @endif
        </div>

        <div class="col-12">

            <table class="table table-responsive table-hover">
                <thead class="thead-light">
                    <tr>
                    <th scope="col">Codigo</th>
                    <th scope="col" colspan="2">Restaurante</th>
                    <th scope="col">Fecha - Hora</th>
                    <th scope="col">Personas</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Total</th>
                    <th scope="col" colspan="3">Acciones</th>
                    </tr>
                </thead>

                <tbody>

                @foreach ($pedidos as $pedido)
                    <tr>
                        <th scope="row">R-000{{$pedido->id}}</th>
                        <th scope="row" class="p-0 pt-1 pl-2">
                            <img src="{{ route('restaurant.image',['filename'=>$pedido->image]) }}" width="50" class="img-fluid img-thumbnail shadow-sm avatar">
                        </th>
                        <th scope="row">{{$pedido->name}}</th>
                        <td>{{$pedido->created_at}}</td>
                        <td>{{$pedido->n_people}}</td>
                        @if ($pedido->state=='pendiente')
                            <td class="text-danger text-uppercase"><span class="badge badge-warning">{{$pedido->state}}</span></td>
                        @elseif($pedido->state=='cancelada')
                            <td class="text-danger text-uppercase"><span class="badge badge-danger">{{$pedido->state}}</span></td>
                        @else
                            <td class="text-primary text-uppercase"><span class="badge badge-primary">{{$pedido->state}}</span></td>
                        @endif
                        <td>S/. {{$pedido->total}}</td>
                        <td><a href="{{route('pedidos.detail_c',["id"=>$pedido->id])}}" class="btn btn-outline-primary btn-sm">Detalles</a></td>
                        @if ($pedido->state=='pendiente')
                        <td>
                            <a href="" id="{{$pedido->id}}" onclick="jalarid(this);" data-toggle="modal" data-target="#modalPago" class="btn btn-outline-danger btn-sm">Cancelar</a>
                        </td>
                        @endif

                        <td>
                            <a href="{{route('pedidos.factura.pdf',["id"=>$pedido->id,"tipo"=>'ver'])}}" target="_blank" class="btn btn-outline-success btn-sm" codigo="{{$pedido->id}},{{$pedido->created_at}},{{$pedido->name}}" >Factura</a>
                        </td>

                    </tr>
                @endforeach

                </tbody>
            </table>

        </div>
    </div>


    {{-- Modal para cancelar --}}
     <!-- Modal Formulario de Pago -->
     <div class="modal fade" id="modalPago" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-body">
            <!--Formulario de Pago-->                
                <form method="post" action="{{route('order.cancelar')}}">
                {{csrf_field()}}
                    <div class="row my-3">
                        <div class="col-12 col-sm-12">
                                <div class="row">
                                    <dt class="col-12">¿Qué pasó?<hr></dt>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-4">
                                        <input type="text" readonly class="form-control" name="cod_reserva" id="cod_reserva"/>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <textarea type="text" placeholder="Escriba su motivo (opcional)" class="form-control" name="motivo" id="motivo"  rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="row mt-2 ">
                                    <div class="col-6">
                                        <input type="submit" class="btn btn-danger btn-block btn-lg" value="Cancelar reserva">
                                    </div>
                                    <div class="col-6 ">
                                        <small class="form-text text-muted">Si ya canceló la reserva, tiene un plazo de 15 dias para postergarla. <a href="">Mas información</a> </small>
                                    </div>
                                </div>
                        </div>
                    </div>
                </form>
            <!--Formulario de Pago-->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>
    <!-- Modal Formulario de Pago -->

</div>



@endsection

@section('scripts')
    <script src="{{ asset('js/app.js') }}" defer></script>
@endsection

    <script>
        function jalarid(input)
        {
            cod_reserva.value = input.id;
        }
    </script>

