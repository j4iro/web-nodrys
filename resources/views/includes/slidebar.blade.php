<div class="col-2">
        <div class="list-group border border-info rounded shadow-sm">
            <a href="{{route('adminRestaurant.plato.list')}}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center ">
                Mis Platos 
                <span class="badge badge-primary badge-pill ml-auto">14</span>
            </a>
            <a href="{{route('adminRestaurant.plato.new')}}" class="list-group-item list-group-item-action ">
                Nuevo Plato
            </a>
            <a href="{{route('adminRestaurant.index')}}" class="list-group-item list-group-item-action  d-flex justify-content-between align-items-center ">
                Pendientes
                <span class="badge badge-light badge-pill ml-auto">14</span>
            </a>
            <a href="{{route('adminRestaurant.pedidos.completados')}}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                Completados
                <span class="badge badge-primary badge-pill ml-auto">14</span>
            </a>
            <a href="{{route('adminRestaurant.orders.qr')}}" class="list-group-item list-group-item-action">QR</a>
            <a href="{{route('adminRestaurant.reportes')}}" class="list-group-item list-group-item-action">Reportes</a>
            <a href="{{route('adminRestaurant.datos')}}" class="list-group-item list-group-item-action">Mis Datos</a>
        </div>
    </div>