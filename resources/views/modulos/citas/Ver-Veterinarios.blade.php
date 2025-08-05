@extends('welcome')

@section('contenido')
  <div class="content-wrapper">
    <section class="content-header">
      <h1> <i class="fa fa-user-md"> </i> Veterinarios</h1>
    </section>

    <section class="content">
      <div class="box">

        <div class="box-header">
          <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#CrearVeterinario"><i
              class="fa fa-plus"></i>
            Crear Veterinario
          </button>
        </div>

        <div class="box-body">
          <table class="table table-bordered table-hover table-striped dt-responsive">
            <thead>
              <tr>

                <th>Veterinario</th>
                <th>Email</th>
                <th>Foto</th>
                <th>Estado</th>

                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($veterinarios as $veterinario)
                <tr>
                  <td>{{ $veterinario->name }}</td>
                  <td>{{ $veterinario->email }}</td>
                  @if ($veterinario->foto == '')
                    <td> <img src="{{ url('storage/defecto.png') }}" width="50px"></td>
                  @else
                    <td> <img src="{{ url('storage/' . $veterinario->foto) }}" width="50px">
                    </td>
                  @endif


                  @if ($veterinario->estado == 'Disponible')
                    <td>
                      <form action="{{ url('Estado/' . $veterinario->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="estado" value="No Disponible">
                        <button type="submit" class="btn btn-success">Disponible</button>
                      </form>
                    </td>
                  @else
                    <td>
                      <form action="{{ url('Estado/' . $veterinario->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="estado" value="Disponible">
                        <button type="submit" class="btn btn-danger">No Disponible</button>
                      </form>
                    </td>
                  @endif


                  <td>

                    <a href="{{ url('Citas-Hoy/' . $veterinario->id) }}">
                      <button class="btn btn-warning">Ver Citas Hoy</button>
                    </a>

                    <a href="{{ url('Calendario/' . $veterinario->id) }}">
                      <button class="btn btn-primary">Ver Agenda Completa</button>
                    </a>


                  </td>
                </tr>
              @endforeach
            </tbody>


          </table>

        </div>

      </div>

    </section>

  </div>




  <div id="CrearVeterinario" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="POST">
          @csrf
          <div class="modal-body">

            <div class="box-body">

              <div class="form-group">
                <h2>Nombre y Apellido</h2>
                <input type="text" class="form-control " name="name" value="{{ old('name') }}" required>
              </div>


              <input type="hidden" class="form-control " name="rol" value="Veterinario" required>


              <div class="form-group">
                <h2>Email</h2>
                <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                @error('email')
                  <div class="alert alert-danger">El Email ya Existe</div>
                @enderror
              </div>

              <div class="form-group">
                <h2>Contraseña</h2>
                <input type="text" class="form-control" name="password" value="{{ old('password') }}" required>

                @error('password')
                  <div class="alert alert-danger">La Contraseña debe Tener al Menos 3 caractetes</div>
                @enderror
              </div>

            </div>

          </div>


          <div class="modal-footer">
            <button class="btn btn-primary" type="submit">Crear</button>
            <button class="btn btn-danger" type="button" data-dismiss="modal">Cerrar</button>
          </div>

        </form>

      </div>

    </div>

  </div>
@endsection
