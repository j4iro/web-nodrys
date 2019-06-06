<?php

namespace App\Exports;

use App\Dish;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DishesExport implements FromCollection ,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'Id',
            'Plato',
            'Precio',
            'Tiempo',
            'Fecha Creación',
            'Categoria',
        ];
    }

    public function collection()
    {
        $platos = Dish::join('categories_dishes','categories_dishes.id','=','dishes.category_dish')
        ->select('dishes.id','dishes.name','dishes.price','dishes.time','dishes.created_at','categories_dishes.name as categoria')
        ->where('dishes.name','<>','reserva')
        ->where('dishes.restaurant_id','=',\session('id_restaurante'))
        ->get();

        return $platos;
    }
}
?>
