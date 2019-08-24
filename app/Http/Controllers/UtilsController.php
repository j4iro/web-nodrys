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
            return redirect()->route('carrito.index');
        }
        else
        {
            session(['next'=>'carrito']);
            return redirect('/login');
        }
    }
}
