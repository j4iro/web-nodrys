<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Valoration;
use BD;
use Input;
use Storage;

class ValorationController extends Controller
{

    public function index()
    {
        $valoration=Valoration::all();
        return view('dish.index',compact('valoration'));
    }

    public function create()
    {
        $valoration=Valoration::all();
        return view('dish.index',compact('valoration'));
    }

    public function store($request)
    {
        $valoration=new Valoration;
        $valoration->user_id=$request->user_id;
        $valoration->restaurant_id=$request->restaurant_id;
        $valoration->score->$request->score;

        $valoration->save();
        return redirect('dish.index')->with('message','Inserto Calificacion :)')
    }

    public function edit($id)
    {
        $valoration = Valoration::find($id);
        return view('dish.index',['valoration'=>$valoration]);
    }

    public function update(ItemUpdateRequest $request, $id)
    {
        $valoration = Valoration::find($id);
        $valoration->user_id = $request->user_id;
        $valoration->restaurant_id = $request->restaurant_id;
        $valoration->score = $request->score;

        $valoration->save();

        Session::flash('message', 'Editado Satisfactoriamente !');
        return Redirect::to('dish.index');
    }

    public function destroy($id)
    {
      $valoration::destroy($id);
      Session::flash('message', 'Eliminado Satisfactoriamente !');
      return Redirect::to('dish.index');
    }
}
