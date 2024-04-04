@extends('angular.frontend.master')
@section('title', 'Crear DCP')
@section('content')
<style>
.btn-x{
    color: hsl(0, 0%, 100%) !important;
    background-color: hsl(2, 64%, 48%);
    cursor: pointer;
    border-color: hsl(2, 65%, 41%) !important;
}
</style>
<script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script>
<script type="text/javascript"></script>
<script type="text/javascript" src="{{url('/js/cuentacobro.editregistro.js')}}?v=<?=date('YmdHis')?>"></script>
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
						<input type="text" value="{{$cuota->cuota_numero}}" class="form form-control" readonly>
                        <input type="hidden" value="{{$cuota->id}}"  name="Cuota" id="Cuota" data-valor="{{$cuota->valor_cuota}}" data-saldo="{{$cuota->valor_saldo}}"/>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 control-label"><i class="text-danger">*</i> Fecha de transacción</label>
					<div class="col-sm-6">
						<input class="fecha form form-control" id="" value="{{$datos_cuenta_cobro->fecha_transaccion}}" title="La fecha de transacción es obligatoria" name="fecha_transaccion" required="required">
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 control-label"><i class="text-danger">*</i> No Planilla</label>
					<div class="col-sm-6">
						<input class="form  form-control" value="{{$datos_cuenta_cobro->planilla_numero}}" id="" title="El numero de planilla es obligatorio" name="Planilla" required="required"/>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 control-label"><i class="text-danger">*</i> Referencia Pago (PIN)</label>
					<div class="col-sm-6">
						<input class="form  form-control" id="" value="{{$datos_cuenta_cobro->pin_numero}}" title="El PIN es obligatorio" name="pin" required="required"/>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 control-label"><i class="text-danger">*</i> Operador</label>
					<div class="col-sm-8">
						<input class="form  form-control" id="" value="{{$datos_cuenta_cobro->operador}}" title="El nombre del operador es obligatorio" name="operador" required="required"/>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 control-label"><i class="text-danger">*</i> Fecha de pago</label>
					<div class="col-sm-6">
						<input class="fecha form form-control" id="" value="{{$datos_cuenta_cobro->fecha_pago}}" title="La fecha de pago es obligatoria" name="fecha_pago" required="required"/>
					</div>
                </div>
                <div class="form-group row">
					<label class="col-sm-4 control-label">Revaluación del contratista o prestador de servicios</label>
					<div class="col-sm-8">
						<input class="form form-control" id="" value="{{$datos_cuenta_cobro->revaluacion}}" name="revaluacion"/>
					</div>
                </div>
                
				<div class="form-group row">
					<label class="col-sm-2 control-label"><i class="text-danger">*</i> Periodo seguridad social</label>
					<div class="col-sm-4">
                    <select class="form form-control" id="" type="periodo_seguridad_social" name="periodo_seguridad_social" required="required">
							<option value="1"  {{$datos_cuenta_cobro->periodo_pago_seguridad_social==1  ?'selected':''}}>Enero</option>
							<option value="2"  {{$datos_cuenta_cobro->periodo_pago_seguridad_social==2  ?'selected':''}}>Febrero</option>
							<option value="3"  {{$datos_cuenta_cobro->periodo_pago_seguridad_social==3  ?'selected':''}}>Marzo</option>
							<option value="4"  {{$datos_cuenta_cobro->periodo_pago_seguridad_social==4  ?'selected':''}}>Abril</option>
							<option value="5"  {{$datos_cuenta_cobro->periodo_pago_seguridad_social==5  ?'selected':''}}>Mayo</option>
							<option value="6"  {{$datos_cuenta_cobro->periodo_pago_seguridad_social==6  ?'selected':''}}>Junio</option>
							<option value="7"  {{$datos_cuenta_cobro->periodo_pago_seguridad_social==7  ?'selected':''}}>Julio</option>
							<option value="8"  {{$datos_cuenta_cobro->periodo_pago_seguridad_social==8  ?'selected':''}}>Agosto</option>
							<option value="9"  {{$datos_cuenta_cobro->periodo_pago_seguridad_social==9  ?'selected':''}}>Septiembre</option>
							<option value="10" {{$datos_cuenta_cobro->periodo_pago_seguridad_social==10 ?'selected':''}}>Octubre</option>
							<option value="11" {{$datos_cuenta_cobro->periodo_pago_seguridad_social==11 ?'selected':''}}>Noviembre</option>
							<option value="12" {{$datos_cuenta_cobro->periodo_pago_seguridad_social==12 ?'selected':''}}>Diciembre</option>
						</select>
					</div>
					<label class="col-sm-1 control-label"><i class="text-danger">*</i> Año</label>
					<div class="col-sm-5">
						<select class="form form-control" id="" type="" name="periodo_seguridad_social_year" required="required">
							@for($i=2018;$i<(date('Y')+4);$i++)
							<option value="{{$i}}" {{$datos_cuenta_cobro->periodo_seguridad_social_year==$i?'selected':''}}>{{$i}}</option>
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
                        @foreach($fotos as $temp)
                        <div class="row" id="id_{{$temp->id}}">
                        <div class="col-sm-2">
                                <img src="{{$temp->url_imagen}}" />
                            </div>
                            <label class="col-sm-2 control-label"><i class="text-danger">*</i> Lugar // informe mensual</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                  <input class="form form-control" value="{{$temp->lugar}}" id="lugar" title="Lugar // informe mensual" name="edit[{{$temp->id}}]" required="required"/>
                                <span class="input-group-addon btn-x" onclick="eliminar({{$temp->id}})" >X</span>
                            </div>
                            </div>
                        </div>
                        @endforeach
    <hr>
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
						<textarea required="required" rows="12" class="form  form-control" id="textarea1" type="" name="tareas_mensuales"/>{{$datos_cuenta_cobro->tareas_informe_mensual}}</textarea>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 control-label"><i class="text-danger">*</i> Tareas del supervisor</label>
					<div class="col-sm-10">
						<textarea required="required" rows="12" class="form  form-control" id="textarea2" type="" name="tareas_supervisor"/>{{$datos_cuenta_cobro->tareas_supervisor}}</textarea>
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