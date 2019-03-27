<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class RestaurantController extends Controller
{

    public function getImage($filename)
    {
        $file = Storage::disk('restaurants')->get($filename);
        return new Response($file,200);
    }

}
