@extends('layouts.app-r')
@section('scripts')
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script>
    var dia;
    var idRestaurant={{$id}};
    var arrayPlatos=getDishes();
    var arrayPlatosMenu=[];

    $(window).load(function() {
        // console.log(arrayPlatos[0]);
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

        getMenuDishes();



    }
// NOTE: esta funcion verifica si el plato existe en el menu que se esta escribiendo
function verifica(dia,platoId){
    var existe=false;
    var url={!! json_encode(url('/')) !!}+ "/admin-restaurante/menus/exists";
    $.get(url,
    {
        idPlato:platoId,
        idRestaurante:idRestaurant,
        dia:dia
    },function(e) {
        existe=e=='OK'?true:false;
        if (existe) {
console.log('existe');
        }else {
            insertarPlatoAlMenu(dia,platoId);
        }
    });
}
    function inserta(value) {
        verifica(DIA,value.value);
        listarPlatoAlMenu();
    }

    function insertarPlatoAlMenu(dia,platoId)
    {
        var finalUrl = {!! json_encode(url('/')) !!}+ "/admin-restaurante/saveplatomenu";
        $.get(finalUrl,
        {
            dia:dia,
            dish_id:platoId,
            restaurant_id:idRestaurant
        },function(e) {
            // console.log(e);
        });
        getMenuDishes();

    }

// NOTE: listan los platos que etan en el menu del dia elegido
function listarPlatoAlMenu()
    {
        var finalUrl = {!! json_encode(url('/')) !!}+ "/admin-restaurante/listarplatomenu";

    }

function eliminarPlatoMenu(id){
    var finalUrl = {!! json_encode(url('/')) !!}+ "/admin-restaurante/eliminarplatomenu";
    $.get(finalUrl,
    {
        menu_id: id
    });
    getMenuDishes();
}

// NOTE: lista todos los platos
function getDishes() {
    var arrayPlatos=[];
    var finalUrl = {!! json_encode(url('/')) !!}+ "/admin-restaurante/getplatos";
    $.get(finalUrl, function(data)
    {
        let platos = JSON.parse(data);
        platos.forEach(
            plato=>{
                arrayPlatos.push(plato);
            }
        )
    });
    return arrayPlatos;
}

function getMenuDishes() {
    var arrayPlatosMenu=[];
    var finalUrl = {!! json_encode(url('/')) !!}+ "/admin-restaurante/listarplatomenu";
    $.get(finalUrl,
    {
        restaurant_id: idRestaurant,
        dia:DIA
    },function(resultados){
        let platosMenu = JSON.parse(resultados);
        let itemsMenu='';
        let itemsPlatos='';

        for(var i=0;i<platosMenu.length;i++){
            arrayPlatosMenu[i]=platosMenu[i].name;
            itemsMenu+= `<button class="btn d-flex justify-content-between align-items-center w-100" m>${platosMenu[i].name}<a id="${platosMenu[i].id}" onclick="eliminarPlatoMenu(this.id);" class="ml-auto text-danger">Quitar</a></button>`
        }
        for(var i=0;i<arrayPlatos.length;i++){
            if(arrayPlatosMenu.indexOf(arrayPlatos[i].name)==-1){
                itemsPlatos += `<li class='btn d-flex'><button onclick='inserta(this)' class='badge badge-success' value='${arrayPlatos[i].id}'>+</button> ${arrayPlatos[i].name}</li>`
            }

        }

        platosMenuDiv.innerHTML=itemsMenu;
        ListaPlatos.innerHTML=itemsPlatos;

    });
}
</script>

@endsection
@section('content')

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
        <div class="col-sm-6" id="platosMenuDiv">

        </div>
    </div>
@endsection
