<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dish;
use App\Restaurant;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
// use Illuminate\Support\Facades\DB;

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

    public function dishes(Request $request)
    {

        $sm="";
        if($this->verificar_restaurante_diferente($request->id)==false)
        {
          $sm="No puedes hacer reserva en más de un restaurante. !GRACIAS POR SU COMPRESIÓN...!  ♥♥♥";
        };

       $dishes = Dish::where('restaurant_id', $request->id)
                ->where('category_dish','<>','5')
                ->where('state', '=',1)
                ->get();

                $reserva = Dish::where('restaurant_id', $request->id)
                ->where('category_dish','=','5')
                ->where('state', '=',1)
                ->first();          

       $restaurant = Restaurant::join('districts','districts.id','=','restaurants.district_id')
       ->join('categories','categories.id','=','restaurants.category_id')
       ->select('restaurants.*','districts.name as distrito','categories.name as categoria')
       ->where('restaurants.id', $request->id)->first();

        return view('dish.index',[
            'dishes' => $dishes,
            'restaurant'=>$restaurant,
            'sm'=>$sm,
            'reserva' => $reserva
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
}
