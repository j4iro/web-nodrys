<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dish;
use App\Restaurant;
use App\Menu;
use App\Order;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class DishController extends Controller
{
   public function verificar_restaurante_diferente($id_restaurant)
    {

      $restaurant_id=isset($_SESSION['carrito'])?$_SESSION['carrito']:"0";
      $id_restaurante_comparar=0;

        if ($restaurant_id!="0") {
          foreach ($restaurant_id as $id => $value) {
             if($value['restaurante_id']!=$id_restaurant){
               return false;
             }else{
               // dd('ss');
             }

           }

        }

        return true;
    }

    public function platosxdia($dia, $id)
    {
        $dias = array('lunes','martes','miércoles','jueves','viernes','sábado','domingo');
        $dias_ingles = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'); //date(w)
        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio","Agosto", "Septiempre", "Octubre", "Noviembre","Diciembre");

        $platos=Menu::join('dishes','dishes.id','=','menus.dish_id')
        ->join('categories_dishes','categories_dishes.id','=','dishes.category_dish')
        ->select('menus.dia','dishes.name','dishes.id','dishes.price','dishes.time','dishes.image','categories_dishes.name as categoria')
        ->where('menus.restaurant_id', $id)
        ->where('dishes.category_dish','<>','5')
        ->where(strtolower('menus.dia'),'=',$dia)
        ->get();

        while ($dia_array_ingles = current($dias_ingles))
        {
            if ($dia_array_ingles == date('l')){
               $posicionDiaActual =  key($dias_ingles); //5
               //echo $posicionDiaActual . '<br>';
            }
            next($dias_ingles);
        }

        while ($dia_array = current($dias))
        {
            if ($dia_array == $dia){
               $posicionDiaQueViene =  key($dias); //6
              //echo $posicionDiaQueViene. '<br>'; //6
            }
            next($dias);
        }

        if($posicionDiaQueViene>$posicionDiaActual){
            $dia_reserva = $this->addToDate($posicionDiaQueViene-$posicionDiaActual);
        }
        else if($posicionDiaQueViene==$posicionDiaActual){
            $dia_reserva = date('d-m-Y');
        }
        else{
            $dia_reserva = $this->addToDate(6-$posicionDiaActual+$posicionDiaQueViene+1);
        }
        // echo $dia_reserva;
        // echo date("m",strtotime($dia_reserva));
        // echo "<br>";
        // // die();
        // echo $meses[(int)date("m",strtotime($dia_reserva))];
        // die();


        return view("dish.cardPlatos",[
            'dishes' => $platos,
            'idrestaurant' => $id,
            'dia_reserva' => $dia_reserva,
            'nombre_mes' => $meses[(int)date("m",strtotime($dia_reserva))-1]
        ]);
    }

    function addToDate($daysToAdd,$date='')
    {
        $date = ($date == '') ? date('d-m-Y') : $date;
        return date('d-m-Y', strtotime($date."$daysToAdd days"));
     }

    function getArrayDiasSemana($posicionDia,$suma)
    {
        $array = array($posicionDia => $diaActual);
        for($i = $posicionDia; $i<=6;$i++)
        {
            array_push($array, $diaActual+1);
        }

        for($i = $posicionDia; $i<=0;$i--)
        {
            array_push($array, $diaActual-1);
        }
        return $array();
    }

    public function dishes(Request $request)
    {
        date_default_timezone_set('America/Lima');

        $dias = array('domingo','lunes','martes','miércoles','jueves','viernes','sábado'); //Entrada
        $nombre_dia_actual = $dias[date('w')]; //jueves
        $nro_dia_actual = date('d'); //27

        // $numeros_dias = array(23,24,25,26,27,28,29); //Salida

        $nro_mes_actual = date('m');
        $nro_ano_actual = date('Y');


        // $numeros_del_mes =

        $menus = Menu::join('dishes','dishes.id','=','menus.dish_id')
        ->join('categories_dishes','categories_dishes.id','=','dishes.category_dish')
        ->select('menus.dia','dishes.name','dishes.price','dishes.time','dishes.image','categories_dishes.name as categoria')
        ->where('menus.restaurant_id', $request->id)
        ->where('dishes.category_dish','<>','5')
        ->get();

        // dd($menus->toArray());

        $sm="";
        if($this->verificar_restaurante_diferente($request->id)==false)
        {
          $sm="No puedes hacer reserva en más de un restaurante. ¡GRACIAS POR SU COMPRENSIÓN!  ♥♥♥";
        };

        $reserva = Dish::where('restaurant_id', $request->id)
        ->where('category_dish','=','5')
        ->where('state', '=',1)
        ->first();

       $restaurant = Restaurant::join('districts','districts.id','=','restaurants.district_id')
       ->join('categories','categories.id','=','restaurants.category_id')
       ->select('restaurants.*','districts.name as distrito','categories.name as categoria')
       ->where('restaurants.id', $request->id)->first();

        return view('dish.index',[
            'dishes' => $menus,
            'dias' => $dias,
            'restaurant'=>$restaurant,
            'sm'=>$sm,
            'reserva'=> $reserva
        ]);
    }

    public function getImage($filename)
    {
        $file = Storage::disk('dishes')->get($filename);
        return new Response($file,200);
    }

    public function new()
    {
        session(['ventana'=>"otra"]);
        return view('admin-restaurant.nuevo-plato');
    }

    public function list()
    {

        session(['ventana'=>"otra"]);
        $id_restaurant = session('id_restaurante');
        $dishes= Dish::where('restaurant_id', $id_restaurant)->get();
        return view('admin-restaurant.list-plato',compact('dishes'));
    }

    public function update_state_dish($id,$state){
    $estado=$state==1?["state"=>1]:["state"=>0];
    Dish::findOrFail($id)->update($estado);

    }
    public function edit($id)
    {
        $plato = Dish::findOrFail($id);
        return view('admin-restaurant.nuevo-plato',compact('plato'));
    }

    public function delete($id)
    {
        $plato = Dish::findOrFail($id)->delete();
        return redirect()->route('adminRestaurant.plato.list')->with('resultado','El plato se eliminó correctamente');
    }

    public function save(Request $request)
    {


        $id_restau = session('id_restaurante');


      //Instanciar a la tabla platos para setear mas adelante
      if ($request->input('editar')=='editar')
      {
        $id = $request->input('id');
        $dish = Dish::where('id',$id)->first();
      }
      else
      {
        $dish = new Dish;
      }

      $dish->restaurant_id = $id_restau;
      $dish->name = $request->input('name');
      $dish->description = $request->input('description');
      $dish->price = $request->input('price');
      $dish->time = $request->input('time');
      $dish->category_dish = $request->input('category_dish');
      $id_restaurante = session('id_restaurante');
    //   $dish->restaurant_id = $id_restaurante;

      //Guardar la imagen del plato
      $image_path =  $request->file('image');

      if ($image_path)
      {
        $image_path_name = time().$image_path->getClientOriginalName();
        Storage::disk('dishes')->put($image_path_name, File::get($image_path));
        $dish->image = $image_path_name;
      }

      if ($request->input('editar')=='editar')
      {
        $dish->update();
        return redirect()->route('adminRestaurant.plato.edit',compact('id'))->with('resultado','El plato se actualizó correctamente');
      }
      else
      {
        $dish->save();
        return redirect()->route('adminRestaurant.plato.new')->with('resultado','El plato se insertó correctamente');
      }

    }
    /*
    $datos = Valoration::all()
    ->where('restaurant_id',$request->restaurant_id);
    */
    public function aforoDisponible(Request $request)
    {
        $id_restaurante = $request->restaurant_id;
        $fecha_actual = date('Y-m-d');
        $hora_actual = date('H:m');

        $aforo = DB::select("SELECT * FROM orders AS o WHERE o.restaurant_id='$id_restaurante' AND o.DATE='$fecha_actual' AND  o.state='completado' AND '$hora_actual'< (DATE_ADD(o.hour,INTERVAL 45 MINUTE ))");

        return $aforo;
    }

}
