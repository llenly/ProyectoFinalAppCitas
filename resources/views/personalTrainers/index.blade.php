@extends('layouts.panel')

@section('content')
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">PersonalTrainer</h3>
                </div>
                <div class="col text-right">
                    <a href="{{ url('/personalTrainers/create') }}" class="btn btn-sm btn-primary">Nuevo PersonalTrainer</a>
                </div>
            </div>
        </div>
        {{-- mensaje para mostrar la notificacion que viene del controller en el metodo sendData --}}
        <div class="card-body">
        @if (session('notificacion'))
            <div class="alert alert-success" role="alert">
              {{ session('notificacion') }}
            </div>
        @endif
        
        </div>

        <div class="table-responsive">
            <!-- Projects table -->
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Cedula</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- mostrar los servicios que vienen del metodo sendData de la vista create servicios, inyectados en el controller en la vista  y metodo index --}}

                    @foreach ($persontrains as $persontrain)
                        <tr>
                            <th scope="row">
                                {{ $persontrain->name }}
                            </th>
                            <td>
                                {{ $persontrain->email }}
                            </td>
                            <td>
                                {{ $persontrain->cedula }}
                            </td>
                            {{-- <td>
                                precio
                            </td> --}}
                            <td>

                                <form action="{{ url('/personalTrainers/' . $persontrain->id) }}" method='POST'>
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ url('/personalTrainers/' . $persontrain->id . '/edit') }}"
                                        class="btn btn-sm btn-primary">Editar</a>
                                    <button type="submit" class="btn btn-sm btn-danger">Eliminar</a>
                                </form>

                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>

        <div class="card-body">
        {{  $persontrains->links() }}
        </div>
    </div>
@endsection
