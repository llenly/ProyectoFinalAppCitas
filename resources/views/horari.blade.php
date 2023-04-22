@extends('layouts.panel')

@section('content')
    {{-- ruta para guardar la ruta del archivo horario --}}
    <form action="{{ url('/horario') }}" method="POST">
        @csrf

        <div class="card shadow">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">Gestionar Horario</h3>
                    </div>
                    <div class="col text-right">
                        <button type="submit" class="btn btn-sm btn-primary">Guardar Cambios</button>
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
                {{-- mostrar mensaje de notificacion de error  --}}
                @if (session('erros'))
                    <div class="alert alert-danger" role="alert">
                        Los cambios estan guardados pero se encontraron las siguientes novedades:
                        <ul>
                            @foreach (sessions('errors') as $error)
                                <li> {{ $error }}</li>
                            @endforeach
                        </ul>
                        {{ session('notificacion') }}
                    </div>
                @endif

            </div>

            <div class="table-responsive">
                <!-- Projects table -->
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Dia</th>
                            <th scope="col">Activo</th>
                            <th scope="col">Turno Mañana</th>
                            <th scope="col">Turno Tarde</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>

            @foreach ($horarios as $key->$horario)
            <?php  echo($days);?>
                <tr>
                    {{-- se pone en days la posicion que tiene le dia en la var key --}}
                    <th>{{ $days[$key] }}</th>
                    <td>
                        <label class="custom-toggle">
                            {{-- $key var que guarda posicion de los dias  --}}
                            <input type="checkbox" name="active[]" value{{ $key }}
                                @if ($horario->active) checked> @endif <span
                                class="custom-toggle-slider rounded-circle"></span>
                        </label>
                    </td>

                    <td>
                        {{-- seleccionar las horas para la citas conun for DE LA MAÑNA --}}
                        <div class="row">
                            <div class="col">
                                <select class="form-control" name="morning_start[]">
                                    @for ($i = 8; $i <= 11; $i++)
                                        <option value="{{ ($i < 10 ? '0' : '') . $i }}: 00">{{ $i }}:00 AM
                                            {{-- compara los formatos de fechas y poner el valido que se ha configurado en el metod controller --}}
                                            @if ($i . ':00 AM' == $horario->morning_start)
                                                selected
                                            @endif>
                                            {{ $i }}:00 AM
                                        </option>

                                        <option value="{{ ($i < 10 ? '0' : '') . $i }}: 50">{{ $i }}:50 AM
                                            {{-- compara los formatos de fechas y poner el valido que se ha configurado en el metod controller --}}
                                            @if ($i . ':50 AM' == $horario->morning_start)
                                                selected
                                            @endif>
                                            {{ $i }}:50 AM
                                        </option>
                                    @endfor

                                </select>
                            </div>

                            <div class="col">
                                <select class="form-control" name="morning_end[]">
                                    @for ($i = 8; $i <= 11; $i++)
                                        <option value="{{ ($i < 10 ? '0' : '') . $i }}:00">{{ $i }}:00 AM
                                            {{-- compara los formatos de fechas y poner el valido que se ha configurado en el metod controller --}}
                                            @if ($i . ':00 AM' == $horario->morning_end)
                                                selected
                                            @endif>
                                            {{ $i }}:00 AM
                                        </option>

                                        </option>
                                        <option value="{{ ($i < 10 ? '0' : '') . $i }}:50 ">{{ $i }}:50 AM
                                            {{-- compara los formatos de fechas y poner el valido que se ha configurado en el metod controller --}}
                                            @if ($i . ':50 AM' == $horario->morning_end)
                                                selected
                                            @endif>
                                            {{ $i }}:50 AM
                                        </option>
                                    @endfor

                                </select>
                            </div>
                        </div>
                    </td>

                    <td>
                        {{-- seleccionar las horas para la citas DE LA TARDE con un for  --}}
                        <div class="row">
                            <div class="col">
                                <select class="form-control" name="afternoon_start[]">
                                    @for ($i = 2; $i <= 11; $i++)
                                        <option value="{{ $i + 12 }}:00">{{ $i }}:00 PM
                                            {{-- compara los formatos de fechas y poner el valido que se ha configurado en el metod controller --}}
                                            @if ($i . ':00 AM' == $horario->afternoon_start)
                                                selected
                                            @endif>
                                            {{ $i }}:00 AM

                                        </option>
                                        <option value="{{ $i + 12 }}:50">{{ $i }}:50 PM
                                            {{-- compara los formatos de fechas y poner el valido que se ha configurado en el metod controller --}}
                                            @if ($i . ':50 AM' == $horario->afternoon_start)
                                                selected
                                            @endif>
                                            {{ $i }}:50 AM

                                        </option>
                                    @endfor

                                </select>
                            </div>

                            <div class="col">
                                <select class="form-control" name="afternoon_end[]">
                                    {{-- el +12 es por que solo aacepta el formato de 24h --}}
                                    @for ($i = 2; $i <= 11; $i++)
                                        <option value="{{ $i + 12 }}:00">{{ $i }}:00 PM
                                            {{-- compara los formatos de fechas y poner el valido que se ha configurado en el metod controller --}}
                                            @if ($i . ':00 AM' == $horario->afternoon_end)
                                                selected
                                            @endif>
                                            {{ $i }}:00 AM
                                        </option>
                                        <option value="{{ $i + 12 }}:50">{{ $i }}:50 PM
                                            @if ($i . ':50 AM' == $horario->afternoon_end)
                                                selected
                                            @endif>
                                            {{ $i }}:50 AM
                                        </option>
                                    @endfor

                                </select>
                            </div>
                        </div>
                    </td>

                </tr>
            @endforeach
        </div>
    </form>
@endsection
