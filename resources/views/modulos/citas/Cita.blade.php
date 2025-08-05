@extends('welcome')

@section('contenido')
    <div class="content-wrapper">
        <section class="content-header">

            <div class="row">

                <div class="col-md-3">
                    <h3><b>{{ $cita->inicio }}</b></h3>
                </div>

                <div class="col-md-3">
                    <h3>Dueño:<b>{{ $cliente->nombre }}</b></h3>
                </div>

                <div class="col-md-3">
                    <h3>Mascota:<b>{{ $mascota->nombre }}</b></h3>
                </div>

                <div class="col-md-3">

                    @if ($cita->estado == 'En Proceso')
                        <h3> <button class="btn btn-warning">En Proceso</button></h3>
                        <form method="POST" action="{{ url('Finalizar-Cita/' . $cita->id) }}">
                            @csrf
                            <button type="submit" class="btn btn-danger">finalizar</button>
                        </form>
                    @else
                        <h3> <button class="btn btn-danger">Finalizada</button></h3>
                    @endif

                </div>


            </div>
        </section>

        <section class="content">
            <div class="box">
                <div class="box-body">

                    <a href="{{ url('Historial/' . $cita->id_mascota) }}">
                        <button class="btn btn-primary">Ver Historial Completo</button>
                    </a>


                    @if ($internacion == null)
                        <button class="btn btn-warning" data-toggle="modal" data-target="#Internar">Internar</button>
                    @else
                        <a href="{{ url('Internacion/' . $internacion->id) }}">
                            <button class="btn btn-warning"> Ver Internacion</button>

                        </a>
                    @endif


                    @if ($receta == null)
                        <button class="btn btn-info pull-right " data-toggle="modal" data-target="#Receta">Receta</button>
                    @else
                        <a href="{{ url('Receta-PDF/' . $receta->id) }}" target="_blank">
                            <button class="btn btn-default pull-right">Generar PDF</button>
                        </a>

                        <button class="btn btn-info pull-right " data-toggle="modal"
                            data-target="#RecetaEditar">Receta</button>
                    @endif

                    @if ($historial == '')
                        <form method="POST">
                            @csrf
                            <input type="hidden" name="tipo" value="Agregar">

                            <h2>Nota</h2>
                            <textarea name="nota" id="editor"></textarea>
                            <br>

                            <button class="btn btn-success" type="submit">Guardar en el Historial</button>
                        </form>
                    @else
                        <form method="POST">
                            @csrf
                            <input type="hidden" name="tipo" value="Actualizar">

                            <h2>Nota</h2>
                            <textarea name="nota" id="editor">
                                {{ $historial->nota }}
                            </textarea>
                            <br>

                            <button class="btn btn-success" type="submit">Guardar en el Historial</button>
                        </form>

                        <hr>
                        <h2>Imaganes</h2>
                        <form method="POST" enctype="multipart/form-data"
                            action="{{ url('Cita-Historial-Imagen/' . $historial->id_cita) }}">
                            @csrf
                            @method('PUT')
                            <input type="file" name="imagenH" multiple>
                            <button class="btn btn-primary" type="submit">Subir</button>

                        </form>

                        <br>
                        @foreach ($imagenes as $imagen)
                            <div class="col-md-3">
                                <form method="POST" action="{{ url('Cita-Historial-Imagen-Borrar/' . $imagen->id) }}">
                                    @csrf
                                    @method('delete')
                                    <a href="{{ url('storage/' . $imagen->imagen) }}" target="_blank">
                                        <img src="{{ url('storage/' . $imagen->imagen) }}" width="150px">
                                    </a>
                                    <button class="btn btn-danger" type="submit"><i class="fa fa-times"></i></button>
                                </form>

                            </div>
                        @endforeach
                    @endif
                </div>

            </div>

        </section>

    </div>


    <div class="modal fade" id="Receta">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ url('Receta/' . $cita->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="box-body">
                            <div class="form-group">
                                <h2>Receta:</h2>
                                <input type="hidden" name="tipo" value="Crear">
                                <textarea name="receta" id="editor2" required></textarea>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">Crear</button>
                        <button class="btn btn-danger" type="button" data-dismiss="modal">Cerrar</>

                    </div>
                </form>
            </div>
        </div>
    </div>

    @if ($receta != null)
        <div class="modal fade" id="RecetaEditar">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ url('Receta/' . $cita->id) }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="box-body">
                                <div class="form-group">
                                    <h2>Receta:</h2>
                                    <input type="hidden" name="tipo" value="Actualizar">
                                    <textarea name="receta" id="editor3" required>{{ $receta->receta }}</textarea>

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="submit">Crear</button>
                            <button class="btn btn-danger" type="button" data-dismiss="modal">Cerrar</>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif


    <div class="modal fade" id="Internar">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ url('Internar/' . $cita->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="box-body">
                            <div class="form-group">
                                <h2>Fecha de Internacion:</h2>
                                @php
                                    $zona = $ajustes->zona_horaria ?? 'America/La_Paz';
                                    $zonaValida = in_array($zona, timezone_identifiers_list())
                                        ? $zona
                                        : 'America/La_Paz';
                                    date_default_timezone_set($zonaValida);
                                    $fechaHoy = date('Y/m/d');
                                @endphp

                                <input class="form-control" type="text" name="fecha_inicio"
                                    value="{{ $fechaHoy }}" required>

                            </div>

                            <div class="form-group">
                                <h2>Motivo de Internacion:</h2>

                                <input class="form-control" type="text" name="motivo" value="" required>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-warning" type="submit">Internar</button>
                        <button class="btn btn-danger" type="button" data-dismiss="modal">Cerrar</>

                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
