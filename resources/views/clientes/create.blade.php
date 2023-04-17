
@extends('layouts.panel')

@section('content')
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Nuevos Clientes</h3>
                </div>
                <div class="col text-right">
                    <a href="{{ url('/clientes') }}" class="btn btn-sm btn-success"><i
                            class="fas fa-chevron-left"></i>Regresar/Atras</a>
                </div>
            </div>
        </div>

        <div class="card-body">

{{-- mostrar los mesnajes de error si existen a la hora de rellenar los campos de crear servicios , los manda desde el servidor  --}}

         @if ($errors->any())

          @foreach ($errors->all() as $error )
              <div class="alert alert-danger" role="alert">
              <i class=" fas fa-exclamation-triangle"></i>
              <strong>Hay un Error</strong>{{ $error }}
              </div>
          @endforeach
             
         @endif





          <form action="{{ (url('/clientes')) }}" method="POST">
            @csrf
                <div class="form-group">
                    <label for="name">Nombre del Cliente</label>
                    <input type="text" name="name" class="form-control" value ="{{ old('name') }}" required>
                </div>
                <div class="form-group">
                    <label for="email">Correo Electronico</label>
                    <input type="text" name="email" class="form-control" value ="{{ old('email') }}" required>
                </div>
                 <div class="form-group">
                    <label for="cedula">Cedula</label>
                    <input type="text" name="cedula" class="form-control" value ="{{ old('cedula') }}" required>
                </div>
                <div class="form-group">
                    <label for="address">Direccion</label>
                    <input type="text" name="address" class="form-control" value ="{{ old('address') }}" required>
                </div>
                 <div class="form-group">
                    <label for="phone">Telefono / Movil</label>
                    <input type="text" name="phone" class="form-control" value ="{{ old('phone') }}" required>
                </div>
                 {{-- a medida que se crean mas servicios se crean campos  --}}


                <button type="submit" class="btn btn-sm btn-primary">Crear Cliente</button>
            </form>

        </div>
    </div>
@endsection
