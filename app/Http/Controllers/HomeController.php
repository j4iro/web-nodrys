<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant;

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
        ->select('restaurants.name','restaurants.address','restaurants.image','restaurants.id','categories.name as categoria')
        ->get();

        //  dd($restaurants);

        return view('home',[
            'restaurants' => $restaurants
        ]);
    }
}
