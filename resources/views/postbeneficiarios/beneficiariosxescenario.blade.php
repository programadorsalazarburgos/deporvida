
@extends('angular.frontend.master')
@section('title', 'Geo referenciacion')
@section('content')
<?php $v='?v='.date('YmdHis');?>
<script type="text/javascript" src="js/functions.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.16/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.16/datatables.min.js"></script>
<div class="container">
    <ul id="tableactiondTab" class="nav nav-tabs">
        <li class="active"><a href="#table-table-tab" data-toggle="tab">Disciplina <strong></strong></a></li>
    </ul>
    <div id="tableactionTabContent" class="tab-content">
    	<table id="table_escenario_beneficiarios" class="table table-hover table-striped table-bordered table-advanced tablesorter dataTable no-footer">
    		<thead>
    		<tr>
    			<th>#</th>
    			<th>Disciplina</th>
    			<th>Documento</th>
    			<th>Apellidos</th>
    			<th>Nombres</th>
    			<th>Fecha de nacimiento</th>
    			<th>Edad</th>
    			<th>Telefonos</th>
    			<!--<th>Opciones</th>-->
    		</tr>
    		</thead>
    		<tbody>
			@foreach($data as $key => $temp)
				<tr>
					<td>{{($key+1)}}</td>
					<td>{{$temp->disciplina}}</td>
					<td>{{$temp->documento}}</td>
					<td>{{$temp->apellidos}}</td>
					<td>{{$temp->nombres}}</td>
					<td>{{$temp->fecha_nacimiento}}</td>
					<td>{{$temp->edad}} años</td>
					<td>{{$temp->telefono_fijo}} {{$temp->telefono_movil}}</td>
					<!--<td><a href="beneficiario/{{$temp->id}}" class="btn btn-default"><i></i> Ver Beneficiario</a></td>-->
				</tr>
			@endforeach
			</tbody>
		</table>
    </div>
</div>
<script type="text/javascript">
	$(function()
	{
		var t = $('#table_escenario_beneficiarios').dataTable({
			language: {url: base + "/js/languages/datatable.Spanish.json"},
			"pageLength": 50
		});
	});
</script>
@stop