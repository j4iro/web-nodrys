<?php

namespace App\Exports;

use App\Restaurant;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RestaurantByDistrictExport implements FromCollection ,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'Distrito',
            'Nombre',
            'Dirección',
            'Ingreso'
        ];
    }

    public function collection()
    {

        $restaurantes = Restaurant::join('districts','districts.id','=','restaurants.district_id')
        ->select('districts.name as distrito','restaurants.name','restaurants.address','restaurants.created_at')
        ->orderBy('districts.name','ASC')
        ->get();

        return $restaurantes;
    }
}
?>
