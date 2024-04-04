<style type="text/css">
li.list-group-item.ng-binding.ng-scope.active {
    z-index: 0;
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

                            <form name="form" class="form-vertical" novalidate>
                                <fieldset>
                                    <legend>@{{subtitle}}</legend>

                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            <label for="tipo" style="color: black;">* Tipo:</label>
                                            <select name="tipo" id="tipo" class="form-control" ng-model="pyp.tipo" required >
                                                <option value="">Seleccione</option>
                                                <option value="TECNICO">Técnico</option>
                                                <option value="PSICOSOCIAL">Psicosocial</option>
                                            </select>
                                            <div ng-show="form.$submitted || form.tipo.$touched" >
                                                <span class="label label-danger" ng-show="form.tipo.$error.required">Requerido</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="clearfix"></div>
                                    <br>

                                    <div class="col-md-12" ng-show="pyp.tipo == 'PSICOSOCIAL'">
                                        <div class="col-md-12">
                                            <div class="panel panel-info">
                                                <div class="panel-heading">
                                                    {{-- <h3 class="panel-title">Seleccione los ejes tematicos a evaluar</h3> --}}
                                                    Seleccione los ejes tematicos a evaluar
                                                </div>
                                                <ul class="list-group">
                                                    <li ng-repeat="(i,eje) in ejes" class="list-group-item" ng-class="{active: eje.selected}"> 
                                                        <input type="checkbox" ng-model="eje.selected" >&nbsp; @{{eje.nombre}}
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            <label for="nombre" style="color: black;">* Descripción:</label>
                                            <input class="form-control" name="nombre" ng-model="pyp.nombre" required></input>
                                            <div ng-show="form.$submitted || form.nombre.$touched" >
                                                <span class="label label-danger" ng-show="form.nombre.$error.required">Requerido</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            <label for="periodo_inicial" style="color: black;">* Plazos de Calificación:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="input-group">
                                                <input idatepicker-rango rango="minDate" input2="plazo_final" class="form-control" name="plazo_inicial" ng-model="pyp.plazo_inicial" required></input>
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default"><i class="glyphicon glyphicon-calendar"></i></button>
                                                </span>
                                            </p>
                                            <div ng-show="form.$submitted || form.plazo_inicial.$touched" >
                                                <span class="label label-danger" ng-show="form.plazo_inicial.$error.required">Requerido</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="input-group">
                                                <input idatepicker-rango rango="maxDate" input2="plazo_inicial" class="form-control" name="plazo_final" ng-model="pyp.plazo_final" required></input>
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default"><i class="glyphicon glyphicon-calendar"></i></button>
                                                </span>
                                            </p>
                                            <div ng-show="form.$submitted || form.plazo_final.$touched" >
                                                <span class="label label-danger" ng-show="form.plazo_final.$error.required">Requerido</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            <label for="periodo_inicial" style="color: black;">* Periodo a Evaluar:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="input-group">
                                                <input idatepicker-rango rango="minDate" input2="periodo_final" class="form-control ifecha" name="periodo_inicial" ng-model="pyp.periodo_inicial" required></input>
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default"><i class="glyphicon glyphicon-calendar"></i></button>
                                                </span>
                                            </p>
                                            <div ng-show="form.$submitted || form.periodo_inicial.$touched" >
                                                <span class="label label-danger" ng-show="form.periodo_inicial.$error.required">Requerido</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="input-group">
                                                <input idatepicker-rango rango="minDate" input2="periodo_inicial" class="form-control ifecha" name="periodo_final" ng-model="pyp.periodo_final" required></input>
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default"><i class="glyphicon glyphicon-calendar"></i></button>
                                                </span>
                                            </p>
                                            <div ng-show="form.$submitted || form.periodo_final.$touched" >
                                                <span class="label label-danger" ng-show="form.periodo_final.$error.required">Requerido</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            <label for="observaciones" style="color: black;"> Observaciones:</label>
                                            <textarea class="form-control" name="observaciones" cols="30" rows="10" ng-model="pyp.observaciones"></textarea>
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
                                                <a ng-href="admin/postplazosyperiodosev#/admin/postplazosyperiodosev" class="btn btn-orange"><i class="fa fa-reply-all"></i>&nbsp;&nbsp;Atras</a>
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

                        