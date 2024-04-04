@extends('angular.frontend.master')
@section('title', 'Carga DCP')
@section('content')
<script src="http://cdn.jsdelivr.net/npm/jquery-easy-loading/dist/jquery.loading.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.12.13/xlsx.full.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs-3.3.7/dt-1.10.18/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs-3.3.7/dt-1.10.18/datatables.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.0/js/bootstrap.min.js"></script>


<script src="{{url('')}}/js/cdp.miscuentas.js"></script>
<div class="container">
    <ul id="tableactiondTab" class="nav nav-tabs">
        <li class="active"><a href="#table-table-tab" data-toggle="tab">Registro de contratos<strong></strong></a></li>
    </ul>
    <div id="tableactionTabContent" class="tab-content">
		<div class="container-fluid">
			<div class="col-md-12">
					<a href="{{url('')}}/cpd/new" class="btn btn-primary"><i class="fa fa-plus"></i> Nuevo</a>
					<table id="mytable" class="table"></table>
			</div>
		</div>
	</div>
</div>
@stop