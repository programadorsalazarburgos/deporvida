@extends('angular.frontend.master')
@section('title', 'Geo referenciacion')
@section('content')
<?php $v='?v='.date('YmdHis');?>
<script type="text/javascript"> var id="{{$id}}";</script>
<style type="text/css">
	.statusbar {
    background-color: #2299ec;
    color: #FFFFFF;
    font-size: 1.5rem;
    text-align: center;
    padding: 20px 5px;
}
th{
	background-color:#3097f3 !important;
	color: #FFFFFF;
}
</style>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="{{url('')}}/js/georeferenciacion.comuna.js{{$v}}"></script>
<link rel="stylesheet" type="text/css" href="css/datepicker.css">
<link rel="stylesheet" type="text/css" href="css/fileinput.css">
<div class="container">
    <ul id="tableactiondTab" class="nav nav-tabs">
        <li class="active"><a href="#table-table-tab" data-toggle="tab">Disciplinas<strong></strong></a></li>
    </ul>
    <div id="tableactionTabContent" class="tab-content">
    	<div class="container-fluid">
	        <div class="col-md-6">
				<select id="tipo_grafico" name="tipo_grafico" class="form form-control">
	            	<!--<option value="pie">pie</option>-->
	                <option value="bar">Barras</option>
	                <option value="column">Columnas</option>
	                <option value="line">Lineas</option>
	                <option value="area">Area</option>
	                <option value="areaspline">areaspline</option>
	            </select>

	        	<div id="container">
		    	</div>
	        </div>
		    <div class="col-md-6">
		    	<div class="statusbar ng-binding">INFORMACIÓN.</div>
		    	<div id="container_datos">
		    		<table class="table-striped" width="100%" border="1" cellspacing="0" cellpadding="2" bordercolor="#fff">
			    		<tr>
			    			<th>DISCIPLINAS</th>
			    			<th>NUMERO DE BENEFICIARIOS</th>
			    		</tr>
			    		@foreach($disciplinas as $temp)
			    		<tr>
			    			<td>{{$temp->nombre_disciplina}}</td>
			    			<td><a href="beneficiarios/disciplinas/{{$temp->id}}">{{$temp->cantidad}}</td>		    		
			    		</tr>
			    		@endforeach
		    		</table>
				</div>
		    </div>
		</div>
    </div>



    <ul id="tableactiondTab" class="nav nav-tabs">
        <li class="active"><a href="#table-table-tab" data-toggle="tab">Escenarios<strong></strong></a></li>
    </ul>
    <div id="tableactionTabContent" class="tab-content">
    	<div class="container-fluid">
	        <div class="col-md-6">
	        	<select id="tipo_grafico_Escenarios" name="tipo_grafico_Escenarios" class="form form-control">
	            	<!--<option value="pie">pie</option>-->
	                <option value="bar">Barras</option>
	                <option value="column">Columnas</option>
	                <option value="line">Lineas</option>
	                <option value="area">Area</option>
	                <option value="areaspline">areaspline</option>
	            </select>
	        	<div id="container_Escenarios">
		    	</div>
	        </div>
		    <div class="col-md-6">
		    	<div class="statusbar ng-binding">INFORMACIÓN DEL ESCENARIO</div>
		    	<div id="container_datos">
		    		<table class="table-striped" width="100%" border="1" cellspacing="0" cellpadding="2" bordercolor="#fff">
			    		<tr>
			    			<th>#</th>
			    			<th>COMUNA</th>
			    			<th>ESCENARIO</th>
			    			<th>BENEFICIARIOS</th>
			    		</tr>
			    		@foreach($escenarios as $key => $temp)
			    		<tr>
			    			<td>{{($key+1)}}</td>
			    			<td><strong><center>{{$temp->comuna_escenario}}</center></strong></td>		    		
			    			<td>{{$temp->nombre_escenario}}</td>
			    			<td><a href="beneficiarios/escenario/{{$temp->id}}">{{$temp->cantidad}}</td>		    		
			    		</tr>
			    		@endforeach
		    		</table>
				</div>
		    </div>
		</div>
    </div>
</div>
@stop