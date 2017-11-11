<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Emergency System | www.emergensys.dev</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{asset('/admin/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('/admin/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css"> -->
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('/admin/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.
  -->
  <link rel="stylesheet" href="{{ asset('/admin/css/_all-skins.min.css')}}">
  <link rel="apple-touch-icon" href="{{ asset('/admin/img/apple-touch-icon.png')}}">
  <link rel="shortcut icon" href="{{ asset('/admin/img/favicon.ico')}}">

  <link rel="stylesheet" href="{{asset('/admin/css/skin-blue.min.css')}}">

  <!-- estilos apra datepicker -->
  <link rel="stylesheet" href="{{asset('/admin/datepicker/css/bootstrap-datepicker.min.css')}}">

  <!-- Css para validator -->
  <link rel="stylesheet" href="{{asset('/validator/Parsley/css/parsley.css')}}">

  <!-- sweet alert -->
  <link rel="stylesheet" href="{{asset('/sweetalert/sweetalert.css')}}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="/" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>E</b>SYS</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>EMERGEN</b>SYS</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="{{ asset('/admin/img/user2-160x160.jpg')}}" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">César Rick</span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="{{ asset('/admin/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">

                <p>
                  César Rick - Full Stack Developer
                  <small>Member since Nov. 2012</small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                {{--
                <div class="row">
                  
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>                  
                </div>
                --}}
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Perfil</a>
                </div>
                <div class="pull-right">
                  <a href="#" class="btn btn-default btn-flat">Cerrar Sesión</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>


  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('/admin/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>César Rick</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header"><h5>MENÚ PRINCIPAL</h5></li>
        <!-- Optionally, you can add icons to the links -->
    
        <!-- Type of Jobs link-->
        <li class="{{ Request::is('multi*') ? 'active' : '' }}">        
          <a href="{{route('categories.index')}}"><i class="fa fa-address-book" aria-hidden="true"></i><span>Tipo de Puestos</span></a>
        </li>

        <!-- Jobs link-->
        <li class="{{ Request::is('works*') ? 'active' : '' }}">        
          <a href="{{route('positions.index')}}"><i class="fa fa-user-o" aria-hidden="true"></i><span>Puestos</span></a>
        </li>

        <!-- Medical Specialitys link-->
        <li class="{{ Request::is('medical_specialities*') ? 'active' : '' }}">        
          <a href="{{route('speciality.index')}}"><i class="fa fa-hospital-o" aria-hidden="true"></i><span>Especialidades Medicas</span></a>
        </li>

        <!-- Level Status link-->
        <li class="{{ Request::is('list_warn*') ? 'active' : '' }}">        
          <a href="{{route('level_danger.index')}}"><i class="fa fa-heartbeat" aria-hidden="true"></i><span>Estados de Salud</span></a>
        </li>

        <!-- Diseases Status link-->
        <li class="{{ Request::is('pathologic*') ? 'active' : '' }}">        
          <a href="{{route('pathologic_lists.index')}}"><i class="fa fa-stethoscope" aria-hidden="true"></i><span>Diagnósticos</span></a>
        </li>

        <!-- Prescriptions Status link-->
        <li class="{{ Request::is('recet*') ? 'active' : '' }}">        
          <a href="{{route('medical_prescription.index')}}"><i class="fa fa-user-md" aria-hidden="true"></i><span>Preescripciones</span></a>
        </li>

        <!-- Pacientes link-->
        <li class="{{ Request::is('persons*') ? 'active' : '' }}">        
          <a href="{{route('patient_lists.index')}}"><i class="fa fa-venus-mars" aria-hidden="true"></i><span>Pacientes</span></a>
        </li>

                        
        <!-- Menu multilevel de Reportes -->
        <li class="treeview">
          <a href="#"><i class="fa fa-tasks" aria-hidden="true"></i><span>Admnistrar Mensajes</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>

          <ul class="treeview-menu">

          <li class="{{ Request::is('media*') ? 'active' : '' }}">        
              <a href="{{route('list_emergency')}}"><i class="fa fa-bell-o" aria-hidden="true"></i><span>Notificar Emergencia</span></a>
            </li>

            <li class="{{ Request::is('media*') ? 'active' : '' }}">        
              <a href="{{route('sending_alerts.index')}}"><i class="fa fa-history" aria-hidden="true"></i><span>Historial</span></a>
            </li>            
          </ul>
        </li>
        <!-- fin multilevel -->

        <!-- Menu multilevel de Reportes -->
        {{-- 
        <li class="treeview">
          <a href="#"><i class="fa fa-file-pdf-o" aria-hidden="true"></i><span>Reportes</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>

          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-paper-plane" aria-hidden="true"></i>Notificaciones Enviadas</a></li>
            <li><a href="#"><i class="fa fa-list-ol" aria-hidden="true"></i>Pacientes</a></li>
              
          </ul>
        </li> --}}
        <!-- fin multilevel -->

        <!-- Link de form de contacto -->
        <li><a href="#"><i class="fa fa-envelope-square" aria-hidden="true"></i><span>Contacto</span></a></li>

      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

<!-- Inicio de contenido -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- <section class="content-header">
      <h1>
        Page Header
        <small>Optional description</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
    </section> -->

<!-- Seccion de contenido -- >
    <!-- Main content -->
    <!-- Your Page Content Here -->
    <section class="content">

    <div class="row">
      <div class="col-lg-12">
        <div class="box">
          <div class="box-header with-border">
            <h1 class="box-title">Sistema de Notificaciones</h1>
            <div class="box-tools pull-right">
              <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              {{-- <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> --}}
            </div>
          </div>
          <!-- /.box-header -->

          <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                        <!--Contenido-->                        
                        @yield('content')
                        <!--Fin Contenido-->
                </div>
            </div><!-- /.row -->
          </div> <!-- /.box-body -->
        </div><!-- /.box -->
      </div><!-- /.col-lg-12 -->
    </div><!-- /.row -->

    <!--
    <div class="row">
      <div class="col-lg-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Sistema Experto</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>                    
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
          </div>
        </div>
      </div>
    </div>

    <div class="box-body">
      <div class="row">
        <div class="col-md-12">
          <h3>Contenido</h3>
          
          
        </div>
      </div>
    </div> -->
            
      </section>
      <!-- /.content -->
      <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane active" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="pull-right-container">
                  <span class="label label-danger pull-right">70%</span>
                </span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

      <!-- Fin Seccion de contenido -- >
    </div>
    <!-- /.content-wrapper -->
    <!-- aside derecho -->
    
    <!-- Fin aside derecho -->

  </div>
<!-- ./wrapper -->

  <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 0.1
        </div>
        <strong>Copyright &copy; 2017-2020 <a href="www.cesardev.com">Rick Blog </a>.</strong> All rights reserved.
  </footer>

  


<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.2.3 -->
<script src="{{asset('/admin/js/jquery-3.2.1.min.js')}}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{asset('/admin/js/bootstrap.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('/admin/js/app.min.js')}}"></script>

<!-- Scripts to datepicker -->
<script src="{{asset('/admin/datepicker/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('/admin/datepicker/locales/bootstrap-datepicker.es.min.js')}}"></script>

<!-- Validator -->
<script src="{{asset('/validator/Parsley/js/parsley.min.js')}}"></script>
<script src="{{asset('/validator/Parsley/i18n/es.js')}}"></script>

<!-- sweet alert -->
<script src="{{asset('/sweetalert/sweetalert.min.js')}}"></script>
@include('sweet::alert')
{{-- <script src="{{asset('/js/toastr.min.js')}}"></script> --}}

{{-- 
<script>
    @if(Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}";
        switch(type){
            case 'info':
                toastr.info("{{ Session::get('message') }}");
                break;
            
            case 'warning':
                toastr.warning("{{ Session::get('message') }}");
                break;
            case 'success':
                toastr.success("{{ Session::get('message') }}");
                break;
            case 'error':
                toastr.error("{{ Session::get('message') }}");
                break;
        }
    @endif
</script>
--}}


<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->

<!-- Scripts js personalizados -->

@stack('scripts')
</body>
</html>
