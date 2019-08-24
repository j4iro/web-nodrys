<?php

namespace App\Exports;

use App\Restaurant;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RestaurantByCategoryExport implements FromCollection ,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'Categoria',
            'Nombre',
            'Dirección',
            'Ingreso'
        ];
    }

    public function collection()
    {

        $restaurantes = Restaurant::join('categories','categories.id','=','restaurants.category_id')
        ->select('categories.name as categoria','restaurants.name','restaurants.address','restaurants.created_at')
        ->orderBy('categories.name','ASC')
        ->get();

        return $restaurantes;
    }
}
?>
