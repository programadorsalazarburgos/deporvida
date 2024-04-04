@extends('angular.frontend.master')
@section('title', 'Grupos')
@section('content')
<?php $v ='';// '?v=' . date('YmdHis'); ?>
<script type="text/javascript" src="js/functions.js?v=<?= date('YmdHis'); ?>"></script>
<script src="js/GeneratorAdd.js<?= $v ?>" type="text/javascript"></script>
<script src="js/ficha.registro2.js<?= $v ?>" type="text/javascript"></script>
<style>
	input{
		background-color:#FFF !important;
        cursor: pointer !important;
	}
    input{text-transform: uppercase;}
    .dir_format{
        width: 100%;
    }
    .row{
        padding-top: 10px;
    }
    input[type=number]::-webkit-inner-spin-button, 
    input[type=number]::-webkit-outer-spin-button { 
        -webkit-appearance: none; 
        margin: 0; 
    }

    input[type=number] { -moz-appearance:textfield; }
</style>
<div class="container">
    <ul id="tableactiondTab" class="nav nav-tabs">
        <li class="active"><a href="#table-table-tab" data-toggle="tab">Registro del beneficiario a la disciplina <strong>{{$disciplina}}</strong></a></li>
    </ul>
    <div id="tableactionTabContent" class="tab-content">
        <form id="form_ficha" method="post">
            <fieldset>
                <legend>Datos básicos</legend>
                <div class="col-md-6">
                    <label class="control-label" for="empleado-tipo_doc">Tipo documento</label>
                    <input required="required" class="form-control">
                        
                    
                </div>

                <div class="col-md-6">
                    <label class="control-label" for="empleado-documento">Documento</label>
                    <input type="text" id="persona_documento" class="only_number form-control" name="id_persona_beneficiario[documento]" required="required">
                </div>
            </fieldset>
            <fieldset>
                <div class="col-md-6">
                    <label class="control-label" for="empleado-nombres">Primer nombre</label>
                    <input value=""  type="text" title="Solo texto" id="id_persona_beneficiario_nombre_primero" class="form-control" name="id_persona_beneficiario[nombre_primero]" maxlength="60" required="required"/>
                </div>              
                <div class="col-md-6">
                    <label class="control-label" for="empleado-nombres">Segundo nombre</label>
                    <input value=""  type="text" title="Solo texto" id="id_persona_beneficiario_nombre_segundo" class="form-control" name="id_persona_beneficiario[nombre_segundo]" maxlength="60" >
                </div>
                <div class="col-md-6">
                    <label class="control-label" for="empleado-apellidos">Primer apellidos</label>
                    <input value=""  type="text" title="Solo texto" id="id_persona_beneficiario_apellido_primero" class="form-control" name="id_persona_beneficiario[apellido_primero]" maxlength="60" required="required">
                </div>
                <div class="col-md-6">

                    <label class="control-label" for="empleado-apellidos">Segundo apellidos</label>
                    <input value=""  type="text" title="Solo texto" id="id_persona_beneficiario_apellido_segundo" class="form-control" name="id_persona_beneficiario[apellido_segundo]" maxlength="60" >
                </div>

                <div class="col-md-6">
                    <label class="control-label" for="empleado-email">Email</label>
                    <input value=""  type="email" id="id_persona_beneficiario_correo_electronico" class="form-control" name="id_persona_beneficiario[correo_electronico]" maxlength="100">
                </div>
                <div class="col-md-3">
                    <label class="control-label" for="empleado-sexo">Sexo</label>
                    <input readonly="readonly" id="id_persona_beneficiario_sexo" class="form-control" name="id_persona_beneficiario[sexo]"  required="required">
                        <option value="">Seleccione</option>
                        <option value="1">Hombre</option>
                        <option value="2">Mujer</option>
                    
                </div>
                <div class="col-md-3">
                    <label class="control-label" for="empleado-fecha_nacimiento">Fecha Nacimiento</label>
                    <div class="input-group">
                        <input type="text" id="id_persona_beneficiario_fecha_nacimiento" name="id_persona_beneficiario[fecha_nacimiento]" class="fecha form form-control" required="required">
                        <span class="input-group-addon" id="id_persona_beneficiario_edad">

                        </span>
                    </div>
                </div>

                <div class="panel">
                    <div class="panel-heading">Datos de nacimiento</div>
                    <div class="panel-body">
                        <div class="container-fluid">
                            <div class="col-md-4">
                                <label class="control-label" for="empleado-id_pais">Pais de procedencia</label>
                                <input readonly="readonly" id="id_persona_beneficiario_id_procedencia_pais" class="form-control" name="id_persona_beneficiario[id_procedencia_pais]" required="required">
                                    <option value="">Seleccione</option>
                                    
                            </div>
                            <div id="other_contry">
                                <div class="col-md-4">
                                    <label class="control-label" for="empleado-id_departamento">Departamento</label>
                                    <input readonly="readonly" class="select2_create form form-control" id="id_persona_beneficiario_id_procedencia_departamento" name="id_persona_beneficiario[id_procedencia_departamento]">
                                        <option value="">Seleccione departamento</option>
                                    
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label" for="empleado-id_ciudad">Ciudad</label>
                                    <input readonly="true" id="id_persona_beneficiario_id_procedencia_municipio" class="select2_create form-control" name="id_persona_beneficiario[id_procedencia_municipio]" required="required" value="{{$nombre_municipio}}" />
                                </div>
                            </div>

                            <div id="show_contry">
                                <div class="col-md-8">
                                    <label class="control-label" for="empleado-id_ciudad">Departamento/Ciudad</label>
                                    <input type="text" name="id_persona_beneficiario[other_municipio_nombre]" id="id_persona_beneficiario_other_municipio_nombre" placeholder="Departamento/municipio" class="form form-control"/>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </fieldset>
            <fieldset>
                <legend>Residencia</legend>
                <div class="col-md-6">
                    <label class="control-label" for="empleado-fecha_nacimiento">Corregimiento</label>
                    <input readonly="readonly" class="form form-control" id="id_persona_beneficiario_id_residencia_corregimiento" name="id_persona_beneficiario[id_residencia_corregimiento]">
                </div>
                <div class="col-md-6">
                    <label class="control-label" for="empleado-fecha_nacimiento">Veredas</label>
                    <input readonly="readonly" class="form form-control" id="id_persona_beneficiario_id_residencia_vereda" name="id_persona_beneficiario[id_residencia_vereda]">
                </div>
                <div id="direcciones_rurales">
                    <div class="col-md-4" id="div_persona_id_residencia_barrio">
                        <label class="control-label" for="empleado-barrio">Barrio</label>
                        <input readonly="readonly" class="form form-control select2_create" id="id_persona_beneficiario_id_residencia_barrio" name="id_persona_beneficiario[id_residencia_barrio]">

                    </div>           

                    <div class="col-md-4">
                        <label class="control-label" for="empleado-estrato">Estrato</label>
                        <input readonly="readonly" id="id_persona_beneficiario_residencia_estrato" class="form-control" name="id_persona_beneficiario[residencia_estrato]">
                    </div>
                    <div class="col-md-4">
                        <label class="control-label" for="empleado-Comuna">Comuna</label><br>
                        <span id="numero_comuna"></span>
                    </div>

                    <div class="col-md-12">
                        <div id="modalIngresoDireccion" class="modal fade modal-change" role="dialog" aria-hidden="true" ></div>
                    </div>

                    <div class="col-md-6" id="div_direccion">
                        <label class="control-label" for="empleado-direccion">Direccion</label>

                        <input value="" class="form-control" id="id_persona_beneficiario_residencia_direccion" placeholder="Direccion creada" name="id_persona_beneficiario[residencia_direccion]" readonly="true" style="background-color: #FFF;"/>
                    </div>

                </div>
                <div class="col-md-6" id="div_complemento">
                    <label class="control-label" for="empleado-direccion">Complemento</label>
                    <input value=""  class="form-control" id="id_persona_beneficiario_residencia_direccion_observacion" placeholder="Complemento de la direccion" name="id_persona_beneficiario[residencia_direccion_observacion]" readonly="true" style="background-color: #FFF;"/>
                </div>
                <div class="col-md-6">
                    <label class="control-label" for="empleado-telefono">Telefono</label>
                    <input value=""  min="0" type="number" id="id_persona_beneficiario_telefono_fijo" class="form-control" name="id_persona_beneficiario[telefono_fijo]" maxlength="45">
                </div>
                <div class="col-md-6">
                    <label class="control-label" for="empleado-celular">Celular</label>
                    <input value=""  min="0" type="number" id="id_persona_beneficiario_telefono_movil" class="form-control" name="id_persona_beneficiario[telefono_movil]" maxlength                        ="45" >
                </div>
            </fieldset>
            <fieldset>
                <legend>Académicos</legend>
                <div class="row">
                    <div class="col-md-6">
                        <label class="control-label" for="empleado-nivel_formacion">Nivel de escolaridad</label>
                        <input readonly="readonly" id="ficha_id_escolaridad_nivel" class="form-control form" name="ficha[id_escolaridad_nivel]" required="required">                       
                    </div>
                    <div class="col-md-6">
                        <label class="control-label" for="empleado-sit_prof_act">Estado de escolaridad</label>
                        <input readonly="readonly" id="ficha_id_estado_escolaridad" class="form-control" name="ficha[id_escolaridad_estado]" required="required">                        
                    </div>
                    <div class="col-md-6">
                        <label class="control-label" for="empleado-sit_prof_act">Ocupación actual</label>
                        <input readonly="readonly" id="ficha_id_ocupacion" class="form-control" name="ficha[id_ocupacion]" required="required">                        
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <div class="panel">
                    <div class="panel-heading">
                        ¿Se reconoce cómo?                    
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <input readonly="readonly" id="ficha_id_etnia" class="form-control" name="ficha[id_etnia]"  required="required">
                        </div>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <div class="row">
                    <legend>Grupo poblacional</legend>
                    <div class="col-md-3">
                        <input value=""  type="" name="grupo_poblacional[][otro]" id="grupo_poblacional_otro" placeholder="Especifique el otro" class="form form-control"/>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <div class="panel">
                    <div class="panel-heading">
                        Padre de familia, acudiente o cuidador
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Tipo de documento</label>
                                <input readonly="readonly" class="form form-control" required="required" id="id_documento_tipo" name="id_persona_acudiente[id_documento_tipo]">
                                    <option value="1">Cédula de ciudadanía</option>
                                    <option value="2">Registro civil</option>
                                    <option value="3">Tarjeta de identidad</option>
                                    <option value="4">Cédula de extrangería</option>
                                    <option value="5">Pasaporte</option>
                                    <option value="6">Sin información</option>
                                    <option value="7">NIT</option>
                                
                            </div>
                            <div class="col-md-6">
                                <label>Documento</label>
                                <input type="text" min="1" class="form form-control" required="required" id="id_persona_acudiente_documento" name="id_persona_acudiente[documento]" style="text-align: right;">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Primer Nombre</label>
                                <input type="text" class="form form-control" required="required" id="id_persona_acudiente_nombre_primero" name="id_persona_acudiente[nombre_primero]">
                            </div>
                            <div class="col-md-6">
                                <label>Segundo Nombre</label>
                                <input type="text" class="form form-control" id="id_persona_acudiente_nombre_segundo" name="id_persona_acudiente[nombre_segundo]">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Primer apellido</label>
                                <input type="text" class="form form-control" required="required" id="id_persona_acudiente_apellido_primero" name="id_persona_acudiente[apellido_primero]">
                            </div>
                            <div class="col-md-6">
                                <label>Segundo apellido</label>
                                <input type="text" class="form form-control" id="id_persona_acudiente_apellido_segundo" name="id_persona_acudiente[apellido_segundo]">
                            </div>
                        </div>
                        <div id="group_beneficiario_fecha_nacimiento">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Fecha nacimiento</label>
                                    <input class="fecha form form-control" type="text" id="id_persona_acudiente_fecha_nacimiento" name="id_persona_acudiente[fecha_nacimiento]">
                                </div>
                                <label class="col-md-2 control-label">Edad <span id="id_persona_acudiente_edad">0</span> años</label>
                                <div id="group_beneficiario_sexo">
                                    <div class="col-md-5">
                                        <label class="control-label" for="empleado-sexo">Genero</label>
                                        <input readonly="readonly" id="id_persona_beneficiario_sexo" class="form-control" name="id_persona_acudiente[sexo]"  required="required">
                                            <option value="1">Masculino</option>
                                            <option value="2">Femenino</option>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Telefono fijo</label>
                                    <input type="text" class="form form-control" id="id_persona_acudiente_telefono_fijo" name="id_persona_acudiente[telefono_fijo]">
                                </div>
                                <div class="col-md-4">
                                    <label>Telefono movil</label>
                                    <input type="text" class="form form-control" id="id_persona_acudiente_telefono_movil" name="id_persona_acudiente[telefono_movil]">
                                </div>
                                <div class="col-md-4">
                                    <label>Correo electronico</label>
                                    <input type="email" class="form form-control" id="id_persona_acudiente_correo_electronico" name="id_persona_acudiente[correo_electronico]">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label>Parentesco</label>
                                    <input readonly="readonly" class="form form-control" id="ficha_id_persona_acudiente_parentesco" name="ficha[id_persona_acudiente_parentesco]">
                                        <option value="1">Madre/Padre</option>
                                        <option value="2">Hermano/Hermana</option>
                                        <option value="3">Tía/tío</option>
                                        <option value="4">Abuelo/Abuela</option>
                                        <option value="5">Cuidador</option>
                                        <option value="6">Otro</option>
                                    
                                </div>
                                <div class="col-md-6" id="other_parentesco" style="display: none;">
                                    <label>Otro parentesco</label>
                                    <input class="form form-control" type="text" id="ficha_persona_acudiente_parentesco_otro" name="ficha[persona_acudiente_parentesco_otro]" placeholder="Especifique el otro">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Vive con</label>
                                    <input readonly="readonly" class="form form-control" id="ficha_id_persona_vive_con_parentesco" name="ficha[id_persona_vive_con_parentesco]">
                                        <option value="1">Madre/Padre</option>
                                        <option value="2">Hermano/Hermana</option>
                                        <option value="3">Tía/tío</option>
                                        <option value="4">Abuelo/Abuela</option>
                                        <option value="5">Cuidador</option>
                                        <option value="6">Otro</option>
                                    
                                </div>
                                <div class="col-md-6" id="other_vive_con" style="display: none;">
                                    <label>Vive con otro</label>
                                    <input class="form form-control" type="text" id="ficha_persona_vive_con_parentesco_otro" name="ficha[persona_vive_con_parentesco_otro]" placeholder="Especifique el otro">
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
                            <label class="control-label" for="empleado-padece_enfermedad">¿Padece alguna enfermedad permanente que limite su actividad f&#237;sica?</label>
                            <input readonly="readonly" id="ficha_enfermedad_padece_si" class="form-control" name="ficha[enfermedad_padece_si]" required="required">
                                <option value="no">No</option>
                                <option value="si">Si</option>
                            
                        </div>
                        <div class="col-md-6" id="div_enfermedad">
                            <label id="label_ficha_enfermedad" class="control-label" for="empleado-enfermedad">Escriba la enfermedad</label>
                            <input value=""  type="text" id="ficha_enfermedad_padece_nombre" class="form-control" name="ficha[enfermedad_padece_nombre]">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="container-fluid">
                        <div class="col-md-6">
                            <label class="control-label" for="empleado-toma_medicamentos">Toma medicamentos</label>
                            <input readonly="readonly" id="ficha_medicamentos_toma_si" class="form-control" name="ficha[medicamentos_toma_si]" required="required">
                                <option value="no">No</option>
                                <option value="si">Si</option>
                            
                        </div>
                        <div class="col-md-6" id="div_ficha_medicamentos_toma_si">
                            <label id="label_ficha_toma_medicamentos"  class="control-label" for="empleado-medicamentos">Mencione los medicamentos</label>
                            <input value=""  type="text" id="ficha_medicamentos_toma_nombre" class="form-control" name="ficha[medicamentos_toma_nombre]">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="container-fluid">
                        <div class="col-md-6">
                            <label class="control-label" for="empleado-tipo_sangre">Tipo de sangre</label>
                            <input readonly="readonly" id="id_persona_beneficiario_sangre_tipo" class="form-control" name="id_persona_beneficiario[sangre_tipo]" required="required">
                                <option value="">Seleccione</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                            
                        </div>
                        <div class="col-md-6">
                            <label class="control-label" for="empleado-tiene_discapacidad">¿Tiene alguna condición de discapacidad?</label>
                            <input readonly="readonly" id="ficha_tiene_discapacidad" class="form-control" name="ficha[tiene_discapacidad]"  required="required">
                                <option value="0">No</option>
                                <option value="1">Si</option>
                            
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="control-label" for="empleado-afiliado_sgsss">¿Se encuentra afiliado al sistema general de afiliación de salud?</label>
                    <input readonly="readonly" id="ficha_afiliado_sgsss" class="form-control" name="ficha[afiliado_sgsss]"  required="required">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    
                </div>
                <div class="col-md-4">
                    <label class="control-label" for="empleado-tipo_afiliacion">Tipo afiliación</label>

                    <input readonly="readonly" id="ficha_id_salud_regimen" class="form-control" name="ficha[id_salud_regimen]">
                </div>
                <div class="col-md-4">
                    <label class="control-label" for="empleado-entidad_eps">Entidad de salud o EPS</label>
                    <input readonly="readonly"  id="ficha_id_eps" class="form-control" name="ficha[id_eps]">                    
                </div>
            </fieldset>
            <fieldset>
                <div class="row">
                    <label class="col-md-2">¿Ha participado antes de este programa?</label>

                    <div class="col-md-2">
                        <input readonly="readonly" class="form form-control" id="participado_antes">
                            <option value="no">No</option>
                            <option value="si">Si</option>
                        
                    </div>
                </div>
                <div class="row">
                    <div id="panel_participado_antes" style="display: block;">
                        <div class="panel">
                            <div class="panel-heading">
                                Especifique el tiempo
                            </div>
                            <div class="panel-body">
                                <div class="col-md-6">
                                    <label>Meses</label>
                                    <input min="0" id="participacion_anterior_meses" name="ficha[participacion_anterior_meses]" class="form-control" type="number">
                                </div>
                                <div class="col-md-6">
                                    <label>Años</label>
                                    <input min="1" id="participacion_anterior_annos" name="ficha[participacion_anterior_annos]" class="form-control" type="number">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>
@stop