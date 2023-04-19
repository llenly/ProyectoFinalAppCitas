<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
// hay que importar el modelo de servicios 
use App\Models\Servicios;
use App\Http\Controllers\Controller;


class ServiciosController extends Controller
{


    // public function __construct(){
    //     $this->middleware('auth'); este viene por defecto enlaravel 
    // }

    //metodos dde las peticiones de servicios , create, index(logueo)edit, por cada metodo se crea una vista 

    // en este metodo inyectamos los datos que vienen del form de crear servicio y los mostramos en la vista index en el form con un foreach
    public function index(){
        $servicios = Servicios::all();
      
        return view('servicios.index', compact('servicios'));
    }

    //metodo create
    public function create(){
        return view('servicios.create');
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
        $notificacion= 'El Servicio se ha creado correctamente';

        return redirect('/servicios')->with(compact ('notificacion'));
     }

    //  metodo editar 
    public function edit(Servicios $servicios){
        return view('servicios.edit', compact('servicios'));

    }

    //metodo update 

     // metodo para enviarlos datos a la base de datos update, segun los campos que tenga la tabla creas los iput en la voista edit y le pasas los datos 
     public function update(Request  $request, Servicios $servicios){
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

    
        $servicios->nombre = $request->input('nombre');
        $servicios->descripcion = $request->input('descripcion');
        $servicios->precio = $request->input('precio');
        $servicios->save();
//mensaje para validad que se ha creado correctamente el servicio nuevo
        $notificacion= 'El Servicio se ha actualizado correctamente';
        return redirect('/servicios')->with(compact ('notificacion'));
     }

     //metodo para borrar los servicios 
     public function destroy(Servicios $servicios){
// variable para guardar el servicio eliminado y poderla llmar 
        $deleteName = $servicios->nombre;

        $servicios->delete();
//mensaje para validad que se ha creado correctamente el servicio nuevo
        $notificacion= 'El Servicio '.$deleteName  .' se ha eliminado correctamente';
        return redirect('/servicios')->with(compact ('notificacion'));
     }

}
