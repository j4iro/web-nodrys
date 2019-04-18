<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UtilsController extends Controller
{
    public function auth()
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
