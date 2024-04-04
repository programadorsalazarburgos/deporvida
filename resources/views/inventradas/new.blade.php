@extends('angular.frontend.master')
@section('title', 'entrada de inventario')
@section('content')
<div class="container">
    <ul id="tableactiondTab" class="nav nav-tabs">
        <li class="active">
        	<a href="#table-table-tab" data-toggle="tab">Inventario Entrada</a>
        </li>
    </ul>
    <div id="tableactionTabContent" class="tab-content">
    	<div class="container-fluid">
    		<form>
	    		<div class="col-md-12">
	    			<label><i class="required">*</i> Fecha</label>
	    			<input type="" name="" class="form form-control">
	    		</div>
	    		<div class="col-md-12">
	    			<label><i class="required">*</i> Proveedor</label>
	    			<input type="" name="" class="form form-control">
	    		</div>
	    		<div class="col-md-12">
	    			<label><i class="required">*</i> Contrato</label>
	    			<input type="" name="" class="form form-control">
	    		</div>
	    		<div class="col-md-12">
	    			<label><i class="required">*</i> Observaciones</label>
	    			<textarea class="form form-control" rows="10"></textarea>
	    		</div>
	    		<table class="table">
	    			<thead>
	    				<thead>
	    					<th width="40%">Clasificacion</th>
	    					<th width="40%">Implemento</th>
	    					<th width="10%">Cantidad</th>
	    					<th width="10%">Borrrar</th>
	    				</thead>
	    			</thead>
	    			<tbody>
	    				<tr>
	    					<td>
	    						<select class="form form-control">
	    							
	    						</select>
	    					</td>
	    					<td>
	    						<select class="form form-control">
	    							
	    						</select>
	    					</td>
	    					<td>
	    						<input class="form form-control" min="0" type="number" name="">
	    					</td>
	    					<td>
	    						<button class="btn btn-danger"><i class="fa fa-trash"></i></button>
	    					</td>
	    				</tr>
	    			</tbody>
	    		</table>
	    		<div class="col-md-12 row" style="text-align: right;">
	    			<button class="btn btn-warning"><i class="fa fa-plus"></i> Agregar elemento</button>
	    		</div>
	    		<div class="col-md-12 row">
	    			<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Guardar</button>
	    		</div>
	    	</form>
	    </div>
    </div>
</div>
@stop