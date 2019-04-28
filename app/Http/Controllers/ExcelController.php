<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\UsersExport;
use App\Exports\RestaurantsExport;
use App\Exports\RestaurantByDistrictExport;
use App\Exports\RestaurantByCategoryExport;
use App\Exports\ClientByDistrictExport;
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
}
