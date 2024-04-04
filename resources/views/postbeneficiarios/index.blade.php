<script type="text/javascript" src="js/postbeneficiarios.export.js"></script>
<div ng-controller="BeneficiariosCrtl">
  <div class="clearfix"></div><br>
  <div class="row">
    
    <div class="col-md-3">Busqueda:
      <input type="text" ng-model="search"  placeholder="Buscar" class="form-control" />
    </div>

<div class="col-md-4">
    <label for="search">Items por pagina:</label>
    <input type="number" min="1" max="100" class="form-control" ng-model="pageSize">
  </div>

    <div class="col-md-5">
      <h5>Resultado @{{ filtered.length }} de @{{ totalItems}} total Beneficiarios</h5>
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
             <div class="pagination-panel">Resultado @{{ filtered.length }} de @{{ totalItems}} total Beneficiarios
             </div>
           </div>

         </div>

         <div class="table-responsive">
          <!--Inicia Boton Nuevo -->
          <div class="portlet-body">
           <div class="actions">
             <button onclick="export_all()" class="btn btn-success" >
                <i class="fa fa-file-excel-o" aria-hidden="true"></i> Exportar Excel
              </button>
          
           </div>

         </div>

         <div class="clearfix"></div>
         <br>
         <table id="example-export" class="table table-hover table-striped table-bordered table-advanced tablesorter" ng-init="getData()">
          <thead>
            <th>Beneficiario&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
            <th>Documento&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
            <th>Telefonos&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
            <th>Activo&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
            <th>Acudiente&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
            <th>Documento&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
            <th>Telefono&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
            <!--<th>Opciones&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>-->
          </thead>
          <tbody>
            <tr dir-paginate="data in list|orderBy:sortKey:reverse|filter:search|itemsPerPage: pageSize">
            
              <td>@{{data.beneficiario_nombre | uppercase }} </td>
              <td>@{{data.beneficiario_documento | uppercase }} </td>
              <td>@{{data.beneficiario_telefono | uppercase }} </td>
              <td>@{{data.activo | uppercase }} </td>
              <td>@{{data.acudiente_nombre | uppercase }}  @{{data.apellidos_beneficiario | uppercase }}</td>
              <td>@{{data.acudiente_documento | uppercase }}  @{{data.apellidos_beneficiario | uppercase }}</td>
              <td>@{{data.acudiente_telefono | uppercase }}  @{{data.apellidos_beneficiario | uppercase }}</td>
         <!--     <td>
               <div ng-if="data.codigo_grupo > '0'">
                 <div class="btn-group pull-right">
                   <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Acciones <span class="fa fa-caret-down"></span></button>
                    <ul class="dropdown-menu">
                      <li>
                        <a ng-href="/admin/postbeneficiarios#/admin/postbeneficiarios/editando/@{{data.id}}">
                            <i class="fa fa-pencil-square-o"></i>&nbsp;Editar
                        </a>
                      </li>
                      <li>
                        <a ng-click="SacarGrupo(data.id)"><i class="fa fa-trash-o"></i>&nbsp;Sacar Grupo</a>
                      </li>
                      <li>
                        <a ng-click="eliminar(data.id)"><i class="fa fa-trash-o"></i>&nbsp;Eliminar</a>
                      </li>
                    </ul>
               </div>
             </div>                    

             <div ng-if="data.codigo_grupo == null">
               <div class="btn-group pull-right">
                 <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Acciones <span class="fa fa-caret-down"></span></button>
                 <ul class="dropdown-menu">

                   <li>
                    <a ng-href="/admin/postbeneficiarios#/admin/postbeneficiarios/editando/@{{data.id}}"><i class="fa fa-pencil-square-o"></i>&nbsp;Editar</a>
                  </li>
                   <li>
                    <a ng-href="/admin/postbeneficiarios#/admin/postbeneficiarios/editando/@{{data.id}}"><i class="fa fa-eye-o"></i>&nbsp;Editar</a>
                  </li>

               </ul>
             </div>
           </div>       

         </div>
       </td>
       -->
     </tr>
   </tbody>
 </table>
 <div class="col-md-12" ng-show="filteredItems == 0">
  <div class="col-md-12">
    <h4>No se encontraron resultados</h4>
  </div>
</div>
<dir-pagination-controls></dir-pagination-controls>

{{-- <div class="col-md-12" ng-show="filteredItems > 0">
  <div pagination="" page="currentPage" on-select-page="setPage(page)" boundary-links="true" total-items="filteredItems" items-per-page="entryLimit" class="pagination-small" previous-text="&laquo;" next-text="&raquo;"></div>
</div> --}}

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
             <b>AGREGAR BENEFICIARIO A</b> GRUPO <br>
             <small>@{{ form_contenido }}.</small>
           </h3>
         </div>
         <div class="tab-content">
           <div class='row'>
            <div class='col-sm-6'>    
              <div class='form-group'>
                <label for="user_firstname">Monitor</label>
                <select name="monitor" ng-model="monitor" class="form-control" required style="width: 280px;" ng-change='selectedMonitor(monitor)'>
                  <option value="">Seleccione 
                  Monitor</option>
                  <option ng-repeat="monitor in monitores" value="@{{ monitor.id }}">@{{ monitor.primer_nombre }} @{{ monitor.segundo_nombre }} @{{ monitor.primer_apellido }} @{{ monitor.segundo_apellido }}</option>
                </select>
                <span class="label label-danger" ng-show="frm.monitor.$dirty && frm.monitor.$error.required">Requerido</span>
              </div>
            </div>
            <div class='col-sm-6'>
              <div class='form-group'>
                <label for="user_firstname">Grupo</label>
                <select name="grupo_monitor" ng-model="grupo_monitor" class="form-control" required style="width: 250px;">
                  <option value="">Seleccione 
                  Grupo</option>
                  <option ng-repeat="grupo_monitor in monitores_grupo" value="@{{ grupo_monitor.id }}">@{{ grupo_monitor.codigo_grupo }}</option>
                </select>
                <span class="label label-danger" ng-show="frm.grupo_monitor.$dirty && frm.grupo_monitor.$error.required">Requerido</span>
              </div>
            </div>

            <div align="center">
            <button type="submit" class="btn btn-success" ng-click="formAsociar(frm.$valid, id)"  ng-disabled="frm.$invalid"><i class="fa fa-save"></i>&nbsp;&nbsp;Asociar</button>
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
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

