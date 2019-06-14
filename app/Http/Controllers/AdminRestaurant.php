<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Restaurant;
use App\Dish;
use App\Card;
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

    public function menus()
    {
        return view('admin-restaurant.menus');
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


    public function newCuentaBancaria()
    {
        $restaurant = \Auth::user();
        $id_restaurante=auth()->user()->id;
        $card = Card::where('user_id','=',$id_restaurante)->first();
        return view('admin-restaurant.datos_bancarios',compact('card'));


    }

    public function reportespersonalizados(){
        return view('admin-restaurant.reportespersonalizados');
    }

    public function getDishes()
    {
        $restaurant = \Auth::user();
        $id_restaurante=auth()->user()->id;
        $dishes = Dish::where('restaurant_id','=',$id_restaurante)->get();
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

        return redirect()->route('admin-r.cuentaBancaria')
        ->with(['message'=>'message']);
    }

}
