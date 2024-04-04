@extends('angular.frontend.master')
@section('title', 'Grupos')
@section('content')
<?php $v ='';//'?v='.date('YmdHis');?>
<script type="text/javascript">
    var id_grupos = "{{$id}}";
</script>
<script type="text/javascript" src="{{url('')}}/js/jquery/crvclockpicker.js"></script>
<script type="text/javascript" src="{{url('')}}/js/grupos.editar.js{{$v}}"></script>
<link rel="stylesheet" href="{{url('')}}/js/jquery/jquery-clockpicker.min.css"/>
<div class="page-content">
    <div id="tab-general">
        <div id="sum_box" class="row mbl">
            <section>
                <div class="container">
                    <ng-view class="ng-scope">
                        <section class="content ng-scope">
                            <div class="row">
                                <div class="col-md-12">
                                    <form class="form-horizontal ng-pristine ng-invalid ng-invalid-required ng-valid-time ng-valid-maxlength" id="form" >
                                        <div class="nav-tabs-custom">
                                            <ul class="nav nav-tabs">
                                                <li class="active">
                                                    <a href="#details" data-toggle="tab" aria-expanded="false">
                                                        <span class="label label-success" >Edición Grupos</span> 
                                                        <span class="label label-primary ng-pristine ng-untouched ng-valid ng-binding" ng-model="codigo" id="codigo_numero">Código Grupo: <i id="codigo">{{@$grupo[0]->codigo_grupo}}</i></span>
                                                    </a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                <div id="resultados_ajax"></div>
                                                <div class="tab-pane active" id="details">
                                                    <div class="clearfix"></div>
                                                    <br>
                                                    <div class="container-fluid">
                                                        <div class="form-group">
                                                            <input type="hidden" id="id_grupo" name="id_grupo" value="{{$id}}"/>
                                                            <label class="col-sm-2 control-label">Monitores</label>
                                                            <div class="col-sm-10">
                                                                <select name="id_user" id="id_user" class="form form-control" required="" >
                                                                    <optgroup label="Mis monitores">
                                                                        @foreach($monitores_mios as $data)
                                                                        <option value="{{@$data->id}}">{{@$data->nombre}} </option>
                                                                        @endforeach
                                                                    </optgroup>
                                                                    <optgroup label="Otros monitores">
                                                                        @if(isset($monitores_no_mios))
                                                                        @foreach($monitores_no_mios as $data)
                                                                        <option value="{{@$data->id}}">{{@$data->nombre}} </option>
                                                                        @endforeach
                                                                        @endif
                                                                    </optgroup>

                                                                </select>
                                                                <br>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">

                                                            <label class="col-sm-2 control-label">Comuna de impacto</label>
                                                            <div class="col-sm-10">
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
                                                                <select name="id_escenario" id="id_escenario" class="form form-control" required="">
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
                                                                <select name="id_nivel" id="id_nivel" class="form form-control" required="" >
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
                                                                <select name="id_disciplina" id="id_disciplina" class="form form-control" required="">
                                                                    @foreach($disciplinas as $data)
                                                                    <option value="{{@$data->id}}">{{@$data->descripcion}}</option>
                                                                    @endforeach    
                                                                </select>
                                                                <span class="label label-danger ng-hide" ng-show="frm.tip_sangre_persona.$dirty & amp;
                                                                                & amp;
                                                                        frm.tip_sangre_persona.$error.required">Requerido</span>
                                                                <br>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="note" class="col-sm-2 control-label">Observaciones</label>
                                                            <div class="col-sm-10">
                                                                <textarea class="form form-control" placeholder="Digita Observaciones" name="observaciones" id="observaciones" ></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <h5><span class="label label-info">Ingrese Horario para este grupo</span></h5>
                                                    <hr>
                                                    <table class="table">

                                                        <tr>
                                                            <td>
                                                                <label><input class="dias" type="checkbox" onclick="hora('Lunes')" id="ch_Lunes" name="dia[Lunes]" value="Lunes">Lunes</label>
                                                            </td>
                                                            <td>
                                                                <input  title="Hora de inicio debe ser menor a la hora de fin" class="form form-control hora" type="text" id="hi_Lunes" name="hora[Lunes][inicio]">
                                                            </td>
                                                            <td>
                                                                <input title="Hora de fin debe ser menor a la hora de inicio" class="form form-control hora" type="text" id="hf_Lunes" name="hora[Lunes][fin]">
                                                            </td>
                                                            <td>
                                                                <select name="hora[Lunes][equipamiento]" id="he_Lunes" class="form form-control tipos_equipamiento">
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <label><input class="dias" type="checkbox" onclick="hora('Martes')" id="ch_Martes" name="dia[Martes]" value="Martes">Martes</label>
                                                            </td>
                                                            <td>
                                                                <input  title="Hora de inicio debe ser menor a la hora de fin" class="form form-control hora" type="text" id="hi_Martes" name="hora[Martes][inicio]">
                                                            </td>
                                                            <td>
                                                                <input title="Hora de fin debe ser menor a la hora de inicio" class="form form-control hora" type="text" id="hf_Martes" name="hora[Martes][fin]">
                                                            </td>
                                                            <td>
                                                                <select name="hora[Martes][equipamiento]" id="he_Martes" class="form form-control tipos_equipamiento">
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <label><input class="dias" type="checkbox" onclick="hora('Miercoles')" id="ch_Miercoles" name="dia[Miercoles]" value="Miercoles">Miercoles</label>
                                                            </td>
                                                            <td>
                                                                <input  title="Hora de inicio debe ser menor a la hora de fin" class="form form-control hora" type="text" id="hi_Miercoles" name="hora[Miercoles][inicio]">
                                                            </td>
                                                            <td>
                                                                <input title="Hora de fin debe ser menor a la hora de inicio" class="form form-control hora" type="text" id="hf_Miercoles" name="hora[Miercoles][fin]">
                                                            </td>
                                                            <td>
                                                                <select name="hora[Miercoles][equipamiento]" id="he_Miercoles" class="form form-control tipos_equipamiento">
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <label><input class="dias" type="checkbox" onclick="hora('Jueves')" id="ch_Jueves" name="dia[Jueves]" value="Jueves">Jueves</label>
                                                            </td>
                                                            <td>
                                                                <input title="Hora de inicio debe ser menor a la hora de fin"  class="form form-control hora" type="text" id="hi_Jueves" name="hora[Jueves][inicio]">
                                                            </td>
                                                            <td>
                                                                <input title="Hora de fin debe ser menor a la hora de inicio" class="form form-control hora" type="text" id="hf_Jueves" name="hora[Jueves][fin]">
                                                            </td>
                                                            <td>
                                                                <select name="hora[Jueves][equipamiento]" id="he_Jueves" class="form form-control tipos_equipamiento">
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <label><input class="dias" type="checkbox" onclick="hora('Viernes')" id="ch_Viernes" name="dia[Viernes]" value="Viernes">Viernes</label>
                                                            </td>
                                                            <td>
                                                                <input title="Hora de inicio debe ser menor a la hora de fin" class="form form-control hora" type="text" id="hi_Viernes" name="hora[Viernes][inicio]">
                                                            </td>
                                                            <td>
                                                                <input  title="Hora de fin debe ser menor a la hora de inicio" class="form form-control hora" type="text" id="hf_Viernes" name="hora[Viernes][fin]">
                                                            </td>
                                                            <td>
                                                                <select name="hora[Viernes][equipamiento]" id="he_Viernes" class="form form-control tipos_equipamiento">
                                                                </select>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td>
                                                                <label><input class="dias" type="checkbox" onclick="hora('Sabado')" id="ch_Sabado" name="dia[Sabado]" value="Sabado">Sabado</label>
                                                            </td>
                                                            <td>
                                                                <input title="Hora de inicio debe ser menor a la hora de fin" class="form form-control hora" type="text" id="hi_Sabado" name="hora[Sabado][inicio]">
                                                            </td>
                                                            <td>
                                                                <input  title="Hora de fin debe ser menor a la hora de inicio" class="form form-control hora" type="text" id="hf_Sabado" name="hora[Sabado][fin]">
                                                            </td>
                                                            <td>
                                                                <select name="hora[Sabado][equipamiento]" id="he_Sabado" class="form form-control tipos_equipamiento">
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <label><input class="dias" type="checkbox" onclick="hora('Domingo')" id="ch_Domingo" name="dia[Domingo]" value="Domingo">Domingo</label>
                                                            </td>
                                                            <td>
                                                                <input title="Hora de inicio debe ser menor a la hora de fin" class="form form-control hora" type="text" id="hi_Domingo" name="hora[Domingo][inicio]">
                                                            </td>
                                                            <td>
                                                                <input  title="Hora de fin debe ser menor a la hora de inicio" class="form form-control hora" type="text" id="hf_Domingo" name="hora[Domingo][fin]">
                                                            </td>
                                                            <td>
                                                                <select name="hora[Domingo][equipamiento]" id="he_Domingo" class="form form-control tipos_equipamiento">
                                                                </select>
                                                            </td>
                                                        </tr>



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
<!-- AQUI VA TODO EL CONTENDIDO -->
@stop