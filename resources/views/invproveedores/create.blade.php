@extends('angular.frontend.master')
@section('title', 'Inventario fisico')
@section('content')
<div class="container">
    <ul id="tableactiondTab" class="nav nav-tabs">
        <li class="active">
        	<a href="#table-table-tab" data-toggle="tab">Inventario fisico</a>
        </li>
    </ul>
    <div id="tableactionTabContent" class="tab-content">
    	<div class="container-fluid">
	    	<form>
	    		<div class="col-md-12">
	    			<label>Fecha</label>
	    			<input type="" name="" class="fecha form form-control" >
	    		</div>
	    		<div class="col-md-12">
	    			<label>Responsable</label>
	    			<select class="form form-control">
	    				
	    			</select>
	    		</div>
	    		<div class="col-md-12">
	    			<label>Observaciones</label>
	    			<textarea class="form form-control" rows="10"></textarea>
	    		</div>
	    		<table class="table">
	    			<thead>
	    				<tr>
	    					<th>Clasificación</th>
	    					<th>Nombre implemento</th>
	    					<th>Proveedor</th>
	    					<th>Stock</th>
	    					<th>En fisico</th>
	    					<th>Diferencia</th>
	    				</tr>
	    			</thead>
	    			<tbody>
	    				@foreach($data as $temp)
	    				<tr>
	    					<td>Disciplina-{{$temp->disciplinas}}</td>
	    					<td>{{$temp->implementos}}</td>
	    					<td>{{$temp->proveedores}}</td>
	    					<td>{{$temp->stock}}</td>
	    					<td>
	    						<span class='number-wrapper'>
	    							<input type="number" data-value="{{$temp->stock}}" name="" id="fisico_{{$temp->id}}" data-id="{{$temp->id}}" class="form form-control fisico" value="{{$temp->stock}}"/>
	    						</span>
	    					</td>
	    					<td><span id="diferencia_{{$temp->id}}">0</span></td>
	    				</tr>
	    				@endforeach
	    			</tbody>
	    			<tfoot>
	    				
	    			</tfoot>
	    		</table>
	    		<div class="row col-md-12">
	    				<button class="btn btn-success"><i class="fa fa-save"></i> Guardar</button>
	    		</div>
	    	</form>
	    	<script type="text/javascript">
	    		function change_diferencia()
	    		{
	    			$('.fisico').change(function()
	    			{
	    				var value = parseInt($(this).val()) -parseInt($(this).attr('data-value'));
	    				var id = $(this).attr('data-id');
	    				console.log(value,id);
	    				$('#diferencia_'+id).html(value);
	    			});
	    		}
	    		$(function()
	    		{
	    			change_diferencia();
	    		});
	    	</script>
	    </div>
    </div>
</div>
@stop