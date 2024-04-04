<style type="text/css">
</style>

<script type="text/javascript">
</script>

<div>

    <div class="clearfix"></div>
    <br>

    <div class="row">

        <div class="col-md-2">Lista:
            <select ng-model="entryLimit" class="form-control" style="text-align: left;">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>
        <div class="col-md-3">Busqueda:
            <input type="text" ng-model="search" ng-change="filter()" placeholder="Buscar" class="form-control" />
        </div>
        <div class="col-md-4">
            <h5>Resultado @{{ filtered.length}} de @{{ totalItems}} total @{{title}}</h5>
        </div>
    </div>

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

                            <div class="table-responsive">

                                <div class="portlet-body">
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <div class="actions">
                                                <a ng-href="/admin/postindicadores#/admin/postindicadores/create-edit" class="btn btn-info"><i class='fa fa-plus'></i> Nuevo</a>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-md-offset-4">
                                            <div class="btn-group pull-right">
                                                <a type="button" style="" class="btn" ng-class="tec.class" ng-click="selectTipo('TECNICO')"> <i class="fa" ng-class="tec.icono"></i>&nbsp; Técnicos</a>
                                                <a type="button" style="" class="btn" ng-class="psi.class" ng-click="selectTipo('PSICOSOCIAL')"> <i class="fa" ng-class="psi.icono"></i> &nbsp; Psicosociales</a>
                                                {{-- <label for="radio-1">Técnicos</label>
                                                <input type="radio" name="radio-1" id="radio-1">
                                                <label for="radio-2">Psicosociales</label>
                                                <input type="radio" name="radio-2" id="radio-2"> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="clearfix"></div>
                                <br/>

                                <table id="example-export" class="table table-hover table-striped table-bordered table-advanced tablesorter" ng-init="getData(tipo)">
                                    <thead>
                                        <th ng-show="tipo == 'PSICOSOCIAL'">EJE TEMATICO&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                        <th ng-show="tipo == 'TECNICO'">DISCIPLINA&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                        <th ng-show="tipo == 'TECNICO'">NIVEL&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                        <th>INDICADOR&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                        <th>OBSERVACIONES&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                        <th style="width:100px;"></th>
                                    </thead>
                                    <tbody>
                                        <tr dir-paginate="data in list|orderBy:sortKey:reverse|filter:search|itemsPerPage: pageSize">
                                            <td ng-show="tipo == 'PSICOSOCIAL'">@{{data.fk_tbl_dv_ejes_tematicos.nombre | uppercase }} </td>
                                            <td ng-show="tipo == 'TECNICO'">@{{data.fk_tbl_dv_disciplinas.descripcion | uppercase }} </td>
                                            <td ng-show="tipo == 'TECNICO'">@{{data.fk_tbl_dv_niveles.descripcion | uppercase }} </td>
                                            <td>@{{data.nombre | uppercase }} </td>
                                            <td>@{{data.observaciones | uppercase }} </td>
                                            <td>
                                                <div class="btn-group pull-right">
                                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Acciones <span class="fa fa-caret-down"></span></button>
                                                        <ul class="dropdown-menu">
                                                            <li> <a ng-href="/admin/postindicadores#/admin/postindicadores/create-edit/@{{tipo}}/@{{data.id}}"><i class="fa fa-pencil-square-o"></i>&nbsp;Editar</a> </li>
                                                            <li> <a ng-click="eliminar(data.id)"><i class="fa fa-trash-o"></i>&nbsp;Eliminar</a> </li>
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

                        