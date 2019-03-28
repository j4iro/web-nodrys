<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dish;
use App\Restaurant;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class DishController extends Controller
{
    public function dishes(Request $request)
    {
        $dishes = Dish::where('restaurant_id', $request->id)
                ->get();
        
       $restaurant = Restaurant::select('name')->where('id', $request->id)
        ->get();

        return view('dish.index',[
            'dishes' => $dishes,
            'restaurant'=>$restaurant
        ]);
    }

    public function getImage($filename)
    {
        $file = Storage::disk('dishes')->get($filename);
        return new Response($file,200);
    }
}
