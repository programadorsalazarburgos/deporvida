<!DOCTYPE html>
<html>
<head>
	<title>Reporte de Devoluciones</title>
  
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
						REPORTE DE DEVOLUCIONES
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
<table width="100%">
	<thead>
		<tr>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
			<th colspan="2" style="background: gray;">DADOS DE BAJA</th>
		</tr>
		<tr>
			<th style="background: gray;">CONTRATISTA</th>
			<th style="background: gray;">ROL</th>
			<th style="background: gray;">FECHA</th>
			<th style="background: gray;">CLASIFICACION</th>
			<th style="background: gray;">NOMBRE IMPLEMENTO</th>
			<th style="background: gray;">ESPECIFICACION TECNICA</th>
			<th style="background: gray;">PROVEEDOR</th>
			<th width="5%" style="background: gray;">CANTIDAD ENTREGADA AL CONTRATISTA</th>
			<th width="5%" style="background: gray;">CANTIDAD DEVUELTA POR EL CONTRATISTA A LA BODEGA</th>
			<th width="5%" style="background: gray;">DAÑO</th>
			<th width="5%" style="background: gray;">ROBO PERDIDA</th>
		</tr>
	</thead>
	<tbody>
		@foreach($devoluciones as $devolucion)
		<tr>
			<td>{{ $devolucion->contratista }}</td>
			<td>{{ $devolucion->rol }}</td>
			<td>{{ $devolucion->fecha }}</td>
			<td>{{ $devolucion->disciplinas }}</td>
			<td>{{ $devolucion->implemento }}</td>
			<td>{{ $devolucion->especificacion_tecnica }}</td>
			<td>{{ $devolucion->proveedor }}</td>
			<td id="cantidad">{{ $devolucion->cantidad }}</td>
			<td id="cantidad">{{ $devolucion->cantidad_devuelta }}</td>
			<td id="cantidad">{{ $devolucion->dano }}</td>
			<td id="cantidad">{{ $devolucion->perdida_robo }}</td>
		</tr>
		@endforeach
	</tbody>
</table>
</body>
</html>