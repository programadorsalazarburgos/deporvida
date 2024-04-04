@extends('angular.frontend.master')
@section('title', 'Carga de Información Masiva')
@section('content')
	<script src="http://cdn.jsdelivr.net/npm/jquery-easy-loading/dist/jquery.loading.min.js" type="text/javascript"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.12.13/xlsx.full.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jexcel/1.3.4/js/jquery.jexcel.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jexcel/1.5.0/js/jquery.jcalendar.js"></script>
	<script src="{{url('')}}/js/cdp.carga.js?v=<?= date('YmdHis') ?>"></script>
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jexcel/1.3.4/css/jquery.jexcel.css" type="text/css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jexcel/1.5.0/css/jquery.jcalendar.min.css" type="text/css" />
	<link rel="stylesheet" type="text/css" href="http://cdn.jsdelivr.net/npm/jquery-easy-loading/dist/jquery.loading.min.css">
<div class="container">
    <ul id="tableactiondTab" class="nav nav-tabs">
        <li class="active"><a href="#table-table-tab" data-toggle="tab">Registro de contratos<strong></strong></a></li>
    </ul>
    <div id="tableactionTabContent" class="tab-content">
		<div class="container-fluid">
			<div class="col-md-12">
				<div class="table-responsive">
					<input class="btn btn-default" type="file" id="LoadData" />
					<button class="btn btn-warning" id="Validar"><i class="fa fa-search"></i> Validar registro</button><br/>
					<button class="btn btn-primary" id="save"><i class="fa fa-save"></i> Guardar información</button>
					<div id="mytable"></div>
				</div>
			</div>
		</div>
	</div>
</div>
	<div id="log"></div>
@stop