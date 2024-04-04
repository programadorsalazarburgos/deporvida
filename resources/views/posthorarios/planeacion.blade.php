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
<script src="{{url('js/planeacion.crear.js')}}"></script>
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
                                                                <label><i class="text-danger">*</i> Grupo</label>
                                                                <select class="form form-control" id="id_grupo" name="id_grupo" required="required">
                                                                    <option value="">Seleccione</option>
                                                                    @foreach($grupos_clase as $temp)
                                                                    <option value="{{$temp->id}}">
                                                                        {{$temp->nombre_nivel}}|{{$temp->descripcion}}|Codigo:{{$temp->codigo_grupo}}|Escenario:{{$temp->nombre_escenario}}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label><i class="text-danger">*</i> Dia de la semana</label>
                                                                <select class="form form-control" id="dia" name="dia" required="required">
                                                                    <option value="">Seleccione</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label><i class="text-danger">*</i> Eje temático psicosocial</label>
                                                                <input class="form form-control" id="eje_tematico" name="eje_tematico" required="required"/>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label><i class="text-danger">*</i> Tema tecnico</label>
                                                                <input class="form form-control" id="tema" name="tema" required="required"/>
                                                            </div>
														</div>
                                                        <div class="row">
															<div class="col-md-6">
                                                                <label><i class="text-danger">*</i> Contenido psicosocial</label>
                                                                <input class="form form-control" id="cont_psicosocial" name="cont_psicosocial" required="required"/>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label><i class="text-danger">*</i> Objetivo</label>
                                                                <input class="form form-control" id="objetivo" name="objetivo" required="required"/>
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
                                                                        <td><label><i class="text-danger">*</i> En minutos</label><input type="number" min="0" class="form form-control" id="tiempo1" name="tiempo1" required="required"/></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>2</td>
                                                                        <td>
                                                                            <table class="table">
                                                                                <tr>
                                                                                    <td>
                                                                                        <label><i class="text-danger">*</i> Juego</label>
                                                                                        <textarea class="form form-control" id="juego" name="juego" required="required"></textarea>
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
                                                                                        <i class="text-danger">*</i> Habilidades motrices básicas y coordinativas
                                                                                        </label>
                                                                                        <textarea class="form form-control" id="habilidades" name="habilidades" required="required"></textarea>
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
                                                                            <label><i class="text-danger">*</i> En minutos</label><input type="number" min="0" class="form form-control" id="tiempo2" name="tiempo2" required="required"/></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>3</td>
                                                                        <td>
                                                                            <table class="table">
                                                                                <tr>
                                                                                    <td>
                                                                                        <label><i class="text-danger">*</i> Ejercicios introductorios</label>
                                                                                        <textarea class="form form-control" id="ejercicios_introductorios" name="ejercicios_introductorios" required="required"></textarea>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        <label><i class="text-danger">*</i> Ejercicios avanzados</label>
                                                                                        <textarea class="form form-control" id="ejercicios_avanzados" name="ejercicios_avanzados" required="required"></textarea>
                                                                                    </td>
                                                                                </tr>                                                                             
                                                                                <tr>
                                                                                    <td>
                                                                                        <label><i class="text-danger">*</i> Ejercicio evaluativo</label>
                                                                                        <textarea class="form form-control" id="juego_correctivo" name="juego_evaluativo" required="required"></textarea>
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
                                                                        <td><label><i class="text-danger">*</i> En minutos</label><input type="number" min="0" class="form form-control" id="tiempo3" name="tiempo3" required="required"/></td>
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
                                                                        <td><label><i class="text-danger">*</i> En minutos</label><input type="number" min="0" class="form form-control" id="tiempo4" name="tiempo4" required="required"/></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="3">
                                                                            <label>OBSERVACIONES</label>
                                                                            <textarea class="form form-control" id="observaciones" name="observaciones"></textarea>
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
                                                        <div ng-show="loading" id="cargando" class="loading ng-hide"><img src="http://localhost:8000/images/cargando.gif">LOADING...</div>
                                                        <button type="submit" id="save" class="btn btn-success">
                                                            <i class="fa fa-save"></i>&nbsp;&nbsp;Crear planificacion
                                                        </button>
                                                        <button type="button" id="reset" class="btn btn-success">
                                                            <i class="fas fa-sync"></i>&nbsp;&nbsp;Nueva planificacion
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