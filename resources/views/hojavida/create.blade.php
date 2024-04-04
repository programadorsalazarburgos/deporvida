<?php
function autoVer($url)
{
  $path = pathinfo($url);
  $ver = '?v='.filemtime($_SERVER['DOCUMENT_ROOT'].$url);
  return $path['dirname'].'/'.$path['basename'].$ver;
}
?>

@extends('angular.frontend.master')
@section('title', 'Registro de personal')
@section('content')
<?php
	$v = '?v=' . date('YmdHis');
	?>
<style type="text/css">
	.fileinput-upload-button {
	display: none;
	}
	.fileinput-remove {
	display: none;}
	.file-upload-indicator {
	display: none;
	}
	hr{color: #f00;
	background-color: #f00;
	height: 5px;}
	.file-preview-image{
	font: 20px Impact,Charcoal,sans-serif !important;
	color: #c3c3c3 !important;
	}
	.adjuntos th, .adjuntos th:hover {
	padding-top: 11px;
	padding-bottom: 11px;
	background-color: #4CAF50 !important;
	color: white;
	}
	[class^="icon-"], [class*=" icon-"] {
	display: inline-block;
	width: 14px;
	height: 14px;
	line-height: 14px;
	vertical-align: text-top;
	background-image: url(../img/glyphicons-halflings.png);
	background-position: 14px 14px;
	background-repeat: no-repeat;
	}
	.icon-arrow-right {
	background-position: -264px -96px;
	}
	.icon-arrow-left {
	background-position: -240px -96px;
	}
	[class^="icon-"]:last-child, [class*=" icon-"]:last-child {
	}
	.file-caption.form-control.kv-fileinput-caption.icon-visible {
	height: 34px !important;
	vertical-align: text-top;
	background-image: url(../img/glyphicons-halflings.png);
	background-position: 11px 32px;
	background-repeat: no-repeat;
	}
</style>
<script type="text/javascript" src="{{url('')}}/js/GeneratorAdd.js"></script>
<script type="text/javascript" src="{{url('')}}/js/sortable.min.js"></script>
<script type="text/javascript" src="{{url('')}}/js/purify.min.js"></script>
<script type="text/javascript" src="{{url('')}}/bootstrap-fileinput/js/fileinput.min.js"></script>
<script type="text/javascript" src="{{url('')}}/bootstrap-fileinput/js/locales/es.js"></script>
<script type="text/javascript" src="{{url('')}}/js/jquery-ui.js"></script>
<script src="<?php echo autoVer('/js/perfil.js'); ?>"></script>

<!-- <script type="text/javascript" src="{{url('')}}/js/perfil.js{{$v}}"></script> -->
<!-- <script src="{{ mix('jswebpack/perfil.js') }}"></script>
 -->
<link rel="stylesheet" type="text/css" href="css/datepicker.css">
<link rel="stylesheet" type="text/css" href="{{url('')}}/bootstrap-fileinput/css/fileinput.min.css">
<div class="container">
	<ul id="tableactiondTab" class="nav nav-tabs">
		<li class="active"><a href="#table-table-tab" data-toggle="tab">Registro del personal<strong></strong></a></li>
	</ul>
	<div id="tableactionTabContent" class="tab-content">
		<!-- Experiencia Profesional -->
		<div style="display: none">
			<div id="data_experiencia_profesional">
				<div class="row" id="form_data_experiencia_profesional_{new_experiencia_profesional}">
					<div class="container-fluid">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<button class="btn btn-danger" type="button" onclick="deleteform('{new_experiencia_profesional}','data_experiencia_profesional','form_data_experiencia_profesional_{new_experiencia_profesional}')" ><i class="glyphicon glyphicon-trash"></i></button> Registrar empresa
							</div>
							<div class="panel-body">
								<div class="row">
									<div class="col-md-6">
										<label>*Empresa o Entidad</label>
										<input title="El nombre de la empresa es obligatorio" type="text" id="empresa_nombre_{new_experiencia_profesional}" name="experiencia[{new_experiencia_profesional}][empresa_nombre]" class="form form-control" required="true">
									</div>
									<div class="col-md-6">
										<input type="hidden" name="experiencia[{new_experiencia_profesional}][id]" id="id_{new_experiencia_profesional}">
										<label>*Nombre jefe inmediato</label>
										<input tile="El nombre del jefe es obligatorio" type="text" id="empresa_jefe_nombre_{new_experiencia_profesional}" name="experiencia[{new_experiencia_profesional}][empresa_jefe_nombre]" class="form form-control" required="true">
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<label>Dirección </label>
										<input type="text" id="experiencia_direccion_{new_experiencia_profesional}" name="experiencia[{new_experiencia_profesional}][empresa_direccion]"  class="form form-control">
									</div>
									<div class="col-md-6">
										<label>Teléfono</label>
										<input type="number" id="empresa_telefono_{new_experiencia_profesional}" name="experiencia[{new_experiencia_profesional}][empresa_telefono]"  class="only_number form form-control">
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<label>*Cargo</label>
										<input type="text" id="empresa_cargo_{new_experiencia_profesional}" name="experiencia[{new_experiencia_profesional}][empresa_cargo]"  class="form form-control" required="true">
									</div>
									<div class="col-md-6">
										<label>Correo de la empresa</label>
										<input type="email" id="empresa_correo_{new_experiencia_profesional}" name="experiencia[{new_experiencia_profesional}][empresa_correo]"  class="form form-control">
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<label>Fecha de Ingreso</label>
										<input type="text" id="empresa_fecha_ingreso_{new_experiencia_profesional}" name="experiencia[{new_experiencia_profesional}][empresa_fecha_ingreso]"  class="fecha_{new_experiencia_profesional} form form-control">
									</div>
									<div class="col-md-6">
										<label>Fecha de Retiro</label>
										<input type="text" id="empresa_fecha_retiro_{new_experiencia_profesional}" name="experiencia[{new_experiencia_profesional}][empresa_fecha_retiro]"  class="fecha_{new_experiencia_profesional} form form-control">
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<label>Tipo de expreriencia ( administrativa / deportiva / psicosocial / otras)</label>
										<select id="empresa_experiencia_tipo_{new_experiencia_profesional}" name="experiencia[{new_experiencia_profesional}][empresa_experiencia_tipo]"  class="form form-control">
											<option value="">Seleccione</option>
											@foreach($experiencia_tipo as $temp)
											<option value="{{$temp->descripcion}}">{{$temp->descripcion}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<label>Documentos</label>
										<div id="documentos_experiencia_{new_experiencia_profesional}">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<label>Adjuntar documentos</label>
										<div class="file-loading">
											<input id="file-{new_experiencia_profesional}"
												name="experiencia[empresa_documentos][{new_experiencia_profesional}][]"
												type="file" required="required" multiple>
										</div>
										<div id="list-file-{new_experiencia_profesional}">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Experiencia Profesional -->
		<!-- FORMACIÓN ACADÉMICA -->
		<div style="display:none">
			<div id="data_estudios">
				<div class="row" id="form_data_estudios_{new_studio}">
					<div class="container-fluid">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<button class="btn btn-danger" type="button" onclick="deleteform('{new_studio}','data_estudios','form_data_estudios_{new_studio}')" ><i class="glyphicon glyphicon-trash"></i></button> Nuevo estudio profesional
							</div>
							<div class="panel-body">
								<div class="row">
                                    <div class="col-md-6">
                                        <input type="hidden" id="id_{new_studio}" name="estudios[{new_studio}][id]">
                                        <label>*Estado actual</label>
                                        <select title="seleccione el estado de su estudio" required="required" class="estado_estudio form form-control" data-id="{new_studio}" name="estudios[{new_studio}][estado_estudio]" id="estado_{new_studio}">
                                            <option value="">Seleccione</option>
                                            <option value="Graduado">Graduado</option>
                                            <option value="Estudiante">Estudiante</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Institucion educativa</label>
                                        <input title="Ingrese el nombre de su institución educativa" required="required" type="text" class="form form-control" id="name_institucion_educativa_{new_studio}" name="estudios[{new_studio}][institucion_educativo]">
                                    </div>
                                </div>
								<div class="row">
                                    <div class="col-md-6">
                                        <i class="">* </i><label>Carrera / programa académico</label>
                                        <select  class="form form-control" id="carrera_{new_studio}" name="estudios[{new_studio}][carrera]" required="true">
                                            <option value="">Seleccione</option>
                                            @foreach($titulos as $temp)
                                            <option value="{{$temp->id}}">{{$temp->descripcion}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Nivel educativo</label>
                                        <select class="form form-control" id="nivel_escolaridad_{new_studio}" name="estudios[{new_studio}][nivel_educativo]">
                                            @foreach($nivel_educativo as $temp)
                                            <option value="{{$temp->id}}">{{$temp->descripcion}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
								<div class="row">
                                    <div class="col-md-4 graduado_{new_studio}" id="fecha_grado_{new_studio}">
                                        <label>Fecha de grado</label>
                                        <input type="text" id="fecha_graduado_{new_studio}" class="fecha_{new_studio} form form-control" name="estudios[{new_studio}][fecha_grado]">
                                    </div>
                                    <div class="col-md-4 graduado_{new_studio}" id="pais_titulo_{new_studio}">
                                        <label>Pais titulo</label>
                                        <select id="id_pais_{new_studio}" class=" form form-control" name="estudios[{new_studio}][pais_grado]">
                                            @foreach($paises as $temp)
                                            <option value="{{$temp->id}}">{{$temp->nombre_pais}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 graduado_{new_studio}" id="tarjeta_profesional_{new_studio}">
                                        <label>Numero de tarjeta profesional</label>
                                        <input type="text" class=" form form-control" id="number_tarjeta_profesional_{new_studio}" name="estudios[{new_studio}][tarjeta_profesional]">
                                    </div>
                                </div>
								<!-- ESTUDIANTES Y GRADUADOS -->
								<div class="col-md-6 estudiante_{new_studio}" id="estado_{new_studio}">
									<label>Estado</label>
									<select class="form form-control" id="estado_estudio_{new_studio}" name="estudios[{new_studio}][estudio_estado]">
										<option value="matriculado">Matriculado</option>
										<option value="Suspendido">Suspendido</option>
									</select>
								</div>
								<div class="col-md-6 estudiante_{new_studio}">
									<label>Semestres aprobados</label>
									<select class="form form-control" id="semestres_{new_studio}" name="estudios[{new_studio}][semestre]">
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<option value="8">8</option>
										<option value="9">9</option>
										<option value="10">10</option>
										<option value="tesis">En proyecto de grado</option>
										<option value="pasantia">En pasantia</option>
									</select>
								</div>
								<div class="col-md-12 estudiante_{new_studio}" id="horario_clases_{new_studio}">
									<label>Horario de clases</label>
									<textarea class="form form-control" id="horario_clases_{new_studio}" name="estudios[{new_studio}][horario_clases]"></textarea>
								</div>
								<div class="col-md-12">
									<div id="list-file-{new_studio}"></div>
								</div>
								<div class="col-md-12">
									<label>Adjuntar documentos</label>
									<div class="file-loading"> <input id="file-{new_studio}" name="estudios[documentos][{new_studio}][]"  required="required" type="file" multiple="multiple"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="experiencia_profesional">
			</div>
		</div>
		<!-- FORMACIÓN ACADÉMICA -->
		<!-- ESTUDIOS NO FORMALES -->
		<div style="display:none">
			<div id="data_estudios_no_formales">
				<div class="row" id="form_data_estudios_no_formales_{new_estudio_no_formal}">
					<div class="container-fluid">
						<div class="panel panel-primary">
							<div class="panel-heading"><button type="button" onclick="deleteform('{new_estudio_no_formal}','data_estudios_no_formales','form_data_estudios_no_formales_{new_estudio_no_formal}')" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>Nuevo curso, diplomado, o serminario</div>
							<div class="panel-body">
								<div class="row">
                                    <div class="col-md-6">
                                        <label>*Titulo</label>
                                        <input type="hidden" id="id_{new_estudio_no_formal}" name="cursos[{new_estudio_no_formal}][id]">
                                        <input title="Debe ingresar el título obtenido" required="required" id="titulo_{new_estudio_no_formal}" class="form form-control" name="cursos[{new_estudio_no_formal}][titulo]">
                                    </div>
                                    <div class="col-md-6">
                                        <label>*Institución</label>
                                        <input title="Ingrese el nombre de la institución" type="text" required="required" class="form form-control" id="cursos_institucion_educativo_{new_estudio_no_formal}" name="cursos[{new_estudio_no_formal}][institucion_educativo]">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>*Tipo de curso</label>
                                        <select title="Ingrese el tipo de curso" required="required" id="curso_tipo_{new_estudio_no_formal}" class="form form-control" name="cursos[{new_estudio_no_formal}][curso_tipo]">
                                            <option value="">Seleccione</option>
                                            <option value="Curso">Curso</option>
                                            <option value="Seminario">Seminario</option>
                                            <option value="Diplomado">Diplomado</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>*Horas cursadas</label>
                                        <input title="Ingrese el numero de horas aprobadas" id="horas_{new_estudio_no_formal}" required="required" type="number" class="form form-control" name="cursos[{new_estudio_no_formal}][horas]">
                                    </div>
                                </div>
                                <div class="row">
								    <div id="list-file-{new_estudio_no_formal}"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Adjuntar documentos</label>
                                        <div class="file-loading"> <input id="file-{new_estudio_no_formal}"
                                            name="cursos[documentos][{new_estudio_no_formal}][]" type="file"  multiple></div>
                                    </div>
                                </div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- ESTUDIOS NO FORMALES -->
		<form id="empleado_form" enctype='multipart/form-data'>
			<fieldset>
				<legend>
					<button class="btn btn-primary" id="nuevo_estudio" type="button"><i class="fa fa-address-card"></i> Agregar estudio</button> Estudios academicos
				</legend>
				<div id="new_estudio">
				</div>
				<legend>
					<button class="btn btn-primary" id="nuevo_estudio_no_formal" type="button"><i class="fa fa-address-card"></i> Agregar estudio</button> Estudios no formales
				</legend>
				<div id="new_estudio_no_formal"></div>
				<legend>
					<button class="btn btn-primary" id="nueva_experiencia_profesional" type="button"><i class="fa fa-address-card"></i> Agregar experiencia</button> Experiencia laboral
				</legend>
				<div id="new_experiencia_profesional"></div>
				<div class="row">
					<div class="container-fluid">
						<legend>Estudios de idiomas</legend>
						<div class="col-md-12">
							<label>Ingrese los idiomas que ha estudiado</label>
							<select id="idiomas" name="idiomas[]" class="js-example-responsive form form-control" multiple="multiple">
								@foreach($idiomas as $temp)
								<option value="{{$temp->id}}">{{$temp->descripcion}}</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="container-fluid">
						<legend>Adjuntar Documento de identidad</legend>
						<div class="col-md-12">
							<label>Adjuntar documentos</label>
							<div class="file-loading">
								<input id="file-other" name="other[]"  required="required" type="file" multiple="multiple" required="required"/>
							</div>
						</div>
						<div id="list-file-other">
						</div>
					</div>
				</div>
			</fieldset>
			<br/>
			<br/>
			<br/>
			<button id="save" class="btn btn-danger"><i class="fa fa-floppy-o"></i> Guardar</button>
		</form>
	</div>
</div>
@stop