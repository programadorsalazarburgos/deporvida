<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="{{url('')}}/css/bootstrap.css">
	<title></title>
</head>
<body>
	<div class="container">
		<div class="col-md-12">
			<label>Fecha</label><br>
			<span>{{$inventario->fecha}}</span>
		</div>
		<div class="col-md-4">
			<label>Documento</label><br>
			<span>{{$inventario->numero_documento}}</span>
		</div>
		<div class="col-md-8">
			<label>Responsable</label><br>
			<span>{{$inventario->primer_nombre}}</span>
			<span>{{$inventario->segundo_nombre}}</span>
			<span>{{$inventario->primer_apellido}}</span>
			<span>{{$inventario->segundo_apellido}}</span>
		</div>
		<div class="col-md-12">
			<label>Observaciones</label><br>
			<span>
				{{$inventario->observaciones}}	
			</span>
		</div>
		<table id="table_contrato" class="table table-striped">
            <thead>
            	<tr>
                	<th></th>
                    <th>Clasificación</th>
                    <th>Nombre Implemento</th>
                    <th>Proveedor</th>
                    <th width="10%">Stock (En Bodega)</th>
                    <th width="10%">En Fisico</th>
                    <th width="10%">Diferencia</th>
				</tr>
            </thead>
            <tbody>
            	@foreach($detalles as $temp)
            	<tr>
            		<td></td>
            		<td>{{$temp->clasificacion}}</td>
            		<td>{{$temp->implemento}}</td>
            		<td>{{$temp->proveedor}}</td>
            		<td>{{$temp->enfisico}}</td>
            		<td>{{$temp->enbodega}}</td>
            		<td>{{$temp->diferencia}}</td>
            	</tr>
            	@endforeach
        	</tbody>
		</table>
	</div>
</body>
</html>