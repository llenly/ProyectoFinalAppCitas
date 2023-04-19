<?php

namespace App\Http\Controllers\PersonTrain;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Horarios;

class HorarioController extends Controller
{
    //1 controllery su metodo ,2 vista 
    public function edit(){
        $days = [
            'Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo'
        ];
        return view('horario', compact('days'));
    }

    //metodo para guardar los horarios 

    public function store (Request $request){
        //hay que crear una var que guarde cada campo de la tabla horarios 
        $active = $request->input('active') ?: [];
        $morning_start = $request->input('morning_start') ?: [];
        $morning_end = $request->input('morning_end') ?: [];
        $afternoon_start = $request->input('afternoon_start') ?: [];
        $afternoon_end = $request->input('afternoon_end') ?: [];

        // /bucle for para actualizar los hoararios que viene de la tabla 7 es numero de dias 

          for ($i=0; $i < 7; $i++) { 
            Horarios::updateOrCreate(
                [
                  'day'=> $id,
                  'user_id'=> auth()->id()
      
                ],
      
                [
                    // en active se busca un elemnt dentro del array, se busca el dia que tiene la posicion i, active si esta o no activo 
                  'active'=> int_array($i, $active),
                  'morning_start'=> $morning_start[$i],
                  'morning_end'=> $morning_end[$i],
                  'afternoon_start'=> $afternoon_start[$i],
                  'afternoon_end'=> $afternoon_end[$i],
                ]
              );

              return back();
          }
       
    }


    // metodo 

}
