@extends('welcome')

@section('contenido')
  <div class="content-wrapper">
    <section class="content-header">

      <h2><b>Veterinario: {{ $veterinario->name }}</b></h2>

      @if ($veterinario->estado == 'Disponible')
        <h2>Estado: <button class="btn btn-success">Disponible</button></h2>
      @else
        <h2>Estado: <button class="btn btn-danger">No Disponible</button></h2>
      @endif
    </section>

    <section class="content">
      <div class="box">
        <div class="box-body">
          <div id="calendario"></div>

        </div>

      </div>

    </section>

  </div>



  <div id="CitaModal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="POST" action="{{ url('Calendario/' . $veterinario->id) }}">
          @csrf
          <div class="modal-body">

            <div class="box-body">

              <input type="hidden" class="form-control " name="id_veterinario" value="{{ $veterinario->id }}" required>

              <div class="form-group">
                <h2>Cliente:</h2>
                <select class="form-control select2" name="id_cliente" id="cliente" style="width: 100%"
                  url="{{ url('') }}" required>
                  <option value="">Seleccionar..</option>

                  @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id }}">{{ $cliente->nombre }} -
                      {{ $cliente->documento }}></option>
                  @endforeach

                </select>

              </div>

              <div class="form-group">
                <h2>Mascota:</h2>
                <select class="form-control" name="id_mascota" id="mascota"></select>
              </div>

              <div class="form-group">
                <h2>Fecha:</h2>
                <input type="text" class="form-control" id="fecha" readonly>
              </div>

              <div class="form-group">
                <h2>Hora:</h2>
                <input type="text" class="form-control" id="hora" readonly>
              </div>

              <input type="hidden" name="inicio" id="fyhInicial">
              <input type="hidden" name="fin" id="fyhFinal">

              <div class="form-group">
                <h2>Nota:</h2>
                <textarea name="nota" id="editor"></textarea>
              </div>


            </div>

          </div>


          <div class="modal-footer">
            <button class="btn btn-primary" type="submit">Agendar Cita</button>
            <button class="btn btn-danger" type="button" data-dismiss="modal">Cerrar</button>
          </div>

        </form>

      </div>

    </div>

  </div>




  <div id="CancelarCita" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="POST" action="{{ url('Cancelar-Cita') }}">

          @csrf
          @method('delete')
          <div class="modal-body">

            <div class="box-body">

              <div class="form-group">
                <h2>Paciente:</h2>

                <h3 id="paciente"></h3>

                <input type="hidden" name="id_cita" id="citaId">
              </div>

            </div>

          </div>

          <div class="modal-footer">
            <button class="btn btn-warning" type="submit">Cancelar Cita</button>
            <button class="btn btn-danger" type="button" data-dismiss="modal">Cerrar</button>
          </div>

        </form>
      </div>
    </div>
  </div>
@endsection
