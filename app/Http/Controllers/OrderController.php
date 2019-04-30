<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\DetailOrder;
use App\Card;
use App\Util;
use App\Restaurant;
use App\User;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index_r()
    {
        //Traigo los pedidos del restaurante identificado
        //Conseguir restaurante identificado
        $id = session('id_user');
        $datos = Restaurant::all()->where('user_id',$id)->first();
        session(['id_restaurante'=>$datos->id]);
        session(['nombre_restaurante'=>$datos->name]);
        $id_restaurant =session('id_restaurante');

        $orders = Order::join('users','users.id','=','orders.user_id')
        ->select('users.image','users.name','users.surname','users.telephone','orders.date','orders.hour','orders.oca_special','orders.n_people','orders.total','orders.state','orders.id')
        ->where('orders.restaurant_id',$id_restaurant)
        ->where('orders.state','pendiente')
        ->get();

        return view('admin-restaurant.index',[
            "pedidos" => $orders
        ]);
    }

    public function pedidos_completados()
    {
        //Traigo los pedidos del restaurante identificado
        $orders = Order::join('users','users.id','=','orders.user_id')
        ->select('users.image','users.name','users.surname','users.telephone','orders.date','orders.hour','orders.oca_special','orders.n_people','orders.total','orders.state','orders.id')
        ->where('orders.restaurant_id',auth()->user()->id)
        ->where('orders.state','confirmada')
        ->get();
       //  dd(User::all());
       // dd($orders->toArray());
        return view('admin-restaurant.pedidos-completados',["pedidos"=>$orders]);
    }

    public function qr()
    {
        return view ('admin-restaurant.confirmation');
    }

    public function index_c(Request $request)
    {
        //Conseguir usuario identificado
        $user = \Auth::user();
        $id_user = $user->id;

        //Traigo los pedidos del usuario identificado
        $orders = Order::join('restaurants','restaurants.id','=','orders.restaurant_id')
        ->select('restaurants.image','restaurants.name','orders.created_at','orders.oca_special','orders.n_people','orders.total','orders.state','orders.id')
        ->where('orders.user_id',$id_user)
        ->orderBy('orders.state', 'DESC')
        ->get();

        return view('pedidos.index',[
            'pedidos' => $orders
        ]);
    }

    public function detail_c($id)
    {
        //Traigo los detalles del pedido que llega
        $details = DetailOrder::join('dishes','dishes.id','=','details_orders.dish_id')
        ->select('details_orders.dish_id','dishes.name','dishes.image','dishes.price','dishes.category_dish')
        ->where('details_orders.order_id',$id)
        ->get();

        return view('pedidos.detail_c',[
            'pedidos' => $details
        ]);
    }

    public function detail_r($id)
    {
        //Traigo los detalles del pedido que llega
        $details = DetailOrder::join('dishes','dishes.id','=','details_orders.dish_id')
        ->select('details_orders.dish_id','dishes.name','dishes.image','dishes.price','dishes.category_dish')
        ->where('details_orders.order_id',$id)
        ->get();

        return view('pedidos.detail_r',[
            'pedidos' => $details
        ]);
    }

    public function confirmation(Request $request){
        $cadena=$request->get('txtCode');
        $trozos = explode(",", $cadena);
        $order=Order::where('id','=',$trozos[0])->first();

        //si existe
        if (count((array)$order)>=1) {
            $order->state='confirmada';
            $order->save();
            return redirect('admin/restaurant/escanear-qr')->with('order',$order);
        }else {
            //datos invalidos
            //dd($cadena);
            // dd('Esta reserva no existe');
            return redirect('admin/restaurant/escanear-qr')->with('error','Esta reserva no existe');
        }


    }

    public function add(Request $request)
    {
        // die();
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

        $stats = Util::statsCarrito();
       
        //Datos del pedido
        $order = new Order();
        $order->restaurant_id = $stats['restaurant_id'];
        $order->user_id = $id_user;
        $order->date =  $fecha_actual;
        $order->hour = $hora_actual;
        $order->n_people = $request->input('n_people');
        $order->oca_special = $request->input('oca_special');

        //Ver si hay codigo de promoción
        // $order->cod_promo = null;
        $order->state = 'pendiente';
        $order->total = $stats['total'];

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

        unset($_SESSION['carrito']);
        return redirect()->route('pedidos.index')->with('result','Pedido Registrado Correctamente');
    }
}
