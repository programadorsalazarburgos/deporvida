<style type="text/css">
.table-responsive {
    overflow-x: auto;
}
.tex-calificacion {
    min-width: 150px; 
    font-size: 12px;
}
</style>

<script type="text/javascript">
</script>

<div>

    <div class="clearfix"></div>
    <br>

    <div class="clearfix"></div>
    <br>
    <div id="table-action" class="row">
        <div class="col-lg-12">

            <ul id="tableactiondTab" class="nav nav-tabs">
                <li class="active">
                    <a href="#table-table-tab" data-toggle="tab">@{{title}}</a>
                </li>
            </ul>

            <div id="tableactionTabContent" class="tab-content">
                <div id="table-table-tab" class="tab-pane fade in active">
                    <div class="row">
                        <div class="col-md-12">

                            <form name="formEvaluacion" class="form-vertical" novalidate>
                                <fieldset>
                                    <legend>@{{subtitle}}</legend>

                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            <label for="grupo" style="color: black;">* Seleccione el Grupo:</label>
                                            {{-- <select name="grupo" ng-model="ev.grupo" class="form-control" ng-change="seleccionGrupo()" required>
                                                <option value="">Seleccione</option>
                                                <option ng-repeat="g in grupos" value="@{{ g }}">@{{ g.codigo_grupo }}</option>
                                            </select> --}}
                                            <select name="grupo" id="grupo" class="form-control" ng-model="ev.grupo" ng-change="seleccionGrupo()" required
                                                ng-options="g as (g.codigo_grupo+' - '+g.fk_tbl_dv_niveles.descripcion+' - '+g.fk_tbl_dv_escenarios.nombre_escenario) for g in grupos track by g.id" >
                                                <option value="" ng-show="!modoUpdate">Seleccione</option>
                                            </select>
                                            <div ng-show="formEvaluacion.$submitted || formEvaluacion.grupo.$touched" >
                                                <span class="label label-danger" ng-show="formEvaluacion.grupo.$error.required">Requerido</span>
                                            </div>
                                        </div>

                                        <div class="clearfix"></div>
                                        <br>

                                        <div class="col-md-6">
                                            <label for="fecha" style="color: black;">* Fecha:</label>
                                            <p class="input-group">
                                                <input class="form-control" name="fecha" ng-model="ev.fecha" required readonly></input>
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default" disabled><i class="glyphicon glyphicon-calendar"></i></button>
                                                </span>
                                            </p>
                                            <div ng-show="formEvaluacion.$submitted || formEvaluacion.fecha.$touched" >
                                                <span class="label label-danger" ng-show="formEvaluacion.fecha.$error.required">Requerido</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <label for="monitor" style="color: black;"> Monitor:</label>
                                            <input class="form-control" name="monitor" ng-model="ev.monitor" readonly></input>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="escenario" style="color: black;"> Escenario:</label>
                                            <input class="form-control" name="escenario" ng-model="ev.escenario" readonly></input>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <label for="disciplina" style="color: black;"> Disciplina:</label>
                                            <input class="form-control" name="disciplina" ng-model="ev.disciplina" readonly></input>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="nivel" style="color: black;"> Nivel:</label>
                                            <input class="form-control" name="nivel" ng-model="ev.nivel" readonly></input>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <label for="periodo_inicio" style="color: black;">* Periodo a Evaluar:</label>
                                            <p class="input-group">
                                                <input class="form-control" name="periodo_inicio" ng-model="ev.periodo_inicial" readonly></input>
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default" disabled><i class="glyphicon glyphicon-calendar"></i></button>
                                                </span>
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="periodo_final" style="color: black;"> &nbsp;</label>
                                            <p class="input-group">
                                                <input class="form-control" name="periodo_final" ng-model="ev.periodo_final" readonly></input>
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default" disabled><i class="glyphicon glyphicon-calendar"></i></button>
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                    
                                </fieldset>

                                <div class="clearfix"></div>
                                <br>
                                
                                <fieldset ng-show="ev.grupo.id">
                                    <legend>Evaluar Indicadores-->:</legend>
                                    
                                    {{-- <div class="col-md-12">
                                        <div class="col-md-12">
                                            <label for="ejeT" style="color: black;">* Eje Tematico:</label>
                                            <select name="ejeT" class="form-control" ng-model="ev.ejeT" ng-change="seleccionEje()" required
                                                ng-options="eje as eje.fk_tbl_dv_ejes_tematicos.nombre for eje in ejes_t track by eje.id" >
                                                <option value="">Seleccione</option>
                                            </select>
                                            <div ng-show="formEvaluacion.$submitted || formEvaluacion.ejeT.$touched" >
                                                <span class="label label-danger" ng-show="formEvaluacion.ejeT.$error.required">Requerido</span>
                                            </div>
                                        </div>
                                    </div> --}}

                                    <div class="clearfix"></div>
                                    <br>

                                    <div class="col-md-12">
                                        <div class="panel panel-primary">
                                            <div class="panel-heading" ng-show="ev.ejeT"><strong>Eje Tematico:</strong> @{{ev.ejeT.fk_tbl_dv_ejes_tematicos.nombre}}</div>
                                            <div class="panel-heading" ng-show="!ev.ejeT"><strong>Nivel:</strong> @{{ev.nivel}}, <strong>Disciplina:</strong> @{{ev.disciplina}}</div>

                                            <div class="panel-body" ng-show="ev.ejeT">
                                                <p>@{{ev.ejeT.fk_tbl_dv_ejes_tematicos.observaciones}}</p>
                                            </div>
                                            <div class="panel-body" ng-show="!ev.ejeT">
                                                <p>@{{ev.grupo.fk_tbl_dv_niveles.observaciones}}</p>
                                            </div>
                                            
                                            <div class="table-responsive">
                                                <table class="table table-hover table-striped table-bordered table-advanced tablesorter" {{-- ng-init="getData()" --}}>
                                                    <thead>
                                                        <th>BENEFICIARIO&nbsp;<a ng-click="sort_by('customerName');">{{-- <i class="glyphicon glyphicon-sort"></i> --}}</a></th>
                                                        <th ng-repeat="indicador in ev.indicadores">@{{indicador.nombre}}</th>
                                                    </thead>
                                                    <tbody>
                                                        <tr ng-repeat="ben in ev.beneficiarios">
                                                            <td>@{{ben.per_ben_nombre_primero}}  @{{ben.per_ben_apellido_primero}}</td>
                                                            <td ng-repeat="indicador in ev.indicadores" style="width: 25%">             
                                                                {{-- <input class="form-control" ng-model="resultadosEv[ben.fich_id_persona_beneficiario][indicador.id].nombre" readonly></input> --}}
                                                                <textarea class="form-control tex-calificacion" ng-model="resultadosEv[ben.fich_id_persona_beneficiario][indicador.id].nombre" readonly></textarea>
                                                                {{-- <pre>@{{rs.nivel}}</pre> --}}
                                                                <div ui-slider 
                                                                    class="slider1" 
                                                                    min="min"  
                                                                    max="max"
                                                                    value="resultadosEv[ben.fich_id_persona_beneficiario][indicador.id].numero"
                                                                    niveles="niveles_ev" 
                                                                    ng-model="resultadosEv[ben.fich_id_persona_beneficiario][indicador.id]"
                                                                    {{-- style="max-width: 100px" --}}>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="clearfix"></div>
                                    <br>

                                    <div class="md-col-12">
                                        <div class="col-md-3">
                                            <a ng-click="volver()" class="btn btn-orange"><i class="fa fa-reply-all"></i>&nbsp;&nbsp;Atras</a>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="portlet-body">
                                                <div class="actions" style="text-align: right">
                                                    <button type="submit" class="btn btn-warning" style="" ng-click="seleccionEje(wizIndex-1)" ng-show="wizIndex > 0">
                                                        <i class="fa fa-arrow-left" aria-hidden="true" ></i> Anterior Eje Tematico
                                                    </button>
                                                    <button type="submit" class="btn btn-warning" style="" ng-click="seleccionEje(wizIndex+1)" ng-show="wizIndex < wizTotal">
                                                        Siguiente Eje Tematico <i class="fa fa-arrow-right" aria-hidden="true" ></i> 
                                                    </button>
    
                                                    <button type="submit" class="btn btn-success" style="" ng-click="guardarEvaluacion(formEvaluacion.$valid)" ng-show="wizIndex == wizTotal">
                                                        <i class="fa fa-save" aria-hidden="true" ></i> Guardar Evaluación
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </fieldset>
                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

                        