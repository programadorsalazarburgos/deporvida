@extends('angular.frontend.master')
@section('title', 'Nueva institución educativa')
@section('content')
<?php
	$v='?v='.date('YmdHis');
	?>
<style type="text/css">
	input{
	text-transform:uppercase;
	} 
</style>
<script type="text/javascript" src="{{url('js/institucion.create.js')}}"></script>
<div class="container">
	<ul id="tableactiondTab" class="nav nav-tabs">
		<li class="active"><a href="#table-table-tab" data-toggle="tab">Nueva institución educativa<strong></strong></a></li>
	</ul>
	<div id="tableactionTabContent" class="tab-content">
		<form id="form">
			<div class="row">
				<div class="col-md-12">
					<label>Nombre</label>
					<input value="" type="text" name="nombre" id="nobmre"  class="form form-control" required="required" />
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Guardar</button>
					<a href="{{url('/institucioneseducativas/index')}}" class="btn btn-orange"><i class="fa fa-reply-all"></i>&nbsp;&nbsp;Atras</a>
				</div>
			</div>
		</form>
	</div>
</div>
@stop