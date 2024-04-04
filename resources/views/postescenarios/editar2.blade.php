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
                        <div class="nav-tabs-custom">
                            <input type="hidden" name="id" id="id" value=""/>
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#details" data-toggle="tab" aria-expanded="false">Formulario Crear Escenario</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="resultados_ajax"></div>
                                <div class="tab-pane active" id="details">
                                    <div class="clearfix"></div>
                                    <br>
                                    <div class="form-group">
                                        <label for="note" class="col-sm-2 control-label">Tipo Escenario</label>
                                        <div class="col-sm-6">
                                            <select name="tipoescenario" id="tipoescenario_id" ng-model="tipoescenario" class="form-control" >
                                                <option value="">Seleccione Tipo Escenario</option>
                                                <option ng-repeat="tipoescenario in tipoescenarios" value="@{{ tipoescenario.id}}">
                                                    @{{ tipoescenario.nombre_tipo_escenario}}
                                                </option>
                                            </select>
                                            <span class="label label-danger" ng-show="frm.tipoescenario.$dirty && frm.tipoescenario.$error.required">Requerido</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="note" class="col-sm-2 control-label">Nombre Escenario</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" placeholder="Digita Nombre Escenario" name="nombre_escenario" id="nombre_escenario" ng-model="nombre_escenario" ></input>
                                            <span class="label label-danger" ng-show="frm.nombre_escenario.$dirty && frm.nombre_escenario.$error.required">Requerido</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="note" class="col-sm-2 control-label">Corregimiento</label>
                                        <div class="col-sm-8">
                                            <select id="id_corregimiento" name="id_corregimiento" class="form form-control">

                                                <option value="">Seleccione</option>
                                                @foreach($corregimiento as $temp)
                                                <option value="{{$temp->id}}">{{$temp->descripcion}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="note" class="col-sm-2 control-label">Vereda</label>
                                        <div class="col-sm-8">
                                            <select id="id_vereda" name="id_vereda" class="form form-control">
                                            </select>
                                        </div>
                                    </div>
                                    <div id="hide_divs">
                                        <div class="form-group">
                                            <label for="note" class="col-sm-2 control-label">Barrio</label>
                                            <div class="col-sm-8">
                                                <select id="id_barrio" name="id_barrio" class="form form-control">
                                                    <option ng-repeat="barrios in data_barrios" value="@{{barrios.id}}">
                                                        @{{barrios.nombre_barrio}}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="note" class="col-sm-2 control-label">Direccion</label>
                                            <div class="col-md-4">
                                                <input placeholder="direccion" class="direcciones form form-control" id="direccion" name="direccion"/>
                                            </div>
                                            <div class="col-md-4">
                                                <input placeholder="complemento de la direccion" class="direcciones form form-control" id="complemento" name="complemento"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="note" class="col-sm-2 control-label">Descripción</label>
                                        <div class="col-sm-8">
                                            <textarea class="form-control" placeholder="Digita descripción" name="descripcion" id="descripcion" ng-model="descripcion" ></textarea>
                                            <span class="label label-danger" ng-show="frm.descripcion.$dirty && frm.descripcion.$error.required">Requerido</span>
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
                                            </table>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <br>
                                    <div class="form-group">
                                        <div class="col-sm-6">
                                            <div ng-show="loading" id="cargando" class="loading"><img src="{{ asset('/images/cargando.gif')}}">LOADING...</div>
                                            <div ng-repeat="car in cars">
                                                <li></li>
                                            </div>
                                            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp;&nbsp;Guardar Escenario</button>
                                            <a href="{{url('/admin/postescenarios#/admin/postescenarios')}}" type="submit" class="btn btn-orange"><i class="fa fa-reply-all"></i>&nbsp;&nbsp;Atras</a>
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
