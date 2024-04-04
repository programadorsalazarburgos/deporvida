<!DOCTYPE html>
<html>
<head>
	<title>Reporte de Inventario</title>
  
 <style>
    body {
        font-size:12px !important; 
        font-family: "Courier New", Courier !important;
      }
      
    table {
        font-size:12px !important; 
        font-family: "Courier New", Courier !important;
      }

    @font-face {
		font-family: 'Courier';
		font-style: normal;
		font-weight: normal;
	}
	#encabezado_centro {
		text-align: center;
	}
	#cantidad {
		text-align: right;
	}
	#logo {
		text-align: center;
		top: 10px;
	}
	#encabezado_izq {
		text-align: center;
        font-size:8px !important; 
	}
	#encabezado_der {
		text-align: center;
	}
	thead {
		background: gray;
	}
    
 </style>
</head>
<body>
<table border="1" width="100%">
	<tbody>
		<tr>
			<th rowspan="3" width="30%">
				<div id="encabezado_izq">
					<img id="logo" src="http://localhost/deporvida/public/img/alcaldia-de-cali.jpg" width="50px">
					<br>
					DESARROLLO SOCIAL<br>
					SERVICIO DE DEPORTE Y RECREACIÓN
				</p>
			</th>
			<th width="40%" rowspan="3">
				<div id="encabezado_centro">
					SISTEMAS DE GESTION Y CONTROL INTEGRADOS <br> 
					(SISTEDA, SGC Y MECI)<br>
					<b>
						INVENTARIO FISICO DE IMPLEMENTACION<br>
						PROGRAMA DEPORVIDA
					</b>
				</div>
			</th>
			<th colspan="2" id="encabezado_der">
				MMDS01.04.18 P02 F04
			</th>
		</tr>
		<tr>
			<th id="encabezado_der">Version</th>	
			<th></th>
		</tr>
		<tr>
			<th width="15%" id="encabezado_der" style="font-size: 6px !important;">
				FECHA DE ENTRADA DE VIGENCIA
			</th>
			<th width="15%" id="encabezado_der">1jun2018</th>
		</tr>
	</tbody>
</table>
<br>
<br>
<table border="1" width="100%">
	<thead>
		<tr>
			<th>CLASIFICACION</th>
			<th>NOMBRE IMPLEMENTO</th>
			<th>ESPECIFICACION TECNICA</th>
			<th>CANTIDAD</th>
			<th>EN USO</th>
			<th>EN BODEGA</th>
		</tr>
	</thead>
	<tbody>

		@foreach($inventario as $inv)
			@php
				$clas = $inv->detalle->count();
			@endphp
				<tr>
					<td rowspan="{{$clas}}">{{$inv->clasificacion}}</td>
				@php
					$i=0;
				@endphp			
				@foreach($inv->detalle as $in)
					@if($i>0)
					</tr>
					<tr>
						<td>{{$in->implemento}}</td>
						<td>{{$in->especificacion_tecnica}}</td>
						<td>{{$in->stock}}</td>
						<td>{{$in->stock - $in->enbodega}}</td>
						<td>{{$in->enbodega}}</td>
					</tr>
					@else
						<td>{{$in->implemento}}</td>
						<td>{{$in->especificacion_tecnica}}</td>
						<td>{{$in->stock}}</td>
						<td>{{$in->stock - $in->enbodega}}</td>
						<td>{{$in->enbodega}}</td>
					</tr>
					@endif
					@php
						$i++;
					@endphp
				@endforeach
		@endforeach
	</tbody>
</table>


</body>
</html>