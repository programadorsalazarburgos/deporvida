@extends('angular.frontend.master')
@section('title', 'Registro de personal')
@section('content')

<ul id="tableactiondTab" class="nav nav-tabs">
    <li class="active"><a href="#table-table-tab" data-toggle="tab">Registro del personal<strong></strong></a></li>
</ul>
<div id="tableactionTabContent" class="tab-content">
	<div id="log"></div>
    <form id="empleado_form">
    	<a href="/Asistencias/imprimir/{{$id_grupo}}" target="_black" class="btn btn-info"><i class="fa fa-print"></i> Imprimir</a>
    	<div class="clearfix"></div>
    	<br/>
		<?= html_entity_decode($table);?>
	</form>
</div>
@stop