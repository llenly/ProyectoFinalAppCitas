<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//importar el modelo user para poder usarlo en el metodo index 
use App\Models\User;
class PersonalTrainerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //var para hacer un forecha en el form de las vistas index
        $personalTrainers=User::personalTrainers()->get();
        return view('personalTrainers.index', compact('personalTrainers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('personalTrainers.create');
    }

 /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(Request $request)
    {
        //estos campos tambien hay que crealos en el modelo user por uqe lo he creado yo y no vienen 
        $rules = [
            'name'=>'required|min:5',
            'email'=>'required|email',
            'cedula'=>'required|digits:8',
            'address'=>'nullable|min:6',
            'phone'=>'required',

        ];
        $messages = [
            'name.required'=>'El nombre es obligatorio',
            'name.min'=>'El nombre debe tener min 5 carateres',
            'email.required'=>'El email es obligatorio',
            'email.email'=>'Ingresa una direccion de correo valida',
            'cedula.required'=>'La cedula es obligatoria ',
            'cedula.digits'=>'La cedula debe tener mas de 6 digitos',
            'address.min'=>'La direccion debe tener al menos 6 caracteres  ',
            'phone.required'=>'El telefono es obligatorio',
        ];
        //mostramos los mesnajes de validadcion 
        $this->validate($request, $rules, $messages);


        //creamos un array asociativo obteniendo la informacion del reuqest lo concatenamos con otro array y le asignamos el rol al personal trainer

        User::create(
            $request->only('name','email','cedula','address','phone')
            +[
                'role'=> 'personaltrainer',
                 'password'=> bcrypt($request->input('password'))
            ]
        );

       
        $notificacion = 'El personal Trainer se ha registrado correctamente';
        return redirect('/personalTrainers')->with(compact('notificacion'));

    }

   

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $personalTrainer = User::personalTrainers()->findOrFail($id);
        return view('personalTrainers.edit', compact('personalTrainer'));
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
        //estos campos tambien hay que crealos en el modelo user por uqe lo he creado yo y no vienen 
        $rules = [
            'name'=>'required|min:5',
            'email'=>'required|email',
            'cedula'=>'required|digits:8',
            'address'=>'nullable|min:6',
            'phone'=>'required',

        ];
        $messages = [
            'name.required'=>'El nombre es obligatorio',
            'name.min'=>'El nombre debe tener min 5 carateres',
            'email.required'=>'El email es obligatorio',
            'email.email'=>'Ingresa una direccion de correo valida',
            'cedula.required'=>'La cedula es obligatoria ',
            'cedula.digits'=>'La cedula debe tener mas de 6 digitos',
            'address.min'=>'La direccion debe tener al menos 6 caracteres  ',
            'phone.required'=>'El telefono es obligatorio',
        ];
        //mostramos los mesnajes de validadcion 
        $this->validate($request, $rules, $messages);
        $user = User::personalTrainers()->findOrFail($id);

        

        //creamos un array asociativo obteniendo la informacion del reuqest lo concatenamos con otro array y le asignamos el rol al personal trainer
        $data =   $request->only('name','email','cedula','address','phone');
        $password = $request->input('password');

        if($password){
            $data['password'] = bcrypt($password);
        }

        $user->fill($data);
        $user->save();

       
        $notificacion = 'La informacion del  personal Trainer se ha actualizado correctamente';
        return redirect('/personalTrainers')->with(compact('notificacion'));

    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::personalTrainers()->findOrFail($id);
        $personalName = $user->name;
        $user->delete();
        $notificacion = "El personal trainer  $personalName se ha eliminado correctamente ";
        return redirect('/personalTrainers')->with(compact('notificacion'));

    }
}
