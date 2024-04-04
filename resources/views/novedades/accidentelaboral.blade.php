@extends('angular.frontend.master')
@section('title', 'Accidente laboral')
@section('content')
<?php
$v='?v='.date('YmdHis');
?>
<script type="text/javascript" src="{{url('')}}/js/novedades.accidentelaboral.js"></script>
<div class="container">
    <ul id="tableactiondTab" class="nav nav-tabs">
        <li class="active"><a href="#table-table-tab" data-toggle="tab">Novedades<strong></strong></a></li>
    </ul>
    <div id="tableactionTabContent" class="tab-content">
    	<div class="container-fluid">
    		<div class="col-md-12">
    			<label>Monitor</label>
    			<select class="form form-control">
    				@foreach($personal as $temp)
    				<option value="{{$temp->id_monitor}}">{{$temp->primer_nombre}} {{$temp->segundo_nombre}} {{$temp->primer_apellido}} {{$temp->segundo_apellido}} - {{$temp->numero_documento}}</option>
    				@endforeach
    			</select>
    		</div>
    	</div>
    </div>
</div>
@stop