@extends('angular.frontend.master')
@section('title', 'Nuevo proveedor')
@section('content')
<div class="container">
    <ul id="tableactiondTab" class="nav nav-tabs">
        <li class="active">
        	<a href="#table-table-tab" data-toggle="tab">Implementos deportivos</a>
        </li>
    </ul>
    <div id="tableactionTabContent" class="tab-content">
    	<div class="container-fluid">
            <legend>Implemento</legend>
            <form>
                <div class="col-md-12">
                    <label><i class="required">*</i> Clasificacion</label>
                    <select class="form form-control" required="required">
                        <option value="">seleccione</option>
                        @foreach($clasificacion as $temp)
                        <option value="{{$temp-id}}">{{$temp->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-8">
                    <label><i class="required">*</i> Nombre implemento</label>
                    <input type="text" class="form form-control" required="required"/>
                </div>
                <div class="col-md-4">
                    <label><i class="required">*</i> Cantidad inicial/Stock</label>
                    <input type="number" class="form form-control" required="required"/>
                </div>


                <div class="col-md-12">
                    <label><i class="required">*</i> Proveedor</label>
                    <select class="form form-control" required="required">
                        <option value="">seleccione</option>
                        @foreach($proveedor as $temp)
                        <option value="{{$temp-id}}">{{$temp->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-12">
                    <label><i class="required">*</i> Especificacion tecnica</label>
                    <textarea rows="10" class="form form-control" required="required"> </textarea>
                </div>

                <div class="col-md-12 row">
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Guardar</button>
                </div>
            <form>
    	</div>
    </div>
</div>
@stop