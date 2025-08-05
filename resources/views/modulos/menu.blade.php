<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">


      <br>

      <li>
        <a href="{{ url('Inicio') }}">
          <i class="fa fa-home text-yellow"></i>
          <span>Inicio</span>
        </a>
      </li>

      <li>
        <a href="{{ url('Usuarios') }}">
          <i class="fa fa-users text-yellow"></i>
          <span>Usuarios</span>
        </a>
      </li>

      <li>
        <a href="{{ url('Clientes') }}">
          <i class="fa fa-user-plus text-yellow"></i>
          <span>Clientes</span>
        </a>
      </li>

      <li>
        <a href="{{ url('Mascotas') }}">
          <i class="fa fa-paw text-yellow"></i>
          <span>Mascotas</span>
        </a>
      </li>



      <li class="treeview">

        <a href="#">
          <i class="fa fa fa-list text-yellow"></i> <span>Clinica</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>

        <ul class="treeview-menu">

          <li>
            <a href="{{ url('Veterinarios') }}">
              <i class="fa fa-medkit text-yellow"></i>
              <span>Veterinarios</span>
            </a>
          </li>

          <li>
            <a href="{{ url('Citas') }}">
              <i class="fa fa-calendar-check-o text-yellow"></i>
              <span>Citas</span>
            </a>
          </li>

          <li>
            <a href="{{ url('Internaciones') }}">
              <i class="fa fa-hospital-o text-yellow"></i>
              <span>Internaciones</span>
            </a>
          </li>

        </ul>

      </li>

      <hr>



      {{-- <li>
                <a href="{{ url('Cajas') }}">
                    <i class="fa fa-money"></i>
                    <span>Cajas</span>
                </a>
            </li>



            <li class="treeview">

                <a href="#">
                    <i class="fa fa fa-list"></i> <span>Productos</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu">

                    <li>
                        <a href="{{ url('Categorias') }}">
                            <i class="fa fa-th"></i>
                            <span>Categorias</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('Gestor de Productos') }}">
                            <i class="fa fa-cubes"></i>
                            <span>Gestor de Productos</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('Inventarios') }}">
                            <i class="fa fa-archive"></i>
                            <span>Inventarios</span>
                        </a>
                    </li>

                </ul>

            </li>

            <li>
                <a href="{{ url('Compras') }}">
                    <i class="fa fa-shopping-basket"></i>
                    <span>Compras</span>
                </a>
            </li>

            <li>
                <a href="{{ url('ventas') }}">
                    <i class="fa fa-cart-plus"></i>
                    <span>ventas</span>
                </a>
            </li>

            <li>
                <a href="{{ url('Informes') }}">
                    <i class="fa fa-file"></i>
                    <span>Informes</span>
                </a>
            </li> --}}




    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
