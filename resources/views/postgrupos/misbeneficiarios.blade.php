<div ng-controller="MisBeneficiariosGrupoCtrl">
    <div class="clearfix"></div><br>
    <div class="row">
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
            <h5>Resultado @{{ filtered.length}} de @{{ totalItems}} total Beneficiarios</h5>
        </div>
    </div>
    <div class="clearfix"></div><br>
    <div id="table-action" class="row">
        <div class="col-lg-12">

            <ul id="tableactiondTab" class="nav nav-tabs">
                <li class="active"><a href="#table-table-tab" data-toggle="tab">Información</a></li>
            </ul>
            <div id="tableactionTabContent" class="tab-content">
                <div id="table-table-tab" class="tab-pane fade in active">
                    <div class="row">
                        <div class="col-lg-12"><h4 class="box-heading">Paginación</h4>
                            <div class="table-container">
                                <div class="row mbm">
                                    <div class="col-lg-6">
                                        <div class="pagination-panel">Resultado @{{ filtered.length}} de @{{ totalItems}} total Beneficiarios
                                        </div>
                                    </div>

                                </div>

                                <div class="table-responsive">
                                    <!--Inicia Boton Nuevo -->
                                    <div class="portlet-body">
                                        <div class="actions">
                                            <a ng-href="beneficiarios/create/@{{grupo}}" class="btn btn-info"><i class='fa fa-plus'></i> Nuevo</a>
                                        </div>
                                    </div>

                                    <div class="clearfix"></div>
                                    <br>
                                    <table id="example-export" class="table table-hover table-striped table-bordered table-advanced tablesorter" ng-init="getData()">

                                        <thead>
                                        <th>Codigo Ficha&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                        <th>Nombres y Apellidos&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                        <th>No Documento&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                        <th>Edad&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                        <th>E.P.S.&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                        <th>Acudiente&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                        <th>Telefono&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                        <th>Direccion&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                        <th>Fecha inscripcion&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                        <th>Opciones</th>
     <!--<th style="width:100px;"></th>-->
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="data in filtered = (list| filter:search | orderBy : predicate :reverse) | startFrom:(currentPage - 1) * entryLimit | limitTo:entryLimit">
                                                <td>@{{data.id_ficha}} </td>
                                                <td>@{{data.nombres_beneficiario}}  @{{data.apellidos_beneficiario}}</td>
                                                <td>@{{data.documento}} </td>
                                                <td>@{{data.edad}} </td>
                                                <td>@{{data.eps}} </td>
                                                <td>@{{data.acudiente}} </td>
                                                <td>@{{data.telefono}} </td>
                                                <td>@{{data.residencia_direccion}} </td>
                                                <td>@{{data.fecha_inscripcion}} </td>
                                                <td>
                                                    <div class="btn-group pull-right">
                                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Acciones <span class="fa fa-caret-down"></span></button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a ng-href="/beneficiarios/editar/@{{data.id_ficha}}"><i class="fa fa-pencil-square-o"></i>&nbsp;Editar</a>
                                                            </li>
                                                            <li>
                                                                <a ng-click="eliminar(data.id_ficha)"><i class="fa fa-trash-o"></i>&nbsp;Desvincular</a>
                                                            </li>
                                                        </ul>
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
                                    <div class="col-md-12" ng-show="filteredItems > 0">
                                        <div pagination="" page="currentPage" on-select-page="setPage(page)" boundary-links="true" total-items="filteredItems" items-per-page="entryLimit" class="pagination-small" previous-text="&laquo;" next-text="&raquo;"></div>
                                    </div>


                                    <!-- show modal  -->
                                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card wizard-card ct-wizard-orange" id="wizardProfile">
                                                    <form method="POST" id="f1" name="frm" class="form-modal" enctype="multipart/form-data">
                                                        <div class="wizard-header">
                                                            <h3>
                                                                <b>CAMBIAR BENEFICIARIO</b> GRUPO <br>
                                                                <small>@{{ form_contenido}}.</small>
                                                            </h3>
                                                        </div>
                                                        <div class="tab-content">
                                                            <div class='row'>
                                                                <div class='col-sm-4'>
                                                                    <div class='form-group'>
                                                                        <label for="user_firstname">Grupo</label>
                                                                        <select name="grupo" ng-model="grupo" class="form-control" required style="width: 250px;">
                                                                            <option value="">Seleccione 
                                                                                Grupo</option>
                                                                            <option ng-repeat="grupo in grupos" value="@{{ grupo.id}}">@{{ grupo.codigo_grupo}}</option>
                                                                        </select>
                                                                        <span class="label label-danger" ng-show="frm.grupo.$dirty && frm.grupo.$error.required">Requerido</span>
                                                                    </div>
                                                                </div>
                                                                <div class="clearfix"></div><br>
                                                                <div align="center">
                                                                    <button type="submit" class="btn btn-success" ng-click="formCambiar(frm.$valid, id)"  ng-disabled="frm.$invalid"><i class="fa fa-save"></i>&nbsp;&nbsp;Cambiar</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                </div>
                                                <div class="wizard-footer">
                                                    <div class="pull-right">
                                                        <button type="button"  class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                                                    </div>

                                                    <div class="clearfix"></div>
                                                </div>
                                                </form>
                                            </div>
                                        </div> 
                                    </div>
                                </div>

                                <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card wizard-card ct-wizard-orange" id="wizardProfile">
                                                    <form method="POST" id="f1" name="frm" class="form-modal" enctype="multipart/form-data">
                                                        <div class="wizard-header">
                                                            <h3>
                                                                <b>MOTIVO DESVINCULACIÒN</b> GRUPO <br>
                                                               
                                                            </h3>
                                                        </div>
                                                        <div class="container-fluid">
                                                        <div class="row">
                                                        <div class="col-md-12">
                                                        <div class='form-group'>
                                                            <label for="user_firstname">Seleccione 
                                                                    Motivo Desvinculación</label>
                                                            <select name="grupo" ng-model="motivo" class="form-control" required >
                                                                
                                                                <option ng-repeat="motivo in motivos" value="@{{ motivo.id}}">@{{ motivo.nombre}}</option>
                                                            </select>
                                                            <span class="label label-danger" ng-show="frm.motivo.$dirty && frm.motivo.$error.required">Requerido</span>
                                                        </div>
                                                            </div>
                                                            </div>
                                                            </div>
                                            
                                                                <div class="clearfix"></div><br>
                                                                <div align="center">
                                                                    <button type="submit" class="btn btn-success" ng-click="GuardarMotivo(frm.$valid, ficha)"  ng-disabled="frm.$invalid"><i class="fa fa-save"></i>&nbsp;&nbsp;Guardar</button>
                                                                </div>
                                                <div class="wizard-footer">
                                                    <div class="pull-right">
                                                        <button type="button"  class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                                                    </div>

                                                    <div class="clearfix"></div>
                                                </div>

                                                            </div>
                                                        </div>
                                                </div>
                                                </form>
                                            </div>
                                        </div> 
                                    </div>
                        </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

