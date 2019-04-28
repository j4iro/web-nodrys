<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ClientByDistrictExport implements FromCollection ,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'Distrito',
            'Id',
            'Nombre',
            'Apellido',
            'Email',
            'Celular',
            'Dirección',
            'Puntos',
            'F. Ingreso'
        ];
    }

    public function collection()
    {
        $clientes = User::join('districts','districts.id','=','users.district_id')
        ->select('districts.name as distrito','users.id','users.name','users.surname','users.email','users.telephone','users.address','users.points','users.created_at')
        ->where('users.name','<>','user')
        ->where('users.name','<>','admin')
        ->get();

        return $clientes;
    }
}
?>
