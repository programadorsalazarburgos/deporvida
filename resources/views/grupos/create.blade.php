@extends('angular.frontend.master')
@section('title', 'Grupos')
@section('content')
<script type="text/javascript" src="js/jquery/crvclockpicker.js"></script>
<link rel="stylesheet" href="js/jquery/jquery-clockpicker.min.css"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="js/registrar.grupos.js<?= '?v='.date('YmdHis');?>"></script>
<style>
    .ui-widget.ui-widget-content {
        border: 1px solid red !important;
    }
</style>
<script>
    $(function()
    {
    $('#id_user').select2();
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
                                                        <span class="label label-success" id="codigo">Asignación Grupos</span> 
                                                    </a></li>
                                            </ul>
                                            <div class="tab-content">
                                                <div id="resultados_ajax"></div>
                                                <div class="tab-pane active" id="details">
                                                    <div class="clearfix"></div>
                                                    <br>
                                                    <div class="container-fluid">
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Monitores</label>
                                                            <div class="col-sm-10">
                                                                <select name="id_user" id="id_user" class="form form-control" required="" style="width: 680px; position: relative; top: 6px">
                                                                    <optgroup label="Mis monitores">
                                                                        @foreach($monitores_mios as $data)
                                                                        <option value="{{@$data->id}}">{{@$data->nombre}} </option>
                                                                        @endforeach
                                                                    </optgroup>
                                                                    <optgroup label="Otros monitores">
                                                                        @foreach($monitores_no_mios as $data)
                                                                        <option value="{{@$data->id}}">{{@$data->nombre}} </option>
                                                                        @endforeach
                                                                    </optgroup>

                                                                </select>
                                                                <br>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">

                                                            <label class="col-sm-2 control-label">Comuna de impacto</label>
                                                            <div class="col-sm-9">
                                                                <select name="id_comuna_impacto" id="id_comuna_impacto" class="form form-control" required="">
                                                                    @foreach($comunas_impacto_mios as $data)
                                                                    <option value="{{@$data->id}}">{{@$data->nombre_comuna}} </option>
                                                                    @endforeach
                                                                </select>
                                                                <br>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">

                                                            <label class="col-sm-2 control-label">Escenarios</label>
                                                            <div class="col-sm-10">
                                                                <select name="id_escenario" id="id_escenario" class="form form-control" required="" style="width: 680px; position: relative; top: 6px">
                                                                    <option value="">Seleccione</option>
                                                                    @foreach($escenarios as $data)
                                                                    <option value="{{@$data->id}}">{{@$data->nombre_escenario}}</option>
                                                                    @endforeach
                                                                    
                                                                </select>
                                                                <br>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Niveles</label>
                                                            <div class="col-sm-10">
                                                                <select name="id_nivel" id="id_nivel" class="form form-control" required="" style="width: 680px; position: relative; top: 6px">
                                                                    @foreach($niveles as $data)
                                                                    <option value="{{@$data->id}}">{{@$data->descripcion}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <br>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Disciplinas</label>
                                                            <div class="col-sm-10">
                                                                <select name="id_disciplina" id="id_disciplina" class="form form-control" required="" style="width: 680px; position: relative; top: 6px;">
                                                                    @foreach($disciplinas as $data)
                                                                    <option value="{{@$data->id}}">{{@$data->descripcion}}</option>
                                                                    @endforeach    
                                                                </select>
                                                                <span class="label label-danger ng-hide" ng-show="frm.tip_sangre_persona.$dirty & amp; & amp; frm.tip_sangre_persona.$error.required">Requerido</span>
                                                                <br>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="note" class="col-sm-2 control-label">Observaciones</label>
                                                            <div class="col-sm-10">
                                                                <textarea class="form form-control" placeholder="Digita Observaciones" name="observaciones" ></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <h5><span class="label label-info">Ingrese Horario para este grupo</span></h5>
                                                    <hr>
                                                    <table class="table">
                                                        @foreach($dias as $dia)
                                                        <tr>
                                                            <td>
                                                                <label><input class="dias" type="checkbox" onclick="hora('{{$dia}}')" id="ch_{{$dia}}" name="dia[{{$dia}}]" value="{{$dia}}">{{$dia}}</label>
                                                            </td>
                                                            <td>
                                                                <input data-dia="{{$dia}}" title="Hora de inicio debe ser menor a la hora de fin" class="form form-control hora" type="text" id="hi_{{$dia}}" name="hora[{{$dia}}][inicio]">
                                                            </td>
                                                            <td>
                                                                <input data-dia="{{$dia}}" title="Hora de fin debe ser menor a la hora de inicio" class="form form-control hora" type="text" id="hf_{{$dia}}" name="hora[{{$dia}}][fin]">
                                                            </td>
                                                            <td>
                                                                <select name="hora[{{$dia}}][equipamiento]" id="he_{{$dia}}" class="form form-control tipos_equipamiento">
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </table>
                                                </div>
                                                <div class="clearfix"></div>
                                                <br>
                                                <div class="form-group">
                                                    <div class="col-sm-6">
                                                        <div ng-show="loading" id="cargando" class="loading ng-hide"><img src="http://localhost:8000/images/cargando.gif">LOADING...</div>
                                                        <button type="submit" id="save" class="btn btn-success">
                                                            <i class="fa fa-save"></i>&nbsp;&nbsp;Guardar Grupo
                                                        </button>
                                                        <a href="javascript:history.back()"type="submit" class="btn btn-orange">
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
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                Horario de este monitor
            </div>
            <div class="modal-body">
                Aqui va el horario
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>



<!-- AQUI VA TODO EL CONTENDIDO -->
@stop