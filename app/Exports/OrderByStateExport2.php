<?php

namespace App\Exports;

use App\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrderByStateExport2 implements FromCollection ,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'Id Orden',
            'Fecha',
            'Hora',
            'Num Personas',
            'Ocasión especial',
            'Estado',
            'Total',
            'Pagada',
            'Fecha Creación',
            'Fecha Actualización',
            'ID Restaurante',
            'ID Usuario',
            'Nombre Cliente',
            'Apellido Cliente',
            'Distrito',
        ];
    }

    public function collection()
    {
        $id_restaurant = session('id_restaurante');
        $pedidos_pendientes = Order::join('users','users.id','=','orders.user_id')
        ->join('districts','districts.id','=','users.district_id')
        ->select('orders.*','users.name','users.surname', 'districts.name as distrito')
        ->where('users.name','<>','user')
        ->where('users.name','<>','admin')
        ->where('orders.state','=','pendiente')
        ->where('orders.restaurant_id','=',$id_restaurant)
        ->get();

        return $pedidos_pendientes;
    }
}
?>
