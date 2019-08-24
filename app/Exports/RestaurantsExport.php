<?php

namespace App\Exports;

use App\Restaurant;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RestaurantsExport implements FromCollection ,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'Id',
            'Nombre',
            'Eslogan',
            'Dirección',
            'Celular',
            'Puntos',
            'F Ingreso',
            'Distrito',
        ];
    }

    public function collection()
    {
        // return Restaurant::all();
        $restaurantes = Restaurant::join('districts','districts.id','=','restaurants.district_id')
        ->select('restaurants.id','restaurants.name','restaurants.slogan','restaurants.address','restaurants.telephone','restaurants.points','restaurants.created_at','districts.name as distrito')
        ->get();
        return $restaurantes;
    }
}
?>
