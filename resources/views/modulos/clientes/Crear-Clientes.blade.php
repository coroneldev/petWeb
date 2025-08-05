@extends('welcome')

@section('contenido')
  <div class="content-wrapper">
    <section class="content-header">
      <h2><i class="fa fa-user-plus"></i> Agregar Nuevo Cliente</h2>
    </section>

    <section class="content">
      <div class="box">

        <div class="box-body">
          <form method="post">
            @csrf

            <div class="form-group">
              <h2>Nombre y Apellido:</h2>
              <input type="text" class="input-lg" placeholder="Nombre y Apellido" name="nombre" required
                value="{{ old('name') }}">
            </div>

            <div class="form-group">
              <h2>Documento:</h2>
              <input type="text" class="input-lg" placeholder="C.I." name="documento" required
                value="{{ old('documento') }}">

              @error('documento')
                <div class="alert alert-danger" role="alert">El Documento ya se encuentra Registrado</div>
              @enderror
            </div>

            <div class="form-group">
              <h2>Email:</h2>
              <input type="text" class="input-lg" placeholder="Email" name="email" required
                value="{{ old('email') }}">

              @error('email')
                <div class="alert alert-danger" role="alert">El Email ya se encuentra Registrado</div>
              @enderror

            </div>

            <div class="form-group">
              <h2>Telefono:</h2>
              <input type="text" class="input-lg" placeholder="Telefono" name="telefono" required
                value="{{ old('telefono') }}">
            </div>

            <div class="form-group">
              <h2>Direccion:</h2>
              <input type="text" class="input-lg" placeholder="Direccion" name="direccion" required
                value="{{ old('direccion') }}">
            </div>|

            <button type="submit" class="btn btn-primary">Agregar</button>


          </form>

        </div>

      </div>

    </section>
  </div>
@endsection
