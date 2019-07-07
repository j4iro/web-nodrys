    <div class="list-group list-group-slidebar border border-info rounded shadow-sm">
        <a href="{{route('admin-r.menus')}}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">Menús
        <a href="{{route('adminRestaurant.plato.list')}}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">Mis Platos
                {{-- <span class="badge badge-primary badge-pill ml-auto">14</span> --}}
        </a>
        <a href="{{route('adminRestaurant.plato.new')}}" class="list-group-item list-group-item-action">Nuevo Plato</a>

        <a href="{{route('adminRestaurant.index')}}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">Pedidos pendientes
            {{-- <span class="badge badge-primary badge-pill ml-auto">14</span> --}}
        </a>
        <a href="{{route('adminRestaurant.pedidos.completados')}}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">Pedidos completados
            {{-- <span class="badge badge-primary badge-pill ml-auto">14</span> --}}
        </a>

        <a href="{{route('adminRestaurant.orders.qr')}}" class="list-group-item list-group-item-action">Lector QR</a>

        <a href="{{route('adminRestaurant.reportes')}}" class="list-group-item list-group-item-action">Reportes Rápidos</a>

        <a href="{{route('adminRestaurant.reportespersonalizados')}}" class="list-group-item list-group-item-action">Reportes Personalizado</a>

        {{-- <a href="{{route('adminRestaurant.reportespedidos')}}" class="list-group-item list-group-item-action">Reportes Pedidos</a> --}}

        <a href="{{route('adminRestaurant.datos')}}" class="list-group-item list-group-item-action">Mis Datos</a>
        <a href="{{route('admin-r.cuentaBancaria')}}" class="list-group-item list-group-item-action">Datos Bancarios</a>
        <a href="{{route('totalComision')}}" class="list-group-item list-group-item-action">Comisión</a>

    <a href="" class="list-group-item list-group-item-action pb-0"><strong id="labeldisponibilidad" class="mr-3">@if(session('estado_restaurant')==1){{'ABIERTO'}}@else{{'CERRADO'}}@endif</strong>
            <label class="switch ">
                <input id="checkdisponibilidad" type="checkbox" @if(session('estado_restaurant')==1) {{'checked'}} @endif onchange="cambiardisponibilidad();">
                <span class="slider round"></span>
            </label>
        </a>

        <a href="{{route('admin-r.help')}}" class="list-group-item list-group-item-action">Ayuda</a>

        <a href="{{ route('logout') }}" onclick="event.preventDefault();
        document.getElementById('logout-form').submit();"  class="list-group-item list-group-item-action text-danger"><strong>Salir</strong></a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
