@extends('angular.frontend.master')
@section('title', 'Escenarios')
@section('content')
<script type="text/javascript" src="{{url('')}}/js/functions.js"></script>
<script type="text/javascript" src="{{url('')}}/js/GeneratorAdd.js"></script>
<script type="text/javascript" src="{{url('')}}/js/escenario.editar.js"></script>
<style>
    .code {
        height: 80px !important;
    }
    textarea.ng-invalid.ng-dirty{border:1px solid red;}
    select.ng-invalid.ng-dirty{border:1px solid red;}
    option.ng-invalid.ng-dirty{border:1px solid red;}
    input.ng-invalid.ng-dirty{border:1px solid red;}

</style>
<div class="container">
    <div class="clearfix"></div>
    <br>
    <div class="content-wrapper">
        <section class="content-header">
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-10">
                    <form action="save/editar-escenario" class="form-horizontal" id="form_edit_escenario" name="frm" novalidate>
                        <input type="hidden" name="id" id="id" value="{{request()->route('id')}}">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#details" data-toggle="tab" aria-expanded="false">Formulario editar escenario</a></li>
                            </ul>
                            <div class="tab-content">
                                
                                    <div id="resultados_ajax"></div>
                                    <div class="tab-pane active" id="details">
                                        <div class="clearfix"></div>
                                        <br>
                                        <div class="form-group">
                                            <label for="note" class="col-sm-2 control-label">Tipo Escenario</label>
                                            <div class="col-sm-6">
                                                <select name="tipoescenario" id="tipoescenario_id"  class="form-control" required="required">
                                                    <option value="">Seleccione Tipo Escenario</option>
                                                    @foreach($tipos_escenarios as $temp)
                                                    <option value="{{$temp->id}}"
                                                        @if ( $id_tipo_escenario  == $temp->id )
                                                        selected
                                                        @endif
                                                        >
                                                        {{$temp->nombre_tipo_escenario}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                <span class="label label-danger required-label" data-required="tipoescenario_id">Requerido</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="note" class="col-sm-2 control-label">Nombre Escenario</label>
                                            <div class="col-sm-8">
                                                <input value="{{$nombre_escenario}}" class="form-control" placeholder="Digita Nombre Escenario" name="nombre_escenario" id="nombre_escenario" required="required"></input>
                                                <span class="label label-danger required-label" data-required="nombre_escenario">Requerido</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="note" class="col-sm-2 control-label">Corregimiento</label>
                                            <div class="col-sm-8">
                                                <select id="id_corregimiento" name="id_corregimiento" class="form form-control">
                                                    <option value="">Seleccione</option>
                                                    @foreach($corregimientos as $temp)
                                                    <option value="{{$temp->id}}" {{$temp->id==$id_corregimiento?'selected':''}}>
                                                        {{$temp->descripcion}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="note" class="col-sm-2 control-label">Vereda</label>
                                            <div class="col-sm-8">
                                                <select id="id_vereda" name="id_vereda" class="form form-control">
                                                    @foreach($veredas as $temp)
                                                    <option value="{{$temp->id}}">{{$temp->nombre}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div id="hide_divs">
                                            <div class="form-group">
                                                <label for="note" class="col-sm-2 control-label">Barrio</label>
                                                <div class="col-sm-8">
                                                    <select id="id_barrio" name="id_barrio" class="form form-control">
                                                        @foreach($barrios as $temp)
                                                        <option  value="{{$temp->id}}"
                                                            @if($temp->id == $id_barrio)
                                                            selected
                                                            @endif
                                                            >
                                                            {{$temp->nombre_barrio}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="note" class="col-sm-2 control-label">Direccion</label>
                                                <div class="col-md-4">
                                                    <input value="{{$direccion}}" placeholder="direccion" class="direcciones form form-control" id="direccion" name="direccion"/>
                                                </div>
                                                <div class="col-md-4">
                                                    <input value="{{$direccion_complemento}}" placeholder="complemento de la direccion" class="direcciones form form-control" id="complemento" name="complemento"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="note" class="col-sm-2 control-label">Descripción</label>
                                            <div class="col-sm-8">
                                                <textarea class="form-control" placeholder="Digita descripción" name="descripcion" id="descripcion" required="required">{{$descripcion}}</textarea>
                                                <span class="label label-danger required-label" data-required="descripcion">Requerido</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="note" class="col-sm-2 control-label">Equipamiento</label>
                                            <button type="button" onclick="tipoesequipamientos()" class="btn btn-success">Agregar +</button>
                                            <div class="col-md-12">
                                                <table class="table table-hover">
                                                    <tr>
                                                        <td>Descripcion</td>
                                                        <td>Cantidad</td>
                                                        <td>Opciones</td>
                                                    </tr>
                                                    <tr id="new_equipamento"></tr>
                                                    @for($i=0; $i<count($equipamentos); $i++)
                                                        <tr id="remove_{{($i+1)}}" class="data_equipamiento">
                                                            <td>
                                                                <select class="form form-control" name="escenario[tipo][]">
                                                                    @foreach($tipos_equipamentos as $temp)
                                                                    <option value="{{$temp->id}}"
                                                                        @if($temp->id==$equipamentos[$i]->id)
                                                                        selected
                                                                        @endif
                                                                        >{{$temp->descripcion}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <input class="form form-control" value="{{$equipamentos[$i]->cantidad}}" name="escenario[cantidad][]">
                                                            </td>
                                                            <td>
                                                                <button class="delete_button btn btn-danger" type="button" onclick="remove_table({{($i+1)}})">
                                                                    <i class="fa fa-times" aria-hidden="true"></i> Eliminar
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @endfor
                                                </table>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>.
                                        <br>
                                        <div class="form-group">
                                        <div class="col-sm-6">
                                            <button type="submit" class="btn btn-success">
                                                <i class="fa fa-save"></i>&nbsp;&nbsp;Guardar Escenario</button>
                                            <a href="{{url('')}}/admin/postescenarios#/admin/postescenarios" class="btn btn-orange"><i class="fa fa-reply-all"></i>&nbsp;&nbsp;Atras</a>
                                        </div>
                                    </div>
                                       
                                    </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="messages"></div>
            <br/>
            <br/>
            <div class="showImage"></div>
        </section>
    </div>
</div>
@stop