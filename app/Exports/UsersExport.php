<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection ,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'Id',
            'Nombre',
            'Apellido',
            'Email',
            'Celular',
            'Dirección',
            'Puntos',
            'F. Ingreso',
            'Distrito',
        ];
    }

    public function collection()
    {
        $clientes = User::join('districts','districts.id','=','users.district_id')
        ->select('users.id','users.name','users.surname','users.email','users.telephone','users.address','users.points','users.created_at','districts.name as distrito')
        ->where('users.name','<>','user')
        ->where('users.name','<>','admin')
        ->get();

        return $clientes;
    }
}
?>
