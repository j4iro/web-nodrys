<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dish;
use App\Restaurant;

class AdminRestaurant extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
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
        // $user = \Auth::user();
        $id = 1;

        return view('admin-restaurant.datos');
    }
    public function reportes()
    {
        return view('admin-restaurant.reportes-rapidos');
    }


}
