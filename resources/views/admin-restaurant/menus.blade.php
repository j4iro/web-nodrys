@extends('layouts.app-r')
@section('scripts')
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>

    <script>

    var dia;
    var idRestaurant={{$id}};
    $(window).load(function() {
        traerPlatos();
        var diaActual=new Date().getDay();
        switch (diaActual) {
            case 0:
                btnDomingo.click();
                break;
            case 1:
                btnLunes.click();
                    break;
            case 2:
                btnMartes.click();
                    break;
            case 3:
                btnMiercoles.click();
                    break;
            case 4:
                btnJueves.click();
                    break;
            case 5:
                btnViernes.click();
                    break;
            case 6:
                btnSabado.click();
                    break;
            default:

        }
        console.log(diaActual);


    });
    var DIA;
    function changeDay(dia){
        DIA=dia.value;
        btnLunes.classList.remove('btn-primary');
        btnLunes.classList.add('btn-light');
        btnMartes.classList.remove('btn-primary');
        btnMartes.classList.add('btn-light');
        btnMiercoles.classList.remove('btn-primary');
        btnMiercoles.classList.add('btn-light');
        btnJueves.classList.remove('btn-primary');
        btnJueves.classList.add('btn-light');
        btnViernes.classList.remove('btn-primary');
        btnViernes.classList.add('btn-light');
        btnSabado.classList.remove('btn-primary');
        btnSabado.classList.add('btn-light');
        btnDomingo.classList.remove('btn-primary');
        btnDomingo.classList.add('btn-light');

        dia.classList.remove('btn-light');
        dia.classList.toggle('btn-primary');
        listarPlatoAlMenu();

    }
    function inserta(value) {
        insertarPlatoAlMenu(DIA,value.value);
        listarPlatoAlMenu();
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
            dia:DIA
        },function(resultados){
            let platos = JSON.parse(resultados);
            let items='';

            platos.forEach( plato => {
                // Ceviche
                 items+= `<button class="btn d-flex justify-content-between align-items-center w-100" m>${plato.name}<a id="${plato.id}" onclick="eliminarPlatoMenu(this.id);" class="ml-auto text-danger">Quitar</a></button>`
            });
            platosMenu.innerHTML=items;
            // $('#ListaPlatos').html(items);
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
            if(platos!='no')
            {
                let template  = ''
                platos.forEach( plato => {
                    // items+= `<button class="btn d-flex justify-content-between align-items-center w-100" m>${plato.name}<a id="${plato.id}" onclick="eliminarPlatoMenu(this.id);" class="ml-auto text-danger">Quitar</a></button>`

                    template += `<li class='btn d-flex'><button onclick='inserta(this)' class='badge badge-success' value='${plato.id}'>+</button> ${plato.name}</li>`

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
    <style media="screen">

    </style>
    <style media="screen">
        .seccion-container{
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;

        }
        .borde{
            border: 1px solid red;
            border-radius: 10px;
            padding: 10px;
        }
        .seccion{
            width: 200px;
        }
        .btn{
            width: 150px;
            margin:5px 0;
        }
    </style>

    {{-- parte de Beimer --}}
    <div class="d-md-flex justify-content-between m-2">
        <button onclick="changeDay(this)" id="btnDomingo" value="Domingo" class="btn btn-ligth border border-dark">Domingo</button>
        <button onclick="changeDay(this)" id="btnLunes" value="Lunes" class="btn btn-light border border-dark">Lunes</button>
        <button onclick="changeDay(this)" id="btnMartes" value="Martes" class="btn btn-light border border-dark">Martes</button>
        <button onclick="changeDay(this)" id="btnMiercoles" value="Miercoles" class="btn btn-light border border-dark">Miercoles</button>
        <button onclick="changeDay(this)" id="btnJueves" value="Jueves" class="btn btn-light border border-dark">Jueves</button>
        <button onclick="changeDay(this)" id="btnViernes" value="Viernes" class="btn btn-light border border-dark">Viernes</button>
        <button onclick="changeDay(this)" id="btnSabado" value="Sabado" class="btn btn-light border border-dark">Sabado</button>
    </div>
    <div class="row">
        <div class="col-sm-6" id="ListaPlatos">
        </div>
        <div class="col-sm-6" id="platosMenu">

        </div>
    </div>

    {{-- *************************** --}}

@endsection
