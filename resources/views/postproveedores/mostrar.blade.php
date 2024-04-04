@extends('angular.frontend.master')
@section('title', 'Información del proveedor')
@section('content')

<style>
.code {
height: 80px !important;
}

</style>

<div class = 'container'>
<div class="content-wrapper">

<div class="row">

<div class="col-md-12">
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#details" data-toggle="tab" aria-expanded="false">Información del Proveedor</a></li>
    </ul>
    <div class="tab-content">
        <div id="resultados_ajax"></div>
        <div class="tab-pane active" id="details">
            <div class="clearfix"></div>
            <br>
            <fieldset>
                <div class="col-md-12">
                    <span class="text-danger">*</span>
                    <label class="control-label" for="proveedor-nombre">Nombre</label>
                    <input value="{{ $proveedor->nombre }}"  type="text" title="Solo texto" id="nombre" class="form-control" name="nombre" maxlength="200" required="true" readonly="true" />
                </div>              
                <div class="col-md-6">
                    <label class="control-label" for="proveedor-telefono">Telefono</label>
                    <input value="{{ $proveedor->telefono }}"  type="text" title="Solo texto" id="telefono" class="form-control" name="telefono" maxlength="20" readonly="true" >
                </div>
                <div class="col-md-6">
                    <label class="control-label" for="proveedor-correo">Correo Electrónico</label>
                    <input value="{{ $proveedor->correo }}"  type="email" title="Solo texto" id="correo" class="form-control" name="correo" maxlength="100" readonly="true">
                </div>
                <div class="col-md-12">
                    <label class="control-label" for="proveedor-direccion">Dirección</label>
                    <input value="{{ $proveedor->direccion }}"  type="text" title="Solo texto" id="direccion" class="form-control" name="direccion" maxlength="60" readonly="true">
                </div>
                <div class="col-md-12">
                    <label class="control-label" for="proveedor-observaciones">Observaciones</label>
                    <input value="{{ $proveedor->observaciones }}"  type="text" title="Solo texto" id="observaciones" class="form-control" name="observaciones" maxlength="250" readonly="true">
                </div>

                <div class="clearfix"></div>
                <br>
                <div class="col-md-12">
                    <div class="table">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Contrato No.</th>
                                    <th>Descripción</th>
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($contratos as $temp)
                                <tr>
                                    <td>{{$temp->no}}</td>
                                    <td>{{$temp->descripcion}}</td>
                                    <td>{{$temp->fecha}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>    
                    </div>
                </div>         

                <div class="clearfix"></div>
                <br>

                <a href="{{url('/admin/proveedor')}}" type="submit" class="btn btn-orange"><i class="fa fa-reply-all"></i>&nbsp;&nbsp;Atras</a>
            </fieldset>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>

@stop