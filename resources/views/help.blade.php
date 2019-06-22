@extends('layouts.app')

@section('scripts')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css"
       integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
       crossorigin=""/>
     <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"
      integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg=="
      crossorigin=""></script>
      <style media="screen">
          #map{
              height: 400px;

          }
          .hubicacion_controls{
              display: none;
          }
          .btnActual{
              position: absolute;
              z-index: 99;
              right: 0;
          }
          .map_container{
            position: relative;
          }
      </style>
@endsection
@section('title')
    Solicitud de registro
@endsection
@section('content')
<div class="container my-4">
    <h1>¿Cómo te podemos ayudar?</h1>
    <p>
        Porque pensamos en ti, te ofrecemos un manual visual para que aprendas a usar nuestra plaforma y puedas ser parte de la familia <strong>nodrys</strong>.
        Aprovecha nuestro servicio de reservas y sacale provecho a nuestra plataforma, donde podras llevar un registro de tus reservas, ademas te garantizamos la reducción de tiempo en cuanto la atención, para que puedas realizar mas cosas.
    </p>
</div>
<div class="container card">

    <a class="card-header" id="help_client">Cliente</a>
    <div class="card-body help-container" id="help_client_container">

        <div class="row">
          <div class="col-sm-4 mg-top">
            <h4>Crear una cuenta de usuario</h4>
            <iframe width="100%" height="100%" src="https://www.youtube.com/embed/anutwQfd2TA" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

          </div>
          <div class="col-sm-4 mg-top">
            <h4>Realizar una reserva de lugar</h4>
            <iframe width="100%" height="100%" src="https://www.youtube.com/embed/zHziYDWxadc" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

          </div>
          <div class="col-sm-4 mg-top" style="margin-top:50px">
            <h4>Realizar un pedido de platos</h4>
            <iframe width="100%" height="100%" src="https://www.youtube.com/embed/rEB2p_9H6WA" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

          </div>
          <div class="col-sm-4 mg-top" style="margin-top:100px;margin-bottom:50px">
            <h4>Localizar restaurantes cercanos</h4>
            <iframe width="100%" height="100%" src="https://www.youtube.com/embed/QLxT13Xp7S0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          </div>
        </div>
    </div>

</div>
<div class="container card">

    <a id="help_restaurant" class="card-header">Restaurante[Administrador]</a>
 <div id="help_restaurant_container" class="card-body help-container">

     <div class="row">
       <div class="col-sm-4 mg-top">
         <h4>¿Cómo unirte a nodrys?</h4>

         <iframe width="100%" height="100%" src="https://www.youtube.com/embed/JxTxE-ZgOVU" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

       </div>
       <div class="col-sm-4 mg-top">
         <h4>Agrega tus platos</h4>
         <iframe width="100%" height="100%" src="https://www.youtube.com/embed/VrZ4snt7T90" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

       </div>
       <div class="col-sm-4 mg-top">
         <h4>Confirma las reservas</h4>
         <iframe width="100%" height="100%" src="https://www.youtube.com/embed/DK2sWTFnYPA" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

       </div>
       <div class="col-sm-4 mg-top">
         <h4>Imprime tus reportes</h4>
         <iframe width="100%" height="100%" src="https://www.youtube.com/embed/OPK4_qfZ8rI" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
       </div>
     </div>
 </div>
</div>
<div class="container card">

    <a class="card-header" id="help_question">Preguntas Frecuentes</a>
    <div class="card-body help-container" id="help_questions_container">
        <div class="row">
          <div class="col-sm-4">
            <h4>¿Tiene un costo la reserva?</h4>
            <p>
                Hemos establecido un costo de tan solo <strong> S/. 1.00 </strong> por cada reserva que desees realizar y esta incluida junto al pedido de platos que haz realizado. Esto se hace para que puedas llevar un buen registro de tus pedidos y reservas que haces, ademas de agilizar la atención que se te brindará.
            </p>
          </div>
          <div class="col-sm-4">
            <h4>Solo quieres realizar reserva</h4>
            <p>
                Descuida si no deseeas adquirir de la compra de platos y solo desea realizar la reserva, lo puedes hacer solo dando clic en el boton <strong>Reservar.</strong>
            </p>
          </div>
          <div class="col-sm-4">
            <h4>La reserva ¿Solo es para una persona?</h4>
            <p>
                Tranquil@ no tomamos en cuenta la cantidad de personas que asistiran, el pago de la reserva solo es por el pedido sin tener encuenta la cantidad de pesonas que asistirán.
            </p>
          </div>

        </div>
      </div>
    </div>


<script type="text/javascript">




help_client.addEventListener('click',function () {
    muestra(help_client_container);

});
help_restaurant.addEventListener('click',function () {
    muestra(help_restaurant_container);


});
help_question.addEventListener('click',function () {
    muestra(help_questions_container);


});

function muestra(objeto) {

objeto.classList.toggle('help-show');
}

</script>
@endsection
