<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\DetailOrder;
use App\Card;

class OrderController extends Controller
{
    public function index_r()
    {
        $orders = Order::where('restaurant_id',1)->get();
        return view('pedidos.index_r');
    }

    public function index_c(Request $request)
    {
        //Conseguir usuario identificado
        $user = \Auth::user();
        $id_user = $user->id;

        //Traigo los pedidos del usuario identificado
        $orders = Order::where('user_id',$id_user)->get();

        return view('pedidos.index',[
            'pedidos' => $orders
        ]);
    }

    public function detail($id)
    {

    }

    public function add(Request $request)
    {
        date_default_timezone_set('America/Lima');
        $now = new \Carbon\Carbon();

        //Fecha y hora actual para 
        $fecha_actual = $now->format('Y-m-d');
        $hora_actual = $now->format('H:i:s');

        //Conseguir usuario identificado
        $user = \Auth::user();
        $id_user = $user->id;

        $card = new Card();
        $card->num_card = $request->input('num_card');
        $card->user_id = $id_user;
        $card->month = $request->input('month');
        $card->year = $request->input('year');
        $card->cvc = $request->input('cvc');
        $card->owner = $request->input('owner');
        $card->country = $request->input('country');
        $card->cod_postal = $request->input('cod_postal');

        $r = $request->input('recordarTarjeta');
        $recordar_tarjeta = isset($r) ? 'on' : 'off';

        if ($recordar_tarjeta=='on') 
        {
            //Guardar los datos de la tarjeta en la base de datos
            $card->save();
            // dd($card);
        }

        //Datos del pedido
        $order = new Order();
        $order->restaurant_id = 1;
        $order->user_id = $id_user;
        $order->date =  $fecha_actual;
        $order->hour = $hora_actual;
        $order->n_people = $request->input('n_people');
        $order->oca_special = $request->input('oca_special');

        //Ver si hay codigo de promoción
        // $order->cod_promo = null;
        $order->state = 'pendiente';
        $order->total = '45.3';

        $order->save();

        //Sacar el ID del último pedido ingresado
        $last_id_insertado = $order->id;
        echo "Último ID insertado" . $last_id_insertado;

        //Recorrer todos los productos del carrito e insertarlos al detalle
        foreach ($_SESSION['carrito'] as $elemento)
        {
            $detail_order = new DetailOrder();
            $producto = $elemento['plato'];

            $detail_order->order_id = $last_id_insertado;
            $detail_order->dish_id = $producto->id;
            $detail_order->save();
            // var_dump($producto->id);
        }

        // die();
        unset($_SESSION['carrito']);
        return redirect()->route('pedidos.index')->with('result','Pedido Registrado Correctamente');

    }
}
