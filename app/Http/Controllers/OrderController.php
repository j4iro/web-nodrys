<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

class OrderController extends Controller
{
    public function index_r()
    {
        $orders = Order::where('restaurant_id',1)->get();
        // dd($orders);

        return view('pedidos.index_r');
    }
}
