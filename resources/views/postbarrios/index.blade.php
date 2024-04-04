<div ng-controller="BarriosCrtl">
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
            <h5>Resultado @{{ filtered.length }} de @{{ totalItems}} total Barrios</h5>
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
     <div class="pagination-panel">Resultado @{{ filtered.length }} de @{{ totalItems}} total Barrios
     </div>
   </div>

</div>

<div class="table-responsive">
<!--Inicia Boton Nuevo -->
<div class="portlet-body">
   <div class="actions">
       <a ng-href="/admin/postbarrios#/admin/postbarrios/create" class="btn btn-info"><i class='fa fa-plus'></i> Nuevo</a>
   </div>
</div>

 <div class="clearfix"></div>
    <br>
      <table id="example-export" class="table table-hover table-striped table-bordered table-advanced tablesorter" ng-init="getData()">

            <thead>

            <th>Codigo&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
            <th>Nombre Barrio&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
            <th>Estrato&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
            <th>Comuna&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
            <th>Zona&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
            <th style="width:100px;"></th>
            </thead>
            <tbody>
                <tr ng-repeat="data in filtered = (list | filter:search | orderBy : predicate :reverse) | startFrom:(currentPage-1)*entryLimit | limitTo:entryLimit">
                    <td>@{{data.codigo | uppercase }} </td>
                    <td>@{{data.nombre_barrio | uppercase }} </td>
                    <td>@{{data.estrato | uppercase }} </td>
                    <td>@{{data.nombre_comuna | uppercase }} </td>
                    <td>@{{data.nombre_zona | uppercase }} </td>
               <td>
                                                

      <div class="btn-group pull-right">
         <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Acciones <span class="fa fa-caret-down"></span></button>
             <ul class="dropdown-menu">
                 
                 <li>
                    <a ng-href="/admin/postbarrios#/admin/postbarrios/editando/@{{data.id}}"><i class="fa fa-pencil-square-o"></i>&nbsp;Editar</a>
                 </li>
                 <!--
                 <li>
                   <a ng-click="eliminar(data.id)"><i class="fa fa-trash-o"></i>&nbsp;Eliminar</a>
                 </li>
               -->
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
        <div class="col-md-12" ng-show="filteredItems > 0">
            <div pagination="" page="currentPage" on-select-page="setPage(page)" boundary-links="true" total-items="filteredItems" items-per-page="entryLimit" class="pagination-small" previous-text="&laquo;" next-text="&raquo;"></div>
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
