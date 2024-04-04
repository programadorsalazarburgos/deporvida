<style type="text/css">
    iframe {
        height: 650px; 
        width: 952px; 
        border: 1px solid #CCC;
    }
    .tab-content {
        padding: 20px 8px !important;
    }
</style>

<script type="text/javascript">
    var jasperServer = {!! json_encode($jasperServer) !!};
    var jasperUser = {!! json_encode($jasperUser) !!};
    var jasperPass = {!! json_encode($jasperPass) !!};
    var jasperDataSource = {!! json_encode($jasperDataSource) !!};
    var jasperTemplateDefault = {!! json_encode($jasperTemplateDefault) !!};
</script>

<div ng-controller="ReporteadorCrtl">

    <div class="clearfix"></div>
    <br>

    <div class="clearfix"></div>
    <br>
    <div id="table-action" class="row">
        <div class="col-lg-12">

            <ul id="tableactiondTab" class="nav nav-tabs">
                <li class="active">
                    <a href="#table-table-tab" data-toggle="tab">Reporteador - Administrador</a>
                </li>
            </ul>

            <div id="tableactionTabContent" class="tab-content">
                <div id="table-table-tab" class="tab-pane fade in active">

                    <div class="col-md-12">
                        <div class="col-md-3">
                            <div class='form-group'>
                                <button type="button" class="btn btn-info" ng-click="verFormReporte()">
                                    <i class="fa fa-plus" aria-hidden="false">
                                        <div class="icon-bg bg-orange"></div>
                                    </i>
                                    Nuevo Reporte
                                </button>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class='form-group'>
                                <button type="button" class="btn" ng-click="verFormDeleteReporte()">
                                    <i class="fa fa-trash-o" aria-hidden="false">
                                        <div class="icon-bg bg-orange"></div>
                                    </i>
                                    Elimiar Reporte
                                </button>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-12" id="preloader" ng-show="preloader">
                        <div class="wait" style="width: 55px; height: 55px; margin: auto"></div>
                    </div>

                    <div class="col-md-12" ng-show="verFromNuevo">
                        <form name="form" class="form-vertical" novalidate>
                            <fieldset>
                                <legend>Crear y publicar Reporte</legend>

                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <label for="label" style="color: black;">Nombre Reporte:</label>
                                        <input type="text" class="form-control" ng-model="jasper.label" placeholder="Reporte" name="label" required>
                                        <div ng-show="form.$submitted || form.label.$touched">
                                            <span class="label label-danger" ng-show="form.label.$error.required">Requerido</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="description" style="color: black;">Descripción del Reporte:</label>
                                        <input type="text" class="form-control" ng-model="jasper.description" placeholder="Descripción" name="description">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <label for="dataSource" style="color: black;">Fuente de Datos / Data Source:</label>
                                        <input type="text" class="form-control" ng-model="jasper.dataSource" placeholder="/datasources/Deporvida" name="dataSource" required>
                                        <div ng-show="form.$submitted || form.dataSource.$touched">
                                            <span class="label label-danger" ng-show="form.dataSource.$error.required">Requerido</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="jquery" style="color: black;">Consulta:</label>
                                        <input type="text" class="form-control" ng-model="jasper.jquery" placeholder="/Deporvida/Consultas/..." name="jquery">
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <label for="jrxml" style="color: black;">Plantilla Reporte:</label>
                                        <input type="text" class="form-control" ng-model="jasper.jrxml" placeholder="/Deporvida/Plantillas/..." name="jrxml" required>
                                        <div ng-show="form.$submitted || form.jrxml.$touched">
                                            <span class="label label-danger" ng-show="form.jrxml.$error.required">Requerido</span>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-6">
                                        <label for="uri" style="color: black;">Identificador:</label>
                                        <input type="text" class="form-control" ng-model="jasper.uri" placeholder="/Deporvida/Reportes/..." name="uri" required>
                                    </div> --}}
                                </div>
                                            
                                <div class="clearfix"></div>
                                <br/>
                                <div class="col-md-12">
                                    <div class='form-group' style="text-align: center">
                                        <button type="submit" class="btn btn-success" ng-click="crearReporte()">
                                            <i class="fa fa-file-text" aria-hidden="false">
                                                <div class="icon-bg bg-orange"></div>
                                            </i>
                                            Crear Reporte
                                        </button>
                                    </div>
                                </div>
                                
                            </fieldset>
                        </form>
                    </div>

                    <div class="col-md-12" ng-show="verFromEliminar">
                        <form name="fromDelete" class="form-vertical" novalidate>
                            <fieldset>
                                <legend>Eliminar Reporte</legend>

                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <label for="reporte_uri" style="color: black;">Reporte:</label>
                                        <input type="text" class="form-control" ng-model="jasperDelete.reporte_uri" placeholder="/Deporvida/Plantillas/..." name="reporte_uri" required>
                                        <div ng-show="fromDelete.$submitted || fromDelete.reporte_uri.$touched">
                                            <span class="label label-danger" ng-show="fromDelete.reporte_uri.$error.required">Requerido</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="clearfix"></div>
                                <br/>
                                <div class="col-md-12">
                                    <div class='form-group' style="text-align: center">
                                        <button type="submit" class="btn btn-success" ng-click="eliminarReporte()">
                                            <i class="fa fa-trash-o" aria-hidden="false">
                                                <div class="icon-bg bg-orange"></div>
                                            </i>
                                            Eliminar Reporte
                                        </button>
                                    </div>
                                </div>
                                
                            </fieldset>
                        </form>
                    </div>

                    <div class="clearfix"></div>
                    <br/>
                    <iframe ng-src="@{{iframeJaseperServer}}" ng-if="!isRefreshing"></iframe>

                </div>
            </div>
        </div>
    </div>
</div>

                        