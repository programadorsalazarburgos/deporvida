<script>
    function download()
    {
        $.ajax({
            url:'{{url('')}}/api/v0/admin/postreporteparrilla',
            type:'POST',
            dataType:'json',
            success:function(data)
            {

                console.log(data);
                var headers = {
                    "Monitor":"Monitor",
                    "Grupo":"Grupo",
                    "Nivel":"Nivel",
                    "Grupo_Activo":"Grupo_Activo",
                    "Comuna_de_Impacto":"Comuna_de_Impacto",
                    "Comuna_Escenario":"Comuna_Escenario",
                    "Barrio_Escenario":"Barrio_Escenario",
                    "Nombre_Escenario":"Nombre_Escenario",
                    "Direccion":"Direccion",
                    "Direccion_Complemento":"Direccion_Complemento",
                    "descripcion_escenario":"descripcion_escenario",
                    "Disciplina_Actividad":"Disciplina_Actividad",
                    "Dias":"Dias","Horarios":"Horarios",
                    "corregimiento":"corregimiento",
                    "vereda":"vereda",
                    "presupuesto":"presupuesto",
                    "grupo_observaciones":"grupo_observaciones",
                  


                };
                exportCSVFile(headers, data, 'reporteparrilla')
            }
        })
    }
</script>
<style type="text/css">
    .table-responsive {
        width: 100%;
        margin-bottom: 15px;
        overflow-x: auto;
        overflow-y: hidden;
        -webkit-overflow-scrolling: touch;
        -ms-overflow-style: -ms-autohiding-scrollbar;
    }
    .table-responsive > .table > thead > tr > th, .table-responsive > .table > tbody > tr > th, .table-responsive > .table > tfoot > tr > th, .table-responsive > .table > thead > tr > td, .table-responsive > .table > tbody > tr > td, .table-responsive > .table > tfoot > tr > td {
        white-space: nowrap;
    }
</style>
<div ng-controller="ReporteParrillaCrtl">

    <div class="clearfix"></div>
    <br>
    <div class="row">

        <div class="col-md-3">Busqueda:
            <input type="text" ng-model="search" placeholder="Buscar" class="form-control" />
        </div>

        <div class="col-md-4">
            <label for="search">Items por pagina:</label>
            <input type="number" min="1" max="100" class="form-control" ng-model="pageSize">
        </div>

        <div class="col-md-5">
            <h5>Resultado @{{ filtered.length }} de @{{ totalItems}} total Items</h5>
        </div>
    </div>



    <div class="clearfix"></div>
    <br>
    <div id="table-action" class="row">
        <div class="col-lg-12">

            <ul id="tableactiondTab" class="nav nav-tabs">
                <li class="active">
                    <a href="#table-table-tab" data-toggle="tab">Reporte Cronograma de Actividades - Parrilla</a>
                </li>
            </ul>

            <div id="tableactionTabContent" class="tab-content">
                <div id="table-table-tab" class="tab-pane fade in active">

                    <div id="preloader">
                        <div class="wait" style="width: 55px; height: 55px; margin: auto"></div>
                    </div>
                    
                    <form class="form-vertical reporte" role="form" method="post" enctype="multipart/form-data" action="{{url('export/excelreporteparrilla')}}">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="portlet-body">
                                    <div class="actions">
                                        <button type="button" class="btn btn-success" onclick="download()">
                                            <i class="fa fa-file-excel-o" aria-hidden="true" ></i> Exportar Excel
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <div class="clearfix"></div>
                                    <br>
                                    <table id="example-export" class="table table-hover table-striped table-bordered table-advanced tablesorter" ng-init="getData()">
                                        <thead>
                                            <th>Monitor&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>Grupo&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>Grupo Activo&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>Comuna de Impacto&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>Comuna Escenario&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>Barrio Escenario&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>Escenario – Dirección&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>Corregimientos - Veredas&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            

                                            <th>Disciplina/Actividad&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>Días&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>Horarios&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>Presupuesto&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>Observaciones&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>

                                        </thead>
                                        <tbody>
                                            <tr dir-paginate="data in list|orderBy:sortKey:reverse|filter:search|itemsPerPage: pageSize">
                                                <td>@{{data.Monitor | uppercase }} </td>
                                                <td>@{{data.Grupo | uppercase }} </td>
                                                <td>@{{data.Grupo_Activo | uppercase }} </td>
                                                <td>@{{data.Comuna_de_Impacto | uppercase }} </td>
                                                <td>@{{data.Comuna_Escenario | uppercase }} </td>
                                                <td>@{{data.Barrio_Escenario | uppercase }} </td>
                                                <td>@{{data.Escenario_Direccion | uppercase }} </td>
                                                <td>@{{data.corregimiento | uppercase }} - @{{data.vereda | uppercase }} </td>
                                                <td>@{{data.Disciplina_Actividad | uppercase }} </td>
                                                <td>@{{data.Dias | uppercase }} </td>
                                                <td>@{{data.Horarios | uppercase }} </td>
                                                <td>@{{data.presupuesto | uppercase }} </td>
                                                <td>@{{data.grupo_observaciones}} </td>
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

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

                        