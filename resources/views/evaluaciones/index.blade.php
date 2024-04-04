@extends('angular.frontend.master')
@section('title', 'Evaluaciones')
@section('content')
<style>
	.fstMultipleMode .fstQueryInput {
	font-size: 1em !important;
	margin: 0 0 0 0 !important;
	}
</style>
<link rel="stylesheet" href="{{url('/js/fastselect/fastselect.css')}}">
<script src="{{url('/js/fastselect/fastselect.standalone.js')}}"></script>
<script type="text/javascript" src="{{url('js/charts/highcharts.js')}}"></script>
<script src="{{url('js/evaluaciones.graficas.js')}}"></script>
<script type="text/javascript" src="{{url('datatables/datatables.min.js')}}"></script>
<link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
<div class="container">
	<ul id="tableactiondTab" class="nav nav-tabs">
		<li class="active">
			<a href="#table-table-tab" data-toggle="tab">Reporte</a>
		</li>
	</ul>
	<div id="tableactionTabContent" class="tab-content">
		<div class="container-fluid">
			<form id="render" action="{{url('/evaluaciones/index')}}" method="get">
				<div class="row">
                    
                <div class="col-md-3">
						<label>Disciplinas</label>
						<select class="form form-control multipleSelect"  id="id_disciplinas" name="id_disciplinas" required="required" >
                        <option value="">Seleccione</option>    
                        @foreach($Disciplinas as $temp)
							<option value="{{$temp->id}}">{{$temp->descripcion}}</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-3">
						<label>Tipo de evaluación</label>
						<select id="tipo" class="form form-control" >
							<option value="">Seleccione</option>
							@foreach($tipos as $temp)
							<option value="{{$temp->tipo}}">{{$temp->tipo}}</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-3">
						<label >Evaluación</label>
						<select required="required" class="form form-control" name="id_EvaluacionesPlazosyperiodos" id="id_EvaluacionesPlazosyperiodos">
							<option value="">Seleccione</option>
							@foreach($evaluaciones as $temp)
							<option data-tipo="{{$temp->tipo}}" value="{{$temp->id}}">{{$temp->nombre}}</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-3">
						<label> Tipo de grafico</label>    
						<select class="form form-control" id="grafico" required="required">
							<option value="">Seleccione</option>
							<option value="pie">Torta</option>
							<option value="line">Lineas</option>
							<option value="spline">puntos</option>
							<option value="column">Columnas</option>
							<option value="bar">Barras</option>
							<option value="semi_pie">Torta</option>
						</select>
                    </div>
                    
                </div>
                <div class="row">
                    <div  class="col-md-12">
                        <button type="submit" class="btn btn-success" ><i class="fa fa-search"></i> Buscar</button>
                        <a href="javascript:history.back(1)" type="submit" class="btn btn-orange"><i class="fa fa-reply-all"></i>&nbsp;&nbsp;Atras</a>
                    </div>
                </div>
            </form>
            <hr>
            <div class="row">
				<div id="graficar">
                </div>
			</div>
		</div>
	</div>
</div>
@stop