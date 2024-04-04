@extends('angular.frontend.master')
@section('title', 'Registro de personal')
@section('content')
<?php $v='?v='.date('YmdHis');?>
<style type="text/css">
    .input{
        text-transform: uppercase;
    }
</style>

<script type="text/javascript" src="js/verhojavida.js"></script>
<link rel="stylesheet" type="text/css" href="css/fileinput.css">
<ul id="tableactiondTab" class="nav nav-tabs">
    <li class="active"><a href="#table-table-tab" data-toggle="tab">Hoja de vida<strong></strong></a></li>
</ul>
<div id="tableactionTabContent" class="tab-content">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <i class="fa fa-user" aria-hidden="true"></i>
            Datos personales
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="container-fluid">
                    <div class="col-md-12">
                        <strong>Numero de documento:</strong>
                        <span class="input">{{$hojavida->numero_documento}}</span>
                    </div>
                    <div class="col-md-12">
                        <strong>Fecha de nacimiento:</strong>
                        <span class="input">{{$hojavida->fecha_nacimiento}}</span>
                    </div>
                    <div class="col-md-12">
                        <strong>Primer nombre:</strong>
                        <span class="input">{{$hojavida->primer_nombre}}</span>
                    </div>
                    <div class="col-md-12">
                        <strong>Segundo nombre:</strong>
                        <span class="input">{{$hojavida->segundo_nombre}}</span>
                    </div>
                    <div class="col-md-12">
                        <strong>Primer apellido:</strong>
                        <span class="input">{{$hojavida->primer_apellido}}</span>
                    </div>
                    <div class="col-md-12">
                        <strong>Segundo apellido:</strong>
                        <span class="input">{{$hojavida->segundo_apellido}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(true) <?php //@if(count($estudios)>0) ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <i class="fa fa-graduation-cap" aria-hidden="true"></i>
            Estudios profesionales
        </div>
        <div class="panel-body">
            @foreach($estudios as $temp)
            <div class="row">
                <div class="col-md-12">
                    <legend>{{$temp->institucion_educativo}}</legend>
                </div>
                <div class="container-fluid">
                    <div class="col-md-12">
                        <legend>{{$temp->carrera}}</legend>
                    </div>
                    <div class="col-md-12">
                        <strong>Nivel de escolaridad</strong>
                        <span class="input">{{$temp->nivel_escolaridad}}</span>
                    </div>
                    <div class="col-md-12">
                        <strong>Estado del estudio</strong>
                        <span class="input">{{$temp->estado_estudio}}</span>
                    </div>
                    <div class="col-md-12">
                        <strong>Pais de grado</strong>
                        <span class="input">{{$temp->nombre_pais}}</span>
                    </div>
                        @if(trim($temp->horario_clases)!='')
                        <div class="col-md-12">
                            <strong>Horario de clase</strong><br/>
                            <span class="input">{{$temp->horario_clases}}</span>
                        </div>
                        @endif
                    
                    <div class="col-md-12">
                        <strong>Fecha de grado</strong>
                        <span class="input">{{$temp->fecha_grado}}</span>
                    </div>
                        @if($temp->tarjeta_profesional!='')
                        <div class="col-md-12">
                            <strong>Numero de tarjeta profesional</strong>
                            <span class="input">{{$temp->tarjeta_profesional}}</span>
                        </div>
                        @endif
                    <div class="col-md-12">
                        @if(!is_null($temp->archivos))
                        <strong>Soportes</strong>
                        @foreach(json_decode($temp->archivos) as $temp2)
                            <br><a target="_blank" href="{{url('')}}/{{$temp2->url}}" onclick="window.open(this.href, this.target, 'width=471,height=700'); return false;"><i class="fa fa-file"></i> {{$temp2->nombre}}</a>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
    @if(true)<?php //$cursos ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <i class="fa fa-book" aria-hidden="true"></i>
            Cursos y seminarios
        </div>
        <div class="panel-body">
            @foreach($cursos as $temp)
            <div class="row">
                <div class="container-fluid">
                    <legend>{{$temp->institucion_educativo}}</legend>
                    <div class="col-md-12">
                        <h4>{{$temp->titulo}}</h4>
                    </div>
                    <div class="col-md-12">
                        <label>Tipo de curso:</label>
                        <span class="input"{{$temp->curso_tipo}}></span>
                    </div>
                    <div class="col-md-12">
                        <label>Horas cursadas:</label>
                        <span class="input">{{$temp->horas_cursadas}}</span>
                    </div>
                    <div class="col-md-12">
                        @if(!is_null($temp->archivos))
                        <strong>Soportes</strong>
                            @foreach(json_decode($temp->archivos) as $temp2)
                                <br><a target="_blank" href="{{url('')}}/{{$temp2->url}}" onclick="window.open(this.href, this.target, 'width=471,height=700'); return false;"><i class="fa fa-file"></i> {{$temp2->nombre}}</a>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
    @if(true)<?php //@if(count($experiencia)>0) ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            Experiencia laboral
        </div>
        <div class="panel-body">
            @foreach($experiencia as $temp)
            <div class="row">
                <div class="container-fluid">
                    <legend>{{$temp->empresa}}</legend>
                    <div class="col-md-12">
                        <strong>Jefe</strong>
                        <span class="input">{{$temp->jefe_inmediato}}</span>
                    </div>
                    <div class="col-md-12">
                        <strong>Direccion</strong>
                        <span class="input">{{$temp->direccion}}</span>
                    </div>
                    <div class="col-md-12">
                        <strong>Telefono</strong>
                        <span class="input">{{$temp->telefono}}</span>
                    </div>
                    <div class="col-md-12">
                        <strong>Cargo</strong>
                        <span class="input">{{$temp->cargo}}</span>
                    </div>
                    <div class="col-md-12">
                        <strong>Fecha ingreso</strong>
                        <span class="input">{{$temp->fecha_ingreso}}</span>
                    </div>
                    <div class="col-md-12">
                        <strong>Fecha retiro</strong>
                        <span class="input">{{$temp->fecha_retiro}}</span>
                    </div>
                    <div class="col-md-12">
                        <strong>Correo empresa</strong>
                        <span class="input">{{$temp->correo_empresa}}</span>
                    </div>
                    <div class="col-md-12">
                        <strong>Expericia</strong>
                        <span class="input">{{$temp->tipo_experiencia}}</span>
                    </div>
                    <div class="col-md-12">
                        @if(!is_null($temp->archivos))
                        <strong>Soportes</strong>
                            @foreach(json_decode($temp->archivos) as $temp2)
                                <br><a target="_blank" href="{{url('')}}/{{$temp2->url}}" onclick="window.open(this.href, this.target, 'width=471,height=700'); return false;"><i class="fa fa-file"></i> {{$temp2->nombre}}</a>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
    @if(true)<?php //@if(count($idiomas)>0) ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <i class="fa fa-flag" aria-hidden="true"></i>
            Idiomas
        </div>
        <div class="panel-body">
            @foreach(json_decode($idiomas) as $temp)
            <div class="row">
                <div class="container-fluid">
                    <div class="col-md-12">
                        <strong>{{$temp->nombre_idioma}}</strong>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
    <div class="panel panel-primary">
        <div class="panel-heading">
            <i class="fa fa-file" aria-hidden="true"></i>
            Documentos adjuntos
        </div>
        <div class="panel-body" style="padding-top: 0px;padding-left: 0px;padding-right: 0px;">
            <iframe border="0"  src="{{$url}}" width="100%" height="600px"></iframe>           
        </div>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <i class="fa fa-pencil-square" aria-hidden="true"></i>
            Observaciones
        </div>
        <form id="cambios">
            <div class="panel-body">
                <div class="col-md-12">
                    <label>Observaciones</label>
                    <textarea rows="10" name="observaciones" class="form form-control">{{$observacion}}</textarea>
                </div>
            </div>
            <div class="panel-footer">
                <button class="btn btn-success"><i class="fa fa-save"></i> Guardar Cambios</button>
            </div>
        </form>
    </div>
</div>
@stop