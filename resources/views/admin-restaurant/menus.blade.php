@extends('layouts.app-r')

@section('scripts')
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>

    <script src="{{ asset('js/app.js') }}" defer></script>

    <script>
    var dia;
    $(window).load(function() {
        $('#exampleModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            dia = button.data('whatever')
            var modal = $(this)
            modal.find('.modal-title').text('Día ' + dia)
            // modal.find('.modal-body input').val(recipient)
            traerPlatos()
        })
    });

    function insertarPlatoAlMenu()
    {
        var finalUrl = {!! json_encode(url('/')) !!}+ "/admin-restaurante/saveplatomenu";
        $.get(finalUrl,
        {
            dia: dia,
            dish_id: $('#comboplatos').val(),
            restaurant_id: 1
        });
        // console.log(dia + dish_id + $('#comboplatos').val());
    }

    function traerPlatos()
    {
        var finalUrl = {!! json_encode(url('/')) !!}+ "/admin-restaurante/getplatos";

        $.get(finalUrl, function(data)
        {
            let platos;
            platos = JSON.parse(data);

            if(platos!='no')
            {
                let template  = ''
                platos.forEach( plato => {
                    template += `<option value="${plato.id}">${plato.name}</option>`
                    // template += `<li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">${plato.name}</li>`
                    }
                );
                 template += `<option value="" disabled selected>Elija un plato</option>`;
                $('#comboplatos').html(template);
            }
            else
            {
                //No hay platos
            }

        });
    }
    </script>

@endsection

@section('content')

    <div class="row">
        <div class="col-12">
            <strong class="navbar-brand p-0">Mis menús</strong>
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-3">
            <div class="card border-dark mb-3" style="max-width: 18rem;">
                <div class="card-header">Lunes</div>
                <div class="card-body text-dark">
                  <h5 class="card-title"><a href="#modal" data-toggle="modal" data-target="#exampleModal" data-whatever="Lunes">Editar</a></h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
              </div>
        </div>
        <div class="col-3">
            <div class="card border-dark mb-3" style="max-width: 18rem;">
                <div class="card-header">Martes</div>
                <div class="card-body text-dark">
                  <h5 class="card-title"><a href="#modal" data-toggle="modal" data-target="#exampleModal" data-whatever="Martes">Editar</a></h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
              </div>
        </div>
        <div class="col-3">
            <div class="card border-dark mb-3" style="max-width: 18rem;">
                <div class="card-header">Miercoles</div>
                <div class="card-body text-dark">
                  <h5 class="card-title"><a href="#modal" data-toggle="modal" data-target="#exampleModal" data-whatever="Miercoles">Editar</a></h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
              </div>
        </div>
        <div class="col-3">
            <div class="card border-dark mb-3" style="max-width: 18rem;">
                <div class="card-header">Jueves</div>
                <div class="card-body text-dark">
                  <h5 class="card-title"><a href="#modal" data-toggle="modal" data-target="#exampleModal" data-whatever="Jueves">Editar</a></h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
              </div>
        </div>
        <div class="col-3">
            <div class="card border-dark mb-3" style="max-width: 18rem;">
                <div class="card-header">Viernes</div>
                <div class="card-body text-dark">
                  <h5 class="card-title"><a href="#modal" data-toggle="modal" data-target="#exampleModal" data-whatever="Viernes">Editar</a></h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
              </div>
        </div>
        <div class="col-3">
            <div class="card border-dark mb-3" style="max-width: 18rem;">
                <div class="card-header">Sábado</div>
                <div class="card-body text-dark">
                  <h5 class="card-title"><a href="#modal" data-toggle="modal" data-target="#exampleModal" data-whatever="Sábado">Editar</a></h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
              </div>
        </div>
        <div class="col-3">
            <div class="card border-dark mb-3" style="max-width: 18rem;">
                <div class="card-header">Domingo</div>
                <div class="card-body text-dark">
                  <h5 class="card-title"><a href="#modal" data-toggle="modal" data-target="#exampleModal" data-whatever="Domingo">Editar</a></h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
              </div>
        </div>
    </div>


    {{-- MODAL --}}

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              {{-- <h5 class="modal-title" id="exampleModalLabel">Día </h5> --}}
              <strong class="modal-title navbar-brand p-0"></strong>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

                <div class="form-row">
                    <div class="col-9 mb-3">
                        <select name="" id="comboplatos" class="form-control">
                            <option value="" disabled selected>Elija un plato</option>
                        </select>
                    </div>
                    <div class="col-2">
                        <button class="btn btn-primary ml-2" onclick="insertarPlatoAlMenu();">Agregar</button>
                    </div>

                </div>

                <ul class="list-group shadow-sm" >

                    <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">Ceviche  <a href="" class="ml-auto text-danger">Quitar</a>  </li>
                    <li class="list-group-item list-group-item-action">Causa</li>
                </ul>



            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              {{-- <button type="button" class="btn btn-primary">Guardar</button> --}}
            </div>
          </div>
        </div>
      </div>

@endsection
