<!DOCTYPE html>
<html lang="en" class="loading">
<head><title>Sider</title>
      <script type="text/javascript" async src="https://www.googletagmanager.com/gtag/js?id=UA-83555206-7"></script>

    <style type="text/css">
        .required{
            color:red;
            font-weight: bold;
        }
        .table-responsive {
          width: 100%;
          margin-bottom: 15px;
          overflow-x: auto;
          overflow-y: hidden;
          -webkit-overflow-scrolling: touch;
          -ms-overflow-style: -ms-autohiding-scrollbar;
      }
    </style>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Apex admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Apex admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
     <meta name="userId" content="{{Auth::check() ? Auth::user()->id : ''}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
  <base href="{!! url('/') !!}"/>

  <link rel="shortcut icon" href="{{ asset('images/icons/favicon.ico') }}">
  <link rel="apple-touch-icon" href="{{ asset('images/icons/favicon.png') }}">
  <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('images/icons/favicon-72x72.png') }}">
  <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('images/icons/favicon-114x114.png') }}">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet">
  <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.ico') }}">
  <link rel="stylesheet" href="{{ asset('css/master.css') }}">
  <link type="text/css" rel="stylesheet" href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}">
  
  <style>
      .btn-azul {
        color: #ffffff;
        background-color: #2299e9;
        border-color: #2299e9;
    }
    
  </style>
  <script>
    var base = "{{ url('/') }}";
  </script>
   <style>
   .table-responsive {
    width: 100%;
    margin-bottom: 15px;
    overflow-x: auto;
    overflow-y: hidden;
    overflow: scroll;
   /* display: block;
    max-height: 200px;
    overflow-y: auto;
    -ms-overflow-style: -ms-autohiding-scrollbar;*/

}


</style> 
</head>
<body class=" ">

  <div align="center"><img src="{{ asset('images/BANNERS.png') }}" width="100%"></div>
  <div id="app">
  <div>


    <!--BEGIN BACK TO TOP--><a id="totop" href="#"><i class="fa fa-angle-up"></i></a><!--END BACK TO TOP-->
    <!--BEGIN TOPBAR-->
    <div id="header-topbar-option-demo" class="page-header-topbar">

      <nav id="topbar" role="navigation" style="margin-bottom: 0; z-index: 2;"
      class="navbar navbar-default navbar-static-top">
      <div class="navbar-header">
        <button type="button" data-toggle="collapse" data-target=".sidebar-collapse" class="navbar-toggle"><span
          class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span
          class="icon-bar"></span><span class="icon-bar"></span></button>
          <a id="logo" href="/" class="navbar-brand"><span class="fa fa-rocket"></span><span class="logo-text" style="
          position: relative;
          top: -13px;
          right: 4px;
          ">SIDER <h5 style="
          font-size:  12px;
          width: 235px;
          position:  relative;
          top: -9px;
          right: 10px;
          ">Sistema Integrado del Deporte y la Recreación</h5>
        </span>
        <span style="display: none" class="logo-text-icon">µ</span></a> 
      </div>


      <div class="topbar-main">
        <ul class="nav navbar-nav">
          <li class="active"><a href="index.html">Dashboard</a></li>
          <li><a href="javascript:;" data-toggle="dropdown" class="dropdown-toggle">Layouts
            &nbsp;<i class="fa fa-angle-down"></i></a>
            <ul class="dropdown-menu">
              <li><a href="layout-left-sidebar.html">Left Sidebar</a></li>
              <li><a href="layout-right-sidebar.html">Right Sidebar</a></li>
              <li><a href="layout-left-sidebar-collapsed.html">Left Sidebar Collasped</a></li>
              
            </ul>
          </li>
          <li class="mega-menu-dropdown"><a href="javascript:;" data-toggle="dropdown"
            class="dropdown-toggle">UI Elements
            &nbsp;<i class="fa fa-angle-down"></i></a>
            <ul class="dropdown-menu">

            </ul>
          </li>
          <li class="mega-menu-dropdown mega-menu-full"><a href="javascript:;" data-toggle="dropdown"
           class="dropdown-toggle">Extras
           &nbsp;<i class="fa fa-angle-down"></i></a>
           <ul class="dropdown-menu">

           </ul>
         </li>
       </ul>

       <ul class="nav navbar navbar-top-links navbar-right mbn">
          @if(Auth::check())  
          @endif  
      
       

        <li class="dropdown topbar-user"><a data-hover="dropdown" href="#" class="dropdown-toggle"><img
          src="{{ asset('images/admin-icon.png') }}" alt=""
          class="img-responsive img-circle"/></a>
          <ul class="dropdown-menu dropdown-user">
            @guest
            <li><a href="{{ route('login') }}"><i class="fa fa-user"></i>Login</a></li>
            @else
            <li>
                <a href="/admin/postusuarios#/admin/postusuarios/editandoperfil/{{Auth::user()->id}}" class="grey-text text-darken-1">
                  <i class="fa fa-pencil-square-o"></i> Editar mi perfil
                </a>
              <a href="{{ route('logout') }}" class="grey-text text-darken-1" onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              <i class="fa fa-sign-out"></i> Cerrar Sesión
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
            </form>
          </li>                           
          @endguest
        </ul>
      </li>
    </ul>
    <!--END THEME SETTING--></li>
  </ul>
</div>
</nav>
<!--BEGIN MODAL CONFIG PORTLET-->
<div id="modal-config" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
        <h4 class="modal-title">Modal title</h4></div>
        <div class="modal-body"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eleifend et
          nisl eget porta. Curabitur elementum sem molestie nisl varius, eget tempus odio molestie. Nunc
          vehicula sem arcu, eu pulvinar neque cursus ac. Aliquam ultricies lobortis magna et aliquam.
          Vestibulum egestas eu urna sed ultricies. Nullam pulvinar dolor vitae quam dictum condimentum.
          Integer a sodales elit, eu pulvinar leo. Nunc nec aliquam nisi, a mollis neque. Ut vel felis
          quis tellus hendrerit placerat. Vivamus vel nisl non magna feugiat dignissim sed ut nibh. Nulla
          elementum, est a pretium hendrerit, arcu risus luctus augue, mattis aliquet orci ligula eget
        massa. Sed ut ultricies felis.</p></div>
        <div class="modal-footer">
          <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
  <!--END MODAL CONFIG PORTLET--></div>
  <!--END TOPBAR-->
  <div id="wrapper"><!--BEGIN SIDEBAR MENU-->
    <nav id="sidebar" role="navigation" class="navbar-default navbar-static-side">
     @include('angular.template.menu')
   </nav>
   <!--END SIDEBAR MENU--><!--BEGIN CHAT FORM-->
   <!--END CHAT FORM--><!--BEGIN PAGE WRAPPER-->
   <div id="page-wrapper"><!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
      <div class="page-header pull-left">
        <div class="page-title"><h4 class="box-heading">@yield('title')</h4></div>
      </div>
      <div class="clearfix"></div>
    </div>
    <!--END TITLE & BREADCRUMB PAGE--><!--BEGIN CONTENT-->
    <div class="page-content">
      <div id="tab-general">
        <div id="sum_box" class="row mbl">
         <section>
          @include('flash::message')
          <router-view></router-view>
         <!--  @yield('content') -->
        </section>
        <!-- AQUI VA TODO EL CONTENDIDO -->
      </div>        
    </div>
  </div>
  <!--END CONTENT--></div>
  <!--BEGIN FOOTER-->
  <div id="footer">
   <div id="copyright">
    <div class="bloqueZona3  tipoDysplay">
      <div class="tabla1 tablaBloque253">   
        <div class="contenido1">
          <div class="container">
            <div class="row">
              <div class="col-md-6 brand">
                <span>Alcaldía de Santiago de Cali - Nit: 890399011-3 </span>
                <a href="/informatica/publicaciones/1344/polticas_seguridad_de_la_informacin/" title="Alcaldía de Santiago de Cali" >Políticas de seguridad de la información y protección de datos personales</a>
                <span>Todos los Derechos Reservados © 2018</span>
              </div>
              <div class="col-md-6 socialnetworks bottom">
                <ul>
                  <li>
                    <span class="title">Síguenos en:</span>
                  </li>
                  <li class="facebook">
                    <a href="https://www.facebook.com/AlcaldiaDeCali/" target="_blank" title="Alcaldía de Santiago de Cali">
                      <span class="icon fa fa-facebook"></span>
                      <span class="hide">Facebook</span>
                    </a>
                  </li>
                  <li class="twitter">
                    <a href="https://twitter.com/alcaldiadecali" target="_blank" title="Alcaldía de Santiago de Cali">
                      <span class="icon fa fa-twitter"></span>
                      <span class="hide">twitter</span>
                    </a>
                  </li>
                  <li class="youTube">
                    <a href="https://www.youtube.com/user/AlcaldiadeCaliTV" target="_blank" title="Alcaldía de Santiago de Cali">
                      <span class="icon fa fa-youtube"></span>
                      <span class="hide">youtube</span>
                    </a>
                  </li>     
                  <li class="instagram">
                    <a href="https://www.instagram.com/alcaldiadecali/" target="_blank" title="Alcaldía de Santiago de Cali">
                      <span class="icon fa fa-instagram"></span>
                      <span class="hide">Instagram</span>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>            </div>
        </div>
        <div class="bloqueZona3  tipoDisplay">
          <div class="tabla1 tablaBloque100993  " style=".">
            <div class="contenido1">
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="copyright">2018 © Secretaria de Deportes</div>
  </div>
  <!--END FOOTER--><!--END PAGE WRAPPER--></div>
</div>
</div>

@include('angular.template.vuescript')
</body>
</html>