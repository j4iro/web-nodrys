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
    public function dishes(Request $request)
    {
       $dishes = Dish::where('restaurant_id', $request->id)->get();
       $restaurant = Restaurant::where('id', $request->id)->first();

        return view('dish.index',[
            'dishes' => $dishes,
            'restaurant'=>$restaurant
        ]);
    }

    public function getImage($filename)
    {
        $file = Storage::disk('dishes')->get($filename);
        return new Response($file,200);
    }

    public function new()
    {
        return view('admin-restaurant.nuevo-plato');
    }

    public function list()
    {
        $id_restaurant = session('id_restaurante');
        $dishes= Dish::where('restaurant_id', $id_restaurant)->get();
        return view('admin-restaurant.list-plato',compact('dishes'));
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

        $id = $_SESSION['id_restaurante'];
        $id_restau = Restaurant::
        where('user_id',$id)
        ->first();


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

      $dish->restaurant_id = $id_restau->id;
      $dish->name = $request->input('name');
      $dish->description = $request->input('description');
      $dish->price = $request->input('price');
      $dish->time = $request->input('time');
      $dish->category_dish = $request->input('category_dish');

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
