<div ng-controller="PermisosRolesCtrl">
  <div class="page-role">
    <div class="row">
      <dualmultiselect options="demoOptions"> </dualmultiselect>
      <section>
        <h2 class="text-left"><span class="label label-success"><strong>ROL @{{ rol.name }}</strong></span></h2>
        <p class="text-left"><small class="label label-info">PANEL PARA ADMINISTRAR LOS PERMISOS DE ESTE ROL</small></p>
        <div class="clearfix"></div><br>
        <twin-list list-data="myData"  selected-data="mySelectedData" max-selections="null" min-selections="2"></twin-list>
      </section>
      <input type="text" id="rolsider" value="@{{ role }}" style="display:none">
      <section>

        <div class="col-lg-11">
          <div class="note note-info"><h3>@{{ serie.id }}Asignación de permisos por Rol</h3>

            <p>Por medio de este modulo podras asignar los permisos para la admistración del 
              sistema dependiendo del rol que elijas. los permisos que aparecen al lado izquierdo
            son todo aquellos permisos que podemos asignar a nuestro respectivo rol</p></div>
          </div>
              
      
      
      </section>
      <div class="clearfix"></div><br>
      
  </div>
</div>
</div>
