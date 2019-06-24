<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant;
use App\Dish;
use App\Category;
use App\District;
use App\RequestRestaurant;
use App\Asigned_role;
use Illuminate\Support\Facades\Mail;
use App\Mail\EnvioSolicitud;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        if (auth()->check())
        {
            $user = \Auth::user();
            $id_user = $user->id;
            $datos_restaurante_logueado = Restaurant::where('user_id',$id_user)->first();

            if ($datos_restaurante_logueado==null)
            {
                //Si el objeto es nulo hay que comprobar si es admin
                //Obtener registros de la tabla asignar_roles
                $registros_asign_roles = Asigned_role::all();
                //Recorrer la tabla
                foreach ($registros_asign_roles as $registro_asign_rol)
                {
                    //Si el id del usuario se encuentra y si el rol es igual a 1 osea admin
                    if($registro_asign_rol->user_id==$id_user && $registro_asign_rol->role_id==1)
                    {
                        return redirect()->route('admin.index');
                    }
                }
            }
            else
            {
                //El usuario logueado es un restaurante y hay que redirigir
                // $_SESSION['logeo']['id_user'] = $id_user;
                session(['id_user'=>$id_user]);
                // dd(session('id_user'));
                return redirect()->route('adminRestaurant.index');
            }
        }

        $restaurants = Restaurant::join('categories','categories.id','=','restaurants.category_id')
        ->join('districts','districts.id','=','restaurants.district_id')
        ->select('restaurants.*','categories.name as categoria', 'districts.name as distrito')
        ->where('restaurants.state','=','1')
        ->get();

        $categorias = Category::all();
        $distritos = District::all();

        return view('home',[
            'restaurants' => $restaurants,
            'categorias' => $categorias,
            'distritos' => $distritos,
        ]);
    }
    public function help(){
        return view('help');
    }

    public function getDishOne(Request $request)
    {
        $dishes = Dish::join('restaurants','restaurants.id','=','dishes.restaurant_id')
        ->select('dishes.*','restaurants.name as restaurante')
        ->where('dishes.name',$request->name)
        ->orWhere('dishes.name','like','%'.$request->name.'%')
        ->get();

        $mje = 'Se muestran '.count($dishes). ' resultados de "' .  $request->name . '".';

        return view('dish.getAll',[
            'platos' => $dishes,
            'resultado' => $mje
        ]);
    }

    public function getAllDishes()
    {
        $platos = Dish::join('restaurants','restaurants.id','=','dishes.restaurant_id')
        ->select('dishes.*','restaurants.name as restaurante','restaurants.id as restaurante_id')
        ->where('dishes.category_dish','<>','5')
        ->get();
        return view('dish.getAll',[
            'platos' => $platos
        ]);
    }

    public function show_solicitud()
    {
        $distritos = District::all();
        $categorias = Category::all();

        return view('solicitud',[
            'distritos' => $distritos,
            'categorias' => $categorias
        ]);
    }

    public function save_solicitud(Request $request)
    {
      // dd($request);
      $request_restaurant = new RequestRestaurant();
      $request_restaurant->name_restaurant = $request->input('name_restaurant');
      $request_restaurant->district_name = $request->input('district_name');
      $request_restaurant->name_owner = $request->input('name_owner');
      $request_restaurant->surname_owner = $request->input('surname_owner');
      $destinatario = $request->input('email_owner');
      $request_restaurant->email_owner = $destinatario;
      $request_restaurant->telephone_owner = $request->input('telephone_owner');
      $request_restaurant->state = '1';
      $request_restaurant->save();

      $data = array('contenido'=>"Hola  ". $request_restaurant->name_owner .", tu solicitud ha sido enviada exitosamente hacia los encargados de la plataforma. Una vez ellos la evaluen, se pondrán en contacto con usted por medio del numero ". $request_restaurant->telephone_owner . " o mediante este email para pedirle los datos de su restaurante. Muchas gracias.");

      Mail::send('correos.enviosolicitud',$data,function($mensaje) use ($destinatario){
          $mensaje->from('soporte@nodrys.com','Equipo de soporte de Nodrys');
          $mensaje->to(trim($destinatario))->subject('Envio de solicitud');
      });

      return  redirect()->route('show.solicitud')->with('resultado','Su solicitud ha sido enviada, le enviamos un correo a ' . $request_restaurant->email_owner. '. Por favor verifique su bandeja');

    }

    public function template(){
        return view('includes.app_new');
    }
}
