@extends('welcome')

@section('contenido')
  <div class="content-wrapper">
    <section class="content-header">
      <h2><i class="fa fa-user-plus"></i> Gestor de Clientes</h2>
    </section>

    <section class="content">
      <div class="box">
        <div class="box-header">
          <a href="{{ url('Crear-Cliente') }}">
            <button class="btn btn-primary btn-lg"><i class="fa fa-plus"></i> Agregar Cliente</button>
          </a>

        </div>
        <div class="box-body">

          <table class="table table-bordered table-hover table-striped dt-responsive">
            <thead>
              <tr>
                <th>Cliente:</th>
                <th>Documento:</th>
                <th>Email:</th>
                <th>Telefono:</th>
                <th>Direccion:</th>

                <th></th>
              </tr>
            </thead>

            <tbody>
              @foreach ($clientes as $cliente)
                <tr>
                  <td>{{ $cliente->nombre }}</td>
                  <td>{{ $cliente->documento }}</td>
                  <td>{{ $cliente->email }}</td>
                  <td>{{ $cliente->telefono }}</td>
                  <td>{{ $cliente->direccion }}</td>


                  <td>
                    <a href="{{ url('Editar-Cliente/' . $cliente->id) }}">
                      <button class="btn btn-success"><i class="fa fa-pencil"></i> Editar</button>
                    </a>

                    <a href="{{ url('Ver-Mascotas/' . $cliente->id) }}">
                      <button class="btn btn-warning"><i class="fa fa-eye"></i> Ver Mascotas</button>

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
@endsection
