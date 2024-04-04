@extends('angular.frontend.master')
@section('title', 'Listado de novedades')
@section('content')
<?php
$v='?v='.date('YmdHis');
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.16/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.16/datatables.min.js"></script>
<script type="text/javascript" src="js/jquery/jquery.printPage.js"></script>
<script type="text/javascript" src="{{url('')}}/js/novedades.metodologos.js"></script>
<div class="container">
    <ul id="tableactiondTab" class="nav nav-tabs">
        <li class="active"><a href="#table-table-tab" data-toggle="tab">Novedades<strong></strong></a></li>
    </ul>
    <div id="tableactionTabContent" class="tab-content">
    	
        <table id="table_novedades" class="table table-hover table-striped table-bordered table-advanced tablesorter">
        </table>
    </div>
</div>
@stop