<?php

namespace App\Http\Controllers\PersonTrain;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Horarios;
use Carbon\Canbon;


class HorarioController extends Controller
{
    //1 controllery su metodo ,2 vista 

    private  $days = [
                       'Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo'
                     ];
    public function edit(){
       
        //obtener los datos del personal taroner que ha inciado sesion
        $horarios = Horarios::where('user_id' , auth()->id())->get();

        //ver el horario del medico en la vista , que horarios tiene
        if(count($horarios) > 0 ){
            //quitar los min de la hora que viene de la db carbon para cambiar el formato de la hora 
             $horarios->map(function($horarios){
             $horarios->morning_start = (new Carbon($horarios->morning_start))->format('g:i A');
             $horarios->morning_end = (new Carbon($horarios->morning_end))->format('g:i A');
             $horarios->afternoon_start = (new Carbon($horarios->afternoon_start))->format('g:i A');
             $horarios->afternoon_end = (new Carbon($horarios->afternoon_end))->format('g:i A');
              });

        }else{
                  // si no existe el horario los definimos 
                  $horarios  = collect();
                  for ($i=0; $i < 7; $i++) { 
                     $horarios->push(new Horarios());
                  }
        }

        //acceder a la var days array que tiene todos los dias de la semana 
          $days = $this->days;

         //ver los cambios en el formato de la fecha 
        //  dd($horarios->toArray());
        //inytectar en la vista la var horarios 
        return view('horario', compact('days', 'horarios'));
    }


    //metodo para guardar los horarios 

    public function store (Request $request){
        // comprobar los datos de las fechas de db
       // dd($request->all());

        //hay que crear una var que guarde cada campo de la tabla horarios 
        $active = $request->input('active') ?: [];
        $morning_start = $request->input('morning_start') ?: [];
        $morning_end = $request->input('morning_end') ?: [];
        $afternoon_start = $request->input('afternoon_start') ?: [];
        $afternoon_end = $request->input('afternoon_end') ?: [];

        //variable para mostar el error con un for para mostrar las cndiciones segun los dias x eso es el 7
        $errors = [];
    
        // /bucle for para actualizar los hoararios que viene de la tabla 7 es numero de dias 

          for ($i=0; $i < 7; $i++) { 

               //validacion turno de la mañana 
           if($morning_start[$i] > $morning_end[$i]){
            $errors[] = 'Debes marcar cita para el intervalo en las horas del turno de mañana ' .$this->$days[$i]. '.';
         }

          //validacion turno de la tarde 
          if($afternoon_start[$i] > $afternoon_start[$i]){
              $errors[] = 'Debes marcar cita para el mismo  intervalo en las horas del turno de la tarde  ' .$this->$days[$i]. '.';
           }
      
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

            }
            if(count($errors) > 0)
            return back()->with(compact('errors'));


            $notificacion = 'Los cambios se han guardado bien';
            return back()->with(compact('notificacion'));

          }
        // metodo

         
    }


   
