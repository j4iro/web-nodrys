<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\UsersExport;
use App\Exports\RestaurantsExport;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function reporteUsers()
    {
        return Excel::download(new UsersExport, 'usuarios.xlsx');
    }

    public function reporteRestaurants()
    {
        return Excel::download(new RestaurantsExport, 'restaurantes.xlsx');
    }
}