@extends('angular.frontend.master')
@section('title', 'Relación de metodólogos y monitores')
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
<script>
$(function()
{
$('#data_monitores').DataTable();
});</script>
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
                                                        <span class="label label-success" id="codigo">Relación de metodólogos y monitores</span> <span class="label label-primary ng-pristine ng-untouched ng-valid ng-binding" ng-model="codigo" id="codigo"></span>
                                                    </a></li>
                                            </ul>
                                            <div class="tab-content">
                                                <div id="resultados_ajax"></div>
                                                <div class="tab-pane active" id="details">
                                                    <div class="clearfix"></div>
                                                    <br>
                                                </div>
                                                <div class="container-fluid">
                                                <table id="data_monitores" class="table table-hover">
                                                <thead>
                                                <tr>
                                                <th>Codigo grupo</th>
                                                <th>Codigo comuna</th>
                                                <th>Metodologo nombre</th>
                                                <th>Metodologo Documento</th>
                                                <th>Monitor Nombre</th>
                                                <th>Monitor Documento</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($data as $temp)
                                                    <tr>
                                                        <td>{{$temp->codigo_grupo}}</td>
                                                        <td>{{$temp->codigo_comuna}}</td>
                                                        <td>{{$temp->metodoloog}}</td>
                                                        <td>{{$temp->metodologo_numero_documento}}</td>
                                                        <td>{{$temp->monitor}}</td>
                                                        <td>{{$temp->monitor_numero_documento}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                                </table>
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