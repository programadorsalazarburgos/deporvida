<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Hoja de vida</title>
		<style>
			.title{
                font-size: 40px;
                font-weight: bold;
                color:#365E83;
			}
            .sub-title{
                font-size: 30px;
                font-family: serif;
                font-weight: bold;
                text-transform: uppercase;
            }
            .table-data{
                width:100%
            }
            .table-data tr td{
                width:50%;
            }
            strong{
                text-transform: uppercase;
            }
		</style>
	</head>
	<body>
		<h2 class="title">
			{{$hojavida->primer_nombre}} 
			{{$hojavida->segundo_nombre}}
			{{$hojavida->primer_apellido}}
			{{$hojavida->segundo_apellido}}
		</h2>
		<strong>{{$hojavida->documento_tipo}}: </strong>
		<span>{{$hojavida->numero_documento}}</span><br>
		<strong>Fecha de nacimiento:</strong>
		<span>{{$hojavida->fecha_nacimiento}}</span><br>
		<strong>Telefono movil:</strong>
		<span>{{$hojavida->telefono_movil}}</span><br>
		<strong>Telefono fijo:</strong>
		<span>{{$hojavida->telefono_fijo}}</span><br>
		<strong>Direccion:</strong>
		<span>{{$hojavida->residencia_direccion}}</span><br>
		<strong>Ciudad:</strong>
		<span>
		{{$hojavida->nombre_municipio}}
		-
		{{$hojavida->nombre_departamento}}
		{{$hojavida->nombre_pais}}
		</span><br>
		<strong>Estado civil:</strong>
		<span>{{$hojavida->estado_civil}}</span><br>
		<strong>Correo:</strong>
		<span>{{$hojavida->correo}}</span><br>
		<br><br>
        <div class="title">ESTUDIOS ACADÉMICOS</div><hr>
		@if(count($estudios)>0)
		<div class="title">Estudios profesionales</div><hr>
		@foreach($estudios as $temp)
        <legend class="sub-title">{{$temp->institucion_educativo}}</legend><br>
        <legend class="sub-title">{{$temp->carrera}}</legend>
        <table class="table-data">
            <tr>
                <td><strong>Nivel de escolaridad</strong></td>
                <td><span>{{$temp->nivel_escolaridad}}</span></td>
            </tr>
            <tr>
                <td><strong>Estado del estudio</strong></td>
                <td><span>{{$temp->estado_estudio}}</span></td>
            </tr>
            <tr>
                <td><strong>Pais de grado</strong></td>
                <td><span>{{$temp->nombre_pais}}</span></td>
            </tr>
            @if(trim($temp->fecha_grado)!='')
            <tr>
                <td><strong>Fecha de grado</strong></td>
                <td><span>{{$temp->fecha_grado}}</span></td>
            </tr>
		    @endif
            @if(trim($temp->horario_clases)!='')
            <tr>
                <td><strong>Horario de clase</strong></td>
                <td><span>{{$temp->horario_clases}}</span></td>
            </tr>
            @endif
        </table>
		@if($temp->tarjeta_profesional!='')
		<strong>Numero de tarjeta profesional</strong>
		<span>{{$temp->tarjeta_profesional}}</span>
		@endif
		@endforeach
		@endif
		@if(count($cursos)>0) 
		<div class="title">Cursos y seminarios</div><hr/>
		@foreach($cursos as $temp)
		<legend class="sub-title">{{$temp->institucion_educativo}}</legend><br>
		<legend class="sub-title">{{$temp->titulo}}</legend><br>
        <table class="table-data">
            <tr>        
                <td><strong>Tipo de curso:</strong></td>
                <td><span>{{$temp->curso_tipo}}></span><br></td>
            </tr>
            <tr>
                <td><strong>Horas cursadas:</strong></td>
                <td><span>{{$temp->horas_cursadas}}</span><br></td>
            </tr>
        </table>
		@endforeach
		@endif
		@if(count($experiencia)>0) 
        <br><br>
		<div class="title">EXPERIENCIA LABORAL</div><hr>
            @foreach($experiencia as $temp)
        <legend class="sub-title">{{$temp->empresa}}</legend>
        <table class="table-data"> 
            <tr>
            <td><strong>Jefe</strong></td>
            <td><span>{{$temp->jefe_inmediato}}</span></td>
            </tr>
            <tr>
            <td><strong>Direccion</strong></td>
            <td><span>{{$temp->direccion}}</span></td>
            </tr>
            <tr>
            <td><strong>Telefono</strong></td>
            <td><span>{{$temp->telefono}}</span></td>
            </tr>
            <tr>
            <td><strong>Cargo</strong></td>
            <td><span>{{$temp->cargo}}</span></td>
            </tr>
            <tr>
            <td><strong>Fecha ingreso</strong></td>
            <td><span>{{$temp->fecha_ingreso}}</span></td>
            </tr>
            <tr>
            <td><strong>Fecha retiro</strong></td>
            <td><span>{{$temp->fecha_retiro}}</span></td>
            </tr>
            <tr>
            <td><strong>Correo empresa</strong></td>
            <td><span>{{$temp->correo_empresa}}</span></td>
            </tr>
            <tr>
            <td><strong>Expericia</strong></td>
            <td><span>{{$temp->tipo_experiencia}}</span></td>
            </tr>
        </table>
            @endforeach
		@endif
		@if(count(json_decode($idiomas))>0)
        <br><br>
		<div class="title">IDIOMAS</div>
        <hr>
		@foreach(json_decode($idiomas) as $temp)
		{{$temp->nombre_idioma}}<br>
		@endforeach
		@endif
	</body>
</html>