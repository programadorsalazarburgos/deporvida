@extends('angular.frontend.master')
@section('title', 'Registro de personal')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('datatables/datatables.min.css') }}"/>
<script type="text/javascript" src="{{ asset('datatables/datatables.min.js') }}"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>





<ul id="tableactiondTab" class="nav nav-tabs">
    <li class="active"><a href="#table-table-tab" data-toggle="tab">Registro del personal<strong></strong></a></li>
</ul>
<div id="tableactionTabContent" class="tab-content">
	<div id="log"></div>
	<div class="container-fluid">
		<form class="row" id="asistencias">
			<div class="col-md-6">
				<label>Fecha inicio</label>
				<input type="" name="inicio" class="fecha form form-control" value="{{$fi}}">	
			</div>
			<div class="col-md-6">
				<label>Fecha fin</label>
				<input type="" name="fin" class="fecha form form-control" value="{{$ff}}">
			</div>
			<div class="col-md-12">
				<button class="btn btn-primary"><i class="fa fa-search"></i> buscar</button>
			</div>
		</form>
<br>
<br>
<br>
		<div class="col-md-12">
			<div class="table-responsive">
			   	<table id="table_registros" class="table table-hover">
	        	</table>			
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	function cargarregistos(data)
	{
		$("#table_registros").DataTable ({
                    destroy: true,
                    language: {url: base + "/js/languages/datatable.Spanish.json"},
                    ajax:base+'/Horarios/informeasistenciasajax?'+data,
                    dom: 'Bfrtip',
			        buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                    "columns" : 
                    [
                        { data : "barrio", title: "Barrio"},
                        { data : "comuna", title: "Comuna"},
                        { data : "escenario", title: "Escenario"},
                        { data : "monitor", title: "Monitor"},
                        { data : "disciplina", title: "Disciplina"},
                        { data : "beneficiario", title: "Beneficiario"},
                        { data : "documento", title: "Documento"},
                        { data : "fecha_registro", title: "Registro"},
                        { data : "codigo_grupo", title: "Grupo"},
                        { data : "activo", title: "Estado grupo"},
                        { data : "clases_planeadas", title: "Clases programadas"},
                        { data : "beneficiario_asistencias_registrado", title: "Clases beneficiario"},
                        { data : "beneficiario_asistencias_asisitio", title: "Asistencias"},
                        { data : "beneficiario_asistencias_porcentaje", title: "Porcentaje"},
                    ]
                });
	}
	$(function()
	{
		$('.fecha').change(function()
		{
			console.log(base+'/Horarios/informeasistenciasajax?'+$('form').serialize());
		});
		$('form').submit(function(e)
		{
			e.preventDefault();
			swal('Reporte en proceso puede tardar unos minutos.');
			cargarregistos($(this).serialize());
		});
	});
</script>
@stop