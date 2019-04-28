<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant;
use Dompdf\Dompdf;
use App\User;
use App\Order;
use App\Dish;

class PdfController extends Controller
{
    public function crearPDF($datos, $vistaurl, $tipo, $nombrePDF,$otroDato = null)
    {
        $data = $datos;
        $data2 = $otroDato;
        $date = date('Y-m-d');
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView($vistaurl,compact('data', 'date','data2'));

        switch($tipo)
        {
            case 'ver': return $pdf->stream($nombrePDF);
            case 'descargar': return $pdf->download($nombrePDF.'.pdf');
        }
    }

    public function reporteRestaurantes($tipo)
    {
        $nombrePDF = 'reporte_restaurantes_registrados';
        $vistaurl = "reportes-pdf.restaurantes";
        $restaurantes = Restaurant::join('districts','districts.id','=','restaurants.district_id')
        ->select('restaurants.*','districts.name as distrito')
        ->get();
        return $this->crearPDF($restaurantes, $vistaurl, $tipo,$nombrePDF);
    }

    public function reporteClientes($tipo)
    {
        $nombrePDF = 'reporte_clientes_registrados';
        $vistaurl = "reportes-pdf.clientes";
        $clientes = User::join('districts','districts.id','=','users.district_id')
        ->select('users.*','districts.name as distrito')
        ->where('users.name','<>','user')
        ->where('users.name','<>','admin')
        ->get();

        return $this->crearPDF($clientes, $vistaurl, $tipo,$nombrePDF);
    }

    public function reportePedidosCompletadosRestaurante($tipo)
    {
        $id_restaurant = session('id_restaurante');
        $nombrePDF = 'historial_peidos_completados';
        $vistaurl = "reportes-pdf.pedidos-completados";
        $clientes_pedidos = Order::join('users','users.id','=','orders.user_id')
        ->join('districts','districts.id','=','users.district_id')
        ->select('orders.*','users.name as username','users.surname as usersurname', 'districts.name as distrito')
        ->where('users.name','<>','user')
        ->where('users.name','<>','admin')
        ->where('orders.state','=','completado')
        ->where('orders.restaurant_id','=',$id_restaurant)
        ->get();
        return $this->crearPDF($clientes_pedidos, $vistaurl, $tipo,$nombrePDF);
    }

    public function reportePedidosPendientesRestaurante($tipo)
    {
        $id_restaurant = session('id_restaurante');
        $nombrePDF = 'historial_pedidos_pendientes';
        $vistaurl = "reportes-pdf.pedidos-pendientes";
        $clientes_pedidos = Order::join('users','users.id','=','orders.user_id')
        ->join('districts','districts.id','=','users.district_id')
        ->select('orders.*','users.name as username','users.surname as usersurname', 'districts.name as distrito')
        ->where('users.name','<>','user')
        ->where('users.name','<>','admin')
        ->where('orders.state','=','pendiente')
        ->where('orders.restaurant_id','=',$id_restaurant)
        ->get();
        return $this->crearPDF($clientes_pedidos, $vistaurl, $tipo,$nombrePDF);
    }

    public function reporteRestaurantesPorDistrito($tipo)
    {
        $nombrePDF = 'reporte_restaurantes_por_distrito';
        $vistaurl = "reportes-pdf.restaurantes_por_distrito";
        $restaurantes = Restaurant::join('districts','districts.id','=','restaurants.district_id')
        ->select('districts.name as distrito','restaurants.*')
        ->orderBy('districts.name','ASC')
        ->get();

        $cantidades = Restaurant::join('districts','districts.id','=','restaurants.district_id')
        ->selectRaw('districts.name as distrito, count(districts.name) as total')
        ->groupBy('districts.name')
        ->get();

        return $this->crearPDF($restaurantes, $vistaurl, $tipo,$nombrePDF, $cantidades);
    }

    public function reportePlatosdeRestaurantes($tipo)
    {
        $nombrePDF = 'reportes_mis_platos';
        $vistaurl = "reportes-pdf.platos_de_restaurante";
        $restaurantes = Dish::join('categories','categories.id','=','dishes.category_dish')
        ->select('dishes.*','categories.name as categoria')
        ->get();
        return $this->crearPDF($restaurantes, $vistaurl, $tipo,$nombrePDF);
    }

    public function reporteRestaurantesPorCategoria($tipo)
    {
        $nombrePDF = 'reporte_restaurantes_por_categoria';
        $vistaurl = "reportes-pdf.restaurantes_por_categoria";

        $restaurantes = Restaurant::join('categories','categories.id','=','restaurants.category_id')
        ->select('categories.name as categoria','restaurants.*')
        ->orderBy('categories.name','ASC')
        ->get();

        $cantidades = Restaurant::join('categories','categories.id','=','restaurants.category_id')
        ->selectRaw('categories.name as categoria, count(restaurants.name) as total')
        ->groupBy('categories.name')
        ->get();

        // dd($restaurantes);
        return $this->crearPDF($restaurantes, $vistaurl, $tipo,$nombrePDF, $cantidades);
    }

    public function reporteClientesPorDistrito($tipo){
        $nombrePDF = 'reporte_clientes_por_distrito';
        $vistaurl = "reportes-pdf.clientes_por_distrito";

        $clientes = User::join('districts','districts.id','=','users.district_id')
        ->select('users.*','districts.name as distrito')
        ->where('users.name','<>','user')
        ->where('users.name','<>','admin')
        ->get();

        $cantidades = User::join('districts','districts.id','=','users.district_id')
        ->selectRaw('districts.name as distrito, count(districts.name) as total')
        ->where('users.name','<>','user')
        ->where('users.name','<>','admin')
        ->groupBy('districts.name')
        ->get();

        return $this->crearPDF($clientes, $vistaurl, $tipo,$nombrePDF, $cantidades);
    }

}
