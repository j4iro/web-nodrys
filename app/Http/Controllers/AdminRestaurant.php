<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Card;
use App\Order;
use App\Restaurant;
use App\Menu;
use App\Dish;
use App\User;
use Auth;
use DB;
use Hash;


class AdminRestaurant extends Controller
{
    public function __construct()
    {
       // $this->middleware('auth');
    }

    public function index()
    {
        return view('admin-restaurant.index');
    }

    public function menus()
    {
        $id = session('id_restaurante');
        session(['ventana'=>"otra"]);
        return view('admin-restaurant.menus',compact('id'));
    }

    public function reportesPedidos(){
        return view('admin-restaurant.reportespedidos');
    }

    public function saveplatomenu(Request $request)
    {

        $menu = new Menu();
        $menu->dia = $request->dia;
        $menu->dish_id = $request->dish_id;
        $menu->restaurant_id = $request->restaurant_id;

        try {
            $menu->save();
        } catch (\Exception $e) {
            echo $e;
        }

    }
    public function reportesClientes(){
        session(['ventana'=>"otra"]);
        return view('admin-restaurant.reportesclientes');
    }

    public function datos()
    {
      session(['ventana'=>"otra"]);
       $id = session('id_restaurante');

        $datos = Restaurant::join('users','users.id','=','restaurants.user_id')
        ->select('restaurants.*','users.email as email_acceso')
        ->where('restaurants.id',$id)
        ->first();

        return view('admin-restaurant.datos',["datos"=>$datos]);
    }

   //$request=array_slice($request->toArray(), 1,7);
     //    $request["image"]=$new_image_path_name;

    public function update(Request $request)
    {

        $image_path = $request->file('image');
        $request = array_slice($request->toArray(), 1,7);

        if ($image_path)
        {
            //Coloco nombre único
            $new_image_path_name = time().$image_path->getClientOriginalName();
            //Guardo en la carpeta Storage (storage/app/users)
            Storage::disk('restaurants')->put($new_image_path_name, File::get($image_path));
            $request["image"] = $new_image_path_name;
        }

         $user_id = Auth::user()->id;//id_user
         $restaurant_id = session('id_restaurante');//id_restaurant
         User::findOrFail($user_id)->update($request);
         Restaurant::findOrFail($restaurant_id)->update($request);

        return back();

    }

    public function cambiarDisponibilidad()
    {
         //Conseguir restaurante identificado
         $user = \Auth::user();
         $datos=auth()->user()->id;//id_restaurant
         $datos=Restaurant::all()->where('user_id','=',$datos)->first();

         if($datos->availability == 0)
         {
            $datos->availability=1;
            session(['estado_restaurant'=>1]);
         }
         else
         {
            $datos->availability=0;
            session(['estado_restaurant'=>0]);
         }
         $datos->update();
         $estado_restau = $datos->availability;
         echo $estado_restau;
    }

    public function reportes()
    {
        session(['ventana'=>"otra"]);
        return view('admin-restaurant.reportes-rapidos');
    }

    public function newCuentaBancaria()
    {
        $restaurant = \Auth::user();
        $id_restaurante=auth()->user()->id;
        $card = Card::where('user_id','=',$id_restaurante)->first();
        session(['ventana'=>"otra"]);
        return view('admin-restaurant.datos_bancarios',compact('card'));
    }

    public function reportespersonalizados(){
        return view('admin-restaurant.reportespersonalizados');
    }

    public function getDishes(Request $request)
    {
        $restaurant = \Auth::user();
        // $id_restaurante=auth()->user()->id;//esto no captura el id del restaurant
        $id_restaurante=$request->restaurant_id;

        $dishes = Dish::where('restaurant_id','=',$id_restaurante)
                        ->where('state','=',1)
                        ->where('category_dish','<>','5')->get();
        // dd($dishes);

        if(count($dishes)>0)
        {
            echo json_encode($dishes);
        }
        else
        {
            echo json_encode("no");
        }
    }

    public function help()
    {
        session(['ventana'=>"otra"]);
        return view('admin-restaurant.help');
    }

    function getDishForDayAndRestaurant(Request $request){
        $datos=Menu::where('dish_id',$request->idPlato)
        ->where('restaurant_id',$request->idRestaurante)
        ->where('dia',$request->dia)
        ->get();
        if(count($datos)>0){
            echo 'OK';
        }
    }

    public function getMenuDia(Request $request)
    {
        $datos = Menu::join('dishes','dishes.id','=','menus.dish_id')
        ->select('menus.id','dishes.name')
        ->where('menus.dia',$request->dia)
        ->where('menus.restaurant_id',$request->restaurant_id)
        ->get();
        return json_encode($datos);
    }

    public function eliminarMenuDia(Request $request){
        $datos = Menu::where('id',$request->menu_id)
        ->first();
        $datos->delete();
        return "Se elimino";
    }

    public function saveCuentaBancaria(Request $request)
    {

        if($request->input('action')=='guardar')
        {
            $card = new Card();
        }else
        {
            $card = Card::where('id',$request->input('id_card'))->first();
        }

        $restaurant = \Auth::user();
        $id_restaurante=auth()->user()->id;


        $card->num_card = $request->input('num_card');
        $card->cod_postal = $request->input('cod_postal');
        $card->month = '00';
        $card->year = '0000';
        $card->cvc = '000';
        $card->owner = $request->input('owner');
        $card->country = $request->input('country');
        $card->user_id = $id_restaurante;

        if($request->input('action')=='guardar')
        {
            $card->save();
        }
        else
        {
            $card->update();
        }
        session(['ventana'=>"otra"]);
        return redirect()->route('admin-r.cuentaBancaria')
        ->with(['message'=>'message']);
    }

    public function totalComision()
    {
        $user_id = Auth::user()->id;//id_user
        $restaurant_id = session('id_restaurante');//id_restaurant

        // $debeComision=Order::join('restaurants','restaurants.id','=','orders.restaurant_id')
        // ->select(DB::raw('SUM(orders.total) as totalComision'))
        // ->where('orders.state','confirmada')
        // ->where('orders.comision','<>',1)
        // ->where('restaurants.id','=',$restaurant_id)
        //   ->groupBy('restaurants.id')
        // ->get();



        $porPagar=Order::join('restaurants','restaurants.id','=','orders.restaurant_id')
        ->join('users','users.id','=','orders.user_id')
        ->select(
                 'users.name as name',
                 'users.surname as surname',
                 'users.email as email',
                 'users.telephone as telephone',
                 'users.address as address',
                 'orders.date as date',
                 'orders.hour as hour',
                 'orders.n_people as npeople',
                 'orders.oca_special as ocasion',
                 'orders.total as subtotal')
        ->where('orders.state','confirmada')
        ->where('orders.comision','<>',1)
        ->where('restaurants.id','=',$restaurant_id)
        ->get();
            // dd($porPagar);
            session(['ventana'=>"otra"]);
        return view('admin-restaurant.porpagar',compact('porPagar'));
        }













    public function contrasena(){
       return view('admin-restaurant.formulariocambiarcontrasena');
    }

    public function guardarcontrasena(Request $request){

        $contrasenaescorrecto=Hash::check($request->actual_p, Auth::user()->password);

        if($contrasenaescorrecto)
        {
          if(($request->nueva_p==$request->repite_p)&&
             ($request->repite_p!=null) && $request->nueva_p!=null){
                $newPasword=['password'=>bcrypt($request->repite_p)];
                User::findOrFail(Auth::user()->id)->update($newPasword);
          }else{
               return back()->with('errors','La confirmmacion de contraseña es incorrecta');
          }

              return back()->with('errors','La contraseña se guardó correctamente');
        }else{
              return back()->with('errors','La contraseña actual es incorrecta');
        }

    }
}
