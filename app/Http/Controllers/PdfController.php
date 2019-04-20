<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant;
use Dompdf\Dompdf;

class PdfController extends Controller
{
    public function crearPDF($datos, $vistaurl, $tipo)
    {
        $data = $datos;
        $date = date('Y-m-d');
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView($vistaurl,compact('data', 'date'));

        switch($tipo)
        {
            case 'ver': return $pdf->stream('reporte');
            case 'descargar': return $pdf->download('reporte.pdf');
        }
    }

    public function reporteRestaurantes($tipo)
    {
        $vistaurl = "reportes-pdf.plantilla";
        $restaurantes = Restaurant::join('districts','districts.id','=','restaurants.district_id')
        ->select('restaurants.*','districts.name as distrito')
        ->get();
        return $this->crearPDF($restaurantes, $vistaurl, $tipo);
    }

}
