<style>
.code {
  height: 80px !important;
}

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
        <div class="col-md-12" style="width: 98%;">
          <div class="content-wrapper">
            <section class="content-header">
              <!-- <h3><i class='fa fa-edit'></i> Agregar nuevo producto</h3> -->
            </section>
            <section class="content">
              <div class="row">
                <form class="" id="f1" name="frm" submit="submitForm()" novalidate>
                  <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                      <li class="active"><a href="#details" data-toggle="tab" aria-expanded="false">
                        <span class="label label-success" id="codigo">FICHA DE INSCRIPCIÓN Y CARACTERIZACIÓN DE USUARIOS-
                        BENEFICIARIOS</span>
                      </a></li>
                    </ul>
                    <div class="tab-content">
                      <div id="resultados_ajax"></div>
                      <div class="tab-pane active" id="details">
                        <div class="clearfix"></div>
                        <br>
                        <div class='row'>
                          <div class='col-sm-4'>    
                            <div class='form-group'>
                              <div class="input-group">
                                <p class="input-group">
                                  <label class="item-input"> <span class="input-label">Fecha de Inscripción</span>
                                    <input type="date" data-ng-model="startDateInscripcion" placeholder="Fecha Inscripción" class="form-control" ng-change="setStartInscripcion(startDateInscripcion)" required validatedateformat calendar>
                                    <br>
                                  </p>
                                </div>
                              </div>
                            </div>
                            <div class='col-sm-4'>
                              <div class='form-group'>
                                <label for="user_firstname">Ficha No</label>
                                <input type="text" class="form-control" ng-model="numero_ficha" placeholder="Ficha No">
                                  <span class="label label-danger" ng-show="frm.numero_ficha.$dirty && frm.numero_ficha.$error.required">Requerido</span>
                              </div>
                            </div>
                            <div class='col-sm-4'>
                              <div class='form-group'>
                                <label for="user_lastname">Programa</label>
                                <select name="programa" ng-model="programa" class="form-control" required>
                                  <option value="">Seleccione Programa</option>
                                  <option ng-repeat="programa in programas" value="@{{ programa.id }}">@{{ programa.nombre_programa }}</option>

                                </select>
                                <span class="label label-danger" ng-show="frm.programa.$dirty && frm.programa.$error.required">Requerido</span>
                              </div>
                            </div>
                          </div>
                          <div class='row'>
                            <div class='col-sm-6'>    
                              <div class='form-group'>
                                <label for="user_firstname">Modalidad</label>
                                <input type="text" class="form-control" ng-model="modalidad" placeholder="Modalidad">
                                <span class="label label-danger" ng-show="frm.modalidad.$dirty && frm.modalidad.$error.required">Requerido</span>
                              </div>
                            </div>
                            <div class='col-sm-6'>
                              <div class='form-group'>
                                <label for="user_firstname">Punto de atención</label>
                                <input type="text" class="form-control" ng-model="punto_atencion" placeholder="Punto de atención">
                                <span class="label label-danger" ng-show="frm.punto_atencion.$dirty && frm.punto_atencion.$error.required">Requerido</span>
                              </div>
                            </div>
                          </div>

                          <ul class="nav nav-tabs">
                            <li class="active"><a href="#details" data-toggle="tab" aria-expanded="false">
                              <span class="label label-primary" id="codigo">Identificación del Usuario-Beneficiario</span>
                            </a></li>
                          </ul>

                          <div class="clearfix"></div><br>
                          <div class='row'>
                            <div class='col-sm-6'>    
                              <div class='form-group'>
                                <label for="user_firstname">Nombres</label>
                                <input type="text" class="form-control" ng-model="nombres_beneficiario" placeholder="Nombres" required>
                                <span class="label label-danger" ng-show="frm.nombres_beneficiario.$dirty && frm.nombres_beneficiario.$error.required">Requerido</span>
                              </div>
                            </div>
                            <div class='col-sm-6'>
                              <div class='form-group'>
                                <label for="user_firstname">Apellidos</label>
                                <input type="text" class="form-control" ng-model="apellidos_beneficiario" placeholder="Apellidos" required>
                                <span class="label label-danger" ng-show="frm.apellidos_beneficiario.$dirty && frm.apellidos_beneficiario.$error.required">Requerido</span>
                              </div>
                            </div>
                          </div>
                          <div class='row'>
                            <div class='col-sm-6'>
                              <div class='form-group'>
                                <label for="user_email">Tipo Documento</label>
                                <select name="tipo" ng-model="tipo_documento_beneficiario" class="form-control" required>
                                  <option value="">Seleccione Tipo Documento</option>
                                  <option ng-repeat="tipo in tipo_documento" value="@{{ tipo.id }}">@{{ tipo.nombre }}</option>
                                </select>
                                <span class="label label-danger" ng-show="frm.tipo_documento_beneficiario.$dirty && frm.tipo_documento_beneficiario.$error.required">Requerido</span>
                              </div>
                            </div>
                            <div class='col-sm-6'>
                              <div class='form-group'>
                                <label for="user_email">No Documento</label>
                                <input class="form-control" ng-model="no_documento_beneficiario"  required="true" size="30" type="text" placeholder="No Documento" />
                                <span class="label label-danger" ng-show="frm.no_documento_beneficiario.$dirty && frm.no_documento_beneficiario.$error.required">Requerido</span>
                              </div>
                            </div>
                          </div>
                          <div class='row'>
                            <div class='col-sm-4'>    
                              <div class='form-group'>
                                <div class="input-group">
                                  <p class="input-group">
                                    <label class="item-input"> <span class="input-label">Sexo</span>
                                     <select  ng-model="sexo_beneficiario" class="form-control" required style="width: 280px; position: relative; top: 6px;">
                                      <option value="">Seleccione Sexo</option>
                                      <option ng-repeat="sex in sexo" value="@{{ sex.id }}">@{{ sex.nombre }}</option>
                                    </select>
                                    <span class="label label-danger" ng-show="frm.sexo_beneficiario.$dirty && frm.sexo_beneficiario.$error.required">Requerido</span>
                                    <br>
                                  </p>
                                </div>
                              </div>
                            </div>
                            <div class='col-sm-4'>
                              <div class='form-group'>
                                <label for="user_firstname">Fecha Nacimiento</label>
                                <input type="date" data-ng-model="startDate" placeholder="Fecha Nacimiento" class="form-control" ng-change="setStart(startDate)" required validatedateformat calendar>
                                <span class="label label-danger" ng-show="frm.startDate.$dirty && frm.startDate.$error.required">Requerido</span>
                                <button button="button" ng-disabled="planningForm.$invalid" ng-click="load()" class="button button-positive">
                                  Edad
                                </button>
                              </div>
                            </div>
                            <div class='col-sm-4'>
                              <div class='form-group'>
                                <label for="user_lastname">Edad</label>
                                <input type="text" class="form-control" value="edad" ng-model="edad_beneficiario" placeholder="Edad">
                                <span class="label label-danger" ng-show="frm.edad_beneficiario.$dirty && frm.edad_beneficiario.$error.required">Requerido</span>
                              </div>
                            </div>
                          </div>
                          <div class='row'>
                            <div class='col-sm-6'>
                              <div class='form-group'>
                                <label for="user_email">Telefono</label>
                                <input class="form-control" required="true" size="30" type="text" placeholder="Telefono" ng-model="telefono_beneficiario"/>
                                <span class="label label-danger" ng-show="frm.telefono_beneficiario.$dirty && frm.telefono_beneficiario.$error.required">Requerido</span>
                              </div>
                            </div>
                            <div class='col-sm-6'>
                              <div class='form-group'>
                                <label for="user_email">Correo Electronico</label>
                                <input class="form-control" required size="30" type="email" placeholder="Correo electronico" ng-model="correo_beneficiario" />
                                <span class="label label-danger" ng-show="frm.correo_beneficiario.$dirty && frm.correo_beneficiario.$error.required">Requerido</span>
                              </div>
                            </div>
                          </div>
                          <div class='row'>
                            <div class='col-sm-4'>    
                              <div class='form-group'>
                                <div class="input-group">
                                  <p class="input-group">
                                    <label class="item-input"> <span class="input-label">Pais</span>
                                     <select name="pais" ng-model="pais" class="form-control" required style="width: 280px; position: relative; top: 6px;" ng-change='selectedPais(pais)'>
                                      <option value="">Seleccione Pais</option>
                                      <option ng-repeat="pais in paises" value="@{{ pais.id }}">@{{ pais.nombre_pais }}</option>
                                    </select>
                                    <span class="label label-danger" ng-show="frm.pais.$dirty && frm.pais.$error.required">Requerido</span>
                                    <br>
                                  </p>
                                </div>
                              </div>
                            </div>
                            <div class='col-sm-4'>
                              <div class='form-group'>
                                <label for="user_firstname">Departamento</label>
                                <select name="departamento" ng-model="departamento" class="form-control" required style="width: 280px; position: relative; top: 6px;" ng-change='selectedDepartamento(departamento)'>
                                  <option value="">Seleccione Departamento</option>
                                  <option ng-repeat="departamento in departamentos" value="@{{ departamento.id }}">@{{ departamento.nombre_departamento }}</option>
                                </select>
                                <span class="label label-danger" ng-show="frm.departamento.$dirty && frm.departamento.$error.required">Requerido</span>
                                <br>
                              </div>
                            </div>
                            <div class='col-sm-4'>
                              <div class='form-group'>
                                <label for="user_lastname">Municipio</label>
                                <select name="municipio" ng-model="municipio" class="form-control" required style="width: 280px; position: relative; top: 6px;">
                                  <option value="">Seleccione Municipio</option>
                                  <option ng-repeat="municipio in municipios" value="@{{ municipio.id }}">@{{ municipio.nombre_municipio }}</option>
                                </select>
                                <span class="label label-danger" ng-show="frm.municipio.$dirty && frm.municipio.$error.required">Requerido</span>
                                <br>
                              </div>
                            </div>
                          </div>
                          <div class='row'>
                            <div class='col-sm-6'>
                              <div class='form-group'>
                                <label for="user_email">Dirección de residencia</label>
                                <input class="form-control"  size="30" type="text" placeholder="Dirección de residencia" ng-model="residencia_beneficiario"/>
                                <span class="label label-danger" ng-show="frm.residencia_beneficiario.$dirty && frm.residencia_beneficiario.$error.required">Requerido</span>
                              </div>
                            </div>
                            <div class='col-sm-6'>
                              <div class='form-group'>
                                <label for="user_email">Estrato</label>
                                <input class="form-control" required= size="30" type="text" placeholder="Estrato" ng-model="estrato" />
                                <span class="label label-danger" ng-show="frm.estrato.$dirty && frm.estrato.$error.required">Requerido</span>
                              </div>
                            </div>
                          </div>
                          <div class='row'>
                            <div class='col-sm-6'>
                              <div class='form-group'>
                                <label for="user_email">Comuna</label>
                                <select name="comuna" ng-model="comuna" class="form-control" required style="width: 280px; position: relative; top: 6px;"  ng-change='selectedComuna(comuna)'>
                                  <option value="">Seleccione Comuna</option>
                                  <option ng-repeat="comuna in comunas" value="@{{ comuna.id }}">@{{ comuna.nombre_comuna }}</option>
                                </select>
                                <span class="label label-danger" ng-show="frm.comuna.$dirty && frm.comuna.$error.required">Requerido</span>
                                <br>
                              </div>
                            </div>
                            <div class='col-sm-6'>
                              <div class='form-group'>
                                <label for="user_email">Barrio</label>
                                <select name="barrio" ng-model="barrio" class="form-control" required style="width: 280px; position: relative; top: 6px;">
                                  <option value="">Seleccione Barrio</option>
                                  <option ng-repeat="barrio in barrios" value="@{{ barrio.id }}">@{{ barrio.nombre_barrio }}</option>
                                </select>
                                <span class="label label-danger" ng-show="frm.barrio.$dirty && frm.barrio.$error.required">Requerido</span>
                                <br>
                              </div>
                            </div>
                          </div>
                          <div class='row'>
                            <div class='col-sm-6'>    
                              <div class='form-group'>
                                <label for="user_firstname">Corregimiento</label>
                                <input type="text" class="form-control" ng-model="corregimiento" placeholder="Corregimiento">
                                <span class="label label-danger" ng-show="frm.corregimiento.$dirty && frm.corregimiento.$error.required">Requerido</span>
                              </div>
                            </div>
                            <div class='col-sm-6'>
                              <div class='form-group'>
                                <label for="user_firstname">Vereda</label>
                                <input type="text" class="form-control" ng-model="vereda" placeholder="Vereda">
                                <span class="label label-danger" ng-show="frm.vereda.$dirty && frm.vereda.$error.required">Requerido</span>
                              </div>
                            </div>
                          </div>
                          <div class='row'>
                            <div class='col-sm-4'>    
                              <div class='form-group'>
                                <div class="input-group">
                                  <p class="input-group">
                                    <label class="item-input"> <span class="input-label">
                                    Estado Civil</span>
                                    <select name="est_beneficiario" ng-model="est_beneficiario" class="form-control" required style="width: 280px; position: relative; top: 6px;">
                                      <option value="">Seleccione 
                                      Estado Civil</option>
                                      <option ng-repeat="est_beneficiario in estado_civil_beneficiario" value="@{{ est_beneficiario.id }}">@{{ est_beneficiario.nombre }}</option>
                                    </select>
                                    <span class="label label-danger" ng-show="frm.est_beneficiario.$dirty && frm.est_beneficiario.$error.required">Requerido</span>
                                    <br>
                                  </p>
                                </div>
                              </div>
                            </div>
                            <div class='col-sm-4'>
                              <div class='form-group'>
                                <label for="user_firstname">¿Tiene hijos?</label>
                                <select name="hijo" ng-model="hijo" class="form-control" required style="width: 280px;" ng-change='selectedHijos(hijo)'>
                                  <option value="">Seleccione </option>
                                  <option ng-repeat="hijo in hijos" value="@{{ hijo.id }}">@{{ hijo.nombre }}</option>
                                </select>
                                <span class="label label-danger" ng-show="frm.hijo.$dirty && frm.hijo.$error.required">Requerido</span>
                              </div>
                            </div>
                            <div class='col-sm-4'>
                              <div class='form-group'>
                                <label for="user_lastname">¿Cuántos?</label>
                                <input type="text" class="form-control" ng-model="cantidad_hijos" placeholder="Cuantos Hijos?"  ng-disabled="isDisabled">
                                <span class="label label-danger" ng-show="frm.cantidad_hijos.$dirty && frm.cantidad_hijos.$error.required">Requerido</span>
                              </div>
                            </div>
                          </div>
                          <div class='row'>
                            <div class='col-sm-4'>    
                              <div class='form-group'>
                                <div class="input-group">
                                  <p class="input-group">
                                    <label class="item-input"> <span class="input-label">Tipo de Sangre</span>
                                     <select name="tip_sangre" ng-model="tip_sangre" class="form-control" required style="width: 280px; position: relative; top: 6px;">
                                      <option value="">Seleccione 
                                      Tipo de Sangre</option>
                                      <option ng-repeat="tip_sangre in tipo_sangre" value="@{{ tip_sangre.id }}">@{{ tip_sangre.nombre }}</option>
                                    </select>
                                    <span class="label label-danger" ng-show="frm.tip_sangre.$dirty && frm.tip_sangre.$error.required">Requerido</span>
                                    <br>
                                  </p>
                                </div>
                              </div>
                            </div>
                            <div class='col-sm-4'>
                              <div class='form-group'>
                                <label for="user_firstname">¿Cuál es su ocupación actual?</label>
                                <select name="ocupacion" ng-model="ocupacion" class="form-control" required style="width: 280px;" ng-change='selectedOcupacion(ocupacion)'>
                                  <option value="">Seleccione 
                                  Ocupación</option>
                                  <option ng-repeat="ocupacion in ocupaciones" value="@{{ ocupacion.id }}">@{{ ocupacion.nombre }}</option>
                                </select>
                                <span class="label label-danger" ng-show="frm.ocupacion.$dirty && frm.ocupacion.$error.required">Requerido</span>
                              </div>
                            </div>
                            <div class='col-sm-4'>
                              <div class='form-group'>
                                <label for="user_lastname">¿Cuál?</label>
                                <input type="text" class="form-control"  ng-model="ocupacion_otra" placeholder="Cual?"  ng-disabled="isDisabledOcupacion">                             
                              </div>
                            </div>
                          </div>
                          <div class='row'>
                            <div class='col-sm-4'>    
                              <div class='form-group'>
                                <div class="input-group">
                                  <p class="input-group">
                                    <label class="item-input"> <span class="input-label">Nivel de escolaridad</span>
                                     <select name="escolaridad" ng-model="escolaridad" class="form-control" required style="width: 280px; position: relative; top: 6px;">
                                      <option value="">Seleccione Nivel de escolaridad</option>
                                      <option ng-repeat="escolaridad in escolaridades" value="@{{ escolaridad.id }}">@{{ escolaridad.nombre }}</option>
                                    </select>
                                    <span class="label label-danger" ng-show="frm.escolaridad.$dirty && frm.escolaridad.$error.required">Requerido</span>
                                    <br>
                                  </p>
                                </div>
                              </div>
                            </div>
                            <div class='col-sm-4'>
                              <div class='form-group'>
                                <label for="user_firstname" style="position: relative; top: -17px;">¿De acuerdo con su cultura, pueblo o rasgos físicos, es o se reconoce como?</label>
                                <select name="cultura" ng-model="cultura" class="form-control" required style="width: 280px; position: relative; top: -17px;" ng-change='selectedCultura(cultura)'>
                                  <option value="">Seleccione</option>
                                  <option ng-repeat="cultura in culturas" value="@{{ cultura.id }}">@{{ cultura.nombre }}</option>
                                </select>
                                <span class="label label-danger" ng-show="frm.cultura.$dirty && frm.cultura.$error.required">Requerido</span>
                              </div>
                            </div>
                            <div class='col-sm-4'>
                              <div class='form-group'>
                                <label for="user_lastname">¿Cuál?</label>
                                <input type="text" class="form-control"  ng-model="cultura_otro" placeholder="Cuál?" ng-disabled="isDisabledCultura">
                              </div>
                            </div>
                          </div>
                          <h4 class="ons  e"><span><b>¿Usted pertenece actualmente a alguno de estos grupos poblacionales, comunitarios y sociales? (Selección múltiple)</b></span></h4>
                          <div class="clearfix"></div><br>
                          <label ng-repeat="grupo_poblacion in grupos_poblacionales" style="margin-bottom: 35px;
                          margin-left: 23px;"><input type="checkbox" checklist-model="selected.poblacionales" checklist-value="grupo_poblacion" />@{{grupo_poblacion.nombre}}<br/> </label>




 @{{selected.poblacionales}}


                        <div class="clearfix"></div><br><br>
                        <div class='row'>
                          <div class='col-sm-4'>    
                            <div class='form-group'>
                              <div class="input-group">
                                <p class="input-group">
                                  <label class="item-input"> <span class="input-label">¿Presenta alguna discapacidad?.</span>
                                   <select name="discapacidad" ng-model="discapacidad" class="form-control" ng-change='selectedDiscapacidad(discapacidad)' required style="position: relative;
                                   top: 6px;">
                                   <option value="">Seleccione</option>
                                   <option ng-repeat="discapacidad in discapacidades" value="@{{ discapacidad.id }}">@{{ discapacidad.nombre }}</option>

                                 </select>
                                 <span class="label label-danger" ng-show="frm.discapacidad.$dirty && frm.discapacidad.$error.required">Requerido</span>

                                 <br>
                               </p>
                             </div>
                           </div>
                         </div>
                         <div class='col-sm-4'>
                          <div class='form-group'>
                            <label for="user_firstname" >Cuál?</label>
                            <select name="discapacidad_otro" ng-model="discapacidad_otro" class="form-control"  style="width: 280px;" ng-change='selectedCulturaOtro(discapacidad_otro)' ng-disabled="isDisabledDiscapacidad">
                              <option value="">Seleccione</option>
                              <option ng-repeat="discapacidad_otro in discapacidad_otra" value="@{{ discapacidad_otro.id }}">@{{ discapacidad_otro.nombre }}</option>
                            </select> 
                          </div>
                        </div>
                        <div class='col-sm-4'>
                          <div class='form-group'>
                            <label for="user_lastname">Otra ¿Cuál?</label>
                            <input type="text" class="form-control" ng-model="otra_discapacidad" placeholder="Otra ¿Cuál?" ng-disabled="isDisabledDiscapacidad">
                          </div>
                        </div>
                      </div>
                      <div class='row'>
                        <div class='col-sm-6'>
                          <div class='form-group'>
                            <label for="user_email">¿Padece alguna enfermedad permanente (crónica) que limite su actividad física?</label>
                            <select name="enfermedad" ng-model="enfermedad" class="form-control" required style="width: 280px;" ng-change='selectedEnfermedad(enfermedad)'>
                              <option value="">Seleccione</option>
                              <option ng-repeat="enfermedad in enfermedades" value="@{{ enfermedad.id }}">@{{ enfermedad.nombre }}</option>
                            </select>
                            <span class="label label-danger" ng-show="frm.enfermedad.$dirty && frm.enfermedad.$error.required">Requerido</span>
                          </div>
                        </div>
                        <div class='col-sm-6'>
                          <div class='form-group'>
                            <label for="user_email">¿Cuál?</label>
                            <input type="text" class="form-control" ng-model="otra_enfermedad" placeholder="Otra ¿Cuál?" ng-disabled="isDisabledEnfermedad">
                          </div>
                        </div>
                      </div>
                      <div class='row'>
                        <div class='col-sm-6'>
                          <div class='form-group'>
                            <label for="user_email">¿Toma medicamentos de manera permanente?</label>
                            <select name="medicamento" ng-model="medicamento" class="form-control" required style="width: 280px;" ng-change='selectedMedicamento(medicamento)'>
                              <option value="">Seleccione</option>
                              <option ng-repeat="medicamento in medicamentos" value="@{{ medicamento.id }}">@{{ medicamento.nombre }}</option>
                            </select>
                          </div>
                        </div>
                        <div class='col-sm-6'>
                          <div class='form-group'>

                            <label for="user_email">¿Cuál(es)?</label>
                            <input class="form-control" size="30" type="text" placeholder="¿Cuál(es)?" disabled style="position: relative; top: -2px;" ng-disabled="isDisabledMedicamento" ng-model="medicamento_otro" />
                          </div>
                        </div>
                      </div>
                      <div class='row'>
                        <div class='col-sm-4'>    
                          <div class='form-group'>
                            <div class="input-group">
                              <p class="input-group">
                                <label class="item-input"> <span class="input-label">¿Se encuentra afiliado al Sistema General de Seguridad Social en Salud-SGSSS?</span>
                                 <select name="seguridad" ng-model="seguridad" class="form-control" required style="    position: relative;
                                 top: 6px" ng-change='selectedSeguridad(seguridad)'>
                                 <option value="">Seleccione</option>
                                 <option ng-repeat="seguridad in seguridad_social" value="@{{ seguridad.id }}">@{{ seguridad.nombre }}</option>

                               </select>
                               <span class="label label-danger" ng-show="frm.seguridad.$dirty && frm.seguridad.$error.required">Requerido</span>

                               <br>
                             </p>
                           </div>
                         </div>
                       </div>
                       <div class='col-sm-4'>
                        <div class='form-group'>
                          <label for="user_firstname" >Cuál?</label>
                          <select name="salud" ng-model="salud" class="form-control"  style="     position: relative;
                          top: 18px" ng-disabled="isDisabledSeguridad">
                          <option value="">Seleccione</option>
                          <option ng-repeat="salud in salud_sgsss" value="@{{ salud.id }}">@{{ salud.nombre }}</option>
                        </select>
                        <br>
                      </div>
                    </div>
                    <div class='col-sm-4'>
                      <div class='form-group'>
                        <label for="user_lastname">Nombre de la entidad a la que se encuentra afiliado</label>
                        <input type="text" class="form-control" ng-model="nombre_entidad" placeholder="Nombre entidad" ng-disabled="isDisabledSeguridad">
                      </div>
                    </div>
                  </div>
                  <div class="clearfix"></div><br>
                  <ul class="nav nav-tabs">
                    <li class="active"><a href="#details" data-toggle="tab" aria-expanded="false">
                      <span class="label label-success" id="codigo">Identificación del Padre de Familia / Acudiente / Cuidador</span>
                    </a></li>
                  </ul>
                  <div class="clearfix"></div><br>
                  <div class='row'>
                    <div class='col-sm-6'>    
                      <div class='form-group'>
                        <label for="user_firstname">Nombres</label>
                        <input type="text" class="form-control" ng-model="nombres_familiar" placeholder="Nombres Familiar">
                        <span class="label label-danger" ng-show="frm.nombres_familiar.$dirty && frm.nombres_familiar.$error.required">Requerido</span>
                      </div>
                    </div>
                    <div class='col-sm-6'>
                      <div class='form-group'>
                        <label for="user_firstname">Apellidos</label>
                        <input type="text" class="form-control" ng-model="apellidos_familiar" placeholder="Apellidos">
                        <span class="label label-danger" ng-show="frm.apellidos_familiar.$dirty && frm.apellidos_familiar.$error.required">Requerido</span>
                      </div>
                    </div>
                  </div>
                  <div class='row'>
                    <div class='col-sm-6'>
                      <div class='form-group'>
                        <label for="user_email">Tipo Documento</label>
                        <select name="tipo" ng-model="tipo_familiar" class="form-control" required>
                          <option value="">Seleccione Tipo Documento</option>
                          <option ng-repeat="tipo in tipo_documento" value="@{{ tipo.id }}">@{{ tipo.nombre }}</option>
                        </select>
                        <span class="label label-danger" ng-show="frm.tipo_familiar.$dirty && frm.tipo_familiar.$error.required">Requerido</span>
                      </div>
                    </div>
                    <div class='col-sm-6'>
                      <div class='form-group'>
                        <label for="user_email">No Documento</label>
                        <input class="form-control" ng-model="no_documento_pariente" size="30" type="text" / placeholder="No Documento">
                        <span class="label label-danger" ng-show="frm.no_documento_pariente.$dirty && frm.no_documento_pariente.$error.required">Requerido</span>
                      </div>
                    </div>
                  </div>
                  <div class='row'>
                    <div class='col-sm-4'>    
                      <div class='form-group'>
                        <div class="input-group">
                          <p class="input-group">
                            <label class="item-input"> <span class="input-label">Sexo</span>
                             <select name="sex_pariente" ng-model="sex_pariente" class="form-control" required style="width: 280px; position: relative; top: 6px;">
                              <option value="">Seleccione Sexo</option>
                              <option ng-repeat="sex in sexo" value="@{{ sex.id }}">@{{ sex.nombre }}</option>

                            </select>
                            <span class="label label-danger" ng-show="frm.sex_pariente.$dirty && frm.sex_pariente.$error.required">Requerido</span>

                            <br>
                          </p>
                        </div>
                      </div>
                    </div>
                    <div class='col-sm-4'>
                      <div class='form-group'>
                        <label for="user_firstname">Fecha Nacimiento</label>
                        <input type="date" data-ng-model="startDateParentesco" placeholder="Fecha Nacimiento" class="form-control" ng-change="setStartParentesco(startDateParentesco)" required validatedateformat calendar>
                        <button button="button" ng-disabled="planningForm.$invalid" ng-click="load_parentesco()" class="button button-positive">
                          Edad
                        </button>
                      </div>
                    </div>
                    <div class='col-sm-4'>
                      <div class='form-group'>
                        <label for="user_lastname">Edad</label>
                        <input type="text" class="form-control" value="edad" ng-model="edad_pariente" placeholder="Edad Pariente" required>
                        <span class="label label-danger" ng-show="frm.edad_pariente.$dirty && frm.edad_pariente.$error.required">Requerido</span>
                      </div>
                    </div>
                  </div>

                  <div class='row'>
                    <div class='col-sm-6'>
                      <div class='form-group'>
                        <label for="user_email">Telefono</label>
                        <input type="text" class="form-control" ng-model="telefono_pariente" placeholder="Telefono Pariente" required>
                        <span class="label label-danger" ng-show="frm.telefono_pariente.$dirty && frm.telefono_pariente.$error.required">Requerido</span>
                      </div>
                    </div>
                    <div class='col-sm-6'>
                      <div class='form-group'>

                        <label for="user_email">Correo Electronico</label>
                        <input class="form-control" required ng-model="email_pariente" size="30" type="email" required />
                        <span class="label label-danger" ng-show="frm.email_pariente.$dirty && frm.email_pariente.$error.required">Requerido</span>
                      </div>
                    </div>
                  </div>
                  <div class='row'>
                    <div class='col-sm-6'>
                      <div class='form-group'>
                        <label for="user_email">Parentesco:</label>
                        <select name="parentesco" ng-model="parentesco" class="form-control" required ng-change='selectedParentesco(parentesco)'>
                          <option value="">Seleccione</option>
                          <option ng-repeat="parentesco in parentescos" value="@{{ parentesco.id }}">@{{ parentesco.nombre }}</option>
                        </select>
                        <span class="label label-danger" ng-show="frm.parentesco.$dirty && frm.parentesco.$error.required">Requerido</span>
                      </div>
                    </div>
                    <div class='col-sm-6'>
                      <div class='form-group'>
                        <label for="user_email">¿Cuál?</label>
                        <input class="form-control required email" ng-model="otro_parentesco" size="30" type="text" placeholder="¿Cuál?" ng-disabled="isDisabledParentesco"/>
                      </div>
                    </div>
                  </div>
                  <div class="clearfix"></div>
                  <br>
                  <div class="form-group">
                    <div class="col-sm-6">
                      <div ng-show="loading" id="cargando" class="loading"><img src="{{ asset('/images/cargando.gif') }}">LOADING...</div>
                      <div ng-repeat="car in cars">
                        <li></li>
                      </div>
                      <button type="submit" class="btn btn-success" ng-click="formsubmit(serie.id, frm.$valid)"><i class="fa fa-save"></i>&nbsp;&nbsp;Crear Beneficiario</button>
                      <a href="{{url('/admin/postgrupos#/admin/postgrupos')}}" type="submit" class="btn btn-orange"><i class="fa fa-reply-all"></i>&nbsp;&nbsp;Atras</a>
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div><br><br>
              </label>
            </p>
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



