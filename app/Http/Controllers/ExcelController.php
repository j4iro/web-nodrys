<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\UsersExport;
use App\Exports\RestaurantsExport;
use App\Exports\RestaurantByDistrictExport;
use App\Exports\RestaurantByCategoryExport;
use App\Exports\ClientByDistrictExport;
use App\Exports\OrderByStateExport1;
use App\Exports\OrderByStateExport2;
use App\Exports\DishesExport;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function reporteUsers()
    {
        return Excel::download(new UsersExport, 'clientes_registrados.xlsx');
    }

    public function reporteRestaurants()
    {
        return Excel::download(new RestaurantsExport, 'restaurantes_registrados.xlsx');
    }

    public function reporteRestaurantesPorDistrito()
    {
        return Excel::download(new RestaurantByDistrictExport, 'restaurantes_por_distrito.xlsx');
    }

    public function reporteRestaurantesPorCategoria()
    {
        return Excel::download(new RestaurantByCategoryExport, 'restaurantes_por_categoria.xlsx');
    }

    public function reporteClientesPorDistrito()
    {
        return Excel::download(new ClientByDistrictExport, 'clientes_por_distrito.xlsx');
    }

    public function reportePedidosC()
    {
        return Excel::download(new OrderByStateExport1, 'pedidos_completados.xlsx');
    }

    public function reportePedidosP()
    {
        return Excel::download(new OrderByStateExport2, 'pedidos_pendientes.xlsx');
    }

    public function reportePlatos()
    {
        return Excel::download(new DishesExport, 'reporte_platos.xlsx');
    }
}
