
@extends('angular.frontend.master')
@section('title', 'Panel de control')
@section('content')
<script type="text/javascript" src="{{url('js/charts/highcharts.js')}}"></script>
<script type="text/javascript" src="{{url('js/charts/export-data.js')}}"></script>
<script type="text/javascript" src="{{url('js/charts/exporting.js')}}"></script>
<script type="text/javascript" src="{{url('js/charts/offline-exporting.js')}}"></script>

<script type="text/javascript" src="{{url('js/panel.control.js')}}?v=<?= date('YmdHis');?>"></script>

<link rel="stylesheet" type="text/css" href="{{url('css/panel.control.css')}}">
<div class="container-fluid">
	<div class="col-md-12">
		<ul id="tableactiondTab" class="nav nav-tabs">
			<li class="active">
				<a href="#table-table-tab" data-toggle="tab">Panel de control</a>
            </li>
        </ul>
        <div id="tableactionTabContent" class="tab-content">
            <div class="container-fluid">
            	<div class="container-fluid">
            	<div class="panel">
            		<div class="panel-body">
								<div class="row">
								<h2>{{$total}} Beneficiarios registrados</h2>
								</div>
						<div class="row">
							<div class="col-md-2">
								<a href="javascript:graf(1)"><img class="img-2" src="{{url('/data_icons/beneficiarios.png')}}" alt=""></a> 
								<label class="title-icon">Beneficiarios atendidos durante el año</label>
							</div>
							<div class="col-md-2">
								<a href="javascript:graf(2)"><img class="img-2" src="{{url('/data_icons/generos.png')}}" alt=""></a> <br>
								<label class="title-icon"> Genero</label>
							</div>
							<div class="col-md-2">
								<a href="javascript:graf(3)"><img class="img-2" src="{{url('/data_icons/escolaridad.png')}}"></a> <br>
								<label class="title-icon">Nivel de escolaridad</label>
							</div>
							<div class="col-md-2">
								<a href="javascript:graf(4)"><img class="img-2" src="{{url('/data_icons/comunas.png')}}"></a> <br>
								<label class="title-icon"> Comuna de residencia</label>
							</div>
							<div class="col-md-2">
								<a href="javascript:graf(5)"><img class="img-2" src="{{url('/data_icons/estratos.png')}}"></a> <br>
								<label class="title-icon">Estratos socioeconomicos</label>
							</div>
						</div>
						<div class="row">
							<div class="col-md-2">
								<a href="javascript:graf(6)"><img class="img-2" src="{{url('/data_icons/cobertura.png')}}"></a> <br>
								<label class="title-icon"> Cobertura por comuna de impacto</label>
							</div>
							<div class="col-md-2">
								<a href="javascript:graf(7)"><img class="img-2" src="{{url('/data_icons/disciplinas.png')}}"></a> <br>
								<label class="title-icon">Cobertura por disciplina</label>
							</div>
							<div class="col-md-2">
								<a href="javascript:graf(8)"><img class="img-2" src="{{url('/data_icons/etnicos.png')}}"></a> <br>
								<label class="title-icon">Etnias</label>
							</div>
							<div class="col-md-2">
								<a href="javascript:graf(9)"><img class="img-2" src="{{url('/data_icons/discapacidad.png')}}"></a> <br>
								<label class="title-icon">Discapacidad</label>
							</div>
							<div class="col-md-2">
								<a href="javascript:graf(10)"><img class="img-2" src="{{url('/data_icons/residencia.png')}}"></a> <br>
								<label class="title-icon">Corregimiento de residencia</label>
							</div>
						</div>
            		</div>
            	</div>
            </div>
			<!--MODAL-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#039be3;color:#FFF">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
	  <div class="container-fluid">
			<div class="col-md-12">
				<select class="form form-control" id="tipo_grafico">
					<option value="line">Lineas</option>
					<option value="pie">Torta</option>				
					<option value="spline">puntos</option>
					<option value="column">Columnas</option>
					<option value="bar">Barras</option>
					<option value="semi_pie">Torta</option>
				</select>
			</div>
			<div class="row">
			<div class="col-md-9">
				<div id="container_grafico">
					Cargando
					<img src="{{url('/images/loading.gif')}}" alt="">
				</div>
			</div>
			<div class="col-md-3">
				<div id="table_grafico">

				</div>
			</div>
			</div>
	  	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!--MODAL-->
            </div>
        </div>
    </div>
</div>
<style>
.col-md-2{
    text-align: center;
}


.modal-dialog {
  width: 98%;
  height: 92%;
  min-height: 92%;
  padding: 0;
}

.modal-content {
  height: 99%;
}
.modal-body{
  height: 80%;
}
.img-2
{
	width:50% !important;
} 
</style>
@stop