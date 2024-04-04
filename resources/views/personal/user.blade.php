@extends('angular.frontend.master')
@section('title', 'Registro de personal')
@section('content')
<?php
	$v = '?v=' . date('YmdHis');
	?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script type="text/javascript" src="js/functions.js<?= $v; ?>"></script>
<script>$(function(){$("#empleado_form").validate();})</script>
<script type="text/javascript" src="js/GeneratorAdd.js"></script>
<script type="text/javascript" src="js/municipios_change.js<?= $v; ?>"></script>
<script type="text/javascript" src="js/empleado.registro.js<?= $v; ?>"></script>
<style>
	input[type=number]::-webkit-inner-spin-button, 
	input[type=number]::-webkit-outer-spin-button { 
	-webkit-appearance: none; 
	margin: 0; 
	}
	input[type=number] { -moz-appearance:textfield; }
	input{text-transform: uppercase;}
	.dir_format{
	width: 100%;
	}
	.row{
	padding-top: 10px;
	}
	.panel.panel-primary > .panel-heading {
	color: #FFFFFF;
	background: #039BE5;
	border-color: #039BE5 !important;
	}
	.panel.panel-primary {
	border-color: #039BE5;
	}
</style>
<script>
	var max_monitor = {{$max_monitor}};
	var max_metodologo = {{$max_metodologo}};
	var PoseePermisos = {{$asignar_permisos}};
</script>
<div class="container">
	<ul id="tableactiondTab" class="nav nav-tabs">
		<li class="active"><a href="#table-table-tab" data-toggle="tab">Registro del personal<strong></strong></a></li>
	</ul>
	<div id="tableactionTabContent" class="tab-content">
		<div id="log"></div>
		<form id="empleado_form">
			<fieldset>
				<legend>Datos básicos</legend>
				<div class="row">
					<div class="col-md-6">
						<input value="{{$id}}" type="hidden" id="persona_id_persona" name="persona[id_persona]"/>
						<input value="<?= ($nuevo); ?>" type="hidden" id="persona_nuevo" name="persona[nuevo]"/>
						<label class="control-label" for="empleado-tipo_doc">*Tipo documento</label>
						<select id="persona_id_documento_tipo" title="Tiene que seleccionar un tipo de documento" required="required" class="form-control" name="persona[id_documento_tipo]">
							<option value="">Seleccione</option>
							@foreach($tipo_documento as $temp)
							<option value="{{$temp->id}}">{{$temp->descripcion}}</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-6">
						<label class="control-label" for="empleado-documento">Documento</label>
						<div class="input-group">
							<input value="{{$documento}}" type="text" onchange="change_documento()" id="persona_documento" class="only_number form-control" name="persona[documento]">
							<span class="input-group-btn">
							<button onclick="change_documento()" class="btn btn-default" type="button"><i class="glyphicon glyphicon-search"></i></button>
							</span>
						</div>
					</div>
				</div>
			</fieldset>
			<fieldset id="other">
				<legend>Mas datos</legend>
				<div class="row">
					<div class="col-md-6">
						<label class="control-label" for="empleado-tipo_doc">*Rol</label>
						<select id="persona_id_rol" required="required" class="form-control" name="persona[id_rol]" style="text-transform:uppercase">
							<option value="">Seleccione</option>
							@foreach($roles as $temp)
							<option value="{{$temp->id}}">{{$temp->name}}</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-6">
						<label class="control-label" for="empleado-tipo_doc">*Presupuesto</label>
						<select id="ficha_id_presupuesto" required="required" class="form-control" name="ficha[id_presupuesto]">
							<option value="">Seleccione</option>
							@foreach($presupuesto as $temp)
							<option value="{{$temp->id}}">{{$temp->descripcion}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<label class="control-label" for="empleado-tipo_doc">*Estado del aspirante</label>
						<select id="ficha_id_estado_aspirante" required="required" class="form-control" name="ficha[id_estado_aspirante]">
							<option value="">Seleccione</option>
							@foreach($estado_aspirante as $temp)
							<option value="{{$temp->id}}">{{$temp->descripcion}}</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-4">
						<label class="control-label" for="empleado-tipo_doc">*Disponibilidad</label>
						<select id="ficha_id_disponibilidad" required="required" class="form-control" name="ficha[id_disponibilidad]">
							<option value="">Seleccione</option>
							@foreach($disponibilidad as $temp)
							<option value="{{$temp->id}}">{{$temp->descripcion}}</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-4">
						<label class="control-label" for="empleado-tipo_doc">*Cargo</label>
						<select id="ficha_id_cargo" required="required" class="form-control" name="ficha[id_cargo]">
							<option value="">Seleccione</option>
							@foreach($cargo as $temp)
							<option value="{{$temp->id}}">{{$temp->descripcion}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="row">
					<legend>Territorio de impacto</legend>
					@foreach($comunas as $temp)
					<div class="col-md-3">
						<label>
							<!--<input type="hidden" value="0" name="id_comuna_impacto[{{$temp->id}}][0]">-->
							<input type="checkbox" value="1" id="id_comuna_impacto{{$temp->id}}" class="comuna_impacto" name="id_comuna_impacto[{{$temp->id}}][1]">
							{{$temp->nombre_comuna}}
						</label>
					</div>
					@endforeach
				</div>
			</fieldset>
			<fieldset>
				<div class="row">
					<div class="col-md-6">
						<label class="control-label" for="empleado-nombres">*Primer nombre</label>
						<input value=""  type="text" id="persona_nombre_primero" class="form-control" name="persona[nombre_primero]" maxlength="60" required="required"/>
					</div>
					<div class="col-md-6">
						<label class="control-label" for="empleado-nombres">Segundo nombre</label>
						<input value=""  type="text" id="persona_nombre_segundo" class="form-control" name="persona[nombre_segundo]" maxlength="60" >
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<label class="control-label" for="empleado-apellidos">*Primer apellidos</label>
						<input value=""  type="text" id="persona_apellido_primero" class="form-control" name="persona[apellido_primero]" maxlength="60" required="required">
					</div>
					<div class="col-md-6">
						<label class="control-label" for="empleado-apellidos">Segundo apellidos</label>
						<input value=""  type="text" id="persona_apellido_segundo" class="form-control" name="persona[apellido_segundo]" maxlength="60" >
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<label class="control-label" for="empleado-persona_correo_electronico">Email</label>
						<input type="email" id="persona_correo_electronico" class="form-control" name="persona[correo_electronico]" maxlength="100">
					</div>
					<div class="col-md-3">
						<label class="control-label" for="empleado-sexo">Sexo</label>
						<select id="persona_sexo" class="form-control" name="persona[sexo]"  required="required">
							<option value="1">Hombre</option>
							<option value="2">Mujer</option>
						</select>
					</div>
					<div class="col-md-3">
						<label class="control-label" for="empleado-fecha_nacimiento">*Fecha Nacimiento</label>
						<input value=""  type="text" id="persona_fecha_nacimiento" name="persona[fecha_nacimiento]" class="fecha form form-control" required="required">
					</div>
				</div>
				<div class="row">
					<div class="panel">
						<div class="panel-heading">Datos de nacimiento</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-4">
									<label class="control-label" for="empleado-id_pais">*Pais de procedencia</label>
									<select id="persona_id_procedencia_pais" class="form-control" title="Debe seleccionar un pais" name="persona[id_procedencia_pais]" required="required">
										<option value="">Seleccione</option>
										@foreach($pais as $temp)
										@if ($temp->id=="1")
										<option value="{{$temp->id}}" selected>{{$temp->nombre_pais}}</option>
										@else
										<option value="{{$temp->id}}">{{$temp->nombre_pais}}</option>
										@endif
										@endforeach
									</select>
								</div>
								<div id="other_contry">
									<div class="col-md-4">
										<label class="control-label" for="empleado-id_departamento">Departamento</label>
										<select class="select2_create form form-control" id="persona_id_procedencia_departamento" name="persona[id_procedencia_departamento]">
											<option value="">Seleccione departamento</option>
											@foreach($departamento as $temp)
											@if ($temp->id=="76")
											<option value="{{$temp->id}}" selected>{{$temp->nombre_departamento}}</option>
											@else
											<option value="{{$temp->id}}">{{$temp->nombre_departamento}}</option>
											@endif
											@endforeach
										</select>
									</div>
									<div class="col-md-4">
										<label class="control-label" for="empleado-id_ciudad">*Ciudad</label>
										<select id="persona_id_procedencia_municipio" class="select2_create form-control" name="persona[id_procedencia_municipio]" required="required">
											<option value="">Seleccione</option>
											@foreach($municipio as $temp)
											@if ($temp->id=="131")
											<option value="{{$temp->id}}" selected>{{$temp->nombre}}</option>
											@else
											<option value="{{$temp->id}}">{{$temp->nombre}}</option>
											@endif
											@endforeach
										</select>
									</div>
								</div>
								<div id="show_contry">
									<div class="col-md-8">
										<label class="control-label" for="empleado-id_ciudad">Departamento/Ciudad</label>
										<input type="text" placeholder="Departamento/municipio" class="form form-control"/>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</fieldset>
			<fieldset>
				<legend>Residencia</legend>
				<div class="row">
					<div class="col-md-6">
						<label class="control-label" for="empleado-fecha_nacimiento">Corregimiento</label>
						<select id="persona_id_residencia_corregimiento" name="persona[id_residencia_corregimiento]" class="select2_create form form-control">
							<option value="">Seleccione</option>
							@foreach($corregimiento as $temp)
							<option value="{{$temp->id}}">{{$temp->descripcion}}</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-6">
						<label class="control-label" for="empleado-fecha_nacimiento">Veredas</label>
						<select id="ficha_id_vereda" name="ficha[id_vereda]" class="select2_create form form-control">
							<option value="">Seleccione</option>
							@foreach($veredas as $temp)
							<option value="{{$temp->id}}" data-comuna="" data-estrato="">{{$temp->nombre}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4" id="div_persona_id_residencia_barrio">
						<label class="control-label" for="empleado-barrio">Barrio</label>
						<select id="persona_id_residencia_barrio" class="select2_create form-control" name="persona[id_residencia_barrio]" >
							<option value="">Seleccionar barrio</option>
							@foreach($barrio as $temp)
							<option data-comuna="{{$temp->comuna_id}}" data-estrato="{{$temp->id_estrato}}" value="{{$temp->id}}">{{$temp->nombre_barrio}}</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-4">
						<label class="control-label" for="empleado-estrato">Estrato</label>
						<select id="persona_residencia_estrato" class="form-control" name="persona[residencia_estrato]">
							<option value="">Seleccione</option>
							<option value="1">Uno</option>
							<option value="2">Dos</option>
							<option value="3">Tres</option>
							<option value="4">Cuatro</option>
							<option value="5">Cinco</option>
							<option value="6">Seis</option>
						</select>
					</div>
					<div class="col-md-4">
						<label class="control-label" for="empleado-Comuna">Comuna</label>
						<input value=""  type="text" class="form form-control" name="comuna" id="comuna" readonly="true" style="background-color: #FFF;"/>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div id="modalIngresoDireccion" class="modal fade modal-change" role="dialog" aria-hidden="true" ></div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6" id="div_direccion">
						<label class="control-label" for="empleado-direccion">Direccion</label>
						<input value="" class="form-control" id="persona_residencia_direccion" placeholder="Direccion creada" name="persona[residencia_direccion]" readonly="true" style="background-color: #FFF;"/>
					</div>
					<div class="col-md-6" id="div_complemento">
						<label class="control-label" for="empleado-direccion">Complemento</label>
						<input value=""  class="form-control" id="persona_residencia_direccion_observacion" placeholder="Complemento de la direccion" name="persona[residencia_direccion_observacion]" readonly="true" style="background-color: #FFF;"/>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<label class="control-label" for="empleado-telefono">Telefono</label>
						<input value=""  min="0" type="number" id="persona_telefono_fijo" class="form-control" name="persona[telefono_fijo]" maxlength="45">
					</div>
					<div class="col-md-6">
						<label class="control-label" for="empleado-celular">Celular</label>
						<input value=""  min="0" type="number" id="persona_telefono_movil" class="form-control" name="persona[telefono_movil]" maxlength                        ="45" >
					</div>
				</div>
			</fieldset>
			<fieldset>
				<legend>Académicos</legend>
				<div class="row">
					<div class="col-md-6">
						<label class="control-label" for="empleado-nivel_formacion">*Nivel de escolaridad</label>
						<select id="ficha_id_escolaridad_nivel" class="form-control form" name="ficha[id_escolaridad_nivel]" required="required">
							<option value="">Seleccione</option>
							@foreach($escolaridad_nivel as $temp)
							<option value="{{$temp->id}}">{{$temp->descripcion}}</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-6">
						<label class="control-label" for="empleado-sit_prof_act">*Estado de escolaridad</label>
						<select id="ficha_id_estado_escolaridad" class="form-control" name="ficha[id_estado_escolaridad]" required="required">
							<option value="">Seleccione</option>
							@foreach($escolaridad_estado as $temp)
							<option value="{{$temp->id}}">{{$temp->descripcion}}                                                                      </option>
							@endforeach
						</select>
					</div>
					<div class="col-md-6">
						<label class="control-label" for="empleado-profesion">Título Obtenido : </label>
						<input value=""  type="text" id="ficha_profesion" class="form-control" name="ficha[profesion]" maxlength="100">
					</div>
					<div class="col-md-6">
						<label class="control-label" for="empleado-profesion">Universidad : </label>
						<input value=""  type="text" id="ficha_universidad" class="form-control" name="ficha[universidad]" maxlength="100">
					</div>
					<div class="col-md-6">
						<label class="control-label" for="empleado-sit_prof_act">Ocupación actual</label>
						<select id="ficha_id_ocupacion" class="form-control" name="ficha[id_ocupacion]">
							<option value="">Seleccione</option>
							@foreach($ocupacion as $temp)
							<option value="{{$temp->id}}">{{$temp->descripcion}}</option>
							@endforeach
						</select>
					</div>
				</div>
			</fieldset>
			<fieldset>
				<div class="panel">
				<div class="panel-heading">Familia</div>
				<div class="panel-body">
					<div class="col-md-6">
						<label class="control-label" for="empleado-estado_civil">Estado Civil</label>
						<select id="persona_id_estado_civil" class="form-control" name="persona[id_estado_civil]" required="required">
							<option value="">Seleccione</option>
							@foreach($estado_civil as $temp)
							<option value="{{$temp->id}}">{{$temp->descripcion}} (a)</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-6">
						<label class="control-label" for="empleado-tiene_hijos">Tiene Hijos</label>
						<select id="ficha_tiene_hijos" class="form-control" name="ficha[tiene_hijos]" required="required">
							<option value="0">No</option>
							<option value="1">Si</option>
						</select>
					</div>
					<div class="col-md-6">
						<label class="control-label" for="empleado-cuantos_hijos">¿Cuántos hijos?</label>
						<input value=""  type="number" min="0" id="ficha_cuantos_hijos" class="form-control" name="ficha[cuantos_hijos]">
					</div>
					<div class="col-md-6">
						<label class="control-label" for="empleado-identidad_cultural">*¿Se reconoce cómo?</label>
						<select id="ficha_id_etnia" class="form-control" name="ficha[id_etnia]"  required="required">
							<option value="">Seleccione</option>
							@foreach($etnia_si as $temp)
							<option value="{{$temp->id}}">{{$temp->descripcion}}</option>
							@endforeach
						</select>
					</div>
					<div class="row">
						<div class="panel">
							<div class="panel-heading">
							Grupo poblacional
							</div>
							<div class="panel body">
								@foreach($grupo_poblacional as $temp)
									<label class="col-md-3" style="text-transform: uppercase">
										<input type="hidden" name="grupo_poblacional[{{$temp->id}}]" value="0"/>
										<input type="checkbox" class="check_grupo_poblacional" id="id_grupo_poblacional_{{$temp->id}}" name="grupo_poblacional[{{$temp->id}}]" value="1">{{$temp->descripcion}}<br>
									</label>
								@endforeach
								<div class="col-md-3">
									<input value=""  type="" name="grupo_poblacional[][otro]" id="grupo_poblacional_otro" placeholder="Especifique el otro" class="form form-control"/>
								</div>
							</div>
						</div>
					</div>

				</div>
				</div>
			</fieldset>
			<fieldset>
				<legend>Salud</legend>
				<div class="row">
					<div class="container-fluid">
						<div class="col-md-6">
							<label class="control-label" for="empleado-padece_enfermedad">*¿Padece alguna enfermedad permanente que limite su actividad f&#237;sica?</label>
							<select id="ficha_padece_enfermedad" class="form-control" name="ficha[padece_enfermedad]" required="required">
								<option value="0">No</option>
								<option value="1">Si</option>
							</select>
						</div>
						<div class="col-md-6" id="div_enfermedad">
							<label id="label_ficha_enfermedad" class="control-label" for="empleado-enfermedad">Escriba la enfermedad</label>
							<input value=""  type="text" id="ficha_enfermedad" class="form-control" name="ficha[enfermedad]">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="container-fluid">
						<div class="col-md-6">
							<label class="control-label" for="empleado-toma_medicamentos">*Toma medicamentos</label>
							<select id="ficha_toma_medicamentos" class="form-control" name="ficha[toma_medicamentos]" required="required">
								<option value="0">No</option>
								<option value="1">Si</option>
							</select>
						</div>
						<div class="col-md-6">
							<label id="label_ficha_toma_medicamentos"  class="control-label" for="empleado-medicamentos">Mencione los medicamentos</label>
							<input value=""  type="text" id="ficha_medicamentos" class="form-control" name="ficha[medicamentos]">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="container-fluid">
						<div class="col-md-6">
							<label class="control-label" for="empleado-tipo_sangre">Tipo de sangre</label>
							<select id="persona_sangre_tipo" class="form-control" name="persona[sangre_tipo]" required="required">
								<option value="">Seleccione</option>
								<option value="O+">O+</option>
								<option value="O-">O-</option>
								<option value="A+">A+</option>
								<option value="A-">A-</option>
								<option value="B+">B+</option>
								<option value="B-">B-</option>
								<option value="AB+">AB+</option>
								<option value="AB-">AB-</option>
							</select>
						</div>
						<div class="col-md-6">
							<label class="control-label" for="empleado-tiene_discapacidad">*¿Tiene alguna condición de discapacidad?</label>
							<select id="ficha_tiene_discapacidad" class="form-control" name="ficha[tiene_discapacidad]"  required="required">
								<option value="0">No</option>
								<option value="1">Si</option>
							</select>
						</div>
						<hr/>
						<div class="row" id="posee_discapacidad">
							<div class="container-fluid">
								<div class="col-md-12">
									<div class="panel panel-primary">
										<div class="panel-heading">
											Discapacidades
										</div>
										<div class="panel-body">
											@foreach($discapacidad as $temp)
											<div class="col-md-4">
												<label style="text-transform: uppercase">
												<input type="hidden" name="discapacidad[{{$temp->id}}]" value="0"/>
												<input type="checkbox" id="id_discapacidad_{{$temp->id}}" name="discapacidad[{{$temp->id}}]" value="1">{{$temp->descripcion}}
												</label>
											</div>
											@endforeach
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<label class="control-label" for="empleado-afiliado_sgsss">*¿Se encuentra afiliado al sistema general de afiliación de salud?</label>
					<select id="ficha_afiliado_sgsss" class="form-control" name="ficha[afiliado_sgsss]"  required="required">
						<option value="1">Si</option>
						<option value="0">No</option>
					</select>
				</div>
				<div class="col-md-4">
					<label class="control-label" for="empleado-tipo_afiliacion">*Tipo afiliación</label>
					<select id="ficha_id_tipo_afiliacion" class="form-control" name="ficha[id_tipo_afiliacion]" required="required">
						<option value="">Seleccione</option>
						<option value="1">Regimen Contributivo (EPS)</option>
						<option value="2">Regimen Subsidiado (SISBEN-EPS-S)</option>
						<option value="3">Especial (FFMM, Policia, etc)</option>
					</select>
				</div>
				<div class="col-md-4">
					<label class="control-label" for="empleado-entidad_eps">*Entidad de salud o EPS</label>
					<select  id="ficha_id_eps" class="form form-control" name="ficha[id_eps]" required="required">
						<option value="">Seleccione</option>
						@foreach($eps as $temp)
						<option value="{{$temp->id}}" class="regimenes regimen_{{$temp->id_regimen}}">{{$temp->descripcion}}</option>
						@endforeach
					</select>
				</div>
			</fieldset>
			<fieldset>
				<legend>Varios</legend>
				<div class="col-md-6">
					<label class="control-label" for="empleado-libreta_militar">Libreta militar</label>
					<select id="ficha_libreta_militar" class="form-control" name="ficha[libreta_militar]">
						<option value="">Seleccione</option>
						<option value="1">Primera</option>
						<option value="2">Segunda</option>
					</select>
				</div>
				<div class="col-md-6">
					<div class="form-group field-empleado-no_libreta_militar">
						<label class="control-label" for="empleado-no_libreta_militar">Número libreta militar</label>
						<input value=""  type="text" id="ficha_no_libreta_militar" class="form-control" name="ficha[no_libreta_militar]">
					</div>
				</div>
				<div class="col-md-6">
					<label class="control-label" for="empleado-distrito_militar">Distrito militar</label>
					<input value=""  type="text" id="ficha_distrito_militar" class="form-control" name="ficha[distrito_militar]" >
				</div>
				<div class="col-md-6">
					<label class="control-label" for="empleado-skype">Skype</label>
					<input value=""  type="text" id="ficha_skype" class="form-control" name="ficha[skype]" maxlength="50" >
				</div>
				<div class="col-md-12">
					<label class="control-label" for="empleado-proyecto_profesional">Proyecto profesional</label>
					<textarea id="ficha_proyecto_profesional" class="form-control" name="ficha[proyecto_profesional]" rows="6"></textarea>
				</div>
			</fieldset>
			<fieldset>
				<legend>Disciplina (Opcional)</legend>
				<div class="row">
					@foreach($disciplinas as $temp)
					<div class="col-md-4">
						<label style="text-transform: uppercase">
						<input type="hidden" name="disciplina[{{$temp->id}}]" value="0">
						<input type="checkbox" id="id_disciplina_{{$temp->id}}" name="disciplina[{{$temp->id}}]" value="1">{{$temp->descripcion}}
						</label>
					</div>
					@endforeach
				</div>
			</fieldset>
			<fieldset>
				<fieldset>
					<div class="jumbotron">En cumplimiento de la ley estatutaria 1581 del 17 de octubre de 2012 "Por la cual se dictan disposiciones generales para la protección de datos personales", la Alcaldía de Santiago de Cali informa, que siendo responsable y encargada del tratamiento de los datos personales de los habitantes del municipio, estos serán utilizados únicamente en el desarrollo de las funciones propias y no se compartirán con nadie para fines diferentes. Esta información es y será utilizada para conocer más al ciudadano que se acerca a la Alcaldía de Santiago de Cali. Para mayor información consulte: <a href="https://goo.gl/VrJ7Bw">https://goo.gl/VrJ7Bw</a>
					</div>
				</fieldset>
			</fieldset>
			<fieldset>
				<button class="btn btn-primary">Guardar</button>
			</fieldset>
		</form>
	</div>
</div>
@stop