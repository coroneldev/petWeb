@extends('welcome')

@section('contenido')
  <div class="content-wrapper">
    <section class="content-header">
      <h2><i class="fa fa-home"></i> Inicio</h2>
    </section>

    <section class="content">
      <div class="box">
        <div class="box-body">
          @if (auth()->user()->rol == 'Administrador')
            <form method="post" enctype="multipart/form-data">
              @csrf

              <div class="col-md-3">
                <h2>Logo</h2>
                <input type="file" class="form-control" name="logo">
                <img src="{{ url('storage/logo.png') }}" width="150px">
              </div>

              <div class="col-md-3">
                <h2>Telefono</h2>
                <input type="text" class="form-control" name="telefono" required data-inputmask="'mask': '  999-99999'"
                  data-mask value="{{ $ajustes->telefono }}">
              </div>

              <div class="col-md-3">
                <h2>Direccion</h2>
                <input type="text" class="form-control" name="direccion" value="{{ $ajustes->direccion }}">
              </div>

              <div class="col-md-3">
                <h2>Moneda</h2>
                <input type="text" class="form-control" name="moneda" value="{{ $ajustes->moneda }}"">
              </div>

              <div class="col-md-3">
                <h2>Zona Horaria</h2>

                <select name="zona_horaria" class="form-control">

                  <option value="{{ $ajustes->zona_horaria }}">{{ $ajustes->zona_horaria }}</option>

                  <option value="America/Monterrey">America/Monterrey</option>
                  <option value="America/Mexico_City">America/Mexico_City</option>
                  <option value="America/Lima">America/Lima</option>
                </select>
              </div>


              <div class="col-md-3 text-center pull-right">
                <br>
                <br><br>
                <button type="submit" class="btn btn-primary">Guardar</button>
              </div>

            </form>
          @endif
        </div>
      </div>
    </section>
  </div>
@endsection
