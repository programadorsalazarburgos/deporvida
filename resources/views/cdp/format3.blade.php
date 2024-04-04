<!DOCTYPE html>
<html>
	<head>
		<style type="text/css">
		@page { margin: 2cm 2.2cm 3.5cm 2.05cm; }
		.table{
			 border:1;
			 width:100%;
		}
		.fin{ vertical-align: 90%; position:relative; }
		body{
			font-family: sans-serif;
            font-size:14.5px;
		}
		</style>
		<title>INFORME MENSUAL DE EJECUCION</title>
	</head>
	<body>
		<div class="container-fluid">
		<table border="1" width="100%">
			<tr>
				<td>
					<strong>CONTRATO:	4162.010.26.1.1124 DE 2018
					</strong>
				</td>
			</tr>
		</table>
		<br>
		<strong>CONTRATANTE:</strong> MUNICIPIO SANTIAGO DE CALI- SECRETARIA DEL DEPORTE Y RECREACION
		<br>
		<br>
		<p><strong>OBJETO:</strong>
		{{$data->contrato_objeto}}</p>
		<br>
		<strong>PLAZO: </strong>HASTA EL 31 DE AGOSTO DE 2018 
		<br>
		<br>
		<table border="1" width="100%">
			<tr>
				<td>
					<strong>SUPERVISOR:</strong> {{$data->supervisor}}
				</td>
			</tr>
		</table>
		<br>
		<center><strong>INFORME MENSUAL DE EJECUCION<br><br>{{strtoupper($data->mes)}} DE 2018<br><br></strong></center>
		Se realizó en el mes de {{$data->mes}} las siguientes actividades: <br><br>
		<p></p>
			<?= ($data->tareas_informe_mensual); ?>
		<br/>
		ANEXO: Registro fotográfico de actividades realizadas
		<br/><br/><br/><br/><br/><br>
		
		<table width="100%">
			<tr>
				<td >
					_________________________<br>
					{{$data->nombre_primero}} {{$data->nombre_segundo}} {{$data->apellido_primero}} {{$data->apellido_segundo}} <br>
					C.C {{number_format($data->documento)}}<br>
					Contratista			
				</td>
				<td>
					_________________________________<br>
					Gloria Caicedo B.<br>
					Coordinador General<br>
					&nbsp;&nbsp;&nbsp;&nbsp;
				</td>
			</tr>
		</table>
		<div style="page-break-after:always;"></div>
		<center>ANEXOS INFORME MENSUAL DE EJECUCION<br>REGISTRO FOTOGRAFICO</center>
			<div class="container-fluid">
				<div class="col-md-12">
					@foreach($fotos as $key => $temp)
						@if(trim($temp->url_imagen)!='')
							@if($key%2==0)
							<div style="width: 230px; text-align: center;">
							<table width="100%" style="border:collapse">
								<tr style="padding-top: 5px;padding-bottom: 5px; " >
							@endif
									<td style=" vertical-align: top;" width="50%">
										<table border="1" style="width: 100%; border: 1px solid black;border-collapse: collapse;">
											<tr>
												<td style="padding: 12px;">LUGAR</td>
												<td style="padding: 12px;">{{$temp->lugar}}</td>
											</tr>
											<tr>
												<td colspan="2" style="padding: 12px;" >
												<img src="{{$temp->url_imagen}}" width="260px">
												<strong>
												<i>{{$data->nombre_primero}} {{$data->nombre_segundo}} {{$data->apellido_primero}} {{$data->apellido_segundo}}</i>
												</strong>
												</td>
											<tr>
										</table>
									</td>
							@if($key%2==1)
								</tr>
							</table>
							</div>
							@endif
						@endif
					@endforeach
				</div>
			</div>
		</div>
		<div class="fin">
		_________________________<br>
					{{$data->nombre_primero}} {{$data->nombre_segundo}} {{$data->apellido_primero}} {{$data->apellido_segundo}} <br>
					Contratista			
		</div>
	</body>
</html>