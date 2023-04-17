@extends('layouts.panel')

@section('content')
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Editar Servicio</h3>
                </div>
                <div class="col text-right">
                    <a href="{{ url('/servicios') }}" class="btn btn-sm btn-success"><i
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





          <form action="{{ (url('/servicios/'.$servicios->id)) }}" method="POST">
            @csrf

            {{-- //sacar y mostrar los datos a editar --}}

             @method('PUT')

                <div class="form-group">
                    <label for="nombre">Nombre del Servicio</label>
                    <input type="text" name="nombre" class="form-control" value ="{{ old('nombre', $servicios->nombre) }}" required>
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripcion del Servicio</label>
                    <input type="text" name="descripcion" class="form-control" value ="{{ old('descripcion',$servicios->descripcion) }}" required>
                </div>
                 <div class="form-group">
                    <label for="precio">Precio del Servicio</label>
                    <input type="text" name="precio" class="form-control" value ="{{ old('precio',$servicios->precio ) }}" required>
                </div>
                 {{-- a medida que se crean mas servicios se crean campos  --}}


                <button type="submit" class="btn btn-sm btn-primary">Guardar Servicio </button>
            </form>

        </div>
    </div>
@endsection
