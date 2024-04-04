<style>
    .code {
        height: 80px !important;
    }
    input,select{text-transform:uppercase;}
    textarea.ng-invalid.ng-dirty{border:1px solid red;}
    select.ng-invalid.ng-dirty{border:1px solid red;}
    option.ng-invalid.ng-dirty{border:1px solid red;}
    input.ng-invalid.ng-dirty{border:1px solid red;}

</style>
<div class = 'container'>
    <div class="clearfix"></div>
    <br>
    <div class="content-wrapper">
        <section class="content">
            <div class="row">

                <div class="col-md-11">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#details" data-toggle="tab" aria-expanded="false">Formulario Creación Usuario</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="resultados_ajax"></div>
                            <div class="tab-pane active" id="details">
                                <div class="clearfix"></div>
                                <br>
                                <form class="form-horizontal" id="f1" name="frm" submit="submitForm()" novalidate>


                                    <div class="form-group">
                                        <label for="note" class="col-sm-2 control-label"><i style="color:red;">*</i> Número de Documento</label>
                                        <div class="col-sm-8">
                                            <input required="true" class="form-control" placeholder="Digita Número de Documento" type="text" name="integer-data-attribute" data-thousands="," ng-blur="onBlurDocumento($event)" ng-model="numero_documento" required="true" />
                                            <span class="label label-danger" ng-show="frm.numero_documento.$dirty && frm.numero_documento.$error.required">Requerido</span>
                                            <div id="repetido_documento">
                                            </div> 
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="note" class="col-sm-2 control-label"><i style="color:red;">*</i> Primer Nombre</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" placeholder="Digita Primer Nombre" name="primer_nombre" ng-model="primer_nombre" required="true"/>
                                            <span class="label label-danger" ng-show="frm.primer_nombre.$dirty && frm.primer_nombre.$error.required">Requerido</span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="note" class="col-sm-2 control-label"><i style="color:red;">*</i> Segundo Nombre</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" placeholder="Digita Segundo Nombre" name="segundo_nombre" ng-model="segundo_nombre" required="true"/>
                                            <span class="label label-danger" ng-show="frm.segundo_nombre.$dirty && frm.segundo_nombre.$error.required">Requerido</span>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="note" class="col-sm-2 control-label"><i style="color:red;">*</i> Primer Apellido</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" placeholder="Digita Primer Apellido" name="primer_apellido" ng-model="primer_apellido" required="true"/>
                                            <span class="label label-danger" ng-show="frm.primer_apellido.$dirty && frm.primer_apellido.$error.required">Requerido</span>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="note" class="col-sm-2 control-label"><i style="color:red;">*</i> Segundo Apellido</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" placeholder="Digita Segundo Apellido" name="segundo_apellido" ng-model="segundo_apellido" required="true"/>
                                            <span class="label label-danger" ng-show="frm.segundo_apellido.$dirty && frm.segundo_apellido.$error.required">Requerido</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="note" class="col-sm-2 control-label"><i style="color:red;">*</i> Tipo Documento</label>
                                        <div class="col-sm-8">
                                            <select name="tipo" ng-model="tipo_documento_usuario" class="form-control" required="true">
                                                <option>Seleccione Tipo Documento</option>
                                                <option ng-repeat="tipo in tipo_documento" value="@{{tipo.id}}">@{{tipo.descripcion}}</option>
                                            </select>
                                            <span class="label label-danger" ng-show="frm.tipo_documento_usuario.$dirty && frm.tipo_documento_usuario.$error.required">Requerido</span>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <span style="color:red;"><strong>*</strong></span> Son obligatorios<table class="controlesDireccion" border="0">
                                                    <tbody>
                                                        <tr>
                                                            <td colspan="10">Ejemplo</td>
                                                        </tr>
                                                        <tr></tr>
                                                        <tr class="trEjemploDireccion">
                                                            <td><span style="color:red;"><strong>*</strong></span>Dg</td>
                                                            <td><span style="color:red;"><strong>*</strong></span>84</td>
                                                            <td>B</td>
                                                            <td>Bis</td>
                                                            <td>A</td>
                                                            <td>Sur</td>
                                                            <td><span style="color:red;"><strong>*</strong></span>No.8</td>
                                                            <td>B</td>
                                                            <td>62</td>
                                                            <td>Este</td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <select class="formlista form form-controll" size="1">
                                                                    <option value="" selected="selected">Escoja una Opción</option>
                                                                    <option value="AC">Avenida calle</option>
                                                                    <option value="AK">Avenida carrera</option>
                                                                    <option value="CL">Calle</option>
                                                                    <option value="KR">Carrera</option>
                                                                    <option value="DG">Diagonal</option>
                                                                    <option value="TV">Transversal</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <input type="number" title="Acepta solo números." class="formlista form form-controll" size="3" maxlength="3">
                                                            </td>
                                                            <td>
                                                                <select class="formlista form form-controll" id="letraViaPrincipal" size="1">
                                                                    <option value="" selected="selected"></option>
                                                                    <option value="A">A</option>
                                                                    <option value="B">B</option>
                                                                    <option value="C">C</option>
                                                                    <option value="D">D</option>
                                                                    <option value="E">E</option>
                                                                    <option value="F">F</option>
                                                                    <option value="G">G</option>
                                                                    <option value="H">H</option>
                                                                    <option value="I">I</option>
                                                                    <option value="J">J</option>
                                                                    <option value="K">K</option>
                                                                    <option value="L">L</option>
                                                                    <option value="M">M</option>
                                                                    <option value="N">N</option>
                                                                    <option value="O">O</option>
                                                                    <option value="P">P</option>
                                                                    <option value="Q">Q</option>
                                                                    <option value="R">R</option>
                                                                    <option value="S">S</option>
                                                                    <option value="T">T</option>
                                                                    <option value="U">U</option>
                                                                    <option value="V">V</option>
                                                                    <option value="W">W</option>
                                                                    <option value="X">X</option>
                                                                    <option value="Y">Y</option>
                                                                    <option value="Z">Z</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <select class="formlista form form-controll" size="1">
                                                                    <option value="" selected="selected"></option>
                                                                    <option value="BIS">BIS</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <select class="formlista form form-controll" id="letraBis" size="1">
                                                                    <option value="" selected="selected"></option>
                                                                    <option value="A">A</option>
                                                                    <option value="B">B</option>
                                                                    <option value="C">C</option>
                                                                    <option value="D">D</option>
                                                                    <option value="E">E</option>
                                                                    <option value="F">F</option>
                                                                    <option value="G">G</option>
                                                                    <option value="H">H</option>
                                                                    <option value="I">I</option>
                                                                    <option value="J">J</option>
                                                                    <option value="K">K</option>
                                                                    <option value="L">L</option>
                                                                    <option value="M">M</option>
                                                                    <option value="N">N</option>
                                                                    <option value="O">O</option>
                                                                    <option value="P">P</option>
                                                                    <option value="Q">Q</option>
                                                                    <option value="R">R</option>
                                                                    <option value="S">S</option>
                                                                    <option value="T">T</option>
                                                                    <option value="U">U</option>
                                                                    <option value="V">V</option>
                                                                    <option value="W">W</option>
                                                                    <option value="X">X</option>
                                                                    <option value="Y">Y</option>
                                                                    <option value="Z">Z</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <select title="&quot;Este&quot;, correponde al Occidente" class="formlista form form-controll" size="1">
                                                                    <option value="" selected="selected"></option>
                                                                    <option value="SUR">SUR</option>
                                                                    <option value="ESTE">ESTE</option>
                                                                </select>
                                                            </td>
                                                            <td>No. 
                                                                <input type="number" title="Acepta solo números." class="formlista form form-controll" size="3" maxlength="3" "="">
                                                            </td>
                                                            <td>
                                                                <select class="formlista form form-controll" id="letraViaGeneradora" size="1">
                                                                    <option value="" selected="selected"></option>
                                                                    <option value="A">A</option>
                                                                    <option value="B">B</option>
                                                                    <option value="C">C</option>
                                                                    <option value="D">D</option>
                                                                    <option value="E">E</option>
                                                                    <option value="F">F</option>
                                                                    <option value="G">G</option>
                                                                    <option value="H">H</option>
                                                                    <option value="I">I</option>
                                                                    <option value="J">J</option>
                                                                    <option value="K">K</option>
                                                                    <option value="L">L</option>
                                                                    <option value="M">M</option>
                                                                    <option value="N">N</option>
                                                                    <option value="O">O</option>
                                                                    <option value="P">P</option>
                                                                    <option value="Q">Q</option>
                                                                    <option value="R">R</option>
                                                                    <option value="S">S</option>
                                                                    <option value="T">T</option>
                                                                    <option value="U">U</option>
                                                                    <option value="V">V</option>
                                                                    <option value="W">W</option>
                                                                    <option value="X">X</option>
                                                                    <option value="Y">Y</option>
                                                                    <option value="Z">Z</option>
                                                                </select>
                                                            </td>
                                                            <td>- 
                                                                <input type="number" min="1" title="Acepta solo números." class="formlista form form-controll" size="3" maxlength="3">
                                                            </td>
                                                            <td>
                                                                <select class="formlista form form-controll" size="1">
                                                                    <option value="" selected="selected"></option>
                                                                    <option value="SUR">SUR</option>
                                                                    <option value="ESTE">ESTE</option>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <strong>Dirección Generada:</strong>&nbsp;&nbsp;      
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="note" class="col-sm-2 control-label"><i style="color:red;">*</i> Dirección</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" placeholder="Digita Dirección" name="direccion" ng-model="direccion" required="true"/>
                                            <span class="label label-danger" ng-show="frm.direccion.$dirty && frm.direccion.$error.required">Requerido</span>
                                        </div>
                                    </div>

                                        <div class="container-fluid">
                                          <div class="form-group">
                                                    <label for="note" class="col-sm-2 control-label">Fecha de Nacimiento</label>
                                                    <div class="col-sm-8">
                                                    <p class="input-group">
                                                      <input class="form-control" type="text" id="fecha_nacimiento" ng-model="fecha_nacimiento" placeholder="día/mes/año">

                                                    </p>
                                                </div>
                                                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                                                </div>
                                            </div>
                                        </div>



                                    <div class="form-group">
                                        <label for="note" class="col-sm-2 control-label">Teléfono móvil
                                        </label>
                                        <div class="col-sm-8">
                                            <input class="form-control" placeholder="Digita Teléfono móvil" name="telefono_movil" type="text" ng-model="telefono_movil"  ng-pattern-restrict="^\d{0,9}((\d{0,2})?)?$" />
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="note" class="col-sm-2 control-label">Teléfono fijo

                                        </label>
                                        <div class="col-sm-8">
                                            <input class="form-control" placeholder="Digita Teléfono fijo
                                                   " name="telefono_fijo" type="text" ng-model="telefono_fijo" ng-pattern-restrict="^\d{0,9}((\d{0,2})?)?$"/>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="note" class="col-sm-2 control-label"><i style="color:red;">*</i> Correo Electrónico

                                        </label>
                                        <div class="col-sm-8">
                                            <input class="form-control" type="email" placeholder="Digita Correo Electrónico" name="email" ng-model="email" id="email" ng-blur="onBlurCorreo($event)" required="true"/>

                                            <div id="repetido">
                                                <span class="label label-danger" ng-show="frm.email.$dirty && frm.email.$error.required">Requerido</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="note" class="col-sm-2 control-label"><i style="color:red;">*</i> Roles</label>
                                        <div class="col-sm-6">

                                            <select name="rol" ng-model="rol" class="form-control" required="true">
                                                <option>Seleccione Rol</option>
                                                <option ng-repeat="rol in roles" value="@{{ rol.id}}">@{{ rol.name}}</option>
                                            </select>
                                            <span class="label label-danger" ng-show="frm.rol.$dirty && frm.rol.$error.required">Requerido</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="note" class="col-sm-2 control-label">Password</label>
                                        <div class="col-sm-8">
                                            <input type="password" class="form-control" name="password" ng-model="registerData.password" required="true"/>
                                            <div class="form-errors" ng-messages="frm.password.$error" ng-if='frm.password.$touched'>
                                                <span class="form-error" ng-message="required">Please enter the password</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="note" class="col-sm-2 control-label">Password confirmacion</label>
                                        <div class="col-sm-8">
                                            <input type="password" class="form-control" name="password_confirmation" ng-model="registerData.password_confirmation" required="true" confirm-pwd="registerData.password" />
                                            <div class="form-errors" ng-messages="autentication_form.password_confirmation.$error" ng-if='autentication_form.password_confirmation.$touched'>
                                                <span class="form-error" ng-message="required">Password confirmacion required</span>
                                                <span class="form-error" ng-message="password">Password different</span>
                                            </div>
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
                                            <button type="submit" class="btn btn-success" ng-click="formsubmit(frm.$valid)"  ng-disabled="frm.$invalid"><i class="fa fa-save"></i>&nbsp;&nbsp;Guardar Usuario</button>
                                            <a href="{{url('/admin/postusuarios#/admin/postusuarios')}}" type="submit" class="btn btn-orange"><i class="fa fa-reply-all"></i>&nbsp;&nbsp;Atras</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="messages"></div><br /><br />
            <!--div para visualizar en el caso de imagen-->
            <div class="showImage"></div>
        </section>
    </div>
</div>