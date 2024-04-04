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
                                            <select name="tipo" id="tipo" class="form-control" ng-model="cal.tipo" required >
                                                <option value="">Seleccione</option>
                                                <option value="TECNICO">Técnico</option>
                                                <option value="PSICOSOCIAL">Psicosocial</option>
                                            </select>
                                            <div ng-show="form.$submitted || form.tipo.$touched" >
                                                <span class="label label-danger" ng-show="form.tipo.$error.required">Requerido</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            <label for="nombre" style="color: black;">* Nombre:</label>
                                            <input class="form-control" name="nombre" ng-model="cal.nombre" required></input>
                                            <div ng-show="form.$submitted || form.nombre.$touched" >
                                                <span class="label label-danger" ng-show="form.nombre.$error.required">Requerido</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <label for="numero" style="color: black;">* Numero:</label>
                                            <input class="form-control" name="numero" ng-model="cal.numero" required min="1" type="number" maxlength="2"></input>
                                            <div ng-show="form.$submitted || form.numero.$touched" >
                                                <span class="label label-danger" ng-show="form.numero.$error.required">Requerido</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            <label for="observaciones" style="color: black;"> Observaciones:</label>
                                            <textarea class="form-control" name="observaciones" cols="30" rows="10" ng-model="cal.observaciones"></textarea>
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
                                                <a ng-href="admin/postcalificacionesescala#/admin/postcalificacionesescala" class="btn btn-orange"><i class="fa fa-reply-all"></i>&nbsp;&nbsp;Atras</a>
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

                        