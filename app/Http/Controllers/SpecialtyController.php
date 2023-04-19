<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Specialty;
use\App\Http\Controllers\Controller;


// este no esta implementado
class SpecialtyController extends Controller
{
    public function __construct(){
        this->middleware('auth');
    }

    public function index(){
        $servicios = Servicios::all();
        return view('specialties.index', compact('specialties'));
    }

    //metodo create
    public function create(){
        return view('specialties.create');
    }

    // metodo para enviarlos datos a la base de datos sendDta, segun los campos que tenga la tabla creas los iput y le pasas los datos 
     public function sendData(Request  $request){
        //definicion de las reglas o rules estos mensajes se muestran en la vista create antes del form
        $rules = [
            'nombre'=>'required| min:3 | max:55'
        ];
        $messages = [
            'nombre.required'=>'El nombre de la especialidad es obligatorio. ',
            'nombre.required'=>'El nombre de la especialidad debe terner mas de 3 caracteres y menos de 15. '
        ];

        //validacion de mensajes a nivel de servidor de cuando se cree un nuevo servicio
        $this->validate($request, $rules,$messages);

        $servicios = new Servicios();
        $servicios->nombre = $request->input('nombre');
        $servicios->descripcion = $request->input('descripcion');
        $servicios->precio = $request->input('precio');
        $servicios->save();
        //mensaje para validad que se ha creado correctamente el servicio nuevo
        $notificacion= 'La especialidad no se ha creado correctamente';

        return redirect('/specialties')->with(compact ('notificacion'));
     }

    //  metodo editar 
    public function edit(Specialties $specialties){
        return view('specialties.edit', compact('specialties'));

    }

    //metodo update 

     // metodo para enviarlos datos a la base de datos update, segun los campos que tenga la tabla creas los iput en la voista edit y le pasas los datos 
     public function update(Request  $request, Specialties $specialties){
        //definicion de las reglas o rules estos mensajes se muestran en la vista create antes del form
        $rules = [
            'nombre'=>'required| min:3 | max:55'
        ];
        $messages = [
            'nombre.required'=>'El nombre de la especialidad es obligatorio. ',
            'nombre.required'=>'El nombre de la especialidad debe terner mas de 3 caracteres y menos de 15. '
        ];

        //validacion de mensajes a nivel de servidor de cuando se cree un nuevo servicio
        $this->validate($request, $rules,$messages);

    
        $specialties->nombre = $request->input('nombre');
        $specialties->descripcion = $request->input('descripcion');
        $specialties->precio = $request->input('precio');
        $specialties->save();
//mensaje para validad que se ha creado correctamente el servicio nuevo
        $notificacion= 'La especialidad  se ha actualizado correctamente';
        return redirect('/servicios')->with(compact ('notificacion'));
     }

     //metodo para borrar los servicios 
     public function destroy(Specialties $specialties){
// variable para guardar el servicio eliminado y poderla llmar 
        $deleteName = $specialties->nombre;

        $specialties->delete();
//mensaje para validad que se ha creado correctamente el servicio nuevo
        $notificacion= 'La especialidad '.$deleteName  .' se ha eliminado correctamente';
        return redirect('/servicios')->with(compact ('notificacion'));
     }

   
}
