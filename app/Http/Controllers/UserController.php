<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function config()
    {
        return view('user.config');
    }

    public function update(Request $request)
    {
        //Conseguir usuario identificado
        $user = \Auth::user();
        $id = $user->id;

        //validación del formulario
        $validate = $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id],
            'telephone' => ['max:20'],
            'address' => ['max:255'],
        ]);

        //recoger los datos del formulario
        $name = $request->input('name');
        $surname = $request->input('surname');
        $email = $request->input('email');
        $telephone = $request->input('telephone');
        $address = $request->input('address');

        //asignar nuevos valores al objeto del usuario
        $user->name = $name;
        $user->surname = $surname;
        $user->email = $email;
        $user->telephone = $telephone;
        $user->address = $address;

        //Ejecutar consulta y cambios en la base de datos
        $user->update();

        //Redireccionar a la vista con un mensaje
        return redirect()->route('config')
                         ->with(['message'=>'Usuario Actualizado Correctamente']);
    }
}
