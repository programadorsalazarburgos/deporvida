@extends('angular.frontend.master')
@section('title', 'Crear DCP')
@section('content')
<div class="container">
	<ul id="tableactiondTab" class="nav nav-tabs">
		<li class="active"><a href="#table-table-tab" data-toggle="tab">Ingrese su información<strong></strong></a></li>
	</ul>
	<div id="tableactionTabContent" class="tab-content">
		<div class="container-fluid">
            <h1>Este documento ya se encuentra <label class="label-success" style="color:#FFF">Aprobado</label> y no puede ser editado.</h1>
        </div>
	</div>
</div>
@stop