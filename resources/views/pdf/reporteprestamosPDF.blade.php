<!DOCTYPE html>
<html>
<head>
	<title>Reporte de Prestamos</title>
  
 <style>
    body {
        font-size:12px !important; 
        font-family: "Courier New", Courier !important;
      }
      
    table {
        font-size:10px !important; 
        font-family: "Courier New", Courier !important;
      }

    @font-face {
		font-family: 'Courier';
		font-style: normal;
		font-weight: normal;
	}
	tr {
        border: 1px solid black;
	}
	td {
        border: 1px solid black;
	}
	thead {
		background: gray;
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
    
 </style>
</head>
<body>
<table border="1" width="100%">
	<tbody>

		<tr>
			<th rowspan="3" width="30%">
				<div id="encabezado_izq">
					<img id="logo" src="http://localhost/deporvida/public/img/alcaldia-de-cali.jpg" width="60px">
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
						REPORTE DE PRESTAMOS
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
			<th>CONTRATISTA</th>
			<th>ROL</th>
			<th>FECHA</th>
			<th>CLASIFICACION</th>
			<th>NOMBRE IMPLEMENTO</th>
			<th>ESPECIFICACION TECNICA</th>
			<th>PROVEEDOR</th>
			<th width="10%">CANTIDAD ENTREGADA AL CONTRATISTA</th>
		</tr>
	</thead>
	<tbody>
		@foreach($prestamos as $prestamo)
		<tr>
			<td>{{ $prestamo->contratista }}</td>
			<td>{{ $prestamo->rol }}</td>
			<td>{{ $prestamo->fecha }}</td>
			<td>{{ $prestamo->disciplinas }}</td>
			<td>{{ $prestamo->implemento }}</td>
			<td>{{ $prestamo->especificacion_tecnica }}</td>
			<td>{{ $prestamo->proveedor }}</td>
			<td id="cantidad">{{ $prestamo->cantidad }}</td>
		</tr>
		@endforeach
	</tbody>
</table>
</body>
</html>