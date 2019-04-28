{{-- SLIDEBAR PARA LA SECCIÓN ADMIN --}}
<div class="col-12 col-md-3 col-lg-2 mb-3">
        <div class="list-group border border-info rounded shadow-sm">

            <div class="btn-group dropright">
                <a  href="" class="list-group-item list-group-item-action dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Solicitudes
                </a>
                <div class="dropdown-menu" x-placement="right-start" style="position: absolute; transform: translate3d(111px, 0px, 0px); top: 0px; left: 0px; will-change: transform;">
                    <a href="{{route('admin.index')}}" class="dropdown-item">
                        Nuevas
                        {{-- <span class="badge badge-primary badge-pill ml-auto">14</span> --}}
                    </a>
                    <a href="{{route('admin.solicitudes.aceptadas')}}" class="dropdown-item">
                        Aceptadas
                    </a>
                    <a href="{{route('admin.solicitudes.historial')}}" class="dropdown-item">
                        Todas
                    </a>
                </div>
            </div>

            <div class="btn-group dropright">
                <a  href="" class="list-group-item list-group-item-action dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Restaurantes
                </a>
                <div class="dropdown-menu" x-placement="right-start" style="position: absolute; transform: translate3d(111px, 0px, 0px); top: 0px; left: 0px; will-change: transform;">
                    <a href="{{route('admin.restaurants')}}" class="dropdown-item">
                        Listar
                        {{-- <span class="badge badge-primary badge-pill ml-auto">14</span> --}}
                    </a>
                    <a href="{{route('admin.restaurant.new')}}" class="dropdown-item">
                        Agregar
                    </a>
                </div>
            </div>

            <div class="btn-group dropright">
                <a  href="" class="list-group-item list-group-item-action dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Pedidos
                </a>
                <div class="dropdown-menu" x-placement="right-start" style="position: absolute; transform: translate3d(111px, 0px, 0px); top: 0px; left: 0px; will-change: transform;">
                    <a href="" class="dropdown-item">
                        Pendientes
                        <span class="badge badge-primary badge-pill ml-auto">14</span>
                    </a>
                    <a href="" class="dropdown-item">
                        Completados
                        <span class="badge badge-primary badge-pill ml-auto">14</span>
                    </a>
                </div>
            </div>

            <div class="btn-group dropright">
                <a  href="" class="list-group-item list-group-item-action dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Reportes
                </a>
                <div class="dropdown-menu" x-placement="right-start" style="position: absolute; transform: translate3d(111px, 0px, 0px); top: 0px; left: 0px; will-change: transform;">
                    <a class="dropdown-item" href="{{route('admin.reportes')}}">Predeterminados</a>
                    <a class="dropdown-item" href="{{route('adminRestaurant.reportesclientes')}}">Clientes</a>
                    <a class="dropdown-item" href="{{route('adminRestaurant.reportespedidos')}}">Pedidos</a>
                </div>
            </div>

            <div class="btn-group dropright">
                <a  href="" class="list-group-item list-group-item-action dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Categorias
                </a>
                <div class="dropdown-menu" x-placement="right-start" style="position: absolute; transform: translate3d(111px, 0px, 0px); top: 0px; left: 0px; will-change: transform;">
                    <a class="dropdown-item" href="{{route('admin.categorias.list')}}">Listar</a>
                    <a class="dropdown-item" href="{{route('admin.categorias.list')}}">Agregar</a>
                </div>
            </div>

            <div class="btn-group dropright">
                <a  href="" class="list-group-item list-group-item-action dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Distritos
                </a>
                <div class="dropdown-menu" x-placement="right-start" style="position: absolute; transform: translate3d(111px, 0px, 0px); top: 0px; left: 0px; will-change: transform;">
                    <a class="dropdown-item" href="{{route('admin.distritos.list')}}">Listar</a>
                    <a class="dropdown-item" href="{{route('admin.distritos.new')}}">Agregar</a>
                </div>
            </div>

            <a href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();"  class="list-group-item list-group-item-action text-danger"><strong>Salir</strong></a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>

        </div>
    </div>
