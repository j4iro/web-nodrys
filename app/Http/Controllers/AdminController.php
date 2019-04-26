<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant;
use App\District;
use App\Category;
use App\RequestRestaurant;
use App\User;
use App\Asigned_role;


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
        ->where('requests_restaurants.state','1')
        ->get();

        return view('admin.index', [
            'solicitudes' => $solicitudes,
            'titulo' => ' nuevas solicitudes'
        ]);
    }

    public function listSolicitudesAceptadas()
    {
        $solicitudes = RequestRestaurant::join('categories','categories.id','=','requests_restaurants.category_id_name')
        ->join('districts','districts.id','=','requests_restaurants.district_id_name')
        ->select('requests_restaurants.*','categories.name as categoria','districts.name as distrito')
        ->where('requests_restaurants.state','0')
        ->get();

        return view('admin.index', [
            'solicitudes' => $solicitudes,
            'titulo' => ' solicitudes aceptadas'
        ]);
    }

    public function listTodasSolicitudes()
    {
        $solicitudes = RequestRestaurant::join('categories','categories.id','=','requests_restaurants.category_id_name')
        ->join('districts','districts.id','=','requests_restaurants.district_id_name')
        ->select('requests_restaurants.*','categories.name as categoria','districts.name as distrito')
        ->orderBy('state', 'desc')
        ->get();

        return view('admin.index', [
            'solicitudes' => $solicitudes,
            'titulo' => ' solicitudes en total'
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

    public function listCategorias()
    {
        $categorias = Category::all();
        return view('admin.categorias',compact('categorias'));
    }

    public function updateStateCategoria($id)
    {
        $categoria = Category::where('id',$id)->first();

        if ($categoria->state==1)
        {
            Category::where('id', $id)
            ->update(['state' => 0]);
            return redirect()->route('admin.categorias.list')->with('resultado','La categoria se deshabilitó correctamente');
        }
        else
        {
            Category::where('id', $id)
            ->update(['state' => 1]);
            return redirect()->route('admin.categorias.list')->with('resultado','La categoria se habilitó correctamente');
        }
    }

    public function updateStateRestaurante($id)
    {
        $restaurante = Restaurant::where('id',$id)->first();

        if ($restaurante->state==1)
        {
            Restaurant::where('id', $id)
            ->update(['state' => 0]);
            return redirect()->route('admin.restaurants')->with('resultado','El restaurante se deshabilitó correctamente');
        }
        else
        {
            Restaurant::where('id', $id)
            ->update(['state' => 1]);
            return redirect()->route('admin.restaurants')->with('resultado','El restaurante se habilitó correctamente');
        }
    }

    public function listDistritos()
    {
        $distritos = District::all();
        return view('admin.distritos',compact('distritos'));
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

        //Revisar esta parte por que un usuario puede tener varios roles
        $asigned_role = Asigned_role::where('user_id',$restaurant->user_id)->first();
      }
      else
      {
        $restaurant = new Restaurant();
        $user = new User();
        $asigned_role = new Asigned_role();
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

      //Comprobar si han escrito contraseñas para un cambio
      $pwd = $request->input('password');
      $pwd2 = $request->input('repeatpassword');

      if (isset($pwd) || isset($pwd2))
      {
          if($pwd!=$pwd2)
          {
              // dd($request->headers->get('referer'));
             $url_anterior = \URL::previous();
             return  redirect($url_anterior)->with('error_password','Las contraseñas no coinciden');
          }
          else
          {
              $user->password = bcrypt($pwd);
          };
      }

      if ($request->input('editar')=='editar')
      {
        $user->update();
      }
      else
      {
        $user->save();
      }

      //Sacar el último id del usuario registrado
      $restaurant->user_id = $user->id;
      $restaurant->district_id = $request->input('district_id');
      $restaurant->category_id = $request->input('category_id');
      $restaurant->name = $request->input('name');
      $restaurant->slogan = $request->input('slogan');
      $restaurant->description = $request->input('description');
      $restaurant->telephone = $request->input('telephone');
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
      $asigned_role->user_id = $user->id;
      $asigned_role->role_id = 2;

      //Falta revisar haber si funciona correctamente
      if ($request->input('editar')=='editar')
      {
        $restaurant->update();
        $asigned_role->update();
        return redirect()->route('admin.restaurant.edit',compact('id'))->with('resultado','El restaurante se actualizó correctamente');
      }
      else
      {
        $restaurant->save();
        $asigned_role->save();
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
