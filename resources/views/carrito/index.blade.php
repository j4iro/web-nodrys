@extends('layouts.app')
@section('scripts')

{{-- INTEGRACION DE LA PASERAL DE PAGOS  --}}
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://checkout.culqi.com/v2"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
{{-- LO DE PASARELA --}}

<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src={{asset('js/validaciones.js') }} rel="stylesheet"></script>
<script src="{{ asset('js/app.js') }}" defer></script>
<script type="text/javascript">

Culqi.publicKey = 'pk_test_KZH8HrkmOItB9qVx';
 var producto="";
 var precio="";
 var mij="nada";
 var err="";

$(window).load(function() {
    $('#modalPago').on('show.bs.modal', function () {
        checkpagarcontarjeta.checked=true;
        poner_requireds();
        //Peticion AJAX para traer datos de la tarjeta guardada
        traerDatosTarjeta();
    });
    modalPago.click();
    $('#modalPago').on('hide.bs.modal', function () {
        checkpagarcontarjeta.checked=false;
        quitar_requireds();
    });

    $('#buyButton').on('click', function(e) {

        producto=$('#buyButton').attr('data-producto');
        precio=$('#buyButton').attr('data-precio');

           Culqi.settings({
               title: producto,
               currency: 'PEN',
               description: producto,
               amount: precio
           });

     Culqi.open();
     e.preventDefault();

    });


});

function traerDatosTarjeta()
{
    var finalUrl = {!! json_encode(url('/')) !!}+ "/carrito/datos-tarjeta";
    $.get(finalUrl,function(data)
    {
         let tarjetas;
         tarjetas = JSON.parse(data);

         if(tarjetas!='no')
         {
            let template  = ''
            tarjetas.forEach( tarjeta => {
                template += `<option value="${tarjeta.id}">${tarjeta.num_card}</option>`
                }
            );
            template += `<option value="nueva" selected><strong>Nueva tarjeta</strong></option>`;
            $('#listatarjetas').html(template);
            limpiarformTarjeta();
         }
         else
         {
            $('#listatarjetas').html(`<option value="nueva" selected>Nueva tarjeta</option>`);
            limpiarformTarjeta();
         }
    });
}

function llenarform()
{
    if($('#listatarjetas').val()=='nueva')
    {
        limpiarformTarjeta();
    }
    else
    {
        var finalUrl = {!! json_encode(url('/')) !!}+ "/carrito/datos-tarjeta/n/" + $('#listatarjetas').val();
        $.get(finalUrl,function(data)
        {
            let tarjetas;
            tarjeta = JSON.parse(data);
            $('#num_card').val(tarjeta['num_card']);
            $('#month').val(tarjeta['month']);
            $('#year').val(tarjeta['year']);
            $('#cvc').val(tarjeta['cvc']);
            $('#owner').val(tarjeta['owner']);
            $('#country').val(tarjeta['country']);
            $('#cod_postal').val(tarjeta['cod_postal']);
        });
    }
}

function limpiarformTarjeta()
{
    $('#num_card').val('');
    $('#month').val('');
    $('#year').val('');
    $('#cvc').val('');
    $('#owner').val('');
    $('#country').val('');
    $('#cod_postal').val('');
}

function poner_requireds() {
    $('#num_card').prop("required", true);
    $('#month').prop("required", true);
    $('#year').prop("required", true);
    $('#cvc').prop("required", true);
    $('#owner').prop("required", true);
    $('#country').prop("required", true);
    $('#cod_postal').prop("required", true);
}
function quitar_requireds() {
    $('#num_card').removeAttr("required");
    $('#month').removeAttr("required");
    $('#year').removeAttr("required");
    $('#cvc').removeAttr("required");
    $('#owner').removeAttr("required");
    $('#country').removeAttr("required");
    $('#cod_postal').removeAttr("required");
}


function ejecutarTargeta(){
     Culqi.publicKey = 'pk_test_KZH8HrkmOItB9qVx';
      var producto="";
      var precio="";
      var mij="nada";
      var err="";
      $('#buyButton').on('click', function(e) {

         producto=$(this).attr('data-producto');
         precio=$(this).attr('data-precio');

            Culqi.settings({
                title: producto,
                currency: 'PEN',
                description: producto,
                amount: precio
            });

      Culqi.open();
      e.preventDefault();

     });
       function culqi() {
        if (Culqi.token) { // ¡Objeto Token creado exitosamente!

                var token = Culqi.token.id;
                var email = Culqi.token.email;

                  $.ajax({
                            url: 'respuesta_pasarela',
                            method: 'get',
                            data:{producto:producto,precio:precio,token:token,email:email},
                            dataType: 'JSON',
                            success:function(data)
                            {

                              var codReferencia='sp';
                              if (data.capture==true) {
                                 codReferencia=data.reference_code;
                                 alert(" Pago por reserva exitosa \nCódigo de referencia: "+codReferencia);

                              }else{
                               mij=JSON.parse(data);
                               alert(mij.user_message);
                              }

                              console.log(data);

                             },
                            error:function(error_data)
                            {
                             console.log(error_data);
                             err=error_data;
                            alert(JSON.parse(err.responseJSON.message).user_message);

                            }
                            });

        }
        else { // ¡Hubo algún problema!
            // Mostramos JSON de objeto error en consola
         console.log(Culqi.error);
        //alert(Culqi.error.user_message);


        }
   };


</script>

@endsection

@section('title')
    {{"Carrito de compras"}}
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
                @else
                    <span class="badge badge-warning border border-secondary">0</span>
                @endif
            </strong>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-10 col-lg-6">

                @if (isset($_SESSION['carrito']) && count($_SESSION['carrito'])>=1)
                    <?php $total=0; ?>
                    @foreach ($carrito as $indice=>$dish)
                    <?php $plato = $dish['plato']; ?>
                    <div class="card mt-2 rounded-lg shadow-sm p-2">
                        <div class="row">
                        <div class="col-4   d-flex align-items-center">
                            <img src="{{ route('dish.image',['filename'=>$plato->image]) }}" class="img-thumbnail shadow ">
                        </div>
                        <div class="col-4 col-sm-5 col-md-5 col-lg-5 pt-2 px-0">
                            <div class="row ">
                                <div class="col-12">
                                    <img src="{{asset('images/icons/icono-comida-carrito.png')}}" width="20">
                                    @if($plato->name=="reserva") {{'-'}} @else {{$plato->name}}  @endif
                                </div>
                                <div class="col-12">
                                    <img src="{{asset('images/icons/icono-categoria-carrito.png')}}" width="20">
                                    <span class="font-weight-light">{{$plato->categoria_plato}}</span>
                                </div>
                                <div class="col-12">
                                    <img src="{{asset('images/icons/icono-dinero-carrito.png')}}" width="20">
                                    <?php $subtotal= $plato->price*$dish['unidades']; ?>
                                    <?php $total += $subtotal; ?>
                                    S/. {{number_format($subtotal,2,'.',' ')}}
                                </div>
                            </div>
                            {{-- {{$plato->restaurante}} --}}
                        </div>
                        <div class="col-4  col-sm-3 col-md-3 col-lg-3 d-flex justify-content-between">
                            <div class="row d-flex justify-content-center align-items-center">
                                <div class="col-12 text-center  ">
                                    <a href="{{route('carrito.deleteone',['indice'=>$indice])}}" class="btn btn-danger btn-sm">Quitar</a>
                                </div>
                                <div class="col-12  d-flex justify-content-center align-items-center">
                                    @if($plato->name!="reserva")
                                <a href="{{route('carrito.up',['indice'=>$indice])}}" class="px-1 "><img src="{{asset('images/icons/btn-up.png')}}" width="25"> </a>
                                    @endif
                                    <strong>{{$dish['unidades']}}</strong>
                                    @if($plato->name!="reserva")
                                    <a href="{{route('carrito.down',['indice'=>$indice])}}" class="px-1 "><img src="{{asset('images/icons/btn-down.png')}}" width="25"></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    @endforeach

                @else
                    {{-- Carrito Vacio --}}

                    <div class="card mt-2 rounded-lg shadow-sm p-2">
                        <div class="row">
                            <div class="col-4   d-flex align-items-center">
                                <img src="{{asset('images/icons/carrito-de-compras-icono.png')}}" class="img-thumbnail shadow ">
                            </div>
                            <div class="col-8 d-flex align-items-center justify-content-center">
                                <blockquote class="blockquote mt-2">
                                <p class="mb-0">Aún no has agregado productos a tu carrito de compras.</p>
                                <a href="./"><footer class="blockquote-footer">Ir al inicio -></footer></a>
                                </blockquote>
                            </div>
                        </div>
                    </div>

                @endif

                @if (isset($_SESSION['carrito']) && count($_SESSION['carrito'])>=1)
                <div class="card mt-2 rounded-lg shadow-sm">
                    <div class="row p-2">
                        <div class="col-4 d-flex align-items-center justify-content-center">
                        <a class="ml-2" href="{{route('carrito.deleteall')}}"><strong>Vaciar Carrito</strong></a>
                        </div>
                        <div class="col-4 d-flex align-items-center p-0">
                            <img src="{{asset('images/icons/icono-dinero-carrito.png')}}" width="20">
                            <strong class="ml-1">S/. {{number_format($total,2,'.',' ')}}</strong>
                        </div>
                        <div class="col-4 d-flex align-items-center justify-content-center">
                            <a class="" href="{{route('carrito.index')}}"><strong>Seguir comprando</strong></a>
                        </div>
                    </div>
                </div>
                @guest
                    <div class="card mt-2 mb-5 rounded-lg shadow-sm">
                        <div class="row">
                            <div class="col-12 ">
                            <a href="{{route('utils.auth')}}" name="validarAuth" id="continuar_carrito" class="btn btn-primary btn-block">Continuar</a>
                            </div>
                        </div>
                    </div>
                @endguest
                @endif

        </div>

        <!--Formulario Ocasión Especial-->
        @auth
        @if (isset($_SESSION['carrito']) && count($_SESSION['carrito'])>=1)
        <div class="mt-1 col-12 mb-3 col-sm-12 col-md-12 col-lg-4 offset-lg-1 " id="formOcasionEspecial">
            <div class="card shadow p-4 ">

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
                    <div class="col-12">
                        <dt class="mb-2">¿Cuantas personas asistirán?</dt>
                        <input type="number" placeholder="Número de personas" value="1" class="form-control" name="n_people" required>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-12">
                        <dt class="mb-2">¿Qué día asistirán?</dt>
                    <input type="date" class="form-control" name="fecha" value="{{date('Y-m-d')}}" required >
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-12">
                        <dt class="mb-2">¿A qué hora asistirán?</dt>
                        <select class="form-control" name="hora" id="hora" required>
                            @for ($i = 11; $i <= 23; $i++)
                                <option value="{{$i}}:00">{{$i}}:00</option>
                                <option value="{{$i}}:30">{{$i}}:30</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-12">
                        <strong class="text-primary">Pagar con:</strong>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-6">

                        <input type="button" id="buyButton" value="Pagar" data-producto="Este es el producto " data-precio=1000 >

                        {{-- <a href="" data-toggle="modal" data-target="#modalPago" class="btn btn-block  btn-primary ">Tarjeta</a> --}}

                    </div>
                    <div class="col-6">
                        <button type="submit"  class="btn btn-block  btn-danger ">Efectivo</button>

                    </div>
                </div>

            </div>
        </div>
        <!--Formulario Ocasión Especial-->
        @endif
        @endauth

</div>

      <!-- Modal Formulario de Pago -->
      <div class="modal fade" id="modalPago" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-body">
                <!--Formulario de Pago-->
                    <div class="row my-3">
                        <div class="col-12 col-sm-12">


                                <div class="row">
                                    <dt class="col-12">
                                        <label for="rbtarjeta" id="titulo_modal" class="form-label">Escoge una tarjeta</label>
                                        <select name="listatarjetas" onChange="llenarform();" class="form-control" id="listatarjetas">
                                        </select>
                                        <hr>
                                    </dt>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-12">
                                        <input type="checkbox" class="d-none" name="pagarcontarjeta" id="checkpagarcontarjeta">
                                        <input type="text" onkeypress="return validarNumero(event);" placeholder="Número de tarjeta" class="form-control" name="num_card" id="num_card" >
                                    </div>
                                </div>


                                <div class="row mt-2">
                                    <div class="col-4  pr-0">
                                        <select name="month" class="form-control" id="month" >
                                            <option value="" disabled selected>MM</option>
                                            @for ($i = 1; $i < 13; $i++)
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-4  pl-0">
                                        <select name="year" class="form-control" id="year" >
                                            <option value="" disabled selected>AAAA</option>
                                            @for ($i = 2020; $i < 2040; $i++)
                                                <option value="{{$i}}"  >{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <input type="text" placeholder="CVC" class="form-control" name="cvc" id="cvc" >
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-12">
                                        <input type="text" onkeypress="return validarLetras(event);" placeholder="Nombre en la tarjeta" class="form-control" name="owner" id="owner" >
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-8 ">
                                        <select name="country" class="form-control" id="country">
                                            <option value="" disabled selected>Pais</option>
                                            <option value="per" >Perú</option>
                                            <option value="col" >Colombia</option>
                                            <option value="chi" >Chile</option>
                                            <option value="ecu" >Ecuador</option>
                                            <option value="mex" >México</option>
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <input type="text" placeholder="Código Postal" class="form-control" name="cod_postal" id="cod_postal">
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

<script type="text/javascript">
    //ejecutarTargeta();
</script>

@endsection
