@extends('angular.frontend.master')
@section('title', 'Edición de disciplinas')
@section('content')
<?php
$v='';//?v='.date('YmdHis');
?>
<script type="text/javascript" src="js/disciplinas.crear.js<?= $v; ?>"></script>
<ul id="tableactiondTab" class="nav nav-tabs">
    <li class="active"><a href="#table-table-tab" data-toggle="tab">Disciplina<strong></strong></a></li>
</ul>
<div id="tableactionTabContent" class="tab-content">
	<div class="container-fluid">
		<div class="col-md-12">
			<form id="disciplinas">
				<div class="container-fluid">
					<div class="row">

						<div class="col-md-12">
							<label>Nombre de la disciplina</label>
							<input class="form form-control" title="El nombre de la disciplina es requerido" type="text" name="descripcion" placeholder="Ingrese el nombre de la disciplina" required="required"/>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Guardar</button>
							<a href="{{url('/disciplinas/index')}}" class="btn btn-orange"><i class="fa fa-reply-all"></i>&nbsp;&nbsp;Atras</a>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@stop