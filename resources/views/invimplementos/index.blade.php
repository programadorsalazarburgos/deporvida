@extends('angular.frontend.master')
@section('title', 'Implementos deportivos')
@section('content')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.16/datatables.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.16/datatables.min.css"/>
<script type="text/javascript">
	$(function()
	{
		$('#implementos').DataTable(
			{
				language: {url: base + "/js/languages/datatable.Spanish.json"},
			});
	});
</script>
<div class="container">
    <ul id="tableactiondTab" class="nav nav-tabs">
        <li class="active">
        	<a href="#table-table-tab" data-toggle="tab">Implementos deportivos</a>
        </li>
    </ul>
    <div id="tableactionTabContent" class="tab-content">
    	<div class="container-fluid">
    		<div class="col-md-12">
                <a href="{{url('')}}/implementos/create"><button class="btn btn-primary"><i class="fa fa-plus"></i> Nuevo</button></a>
    			<table class="table" id="implementos">
    				<thead>
    					<th>Clasificacion</th>
    					<th>Implemento</th>
    					<th>Proveedor</th>
    					<th>Cantidad bodega</th>
    					<th>Opciones</th>
    				</thead>
    				<tbody>
		    			@foreach($data as $temp)
		    			<tr>
		    				<td>$temp->implemento</td>
		    				<td>$temp->proveedor</td>
		    				<td>$temp->cantidad_bodega</td>
		    				<td></td>
		    			</tr>
		    			@endforeach
    					
    				</tbody>
    			</table>
    		</div>
    	</div>
    </div>
</div>
@stop