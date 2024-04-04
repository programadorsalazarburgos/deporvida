@extends('angular.frontend.master')
@section('title', 'Registro de disciplinas')
@section('content')
<?php
$v='';//?v='.date('YmdHis');
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.16/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.16/datatables.min.js"></script>
<script type="text/javascript" src="js/jquery/jquery.printPage.js"></script>
<script type="text/javascript" src="js/disciplinas.listar.js<?= $v; ?>"></script>
<div class="row">

    <div class="col-md-3">Busqueda:
      <input type="text" id="search" placeholder="Buscar" class="form-control">
    </div>

<div class="col-md-4">
    <label for="search">Items por pagina:</label>
    <input type="number" value="50" min="1" max="10000" class="form-control" id="pagination_value">
  </div>

    <div class="col-md-5">
      <h5 class="ng-binding">Resultado  de <span class="count_datatable"></span> total Eps</h5>
    </div>
  </div>
<div class="container">

<ul id="tableactiondTab" class="nav nav-tabs">
    <li class="active"><a href="#table-table-tab" data-toggle="tab">Listado<strong></strong></a></li>
</ul>
<div id="tableactionTabContent" class="tab-content">
	<div class="container-fluid">
		<div class="col-lg-12">
			<h4 class="box-heading">Paginación</h4>
		</div>
		<div class="col-lg-12">
			<div class="pagination-panel ng-binding">Resultado  de <span class="count_datatable"></span> total disciplinas</div>
		</div>

		<div class="col-md-12">
			  <a href="disciplinas/crear" class="btn btn-info" id="nuevo"><i class="glyphicon glyphicon-plus"></i> Nuevo</a>
			  <br/>
			  <br/>
		</div>
		<div class="col-md-12">
			<table id="table_disciplina" width="100%" class="table table-hover table-striped table-bordered table-advanced tablesorter"></table>
		</div>
	</div>
</div>
</div>

@stop