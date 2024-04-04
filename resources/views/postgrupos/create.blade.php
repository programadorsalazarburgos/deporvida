<section class="content">
    <div class="row">
        <div class="col-md-12">
            <form class="form-horizontal" id="f1" name="frm" submit="submitForm()" novalidate>
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#details" data-toggle="tab" aria-expanded="false">
                                <span class="label label-success" id="codigo">Asignación Grupos</span> <span class="label label-primary" ng-model="codigo" id="codigo">Código Grupo: @{{ codigo_grupo}}</span>
                            </a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="resultados_ajax"></div>
                        <div class="tab-pane active" id="details">
                            <div class="clearfix"></div>
                            <br>

                            <div class="form-group">

                                <label class="col-sm-2 control-label">Monitores</label>
                                <div class="col-sm-8">
                                    <select name="monitores" ng-model="id_monitor" class="form-control" required style="width: 280px; position: relative; top: 6px">
                                        <option value="">Seleccione monitor</option>
                                        <option ng-repeat="data in monitores" value="@{{ data.id}}">
                                            @{{ data.primer_nombre}} @{{ data.segundo_nombre}} @{{ data.primer_apellido}} 
                                            @{{ data.segundo_apellido}}                                       </option>

                                    </select>
                                    <span class="label label-danger" ng-show="frm.id_monitor.$dirty && frm.id_monitor.$error.required">Requerido</span>
                                    <br>
                                </div>
                            </div>
                            <div class="form-group">

                                <label class="col-sm-2 control-label">Escenarios</label>
                                <div class="col-sm-8">
                                    <select name="id_escenario" ng-model="id_escenario" class="form-control" required style="width: 280px; position: relative; top: 6px">
                                        <option value="">Escenarios 1</option>
                                        <option value="">Escenarios 2</option>
                                        <option value="">Escenarios 3</option>
                                        <option value="">Escenarios 4</option>
                                        <option value="">Escenarios 5</option>
                                        <option value="">Escenarios 6</option>
                                        <option value="">Escenarios 7</option>
                                        <option value="">Escenarios 8</option>
                                    </select>
                                    <span class="label label-danger" ng-show="frm.id_monitor.$dirty && frm.id_monitor.$error.required">Requerido</span>
                                    <br>
                                </div>
                            </div>
                            <div class="form-group">

                                <label class="col-sm-2 control-label">Niveles</label>
                                <div class="col-sm-8">
                                    <select name="id_nivel" id="id_nivel" ng-model="id_nivel" class="form-control" required style="width: 280px; position: relative; top: 6px">
                                        <option value="">Nivel 1</option>
                                        <option value="">Nivel 2</option>
                                        <option value="">Nivel 3</option>
                                        <option value="">Nivel 4</option>


                                    </select>
                                    <span class="label label-danger" ng-show="frm.id_monitor.$dirty && frm.id_monitor.$error.required">Requerido</span>
                                    <br>
                                </div>
                            </div>
                            <div class="form-group">

                                <label class="col-sm-2 control-label">Disciplinas</label>
                                <div class="col-sm-8">
                                    <select  name="disciplina" nm-model="disciplina" class="form-control" required style="width: 280px; position: relative; top: 6px;">
                                        <option value="">Seleccione la disciplina</option>
                                        <option value="">Futbol</option>
                                        <option value="">Basket</option>
                                        <option value="">Natacion</option>
                                    </select>
                                    <span class="label label-danger" ng-show="frm.tip_sangre_persona.$dirty && frm.tip_sangre_persona.$error.required">Requerido</span>
                                    <br>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="note" class="col-sm-2 control-label">Observaciones</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" placeholder="Digita Observaciones" name="observaciones" ng-model="observaciones" required></textarea>
                                    <span class="label label-danger" ng-show="frm.observaciones.$dirty && frm.observaciones.$error.required">Requerido</span>
                                </div>
                            </div>
                            <h5><span class="label label-info">Ingrese Horario para este grupo</span></h5>
                            <hr/>
                            <table class="table">
                                <tr data-ng-repeat="dia in dias">
                                    <td>
                                        <label>
                                            <input type="checkbox" id="lunes" ng-model="checked" ng-change="avisar()" name="form_animal" class="micheckbox" value="1" />
                                            @{{dia.id}}
                                        </label>
                                    </td>
                                    <td>
                                <timepicker-pop input-time="dia.inicio" ng-show="checked" class="input-group"  ng-model="dia.inicio" show-meridian='showMeridian' ng-required="checked == true"> </timepicker-pop>
                                </td>
                                <td>
                                <timepicker-pop input-time="dia.fin" ng-show="checked" class="input-group" disabled="disabled" show-meridian='showMeridian' ng-model="dia.fin" ng-required="checked == true"> </timepicker-pop>
                                </td>
                                </tr>
                            </table>
                        </div>
                        <div class="clearfix"></div>
                        <br>
                        <div class="form-group">
                            <div class="col-sm-6">
                                <div ng-show="loading" id="cargando" class="loading"><img src="{{ asset('/images/cargando.gif')}}">LOADING...</div>
                                <div ng-repeat="car in cars">
                                    <li></li>
                                </div>

                                <button type="submit" class="btn btn-success" ng-click="formsubmit(frm.$valid)"  ng-disabled="frm.$invalid"><i class="fa fa-save"></i>&nbsp;&nbsp;Guardar Grupo</button>

                                <a href="{{url('/admin/postinstituciones#/admin/postinstituciones')}}" type="submit" class="btn btn-orange"><i class="fa fa-reply-all"></i>&nbsp;&nbsp;Atras</a>

                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
</form>
<div class="messages"></div><br /><br />
<!--div para visualizar en el caso de imagen-->
<div class="showImage"></div>
</div>
</div>
</section>
