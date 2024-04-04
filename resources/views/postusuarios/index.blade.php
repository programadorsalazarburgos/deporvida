


<div ng-controller="UsuariosCrtl">

<script>
  
function convertToCSV(objArray) 
{
    var array = typeof objArray != 'object' ? JSON.parse(objArray) : objArray;
    var str = '';
    for (var i = 0; i < array.length; i++) 
    {
        var line = '';
        for (var index in array[i]) 
        {
            if (line != '') 
            {line += ';';}
            try
            {
                line += array[i][index];
                //line += utf8_decode(array[i][index]);
            }
            catch(Exception)
            {
                line += array[i][index];
            }
        }
        line=line.replace(/\á/g, 'a').replace(/\é/g, 'e').replace(/\í/g, 'i').replace(/\ó/g, 'o').replace(/\ú/g, 'u');
        line=line.replace(/\Á/g, 'A').replace(/\É/g, 'E').replace(/\Í/g, 'I').replace(/\Ó/g, 'O').replace(/\Ú/g, 'U');
        str += line + '\r\n';
    }
    return str;
}


function exportCSVFile(headers, items, fileTitle) {
    if (headers) {
        items.unshift(headers);
    }

    // Convert Object to JSON
    var jsonObject = JSON.stringify(items);

    var csv = this.convertToCSV(jsonObject);

    var exportedFilenmae = fileTitle + '.csv' || 'export.csv';

    var blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
    if (navigator.msSaveBlob) { // IE 10+
        navigator.msSaveBlob(blob, exportedFilenmae);
    } else {
        var link = document.createElement("a");
        if (link.download !== undefined) { // feature detection
            // Browsers that support HTML5 download attribute
            var url = URL.createObjectURL(blob);
            link.setAttribute("href", url);
            link.setAttribute("download", exportedFilenmae);
            link.style.visibility = 'hidden';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    }
}


function CargarImagen()
{

  $('#myDiv').show();
}


function download(){

  CargarImagen();

  $.ajax({
            url:'{{url('')}}/api/v0/admin/postreporteUsuarios',
            type:'POST',
            dataType:'json',
            data:$('form').serialize(),
           //  beforeSend: function() {
           //    $("#loading-image").show();
           // },
            success:function(data)
            {




var headers = {
      fecha_nacimiento: 'fecha_nacimiento', // remove commas to avoid errors
      tipo_documento: 'tipo_documento', // remove commas to avoid errors
      numero_documento: 'numero_documento', // remove commas to avoid errors
      nombre_rol: 'nombre_rol', // remove commas to avoid errors
      presupuesto: "presupuesto",
      estado_aspirante: "estado_aspirante",
      primer_nombre: "primer_nombre",
      segundo_nombre: "segundo_nombre",
      primer_apellido: "primer_apellido",
      segundo_apellido: "segundo_apellido",
      email: "email",
      telefono_movil: "telefono_movil",
      direccion: "direccion",
      estado_aspirante: "estado_aspirante",
      empleado_cargo: "empleado_cargo",
      comunas: "comunas",
      nombre_pais: "nombre_pais",
      nombre_departamento: "nombre_departamento",
      nombre_municipio: "nombre_municipio",
      corregimiento: "corregimiento",
      vereda: "vereda",
      comuna_residencia: "comuna_residencia",
      barrio: "barrio",
      residencia_estrato: "residencia_estrato",
      direccion_residencia: "direccion_residencia",
      nivel_escolaridad: "nivel_escolaridad",
      estado_escolaridad: "estado_escolaridad",
      profesion: "profesion",
      institucion_educativa: "institucion_educativa",
      ocupacion: "ocupacion",
      estado_civil: "estado_civil",
      tiene_hijos: "tiene_hijos",
      cuantos_hijos: "cuantos_hijos",
      etnia: "etnia",
      padece_enfermedad: "padece_enfermedad",
      toma_medicamentos: "toma_medicamentos",
      medicamentos: "medicamentos",
      sangre_tipo: "sangre_tipo",
      tiene_discapacidad: "tiene_discapacidad",
      afiliado_sgsss: "afiliado_sgsss",
      eps: "eps",
      libreta_militar: "libreta_militar",
      no_libreta_militar: "no_libreta_militar",
      distrito_militar: "distrito_militar",
      skype: "skype",
      proyecto_profesional: "proyecto_profesional"



  };

  var itemsFormatted = [];

  // format the data
  data.forEach((item) => {
      itemsFormatted.push({
          fecha_nacimiento: item.fecha_nacimiento, // remove commas to avoid errors,
          tipo_documento: item.tipo_documento, // remove commas to avoid errors,
          numero_documento: item.numero_documento, // remove commas to avoid errors,
          nombre_rol: item.nombre_rol, // remove commas to avoid errors,
          presupuesto: item.presupuesto,
          estado_aspirante: item.estado_aspirante,
          primer_nombre: item.primer_nombre,
          segundo_nombre: item.segundo_nombre,
          primer_apellido: item.primer_apellido,
          segundo_apellido: item.segundo_apellido,
          email: item.email,
          telefono_movil: item.telefono_movil,
          direccion: item.direccion,
          estado_aspirante: item.estado_aspirante,
          empleado_cargo: item.empleado_cargo,
          comunas: item.comunas,
          nombre_pais: item.nombre_pais,
          nombre_departamento: item.nombre_departamento,
          nombre_municipio: item.nombre_municipio,
          corregimiento: item.corregimiento,
          vereda: item.vereda,
          comuna_residencia: item.comuna_residencia,
          barrio: item.barrio,
          residencia_estrato: item.residencia_estrato,
          direccion_residencia: item.direccion_residencia,
          nivel_escolaridad: item.nivel_escolaridad,
          estado_escolaridad: item.estado_escolaridad,
          profesion: item.profesion,
          institucion_educativa: item.institucion_educativa,
          ocupacion: item.ocupacion,
          estado_civil: item.estado_civil,
          tiene_hijos: item.tiene_hijos,
          cuantos_hijos: item.cuantos_hijos,
          etnia: item.etnia,
          padece_enfermedad: item.padece_enfermedad,
          toma_medicamentos: item.toma_medicamentos,
          medicamentos: item.medicamentos,
          sangre_tipo: item.sangre_tipo,
          tiene_discapacidad: item.tiene_discapacidad,
          afiliado_sgsss: item.afiliado_sgsss,
          eps: item.eps,
          libreta_militar: item.libreta_militar,
          no_libreta_militar: item.no_libreta_militar,
          distrito_militar: item.distrito_militar,
          skype: item.skype,
          proyecto_profesional: item.proyecto_profesional


      });
  });


  var fileTitle = 'Reporte_General'; // or 'my-unique-title'

  exportCSVFile(headers, itemsFormatted, fileTitle); // call the exportCSVFile() function to process the JSON and trigger the download
  $('#myDiv').hide();
   }
  
  })


  
}
</script>



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
            <h5>Resultado @{{ filtered.length }} de @{{ totalItems}} total Usuarios</h5>
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
     <div class="pagination-panel">Resultado @{{ filtered.length }} de @{{ totalItems}} total Usuarios
     </div>
   </div>

</div>

<div class="table-responsive">
<!--Inicia Boton Nuevo -->
<div class="portlet-body">
   <div class="actions">
       <a ng-href="postusuarios/create" class="crear-usuarios btn btn-info"><i class='fa fa-plus'></i> Nuevo</a>

                  <button type="button" class="btn btn-success" onclick="download()">
                      <i class="fa fa-file-excel-o" aria-hidden="true" ></i> Exportar Excel
                  </button>   

   </div>
</div>

 <div class="clearfix"></div>
    <br>
      <table id="example-export" class="table table-hover table-striped table-bordered table-advanced tablesorter" ng-init="getData()">

            <thead>

            <th>Nombre Usuario&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
            <th>Documento&nbsp;<a ng-click="sort_by('addressLine1');"><i class="glyphicon glyphicon-sort"></i></a></th>
            <th>Correo Electronico&nbsp;<a ng-click="sort_by('addressLine1');"><i class="glyphicon glyphicon-sort"></i></a></th>
            <th>Telefono Movil&nbsp;<a ng-click="sort_by('addressLine1');"><i class="glyphicon glyphicon-sort"></i></a></th>
            <th>Dirección&nbsp;<a ng-click="sort_by('addressLine1');"><i class="glyphicon glyphicon-sort"></i></a></th>
            <th>Rol en el programa&nbsp;<a ng-click="sort_by('addressLine1');"><i class="glyphicon glyphicon-sort"></i></a></th>
            <th>Estado&nbsp;<a ng-click="sort_by('addressLine1');"><i class="glyphicon glyphicon-sort"></i></a></th>
            <th>Rol del sistema&nbsp;<a ng-click="sort_by('addressLine1');"><i class="glyphicon glyphicon-sort"></i></a></th>



            <th>Comunas&nbsp;<a ng-click="sort_by('addressLine1');"><i class="glyphicon glyphicon-sort"></i></a></th>
            <th>Opciones&nbsp;<a ng-click="sort_by('addressLine1');"><i class="glyphicon glyphicon-sort"></i></a></th>
            </thead>
            <tbody>
                <tr ng-repeat="data in filtered = (list | filter:search | orderBy : predicate :reverse) | startFrom:(currentPage-1)*entryLimit | limitTo:entryLimit">
                    <td>@{{data.primer_nombre | uppercase }} @{{data.primer_apellido | uppercase }} </td>
                    <td>@{{(data.numero_documento | currency:'':0)}}</td>
                    <td>@{{data.email | uppercase }}</td>
                    <td>@{{data.telefono_movil | uppercase }}</td>
                    <td>@{{data.direccion | uppercase}}</td>
                    <td>@{{data.empleado_cargo | uppercase}}</td>
                    <td>@{{data.estado_aspirante | uppercase}}</td>
                    <td>@{{data.display_name | uppercase}}</td>
                    <td>@{{data.comunas | uppercase}}</td>
                    <td>
                      <div class="btn-group pull-right">
                         <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Acciones <span class="fa fa-caret-down"></span></button>
                             <ul class="dropdown-menu">
                                 <li>
                                    <a ng-href="/admin/postusuarios#/admin/postusuarios/mostrar/@{{data.id}}"><i class="fa fa-search-plus" aria-hidden="true"></i>&nbsp; Ver</a>
                                 </li>
                                 <li class="editar-usuarios">
                                    <a ng-href="/postusuarios/editar/@{{data.id_persona}}"><i class="fa fa-pencil-square-o"></i>&nbsp;Editar</a>
                                 </li>
                                 <li class="editar-usuarios">
                                    <a ng-href="/admin/postusuarios#/admin/postusuarios/clave/@{{data.id}}"><i class="fa fa-spinner"></i>&nbsp;Cambiar Password</a>
                                 </li>
                                 <li class="eliminar-usuarios">
                                   <a ng-click="eliminar(data.id)"><i class="fa fa-trash-o"></i>&nbsp;Eliminar</a>
                                 </li>
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
