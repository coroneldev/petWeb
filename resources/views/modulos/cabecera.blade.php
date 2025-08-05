   <header class="main-header">
     <!-- Logo -->
     <a href="{{ url('Inicio') }}" class="logo">
       <span class="logo-mini"><b><i class="fa fa-paw"></i></b></span>
       <span class="logo-lg"><b>COMVET</b>LP <i><i class="fa fa-paw"></i></i></span>
     </a>
     <!-- Header Navbar: style can be found in header.less -->
     <nav class="navbar navbar-static-top">
       <!-- Sidebar toggle button-->
       <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
         <span class="sr-only">Toggle navigation</span>
       </a>

       <div class="navbar-custom-menu">
         <ul class="nav navbar-nav">

           <!-- User Account: style can be found in dropdown.less -->
           <li class="dropdown user user-menu">
             <a href="#" class="dropdown-toggle" data-toggle="dropdown">

               @if (auth()->user()->foto == '')
                 <img src="{{ url('storage/defecto.png') }}" class="user-image" alt="User Image">
               @else
                 <img src="{{ url('storage/' . auth()->user()->foto) }}" class="user-image" alt="User Image">
               @endif

               <span class="hidden-xs">{{ auth()->user()->name }}</span>
             </a>
             <ul class="dropdown-menu">


               <!-- Menu Footer-->
               <li class="user-footer">
                 <div class="pull-left">
                   <a href="{{ url('Mis-Datos') }}" class="btn btn-primary btn-flat"><i><i class="fa fa-user"></i> Mis
                       Datos</a>
                 </div>
                 <div class="pull-right">
                   <a href="{{ route('logout') }}" class="btn btn-danger btn-flat"
                     onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i><i
                         class="fa fa-sign-out"></i>
                       Salir</a>
                 </div>

                 <form method="post" action="{{ route('logout') }}" id="logout-form">
                   @csrf
                 </form>
               </li>
             </ul>
           </li>

         </ul>
       </div>
     </nav>
   </header>
