{{-- SLIDEBAR PARA LA SECCIÓN ADMIN --}}
<div class="col-2">
        <div class="list-group border border-info rounded shadow-sm">

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
                    <a href="{{route('adminRestaurant.index')}}" class="dropdown-item">
                        Pendientes
                        <span class="badge badge-primary badge-pill ml-auto">14</span>
                    </a>
                    <a href="{{route('adminRestaurant.pedidos.completados')}}" class="dropdown-item">
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
                    <a class="dropdown-item" href="{{route('admin.reportes')}}">Rápidos</a>
                    <a class="dropdown-item" href="{{route('adminRestaurant.reportesclientes')}}">Clientes</a>
                    <a class="dropdown-item" href="{{route('adminRestaurant.reportespedidos')}}">Pedidos</a>
                </div>
            </div>

            <a href="{{route('adminRestaurant.datos')}}" class="list-group-item list-group-item-action">Categorias</a>
        </div>
    </div>