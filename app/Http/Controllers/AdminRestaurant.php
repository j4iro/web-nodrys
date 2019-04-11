<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dish;
use App\Restaurant;

class AdminRestaurant extends Controller
{
    public function index()
    {
        return view('admin-restaurant.index');
    }

    public function reportes()
    {
        return view('admin-restaurant.reportes');
    }

    public function datos()
    {
        //Conseguir restaurante identificado
        // $user = \Auth::user();
        $id = 1;
        $datos = Restaurant::all()
        ->where('id',$id)
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
}