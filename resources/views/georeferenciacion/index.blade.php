@extends('angular.frontend.master')
@section('title', 'Reportes graficos por comuna')
@section('content')
<?php $v='?v='.date('YmdHis');?>
<script src="{{url('')}}/js/charts/highmaps.js"></script>
<script src="{{url('')}}/js/charts/exporting.js"></script>
<script src="{{url('')}}/js/charts/offline-exporting.js"></script>



<script src="{{url('')}}/js/georeferenciacion.index.js{{$v}}"></script>

<link rel="stylesheet" type="text/css" href="css/datepicker.css">
<link rel="stylesheet" type="text/css" href="css/fileinput.css">
<div class="container">
    <ul id="tableactiondTab" class="nav nav-tabs">
        <li class="active"><a href="#table-table-tab" data-toggle="tab">Reportes graficos por comuna<strong></strong></a></li>
    </ul>
    <div id="tableactionTabContent" class="tab-content">
    	<div id="container" style=" height: 600px;">
    		
    	</div>
    </div>
</div>
@stop
