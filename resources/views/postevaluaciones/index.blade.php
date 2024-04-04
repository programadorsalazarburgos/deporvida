<style type="text/css">
    .label {
        font-size: 14px !important;
    }
    .alert-info {
        color: #31708f !important;
        background-color: #d9edf7;
        border-color: #bce8f1;
    }
</style>

<script type="text/javascript">
    var tipo = {!! json_encode($tipo) !!};
</script>

<div>

    {{-- <div class="row">
        <div class="col-md-2">Lista:
            <select ng-model="entryLimit" class="form-control" style="text-align: left;">
                <option>5</option>
                <option>10</option>
                <option>20</option>
                <option ng-selected="true">50</option>
                <option>100</option>
            </select>
        </div>
        <div class="col-md-3">Busqueda:
            <input type="text" ng-model="search" ng-change="filter()" placeholder="Buscar" class="form-control" />
        </div>
        <div class="col-md-4">
            <h5>Resultado @{{ filtered.length}} de @{{ totalItems}} total Evaluaciones</h5>
        </div>
    </div> --}}

    <div class="row" ng-show="activo">
        <div class="col-md-12">
            <div class="alert alert-info" role="alert">
                <h3><strong>Evaluación:</strong> @{{evPyp.nombre}}</h3>
                <span class="label label-danger"><strong>Plazo de Evaluacion:</strong> Del: @{{evPyp.plazo_inicial}} hasta: @{{evPyp.plazo_final}}</span>
                <div style="margin-top: 17px">
                    <ul>
                        <li><strong>Grupos pendientes por Evaluar:</strong> <span class="badge">@{{evPyp.grupos_pendientes.length}}</span> </li>
                        <li><strong>Periodo a Evaluar:</strong> Desde: @{{evPyp.periodo_inicial}} hasta @{{evPyp.periodo_final}}</li>
                        <li><strong>Observaciones:</strong> @{{evPyp.observaciones}} </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row" ng-show="!activo">
        <div class="col-md-12">
            <div class="alert alert-danger" role="alert">
                <h3><strong>No hay evaluaciones que realizar!</strong></h3> 
                <p>Cuando se programe un nuevo periodo de evaluacion saldra aqui la información al respecto </p>
                <br/>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>
    <br>
    <div id="table-action" class="row" ng-show="activo">
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

                            <div class="table-responsive">

                                <div class="portlet-body">
                                    <div class="actions">
                                        <a ng-href="/admin/postevaluaciones#/admin/postevaluacion/create-edit/@{{tipo}}" class="btn btn-info"><i class='fa fa-plus'></i> Nueva Evaluación</a>
                                    </div>
                                </div>

                                <div class="clearfix"></div>
                                <br/>

                                <table id="example-export" class="table table-hover table-striped table-bordered table-advanced tablesorter" ng-init="getData()">
                                    <thead>
                                        <th style="width:85px;">FECHA&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                        <th>MONITOR&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                        <th>GRUPO&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                        <th>NIVEL&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                        <th>ESCENARIO&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                        <th>DISCIPLINA&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                        <th style="width:100px;"></th>
                                    </thead>
                                    <tbody>
                                        <tr dir-paginate="data in list|orderBy:sortKey:reverse|filter:search|itemsPerPage: pageSize">
                                            <td>@{{data.fecha | uppercase }} </td>
                                            <td>@{{data.fk_tbl_dv_grupos.fk_view_dv_monitores.per_mon_nombre_primero + ' ' + data.fk_tbl_dv_grupos.fk_view_dv_monitores.per_mon_apellido_primero | uppercase }} </td>
                                            <td>@{{data.fk_tbl_dv_grupos.codigo_grupo | uppercase }} </td>
                                            <td>@{{data.fk_tbl_dv_grupos.fk_tbl_dv_niveles.descripcion | uppercase }} </td>
                                            <td>@{{data.fk_tbl_dv_grupos.fk_tbl_dv_escenarios.nombre_escenario | uppercase }} </td>
                                            <td>@{{data.fk_tbl_dv_grupos.fk_tbl_dv_disciplinas.descripcion | uppercase }} </td>
                                            <td>
                                                <div class="btn-group pull-right">
                                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Acciones <span class="fa fa-caret-down"></span></button>
                                                        <ul class="dropdown-menu">
                                                            <li> <a ng-href="/admin/postevaluaciones#/admin/postevaluacion/create-edit/@{{tipo}}/@{{data.id}}"><i class="fa fa-pencil-square-o"></i>&nbsp;Editar</a> </li>
                                                            {{-- <li> <a ng-click="eliminar(data.id)"><i class="fa fa-trash-o"></i>&nbsp;Eliminar</a> </li> --}}
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="col-md-12" ng-show="filteredItems == 0">
                                    <div class="col-md-12">
                                        <h4>No se encontraron resultados</h4>
                                    </div>
                                </div>
                                <dir-pagination-controls></dir-pagination-controls>

                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

                        