@extends('welcome')

@section('contenido')
  <div class="content-wrapper">
    <section class="content-header">
      <h1> <i class="fa fa-id-card"></i><b> Carnet de Vacunas</b></h1>
      <h4><b>Mascota: </b> {{ $mascota->nombre }}</h4>
      <h4><b>Dueño: </b>{{ $mascota->DUEÑO->nombre }}</h4>
    </section>

    <section class="content">h4
      <b>
      </b>
      <div class="box">

        <div class="box-body">
          <button class="btn btn-primary" data-toggle="modal" data-target="#AgregarVacuna">Agregar Vacuna</button>

          <a href="{{ url('Carnet-Vacunas-PDF/' . $mascota->id) }}" target="_blank">
            <button type="button" class="btn btn-warning">Generar PDF</button>
          </a>
        </div>
        <table class="table table-bordered table-hover table-striped dt-responsive">
          <thead>
            <tr>
              <th>Vacuna</th>
              <th>Veterinario</th>
              <th>Fecha de Aplicacion</th>
              <th>Proxima Fecha</th>
            </tr>
          </thead>

          <tbody>
            @foreach ($vacunas as $vacuna)
              <tr>
                <td>{{ $vacuna->vacuna }}</td>
                <td>{{ $vacuna->VETERINARIO->name }}</td>
                <td>{{ $vacuna->fecha }}</td>

                @if ($vacuna->prox_fecha == 'Fin')
                  <td> - </td>
                @else
                  <td>{{ $vacuna->prox_fecha }}</td>
                @endif
            @endforeach

          </tbody>

        </table>

      </div>

    </section>

  </div>



  <div id="AgregarVacuna" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="POST">
          @csrf
          <div class="modal-body">
            <div class="box-body">

              @if (auth()->user()->rol != 'Veterinario')
                <div class="form-group">
                  <h2>Veterinario:</h2>
                  <select class="form-control select2 " name="id_veterinario" required style="width: 100%">
                    <option value="">Seleccione un Veterinario</option>
                    @foreach ($veterinarios as $veterinario)
                      <option value="{{ $veterinario->id }}">{{ $veterinario->name }}</option>
                    @endforeach
                  </select>
                </div>
              @else
                <input type="hidden" name="id_veterinario" value="{{ auth()->user()->id }}">
              @endif

              <div class="form-group">
                <h2>Vacuna:</h2>
                <input type="text" class="form-control" name="vacuna" required>
              </div>


              <div class="form-group">
                <h2>Fecha de Aplicacion:</h2>
                <input type="date" class="form-control" name="fecha" required>
              </div>

              <div class="form-group">
                <h2>Proxima Aplicacion:</h2>
                <input type="date" class="form-control" name="prox_fecha">
              </div>

            </div>

          </div>

          <div class="modal-footer">
            <button class="btn btn-primary" type="submit">Agregar</button>
            <button class="btn btn-danger" type="button" data-dismiss="modal">Cerrar</button>
          </div>

        </form>

      </div>

    </div>

  </div>
@endsection
