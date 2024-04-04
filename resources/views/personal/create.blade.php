@extends('angular.frontend.master')
@section('title', 'Registro de personal')
@section('content')
<script type="text/javascript" src="js/functions.js"></script>
<script type="text/javascript" src="js/municipios_change.js"></script>
<script type="text/javascript" src="js/empleado.registro.js"></script>
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
    .data_hide{
        display: none !important;
    }
</style>
<script>
    $(function ()
    {
        $('#empleado_form').submit(function (e)
        {
            e.preventDefault();
            $.ajax({
                url: base + '/personal/save',
                type: 'POST',
                data: $(this).serialize(),
                success: function (data)
                {
                    $('body,html').animate({scrollTop: 0}, 500);
                    swal("Almacenado!", "Registro Guardado.", "success");
                    window.location = base + '/login';
                }
            });
        });
    });
</script>
<ul id="tableactiondTab" class="nav nav-tabs">
    <li class="active"><a href="#table-table-tab" data-toggle="tab">Registro del personal<strong></strong></a></li>
</ul>
<div id="tableactionTabContent" class="tab-content">
    <div id="log"></div>
    <form id="empleado_form">
        <fieldset>
            <legend>Datos básicos</legend>
            <div class="col-md-6">
                <label class="control-label" for="empleado-tipo_doc">Tipo documento</label>
                <select id="persona_id_documento_tipo" required="true" class="form-control" name="persona[id_documento_tipo]">
                    <option value="">Seleccione</option>
                    @foreach($tipo_documento as $temp)
                    <option value="{{$temp->id}}">{{$temp->descripcion}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label class="control-label" for="empleado-documento">Documento</label>
                <div class="input-group">
                    <input type="text" id="persona_documento" class="only_number form-control" onchange="change_documento()" name="persona[documento]"/>
                    <span class="input-group-btn">
                        <button onclick="change_documento()" class="btn btn-default" type="button"><i class="glyphicon glyphicon-search"></i></button>
                    </span>
                </div>
            </div>
        </fieldset>
        <fieldset class="data_hide">
            <div class="col-md-6">
                <label class="control-label" for="empleado-nombres">Primer nombre</label>
                <input value=""  type="text" title="Solo texto" id="persona_nombre_primero" class="form-control" name="persona[nombre_primero]" maxlength="60" required="true"/>
            </div>              
            <div class="col-md-6">
                <label class="control-label" for="empleado-nombres">Segundo nombre</label>
                <input value=""  type="text" title="Solo texto" id="empleado-nombres" class="form-control" name="persona[nombre_segundo]" maxlength="60" >
            </div>
            <div class="col-md-6">
                <label class="control-label" for="empleado-apellidos">Primer apellidos</label>
                <input value=""  type="text" title="Solo texto" id="empleado-apellidos" class="form-control" name="persona[apellido_primero]" maxlength="60" required="true">
            </div>
            <div class="col-md-6">

                <label class="control-label" for="empleado-apellidos">Segundo apellidos</label>
                <input value=""  type="text" title="Solo texto" id="empleado-apellidos" class="form-control" name="persona[apellido_segundo]" maxlength="60" >
            </div>

            <div class="col-md-6">
                <label class="control-label" for="empleado-email">Email</label>
                <input value=""  type="email" id="persona_correo_electronico" class="form-control" name="persona[correo_electronico]" maxlength="100">
            </div>
            <div class="col-md-6">
                <label class="control-label" for="empleado-sexo">Sexo</label>
                <select id="empleado-sexo" class="form-control" name="persona[sexo]"  required="true">
                    <option value="1">Hombre</option>
                    <option value="2">Mujer</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="control-label" for="empleado-fecha_nacimiento">Fecha Nacimiento</label>
                <input value=""  type="text" id="persona_fecha_nacimiento" name="persona[fecha_nacimiento]" class="fecha form form-control" required="true">
            </div>
            <div class="col-md-6">
                <label class="control-label" for="empleado-fecha_nacimiento">Corregimiento</label>
                <select id="ficha_id_corregimiento" name="ficha[id_corregimiento]" class="fecha form form-control">
                    <option value="">Seleccione</option>
                    @foreach($corregimiento as $temp)
                    <option value="{{$temp->id}}">{{$temp->nombre}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label class="control-label" for="empleado-fecha_nacimiento">Veredas</label>
                <select id="ficha_id_vereda" name="ficha[id_vereda]" class="fecha form form-control">
                    <option value="">Seleccione</option>
                    @foreach($veredas as $temp)
                    <option value="{{$temp->id}}">{{$temp->nombre}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label class="control-label" for="empleado-id_pais">Nacionalidad</label>
                <select id="persona_id_procedencia_pais" class="form-control" name="persona[id_procedencia_pais]" required="true">
                    <option value="">Seleccione</option>
                    @foreach($pais as $temp)

                    @if ($temp->id=="1")
                    <option value="{{$temp->id}}" selected>{{$temp->nombre}}</option>
                    @else
                    <option value="{{$temp->id}}">{{$temp->nombre}}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label class="control-label" for="empleado-id_departamento">Departamento</label>
                <select class="form form-control" id="persona_id_procedencia_departamento" name="persona[id_procedencia_departamento]" required="true">
                    <option value="">Seleccione</option>
                    <option value="{{$temp->id}}">{{$temp->nombre}}</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="control-label" for="empleado-id_ciudad">Ciudad</label>
                <select id="persona_id_ciudad" class="form-control" name="persona[id_ciudad]"  required="true">
                    <option value="">Seleccione</option>
                    @foreach($municipio as $temp)
                    <option value="{{$temp->id}}">{{$temp->nombre}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label class="control-label" for="empleado-id_ciudad">Ciudad</label>
                <select id="persona_id_ciudad" class="form-control" name="persona[id_ciudad]"  required="true">
                    <option value="">Seleccione</option>
                    @foreach($municipio as $temp)
                    <option value="{{$temp->id_ciudad}}">{{$temp->nombre}}</option>
                    @endforeach
                </select>
            </div>
        </fieldset>
        <fieldset class="data_hide">
            <legend>Residencia</legend>

            <div class="col-md-6">
                <label class="control-label" for="empleado-barrio">Barrio</label>
                <select id="persona_id_residencia_barrio" class="form-control" name="persona[id_residencia_barrio]" required="true">
                    <option value="">Seleccionar barrio</option>
                    @foreach($barrio as $temp)
                    <option data-comuna="{{$temp->comuna_id}}" data-estrato="{{$temp->id_estrato}}" value="{{$temp->id}}">{{$temp->nombre_barrio}}</option>
                    @endforeach
                </select>

            </div>           

            <div class="col-md-12">
                <div class="form-group">
                    <div class="row">
                        <script src="js/GeneratorAdd.js" type="text/javascript"></script>
                        <script>
                            $(function ()
                            {
                                $('#persona_residencia_direccion').add_generator({
                                    direccion: 'persona_residencia_direccion',
                                    complemento:'persona_residencia_direccion_observacion'
                                });
                            });
                        </script>

                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <label class="control-label" for="empleado-direccion">Direccion</label>
                <input value=""  class="form-control" id="persona_residencia_direccion" placeholder="Digita Dirección" name="persona[residencia_direccion]" required="true" readonly="true" />
            </div>
            <div class="col-md-6">
                <label class="control-label" for="empleado-direccion">Observaciones</label>
                <input value=""  class="form-control" id="persona_residencia_direccion_observacion" placeholder="" name="persona[residencia_direccion_observacion]" />
            </div>
            <div class="col-md-6">
                <label class="control-label" for="empleado-estrato">Estrato</label>
                <select id="persona_residencia_estrato" class="form-control" name="persona[residencia_estrato]"  required="true">
                    <option value="">Seleccione</option>
                    <option value="1">Uno</option>
                    <option value="2">Dos</option>
                    <option value="3">Tres</option>
                    <option value="4">Cuatro</option>
                    <option value="5">Cinco</option>
                    <option value="6">Seis</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="control-label" for="empleado-telefono">Telefono</label>
                <input value=""  min="0" type="number" id="persona_telefono_fijo" class="form-control" name="persona[telefono_fijo]" maxlength="45">
            </div>
            <div class="col-md-6">
                <label class="control-label" for="empleado-celular">Celular</label>
                <input value=""  min="0" type="number" id="persona_telefono_movil" class="form-control" name="persona[telefono_movil]" maxlength="45" >
            </div>
        </fieldset>
        <fieldset class="data_hide">
            <legend>Académicos</legend>
            <div class="row">
                <div class="col-md-6">
                    <label class="control-label" for="empleado-profesion">Título Obtenido : </label>
                    <input value=""  type="text" id="ficha_profesion" class="form-control" name="ficha[profesion]" maxlength="100" required="true">
                </div>
                <div class="col-md-6">
                    <label class="control-label" for="empleado-sit_prof_act">Ocupación actual</label>
                    <select id="ficha_ocupacion" class="form-control" name="ficha[id_ocupacion]" required="true">
                        <option value="">Seleccione</option>
                        @foreach($ocupacion as $temp)
                        <option value="{{$temp->id}}">{{$temp->descripcion}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="control-label" for="empleado-nivel_formacion">Nivel de escolaridad</label>
                    <select id="ficha_id_escolaridad_nivel" class="form-control form" name="ficha[id_escolaridad_nivel]" required="true">
                        <option value="">Seleccione</option>
                        @foreach($escolaridad_nivel as $temp)
                        <option value="{{$temp->id_escolaridad_nivel}}">{{$temp->descripcion}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="control-label" for="empleado-profesion">Universidad : </label>
                    <input value=""  type="text" id="ficha_universidad" class="form-control" name="ficha[universidad]" maxlength="100" required="true">
                </div>
            </div>
        </fieldset>
        <fieldset class="data_hide">
            <legend>Familia</legend>
            <div class="col-md-6">
                <label class="control-label" for="empleado-estado_civil">Estado Civil</label>
                <select id="persona_id_estado_civil" class="form-control" name="persona[id_estado_civil]" required="true">
                    <option value="">Seleccione</option>
                    @foreach($estado_civil as $temp)
                    <option value="{{$temp->id}}">{{$temp->descripcion}} (a)</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label class="control-label" for="empleado-tiene_hijos">Tiene Hijos</label>
                <select id="ficha_tiene_hijos" class="form-control" name="ficha[tiene_hijos]" required="true">
                    <option value="0">No</option>
                    <option value="1">Si</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="control-label" for="empleado-cuantos_hijos">¿Cuántos hijos?</label>
                <input value=""  type="number" min="0" id="ficha_cuantos_hijos" class="form-control" name="ficha[cuantos_hijos]">
            </div>
            <div class="col-md-6">
                <label class="control-label" for="empleado-identidad_cultural">¿Se reconoce cómo?</label>
                <select id="ficha_id_etnia" class="form-control" name="ficha[id_etnia]"  required="true">
                    <option value="">Seleccione</option>
                    @foreach($etnia_si as $temp)
                    <option value="{{$temp->id}}">{{$temp->descripcion}}</option>
                    @endforeach
                </select>
            </div>
            <div class="row">
                <legend>Grupo poblacional</legend>
                @foreach($grupo_poblacional as $temp)
                <label class="col-md-3" style="text-transform: uppercase">
                    <input value=""  type="checkbox" id="id_grupo_poblacional_{{$temp->id}}" name="grupo_poblacional[]" value="{{$temp->id}}">{{$temp->descripcion}}<br>
                </label>
                @endforeach
                <div class="col-md-3">
                    <input value=""  type="" name="grupo_poblacional[][otro]" id="grupo_poblacional_otro" placeholder="Especifique el otro" class="form form-control"/>
                </div>
            </div>
        </fieldset>
        <fieldset class="data_hide">
            <legend>Salud</legend>
            <div class="col-md-6">
                <label class="control-label" for="empleado-tipo_sangre">Tipo de sangre</label>
                <select id="persona_sangre_tipo" class="form-control" name="persona[sangre_tipo]" required="true">
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
                <label class="control-label" for="empleado-tiene_discapacidad">¿Tiene discapacidad?</label>
                <select id="ficha_tiene_discapacidad" class="form-control" name="ficha[tiene_discapacidad]"  required="true">
                    <option value="">Seleccione</option>
                    <option value="0">No</option>
                    <option value="1">Si</option>
                </select>
            </div>
            <div class="row">
                <legend>¿Posee alguna discapacidad?</legend>
                @foreach($discapacidad as $temp)
                <div class="col-md-4">
                    <label style="text-transform: uppercase">
                        <input value=""  type="checkbox" id="id_discapacidad_{{$temp->id_discapacidad}}" name="discapacidad[]" value="{{$temp->id_discapacidad}}">{{$temp->descripcion}}
                    </label>
                </div>
                @endforeach
            </div>
            <div class="col-md-6">
                <label class="control-label" for="empleado-padece_enfermedad">¿Padece alguna enfermedad?</label>
                <select id="ficha_padece_enfermedad" class="form-control" name="ficha[padece_enfermedad]" required="required">
                    <option value="">Seleccione</option>
                    <option value="0">No</option>
                    <option value="1">Si</option>
                </select>
            </div>
            <div class="col-md-6" id="div_enfermedad">
                <label class="control-label" for="empleado-enfermedad">Escriba la enfermedad</label>
                <input value=""  type="text" id="ficha_enfermedad" class="form-control" name="ficha[enfermedad]">
            </div>
            <div class="col-md-6">
                <label class="control-label" for="empleado-toma_medicamentos">Toma medicamentos</label>
                <select id="persona_toma_medicamentos" class="form-control" name="persona[toma_medicamentos]" required="true">
                    <option value="">Seleccione</option>
                    <option value="0">No</option>
                    <option value="1">Si</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="control-label" for="empleado-medicamentos">Mencione los medicamentos</label>
                <input value=""  type="text" id="ficha_medicamentos" class="form-control" name="ficha[medicamentos]">
            </div>
            <div class="col-md-6">
                <label class="control-label" for="empleado-afiliado_sgsss">¿Se encuentra afiliado al sistema general de afiliación de salud?</label>
                <select id="ficha_afiliado_sgsss" class="form-control" name="ficha[afiliado_sgsss]"  required="true">
                    <option value="">Seleccione</option>
                    <option value="0">No</option>
                    <option value="1">Si</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="control-label" for="empleado-tipo_afiliacion">Tipo afiliación</label>

                <select id="ficha_tipo_afiliacion" class="form-control" name="ficha[id_tipo_afiliacion]" required="true">
                    <option value="">Seleccione</option>
                    <option value="1">Regimen Contributivo (EPS)</option>
                    <option value="2">Regimen Subsidiado (SISBEN-EPS-S)</option>
                    <option value="3">Especial (FFMM, Policia, etc)</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="control-label" for="empleado-entidad_eps">Entidad de salud o EPS</label>
                <select  id="ficha_entidad_eps" class="form-control" name="ficha[id_eps]" required="true">
                    @foreach($eps as $temp)
                    <option value="{{$temp->id_eps}}">{{$temp->descripcion}}</option>
                    @endforeach
                </select>
            </div>
        </fieldset>
        <fieldset class="data_hide">
            <legend>Varios</legend>
            <div class="col-md-6">
                <label class="control-label" for="empleado-libreta_militar">Libreta militar</label>
                <select id="ficha_libreta_militar" class="form-control" name="ficha[libreta_militar]" required="true">
                    <option value="">Seleccione</option>
                    <option value="1">Primera</option>
                    <option value="2">Segunda</option>
                </select>
            </div>
            <div class="col-md-6">
                <div class="form-group field-empleado-no_libreta_militar">
                    <label class="control-label" for="empleado-no_libreta_militar">Número libreta militar</label>
                    <input value=""  type="text" id="empleado-no_libreta_militar" class="form-control" name="ficha[no_libreta_militar]">
                </div>
            </div>
            <div class="col-md-6">
                <label class="control-label" for="empleado-distrito_militar">Distrito militar</label>
                <input value=""  type="text" id="empleado-distrito_militar" class="form-control" name="ficha[distrito_militar]" >
            </div>
            <div class="col-md-6">
                <label class="control-label" for="empleado-skype">Skype</label>
                <input value=""  type="text" id="empleado-skype" class="form-control" name="ficha[skype]" maxlength="50" >
            </div>
            <div class="col-md-12">
                <label class="control-label" for="empleado-proyecto_profesional">Proyecto profesional</label>
                <textarea id="empleado-proyecto_profesional" class="form-control" name="ficha[proyecto_profesional]" rows="6" required="true"></textarea>
            </div>
        </fieldset>
        <fieldset class="data_hide">
            <legend>Disciplina (Opcional)</legend>
            <div class="row">
                @foreach($disciplinas as $temp)
                <div class="col-md-4">
                    <label style="text-transform: uppercase">
                        <input value=""  type="checkbox" id="id_disciplina_{{$temp->id}}" name="disciplina[]" value="{{$temp->id}}">{{$temp->descripcion}}
                    </label>
                </div>
                @endforeach
            </div>
            <button class="btn btn-primary">Guardar</button>
        </fieldset>
    </form>
</div>
@stop