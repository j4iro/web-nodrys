<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\DetailOrder;
use App\Card;
use App\Util;
use App\Restaurant;
use App\User;
use App\Valoration;
use Auth;
class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function disponibilidad(){
        $user = \Auth::user();
        $datos=auth()->user()->id;//id_restaurant
        $datos=Restaurant::all()->where('user_id','=',$datos)->first();
        $disponibilidad = $datos->availability;
        return $disponibilidad;
    }

private function getOrders(){
    //Traigo los pedidos del restaurante identificado
    //Conseguir restaurante identificado
    $id = session('id_user');
    $datos = Restaurant::all()->where('user_id',$id)->first();
    session(['id_restaurante'=>$datos->id]);
    session(['nombre_restaurante'=>$datos->name]);
    $id_restaurant =session('id_restaurante');


    $orders = Order::join('users','users.id','=','orders.user_id')
    ->select('users.image','users.name','users.surname','users.telephone','orders.date','orders.hour','orders.oca_special','orders.n_people','orders.total','orders.state','orders.id','orders.restaurant_id')
    ->where('orders.restaurant_id',$id_restaurant)
    ->where('orders.state','pendiente')
    ->get();

// dd($orders->toArray());

    return $orders;
}
public function pagar_por_mes(){
        $user_id = Auth::user()->id;//id_user
         $restaurant_id = session('id_restaurante');//id_restaurant
        //echo "hli".$restaurant_id;

    $debeComision=Order::join('restaurants','restaurants.id','=','orders.restaurant_id')
    ->selectRaw('COUNT(*) as totalComision')
    ->where('orders.state','confirmada')
    ->where('orders.comision','<>',1)
    ->where('restaurants.id','=',$restaurant_id)
    ->get();
    
    return $debeComision[0]->totalComision;
}
public function index_r()
{
        $time=null;
        $orders=$this->getOrders();
        if(count($orders->toArray())>0){
            $id_restaurant=$orders->first()->restaurant_id;
            // dd($id_restaurant);
        
            $restaurante=Restaurant::where("id","=",$id_restaurant)->first();
            $time=$restaurante->time;
        }

        // dd($orders->first()->toArray());
      

        session(['estado_restaurant'=>$this->disponibilidad(),
                    'ventana'=>"inicio",
                    'tolerancia'=>$time,
                    'debePagar'=>$this->pagar_por_mes()]
                    );

        return view('admin-restaurant.index',[
            "pedidos" => $orders,
            "disponibilidad" =>$this->disponibilidad()
        ]);
}
    public function notif(){
        header('Content-Type: text/event-stream');
        header('Cache-Control: no-cache');

        //$time = date('r');
        // echo "data: The server time is, otro\n\n";
        $orders=$this->getOrders();
        $ordenes=array();
        $array=$orders->toArray();
        foreach ($array as $reserva) {

            array_push($ordenes,implode(",",$reserva));
        }
        // $cadena=implode ( ";" , $array );
        $cadena=implode(";",$ordenes);

        echo "data: {$cadena}\n\n";
        flush();

    }
    public function pedidos_completados()
    {
        session(['ventana'=>"otra"]);
        $id_restaurant =session('id_restaurante');
        //Traigo los pedidos del restaurante identificado
        $orders = Order::join('users','users.id','=','orders.user_id')
        ->select('users.image','users.name','users.surname','users.telephone','orders.date','orders.hour','orders.oca_special','orders.n_people','orders.total','orders.state','orders.id')
        ->where('orders.restaurant_id',$id_restaurant)
        ->where('orders.state','confirmada')
        ->get();
       //  dd(User::all());
       // dd($orders->toArray());

        return view('admin-restaurant.pedidos-completados',[
            "pedidos"=>$orders,
            "disponibilidad" =>$this->disponibilidad()
            ]);
    }

    public function qr()
    {
        session(['ventana'=>"otra"]);
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
        ->join('categories_dishes','categories_dishes.id','=','dishes.category_dish')
        ->select('details_orders.dish_id','dishes.name','dishes.image','dishes.price','details_orders.cant','dishes.category_dish','categories_dishes.name as type')
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

        ->select('details_orders.dish_id','dishes.name','dishes.image','dishes.price','details_orders.cant','dishes.category_dish')
        ->where('details_orders.order_id',$id)
        ->get();

        return view('pedidos.detail_r',[
            'pedidos' => $details
        ]);

    }

    public function confirmation(Request $request){

      

        $cadena=$request->get('orderData');
        $trozos = explode(",", $cadena);
        
        // dd($trozos[0]);
        
        $orden=Order::findOrFail($trozos[0]);
        $user_id=$orden->toArray()["user_id"];
        $cliente=User::where("id","=",$user_id)->first();

        $restaurante=Restaurant::findOrFail($orden->toArray()["restaurant_id"])->toArray();

        
        $cliente->points+=$restaurante["points"];
        $cliente->save();

        $order=Order::where('id','=',$trozos[0])->first();


        //si existe
        if (count((array)$order)>=1) {
            $order->state='confirmada';
            $order->save();

            $cadena=implode(",",$order->toArray());
            
            // return redirect('admin/restaurant/escanear-qr')->with('order',$order);
            echo $cadena;
        }
       
    }

    public function cancelar(Request $request)
    {
        $this->cancela_orden($request->input('cod_reserva'),"cancela");
        return redirect()->route('pedidos.index')->with('respuesta','La reserva ha sido cancelada');
    }
    public function vence_orden(Request $request){
        $this->cancela_orden($request->input('cod_reserva'));
    }

    public function cancela_orden($id,$accion="otra")
    {
        $order = Order::where('id','=',$id)->first();

        if ($accion=="cancela") {
            $order->state = 'cancelada';
            $order->update();

        }else {
            $order->state = 'vencida';
            $order->update();
            echo "OK";
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

        $pagar_con_tarjeta = $request->input('pagarcontarjeta');

        $order = new Order();

        if(isset($pagar_con_tarjeta))
        {
            $order->paid = "si";

            //Aqui falta verificar si la tarjeta existe, si ya existe que ya no se inserte
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
               $card->save();
            }
        }
        else
        {
            $order->paid = "no";
        }

        $stats = Util::statsCarrito();

        //Datos del pedido
        $order->restaurant_id = $stats['restaurant_id'];
        $order->user_id = $id_user;
        $order->date =  $request->input('fecha');
        $order->hour = $request->input('hora');
        $order->n_people = $request->input('n_people');
        $order->oca_special = $request->input('oca_special');
        $order->state = 'pendiente';
        $order->total = $stats['total'];


        $order->save();

        //Sacar el ID del último pedido ingresado
        $last_id_insertado = $order->id;
        //echo "Último ID insertado" . $last_id_insertado;

        //Recorrer todos los productos del carrito e insertarlos al detalle
        foreach ($_SESSION['carrito'] as $elemento)
        {
            $detail_order = new DetailOrder();
            $producto = $elemento['plato'];

            $detail_order->order_id = $last_id_insertado;
            $detail_order->dish_id = $producto->id;
            $detail_order->cant = $elemento['unidades'];

            $detail_order->save();
            // var_dump($producto->id);
        }

        unset($_SESSION['carrito']);
        return redirect()->route('pedidos.index')->with('result','Pedido Registrado Correctamente');
    }
}
