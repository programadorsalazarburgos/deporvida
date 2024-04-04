@extends('angular.frontend.master')
@section('title', 'entrada de inventario')
@section('content')
<script type="text/javascript" src="{{url('datatables/datatables.min.js')}}"></script>

<link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
<script type="text/javascript">
    function reporte()
    {
        $('#example').DataTable
	    	({
                "processing": true,
                destroy: true,
	        	//"serverSide": true,
                "ajax": base+"/postreporteindicadorestecnicos?"+$('form').serialize(),
                language: {
                "decimal": "",
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Entradas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
				"columns": [
                    { data: "nombre_evalucion", title: "nombre_evalucion" },
                    { data: "codigo_grupo", title: "codigo_grupo" },
                    { data: "disciplina", title: "disciplina" },
                    { data: "niveles", title: "niveles" },
                    { data: "comuna_impacto", title: "comuna_impacto" },
                    { data: "fecha", title: "fecha" },
                    { data: "beneficiario", title: "beneficiario" },
                    { data: "documento", title: "documento" },
                    { data: "edad", title: "edad" },
                    { data: "plazo_inicial", title: "plazo_inicial" },
                    { data: "plazo_final", title: "plazo_final" },
                    { data: "indicador_eje", title: "indicador_eje" },
                    { data: "indicador_nombre", title: "indicador_nombre" },
                    { data: "indicador_tipo", title: "indicador_tipo" },
                    { data: "decripcion", title: "decripcion" },
                    { data: "calificacion", title: "calificacion" },
                    { data: "observaciones", title: "observaciones" }
				    ]
	    	});
    }
    function descargar()
    {
        $.ajax({
            url:base+"/postreporteindicadorestecnicos",
            type:'GET',
            dataType:'json',
            data:$('form').serialize(),
            success:function(data)
            {
                var headers = { "nombre_evalucion": "nombre_evalucion" , "codigo_grupo": "codigo_grupo" , "disciplina": "disciplina" , "niveles": "niveles" , "comuna_impacto": "comuna_impacto" , "fecha": "fecha" , "beneficiario": "beneficiario" , "documento": "documento" , "edad": "edad" , "plazo_inicial": "plazo_inicial" , "plazo_final": "plazo_final" , "indicador_eje": "indicador_eje" , "indicador_nombre": "indicador_nombre" , "indicador_tipo": "indicador_tipo" , "decripcion": "decripcion" , "calificacion": "calificacion" , "observaciones": "observaciones" };
                exportCSVFile(headers, data.data, 'Indicadores tecnicos');
            }
        })
    }
	$(document).ready(function() 
	{
        
	});
	</script>
<div class="container">
    <ul id="tableactiondTab" class="nav nav-tabs">
        <li class="active">
        	<a href="#table-table-tab" data-toggle="tab">Reporte</a>
        </li>
    </ul>
    <div id="tableactionTabContent" class="tab-content">
        <div class="container-fluid">
            <form >
            <div class="col-md-4">
                <label>Comuna</label>
                <select name="comuna" id="comuna" class="form form-control">
                    <option value="">Seleccione</option>
                    @foreach($comunas as $temp)
                    <option value="{{$temp->id}}">{{$temp->nombre_comuna}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label>Disciplina</label>
                <select name="disciplina" id="disciplina" class="form form-control">
                    <option value="">Seleccione</option>
                    @foreach($disciplinas as $temp)
                        <option value="{{$temp->id}}">{{$temp->descripcion}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label>Indicador tipo</label>
                <select name="indicador" id="indicador" class="form form-control">
                    <option value="">Seleccione</option>
                    @foreach($indicadores as $temp)
                        <option value="{{$temp->tipo}}">{{$temp->tipo}}</option>
                    @endforeach
                </select>
            </div>
            <br>
            <br>
            <div class="col-md-12">
                <button type="button" class="btn btn-success" onclick="reporte()">Buscar</button>
                <button type="button" class="btn btn-success" onclick="descargar()">Descargar</button>
            </div>
            </form>
            

        </div>
    	<div class="container-fluid">
            <table id="example" class="display" style="width:100%">
            </table>
	    </div>
    </div>
</div>
@stop