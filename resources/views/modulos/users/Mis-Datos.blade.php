@extends('welcome')

@section('contenido')
  <div class="content-wrapper">
    <section class="content-header">
      <h2><i class="fa fa-user-circle"></i> Gestor de Perfil</h2>
    </section>

    <section class="content">
      <div class="box">
        <div class="box-body">

          <form method="post" enctype="multipart/form-data">
            @csrf
            @method('put')

            <div class="row">

              <div class="col-md-6 col-xs-12">
                <h2>Nombre:</h2>
                <input type="text" class="input-lg" name="name" value="{{ auth()->user()->name }}" required>

                <h2>Email:</h2>
                <input type="text" class="input-lg" name="email" value="{{ auth()->user()->email }}" required>

                @error('email')
                  <p class="alert alert-danger"> El Email ya Existe</p>
                @enderror

              </div>

              <div class="col-md-6 col-xs-12">
                <h2>Contraseña:</h2>
                <input type="text" class="input-lg" name="password">

                @error('email')
                  <p class="alert alert-danger"> el Correo debe Tener al Menos 3 Caracteres</p>
                @enderror

                <h2>Foto Perfil:</h2>
                <hr>
                <input type="file" name="fotoPerfil">
                <br>
                @if (auth()->user()->foto == '')
                  <img src="{{ url('storage/defecto.png') }}" width="150px" height="150px">
                @else
                  <img src="{{ url('storage/' . auth()->user()->foto) }}" width="150px" height="150px">
                @endif
              </div>

            </div>

            <div class="box-footer">
              <button type="submit" class="btn btn-success pull-right">Guardar</button>
            </div>

          </form>

        </div>

      </div>

    </section>
  </div>
@endsection
