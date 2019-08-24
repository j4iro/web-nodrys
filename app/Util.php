<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Util extends Model
{
    public static function statsCarrito()
    {
        $stats = array(
            'count' => 0,
            'total' => 0,
            'restaurant_id' => 0,
         );

        if (isset($_SESSION['carrito'])) 
        {
            $stats['count'] = count($_SESSION['carrito']);
            

            foreach ($_SESSION['carrito'] as $producto) {
                $stats['total'] += $producto['precio'] * $producto['unidades'];
                $stats['restaurant_id'] = $producto['restaurante_id'];
            }
        }

        return $stats;
    }

    public static function auth()
    {
        $logeado = \Auth::user() ? true : false;

        if ($logeado) 
        {
            return redirect()->route('carrito.index')->with('mostrarform',true);
        }
        else
        {
            return redirect('/login'); 
        }
    }
}
