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
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est consequatur voluptate maiores nulla ea consequuntur, et nihil eligendi cumque, temporibus incidunt obcaecati earum inventore pariatur a sint quo fugiat? Hic fugit unde velit quis, nobis ipsam non dolore similique, natus delectus incidunt at culpa explicabo ullam optio magni consequuntur maiores nihil modi nam deleniti facilis eos ducimus esse libero. Dolore, placeat. Similique ipsa et quasi praesentium repellat quam, odio maiores, illum quo officia illo, dolores consectetur sit architecto assumenda laudantium sint excepturi consequatur magni commodi laborum. Facere magni nulla, suscipit rerum ullam fuga, commodi quae soluta, asperiores repellat velit dolorum.

    </p>
</div>
<div class="container card">
    <h2 class="card-header" id="help_client">Cliente</h2>
    <div class="card-body" id="help_client_container">
        <div class="row">
          <div class="col-sm-4">
            <h4>Crear una cuenta de usuario</h4>
            <video class="help_videos" src="" poster="">

            </video>
          </div>
          <div class="col-sm-4">
            <h4>Realizar una reserva de lugar</h4>
            <video class="help_videos" src="" poster="">

            </video>
          </div>
          <div class="col-sm-4">
            <h4>Realizar un pedido de platos</h4>
            <video class="help_videos" src="" poster="">

            </video>
          </div>
          <div class="col-sm-4">
            <h4>Localizar restaurantes cercanos</h4>
            <video class="help_videos" src="" poster="">

            </video>
          </div>
        </div>
    </div>

</div>
<div class="container card">
    <h2 id="help_restaurant" class="card-header">Restaurante[Administrador]</h2>
 <div id="help_restaurant_container" class="card-body">
     <div class="row">
       <div class="col-sm-4">
         <h4>¿Cómo unirte a nodrys?</h4>
         <video class="help_videos" src="" poster="">

         </video>
       </div>
       <div class="col-sm-4">
         <h4>Agrega tus platos</h4>
         <video class="help_videos" src="" poster="">

         </video>
       </div>
       <div class="col-sm-4">
         <h4>Confirma las reservas</h4>
         <video class="help_videos" src="" poster="">

         </video>
       </div>
       <div class="col-sm-4">
         <h4>Imprime tus reportes</h4>
         <video class="help_videos" src="" poster="">

         </video>
       </div>
     </div>
 </div>
</div>
<div class="container card">
    <h2 class="card-header" id="help_question">Preguntas Frecuentes</h2>
    <div class="card-body" id="help_questions_container">
        <div class="row">
          <div class="col-sm-4 panel panel-default">
            <h4>Crear una cuenta de usuario</h4>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et m id est laborum.
            </p>
          </div>
          <div class="col-sm-4">
            <h4>Realizar una reserva de lugar</h4>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et m id est laborum.
            </p>
          </div>
          <div class="col-sm-4">
            <h4>Realizar un pedido de platos</h4>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et m id est laborum.
            </p>
          </div>
          <div class="col-sm-4">
            <h4>Localizar restaurantes cercanos</h4>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et m id est laborum.
            </p>
          </div>
        </div>
      </div>
    </div>


<script type="text/javascript">


help_client_container.style.display="none";
help_restaurant_container.style.display="none";
help_questions_container.style.display="none";

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
objeto.style.display="block";
}

</script>
@endsection
