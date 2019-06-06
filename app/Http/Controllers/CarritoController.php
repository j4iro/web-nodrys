<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dish;
use App\User;
use App\Util;

class CarritoController extends Controller
{
    public function index()
    {


        $carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : array();
        return view('carrito.index',[
            'carrito' => $carrito
        ]);
    }

    public function auth()
    {
        Util::auth();
    }

    public function verificar_restaurante_diferente($id_restaurant)
    {

      $restaurant_id=isset($_SESSION['carrito'])?$_SESSION['carrito']:"0";
      $id_restaurante_comparar=0;

        if ($restaurant_id!="0") {
          foreach ($restaurant_id as $id => $value) {
             if($value['restaurante_id']!=$id_restaurant){
               return false;
             }else{
               // dd('ss');
             }

           }

        }

        return true;
    }
    public function add(Request $request)
    {

        $solo_reserva = $request->input('solo_reserva');
        if(isset($solo_reserva))
        {
            unset($_SESSION['carrito']);
        }

        if (isset($request->checkDish) && count($request->checkDish)>0)
        {
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
                    $dish = Dish::join('restaurants','restaurants.id','=','dishes.restaurant_id')
                    ->join('categories_dishes','categories_dishes.id','=','dishes.category_dish')
                    ->select('dishes.*','categories_dishes.name as categoria_plato','restaurants.name as restaurante', 'restaurants.id as restaurante_id')
                    ->where('dishes.id',$id_plato)->first();

                    if($this->verificar_restaurante_diferente($dish->restaurante_id)==false){
                            return back();
                    };


                    if (is_object($dish)) {

                        $_SESSION['carrito'][] = array(
                            "id_plato" => $dish->id,
                            "restaurante" => $dish->restaurante,
                            "restaurante_id" => $dish->restaurante_id,
                            "precio" => $dish->price,
                            "unidades" => 1,
                            "plato" => $dish
                        );
                    }

                }
            }

            return redirect()->route('carrito.index');
        }
        else
        {
            return back()->with('vacio','Seleccione al menos un plato para continuar');
        }
    }

    public function up($indice)
    {
        $_SESSION['carrito'][$indice]['unidades']++;
        return redirect()->route('carrito.index');
    }

    public function down($indice)
    {
        $_SESSION['carrito'][$indice]['unidades']--;
        if($_SESSION['carrito'][$indice]['unidades']==0)
        {
            unset($_SESSION['carrito'][$indice]);
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

    public function delete_all_and_add_reseva()
    {
        unset($_SESSION['carrito']);
        return redirect()->route('carrito.index');
    }
}
