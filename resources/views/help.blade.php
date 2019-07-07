@extends('layouts.app')

@section('title')
    Ayuda en Nodrys
@endsection

@section('content')

<div class="container my-4">
    <h2 class="display-4 display-help text-center mt-4">¿Cómo te podemos ayudar?</h2>
    <hr>
    <p>
        Porque pensamos en ti, te ofrecemos un manual visual para que aprendas a usar nuestra página web y puedas ser parte de la familia <strong>Nodrys</strong>.
        Aprovecha nuestro servicio de reservas y sacale provecho a nuestra plataforma, donde podrás llevar un registro de tus reservas, además te garantizamos la reducción de tiempo en cuanto la atención, para que puedas realizar mas cosas que te gustan.
    </p>
</div>

<div class="container card border border-secondary px-0    mb-3">
    <a  class="card-header font-weight-bold cursor-pointer" id="help_client">Cliente</a>

    <div class="card-body help-container" id="help_client_container">
        <div class="row mb-5">
          <div class="col-12  col-sm-6  col-md-4  ">
            <h4 class="font-weight-bold text-center mt-2">Realizar una reserva de lugar</h4>
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" width="100%" height="100%" src="https://www.youtube.com/embed/zHziYDWxadc" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
          </div>

          <div class="col-12  col-sm-6  col-md-4  "  >
            <h4 class="font-weight-bold text-center mt-2">Realizar un pedido de platos</h4>
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" width="100%" height="100%" src="https://www.youtube.com/embed/rEB2p_9H6WA" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
          </div>

          <div class="col-12  col-sm-6  col-md-4  ">
            <h4 class="font-weight-bold text-center mt-2">Localizar restaurantes cercanos</h4>
            <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item" width="100%" height="100%" src="https://www.youtube.com/embed/QLxT13Xp7S0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
          </div>
        </div>
    </div>
</div>


<div class="container card border border-secondary px-0 mb-3">
    <a class="card-header font-weight-bold" id="help_question">Preguntas Frecuentes</a>
    <div class="card-body help-container" id="help_questions_container">
        <div class="row">
          <div class="col-sm-12">
            <h4 class="font-weight-bold ">1. ¿Tiene un costo la reserva?</h4>
            <p>
                Hemos establecido un costo de tan solo <strong> S/. 1.00 </strong> por cada reserva que desees realizar y esta incluida junto al pedido de platos que haz realizado. Esto se hace para que puedas llevar un buen registro de tus pedidos y reservas que haces, ademas de agilizar la atención que se te brindará.
            </p>
          </div>
          <div class="col-sm-12">
            <h4 class="font-weight-bold ">2. Solo quieres realizar reserva</h4>
            <p>
                Descuida si no deseeas adquirir de la compra de platos y solo desea realizar la reserva, lo puedes hacer solo dando clic en el boton <strong>Reservar.</strong>
            </p>
          </div>
          <div class="col-sm-12">
            <h4 class="font-weight-bold ">3. La reserva ¿Solo es para una persona?</h4>
            <p>
                Tranquil@, no tomamos en cuenta la cantidad de personas que asistiran, el pago de la reserva solo es por el pedido sin tener encuenta la cantidad de pesonas que asistirán.
            </p>
          </div>

        </div>
      </div>
</div>


<script type="text/javascript">

help_client.addEventListener('click',function () {
    muestra(help_client_container);

});

help_question.addEventListener('click',function () {
    muestra(help_questions_container);

});

function muestra(objeto)
{
    objeto.classList.toggle('help-show');
}

</script>
@endsection
