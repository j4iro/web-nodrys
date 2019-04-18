<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant;
use App\District;
use App\Category;


class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
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

    public function saveRestaurant(Request $request)
    {
    
        //Instanciar a la tabla platos para setear mas adelante
      if ($request->input('editar')=='editar')
      {
        $id = $request->input('id');
        $restaurant = Restaurant::where('id',$id)->first();
      }
      else
      {
        $restaurant = new Restaurant();
      }

      $restaurant->district_id = $request->input('district_id');
      $restaurant->category_id = $request->input('category_id');
      $restaurant->name = $request->input('name');
      $restaurant->slogan = $request->input('slogan');
      $restaurant->address = $request->input('address');
      $restaurant->assessment = 0;
      $restaurant->points = $request->input('points');

      //Guardar la imagen del plato
      $image_path =  $request->file('image');

      if ($image_path)
      {
        $image_path_name = time().$image_path->getClientOriginalName();
        \Storage::disk('restaurants')->put($image_path_name, \File::get($image_path));
        $restaurant->image = $image_path_name;
      }

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
        // dd($restaurante);
        //return view('admin-restaurant.nuevo-plato',compact('plato'));
        $distritos = District::all();
        $categorias = Category::all();

        return view('admin.add-restaurant',[
            'distritos' => $distritos,
            'categorias' => $categorias,
            'restaurante'=>$restaurante
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
