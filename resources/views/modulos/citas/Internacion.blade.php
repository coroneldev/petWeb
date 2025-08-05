@extends('welcome')

@section('contenido')
    <div class="content-wrapper">
        <section class="content-header">
            <h1> <i class="fa fa-hospital-o"></i>Internacion de la Mascota: <b>{{ $internacion->MASCOTA->nombre }} -
                    {{ $internacion->MASCOTA->edad }} Años</b></h1>
        </section>

        <section class="content">
            <div class="box">
                <div class="box-body">

                    <div class="col-md-5">
                        <h3 class="pull-left">Motivo de la Internacion:
                            <b>{{ $internacion->motivo }}</b>
                        </h3>

                    </div>



                    @if ($internacion->fecha_alta != 0)
                        <div class="col-md-4">
                            <h4 class="pull-left">Fecha de Internacion: <b>{{ $internacion->fecha_inicio }}</b><br>Fecha de
                                Alta: <b>{{ $internacion->fecha_alta }}</b></h4>
                        </div>
                    @else
                        <div class="col-md-4">
                            <h4 class="pull-left">Fecha de Internacion: <b>{{ $internacion->fecha_inicio }}</b><br>Fecha de
                                Alta: <b>Sin Alta</b></h4>
                        </div>

                        <div class="col-md-2">
                            <form method="POST" action="{{ url('DarAlta/' . $internacion->id) }}">
                                @csrf

                                @php
                                    $zona = $ajustes->zona_horaria ?? 'America/La_Paz';
                                    $zonaValida = in_array($zona, timezone_identifiers_list())
                                        ? $zona
                                        : 'America/La_Paz';
                                    date_default_timezone_set($zonaValida);
                                    $fechaHoy = date('Y/m/d');
                                @endphp
                                <input type="hidden" name="fecha_alta" value="{{ $fechaHoy }}">
                                <button class="btn btn-warning btn-sm pull-right" type="submit">Dar de Alta</button>
                            </form>
                        </div>
                    @endif

                </div>
                <div class="col-md-12">
                    <hr>
                    <h3>Expediente:</h3>

                    <form method="POST">
                        @csrf
                        <textarea name="expediente" id="editor" required>

                                {{ $internacion->expediente }}

                            </textarea>

                        <button class="btn btn-primary" type="submit">Guardar Expediente</button>
                    </form>

                </div>

            </div>

    </div>

    </section>

    </div>
@endsection
