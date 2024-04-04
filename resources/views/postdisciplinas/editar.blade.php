@extends('angular.frontend.master')
@section('title', 'Edición de disciplinas')
@section('content')
<?php
$v='';//?v='.date('YmdHis');
?>
<script type="text/javascript" src="js/disciplinas.editar.js<?= $v; ?>"></script>
<ul id="tableactiondTab" class="nav nav-tabs">
    <li class="active"><a href="#table-table-tab" data-toggle="tab">Disciplina<strong></strong></a></li>
</ul>
<div id="tableactionTabContent" class="tab-content">
	<div class="container-fluid">
		<div class="col-md-12">
			<form id="disciplinas">
				<div class="container-fluid">
					<div class="col-md-12">
						<label>Nombre de la disciplina</label>
						<input class="form form-control" title="El nombre de la disciplina es requerido" type="text" name="descripcion" value="{{$nombre}}" required="required"/>
						<input type="hidden" name="id" value="{{$id}}"/>
					</div>
					<div class="col-md-12">
						<button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Guardar</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@stop