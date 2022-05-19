<?php

namespace App\Http\Controllers;
use DateTime;
use Illuminate\Http\Request;
use App\Models\Turno;
use App\Http\Controllers\MailController;

class TurnoController extends Controller
{

    public function store(){
        
        Turno::create([ 
            'fecha' => request()->get('fecha'),
            'hora' => new DateTime('today'),
            'id_paciente'=> auth()->id(),
            'id_zona' => request()->get('zona'),
            'id_vacuna' => request()->get('vacuna'),
        ]);

        $controlador = new MailController;
        $controlador->send(); 

        return redirect('home');
        
    }

    public function edit($id) {
        Turno::where("id", $id)->update(["estado" => "cancelado"]);
        return redirect('ver-turnos')->with('eliminar','ok');
    }

}
