@extends('layouts.app-r')
@section('scripts')
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>

    <script>

    var dia;
    var idRestaurant={{$id}};
    $(window).load(function() {
        traerPlatos();


    });
    var DIA;
    function changeDay(dia){
        DIA=dia.value;
    }
    function inserta(value) {
        insertarPlatoAlMenu(DIA,value.value);
    }
    function insertarPlatoAlMenu(dia,platoId)
    {
        var finalUrl = {!! json_encode(url('/')) !!}+ "/admin-restaurante/saveplatomenu";

        $.get(finalUrl,
        {   dia:dia,
            dish_id:platoId,
            restaurant_id:idRestaurant
        },function(e) {
            console.log(e);
        });
        // console.log(dia + dish_id + $('#comboplatos').val());
        // listarPlatoAlMenu();
    }

    function listarPlatoAlMenu()
    {
        var finalUrl = {!! json_encode(url('/')) !!}+ "/admin-restaurante/listarplatomenu";

        $.get(finalUrl,
        {
            restaurant_id: idRestaurant,
            dia: dia
        },function(resultados){
            let platos = JSON.parse(resultados);
            let items='';

            platos.forEach( plato => {
                // Ceviche
                 items+= `<button class="d-flex justify-content-between align-items-center">${plato.name}<a id="${plato.id}" onclick="eliminarPlatoMenu(this.id);" class="ml-auto text-danger">Quitar</a></button>`
            });
            $('#ListaPlatos').html(items);
        });
    }

    function eliminarPlatoMenu(id){
        var finalUrl = {!! json_encode(url('/')) !!}+ "/admin-restaurante/eliminarplatomenu";
        $.get(finalUrl,
        {
            menu_id: id
        });

        listarPlatoAlMenu();
    }

    function traerPlatos()
    {
        var finalUrl = {!! json_encode(url('/')) !!}+ "/admin-restaurante/getplatos";

        $.get(finalUrl, function(data)
        {
            let platos;
            platos = JSON.parse(data);
// console.log(data)
            if(platos!='no')
            {
                let template  = ''
                platos.forEach( plato => {
                    template += `<li class='list-group-item d-flex justify-content-between'>${plato.name}<button onclick='inserta(this)' class='btn' value='${plato.id}'>+</button></li>`

                    }
                );
                 ListaPlatos.innerHTML=template;
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
    {{-- parte de Beimer --}}
    <div class="d-flex">
        <button onclick="changeDay(this)" value="Domingo" class="btn btn-primary">Domingo</button>
        <button onclick="changeDay(this)" value="Lunes" class="btn btn-primary">Lunes</button>
        <button onclick="changeDay(this)" value="Martes" class="btn btn-primary">Martes</button>
        <button onclick="changeDay(this)" value="Miercoles" class="btn btn-primary">Miercoles</button>
        <button onclick="changeDay(this)" value="Jueves" class="btn btn-primary">Jueves</button>
        <button onclick="changeDay(this)" value="Viernes" class="btn btn-primary">Viernes</button>
        <button onclick="changeDay(this)" value="Sabado" class="btn btn-primary">Sabado</button>
    </div>
    <div class="row">
        <div class="card col-4 list-group" id="ListaPlatos">
        </div>
        <div class="card col-6">

        </div>
    </div>

    {{-- *************************** --}}

@endsection
