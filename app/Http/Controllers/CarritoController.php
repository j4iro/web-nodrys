<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dish;

class CarritoController extends Controller
{
    public function index()
    {
        $carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : array();
        return view('carrito.index',[
            'carrito' => $carrito
        ]);
    }

    public function add(Request $request)
    {
        // var_dump($_POST);
        if(isset($_SESSION['carrito']))
        {
            $counter = 0;
            for ($i=0; $i < count($request->checkDish); $i++)
            {
                $id_plato = $request->checkDish[$i];
                foreach($_SESSION['carrito'] as $indice=>$elemento)
                {
                    if ($elemento['id_plato']==$id_plato) {
                        $_SESSION['carrito'][$indice]['unidades']++;
                        $counter++;
                    }
                }
            }
        }

        if (!isset($counter) || $counter==0) 
        {
            for ($i=0; $i < count($request->checkDish); $i++)
            {
                $id_plato = $request->checkDish[$i];

                //Conseguir Datos del plato
                $dish = Dish::where('id',$id_plato)->first();

                //Añadir al carrito
                if (is_object($dish)) {
                    $_SESSION['carrito'][] = array(
                        "id_plato" => $dish->id,
                        "unidades" => 1,
                        "plato" => $dish
                    );
                }
            }
        }

        return redirect()->route('carrito.index');
    }

    public function delete_one($indice)
    {
        unset($_SESSION['carrito'][$indice]);
        return redirect()->route('carrito.index');
    }

    public function delete_all()
    {
        unset($_SESSION['carrito']);
        return redirect()->route('carrito.index');
    }
}
