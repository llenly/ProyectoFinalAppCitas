{{-- el admin va a generar contraseña aleatoria para el personal trainer y que luego la cambie  --}}
<?php
use Illuminate\Support\Str;

?>
@extends('layouts.panel')

@section('content')
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Editar PersonalTrainer</h3>
                </div>
                <div class="col text-right">
                    <a href="{{ url('/personalTrainers') }}" class="btn btn-sm btn-success"><i
                            class="fas fa-chevron-left"></i>Regresar/Atras</a>
                </div>
            </div>
        </div>

        <div class="card-body">

            {{-- mostrar los mesnajes de error si existen a la hora de rellenar los campos de crear servicios , los manda desde el servidor  --}}

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">
                        <i class=" fas fa-exclamation-triangle"></i>
                        <strong>Hay un Error</strong>{{ $error }}
                    </div>
                @endforeach
            @endif





            <form action="{{ url('/personalTrainers/'.$personalTrainer->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Nombre del PersonalTrainer</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $personalTrainer->name) }}">
                </div>
                <div class="form-group">
                    <label for="email">Correo Electronico</label>
                    <input type="text" name="email" class="form-control" value="{{ old('email', $personalTrainer->email) }}" >
                </div>
                <div class="form-group">
                    <label for="cedula">Cedula</label>
                    <input type="text" name="cedula" class="form-control" value="{{ old('cedula',$personalTrainer->cedula) }}" >
                </div>
                <div class="form-group">
                    <label for="address">Direccion</label>
                    <input type="text" name="address" class="form-control" value="{{ old('address',$personalTrainer->address) }}" >
                </div>
                <div class="form-group">
                    <label for="phone">Telefono / Movil</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone',$personalTrainer->phone) }}" >
                </div>
                {{-- este campo el admin genera una pass para cada personaltariner y asignarle el rol , luego el empleado debe cambiarla  --}}
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="text" name="password" class="form-control">

                    {{-- mensaje de notificacion  --}}
                    <small class="text-warning">Solo llena el campo si desea cambiar la contraseña</small>

                </div>

                {{-- a medida que se crean mas servicios se crean campos  --}}


                <button type="submit" class="btn btn-sm btn-primary">Guardar Cambios </button>
            </form>

        </div>
    </div>
@endsection
