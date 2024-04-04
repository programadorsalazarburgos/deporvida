@extends('angular.frontend.master')
@section('title', 'Prestamos')
@section('content')
<script type="text/javascript" src="{{url('/js/prestamos.create.js')}}<?php echo '?v='.date('YmdHis'); ?>"></script>
<div class="container">
    <ul id="tableactiondTab" class="nav nav-tabs">
        <li class="active">
        	<a href="#table-table-tab" data-toggle="tab">Prestamo Implementos Deportivos</a>
        </li>
    </ul>
    <div id="tableactionTabContent" class="tab-content">
    	<div class="container-fluid">
            <form id="prestamo_form">
                <div class="col-md-12">
                    <label><i class="required">*</i> Fecha</label>
                    <input type="date" name="fecha" id="fecha" class="fecha form form-control" value="<?php echo date('Y-m-d', strtotime(date('Y/m/d'))); ?>" />
                </div>
                <div class="col-md-4">
                    <label><i class="required">*</i> Cedula</label>
                    <input type="text" name="contratista_user_id" id="contratista_user_id" class="form form-control" />
                </div>
                <div class="col-md-8">
                    <label><i class="required"></i> Contratista</label>
                    <select name="user_id" id="user_id" class="form form-control select_user_id" data-usuarios="{{$usuarios}}" >
                        <option value="">Seleccionar</option>
                        @foreach($usuarios as $temp)
                        <option data-disciplinas="{{$temp->disciplinas}}" data-documento="{{$temp->documentos}}" data-comunas="{{$temp->comunas}}" value="{{$temp->id}}">
                            {{$temp->primer_nombre}} 
                            {{$temp->segundo_nombre}} 
                            {{$temp->primer_apellido}}
                            {{$temp->segundo_apellido}}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label><i class="required"></i>Comuna</label>
                    <input type="text" name="comuna"  id="comuna_id" class="form form-control"  />
                </div>
                <div class="col-md-6">
                    <label><i class="required"></i>Disciplina</label>
                    <input type="text" id="disciplina" name="disciplina" class="form form-control" readonly />
                </div>

                <div class="col-md-12">
                    <label><i class="required"></i> Observaciones</label>
                    <textarea name="observaciones" id="observaciones" rows="6" class="form form-control" required="required"> </textarea>
                </div>
                <div class="clearfix"></div>
                <br>
                
                <div id="clasificacion_section">
                    <div id="clasificacion_0">
                        <div class="col-md-4 text-right">
                            <strong>Clasificacion</strong>
                        </div>
                        <div class="col-md-6">
                            <select data-id="1" id="clasificacion_id_1" onchange="changeClasificacion(1)" class="clas_id form-control" >
                                <option value="">Seleccionar</option>
                                @foreach($clasificaciones as $temp)
                                <option value="{{$temp->id}}">{{$temp->nombre}}</option>
                                @endforeach
                            </select>         
                        </div>
                        <div id="implementos_1" class="implementos"></div>
                    </div>
                </div>

                <div class="clearfix"></div>
                <br>
                <div class="row">
                    <div class="col-md-6"  style="float: right;">
                        <button type="button" value="agrega_clasificacion" id="agrega_clasificacion" class="btn btn-warning"><i class="fa fa-plus"></i> Agregar Clasificacion</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <button id="submit_button" type="submit" class="btn btn-success" style="margin-left: 15px; "><i class="fa fa-save"></i> Guardar</button>
                    </div>
                </div>

            <form>
    	</div>
    </div>
</div>
@stop