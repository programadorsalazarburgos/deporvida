@extends('angular.frontend.master')
@section('title', 'Carga DCP')
@section('content')
	<script src="http://cdn.jsdelivr.net/npm/jquery-easy-loading/dist/jquery.loading.min.js" type="text/javascript"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.12.13/xlsx.full.min.js"></script>
	<style type="text/css">
		.table-responsive {
    width: 100%;
    margin-bottom: 15px;
    overflow-x: auto;
    overflow-y: hidden;
    -webkit-overflow-scrolling: touch;
    -ms-overflow-style: -ms-autohiding-scrollbar;
	</style>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs-3.3.7/dt-1.10.18/datatables.min.css"/>
	<script type="text/javascript" src="https://cdn.datatables.net/v/bs-3.3.7/dt-1.10.18/datatables.min.js"></script>
	<script src="{{url('')}}/js/cdp.cuentascobros.js"></script>
<div class="container">
    <ul id="tableactiondTab" class="nav nav-tabs">
        <li class="active"><a href="#table-table-tab" data-toggle="tab">Registro de contratos<strong></strong></a></li>
    </ul>
    <div id="tableactionTabContent" class="tab-content">
		<div class="container-fluid">
			<div class="col-md-12">
				<div class="table-responsiveno">
					<table id="mytable" class="table"></table>
				</div>
			</div>
		</div>
	</div>
</div>
@stop