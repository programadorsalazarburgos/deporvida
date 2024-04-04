<!DOCTYPE html>
<html lang="pt-BR" ng-app="SeriesApp">
<head><title>Dashboard | Dashboard</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="cache-control" content="no-cache">
    <meta http-equiv="expires" content="Thu, 19 Nov 1900 08:52:00 GMT">
     <base href="{!! url('/') !!}"/>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-route.js"></script>
  <script src="https://code.angularjs.org/1.4.3/angular-messages.js"></script>
  <script  src="https://cdnjs.cloudflare.com/ajax/libs/angular-deckgrid/0.5.0/angular-deckgrid.js"></script>
  <link rel="stylesheet" href="//cdn.rawgit.com/indrimuska/angular-selector/master/dist/angular-selector.css">
  <script src="//cdn.rawgit.com/indrimuska/angular-selector/master/dist/angular-selector.js"></script>

  <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.2.18/angular-sanitize.js"></script>
  <script src="{{ asset('js/timepickerpop.js') }}"></script>
  <script src="{{ asset('js/select.js') }}"></script>
  <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/select2/3.4.5/select2.css">
  <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.8.5/css/selectize.default.css">
    <link rel="shortcut icon" href="{{ asset('images/icons/favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/icons/favicon.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('images/icons/favicon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('images/icons/favicon-114x114.png') }}">
    <!--Loading bootstrap css-->
    
 <link type="text/css" rel="stylesheet"
          href="{{ asset('vendors/jquery-ui-1.10.4.custom/css/ui-lightness/jquery-ui-1.10.4.custom.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}">
 <link type="text/css" rel="stylesheet" href="{{ asset('vendors/bootstrap/css/bootstrap.min.css') }}">
     <link rel="stylesheet" href="{{ asset('css/calendar.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('demo2/css/prism.css') }}" />
          <link rel="stylesheet" type="text/css" href="{{ asset('demo2/css/calendar-style.css') }}" />
           <link rel="stylesheet" type="text/css" href="{{ asset('src2/css/pignose.calendar.css') }}" />
              <link type="text/css" rel="stylesheet" href="{{ asset('vendors/select2/select2-madmin.css') }}">
               <link type="text/css" rel="stylesheet" href="{{ asset('vendors/bootstrap-select/bootstrap-select.min.css') }}">
                <link type="text/css" rel="stylesheet" href="{{ asset('vendors/multi-select/css/multi-select-madmin.css') }}">
                  <script src="{{ asset('proui/js/vendor/modernizr-2.7.1-respond-1.4.2.min.js') }}"></script>
    <!--LOADING STYLESHEET FOR PAGE-->
     <link type="text/css" rel="stylesheet" href="{{ asset('vendors/intro.js/introjs.css') }}">
         <link type="text/css" rel="stylesheet" href="{{ asset('vendors/calendar/zabuto_calendar.min.css') }}">
  <link type="text/css" rel="stylesheet" href="{{ asset('vendors/calendar/zabuto_calendar.min.css') }}">
  <link type="text/css" rel="stylesheet" href="{{ asset('vendors/sco.message/sco.message.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('vendors/intro.js/introjs.css') }}">
        <link type="text/css" rel="stylesheet" href="{{ asset('vendors/DataTables/media/css/jquery.dataTables.css') }}">
         <link type="text/css" rel="stylesheet"
          href="{{ asset('vendors/DataTables/extensions/TableTools/css/dataTables.tableTools.min.css') }}">
              <link type="text/css" rel="stylesheet" href="{{ asset('vendors/DataTables/media/css/dataTables.bootstrap.css') }}">
    <!--Loading style vendors3-->
      <link type="text/css" rel="stylesheet" href="{{ asset('vendors/animate.css/animate.css') }}">
   <link type="text/css" rel="stylesheet" href="{{ asset('vendors/jquery-pace/pace.css') }}">
   <link type="text/css" rel="stylesheet" href="{{ asset('vendors/iCheck/skins/all.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('vendors/jquery-notific8/jquery.notific8.min.css') }}">
     <link type="text/css" rel="stylesheet" href="{{ asset('vendors/bootstrap-daterangepicker/daterangepicker-bs3.css') }}">
         <link type="text/css" rel="stylesheet" href="{{ asset('vendors/bootstrap-colorpicker/css/colorpicker.css') }}">
             <link type="text/css" rel="stylesheet" href="{{ asset('vendors/bootstrap-datepicker/css/datepicker.css') }}">
                <link type="text/css" rel="stylesheet"
    href="{{ asset('vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}">
       <link type="text/css" rel="stylesheet" href="{{ asset('vendors/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
           <link type="text/css" rel="stylesheet" href="{{ asset('vendors/bootstrap-clockface/css/clockface.css') }}">
              <link type="text/css" rel="stylesheet" href="{{ asset('vendors/bootstrap-switch/css/bootstrap-switch.css') }}">
                <link type="text/css" rel="stylesheet" href="{{ asset('css/themes/style1/orange-blue.css') }}" class="default-style">
                  <link type="text/css" rel="stylesheet" href="{{ asset('css/themes/style1/orange-blue.css') }}" id="theme-change"
          class="style-change color-change">
            <link type="text/css" rel="stylesheet" href="{{ asset('css/themes/style2s/orange-blue.css') }}" id="theme-change" class="style-change color-change">
   <link type="text/css" rel="stylesheet" href="{{ asset('css/style-responsive.css') }}">
      <script src="{{ asset('dist/sweetalert-dev.js') }}"></script>
   <link rel="stylesheet" href="{{ asset('dist/sweetalert.css') }}">
   <link rel="stylesheet" href="{{ asset('plugins/chosen/chosen.css') }}">

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.19/angular.min.js" type="text/javascript"></script>
   <script src="http://angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.10.0.js" type="text/javascript"></script>
   <link href='{{ asset('fullcalendar/fullcalendar.css') }}' rel='stylesheet' />
   <link type="text/css" rel="stylesheet" href="{{ asset('vendors/jquery-toastr/toastr.min.css') }}">
   <link rel="stylesheet" href="{{ asset('css/letrasmagicas.css') }}">

  <link rel="stylesheet" href="{{ asset('css/validationEngine.jquery.css') }}" type="text/css"/>

  <link rel="stylesheet" href="{{ asset('bower_components/EasyAutocomplete/dist/easy-autocomplete.min.css') }}" type="text/css"/>
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.ico') }}">
<link rel="stylesheet" href="{{ asset('css/ticket.css') }}" media="screen" type="text/css" />

<link rel="stylesheet" type="text/css" href="{{ asset('calendarmaterial/material-datepicker/css/material.datepicker.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ng-ckeditor/0.2.1/ng-ckeditor.css" type="text/css"/>

 <link rel="stylesheet" href="{{ asset('node_modules/material-date-picker/build/styles/mbdatepicker.css') }}"/>

<link rel="stylesheet" href="{{ asset('css/dualmultiselect.css') }}">
<link rel="stylesheet" href="{{ asset('css/sider.css') }}">
<link rel="stylesheet" href="{{ asset('css/build.css') }}">
<style type="text/css">
  input {
    border: 1px solid #4195fc; /* some kind of blue border */

    /* other CSS styles */

    /* round the corners */
    -webkit-border-radius: 4px;
       -moz-border-radius: 4px;
            border-radius: 4px;


    /* make it glow! */
    -webkit-box-shadow: 0px 0px 4px #4195fc;
       -moz-box-shadow: 0px 0px 4px #4195fc;
            box-shadow: 0px 0px 4px #4195fc; /* some variation of blue for the shadow */

}


label {
  color: grey;
}



</style> 
<link rel="stylesheet" href="{{ asset('css/iphone.css') }}">

  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">




</head>
<body class=" ">
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
                <a id="logo" href="index.html" class="navbar-brand"><span class="fa fa-rocket"></span><span
                        class="logo-text">µAdmin</span><span style="display: none" class="logo-text-icon">µ</span></a>
            </div>
            <div class="topbar-main"><a id="menu-toggle" href="#" class="hidden-xs"><i class="fa fa-bars"></i></a>
                <ul class="nav navbar-nav    ">
                    <li class="active"><a href="index.html">Dashboard</a></li>
                    <li><a href="javascript:;" data-toggle="dropdown" class="dropdown-toggle">Layouts
                        &nbsp;<i class="fa fa-angle-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="layout-left-sidebar.html">Left Sidebar</a></li>
                            <li><a href="layout-right-sidebar.html">Right Sidebar</a></li>
                            <li><a href="layout-left-sidebar-collapsed.html">Left Sidebar Collasped</a></li>
                            <li><a href="layout-right-sidebar-collapsed.html">Right Sidebar Collasped</a></li>
                            <li class="dropdown-submenu"><a href="javascript:;" data-toggle="dropdown"
                                                            class="dropdown-toggle">More Options</a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Second level link</a></li>
                                    <li class="dropdown-submenu"><a href="javascript:;" data-toggle="dropdown"
                                                                    class="dropdown-toggle">More Options</a>
                                        <ul class="dropdown-menu">
                                            <li><a href="#">Third level link</a></li>
                                            <li><a href="#">Third level link</a></li>
                                            <li><a href="#">Third level link</a></li>
                                            <li><a href="#">Third level link</a></li>
                                            <li><a href="#">Third level link</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">Second level link</a></li>
                                </ul>
                            </li>
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
                   
                    
                    <li class="dropdown topbar-user"><a data-hover="dropdown" href="#" class="dropdown-toggle"><img
                            src="https://s3.amazonaws.com/uifaces/faces/twitter/kolage/48.jpg" alt=""
                            class="img-responsive img-circle"/></a>
                        <ul class="dropdown-menu dropdown-user">
                           
                            

                        @guest
                        <li><a href="{{ route('login') }}"><i class="fa fa-user"></i>Login</a></li>
   @else
                <li>
                  <a href="{{ route('logout') }}" class="grey-text text-darken-1" onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                  <i class="material-icons">keyboard_tab</i> Cerrar Sesión
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
                    <div class="page-title">@yield('title')</div>
                </div>
             
             
                <div class="clearfix"></div>
            </div>
            <!--END TITLE & BREADCRUMB PAGE--><!--BEGIN CONTENT-->
            <div class="page-content">
                <div id="tab-general">
                    <div id="sum_box" class="row mbl">
                       

                         <section>
          @include('flash::message')
          @yield('content')
        </section>
                        <!-- AQUI VA TODO EL CONTENDIDO -->
                     
                    </div>





                
                  
                </div>
            </div>
            <!--END CONTENT--></div>
        <!--BEGIN FOOTER-->
        <div id="footer">
            <div class="copyright">2014 © &mu;Admin - Responsive Multi-Style Admin Template</div>
        </div>
        <!--END FOOTER--><!--END PAGE WRAPPER--></div>
</div>

@include('angular.template.script')
</body>
</html>