@extends('layouts.app-r')
@section('content')

        <div class="container-fluid mt-3">

            <div class="row">
                @include('includes/slidebar')
                <div class="col-7">
                        <div class="preview-container">
                            <video id="preview"></video>
                                <div class="cameras">
                                    <h4>Cameras</h4>
                                    <div id="camerasList">
                                    </div>
                                </div>
                            <div class="scans">
                                <div id="scans">
                                    <h4>Scans</h4>

                                </div>
                            </div>
                            <div id="line" class="line"></div>
                        </div>
                    <form style="display:none" action="{{route('adminRestaurant.pedidos.confirmation')}}" method="post" display="none">
                        @csrf
                        <input id="txtCode" type="text" name="txtCode" value="">
                        <button id="btnConfirma" name="btnConfirma" class="btn btn-primary">enviar</button>

                    </form>
                </div>
                <div class="col-3">
                    @if (session('order'))
                        @php
                            $order=session('order');
                        @endphp
                        <h2>Ultima Orden confirmada</h2>
                        <table class="table">
                            <tr>
                                <td>Fecha:</td>
                                <td>{{$order->date}}</td>
                            </tr>
                            <tr>
                                <td>Hora:</td>
                                <td>{{$order->hour}}</td>
                            </tr>
                            <tr>
                                <td>N° Personas:</td>
                                <td>{{$order->n_people}}</td>
                            </tr>
                            <tr>
                                <td>Pago:</td>
                                <td>{{$order->total}}</td>
                            </tr>
                        </table>
                    @endif
                </div>




            </div>
        </div>



@endsection
