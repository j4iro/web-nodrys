<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use App\Restaurant;
use App\Category;
use App\District;

class RestaurantController extends Controller
{

    public function getImage($filename)
    {
        $file = Storage::disk('restaurants')->get($filename);
        return new Response($file,200);
    }

    public function buscar(Request $request)
    {
        $restaurants = Restaurant::join('categories','categories.id','=','restaurants.category_id')->where('restaurants.name',$request->name)
        ->orWhere('restaurants.name','like','%'.$request->name.'%')
        ->select('restaurants.name','restaurants.address','restaurants.image','restaurants.id','restaurants.latitude','restaurants.longitude','categories.name as categoria')
        ->get();

        $mje = 'Se muestran '.count($restaurants). ' resultados de "' .  $request->name . '".';

        $categorias = Category::all();
        $distritos = District::all();

        return view('home',[
            'restaurants' => $restaurants,
            'resultado' => $mje,
            'categorias' => $categorias,
            'distritos' => $distritos
        ]);
    }
/*
    public function filtro(Request $request)
    {


        if(isset($request->categoria))
        {
            $restaurants = Restaurant::join('categories','categories.id','=','restaurants.category_id')
            ->select('restaurants.name','restaurants.address','restaurants.image','restaurants.id','restaurants.latitude','restaurants.longitude','categories.name as categoria')
            ->where('restaurants.category_id',$request->categoria)
            ->get();
        }
        if(isset($request->distrito))
        {
            $restaurants = Restaurant::join('categories','categories.id','=','restaurants.category_id')
            ->select('restaurants.name','restaurants.address','restaurants.image','restaurants.id','restaurants.latitude','restaurants.longitude','categories.name as categoria')
            ->where('restaurants.district_id',$request->distrito)
            ->get();
        }
        if(isset($request->distrito))
        {
            $restaurants = Restaurant::join('categories','categories.id','=','restaurants.category_id')
            ->select('restaurants.name','restaurants.address','restaurants.image','restaurants.id','restaurants.latitude','restaurants.longitude','categories.name as categoria')
            ->where('restaurants.district_id',$request->distrito)
            ->where('restaurants.category_id',$request->categoria)
            ->get();
        }

        $categorias = Category::all();
        $distritos = District::all();

        return view('home',[
            'restaurants' => $restaurants,
            'categorias' => $categorias,
            'distritos' => $distritos
        ]);
    }
*/

    public function filtroXcategoria($categoria){

      if($categoria)
        {
            $restaurants = Restaurant::join('categories','categories.id','=','restaurants.category_id')
            ->select('restaurants.name','restaurants.address','restaurants.image','restaurants.id','categories.name as categoria')
            ->where('restaurants.category_id',$categoria)
            ->get();
        }

        $categorias = Category::all();
        $distritos = District::all();

        //  dd($restaurants);

        return view('filtroXcategoria',[
            'restaurants' => $restaurants,
            'categorias' => $categorias,
            'distritos' => $distritos
        ]);


    }
}
