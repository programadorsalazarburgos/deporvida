@extends('angular.frontend.master')
@section('title', 'Grupos')
@section('content')
<style>
input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
}
#id_grupo, #id_grupo option 
{
    font-family: Consolas, monospace;
}
input:read-only,textarea:read-only { 
    background-color: #FFF !important;
}
input[type=number] { -moz-appearance:textfield; }
    .table{
        margin-bottom: 0px !important;
    }
    table tr td,table tr th{
        vertical-align:middle !important;
    }
    table tr td,table tr th{
        text-align: center !important;
    }
</style>
<script type="text/javascript" src="js/functions.js"></script>
<script src="js/planeacion.editar.js"></script>
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
                                                    </a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                <div id="resultados_ajax"></div>
                                                <div class="tab-pane active" id="details">
                                                    <div class="clearfix"></div>
                                                    <div id="container_form">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <span class="label label-warning" id="semana_proxima"></span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="hidden" name="id" value="{{$data->id}}"/>
                                                                <label>Grupo</label>
                                                                <br/>
                                                                <strong>
                                                                    Disciplina:{{$grupos_clase_dias->disciplina}}
                                                                    |Codigo:{{$grupos_clase_dias->codigo_grupo}}
                                                                    |Escenario:{{$grupos_clase_dias->nombre_escenario}}
                                                                </strong>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Fecha</label>
                                                                <br/>
                                                                <strong>{{$data->fecha}}</strong>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label>Eje temático psicosocial</label>
                                                                <input {{$readonly}} class="form form-control" id="eje_tematico" name="eje_tematico" required="required" value="{{$data->eje_tematico}}" />
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>Tema tecnico</label>
                                                                <input {{$readonly}} class="form form-control" value="{{$data->tema}}" id="tema" name="tema" required="required"/>
                                                            </div>
														</div>
                                                        <div class="row">
															<div class="col-md-6">
                                                                <label><i class="text-danger">*</i> Contenido psicosocial</label>
                                                                <input {{$readonly}} class="form form-control" value="{{$data->cont_psicosocial}}" id="cont_psicosocial" name="cont_psicosocial" required="required"/>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>Objetivo</label>
                                                                <input {{$readonly}} class="form form-control" id="objetivo" value="{{$data->objetivo}}" name="objetivo" required="required"/>
                                                            </div>
                                                        </div>
                                                        <br/>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <table border="1" class="table table-hover-color">
                                                                    <tr>
                                                                        <th width="10%">Momento</th>
                                                                        <th width="80%">Descripcion de la actividad</th>
                                                                        <th width="10%">Tiempo</th>
                                                                    </tr>
                                                                    <tr>
                                                                        <td >1</td>                                                 
                                                                        <td>
                                                                            <table class="table">
                                                                                <tr>
                                                                                    <td>Recibimiento de los niños</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>Saludo</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>Cuidado del medio ambiente</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>Charla inicial</td>
                                                                                </tr>
                                                                            </table>
                                                                        </td>
                                                                        <td><label>En minutos</label><input {{$readonly}} type="number" min="0" class="form form-control" value="{{$data->tiempo1}}" id="tiempo1" name="tiempo1" required="required"/></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>2</td>
                                                                        <td>
                                                                            <table class="table">
                                                                                <tr>
                                                                                    <td>
                                                                                        <label>Juego</label>
                                                                                        <textarea {{$readonly}} class="form form-control" id="juego" name="juego" required="required">{{$data->juego}}</textarea>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        Estiramiento general
                                                                                    </td>
                                                                                </tr>

                                                                                <tr>
                                                                                    <td>
                                                                                        <label>
                                                                                            Habilidades motrices básicas y coordinativas
                                                                                        </label>
                                                                                        <textarea {{$readonly}} class="form form-control" id="habilidades" name="habilidades" required="required">{{$data->habilidades}}</textarea>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        Hidratación
                                                                                    </td>
                                                                                </tr>

                                                                            </table>
                                                                        </td>
                                                                        <td>
                                                                            <label>En minutos</label><input {{$readonly}} type="number" min="0" class="form form-control" value="{{$data->tiempo2}}" id="tiempo2" name="tiempo2" required="required"/></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>3</td>
                                                                        <td>
                                                                            <table class="table">
                                                                                <tr>
                                                                                    <td>
                                                                                        <label>Ejercicios introductorios</label>
                                                                                        <textarea {{$readonly}} class="form form-control" id="ejercicios_introductorios" name="ejercicios_introductorios" required="required">{{$data->ejercicios_introductorios}}</textarea>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        <label>Ejercicios avanzados</label>
                                                                                        <textarea {{$readonly}} class="form form-control" id="ejercicios_avanzados" name="ejercicios_avanzados" required="required">{{$data->ejercicios_avanzados}}</textarea>
                                                                                    </td>
                                                                                </tr>                                                                             
                                                                                <tr>
                                                                                    <td>
                                                                                        <label>Ejercicio evaluativo</label>
                                                                                        <textarea {{$readonly}} class="form form-control" id="juego_correctivo" name="juego_evaluativo" required="required">{{$data->juego_evaluativo}}</textarea>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        Hidratación final
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        Estiramiento final
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        </td>
                                                                        <td><label>En minutos</label><input {{$readonly}} type="number" min="0" class="form form-control" value="{{$data->tiempo3}}" id="tiempo3" name="tiempo3" required="required"/></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>4</td>
                                                                        <td>
                                                                            <table class="table">
                                                                                <tr>
                                                                                    <td>
                                                                                        <label>RECOGER IMPLEMENTACIÓN/CUIDADO DEL MEDIO</label>
                                                                                    </td>
                                                                                </tr>                                                                             
                                                                                <tr>
                                                                                    <td>
                                                                                        <label>CHARLA FINAL</label>
                                                                                    </td>
                                                                                </tr>                                                                             
                                                                                <tr>
                                                                                    <td>
                                                                                        <label>DESPEDIDA</label>
                                                                                    </td>
                                                                                </tr>                                                                             
                                                                            </table>
                                                                        </td>
                                                                        <td><label>En minutos</label><input {{$readonly}} type="number" min="0" class="form form-control" value="{{$data->tiempo4}}" id="tiempo4" name="tiempo4" required="required"/></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="3">
                                                                            <label>OBSERVACIONES</label>
                                                                            <textarea class="form form-control" id="observaciones" name="observaciones" required="required">{{$data->observaciones}}</textarea>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <br>
                                                <div class="form-group">
                                                    <div class="col-sm-6">
                                                        <button type="submit" id="save" class="btn btn-success">
                                                            <i class="fa fa-save"></i>&nbsp;&nbsp;Editar planificacion
                                                        </button>
                                                        <a href="javascript:history.back(1)" type="submit" class="btn btn-orange"><i class="fa fa-reply-all"></i>&nbsp;&nbsp;Atras</a>
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
        </div>
    </div>
</div>
@stop