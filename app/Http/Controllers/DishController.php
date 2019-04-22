<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dish;
use App\Restaurant;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $dishes = Dish::where('restaurant_id', $request->id)->get();
        $restaurant = Restaurant::where('id', $request->id)->first();

         return view('dish.index',[
             'dishes' => $dishes,
             'restaurant'=>$restaurant
         ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin-restaurant.nuevo-plato');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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

      $dish->restaurant_id = $request->input('restaurant_id');
      $dish->name = $request->input('name');
      $dish->description = $request->input('description');
      $dish->price = $request->input('price');
      $dish->time = $request->input('time');
      $dish->type = $request->input('type');

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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $plato = Dish::findOrFail($id);
        return view('admin-restaurant.nuevo-plato',compact('plato'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $plato = Dish::findOrFail($id)->delete();
        return redirect()->route('adminRestaurant.plato.list')->with('resultado','El plato se eliminó correctamente');
    }
}
