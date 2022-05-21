<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RegisterController extends Controller
{



    public function store() {

        //Validacion
        request()->validate([
            '*' => 'required',              // Todos los campos obligatorios
            'email' => ' email | required | unique:users,email' , // obligatorio + unico
            'documento' => 'required | unique:users,documento', // obligatorio + unico
            'password' => 'min:6| same:password-confirm',
            'password-confirm' => 'min:6 | required | same:password'
        ]);

        User::create([
        'name'=> request()->get('nombre'),
        'email'=>request()->get('email'),
        'password'=> bcrypt(request()->get('password')),
        'apellido'=> request()->get('apellido'),
        'direccion'=> request()->get('direccion'),
        'telefono' => request()->get('telefono'),
        'documento' => request()->get('documento'),
        'fecha_nacimiento' => request()->get('fecha_nacimiento'),
        ]);

        // Una vez registrado, lo mandamos al home pero para eso la sesion debe estar iniciada
        $objeto = new LoginController();
        $objeto->login($_REQUEST);
        return redirect('home');
    }
}
