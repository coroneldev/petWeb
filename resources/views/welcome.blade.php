<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> | COMVET - LP |</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <!-- Estilos -->
  <link rel="stylesheet" href="{{ url('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ url('bower_components/font-awesome/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ url('bower_components/Ionicons/css/ionicons.min.css') }}">
  <link rel="stylesheet" href="{{ url('dist/css/AdminLTE.min.css') }}">
  <link rel="stylesheet" href="{{ url('dist/css/skins/_all-skins.min.css') }}">
  <link rel="stylesheet" href="{{ url('bower_components/morris.js/morris.css') }}">
  <link rel="stylesheet" href="{{ url('bower_components/jvectormap/jquery-jvectormap.css') }}">
  <link rel="stylesheet" href="{{ url('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
  <link rel="stylesheet" href="{{ url('bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
  <link rel="stylesheet" href="{{ url('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ url('bower_components/datatables.net-bs/css/responsive.bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ url('bower_components/select2/dist/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ url('bower_components/fullcalendar/dist/fullcalendar.min.css') }}">
  <link rel="stylesheet" href="{{ url('bower_components/fullcalendar/dist/fullcalendar.print.min.css') }}" media="print">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-green sidebar-mini login-page">

  @if (Auth::user())
    <div class="wrapper">
      @include('modulos.cabecera')
      @include('modulos.menu')
      @yield('contenido')
    </div>
  @else
    @yield('ingresar')
  @endif

  <!-- Scripts -->
  <script src="{{ url('bower_components/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ url('bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
  <script>
    $.widget.bridge('uibutton', $.ui.button);
  </script>
  <script src="{{ url('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
  <script src="{{ url('bower_components/raphael/raphael.min.js') }}"></script>
  <script src="{{ url('bower_components/morris.js/morris.min.js') }}"></script>
  <script src="{{ url('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
  <script src="{{ url('bower_components/jquery-knob/dist/jquery.knob.min.js') }}"></script>
  <script src="{{ url('bower_components/moment/min/moment.min.js') }}"></script>
  <script src="{{ url('bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
  <script src="{{ url('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ url('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
  <script src="{{ url('bower_components/fastclick/lib/fastclick.js') }}"></script>
  <script src="{{ url('dist/js/adminlte.min.js') }}"></script>
  <script src="{{ url('dist/js/pages/dashboard.js') }}"></script>
  <script src="{{ url('dist/js/demo.js') }}"></script>
  <script src="{{ url('bower_components/input-mask/jquery.inputmask.js') }}"></script>
  <script src="{{ url('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ url('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
  <script src="{{ url('bower_components/datatables.net-bs/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ url('bower_components/select2/dist/js/select2.min.js') }}"></script>
  <script src="{{ url('bower_components/fullcalendar/dist/fullcalendar.min.js') }}"></script>
  <script src="{{ url('bower_components/fullcalendar/dist/locale/es.js') }}"></script>
  <script src="{{ url('bower_components/ckeditor/ckeditor.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    $(".sidebar-menu").tree();
    $("[data-mask]").inputmask();
    $(".table").DataTable({
      "ordering": false,
      "language": {
        "sSearch": "Buscar:",
        "sEmptyTable": "No hay datos en la Tabla",
        "sZeroRecords": "No se encontraron resultados",
        "sInfo": "Mostrando registros del _START_ al _END_ de un total _TOTAL_",
        "SInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
        "sInfoFiltered": "(filtrando de un total de _MAX_ registros)",
        "oPaginate": {
          "sFirst": "Primero",
          "sLast": "Último",
          "sNext": "Siguiente",
          "sPrevious": "Anterior"
        },
        "sLoadingRecords": "Cargando...",
        "sLengthMenu": "Mostrar _MENU_ registros"
      }
    });
    $(".select2").select2();
    CKEDITOR.replace('editor');
    CKEDITOR.replace('editor2');
  </script>

  <script>
    @if (Session('UsuarioCreado') == 'OK')
      Swal.fire('El Usuario ha sido Creado', '', 'success')
    @elseif (Session('UsuarioActualizado') == 'OK')
      Swal.fire('El Usuario ha Actualizado', '', 'success')
    @elseif (Session('ClienteAgreagado') == 'OK')
      Swal.fire('El Cliente ha sido Agregado', '', 'success')
    @elseif (Session('ClienteActualizado') == 'OK')
      Swal.fire('El Cliente ha sido Actualizado', '', 'success')
    @elseif (Session('MascotaAgregada') == 'OK')
      Swal.fire('La Mascota ha sido Agregada', '', 'success')
    @elseif (Session('MascotaActualizada') == 'OK')
      Swal.fire('La Mascota ha sido Actualizada', '', 'success')
    @elseif (Session('VacunaAgregada') == 'OK')
      Swal.fire('La Vacuna ha sido Agregada', '', 'success')
    @elseif (Session('VeterinarioCreado') == 'OK')
      Swal.fire('El Veterinario ha sido Creado', '', 'success')
    @endif
  </script>

  {{-- Mostrar modales según la URL --}}
  @if (Request::segment(3) === 'Editar-Usuario')
    <script>
      $('#EditarUsuario').modal('toggle');
    </script>
  @elseif (Request::segment(3) === 'Editar-Mascota')
    <script>
      $('#EditarMascota').modal('toggle');
    </script>
  @endif

  <script>
    $(".table").on('click', '.EliminarUsuario', function () {
      var Uid = $(this).attr('Uid');
      var usuario = $(this).attr('usuario');
      Swal.fire({
        title: 'Seguro que desea Eliminar el Usuario : ' + usuario + '?',
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Eliminar',
        confirmButtonColor: '#3085d6'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location = 'Eliminar-Usuario/' + Uid;
        }
      });
    });

    $(".table").on('click', '.EliminarMascota', function () {
      var Mid = $(this).attr('Mid');
      var mascota = $(this).attr('mascota');
      Swal.fire({
        title: 'Seguro que desea Eliminar la Mascota : ' + mascota + '?',
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Eliminar',
        confirmButtonColor: '#3085d6'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location = 'Eliminar-Mascota/' + Mid;
        }
      });
    });
  </script>

  <script>
    $('#calendario').fullCalendar({
      defaultView: 'agendaWeek',
      hiddenDays: [0, 6],
      scrollTime: '09:00',
      minTime: '09:00',
      maxTime: '18:00'
    });
  </script>

</body>

</html>
