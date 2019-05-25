<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dish;
use App\Restaurant;

class AdminRestaurant extends Controller
{
    public function __construct()
    {
       // $this->middleware('auth');
    }

    public function index()
    {
        // $user = \Auth::user();
        // $id = 1;
        // $datos=auth()->user()->id;//id_restaurant
        // $datos=Restaurant::all()->where('user_id','=',$datos)->first();

        // $disponibilidad = $datos->availability;
        // dd($disponibilidad);

        return view('admin-restaurant.index');
    }

    public function reportesClientes()
    {
        return view('admin-restaurant.reportesclientes');
    }

    public function reportesPedidos()
    {
        return view('admin-restaurant.reportespedidos');
    }

    public function datos()
    {
        $id = session('id_restaurante');
        $datos = Restaurant::join('users','users.id','=','restaurants.user_id')
        ->select('restaurants.*','users.email as email_acceso')
        ->where('restaurants.id',$id)
        ->first();
        return view('admin-restaurant.datos',["datos"=>$datos]);
    }

    public function update(Request $request)
    {
        //Conseguir restaurante identificado
        $user = \Auth::user();
        $datos=auth()->user()->id;//id_restaurant
        $datos=Restaurant::all()->where('user_id','=',$datos);

        return view('admin-restaurant.datos',compact('datos'));
    }

    public function cambiarDisponibilidad()
    {
         //Conseguir restaurante identificado
         $user = \Auth::user();
         $datos=auth()->user()->id;//id_restaurant
         $datos=Restaurant::all()->where('user_id','=',$datos)->first();

         if($datos->availability == 0)
         {
            $datos->availability=1;
         }
         else
         {
            $datos->availability=0;
         }
         $datos->update();
         $estado_restau = $datos->availability;
         echo $estado_restau;

    }

    public function reportes()
    {
        return view('admin-restaurant.reportes-rapidos');
    }
    // C:\xampp\htdocs\tesis\app\Http\Controllers\AdminRestaurant.php

}
