@extends('welcome')

@section('contenido')
  <div class="content-wrapper">
    <section class="content-header">
      <h2><i class="fa fa-users"></i> Gestor de Usuarios</h2>
    </section>

    <section class="content">
      <div class="box">

        <div class="box-header">
          <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#CrearUsuario"><i class="fa fa-plus"></i>
            Agregar Usuario</button>
        </div>

        <div class="box-body">

          <table class="table table-bordered table-hover table-striped dt-responsive">

            <thead>
              <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Email</th>
                <th>Foto</th>
                <th>Rol</th>

                <th></th>
              </tr>
            </thead>

            <tbody>
              @foreach ($users as $user)
                <tr>
                  <td>{{ $user->id }}</td>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->email }}</td>

                  <td>
                    @if ($user->foto != '')
                      <img src="{{ url('storage/' . $user->foto) }}" width="50px">
                    @else
                      <img src="{{ url('storage/defecto.png') }}" width="50px">
                    @endif
                  </td>

                  <td>{{ $user->rol }}</td>




                  <td>

                    <a href="{{ url('Editar-Usuario/' . $user->id) }}">
                      <button type="button" class="btn btn-success"><i class="fa fa-pencil"></i> Editar</button>
                    </a>

                    <button type="button" class="btn btn-danger EliminarUsuario" usuario="{{ $user->name }}"
                      Uid="{{ $user->id }}"><i class="fa fa-trash-o"></i>
                      Eliminar</button>

                  </td>

                </tr>
              @endforeach


            </tbody>
          </table>

        </div>
      </div>
    </section>
  </div>



  <div class="modal fade" id="CrearUsuario">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post">
          @csrf
          <div class="modal-body">
            <div class="box-body">

              <div class="form-group">
                <h2>Nombre y Apellido</h2>
                <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
              </div>

              <div class="form-group">
                <h2>Rol</h2>

                <select class="form-control" name="rol" required>

                  <option value="Selecccionar">Selecccionar</option>

                  <option value="Administrador">Administrador</option>
                  <option value="Veterinario">Veterinario</option>
                  <option value="Secretaria">Secretaria</option>


                </select>
              </div>

              <div class="form-group">
                <h2>Email:</h2>
                <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                @error('email')
                  <div class="alert alert-danger" role="alert">El Email ya existe</div>
                @enderror
              </div>

              <div class="form-group">
                <h2>Contraseña:</h2>
                <input type="text" class="form-control" name="password" value="{{ old('password') }}" required>
                @error('password')
                  <div class="alert alert-danger" role="alert">La Contraseña debe tener al menos 3 caracteres</div>
                @enderror
              </div>

            </div>
          </div>

          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Agregar</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>

          </div>
        </form>
      </div>
    </div>
  </div>


  @php
    $exp = explode('/', $_SERVER['REQUEST_URI']);
  @endphp

  @if ($exp[3] == 'Editar-Usuario')
    <div class="modal fade" id="EditarUsuario">
      <div class="modal-dialog">
        <div class="modal-content">

          <form method="post" action="{{ url('Actualizar-Usuario/' . $usuario->id) }}">

            @csrf
            @method('put')

            <div class="modal-body">
              <div class="box-body">

                <div class="form-group">
                  <h2>Nombre y Apellido</h2>
                  <input type="text" class="form-control" name="name" value="{{ $usuario->name }}" required>
                </div>

                <div class="form-group">
                  <h2>Rol</h2>

                  <select class="form-control" name="rol" required>

                    <option value="{{ $usuario->rol }}">{{ $usuario->rol }}</option>

                    @php
                      $roles = ['Administrador', 'Veterinario', 'Secretaria'];
                    @endphp

                    @foreach ($roles as $rol)
                      @if ($rol != $usuario->rol)
                        <option value="{{ $rol }}">{{ $rol }}</option>
                      @endif
                    @endforeach

                  </select>
                </div>

                <div class="form-group">
                  <h2>Email:</h2>
                  <input type="email" class="form-control" name="email" value="{{ $usuario->email }}" required>
                  @error('email')
                    <div class="alert alert-danger" role="alert">El Email ya existe</div>
                  @enderror
                </div>

                <div class="form-group">
                  <h2>Contraseña:</h2>
                  <input type="text" class="form-control" name="password" value="{{ old('password') }}">
                  @error('password')
                    <div class="alert alert-danger" role="alert">La Contraseña debe tener al menos 3 caracteres</div>
                  @enderror
                </div>

              </div>
            </div>

            <div class="modal-footer">
              <button type="submit" class="btn btn-success"> Guardar</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal"> Cancelar</button>

            </div>
          </form>
        </div>
      </div>
    </div>
  @endif
@endsection
