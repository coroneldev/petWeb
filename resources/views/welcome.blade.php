<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> | COMVET - LP |</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">


  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ url('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('bower_components/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ url('bower_components/Ionicons/css/ionicons.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('dist/css/AdminLTE.min.css') }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ url('dist/css/skins/_all-skins.min.css') }}">
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{ url('bower_components/morris.js/morris.css') }}">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{ url('bower_components/jvectormap/jquery-jvectormap.css') }}">
  <!-- Date Picker -->
  <link rel="stylesheet"
    href="{{ url('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ url('bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->


  <!-- DataTables -->
  <link rel="stylesheet" href="{{ url('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ url('bower_components/datatables.net-bs/css/responsive.bootstrap.min.css') }}">

  {{-- Select2 --}}
  <link rel="stylesheet" href="{{ url('bower_components/select2/dist/css/select2.min.css') }}">


  {{-- FullCalendar --}}
  <link rel="stylesheet" href="{{ url('bower_components/fullcalendar/dist/fullcalendar.min.css') }}">
  <link rel="stylesheet" href="{{ url('bower_components/fullcalendar/dist/fullcalendar.print.min.css') }}"
    media="print">



  <!-- Google Font -->
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









  <!-- jQuery 3 -->
  <script src="{{ url('bower_components/jquery/dist/jquery.min.js') }}"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="{{ url('bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button);
  </script>
  <!-- Bootstrap 3.3.7 -->
  <script src="{{ url('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
  <!-- Morris.js charts -->
  <script src="{{ url('bower_components/raphael/raphael.min.js') }}"></script>
  <script src="{{ url('bower_components/morris.js/morris.min.js') }}"></script>
  <!-- Sparkline -->
  <script src="{{ url('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
  <!-- jQuery Knob Chart -->
  <script src="{{ url('bower_components/jquery-knob/dist/jquery.knob.min.js') }}"></script>
  <!-- daterangepicker -->
  <script src="{{ url('bower_components/moment/min/moment.min.js') }}"></script>
  <script src="{{ url('bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
  <!-- datepicker -->
  <script src="{{ url('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
  <!-- Slimscroll -->
  <script src="{{ url('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
  <!-- FastClick -->
  <script src="{{ url('bower_components/fastclick/lib/fastclick.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ url('dist/js/adminlte.min.js') }}"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="{{ url('dist/js/pages/dashboard.js') }}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{ url('dist/js/demo.js') }}"></script>





  {{-- inputmask --}}

  <script src="{{ url('bower_components/input-mask/jquery.inputmask.js') }}"></script>

  <!-- DataTables -->
  <script src="{{ url('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ url('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
  <script src="{{ url('bower_components/datatables.net-bs/js/dataTables.responsive.min.js') }}"></script>


  {{-- Select2 --}}
  <script src="{{ url('bower_components/select2/dist/js/select2.min.js') }}"></script>

  {{-- FullCalendar --}}
  <script src="{{ url('bower_components/fullcalendar/dist/fullcalendar.min.js') }}"></script>
  <script src="{{ url('bower_components/fullcalendar/dist/locale/es.js') }}"></script>




  {{-- CKEditor --}}

  <script src="{{ url('bower_components/ckeditor/ckeditor.js') }}"></script>

  {{-- Sweetalert2 --}}
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



  <script type="text/javascript">
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


  <script type="text/javascript">
    @if (Session('UsuarioCreado') == 'OK')
      Swal.fire(
        'El Usuario ha sidoCreado',
        '',
        'success'

      )
    @elseif (Session('UsuarioActualizado') == 'OK')
      Swal.fire(
        'El Usuario ha Actualizado',
        '',
        'success'

      )
    @elseif (Session('ClienteAgreagado') == 'OK')
      Swal.fire(
        'El Cliente ha sido Agregado',
        '',
        'success'

      )
    @elseif (Session('ClienteActualizado') == 'OK')
      Swal.fire(
        'El Cliente ha sido Actualizado',
        '',
        'success'

      )
    @elseif (Session('MascotaAgregada') == 'OK')
      Swal.fire(
        'La Mascota ha sido Agregada',
        '',
        'success'

      )
    @elseif (Session('MascotaActualizada') == 'OK')
      Swal.fire(
        'La Mascota ha sido Actualizada',
        '',
        'success'

      )
    @elseif (Session('VacunaAgregada') == 'OK')
      Swal.fire(
        'La Vacuna ha sido Agregada',
        '',
        'success'

      )
    @elseif (Session('VeterinarioCreado') == 'OK')
      Swal.fire(
        'El Veterinario ha sido Creado',
        '',
        'success'

      )
    @endif
  </script>



  @php
    $exp = explode('/', $_SERVER['REQUEST_URI']);
  @endphp



  @if ($exp[3] == 'Editar-Usuario')
    <script type="text/javascript">
      $('#EditarUsuario').modal('toggle');
    </script>
  @elseif ($exp[3] == 'Editar-Mascota')
    <script type="text/javascript">
      $('#EditarMascota').modal('toggle');
    </script>
  @endif



  <script type="text/javascript">
    $(".table").on('click', '.EliminarUsuario', function() {

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
      })
    })

    $(".table").on('click', '.EliminarMascota', function() {

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
      })
    })
  </script>



  <script type="text/javascript">
    $(#calendario).fullCalendar({

      defaultView: 'agendaWeek',

      hiddenDays: [0, 6],

      scrollTime: '09:00',
      minTime: '09:00',
      maxTime: '18:00',

    });
  </script>




</body>

</html>
