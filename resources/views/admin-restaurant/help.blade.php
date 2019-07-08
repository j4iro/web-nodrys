@extends('layouts.app-r')

@section('title')
    Ayuda en Nodrys
@endsection

@section('content')

<div class="container my-4">
    <h2 class="display-4 display-help text-center mt-2">¿Cómo te podemos ayudar?</h2>
    <hr>
    <p>
        Porque pensamos en ti, te ofrecemos un manual visual para que aprendas a usar nuestra página web y puedas ser parte de la familia <strong>Nodrys</strong>.
        Aprovecha nuestro servicio de reservas y sacale provecho a nuestra plataforma, donde podrás llevar un registro de tus reservas, además te garantizamos la reducción de tiempo en cuanto la atención, para que puedas realizar mas cosas que te gustan.
    </p>
</div>


<div class="container card border border-secondary px-0    mb-3">
        <a   class="card-header font-weight-bold cursor-pointer" id="help_restaurant">Restaurante (Administrador)</a>

        <div class="card-body help-container" id="help_restaurant_container">
            <div class="row mb-5">

              <div class="col-12  col-sm-6  col-md-4  "  >
                <h4 class="font-weight-bold text-center">Agrega tus platos</h4>
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" width="100%" height="100%" src="https://www.youtube.com/embed/VrZ4snt7T90" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
              </div>

              <div class="col-12  col-sm-6  col-md-4  ">
                <h4 class="font-weight-bold text-center">Confirma las reservas</h4>
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" width="100%" height="100%" src="https://www.youtube.com/embed/DK2sWTFnYPA" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
              </div>

              <div class="col-12  col-sm-6  col-md-4  ">
                <h4 class="font-weight-bold text-center">Imprime tus reportes</h4>
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" width="100%" height="100%" src="https://www.youtube.com/embed/OPK4_qfZ8rI" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
              </div>
            </div>
        </div>
    </div>

<script type="text/javascript">

help_restaurant.addEventListener('click',function () {
    muestra(help_restaurant_container);

});

function muestra(objeto)
{
    objeto.classList.toggle('help-show');
}

</script>
@endsection
