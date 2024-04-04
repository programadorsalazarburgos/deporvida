@extends('angular.frontend.master')
@section('title', 'Novedades')
@section('content')
<?php
$v='?v='.date('YmdHis');
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.18.0/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.18.0/localization/messages_es.min.js"></script>
<link rel="stylesheet" href="{{url('/css/validate.css')}}">
<script>$(function(){$("#form").validate();})</script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.16/datatables.min.css"/>
<script type="text/javascript" src="{{url('/js/novedad.new.js')}}"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.16/datatables.min.js"></script>
<script type="text/javascript" src="js/jquery/jquery.printPage.js"></script>
<div class="container">
    <ul id="tableactiondTab" class="nav nav-tabs">
        <li class="active"><a href="#table-table-tab" data-toggle="tab">Novedad<strong></strong></a></li>
    </ul>
    <div id="tableactionTabContent" class="tab-content">
        <div class="container-fluid">
        	<form id="form" action="{{url('/novedad/save')}}" method="post">
	        
	        	<div class="row">
		        	<div class="col-md-3"><label>Tipo de novedad</label></div>
		        	<div class="col-md-5">
		        		<select class="form form-control" name="id_novedad_tipo" id="id_novedad_tipo" required="required">
		        			<option value="">Seleccione</option>
		        			@foreach($novedades_tipo as $temp)
		        				<option value="{{$temp->id}}">{{$temp->descripcion}}</option>
		        			@endforeach
		        		</select>
		        	</div>
	        	</div>
	        	<div class="row">
		        	<div class="col-md-3"><label>Fecha de novedad</label></div>
		        	<div class="col-md-5">
		        		<input type="text" name="fecha_reportar" id="fecha_reportar" class="form form-control" required="required">
		        	</div>
	        	</div>
				<div class="row">
					<div class="col-md-8">
						<label>Grupos</label>
						<select class="form form-control" id="id_grupo" name="id_grupo">
						</select>
					</div>
		        </div>

		        <div class="row">
		        	<div class="col-md-8">
		        		<label class="label label-warning" id="horario_label"></label>
		        	</div>
		        </div>
		        <div class="row">
					<div class="col-md-8">
						<label>Descripcion</label>
						<textarea class="form form-control" name="detalle" required="required"></textarea>
					</div>
		        </div>
		    	<div class="row">
		    		<div class="col-md-8">
						<button id="save" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
						<a href="javascript:history.back(1)" type="submit" class="btn btn-orange"><i class="fa fa-reply-all"></i>&nbsp;&nbsp;Atras</a>
			    	</div>
		    	</div>
        	</form>
        </div>
    </div>
</div>
@stop
