<!DOCTYPE html>
<html lang="pt-BR" ng-app="SeriesApp">
	<head>
		<title>Sider</title>
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script type="text/javascript" async src="https://www.googletagmanager.com/gtag/js?id=UA-83555206-7"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());

			gtag('config', 'UA-83555206-7');
		</script>
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
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="cache-control" content="no-cache">
		<meta http-equiv="expires" content="Thu, 19 Nov 1900 08:52:00 GMT">
		<base href="{!! url('/') !!}"/>
		<link type="text/css" rel="stylesheet" href="{{url('')}}/local/css/angular-selector.css">
		<link type="text/css" rel="stylesheet" href="{{url('')}}/local/css/select2.css">
		<link type="text/css" rel="stylesheet" href="{{url('')}}/local/css/selectize.default.css">
		<link rel="shortcut icon" href="{{ asset('images/icons/favicon.ico') }}">
		<link rel="apple-touch-icon" href="{{ asset('images/icons/favicon.png') }}">
		<link rel="apple-touch-icon" sizes="72x72" href="{{ asset('images/icons/favicon-72x72.png') }}">
		<link rel="apple-touch-icon" sizes="114x114" href="{{ asset('images/icons/favicon-114x114.png') }}">
		<link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.ico') }}">
		<!--Loading bootstrap css-->
		{{--
		<link type="text/css" rel="stylesheet" href="{{ asset('vendors/jquery-ui-1.10.4.custom/css/ui-lightness/jquery-ui-1.10.4.custom.min.css') }}">
		--}}
		<link type="text/css" rel="stylesheet" href="{{url('')}}/local/css/jquery-ui.css"/>
		<link type="text/css" rel="stylesheet" href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}">
		<link type="text/css" rel="stylesheet" href="{{ asset('vendors/bootstrap/css/bootstrap.min.css') }}">
		<link type="text/css" rel="stylesheet" href="{{ asset('css/calendar.css') }}">
		<link type="text/css" rel="stylesheet" href="{{ asset('demo/css/prism.css') }}" />
		<link type="text/css" rel="stylesheet" href="{{ asset('demo/css/calendar-style.css') }}" />
		<link type="text/css" rel="stylesheet" href="{{ asset('src2/css/pignose.calendar.css') }}" />
		<link type="text/css" rel="stylesheet" href="{{ asset('vendors/select2/select2-madmin.css') }}">
		<link type="text/css" rel="stylesheet" href="{{ asset('vendors/bootstrap-select/bootstrap-select.min.css') }}">
		<link type="text/css" rel="stylesheet" href="{{ asset('vendors/multi-select/css/multi-select-madmin.css') }}">
		<!--LOADING STYLESHEET FOR PAGE-->
		<link type="text/css" rel="stylesheet" href="{{ asset('vendors/intro.js/introjs.css') }}">
		<link type="text/css" rel="stylesheet" href="{{ asset('vendors/calendar/zabuto_calendar.min.css') }}">
		<link type="text/css" rel="stylesheet" href="{{ asset('vendors/calendar/zabuto_calendar.min.css') }}">
		<link type="text/css" rel="stylesheet" href="{{ asset('vendors/sco.message/sco.message.css') }}">
		<link type="text/css" rel="stylesheet" href="{{ asset('vendors/intro.js/introjs.css') }}">
		<link type="text/css" rel="stylesheet" href="{{ asset('vendors/DataTables/media/css/jquery.dataTables.css') }}">
		<link type="text/css" rel="stylesheet" href="{{ asset('vendors/DataTables/extensions/TableTools/css/dataTables.tableTools.min.css') }}">
		<link type="text/css" rel="stylesheet" href="{{ asset('vendors/DataTables/media/css/dataTables.bootstrap.css') }}">
		<!--Loading style vendors3-->
		<link type="text/css" rel="stylesheet" href="{{ asset('vendors/animate.css/animate.css') }}">
		<link type="text/css" rel="stylesheet" href="{{ asset('vendors/jquery-pace/pace.css') }}">
		<link type="text/css" rel="stylesheet" href="{{ asset('vendors/iCheck/skins/all.css') }}">
		<link type="text/css" rel="stylesheet" href="{{ asset('vendors/jquery-notific8/jquery.notific8.min.css') }}">
		{{--
		<link type="text/css" rel="stylesheet" href="{{ asset('vendors/bootstrap-daterangepicker/daterangepicker-bs3.css') }}">
		<link type="text/css" rel="stylesheet" href="{{ asset('vendors/bootstrap-colorpicker/css/colorpicker.css') }}">
		<link type="text/css" rel="stylesheet" href="{{ asset('vendors/bootstrap-datepicker/css/datepicker.css') }}">
		--}}
		{{--
		<link type="text/css" rel="stylesheet" href="{{ asset('vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}">
		--}}
		{{--
		<link type="text/css" rel="stylesheet" href="{{ asset('vendors/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
		--}}
		<link type="text/css" rel="stylesheet" href="{{ asset('vendors/bootstrap-clockface/css/clockface.css') }}">
		<link type="text/css" rel="stylesheet" href="{{ asset('vendors/bootstrap-switch/css/bootstrap-switch.css') }}">
		<link type="text/css" rel="stylesheet" href="{{ asset('css/themes/style1/orange-blue.css') }}" class="default-style">
		<link type="text/css" rel="stylesheet" href="{{ asset('css/themes/style1/orange-blue.css') }}" id="theme-change" class="style-change color-change">
		<link type="text/css" rel="stylesheet" href="{{ asset('css/themes/style2/orange-blue.css') }}" id="theme-change" class="style-change color-change">
		<link type="text/css" rel="stylesheet" href="{{ asset('css/style-responsive.css') }}">
		<link type="text/css" rel="stylesheet" href="{{ asset('dist/sweetalert.css') }}">
		<link type="text/css" rel="stylesheet" href="{{ asset('plugins/chosen/chosen.css') }}">
		<link type="text/css" rel="stylesheet" href="{{ asset('fullcalendar/fullcalendar.css') }}"/>
		<link type="text/css" rel="stylesheet" href="{{ asset('vendors/jquery-toastr/toastr.min.css') }}">
		<link type="text/css" rel="stylesheet" href="{{ asset('css/letrasmagicas.css') }}">
		<link type="text/css" rel="stylesheet" href="{{ asset('css/validationEngine.jquery.css') }}" type="text/css"/>
		<link type="text/css" rel="stylesheet" href="{{ asset('bower_components/EasyAutocomplete/dist/easy-autocomplete.min.css') }}" type="text/css"/>
		<link type="text/css" rel="stylesheet" href="{{url('')}}/local/css/ionicons.min.css">
		<link type="text/css" rel="stylesheet" href="{{ asset('css/ticket.css') }}" media="screen"/>
		{{--
		<link type="text/css" rel="stylesheet" href="{{ asset('calendarmaterial/material-datepicker/css/material.datepicker.css') }}">
		--}}
		<link type="text/css" rel="stylesheet" href="{{url('')}}/local/css/ng-ckeditor.css"/>
		{{--
		<link type="text/css" rel="stylesheet" href="{{ asset('node_modules/material-date-picker/build/styles/mbdatepicker.css') }}"/>
		--}}
		<link type="text/css" rel="stylesheet" href="{{ asset('css/dualmultiselect.css') }}">
		<link type="text/css" rel="stylesheet" href="{{ asset('css/sider.css') }}">
		<link type="text/css" rel="stylesheet" href="{{ asset('css/build.css') }}">
		<style type="text/css">
			input {
			//border: 1px solid #4195fc; /* some kind of blue border */
			-webkit-border-radius: 4px;
			-moz-border-radius: 4px;
			border-radius: 4px;
			//-webkit-box-shadow: 0px 0px 4px #4195fc;
			-moz-box-shadow: 0px 0px 4px #4195fc;
			//box-shadow: 0px 0px 4px #4195fc; /* some variation of blue for the shadow */
			}
			.select2-results .select2-highlighted {
			background: #3875d7 !important;
			color: #fff;
			label {color: grey;}
			.required{
		        color:red;
		        font-weight: bold;
		    }

		</style>
		<link type="text/css" rel="stylesheet" href="{{ asset('css/iphone.css') }}">
		<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"/>
		<link type="text/css" rel="stylesheet" href="{{url('')}}/local/css/export.css" media="all" />
		<link type="text/css" rel="stylesheet" href="{{ asset('js/ng-tags-input.min.css') }}" />
		<link type="text/css" rel="stylesheet" href="{{ asset('vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}">
		<link type="text/css" rel="stylesheet" href="{{url('')}}/css/loading.css">
		<script type="text/javascript" src="{{url('')}}/local/js/jquery.js"></script>
		<script type="text/javascript" src="{{url('')}}/local/js/jquery-ui.js"></script>
		<script type="text/javascript" src="{{url('')}}/js/session.active.js<?= '?v='.date('YmdHis');?>"></script>
		<script type="text/javascript" src="{{ asset('ui/i18n/datepicker-es.js') }}"></script>
		<script type="text/javascript" src="{{url('')}}/local/js/angular.min.js"></script>
		<script type="text/javascript" src="{{url('')}}/local/js/angular-route.js"></script>
		<script type="text/javascript" src="{{url('')}}/local/js/angular-messages.js"></script>
		<script type="text/javascript" src="{{url('')}}/local/js/angular-deckgrid.js"></script>
		<script type="text/javascript" src="{{url('')}}/local/js/angular-selector.js"></script>
		<script type="text/javascript" src="{{url('')}}/local/js/angular-sanitize.js"></script>
		<script type="text/javascript" src="{{ asset('js/timepickerpop.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/select.js') }}"></script>
		<script type="text/javascript" src="{{ asset('proui/js/vendor/modernizr-2.7.1-respond-1.4.2.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('dist/sweetalert-dev.js') }}"></script>
		{{-- <script type="text/javascript" src="{{url('')}}/local/js/angular.min.js"></script> --}}
		<script type="text/javascript" src="{{url('')}}/local/js/ui-bootstrap-tpls-0.10.0.js"></script>
		<script type="text/javascript" src="{{url('')}}/local/js/amcharts.js"></script>
		<script type="text/javascript" src="{{url('')}}/local/js/serial.js"></script>
		<script type="text/javascript" src="{{url('')}}/local/js/pie.js"></script>
		<script type="text/javascript" src="{{url('')}}/local/js/export.min.js"></script>
		<script type="text/javascript" src="{{url('')}}/local/js/light.js"></script>
		@include('angular.template.script')
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.18.0/jquery.validate.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.18.0/localization/messages_es.min.js"></script>
		<link rel="stylesheet" href="{{url('/css/validate.css')}}">
		<script>$(function(){$("form").validate();})</script>
		<style></style>
		<script type="text/javascript" src="{{url('')}}/js/loading.js"></script>
	</head>
	<body class=" ">
		<div align="center"><img src="{{ asset('images/BANNER.png') }}" width="100%"></div>
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
					<a id="logo" href="/" class="navbar-brand"><span class="fa fa-rocket"></span><span class="logo-text" style="">SEMILLEROS
					</span>
					<span style="display: none" class="logo-text-icon">µ</span></a>
				</div>
				<div class="topbar-main">
					<ul class="nav navbar-nav">
						<li class="active"><a href="index.html">Dashboard</a></li>
						<li>
							<a href="javascript:;" data-toggle="dropdown" class="dropdown-toggle">Layouts
							&nbsp;<i class="fa fa-angle-down"></i></a>
							<ul class="dropdown-menu">
								<li><a href="layout-left-sidebar.html">Left Sidebar</a></li>
								<li><a href="layout-right-sidebar.html">Right Sidebar</a></li>
								<li><a href="layout-left-sidebar-collapsed.html">Left Sidebar Collasped</a></li>
							</ul>
						</li>
						<li class="mega-menu-dropdown">
							<a href="javascript:;" data-toggle="dropdown"
								class="dropdown-toggle">UI Elements
							&nbsp;<i class="fa fa-angle-down"></i></a>
							<ul class="dropdown-menu">
							</ul>
						</li>
						<li class="mega-menu-dropdown mega-menu-full">
							<a href="javascript:;" data-toggle="dropdown"
								class="dropdown-toggle">Extras
							&nbsp;<i class="fa fa-angle-down"></i></a>
							<ul class="dropdown-menu">
							</ul>
						</li>
					</ul>
					@if (!is_null(Auth::user()))
					@if(Auth::user()->hasRole('METODÓLOGO'))
					<style type="text/css">
						li.notifi-all
						{
							background-color: #c3c3c3;
						}
						li.jewelItemNew
						{
						    background-color: #edf2fa;
						}
						.counter{
						  	background-color: #fa3e3e;
						    color: #fff;
						    padding: 1px 5px;
						    font-size: 10px;
						    position: absolute;
						    border-radius: 10px;
						    top: 10px;
						    right: 10px;
						}
					</style>
					<script type="text/javascript">
						function notifi_load()
						{
							$.ajax({
								url:base+'/notifi/load',
								dataType:'json',
								success:function(data)
								{
									if(data.validate)
									{
										if(data.sin_leer)
										{
											$('#counter').html(data.sin_leer);
											$('#counter').addClass('counter');
										}
										var html='';
										$.each(data.data,function(index,value)
										{
											html+='<li'+(parseInt(value.leido_monitor)==1?' class="jewelItemNew"':'') +'>'+
											'<a href="'+base+'/novedad/registro'+value.id+'">'+
											'<div direction="left" class="clearfix">'+
											'</div>'+
											'<div class="">'+
											'<div class="_42ef clearfix" direction="right">'+
											'<div class="_ohf rfloat"><div><span></span><div class="x_div">'+
											'<div aria-label="Marcar como leído" class="_5c9q" data-hover="tooltip" data-tooltip-alignh="center" data-tooltip-content="Marcar como leído" role="button" tabindex="0"></div></div></div></div><div class="">'+
											'<div class="content"><div class="author"><strong><span>'+
											value.monitor+'</span></strong><span class="presenceIndicator"><span class="accessible_elem"></span></span></div><div class="_1iji"><div class="_1ijj"><span class="_3jy5"></span><span><span>'+value.nombre+'</span></span></div><div></div></div><div class="time"><abbr class="timestamp" title="value.fecha_creacion">'+value.fecha_creacion+'</abbr></div></div></div></div></div></div></a></li>';
										});
										html+='<li class="notifi-all"><a href="'+base+'/novedad/listmonitor">Ver todas las novedades</li>';
										$('#notifi-list').html(html);
									}
								}
							});
						}
						$(function()
						{
							notifi_load();
						})
					</script>
					<ul class="nav navbar navbar-top-links navbar-right mbn">
						<li class="dropdown topbar-user">
							<a data-hover="dropdown" id="notifi-wolrd" href="#" class="dropdown-toggle"><img
								src="{{ asset('img/notifi.png') }}" alt=""
								class="img-responsive img-circle"/>
							</a>
							<span id="counter"></span>
							<ul class="dropdown-menu dropdown-user" id="notifi-list">

							</ul>

						</li>
					</ul>
					@endif
					@endif
					<ul class="nav navbar navbar-top-links navbar-right mbn">
						<li class="dropdown topbar-user">
							<a data-hover="dropdown" href="#" class="dropdown-toggle"><img
								src="{{ asset('images/admin-icon.png') }}" alt=""
								class="img-responsive img-circle"/></a>
							<ul class="dropdown-menu dropdown-user">
								@guest
								<li><a href="{{ route('login') }}"><i class="fa fa-user"></i>Login</a></li>
								@else
								<li>
									<a href="{{ route('logout') }}" class="grey-text text-darken-1" onclick="event.preventDefault();
										document.getElementById('logout-form').submit();">
									<i class="fa fa-sign-out"></i> Cerrar Sesión
									</a>
									<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
										{{ csrf_field() }}
									</form>
								</li>
								<li><a href="usuario/cambiar"><i class="fa fa-lock"></i> Cambiar contraseña</a></li>
								</li>
								<li><a href="{!! url('/') !!}"><i class="fa fa-user"></i> Datos personales</a></li>
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
							<h4 class="modal-title">Modal title</h4>
						</div>
						<div class="modal-body">
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eleifend et
								nisl eget porta. Curabitur elementum sem molestie nisl varius, eget tempus odio molestie. Nunc
								vehicula sem arcu, eu pulvinar neque cursus ac. Aliquam ultricies lobortis magna et aliquam.
								Vestibulum egestas eu urna sed ultricies. Nullam pulvinar dolor vitae quam dictum condimentum.
								Integer a sodales elit, eu pulvinar leo. Nunc nec aliquam nisi, a mollis neque. Ut vel felis
								quis tellus hendrerit placerat. Vivamus vel nisl non magna feugiat dignissim sed ut nibh. Nulla
								elementum, est a pretium hendrerit, arcu risus luctus augue, mattis aliquet orci ligula eget
								massa. Sed ut ultricies felis.
							</p>
						</div>
						<div class="modal-footer">
							<button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
							<button type="button" class="btn btn-primary">Save changes</button>
						</div>
					</div>
				</div>
			</div>
			<!--END MODAL CONFIG PORTLET-->
		</div>
		<!--END TOPBAR-->
		<div id="wrapper">
			<!--BEGIN SIDEBAR MENU-->
			<nav id="sidebar" role="navigation" class="navbar-default navbar-static-side">
				@include('angular.template.menu')
			</nav>
			<!--END SIDEBAR MENU--><!--BEGIN CHAT FORM-->
			<!--END CHAT FORM--><!--BEGIN PAGE WRAPPER-->
			<div id="page-wrapper">
				<!--BEGIN TITLE & BREADCRUMB PAGE-->
				<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
					<div class="page-header pull-left">
						<div class="page-title">
							<h4 class="box-heading">@yield('title')</h4>
						</div>
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
				<!--END CONTENT-->
			</div>
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
											<span>Todos los Derechos Reservados © {{date('Y')}}</span>
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
								</div>
							</div>
						</div>
						<div class="bloqueZona3  tipoDisplay">
							<div class="tabla1 tablaBloque100993  " style=".">
								<div class="contenido1">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="copyright">{{date('Y')}} © Secretaria de Deportes</div>
			</div>
		</div>
		<style>
			input[type=number]::-webkit-inner-spin-button,
			input[type=number]::-webkit-outer-spin-button {
			-webkit-appearance: none;
			margin: 0;
			}

			input[type=number] { -moz-appearance:textfield; }
			</style>
	</body>
</html>
