@extends('angular.frontend.master')
@section('title', 'Documentos')
@section('content')
<link rel="stylesheet" type="text/css" href="{{url('')}}/css/menuarbolaccesible.css"/>
<script type="text/javascript" src="{{url('')}}/js/menuarbolaccesible.js"></script>
<div class="container-fluid">
    <div class="col-md-12">
        <ul id="tableactiondTab" class="nav nav-tabs">
            <li class="active">
                <a href="#table-table-tab" data-toggle="tab">Documentos</a>
            </li>
        </ul>
        <div id="tableactionTabContent" class="tab-content">
            <div class="container-fluid">
            	<div id="menu_archivos">
	                <!-- DATA  ELFINDER -->
	                <?= html_entity_decode($archivos);?>
	                <!-- EL FINDER -->
            	</div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
	iniciaMenu('miMenu');
</script>
@stop