
<div ng-controller="RolesCrtl">
 <style>
        .code {
            height: 80px !important;
        }

        textarea.ng-invalid.ng-dirty{border:1px solid red;}
        select.ng-invalid.ng-dirty{border:1px solid red;}
        option.ng-invalid.ng-dirty{border:1px solid red;}
        input.ng-invalid.ng-dirty{border:1px solid red;}

</style>

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
      <h5>Resultado @{{ filtered.length }} de @{{ totalItems}} total Roles</h5>
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
             <div class="pagination-panel">Resultado @{{ filtered.length }} de @{{ totalItems}} total de Roles
             </div>
           </div>

         </div>

         <div class="table-responsive">
          <!--Inicia Boton Nuevo -->
          <div class="portlet-body">
           <div class="actions">
             <a  ng-click="toggle('CrearRol')" class="crear-roles btn btn-info"><i class="fa fa-plus"></i>&nbsp;Nuevo</a>&nbsp;

           </div>
         </div>

         <div class="clearfix"></div>
         <br>
         <table id="example-export" class="table table-hover table-striped table-bordered table-advanced tablesorter" ng-init="getData()">

          <thead>

            <th>Nombre Rol&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
            <th>Descripción Rol&nbsp;<a ng-click="sort_by('addressLine1');"><i class="glyphicon glyphicon-sort"></i></a></th>
            
            
            <th style="width:250px;"></th>
          </thead>
          <tbody>
            <tr ng-repeat="data in filtered = (list | filter:search | orderBy : predicate :reverse) | startFrom:(currentPage-1)*entryLimit | limitTo:entryLimit">
              <td>@{{data.name}}</td>
              <td>@{{data.display_name}}</td>


              <td>


                <div class="btn-group pull-right">

                  <a class="editar-roles btn btn-success" ng-href="/admin/postroles#/admin/postroles/permisos/@{{data.id}}"><i class="fa fa-pencil-square-o"></i>&nbsp;Permisos</a>
                  <a class="eliminar-roles btn btn-primary" ng-click="eliminar(data.id)"><i class="fa fa-times"></i>&nbsp;Eliminar</a>
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
<!-- show modal  -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <div class="orange" id="wizardProfile">
          <form method="POST" id="myform" name="myform" class="form-modal" enctype="multipart/form-data">
            <div class="wizard-header">
              <h3>
                <b>CREACIÓN</b> ROL SIDER <br>
              </h3>
            </div>
            <div class="tab-content">
              <form id="frm" name="frm">
                <div class="form-group">
                  <label for="email">@{{ form_title }}:</label>
                </div>
                <div class="form-group">
                  <label for="pwd">Nombre Rol:</label>
                  <input class="form-control" name="nombre" ng-model="nombre" required></input>
                    <span class="label label-danger" ng-show="frm.nombre.$dirty && frm.nombre.$error.required">Requerido</span>
                </div>
                <div class="form-group">
                  <label for="pwd">Descripción Rol:</label>
                  <textarea class="form-control" name="descripcion" ng-model="descripcion" required></textarea>
                  <span class="label label-danger" ng-show="frm.descripcion.$dirty && frm.descripcion.$error.required">Requerido</span>
                </div>

                <button  ng-click="GuardarRol()" class="btn btn-success" ng-click="formsubmit(frm.$valid)"  ng-disabled="frm.$invalid"><i class="fa fa-save"></i>&nbsp;&nbsp;Guardar</button>
              </form>
            </div>
          </div>
          <div class="wizard-footer">
            <div class="pull-right">
              <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
            </div>
            <div class="clearfix"></div>
          </div>
        </form>
      </div>
    </div> <!-- wizard container -->
  </div>
</div>

</div>

