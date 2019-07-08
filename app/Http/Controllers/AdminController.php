<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant;
use App\District;
use App\Category;
use App\RequestRestaurant;
use App\User;
use App\Asigned_role;
use App\Order;
use App\Dish;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('roles:admin');
    }

    public function index()
    {
        $solicitudes = RequestRestaurant::join('districts','districts.id','=','requests_restaurants.district_name')
        ->select('requests_restaurants.*','districts.name as distrito')
        ->where('requests_restaurants.state','1')
        ->orderBy('state', 'desc')
        ->get();

        return view('admin.index', [
            'solicitudes' => $solicitudes,
            'titulo' => ' nuevas solicitudes'
        ]);
    }

    public function listSolicitudesAceptadas()
    {
        $solicitudes = RequestRestaurant::join('districts','districts.id','=','requests_restaurants.district_name')
        ->select('requests_restaurants.*','districts.name as distrito')
        ->where('requests_restaurants.state','0')
        ->orderBy('state', 'desc')
        ->get();

        return view('admin.index', [
            'solicitudes' => $solicitudes,
            'titulo' => ' solicitudes aceptadas'
        ]);
    }

    public function listTodasSolicitudes()
    {
        $solicitudes = RequestRestaurant::join('districts','districts.id','=','requests_restaurants.district_name')
        ->select('requests_restaurants.*','districts.name as distrito')
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
    public function editCategorias($id){
      $categorias=Category::findOrFail($id);
      return view('admin.create-categoria',compact('categorias'));
    }
    public function createCategorias(){
      return view('admin.create-categoria');
    }
    public function saveCategorias(Request $request){

     if ($request->editar=="editar")
      {
          Category::findOrFail($request->id)->update($request->all());
          return back()->with('resultado','La categoria se actualizó correctamente');
      }
          Category::create($request->all());
          return back()->with('resultado','La categoria se agregó correctamente');
    }

    public function updateStateCategoria($id)
    {
        $categoria = Category::where('id',$id)->first();
        $id_categoria = $categoria->id;

        $restaurantes = Restaurant::where('category_id', $id_categoria)->get();
        $cantidad = count($restaurantes);

        if($cantidad>=1)
        {
            return back()->with('error','No se puede deshabilitar esta categoria por que hay '.$cantidad.' restaurantes asociados a esta. Por favor edite la información de estos y vuelva a intentarlo.');
        }
        else
        {
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

    public function updateStateDistrito($id)
    {
        $distrito = District::where('id',$id)->first();
        $id_distrito = $distrito->id;

        $restaurantes = Restaurant::where('district_id', $id_distrito)->get();
        $cantidad = count($restaurantes);

        if($cantidad>=1)
        {
            return back()->with('error','No se puede deshabilitar este distrito por que hay '.$cantidad.' restaurantes asociados a este. Por favor edite la información de estos y vuelva a intentarlo.');
        }
        else
        {
            if ($distrito->state==1)
            {
                District::where('id', $id)
                ->update(['state' => 0]);
                return back()->with('resultado','El distrito se deshabilitó correctamente');
            }
            else
            {
                District::where('id', $id)
                ->update(['state' => 1]);
                return back()->with('resultado','El distrito se habilitó correctamente');
            }
        }
    }

    public function listDistritos()
    {
        $distritos = District::all();
        return view('admin.distritos',compact('distritos'));
    }

    public function newDistritos()
    {
        return view('admin.add-distritos');
    }

    public function saveDistritos(Request $request)
    {

        if ($request->editar=="editar")
        {
            District::findOrFail($request->id)->update($request->all());
            return back()->with('resultado','El distrito se actualizó correctamente');
        }
            District::create($request->all());
            return back()->with('resultado','El distrito se agregó correctamente');
    }

    public function showDestritos($id){
        $distritos=District::findOrFail($id);
        return view('admin.add-distritos',compact('distritos'));
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
        $reserva = new Dish();
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
      $restaurant->ruc=$request->input('ruc');
      $restaurant->latitude=$request->input('latitud');
      $restaurant->longitude=$request->input('longitud');
        $restaurant->capacity=$request->input('capacity');


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

     //Actualizar la solicitud si la hay a estado completado
     $solicitud = $request->input('solicitud');
     if (isset($solicitud))
     {
        $solicitud = RequestRestaurant::findOrFail($solicitud);
        $solicitud->state = 0;
        $solicitud->update();
     }

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

        $reserva->name = 'reserva';
        $reserva->price = '3.30';
        $reserva->time = '1';
        $reserva->image = 'reserva-81818.png';
        $reserva->category_dish = '5';
        $reserva->restaurant_id = $restaurant->id;

        $asigned_role->save();
        $reserva->save();
        return redirect()->route('admin.restaurant.new')->with('resultado','El restaurante se insertó correctamente');
      }
    }

    public function reportespedidos()//es reportes clientes por distritos
    {
        $distritos = District::where('districts.name','<>','otro')->get();
        return view('admin.reportesclientesdistrito',[
            'distritos' => $distritos
        ]);
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
            'solicitud' => $id
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

   public function cash()
   {
      $restaurants=Order::join('restaurants','restaurants.id','=','orders.restaurant_id')
    ->selectRaw('restaurants.id as id,restaurants.name,restaurants.slogan,COUNT(*) as cant')
    ->where('orders.state','confirmada')
    ->where('orders.comision','<>',1)
    ->groupBy('restaurants.id')
    ->groupBy('restaurants.name')
    ->groupBy('restaurants.slogan')
    ->get();

    $totalComision=Order::join('restaurants','restaurants.id','=','orders.restaurant_id')
    ->selectRaw('COUNT(*) as totalComision')
    ->where('orders.state','confirmada')
    ->where('orders.comision','=',1)
    ->get();

     return view('cash.cash',[
     'restaurants'=>$restaurants,
     'totalComision'=>$totalComision
     ]);
   }
   public function pagarComision($id)
   {
      Order::findOrFail($id)->update(['comision'=>1]);


   }

}
