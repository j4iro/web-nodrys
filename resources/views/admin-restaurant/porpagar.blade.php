@extends('layouts.app-r')

@section('content')

            <!--Titulo-->
            <div class="row mb-2">
                <div class="col-12 ">
                    <strong class="navbar-brand p-0">Comisiones por Pagar</strong>
                     {{-- <div class="badge badge-primary" style="font-size: 1.2em">{{'S/. '.number_format($debeComision[0]->totalComision,2)}}</div> --}}
                </div>
            </div>
            <!--Titulo-->

            <table class="table table-responsive table-hover">
                <thead class="thead-light">
                    <tr>
                    <th scope="col">Cliente</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col">Dirección</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Hora</th>
                    <th scope="col">N° personas</th>
                    <th scope="col">Ocasión</th>
                    <th scope="col">Subtotal</th>
                    </tr>
                </thead>
                <tbody>

                @foreach ($porPagar as $item)
                    <tr>
                        <th scope="col">{{$item->name.' '.$item->surname}} </th>
                        <th scope="col">{{$item->email}} </th>
                        <th scope="col">{{$item->telephone}} </th>
                        <th scope="col">{{$item->address}}  </th>
                        <th scope="col">{{$item->date}} </th>
                        <th scope="col">{{$item->hour}} </th>
                        <th scope="col">{{$item->npeople}} </th>
                        <th scope="col">{{$item->ocasion}} </th>
                        <th scope="col">{{$item->subtotal}} </th>

                    </tr>
                @endforeach

                </tbody>
            </table>
 @endsection
