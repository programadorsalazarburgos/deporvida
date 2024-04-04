@extends('angular.frontend.master')
@section('title', 'Ver asistencias tomadas')
@section('content')
<style>
    .onoffswitch {
        position: relative; width: 90px;
        -webkit-user-select:none; -moz-user-select:none; -ms-user-select: none;
    }
    .onoffswitch-checkbox {
        display: none;
    }
    .onoffswitch-label {
        display: block; overflow: hidden; cursor: pointer;
        border: 2px solid #999999; border-radius: 20px;
    }
    .onoffswitch-inner {
        display: block; width: 200%; margin-left: -100%;
        transition: margin 0.3s ease-in 0s;
    }
    .onoffswitch-inner:before, .onoffswitch-inner:after {
        display: block; float: left; width: 50%; height: 30px; padding: 0; line-height: 30px;
        font-size: 14px; color: white; font-family: Trebuchet, Arial, sans-serif; font-weight: bold;
        box-sizing: border-box;
    }
    .onoffswitch-inner:before {
        content: "SI";
        padding-left: 10px;
        background-color: #34C234; color: #FFFFFF;
    }
    .onoffswitch-inner:after {
        content: "NO";
        padding-right: 10px;
        background-color: #FF0000; color: #EEEEEE;
        text-align: right;
    }
    .onoffswitch-switch {
        display: block; width: 18px; margin: 6px;
        background: #FFFFFF;
        position: absolute; top: 0; bottom: 0;
        right: 56px;
        border: 2px solid #999999; border-radius: 20px;
        transition: all 0.3s ease-in 0s; 
    }
    .onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-inner {
        margin-left: 0;
    }
    .onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-switch {
        right: 0px; 
    }
</style>

<script type="text/javascript" src="js/functions.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.16/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.16/datatables.min.js"></script>
<!--
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/bs-3.3.5/jq-2.1.4,dt-1.10.8/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/r/bs-3.3.5/jqc-1.11.3,dt-1.10.8/datatables.min.js"></script>
-->
<script type="text/javascript">
function CargarRegistro() 
{
       var table = $("#listado_asistencias").DataTable (
       {
                    destroy: true,
                    language: {url: base + "/js/languages/datatable.Spanish.json"},
                    ajax:base+'/Horarios/MisAsistencia/'+$('#fecha_ini').val()+'/'+$('#fecha_fin').val(),
                    pageLength:$('#pagination_value').val(),
                    "ordering": false,
                    "serverSide": true,
                    "columns" : [
                        { "data" : "fecha_asistencia" , "title": "Fecha" },
                        { "data" : "monitor" , "title": "Monitor" },
                        { "data" : "codigo_grupo" , "title": "Codigo" },
                        { "data" : "disciplina" , "title": "Disciplina" },
                        { "data" : "nombre_escenario" , "title": "Escenario" },
                        {
                            data: 'id_grupo', "title": "Opciones", 
                            render:function (id_grupo) 
                            {
                                return '<div class="btn-group pull-right">'+
                                '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Acciones <span class="fa fa-caret-down"></span></button>'+
                                '    <ul class="dropdown-menu">'+
                                '        <li>'+
                                '           <a href="Asistencias/beneficiarios/'+id_grupo+'"><i class="fa fa-pencil-square-o"></i>&nbsp;Ver Asistencias</a>'+
                                //'            <a href="#'+base+'/Horario/Editar/'+id_grupo+'"><i class="fa fa-pencil-square-o"></i>&nbsp;Editar</a>'+
                                '        </li>'+
                                '    </ul>'+
                                '</div>';
                                $('.imp').printPage();
                            }
                        }
                    ]
        });
       //$("#listado_asistencias").removeClass('display').addClass('table table-striped table-bordered');
        /*
        $('.search_value').on('keyup', function () 
        {
            table.search(this.value).draw();
        });
        $('.pagination_value').change(function()
        {
            $('#table_planeacion_length').hide();
            table.page.len($('.pagination_value').val()).draw();
            console.log(table.rows().count());
        });*/
}
$(function ()
{
    CargarRegistro();
});
</script>
<div class="page-content">
    <div id="tab-general">
        <div id="sum_box" class="row mbl">
            <section>
                <div class="container">
                    <!-- ngView: undefined --><ng-view class="ng-scope"><section class="content ng-scope">
                            <div class="row">
                                <div class="col-md-12">
                                    <form class="form-horizontal ng-pristine ng-invalid ng-invalid-required ng-valid-time ng-valid-maxlength" id="form" >
                                        <div class="nav-tabs-custom">
                                            <ul class="nav nav-tabs">
                                                <li class="active"><a href="#details" data-toggle="tab" aria-expanded="false">
                                                        <span class="label label-success" id="codigo">Asignación de asistencias</span> <span class="label label-primary ng-pristine ng-untouched ng-valid ng-binding" ng-model="codigo" id="codigo"></span>
                                                    </a></li>
                                            </ul>
                                            <div class="tab-content">
                                                <div id="resultados_ajax"></div>
                                                <div class="tab-pane active" id="details">
                                                    <div class="clearfix"></div>
                                                    <br>
                                                </div>
                                                <div class="container-fluid">
                                                <div class="col-md-4">
                                                        <label for="">Fecha de inicio</label>
                                                        <input type="text" value="{{$fi}}" id="fecha_ini" class="form fecha form-control">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="">Fecha de fin</label>
                                                        <input type="text" value="{{$ff}}" id="fecha_fin" class="form fecha form-control">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <button type="button" class="btn btn-success" onclick="CargarRegistro()">Buscar</button>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <br>
                                                <table id="listado_asistencias" class="table table-hover table-striped table-bordered table-advanced tablesorter dataTable no-footer">
                                                    
                                                </table>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>


                            <div class="messages"></div><br><br>
                            <!--div para visualizar en el caso de imagen-->
                            <div class="showImage"></div>


                        </section>
                    </ng-view>
                </div>

            </section>
            <!-- AQUI VA TODO EL CONTENDIDO -->
            @stop