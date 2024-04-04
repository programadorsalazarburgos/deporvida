<script>
    function download()
    {
        $.ajax({
            url:'{{url('')}}/api/v0/admin/postreporteficha',
            type:'POST',
            dataType:'json',
            data:$('form').serialize(),
            success:function(data)
            {
                var headers={
                    FICHA_NO:"No",
                    VINCULADO_ACTUALMENTE: 'VINCULADO_ACTUALMENTE',
                    FICHA_ID: "FICHA_ID",
                    FECHA_REGISTRO: "FECHA_REGISTRO",
                    FECHA_RETIRO: "FECHA_RETIRO",
                    MOTIVO_DESVINCULACION: "MOTIVO_DESVINCULACION",
                    PROGRAMA: "PROGRAMA",
                    MODALIDAD: "MODALIDAD",
                    PUNTO_DE_ATENCION: "PUNTO_DE_ATENCION",
                    BARRIO_PUNTO_DE_ATENCION: "BARRIO_PUNTO_DE_ATENCION",
                    COMUNA_PUNTO_DE_ATENCION: "COMUNA_PUNTO_DE_ATENCION",
                    COMUNA_DE_IMPACTO: "COMUNA_DE_IMPACTO",
                    ID_MONITOR: "ID_MONITOR",
                    MONITOR: "MONITOR",
                    ASISTENCIAS_BENEFICIARIO: "ASISTENCIAS_BENEFICIARIO",
                    CODIGO_GRUPO: "CODIGO_GRUPO",
                    NIVEL_GRUPO: "NIVEL_GRUPO",
                    GRUPO_ACTIVO: "GRUPO_ACTIVO",
                    ID_BENEFICIARIO: "ID_BENEFICIARIO",
                    PRIMER_NOMBRE: "PRIMER_NOMBRE",
                    SEGUNDO_NOMBRE: "SEGUNDO_NOMBRE",
                    PRIMER_APELLIDO: "PRIMER_APELLIDO",
                    SEGUNDO_APELLIDO: "SEGUNDO_APELLIDO",
                    DOCUMENTO: "DOCUMENTO",
                    NUM_DOC: "NUM_DOC",
                    SEXO: "SEXO",
                    FECHA_NAC: "FECHA_NAC",
                    EDAD: "EDAD",
                    //TELEFONO: "TELEFONO",
                    //CORREO_ELECTRONICO: "CORREO_ELECTRONICO",
                    PAIS: "PAIS",
                    DEPARTAMENTO: "DEPARTAMENTO",
                    MUNICIPIO: "MUNICIPIO",
                    //DIRECCION: "DIRECCION",
                    ESTRATO: "ESTRATO",
                    BARRIO: "BARRIO",
                    COMUNA_RESIDENCIA: "COMUNA_RESIDENCIA",
                    CORREGIMIENTO: "CORREGIMIENTO",
                    VEREDA: "VEREDA",
                    OCUPACION: "OCUPACION",
                    ESCOLARIDAD: "ESCOLARIDAD",
                    ESTADO_ESCOLARIDAD: "ESTADO_ESCOLARIDAD",
                    AUTORECONOCE: "AUTORECONOCE",
                    DISCAPACIDAD: "DISCAPACIDAD",
                    TIPO_DISCAPACIDAD: "TIPO_DISCAPACIDAD",
                    INDIGENA: "INDIGENA",
                    AFRODESCENDIENTE: "AFRODESCENDIENTE",
                    VICTIMA_DEL_CONFLICTO: "VICTIMA_DEL_CONFLICTO",
                    ADULTO_MAYOR: "ADULTO_MAYOR",
                    LGBTI: "LGBTI",
                    GRUPO_MUJERES: "GRUPO_MUJERES",
                    GRUPO_JOVENES: "GRUPO_JOVENES",
                    JAC: "JAC",
                    JAL: "JAL",
                    OTRO_CUAL: "OTRO_CUAL",
                    PRIMER_NOMBRE_ACUDIENTE: "PRIMER_NOMBRE_ACUDIENTE",
                    SEGUNDO_NOMBRE_ACUDIENTE: "SEGUNDO_NOMBRE_ACUDIENTE",
                    PRIMER_APELLIDO_ACUDIENTE: "PRIMER_APELLIDO_ACUDIENTE",
                    SEGUNDO_APELLIDO_ACUDIENTE: "SEGUNDO_APELLIDO_ACUDIENTE",
                    DOCUMENTO_ACUDIENTE: "DOCUMENTO_ACUDIENTE",
                    NUM_DOC_ACUDIENTE: "NUM_DOC_ACUDIENTE",
                    SEXO_ACUDIENTE: "SEXO_ACUDIENTE",
                    FECHA_NAC_ACUDIENTE: "FECHA_NAC_ACUDIENTE",
                    EDAD_ACUDIENTE: "EDAD_ACUDIENTE",
                    //TELEFONO_ACUDIENTE: "TELEFONO_ACUDIENTE",
                    //CORREO_ACUDIENTE: "CORREO_ACUDIENTE",
                    PARENTESCO: "PARENTESCO",
                    PARENTESCO_OTRO: "PARENTESCO_OTRO"
                    };
				exportCSVFile(headers, data, 'Reporte ficha');
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
    .input-group {
        display: table-row !important;
    }
    .col-md-4 {
        padding-bottom: 15px;
    }
</style>
<div ng-controller="ReporteFichaCrtl">

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
            <h5>Resultado @{{ filtered.length }} de @{{ totalItems}} total Fichas</h5>
        </div>
    </div>



    <div class="clearfix"></div>
    <br>
    <div id="table-action" class="row">
        <div class="col-lg-12">

            <ul id="tableactiondTab" class="nav nav-tabs">
                <li class="active">
                    <a href="#table-table-tab" data-toggle="tab">Reporte ficha caracterización</a>
                </li>
            </ul>

            <div id="tableactionTabContent" class="tab-content">
                <div id="table-table-tab" class="tab-pane fade in active">

                    <form name="form" class="form-vertical" role="form" method="post" enctype="multipart/form-data" action="{{url('export/excelreporteficha')}}" novalidate>
                        <fieldset>
                            <legend>Filtros</legend>

                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <label for="user_firstname" style="color: black;">* Fecha de registro, desde:</label>
                                    <p class="input-group">
                                        <input idatepicker class="form-control ifecha" name="fecha_inicial" ng-model="filtros.fecha_inicial" required ng-change="validar()"></input>
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-default"><i class="glyphicon glyphicon-calendar"></i></button>
                                        </span>
                                    </p>
                                    <div ng-show="form.$submitted || form.fecha_inicial.$touched || !formValido">
                                        <span class="label label-danger" ng-show="form.fecha_inicial.$error.required">Requerido</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="user_firstname" style="color: black;">* Fecha de registro, hasta:</label>
                                    <p class='input-group'>
                                        <input idatepicker class="form-control ifecha" name="fecha_final" ng-model="filtros.fecha_final" required ng-change="validar()"></input>
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-default"><i class="glyphicon glyphicon-calendar"></i></button>
                                        </span>
                                    </p>    
                                    <div ng-show="form.$submitted || form.fecha_final.$touched || !formValido">
                                        <span class="label label-danger" ng-show="form.fecha_final.$error.required">Requerido</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="user_firstname" style="color: black;">Modalidad:</label>
                                    <select name="disciplina" ng-model="filtros.disciplina" class="form-control">
                                        <option value="">Seleccione</option>
                                        <option ng-repeat="disciplina in disciplinas" value="@{{ disciplina.id }}">@{{ disciplina.descripcion }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <label for="user_firstname" style="color: black;">Comuna de impacto:</label>
                                    <select name="comuna_impacto" ng-model="filtros.comuna_impacto" class="form-control">
                                        <option value="">Seleccione</option>
                                        <option ng-repeat="comuna in comuna_impacto" value="@{{ comuna.id }}">@{{ comuna.nombre_comuna }}</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="user_firstname" style="color: black;">Monitor:</label>
                                    <select name="monitor" ng-model="filtros.monitor" class="form-control">
                                        <option value="">Seleccione</option>
                                        <option ng-repeat="monitor in monitores" value="@{{ monitor.id }}">@{{ monitor.per_mon_nombre_primero + ' ' + monitor.per_mon_nombre_segundo + ' ' + monitor.per_mon_apellido_primero + ' ' + monitor.per_mon_apellido_segundo }}</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="user_firstname" style="color: black;">Sexo del beneficiario:</label>
                                    <select name="sexo" ng-model="filtros.sexo" class="form-control">
                                        <option value="">Seleccione</option>
                                        <option value="1">Hombre</option>
                                        <option value="2">Mujer</option>
                                    </select>
                                </div>
                            </div>

                        </fieldset>

                        <div class="col-md-12">
                            <div class='form-group' style="text-align: center">
                                <button type="button" class="btn btn-success" ng-click="getData()">
                                    <i class="fa fa-file-text" aria-hidden="false">
                                        <div class="icon-bg bg-orange"></div>
                                    </i>
                                    Consultar
                                </button>
                            </div>
                        </div>

                        <div id="preloader" class="col-md-12">
                            <div class="wait" style="width: 55px; height: 55px; margin: auto"></div>
                        </div>

                        <div class="row reporte">
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
                                    <table id="example-export" class="table table-hover table-striped table-bordered table-advanced tablesorter">
                                        <thead>
                                            <th>FICHA NO&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>FICHA ID&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>FICHA VINCULADO ACTUALMENTE&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>FECHA REGISTRO&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>FECHA RETIRO&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>PROGRAMA&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>MODALIDAD&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>PUNTO DE ATENCIÓN&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>BARRIO PUNTO DE ATENCIÓN&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>COMUNA PUNTO DE ATENCIÓN&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>COMUNA DE IMPACTO&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>ID MONITOR&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>MONITOR&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>ASISTENCIAS BENEFICIARIO&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>CODIGO GRUPO&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>NIVEL GRUPO&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>GRUPO ACTIVO&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>ID BENEFICIARIO&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>PRIMER NOMBRE&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>SEGUNDO NOMBRE&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>PRIMER APELLIDO&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>SEGUNDO APELLIDO&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>DOCUMENTO&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>NUM DOC&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>SEXO&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>FECHA NAC&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>EDAD&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <!--  NO MOSTRAR ESTOS DATOS -->
                                            <th>TELÉFONO&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>CORREO ELECTRÓNICO&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>PAÍS&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>DEPARTAMENTO&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>MUNICIPIO&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>DIRECCIÓN&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>ESTRATO&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>BARRIO&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>COMUNA RESIDENCIA&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>CORREGIMIENTO&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>VEREDA&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>OCUPACIÓN&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>ESCOLARIDAD&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>ESTADO ESCOLARIDAD&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>AUTORECONOCE&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>DISCAPACIDAD&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>TIPO DISCAPACIDAD&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>INDÍGENA&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>AFRODESCENDIENTE&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>VICTIMA DEL CONFLICTO&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>ADULTO MAYOR&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>LGBTI&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>GRUPO MUJERES&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>GRUPO JOVENES&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>JAC&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>JAL&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>OTRO ¿CUÁL?&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>PRIMER NOMBRE ACUDIENTE&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>SEGUNDO NOMBRE ACUDIENTE&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>PRIMER APELLIDO ACUDIENTE&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>SEGUNDO APELLIDO ACUDIENTE&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>DOCUMENTO ACUDIENTE&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>NUM DOC ACUDIENTE&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>SEXO ACUDIENTE&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>FECHA NAC ACUDIENTE&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>EDAD ACUDIENTE&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>TELÉFONO ACUDIENTE&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>CORREO ACUDIENTE&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>PARENTESCO&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>PARENTESCO OTRO&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <!-- NO MOSTRAR ESTOS DATOS -->
                                        </thead>
                                        <tbody>
                                            <tr dir-paginate="data in list|orderBy:sortKey:reverse|filter:search|itemsPerPage: pageSize">
                                                <td>@{{data.FICHA_NO | uppercase }} </td>
                                                <td>@{{data.FICHA_ID | uppercase }} </td>
                                                <td>@{{data.VINCULADO_ACTUALMENTE | uppercase }} </td>
                                                <td>@{{data.FECHA_REGISTRO | uppercase }} </td>
                                                <td>@{{data.FECHA_RETIRO | uppercase }} </td>
                                                <td>@{{data.PROGRAMA | uppercase }} </td>
                                                <td>@{{data.MODALIDAD | uppercase }} </td>
                                                <td>@{{data.PUNTO_DE_ATENCION | uppercase }} </td>
                                                <td>@{{data.BARRIO_PUNTO_DE_ATENCION | uppercase }} </td>
                                                <td>@{{data.COMUNA_PUNTO_DE_ATENCION | uppercase }} </td>
                                                <td>@{{data.COMUNA_DE_IMPACTO | uppercase }} </td>
                                                <td>@{{data.ID_MONITOR | uppercase }} </td>
                                                <td>@{{data.MONITOR | uppercase }} </td>
                                                <td>@{{data.ASISTENCIAS_BENEFICIARIO | uppercase }} </td>
                                                <td>@{{data.CODIGO_GRUPO | uppercase }} </td>
                                                <td>@{{data.NIVEL_GRUPO | uppercase }} </td>
                                                <td>@{{data.GRUPO_ACTIVO | uppercase }} </td>
                                                <td>@{{data.ID_BENEFICIARIO | uppercase }} </td>
                                                <td>@{{data.PRIMER_NOMBRE | uppercase }} </td>
                                                <td>@{{data.SEGUNDO_NOMBRE | uppercase }} </td>
                                                <td>@{{data.PRIMER_APELLIDO | uppercase }} </td>
                                                <td>@{{data.SEGUNDO_APELLIDO | uppercase }} </td>
                                                <td>@{{data.DOCUMENTO | uppercase }} </td>
                                                <td>@{{data.NUM_DOC | uppercase }} </td>
                                                <td>@{{data.SEXO | uppercase }} </td>
                                                <td>@{{data.FECHA_NAC | uppercase }} </td>
                                                <td>@{{data.EDAD | uppercase }} </td>
                                                <td>@{{data.TELEFONO | uppercase }} </td>
                                                <td>@{{data.CORREO_ELECTRONICO | uppercase }} </td>
                                                <td>@{{data.PAIS | uppercase }} </td>
                                                <td>@{{data.DEPARTAMENTO | uppercase }} </td>
                                                <td>@{{data.MUNICIPIO | uppercase }} </td>
                                                <td>@{{data.DIRECCION | uppercase }} </td>
                                                <td>@{{data.ESTRATO | uppercase }} </td>
                                                <td>@{{data.BARRIO | uppercase }} </td>
                                                <td>@{{data.COMUNA_RESIDENCIA | uppercase }} </td>
                                                <td>@{{data.CORREGIMIENTO | uppercase }} </td>
                                                <td>@{{data.VEREDA | uppercase }} </td>
                                                <td>@{{data.OCUPACION | uppercase }} </td>
                                                <td>@{{data.ESCOLARIDAD | uppercase }} </td>
                                                <td>@{{data.ESTADO_ESCOLARIDAD | uppercase }} </td>
                                                <td>@{{data.AUTORECONOCE | uppercase }} </td>
                                                <td>@{{data.DISCAPACIDAD | uppercase }} </td>
                                                <td>@{{data.TIPO_DISCAPACIDAD | uppercase }} </td>
                                                <td>@{{data.INDIGENA | uppercase }} </td>
                                                <td>@{{data.AFRODESCENDIENTE | uppercase }} </td>
                                                <td>@{{data.VICTIMA_DEL_CONFLICTO | uppercase }} </td>
                                                <td>@{{data.ADULTO_MAYOR | uppercase }} </td>
                                                <td>@{{data.LGBTI | uppercase }} </td>
                                                <td>@{{data.GRUPO_MUJERES | uppercase }} </td>
                                                <td>@{{data.GRUPO_JOVENES | uppercase }} </td>
                                                <td>@{{data.JAC | uppercase }} </td>
                                                <td>@{{data.JAL | uppercase }} </td>
                                                <td>@{{data.OTRO_CUAL | uppercase }} </td>
                                                <td>@{{data.PRIMER_NOMBRE_ACUDIENTE | uppercase }} </td>
                                                <td>@{{data.SEGUNDO_NOMBRE_ACUDIENTE | uppercase }} </td>
                                                <td>@{{data.PRIMER_APELLIDO_ACUDIENTE | uppercase }} </td>
                                                <td>@{{data.SEGUNDO_APELLIDO_ACUDIENTE | uppercase }} </td>
                                                <td>@{{data.DOCUMENTO_ACUDIENTE | uppercase }} </td>
                                                <td>@{{data.NUM_DOC_ACUDIENTE | uppercase }} </td>
                                                <td>@{{data.SEXO_ACUDIENTE | uppercase }} </td>
                                                <td>@{{data.FECHA_NAC_ACUDIENTE | uppercase }} </td>
                                                <td>@{{data.EDAD_ACUDIENTE | uppercase }} </td>
                                                <td>@{{data.TELEFONO_ACUDIENTE | uppercase }} </td>
                                                <td>@{{data.CORREO_ACUDIENTE | uppercase }} </td>
                                                <td>@{{data.PARENTESCO | uppercase }} </td>
                                                <td>@{{data.PARENTESCO_OTRO | uppercase }} </td>
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

                        