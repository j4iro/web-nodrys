<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant;
use App\Dish;
use App\Category;
use App\District;
use App\RequestRestaurant;
use App\Asigned_role;

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
                $_SESSION['id_restaurante'] = $id_user;
                return redirect()->route('adminRestaurant.index');
            }
        }

        $restaurants = Restaurant::join('categories','categories.id','=','restaurants.category_id')
        ->join('districts','districts.id','=','restaurants.district_id')
        ->select('restaurants.name','restaurants.address','restaurants.image','restaurants.id','categories.name as categoria', 'districts.name as distrito')
        ->get();

        $categorias = Category::all();
        $distritos = District::all();

        return view('home',[
            'restaurants' => $restaurants,
            'categorias' => $categorias,
            'distritos' => $distritos,
        ]);
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
        ->select('dishes.*','restaurants.name as restaurante')->get();
        return view('dish.getAll',[
            'platos' => $platos
        ]);
    }

    public function show_solicitud($resultado="nada")
    {
        $distritos = District::all();
        $categorias = Category::all();

        return view('solicitud',[
            'distritos' => $distritos,
            'categorias' => $categorias,
            'resultado' => $resultado
        ]);
    }

    public function save_solicitud(Request $request)
    {
      $request_restaurant = new RequestRestaurant();
      $request_restaurant->name = $request->input('name');
      $request_restaurant->description = $request->input('description');
      $request_restaurant->category_id_name = $request->input('category_id_name');
      $request_restaurant->district_id_name = $request->input('district_id_name');
      $request_restaurant->slogan = $request->input('slogan');
      $request_restaurant->address = $request->input('address');
      $request_restaurant->email = $request->input('email');
      $request_restaurant->telephone = $request->input('telephone');
      $request_restaurant->points = $request->input('points');

      //Guardar la imagen del plato
      $image_path =  $request->file('image');

      if ($image_path)
      {
        $image_path_name = time().$image_path->getClientOriginalName();
        \Storage::disk('restaurants')->put($image_path_name, \File::get($image_path));
         $request_restaurant->image = $image_path_name;
      }

      $request_restaurant->save();
      return  $this->show_solicitud('Su solicitud se ha enviado correctamente');

    }
}
