{{-- SLIDEBAR PARA LA SECCIÓN ADMIN --}}
<ul id="myUL" class="col-12 col-md-3 col-lg-2 mb-3 ">
  <li class="btn-group dropright ">
    <span class="caret list-group-item list-group-item-action dropdown-toggle">Solicitudes</span>
    <ul class="nested dropdown-menu">
        <a href="{{route('admin.index')}}" class="dropdown-item">Nuevas</a>
        <a href="{{route('admin.solicitudes.aceptadas')}}" class="dropdown-item">Aceptadas</a>
        <a href="{{route('admin.solicitudes.historial')}}" class="dropdown-item">Todas</a>
    </ul>
  </li>
  <li class="btn-group dropright ">
      <span class="caret list-group-item list-group-item-action dropdown-toggle">Restaurantes</span>
      <ul class="nested dropdown-menu">
          <a href="{{route('admin.restaurants')}}" class="dropdown-item">
              Listar
              {{-- <span class="badge badge-primary badge-pill ml-auto">14</span> --}}
          </a>
          <a href="{{route('admin.restaurant.new')}}" class="dropdown-item">
              Agregar
          </a>
      </ul>
  </li>
  {{-- <li class="btn-group dropright">
      <span class="caret list-group-item list-group-item-action dropdown-toggle">Pedidos</span>
      <ul class="nested dropdown-menu">
          <a href="" class="dropdown-item">
              Pendientes
              <span class="badge badge-primary badge-pill ml-auto">14</span>
          </a>
          <a href="" class="dropdown-item">
              Completados
              <span class="badge badge-primary badge-pill ml-auto">14</span>
          </a>
      </ul>
  </li> --}}
  <li class="btn-group dropright">
      <span class="caret list-group-item list-group-item-action dropdown-toggle">Reportes</span>
      <ul class="nested dropdown-menu">
          <a class="dropdown-item" href="{{route('admin.reportes')}}">Predeterminados</a>
          <a class="dropdown-item" href="{{route('admin.reportespersonalizados')}}">Pedidos</a>
          <a class="dropdown-item" href="{{route('admin.reportespersonalizados')}}">Clientes</a>
      </ul>
  </li>
  <li class="btn-group dropright">
      <span class="caret list-group-item list-group-item-action dropdown-toggle">Categorias</span>
      <ul class="nested dropdown-menu">
          <a class="dropdown-item" href="{{route('admin.categorias.list')}}">Listar</a>
          <a class="dropdown-item" href="{{route('admin.categorias.create')}}">Agregar</a>
      </ul>
  </li>
  <li class="btn-group dropright">
      <span class="caret list-group-item list-group-item-action dropdown-toggle">Distritos</span>
      <ul class="nested dropdown-menu">
          <a class="dropdown-item" href="{{route('admin.distritos.list')}}">Listar</a>
          <a class="dropdown-item" href="{{route('admin.distritos.new')}}">Agregar</a>
      </ul>

  </li>
  <li class="btn-group dropright">
    <a class="list-group-item list-group-item-action" href="{{route('cashs')}}">Caja</a>
  </li>
  <a href="{{ route('logout') }}" onclick="event.preventDefault();
  document.getElementById('logout-form').submit();"  class="list-group-item list-group-item-action text-danger"><strong>Salir</strong></a>
  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      @csrf
  </form>
</ul>
