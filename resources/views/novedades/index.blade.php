@extends('angular.frontend.master')
@section('title', 'Novedades')
@section('content')
<?php
$v='?v='.date('YmdHis');
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.16/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.16/datatables.min.js"></script>
<script type="text/javascript" src="js/jquery/jquery.printPage.js"></script>
<script type="text/javascript" src="{{url('')}}/js/novedades.index.js"></script>
<div class="container">
    <ul id="tableactiondTab" class="nav nav-tabs">
        <li class="active"><a href="#table-table-tab" data-toggle="tab">Listado<strong></strong></a></li>
    </ul>
    <div id="tableactionTabContent" class="tab-content">
    	<a href="{{url('')}}/novedades/new" class="btn btn-primary">Nueva novedad</a>
        <table id="table_novedades" class="table table-hover table-striped table-bordered table-advanced tablesorter">
        </table>
    </div>
</div>
@stop