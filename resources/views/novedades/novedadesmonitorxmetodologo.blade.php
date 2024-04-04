@extends('angular.frontend.master')
@section('title', 'Novedades')
@section('content')
<?php
$v='?v='.date('YmdHis');
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.16/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.16/datatables.min.js"></script>
<script type="text/javascript" src="js/jquery/jquery.printPage.js"></script>
<script type="text/javascript" src="{{url('')}}/js/novedades_metodologxmonitor.index.js"></script>
<div class="container">
    <ul id="tableactiondTab" class="nav nav-tabs">
        <li class="active"><a href="#table-table-tab" data-toggle="tab">Novedad<strong></strong></a></li>
    </ul>
    <div id="tableactionTabContent" class="tab-content">
    	<legend>Novedad registrada</legend>
    	<div class="container-fluid">		
		    <div class="col-md-12">
		     <table class="table">
		     	<tr>
		     		<td width="20%"><strong>Monitor</strong></td>
		     		<td width="80%">
		     			{{$data->primer_apellido}}
		     			{{$data->segundo_apellido}}
		     			{{$data->primer_nombre}}
		     			{{$data->segundo_nombre}} -
		     			{{$data->numero_documento}}
		     		</td>
		     	</tr>
		     	<tr>
		     		<td width="20%"><strong>Tipo de novedad</strong></td>
		     		<td width="80%">{{$data->descripcion}}</td>
		     	</tr>
		     	<tr>
		     		<td width="20%"><strong>Fecha de novedad</strong></td>
		     		<td width="80%">{{$data->fecha_reportar}}</td>
		     	</tr>
		     	<tr>
		     		<td width="20%"><strong>Fecha registro</strong></td>
		     		<td width="80%">{{$data->fecha_creacion}}</td>
		     	</tr>
		     	<tr>
		     		<td width="20%"><strong>Grupo</strong></td>
		     		<td width="80%">{{$data->codigo_grupo}}</td>
		     	</tr>
		     	<tr>
		     		<td colspan="2">{{$data->detalle}}</td>
		     	</tr>
		     </table>
		     </div>
	    </div>
    </div>
</div>
@stop