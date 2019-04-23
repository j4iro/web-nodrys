<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant;
use App\District;
use App\Category;
use App\RequestRestaurant;
use App\User;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('roles:admin');
    }

    public function index()
    {
        $solicitudes = RequestRestaurant::join('categories','categories.id','=','requests_restaurants.category_id_name')
        ->join('districts','districts.id','=','requests_restaurants.district_id_name')
        ->select('requests_restaurants.*','categories.name as categoria','districts.name as distrito')
        ->get();

        return view('admin.index', [
            'solicitudes' => $solicitudes,
        ]);
    }

    public function newRestaurant()
    {
        $distritos = District::all();
        $categorias = Category::all();

        return view('admin.add-restaurant',[
            'distritos' => $distritos,
            'categorias' => $categorias,
        ]);
    }

    public function reportes()
    {
      return view('admin.reportes-rapidos');
    }

    public function saveRestaurant(Request $request)
    {

     //Instanciar a la tabla platos para setear mas adelante
      if ($request->input('editar')=='editar')
      {
        $id = $request->input('id');
        $restaurant = Restaurant::where('id',$id)->first();
        $user = User::where('id',$restaurant->user_id)->first();
      }
      else
      {
        $restaurant = new Restaurant();
        $user = new User();
      }

      $user->name = "user-r";
      $user->surname = "restaurant";
      $user->email = $request->input('email_ingreso');
      $user->password = bcrypt($request->input('password'));
      $user->telephone = "null";
      $user->address = "null";
      $user->image = "null";
      $user->points = 0;
      $user->state = 1;
      $user->district_id = $request->input('district_id');
      $user->save();

      //Sacar el último id del usuario registrado

      $restaurant->user_id = $user->id;
      $restaurant->district_id = $request->input('district_id');
      $restaurant->category_id = $request->input('category_id');
      $restaurant->name = $request->input('name');
      $restaurant->slogan = $request->input('slogan');
      $restaurant->address = $request->input('address');
      $restaurant->assessment = 0;
      $restaurant->points = $request->input('points');
      $imagen_soli =  $request->input('imagen_soli');

      //Guardar la imagen del plato
      $image_path =  $request->file('image');

      if ($image_path)
      {
        $image_path_name = time().$image_path->getClientOriginalName();
        \Storage::disk('restaurants')->put($image_path_name, \File::get($image_path));
        $restaurant->image = $image_path_name;
      }

      if (!empty($imagen_soli))
     {
        $restaurant->image = $imagen_soli;
     }

     //Ingresar en la tabla asignrd_roles el respectivo permiso


      if ($request->input('editar')=='editar')
      {
        $restaurant->update();
        return redirect()->route('admin.restaurant.edit',compact('id'))->with('resultado','El restaurante se actualizó correctamente');
      }
      else
      {
        $restaurant->save();
        return redirect()->route('admin.restaurant.new')->with('resultado','El restaurante se insertó correctamente');
      }

    }

    public function editRestaurant($id)
    {
        $restaurante = Restaurant::findOrFail($id);
        $distritos = District::all();
        $categorias = Category::all();

        $restaurante2 = Restaurant::where('id',$id)->first();
        $user = User::findOrFail($restaurante2->user_id);

        return view('admin.add-restaurant',[
            'distritos' => $distritos,
            'categorias' => $categorias,
            'restaurante'=>$restaurante,
            'user' => $user
        ]);
    }

    public function showDatosSolicitud($id)
    {
        $restaurante = RequestRestaurant::findOrFail($id);
        $distritos = District::all();
        $categorias = Category::all();

        return view('admin.add-restaurant',[
            'distritos' => $distritos,
            'categorias' => $categorias,
            'restaurante'=>$restaurante,
            'solicitud' => 1
        ]);
    }

    public function showRestaurants()
    {
        $restaurants = Restaurant::join('categories','categories.id','=','restaurants.category_id')
        ->join('districts','districts.id','=','restaurants.district_id')
        ->select('restaurants.*','categories.name as categoria', 'districts.name as distrito')
        ->get();

        return view('admin.restaurants',[
            'restaurantes' => $restaurants,
        ]);
    }
}
