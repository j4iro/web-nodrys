<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Restaurant;
use App\Dish;
use App\User;
use App\Order;
use Auth;


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

    public function reportesClientes(){
        session(['ventana'=>"otra"]);
        return view('admin-restaurant.reportesclientes');
    }

    public function reportesPedidos(){
        return view('admin-restaurant.reportespedidos');
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
        $new_image_path_name="";

        if ($image_path)
        {
            //Coloco nombre único
            $new_image_path_name = time().$image_path->getClientOriginalName();
            //Guardo en la carpeta Storage (storage/app/users)
            Storage::disk('restaurants')->put($new_image_path_name, File::get($image_path));

        }

        $request=array_slice($request->toArray(), 1,7);
        $request["image"]=$new_image_path_name;

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

    public function totalComision(){
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
}
