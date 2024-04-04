@extends('angular.frontend.master')
@section('title', 'Crear DCP')
@section('content')
<script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script>
<script type="text/javascript"></script>
<script type="text/javascript" src="{{url('/js/cuentacobro.registro.js')}}?v=<?=date('YmdHis')?>"></script>
<div class="container">
	<ul id="tableactiondTab" class="nav nav-tabs">
		<li class="active"><a href="#table-table-tab" data-toggle="tab">Ingrese su información<strong></strong></a></li>
	</ul>
	<div id="tableactionTabContent" class="tab-content">
		<div class="container-fluid">
			<form class="form-horizontal" id="form">
				<div class="form-group row">
					<label class="col-sm-2 control-label">Cuota número</label>
					<div class="col-sm-6">
						<select class="form  form-control" id="Cuota" type="" name="Cuota">
							@foreach($cuotas as $temp)
							<option value="{{$temp->id}}" data-valor="{{$temp->valor_cuota}}" data-saldo="{{$temp->valor_saldo}}">{{$temp->cuota_numero}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 control-label"><i class="text-danger">*</i> Fecha de transacción</label>
					<div class="col-sm-6">
						<input class="fecha form form-control" id="" title="La fecha de transacción es obligatoria" name="fecha_transaccion" required="required">
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 control-label"><i class="text-danger">*</i> No Planilla</label>
					<div class="col-sm-6">
						<input class="form  form-control" id="" title="El numero de planilla es obligatorio" name="Planilla" required="required"/>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 control-label"><i class="text-danger">*</i> Referencia Pago (PIN)</label>
					<div class="col-sm-6">
						<input class="form  form-control" id="" title="El PIN es obligatorio" name="pin" required="required"/>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 control-label"><i class="text-danger">*</i> Operador</label>
					<div class="col-sm-8">
						<input class="form  form-control" id="" title="El nombre del operador es obligatorio" name="operador" required="required"/>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 control-label"><i class="text-danger">*</i> Fecha de pago</label>
					<div class="col-sm-6">
						<input class="fecha form form-control" id="" title="La fecha de pago es obligatoria" name="fecha_pago" required="required"/>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-4 control-label">Revaluación del contratista o prestador de servicios</label>
					<div class="col-sm-8">
						<input class="form form-control" name="revaluacion"/>
					</div>
                </div>
				<div class="form-group row">
					<label class="col-sm-2 control-label"><i class="text-danger">*</i> Periodo seguridad social</label>
					<div class="col-sm-4">
						<select class="form form-control" id="" type="periodo_seguridad_social" name="periodo_seguridad_social" required="required">
							<option value="1">Enero</option>
							<option value="2">Febrero</option>
							<option value="3">Marzo</option>
							<option value="4">Abril</option>
							<option value="5">Mayo</option>
							<option value="6">Junio</option>
							<option value="7">Julio</option>
							<option value="8">Agosto</option>
							<option value="9">Septiembre</option>
							<option value="10">Octubre</option>
							<option value="11">Noviembre</option>
							<option value="12">Diciembre</option>
						</select>
					</div>
					<label class="col-sm-1 control-label"><i class="text-danger">*</i> Año</label>
					<div class="col-sm-5">
						<select class="form form-control" id="" type="" name="periodo_seguridad_social_year" required="required">
							@for($i=2018;$i<(date('Y')+4);$i++)
							<option value="{{$i}}">{{$i}}</option>
							@endfor
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-primary">
						<div class="panel-heading">
							<button class="btn btn-danger" type="button" onclick="other_photo()"><i class="fa fa-plus"></i></button> Subir fotos
						</div>
						<div class="panel-body">
						<div id="photos">
						</div>
						</div>
					</div>
				</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-12">
						<div class="col-sm-2">
							<select name="retencion_periodo" class="form form-control">
							<option value="0">NO</option>
							<option value="1">SI</option>
							</select>
						</div>
						<label class="col-sm-10 control-label">RECIBO DE CONSIGNACIÓN EN MI CUENTA DE APOYO AL FOMENTO DE LA CONSTRUCCIÓN AFC DEL PERIODO DE LA CUOTA.</label>
					</div>
				</div>
				


				<div class="form-group row">
					<div class="col-sm-12">
						<div class="col-sm-2">
						<select name="retencion_pensiones" class="form form-control">
						<option value="0">NO</option>
						<option value="1">SI</option>
						</select>
						</div>
						<label class="col-sm-10 control-label">RECIBO DE CONSIGNACIÓN EN MI CUENTA DEL FONDO DE PENSIONES VOLUNTARIAS DEL PERIODO DE LA CUOTA.</label>
					</div>
				</div>
			
				<div class="form-group row">
					<label class="col-sm-2 control-label"><i class="text-danger">*</i> Tareas mensuales</label>
					<div class="col-sm-10">
						<textarea required="required" rows="12" class="form  form-control" id="textarea1" type="" name="tareas_mensuales"/>{{$tareas_mensuales}}</textarea>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 control-label"><i class="text-danger">*</i> Tareas del supervisor</label>
					<div class="col-sm-10">
						<textarea required="required" rows="12" class="form  form-control" id="textarea2" type="" name="tareas_supervisor"/>{{$tareas_supervisor}}</textarea>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 control-label"><i class="text-danger">*</i> Objeto del contrato</label>
					<div class="col-sm-10">
						{{$objeto_contrato}}
						<input type="hidden" name="objeto_contrato" value="{{$objeto_contrato}}"/>
					</div>
				</div>
				<div class="row" id="informes">
					<div class="panel panel-default">
						<div class="panel-heading">Informes generados</div>
						<div class="panel-body">
							<a target="_blank" href="#" id="inf1" class="btn btn-primary"><i class="fa fa-download" aria-hidden="true"></i></a> Documento equivalente <br/>
							<a target="_blank" href="#" id="inf2" class="btn btn-primary"><i class="fa fa-download" aria-hidden="true"></i></a> Informe parcial <br/>
							<a target="_blank" href="#" id="inf3" class="btn btn-primary"><i class="fa fa-download" aria-hidden="true"></i></a> Informe mensual <br/>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="form-group">
					<div class="col-sm-6">
						<button type="submit" id="save" class="btn btn-success">
						<i class="fa fa-save"></i>&nbsp;&nbsp;Guardar
						</button>
						<a href="javascript:history.back()" class="btn btn-orange">
						<i class="fa fa-reply-all"></i>&nbsp;&nbsp;Atras
						</a>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@stop