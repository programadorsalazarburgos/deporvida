<style type="text/css">
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

                            <form name="form" class="form-vertical" novalidate>
                                <fieldset>
                                    <legend>@{{subtitle}}</legend>

                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            <label for="tipo" style="color: black;">* Tipo:</label>
                                            <select name="tipo" id="tipo" class="form-control" ng-model="ind.tipo" required >
                                                <option value="">Seleccione</option>
                                                <option value="TECNICO">Técnico</option>
                                                <option value="PSICOSOCIAL">Psicosocial</option>
                                            </select>
                                            <div ng-show="form.$submitted || form.tipo.$touched" >
                                                <span class="label label-danger" ng-show="form.tipo.$error.required">Requerido</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12" ng-show="ind.tipo == 'PSICOSOCIAL'">
                                        <div class="col-md-12">
                                            <label for="eje" style="color: black;">* Eje Tematico:</label>
                                            <select name="eje" id="eje" class="form-control" ng-model="ind.id_eje" ng-required="ind.tipo == 'PSICOSOCIAL'"
                                                ng-options="eje.id as eje.nombre for eje in ejes" >
                                                <option value="">Seleccione</option>
                                            </select>
                                            <div ng-show="form.$submitted || form.eje.$touched" >
                                                <span class="label label-danger" ng-show="form.eje.$error.required">Requerido</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12" ng-show="ind.tipo == 'TECNICO'">
                                        <div class="col-md-12">
                                            <label for="nivel" style="color: black;">* Nivel:</label>
                                            <select name="nivel" id="nivel" class="form-control" ng-model="ind.id_nivel" ng-required="ind.tipo == 'TECNICO'"
                                                ng-options="nivel.id as nivel.descripcion for nivel in niveles" >
                                                <option value="">Seleccione</option>
                                            </select>
                                            <div ng-show="form.$submitted || form.nivel.$touched" >
                                                <span class="label label-danger" ng-show="form.nivel.$error.required">Requerido</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12" ng-show="ind.tipo == 'TECNICO'">
                                        <div class="col-md-12">
                                            <label for="disciplina" style="color: black;">* Disciplina:</label>
                                            <select name="disciplina" id="disciplina" class="form-control" ng-model="ind.id_disciplina" ng-required="ind.tipo == 'TECNICO'"
                                                ng-options="disciplina.id as disciplina.descripcion for disciplina in disciplinas" >
                                                <option value="">Seleccione</option>
                                            </select>
                                            <div ng-show="form.$submitted || form.disciplina.$touched" >
                                                <span class="label label-danger" ng-show="form.disciplina.$error.required">Requerido</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            <label for="nombre" style="color: black;">* Indicador:</label>
                                            <input class="form-control" name="nombre" ng-model="ind.nombre" required></input>
                                            <div ng-show="form.$submitted || form.nombre.$touched" >
                                                <span class="label label-danger" ng-show="form.nombre.$error.required">Requerido</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            <label for="observaciones" style="color: black;"> Observaciones:</label>
                                            <textarea class="form-control" name="observaciones" cols="30" rows="10" ng-model="ind.observaciones"></textarea>
                                        </div>
                                    </div>

                                    <div class="clearfix"></div>
                                    <br>

                                    <div class="col-md-12">
                                        <div class="portlet-body">
                                            <div class="actions">
                                                <button type="submit" class="btn btn-success" style="" ng-click="guardar(form.$valid)" ng-show="!modoUpdate">
                                                    <i class="fa fa-save" aria-hidden="true" ></i> Guardar
                                                </button>
                                                <button type="submit" class="btn btn-success" style="" ng-click="modificar(form.$valid)" ng-show="modoUpdate">
                                                    <i class="fa fa-save" aria-hidden="true" ></i> Actualizar
                                                </button>
                                                <a ng-href="admin/postindicadores#/admin/postindicadores" class="btn btn-orange"><i class="fa fa-reply-all"></i>&nbsp;&nbsp;Atras</a>
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

                        