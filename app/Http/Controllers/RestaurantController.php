<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use App\Restaurant;

class RestaurantController extends Controller
{

    public function getImage($filename)
    {
        $file = Storage::disk('restaurants')->get($filename);
        return new Response($file,200);
    }

    public function buscar(Request $request)
    {
        $restaurants = Restaurant::where('name',$request->name)
        ->orWhere('name','like','%'.$request->name.'%')->get();

        $mje = 'Se muestran '.count($restaurants). ' resultados de "' .  $request->name . '".';

        return view('home',[
            'restaurants' => $restaurants,
            'resultado' => $mje
        ]);
    }

}
