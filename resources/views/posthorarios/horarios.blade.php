@extends('angular.frontend.master')
@section('title', 'Grupos')
@section('content')
<style>
    .dada .ui-state-default{
     background-color: #FF9918;  
    }
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
<script type="text/javascript">
   
</script>
<script type="text/javascript" src="{{url('')}}/js/planeacion.asistencias.js"></script>
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
                                                    <form id="form">
                                                        <div class="form-group">

                                                            <label class="col-sm-2 control-label">Grupo</label>
                                                            <div class="col-sm-4">
                                                                <select  required="required" id="grupos"  name="grupos" class="form form-control">
                                                                    <option value="">Seleccione</option>
                                                                    @foreach($grupos_clase as $temp)
                                                                    <option value="{{$temp->id}}">
                                                                        Disciplina:{{$temp->descripcion}}|Codigo:{{$temp->codigo_grupo}}|Escenario:{{$temp->nombre_escenario}}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <label class="col-sm-2 control-label">Fecha</label>
                                                            <div class="col-sm-4">
                                                                <input name="fecha" id="fecha_calendar" class="form form-control">
<!--
                                                                </select>
                                                                <select required="required" name="fecha" id="fecha" class="form form-control">

                                                                </select>-->
                                                            </div>
                                                        </div>
                                                        <hr/>
                                                        <div class="form-group">
                                                            <div class="col-sm-12">
                                                                <div id="table">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="clearfix"></div>
                                                <br>
                                                <div class="form-group">
                                                    <div class="col-sm-6">
                                                        <div ng-show="loading" id="cargando" class="loading ng-hide"><img src="http://localhost:8000/images/cargando.gif">LOADING...</div>
                                                        <!-- ngRepeat: car in cars -->

                                                        <button type="submit" id="save" class="btn btn-success"><i class="fa fa-save"></i>&nbsp;&nbsp;Guardar Grupo</button>

                                                        <a href="javascript:history.back()" type="submit" class="btn btn-orange">
                                                            <i class="fa fa-reply-all"></i>&nbsp;&nbsp;Atras
                                                        </a>

                                                    </div>
                                                </div>
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