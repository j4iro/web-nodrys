<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dish;

class AdminRestaurant extends Controller
{
    public function index()
    {
        return view('admin-restaurant.index');
    }
}
