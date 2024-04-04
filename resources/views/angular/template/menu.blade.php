<?php
try
{

    $TieneRol = App\Http\Controllers\PostRolesController::TieneRol();
    $MiRol    = 'SIN ROL';
    if ($TieneRol)
    {
        $MiRol = App\Http\Controllers\PostRolesController::MiRol();
        $data  = \App\Http\Controllers\PostRolesController::verroles_user();

        if ($data != '')
        {

            // dd($data);

            echo '<style>' . $data . '{display:none !important;}</style>';
        }
    } else
    {

        echo '<style>.ver_rol{display:none !important;}</style>';
    }

    // Menu reporteador 
    $reportesReporteador = \App\Http\Controllers\PostReporteadorController::menuReportesReporteador();

} catch (Exception $e)
{
    var_dump($e);
}
?>
@guest
@else
<link rel="stylesheet" type="text/css" href="http://cdn.jsdelivr.net/npm/jquery-easy-loading/dist/jquery.loading.min.css">
<style>
    input[type=number]::-webkit-inner-spin-button, 
    input[type=number]::-webkit-outer-spin-button { 
    -webkit-appearance: none; 
    margin: 0; 
    }
    input[type=number] { -moz-appearance:textfield; }
    input{text-transform: uppercase;}
    .dir_format{
    width: 100%;
    }
    .row{
    padding-top: 10px;
    }
    .data_hide{
    display: none !important;
    }
</style>
<div class="sidebar-collapse menu-scroll">
    <ul id="side-menu" class="nav">
        <li class="user-panel">
            <div class="thumb"><img src="{{ asset('images/admin-icon.png') }}" alt="" class="img-circle"></div>
            @if(Auth::check())
            <div class="info">
                <p align="center" style="font-size: 12px; text-transform: uppercase;">{{$MiRol}}</p>    
                <p style="font-size: 12px;">{{ strtoupper(Auth::user()->primer_nombre) }} {{ strtoupper(Auth::user()->primer_apellido) }}</p>
                <ul class="list-inline list-unstyled">
                </ul>
            </div>
            @endif
            <div class="clearfix"></div>
        </li>


        <li>
        <a href="#">
                <i class="fa fa-file" aria-hidden="false">
                    <div class="icon-bg bg-orange"></div>
                </i>
                <span class="menu-title"> Novedades</span>
                <span class="fa arrow"></span>
                <span class="label label-yellow"></span>
            </a>
            <ul class="nav nav-second-level">
                <li class="novedades-list">
                    <a href="{{url('')}}/novedades/index">
                        <i class="fa fa-plus-square"></i>
                        <span class="submenu-title">Mis novedades</span>
                    </a>
                </li>
                <li class="novedades_mis_monitores">
                    <a href="{{url('')}}/novedad/listmonitor">
                        <i class="fa fa-address-card"></i>
                        <span class="submenu-title">Novedades de mis monitores</span>
                    </a>
                </li>   
                @if($MiRol=='GESTIÓN HUMANA')
                <li class="novedades_mis_monitores">
                    <a href="{{url('')}}/novedad/listmonitores">
                        <i class="fa fa-address-card"></i>
                        <span class="submenu-title">Novedades de  monitores</span>
                    </a>
                </li>
                 @endif
            </ul>
        </li>    
        <li>
            <a href="#">
                <i class="fa fa-file" aria-hidden="false">
                    <div class="icon-bg bg-orange"></div>
                </i>
                <span class="menu-title"> Mi perfil</span>
                <span class="fa arrow"></span>
                <span class="label label-yellow"></span>
            </a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="{{url('')}}/personal/datos">
                        <i class="fa fa-plus-square"></i>
                        <span class="submenu-title">Datos personales</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('')}}/personal/hojavida">
                        <i class="fa fa-address-card"></i>
                        <span class="submenu-title">Hoja de vida</span>
                    </a>
                </li>
                <li class="hojavida-list">
                    <a href="{{url('')}}/personal/index">
                        <i class="fa fa-address-book"></i>
                        <span class="submenu-title">Hoja de vida subidas</span>
                    </a>
                </li>

                <li>
                    <a href="{{url('')}}/documentos/index">
                        <i class="fa fa-folder-open"></i>
                        <span class="submenu-title">Mis documentos</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('')}}/documentos/archivos">
                        <i class="fa fa-files-o"></i>
                        <span class="submenu-title">Archivos</span>
                    </a>
                </li>

            </ul>
        </li>


<!-- NO MUESTRA -->

        <li>
            <a href="#">
                <i class="fa fa-usd" aria-hidden="false">
                    <div class="icon-bg bg-orange"></div>
                </i>
                <span class="menu-title"> Módulo contable</span>
                <span class="fa arrow"></span>
                <span class="label label-yellow"></span>
            </a>
            <ul class="nav nav-second-level">
                <li class="ver_rol ver-roles">
                    <a href="{{url('')}}/cdp/index">
                        <i class="fa fa-plus-square"></i>
                        <span class="submenu-title">Ingresar informacion de contratistas</span>
                    </a>
                </li>
                <li class="ver_rol ver-roles">
                    <a href="{{url('')}}/cdp/carga">
                        <i class="fa fa-plus-square"></i>
                        <span class="submenu-title">Carga masiva de contratistas</span>
                    </a>
                </li>
                <li class="cuentas-cobro-subidas">
                    <a href="{{url('')}}/cdp/all">
                        <i class="fa fa-plus-square"></i>
                        <span class="submenu-title">Cuentas de cobro subidas</span>
                    </a>
                </li>
                <li class="">
                    <a href="{{url('')}}/cpd/list">
                        <i class="fa fa-plus-square"></i>
                        <span class="submenu-title">Mis cuentas de cobro</span>
                    </a>
                </li>

            </ul>
        </li>
<!-- NO MUESTRA -->


        <li class="ver_rol mostrar-usuarios">
            <a href="#">
                <i class="fa fa-user" aria-hidden="false">
                    <div class="icon-bg bg-orange"></div>
                </i>
                <span class="menu-title">Gestión Usuarios</span>
                <span class="fa arrow"></span>
                <span class="label label-yellow"></span>
            </a>
            <ul class="nav nav-second-level">
                <li class="ver_rol ver-roles">
                    <a href="{{url('/admin/postroles#/admin/postroles')}}">
                        <i class="fa fa-list-ol"></i>
                        <span class="submenu-title">Roles y Permisos</span>
                    </a>
                </li>
                <li class="ver_rol ver-usuarios">
                    <a href="{{url('/admin/postusuarios#/admin/postusuarios')}}">
                        <i class="fa fa-plus-square"></i>
                        <span class="submenu-title">Usuarios</span>
                    </a>
                </li>
            </ul>

        </li>
        <li class="ver_rol mostrar-gest-administrativa">
            <a href="#">
                <i class="fa fa-wrench" aria-hidden="false">
                    <div class="icon-bg bg-orange"></div>
                </i>
                <span class="menu-title">Gest. Administrativa</span>
                <span class="fa arrow"></span>
                <span class="label label-yellow"></span>
            </a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="{{url('/admin/postzonas#/admin/postzonas')}}">
                        <i class="fa fa-list-ol"></i><span class="submenu-title">Zonas</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/admin/postcomunas#/admin/postcomunas')}}">
                        <i class="fa fa-plus-square"></i>
                        <span class="submenu-title">Comunas</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/admin/postbarrios#/admin/postbarrios')}}">
                        <i class="fa fa-plus-square"></i>
                        <span class="submenu-title">Barrios</span></a>
                </li>
            </ul>
        </li>
        <li class="ver_rol">
            <a href="#">
                <i class="fa fa-wrench" aria-hidden="false">
                    <div class="icon-bg bg-orange"></div>
                </i>
                <span class="menu-title">Gest. Horarios</span>
                <span class="fa arrow"></span>
                <span class="label label-yellow"></span>
            </a>
            <ul class="nav nav-second-level">
                <li class="ver_rol crear-planificacion">
                    <a href="{{url('/Horarios/index')}}"><i class="fa fa-list-ol"></i>
                        <span class="submenu-title">Planificacion</span></a>
                </li>
                <li class="ver-planificaciones">
                    <a href="{{url('/Horarios/planeaciones')}}"><i class="fa fa-list-ol"></i>
                        <span class="submenu-title">Ver planificaciones</span></a>
                </li>
                <li class="ver_rol crear-asistencias">
                    <a href="{{url('/Horarios/Asistencias')}}"><i class="fa fa-plus-square"></i>
                        <span class="submenu-title">Asistencias</span>
                    </a>
                </li>
                <li class="asistencias-metodologo">
                    <a href="{{url('/Horarios/Asistencia')}}"><i class="fa fa-plus-square"></i>
                        <span class="submenu-title">Asistencias</span>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="{{url('')}}/georreferenciacion/index"><i class="fa fa-codepen" aria-hidden="false">
                <div class="icon-bg bg-orange"></div>
                </i><span class="menu-title">Gráficos por comuna</span><span class="fa arrow"></span><span class="label label-yellow"></span>
            </a>
        </li>
        <li class="ver-gestion_inventario">
            <a href="#">
                <i class="fa fa-building" aria-hidden="false">
                    <div class="icon-bg bg-orange"></div>
                </i>
                <span class="menu-title">Gest. Inventario</span>
                <span class="fa arrow"></span>
                <span class="label label-yellow"></span>
            </a>
            <ul class="nav nav-second-level">

                <li>
                    <a href="{{url('/admin/clasificaciones')}}">
                        <i class="fa fa-list-ol"></i>
                        <span class="submenu-title">Clasificaciones</span>
                    </a>
                </li>

                <li>
                    <a href="{{url('/admin/proveedor')}}">
                        <i class="fa fa-list-ol"></i>
                        <span class="submenu-title">Proveedores</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/admin/implementos')}}">
                        <i class="fa fa-list-ol"></i>
                        <span class="submenu-title">Implementos</span>
                    </a>
                </li>

                <li>
                    <a href="{{url('/admin/inventariofisico')}}">
                        <i class="fa fa-list-ol"></i>
                        <span class="submenu-title">Inventario Fisico </span>
                    </a>
                </li>
            
                <li>
                    <a href="{{url('/admin/prestamoinventario')}}">
                        <i class="fa fa-list-ol"></i>
                        <span class="submenu-title">Prestamos</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/admin/devolucioninventario')}}">
                        <i class="fa fa-list-ol"></i>
                        <span class="submenu-title">Devoluciones</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="ver_rol mostrar-gest-infraestructura">
            <a href="#">
                <i class="fa fa-building" aria-hidden="false">
                    <div class="icon-bg bg-orange"></div>
                </i>
                <span class="menu-title">Gest. Infraestructura</span>
                <span class="fa arrow"></span>
                <span class="label label-yellow"></span>
            </a>
            <ul class="nav nav-second-level">

                <li class="ver-disciplinas">
                    <a href="{{url('/disciplinas/index')}}">
                        <i class="fa fa-list-ol"></i>
                        <span class="submenu-title">Disciplinas deportivas</span>
                    </a>
                </li>

                <li class="ver-instituciones">
                    <a href="{{url('/institucioneseducativas/index')}}">
                        <i class="fa fa-list-ol"></i>
                        <span class="submenu-title">Instituciones educativas</span>
                    </a>
                </li>

                <li class="ver-eps">
                    <a href="{{url('/admin/posteps')}}">
                        <i class="fa fa-list-ol"></i>
                        <span class="submenu-title">EPS </span>
                    </a>
                </li>


                <li class="ver_rol ver-tipoescenarios">
                    <a href="{{url('/admin/posttipoescenarios#/admin/posttipoescenarios')}}">
                        <i class="fa fa-list-ol"></i>
                        <span class="submenu-title">Tipo Escenarios</span>
                    </a>
                </li>
                <li class="ver_rol ver-escenarios">
                    <a href="{{url('/admin/postescenarios#/admin/postescenarios')}}">
                        <i class="fa fa-list-ol"></i>
                        <span class="submenu-title">Escenarios</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="ver_rol mostrar-Beneficiarios">
            <a href="#">
                <i class="fa fa-group" aria-hidden="false">
                    <div class="icon-bg bg-orange"></div>
                </i>
                <span class="menu-title">Gest. Beneficiarios</span>
                <span class="fa arrow"></span>
                <span class="label label-yellow"></span>
            </a>
            <ul class="nav nav-second-level">
                <li class="ver_rol ver-beneficiarios">
                    <a href="{{url('/admin/postbeneficiarios#/admin/postbeneficiarios')}}">
                        <i class="fa fa-list-ol"></i>
                        <span class="submenu-title">Listar Beneficiarios</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="ver_rol">
            <a href="#">
                <i class="fa fa-th-large" aria-hidden="false">
                    <div class="icon-bg bg-orange"></div>
                </i>
                <span class="menu-title">Gest. Grupos</span>
                <span class="fa arrow"></span>
                <span class="label label-yellow"></span>
            </a>
            <ul class="nav nav-second-level">
            @if($MiRol=='SUPERADMIN')
            <li class="">
                    <a href="{{url('/Metodologos/monitores_grupos')}}">
                        <i class="fa fa-list-ol"></i>
                        <span class="submenu-title">Relación monitores por metodólogos</span>
                    </a>
                </li>
                  @endif

                
                @if($MiRol=='SUPERADMIN') 
                <li class="">
                    <a href="{{url('/deporvida/reportesesiones')}}">
                        <i class="fa fa-list-ol"></i>
                        <span class="submenu-title">Clases de grupos reportadas</span>
                    </a>
                </li>
                  @endif
                
                    @if($MiRol=='COORDINADOR ZONAL') 
                <li class="">
                    <a href="{{url('/deporvida/reportesesiones')}}">
                        <i class="fa fa-list-ol"></i>
                        <span class="submenu-title">Clases de grupos reportadas</span>
                    </a>
                </li>
                  @endif   


                    @if($MiRol=='coordinador territorial') 
                <li class="">
                    <a href="{{url('/deporvida/reportesesiones')}}">
                        <i class="fa fa-list-ol"></i>
                        <span class="submenu-title">Clases de grupos reportadas</span>
                    </a>
                </li>
                  @endif
                
              
                <li class="ver_rol ver-grupos">
                    <a href="{{url('/admin/postgrupos#/admin/postgrupos')}}">
                        <i class="fa fa-list-ol"></i>
                        <span class="submenu-title">Listar Grupos</span>
                    </a>
                </li>
                
                <li class="ver-reasignar">
                    <a href="{{url('')}}/metodologos/reasignar">
                        <i class="fa fa-list-ol"></i>
                        <span class="submenu-title">Reasignar Grupos a metodologos</span>
                    </a>
                </li>

            </ul>
        </li>

        <li class="ver_rol mostrar-evaluaciones">
            <a href="#">
                <i class="fa fa-pencil" aria-hidden="false">
                    <div class="icon-bg bg-orange"></div>
                </i>
                <span class="menu-title">Evaluación de Indicadores</span>
                <span class="fa arrow"></span>
                <span class="label label-yellow"></span>
            </a>
            <ul class="nav nav-second-level">
                <li class="ver_rol ver-ejes-tematicos">
                    <a href="{{url('admin/postejestematicos#/admin/postejestematicos')}}">
                        <i class="fa fa-pencil"></i>
                        <span class="submenu-title">Ejes Tematicos Psicosocial</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('admin/postreporte/indicadorestecnicos')}}">
                        <i class="fa fa-pie-chart"></i>
                        <span class="submenu-title">Reportes de indicadores</span>
                    </a>
                </li>
                <li class="ver_rol ver-niveles-tecnicos">
                    <a href="{{url('admin/postniveles#/admin/postniveles')}}">
                        <i class="fa fa-pencil"></i>
                        <span class="submenu-title">Niveles Técnicos</span>
                    </a>
                </li>
                <li class="ver_rol ver-calificaciones-escala">
                    <a href="{{url('admin/postcalificacionesescala#/admin/postcalificacionesescala')}}">
                        <i class="fa fa-pencil"></i>
                        <span class="submenu-title">Escala de Calificaciones</span>
                    </a>
                </li>
                <li class="ver_rol ver-indicadores">
                    <a href="{{url('admin/postindicadores#/admin/postindicadores')}}">
                        <i class="fa fa-pencil"></i>
                        <span class="submenu-title">Indicadores de Medición</span>
                    </a>
                </li>
                <li class="ver_rol ver-plazos-y-periodos-evaluaciones">
                    <a href="{{url('admin/postplazosyperiodosev#/admin/postplazosyperiodosev')}}">
                        <i class="fa fa-pencil"></i>
                        <span class="submenu-title">Plazos y Periodos</span>
                    </a>
                </li>
                <li class="ver_rol ver-evaluaciones-psicosocial">
                    <a href="{{url('admin/postevaluaciones#/admin/postevaluacionpsicosocial')}}">
                        <i class="fa fa-pencil"></i>
                        <span class="submenu-title">Evaluación Psicosocial</span>
                    </a>
                </li>
                <li class="ver_rol ver-evaluaciones-tecnica">
                    <a href="{{url('admin/postevaluaciones#/admin/postevaluaciontecnica')}}">
                        <i class="fa fa-pencil"></i>
                        <span class="submenu-title">Evaluación Técnica</span>
                    </a>
                </li>
            </ul>
        </li>
        
        <li class="ver_rol mostrar-reporteador">
            <a href="#">
                <i class="fa fa-building-o" aria-hidden="false">
                    <div class="icon-bg bg-orange"></div>
                </i>
                <span class="menu-title">Reporteador</span>
                <span class="fa arrow"></span>
                <span class="label label-yellow"></span>
            </a>
            <ul class="nav nav-second-level">
                <li class="ver_rol reporteador">
                    <a href="{{url('admin/postreporteador#/admin/postreporteador')}}">
                        <i class="fa fa-building-o"></i>
                        <span class="submenu-title">Reporteador</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="ver_rol mostrar-reportes">
            <a href="#">
                <i class="fa fa-file-text" aria-hidden="false">
                    <div class="icon-bg bg-orange"></div>
                </i>
                <span class="menu-title">Consultas y Reportes</span>
                <span class="fa arrow"></span>
                <span class="label label-yellow"></span>
            </a>
            <ul class="nav nav-second-level">
                <li class="ver_rol reporte-caracterizacion">
                    <a href="{{url('admin/postreporteficha#/admin/postreporteficha')}}">
                        <i class="fa fa-file-text"></i>
                        <span class="submenu-title">Ficha Caracterización</span>
                    </a>
                </li>
                <li class="ver-reporte-sencillo">
                    <a href="{{url('admin/postreportefichabasica#/admin/postreporteficha')}}">
                        <i class="fa fa-file-text"></i>
                        <span class="submenu-title">Cobertura por monitor</span>
                    </a>
                </li>
                <li class="ver_rol reporte-parrilla">
                    <a href="{{url('admin/postreporteparrilla#/admin/postreporteparrilla')}}">
                        <i class="fa fa-file-text"></i>
                        <span class="submenu-title">Parrilla de Actividades</span>
                    </a>
                </li>
                <li class="informeasistencias">
                    <a href="{{url('Horarios/informeasistencias')}}">
                        <i class="fa fa-file-text"></i>
                        <span class="submenu-title">Informe de asistencias</span>
                    </a>
                </li>
                
                @foreach ($reportesReporteador as $reporte) 
                    <li class="ver_rol {{$reporte->name}}">
                        <a href="{{url('admin/postreporteadorvisor#/admin/postreporteadorvisor/'.base64_encode($reporte->description))}}">
                            <i class="fa fa-file-text"></i>
                            <span class="submenu-title">{{preg_replace('/_/', ' ', str_replace('reporte-','',$reporte->name))}}</span>
                        </a>
                    </li>
                @endforeach

            </ul>
        </li>

        <li class="ver_rol mostrar-reportes-graficos">
            <a href="#">
                <i class="fa fa-pie-chart" aria-hidden="false">
                    <div class="icon-bg bg-orange"></div>
                </i>
                <span class="menu-title">Reportes Gráficos</span>
                <span class="fa arrow"></span>
                <span class="label label-yellow"></span>
            </a>
            <ul class="nav nav-second-level">
                <li class="ver_rol reporte-Tablero_de_Control">
                        <a href="{{url('admin/postreporteadorvisor#/admin/postreporteadorvisor/'.base64_encode('/Deporvida/Reportes/Dashboard_Deporvida'))}}">
                        <i class="fa fa-tachometer"></i>
                        <span class="submenu-title">Tablero de Control</span>
                    </a>
                    <a href="{{url('panelcontrol/index')}}">
                        <i class="fa fa-tachometer"></i>
                        <span class="submenu-title">Tablero de Control - v2</span>
                    </a>
                    
                </li>
                <li class="reporte-Indicadores_Psicosociales">
                    <a href="{{url('/evaluaciones')}}">
                        <i class="fa fa-pie-chart"></i>
                        <span class="submenu-title">Indicadores Psicosociales y tecnicos </span>
                    </a>
                </li>
                <li class="ver_rol reporte-Indicadores_Psicosociales">
                    <a href="{{url('admin/postreporteadorvisor#/admin/postreporteadorvisor/'.base64_encode('/Deporvida/Reportes/Indicadores_Psicosociales'))}}">
                        <i class="fa fa-pie-chart"></i>
                        <span class="submenu-title">Indicadores Psicosociales</span>
                    </a>
                </li>
                <li class="ver_rol reporte-Indicadores_Tecnicos">
                    <a href="{{url('admin/postreporteadorvisor#/admin/postreporteadorvisor/'.base64_encode('/Deporvida/Reportes/Indicadores_Tecnicos'))}}">
                        <i class="fa fa-pie-chart"></i>
                        <span class="submenu-title">Indicadores Técnicos</span>
                    </a>
                </li>

                
            </ul>
        </li>
        
    </ul>
</div>
@endguest