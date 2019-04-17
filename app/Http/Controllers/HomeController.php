<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant;
use App\Dish;
use App\Category;
use App\District;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $restaurants = Restaurant::join('categories','categories.id','=','restaurants.category_id')
        ->join('districts','districts.id','=','restaurants.district_id')
        ->select('restaurants.name','restaurants.address','restaurants.image','restaurants.id','categories.name as categoria', 'districts.name as distrito')
        ->get();

        $categorias = Category::all();
        $distritos = District::all();

        //  dd($restaurants);

        return view('home',[
            'restaurants' => $restaurants,
            'categorias' => $categorias,
            'distritos' => $distritos
        ]);
    }

    public function getDishOne(Request $request)
    {
        $dishes = Dish::join('restaurants','restaurants.id','=','dishes.restaurant_id')
        ->select('dishes.*','restaurants.name as restaurante')
        ->where('dishes.name',$request->name)
        ->orWhere('dishes.name','like','%'.$request->name.'%')
        ->get();

        //dd($dishes);

        $mje = 'Se muestran '.count($dishes). ' resultados de "' .  $request->name . '".';

        return view('dish.getAll',[
            'platos' => $dishes,
            'resultado' => $mje
        ]);
    }

    public function getAllDishes() 
    {
        $platos = Dish::join('restaurants','restaurants.id','=','dishes.restaurant_id')
        ->select('dishes.*','restaurants.name as restaurante')->get();
        //  dd($platos);
        return view('dish.getAll',[
            'platos' => $platos
        ]);
    }
}
