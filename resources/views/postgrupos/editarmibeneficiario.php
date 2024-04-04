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
                          <input type="date" style="border: 2px solid #366a8eab; position: relative; top: 5px;"  ng-model="fecha_inscripcions" placeholder="Fecha Inscripción" class="form-control" value="@{{ fecha_inscripcions}}" ng-change="setStartInscripcion(startDateInscripcion)" required validatedateformat calendar> 
                                    <br>
                                  </p>
                                </div>
                              </div>
                            </div>

                            <div class='col-sm-4'>
                              <div class='form-group'>
                                <label for="user_firstname">Ficha No</label>
                                <input type="text" class="form-control" style="    border: 2px solid #366a8eab; border-radius: 7px;" value="@{{no_ficha}}" ng-model="serie.no_ficha"  placeholder="Ficha No">
                                <span class="label label-danger" ng-show="frm.numero_ficha.$dirty && frm.numero_ficha.$error.required">Requerido</span>
                              </div>
                            </div>
                            <div class='col-sm-4'>
                              <div class='form-group'>
                                <label for="user_lastname">Programa</label>

                                <select class="form-control" name="programa" id="programa" required ng-change="unitChanged()" ng-model="data_programa.unit" ng-options="unit.id as unit.nombre_programa for unit in programas" style="    border: 2px solid #366a8eab;"></select>

                                <span class="label label-danger" ng-show="frm.programa.$dirty && frm.programa.$error.required">Requerido</span>
                              </div>
                            </div>
                          </div>
                          <div class='row'>
                            <div class='col-sm-6'>    
                              <div class='form-group'>
                                <label for="user_firstname">Modalidad</label>
                                <input type="text" class="form-control" value="@{{modalidad}}" ng-model="serie.modalidad" placeholder="Modalidad" style="    border: 2px solid #366a8eab; border-radius: 7px">
                                <span class="label label-danger" ng-show="frm.modalidad.$dirty && frm.modalidad.$error.required" >Requerido</span>
                              </div>
                            </div>
                            <div class='col-sm-6'>
                              <div class='form-group'>
                                <label for="user_firstname">Punto de atención</label>
                                <input type="text" class="form-control" value="@{{punto_atencion}}" ng-model="serie.punto_atencion" placeholder="Punto de atención" style="    border: 2px solid #366a8eab;">
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
                                <input type="text" class="form-control" value="@{{nombres_beneficiario}}" ng-model="serie.nombres_beneficiario" placeholder="Nombres" required>
                                <span class="label label-danger" ng-show="frm.nombres_beneficiario.$dirty && frm.nombres_beneficiario.$error.required">Requerido</span>
                              </div>
                            </div>
                            <div class='col-sm-6'>
                              <div class='form-group'>
                                <label for="user_firstname">Apellidos</label>
                                <input type="text" class="form-control" value="@{{apellidos_beneficiario}}" ng-model="serie.apellidos_beneficiario" placeholder="Apellidos" required>
                                <span class="label label-danger" ng-show="frm.apellidos_beneficiario.$dirty && frm.apellidos_beneficiario.$error.required">Requerido</span>
                              </div>
                            </div>
                          </div>
                          <div class='row'>
                            <div class='col-sm-6'>
                              <div class='form-group'>
                                <label for="user_email">Tipo Documento</label>
                                  <select class="form-control" ng-model="obtener.documentoId" ng-options="documento.id as documento.nombre for documento in obtener.documentos"></select>
                                <span class="label label-danger" ng-show="frm.tipo_documento_beneficiario.$dirty && frm.tipo_documento_beneficiario.$error.required">Requerido</span>
                              </div>
                            </div>
                            <div class='col-sm-6'>
                              <div class='form-group'>
                                <label for="user_email">No Documento</label>
                                <input class="form-control" value="@{{no_documento_beneficiario}}" ng-model="serie.no_documento_beneficiario"  required="true" size="30" type="text" placeholder="No Documento" />
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
                                     <select class="form-control" ng-model="obsexo.sexoId" ng-options="sex.id as sex.nombre for sex in obsexo.sexo" required style="width: 280px; position: relative; top: 6px;"></select>
                               
                                    <span class="label label-danger" ng-show="frm.sexo_beneficiario.$dirty && frm.sexo_beneficiario.$error.required">Requerido</span>
                                    <br>
                                  </p>
                                </div>
                              </div>
                            </div>
                            <div class='col-sm-4'>
                              <div class='form-group'>
                                <label for="user_firstname">Fecha Nacimiento</label>
                                <input type="date" data-ng-model="fecha_nac" value="@{{ fecha_nac }}" placeholder="Fecha Nacimiento" class="form-control" ng-change="setStart(fecha_nac)" required validatedateformat calendar>
                                <span class="label label-danger" ng-show="frm.fecha_nac.$dirty && frm.fecha_nac.$error.required">Requerido</span>
                                
                              </div>
                            </div>
                            <div class='col-sm-4'>
                              <div class='form-group'>
                                <label for="user_lastname">Edad</label>
                                <input type="text" class="form-control" value="@{{edad_beneficiario}}" ng-model="serie.edad_beneficiario" placeholder="Edad">
                                <span class="label label-danger" ng-show="frm.edad_beneficiario.$dirty && frm.edad_beneficiario.$error.required">Requerido</span>
                              </div>
                            </div>
                          </div>
                          <div class='row'>
                            <div class='col-sm-6'>
                              <div class='form-group'>
                                <label for="user_email">Telefono</label>
                                <input class="form-control" required="true" size="30" type="text" placeholder="Telefono" value="@{{telefono_beneficiario}}" ng-model="serie.telefono_beneficiario"/>
                                <span class="label label-danger" ng-show="frm.telefono_beneficiario.$dirty && frm.telefono_beneficiario.$error.required">Requerido</span>
                              </div>
                            </div>
                            <div class='col-sm-6'>
                              <div class='form-group'>
                                <label for="user_email">Correo Electronico</label>
                                <input class="form-control" required size="30" type="email" placeholder="Correo electronico" value="@{{correo_beneficiario}}" ng-model="serie.correo_beneficiario" />
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
                                     

                                    <select class="form-control" name="pais" id="pais" required ng-change='selectedPais(data.unit)' ng-model="data.unit" ng-options="unit.id as unit.nombre_pais for unit in paises" style="width: 280px; position: relative; top: 6px;"></select>

                                    <span class="label label-danger" ng-show="frm.pais.$dirty && frm.pais.$error.required">Requerido</span>
                                    <br>
                                  </p>
                                </div>
                              </div>
                            </div>
                            <div class='col-sm-4'>
                              <div class='form-group'>
                                <label for="user_firstname">Departamento</label>
                                <select class="form-control" name="departamento" id="departamento" required  ng-model="datas.unit" ng-change='selectedDepartamento(datas.unit)' ng-options="unit.id as unit.nombre_departamento for unit in departamentos" style="width: 280px; position: relative; top: 6px;"></select>
                              
                                <br>
                              </div>
                            </div>
                            <div class='col-sm-4'>
                              <div class='form-group'>
                                <label for="user_lastname">Municipio</label>
                               <select class="form-control" name="municipio" id="municipio" required  ng-model="data_municipio.unit" ng-options="unit.id as unit.nombre_municipio for unit in municipios" style="width: 280px; position: relative; top: 6px;"></select>
                                <span class="label label-danger" ng-show="frm.data_municipio.unit.$dirty && frm.data_municipio.unit.$error.required">Requerido</span>
                                <br>
                              </div>
                            </div>
                          </div>
                          <div class='row'>
                            <div class='col-sm-6'>
                              <div class='form-group'>
                                <label for="user_email">Dirección de residencia</label>
                                <input class="form-control"  size="30" type="text" placeholder="Dirección de residencia" value="@{{direccion_beneficiario}}" ng-model="serie.direccion_beneficiario"/>
                                <span class="label label-danger" ng-show="frm.residencia_beneficiario.$dirty && frm.residencia_beneficiario.$error.required">Requerido</span>
                              </div>
                            </div>
                            <div class='col-sm-6'>
                              <div class='form-group'>
                                <label for="user_email">Estrato</label>
                                <input class="form-control" required= size="30" type="text" placeholder="Estrato" value="@{{estrato_beneficiario}}" ng-model="serie.estrato_beneficiario" />
                                <span class="label label-danger" ng-show="frm.estrato.$dirty && frm.estrato.$error.required">Requerido</span>
                              </div>
                            </div>
                          </div>
                          <div class='row'>
                            <div class='col-sm-6'>
                              <div class='form-group'>
                                <label for="user_email">Comuna</label>
                                  <select class="form-control" name="comuna" id="comuna" required ng-change='selectedComuna(data_comuna.unit)' ng-model="data_comuna.unit" ng-options="unit.id as unit.nombre_comuna for unit in comunas" style="width: 280px; position: relative; top: 6px;"></select>
                                <span class="label label-danger" ng-show="frm.data_comuna.unit.$dirty && frm.data_comuna.unit.$error.required">Requerido</span>
                                <br>
                              </div>
                            </div>
                            <div class='col-sm-6'>
                              <div class='form-group'>
                                <label for="user_email">Barrio</label>
                                <select class="form-control" name="barrio" id="barrio" required  ng-model="data_barrio.unit" ng-options="unit.id as unit.nombre_barrio for unit in barrios" style="width: 280px; position: relative; top: 6px;"></select>
                                <span class="label label-danger" ng-show="frm.data_barrio.unit.$dirty && frm.data_barrio.unit.$error.required">Requerido</span>
                                <br>
                              </div>
                            </div>
                          </div>
                          <div class='row'>
                            <div class='col-sm-6'>    
                              <div class='form-group'>
                                <label for="user_firstname">Corregimiento</label>
                                <input type="text" class="form-control" value="@{{corregimiento_beneficiario}}" ng-model="serie.corregimiento_beneficiario" placeholder="Corregimiento">
                                <span class="label label-danger" ng-show="frm.corregimiento.$dirty && frm.corregimiento.$error.required">Requerido</span>
                              </div>
                            </div>
                            <div class='col-sm-6'>
                              <div class='form-group'>
                                <label for="user_firstname">Vereda</label>
                                <input type="text" class="form-control"  placeholder="Vereda" value="@{{vereda_beneficiario}}" ng-model="serie.vereda_beneficiario">
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
                                        <select class="form-control" ng-model="obcivil.civilId" ng-options="civ.id as civ.nombre for civ in obcivil.civil" required style="width: 280px; position: relative; top: 6px;"></select>
                                    <span class="label label-danger" ng-show="frm.est_beneficiario.$dirty && frm.est_beneficiario.$error.required">Requerido</span>
                                    <br>
                                  </p>
                                </div>
                              </div>
                            </div>
                            <div class='col-sm-4'>
                              <div class='form-group'>
                                <label for="user_firstname">¿Tiene hijos?</label>
                                 <select class="form-control" ng-model="obhijos.hijosId" ng-options="hij.id as hij.nombre for hij in obhijos.hijos" required style="width: 280px; position: relative; top: 6px;" ng-change='selectedHijos(hijo)'></select>
                                <span class="label label-danger" ng-show="frm.obhijos.hijosId.$dirty && frm.obhijos.hijosId.$error.required">Requerido</span>
                              </div>
                            </div>
                            <div class='col-sm-4'>
                              <div class='form-group'>
                                <label for="user_lastname">¿Cuántos?</label>
                                <input type="text" class="form-control" value="@{{cantidad_hijos_beneficiario}}" ng-model="serie.cantidad_hijos_beneficiario" placeholder="Cuantos Hijos?"  ng-disabled="isDisabled">
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
                                    <select class="form-control" ng-model="obtipo_sangre.tipo_sangreId" ng-options="tipos.id as tipos.nombre for tipos in obtipo_sangre.tipo_sangre" required style="width: 280px; position: relative; top: 6px;" required></select>

                                    <span class="label label-danger" ng-show="frm.tip_sangre.$dirty && frm.tip_sangre.$error.required">Requerido</span>
                                    <br>
                                  </p>
                                </div>
                              </div>
                            </div>
                            <div class='col-sm-4'>
                              <div class='form-group'>
                                <label for="user_firstname">¿Cuál es su ocupación actual?</label>
                                    <select class="form-control" ng-model="obocupacion.ocupacionId" ng-options="ocup.id as ocup.nombre for ocup in obocupacion.ocupacion" required style="width: 280px; position: relative; top: 6px;" required></select>
                                <span class="label label-danger" ng-show="frm.obocupacion.ocupacionId.$dirty && frm.obocupacion.ocupacionId.$error.required">Requerido</span>
                              </div>
                            </div>
                            <div class='col-sm-4'>
                              <div class='form-group'>
                                <label for="user_lastname">¿Cuál?</label>
                                <input type="text" class="form-control"  value="@{{ocupacion_beneficiario}}" ng-model="serie.ocupacion_beneficiario"  placeholder="Cual?"  ng-disabled="isDisabledOcupacion">                             
                              </div>
                            </div>
                          </div>
                          <div class='row'>
                            <div class='col-sm-4'>    
                              <div class='form-group'>
                                <div class="input-group">
                                  <p class="input-group">
                                    <label class="item-input"> <span class="input-label">Nivel de escolaridad</span>
                                     <select class="form-control" ng-model="obescolaridad.escolaridadId" ng-options="esc.id as esc.nombre for esc in obescolaridad.escolaridad" required style="width: 280px; position: relative; top: 6px;" required></select>

                                    <span class="label label-danger" ng-show="frm.obescolaridad.escolaridadId.$dirty && frm.obescolaridad.escolaridadId.$error.required">Requerido</span>
                                    <br>
                                  </p>
                                </div>
                              </div>
                            </div>
                            <div class='col-sm-4'>
                              <div class='form-group'>
                                <label for="user_firstname" style="position: relative; top: -17px;">¿De acuerdo con su cultura, pueblo o rasgos físicos, es o se reconoce como?</label>
                                   <select class="form-control" ng-model="obcultura.culturaId" ng-options="cult.id as cult.nombre for cult in obcultura.cultura" required style="width: 280px; position: relative; top: -17px;" required></select>

                                <span class="label label-danger" ng-show="frm.cultura.$dirty && frm.cultura.$error.required">Requerido</span>
                              </div>
                            </div>
                            <div class='col-sm-4'>
                              <div class='form-group'>
                                <label for="user_lastname">¿Cuál?</label>
                                <input type="text" class="form-control"  value="@{{otra_cultura_beneficiario  }}" ng-model="serie.otra_cultura_beneficiario" placeholder="Cuál?" ng-disabled="isDisabledCultura">
                              </div>
                            </div>
                          </div>
                          <h4 class="ons  e"><span><b>¿Usted pertenece actualmente a alguno de estos grupos poblacionales, comunitarios y sociales? (Selección múltiple)</b></span></h4>
                          <div class="clearfix"></div><br>
                          <label ng-repeat="grupo_poblacion in grupos_poblacionales" style="margin-bottom: 35px;
                          margin-left: 23px;"><input type="checkbox" checklist-model="selected.poblacionales" checklist-value="grupo_poblacion" />@{{grupo_poblacion.nombre}}<br/> </label>



<p ng-repeat="seleccion in allGrupos_poblacionales">
      <input type="checkbox" ng-checked="selectedPoblacionales.containsObjectWithProperty('id', seleccion.id)" ng-click="toggleSelection(seleccion)" />
      @{{seleccion.name}}
    </p>
    <hr />
  
                          <div class="clearfix"></div><br><br>
                          <div class='row'>
                            <div class='col-sm-4'>    
                              <div class='form-group'>
                                <div class="input-group">
                                  <p class="input-group">
                                    <label class="item-input"> <span class="input-label">¿Presenta alguna discapacidad?.</span>
                                     <select class="form-control" ng-model="obdiscapacidad.discapacidadId" ng-options="disc.id as disc.nombre for disc in obdiscapacidad.discapacidad" required style="width: 280px; position: relative; top: 6px;" ng-change='selectedDiscapacidad(obdiscapacidad.discapacidadId)'></select>
                                   <span class="label label-danger" ng-show="frm.obdiscapacidad.discapacidadId.$dirty && frm.obdiscapacidad.discapacidadId.$error.required">Requerido</span>

                                   <br>
                                 </p>
                               </div>
                             </div>
                           </div>
                           <div class='col-sm-4'>
                            <div class='form-group'>
                              <label for="user_firstname" >Cuál?</label>
                               <select class="form-control" ng-model="obdiscapacidadotro.discapacidadotroId" ng-options="discotro.id as discotro.nombre for discotro in obdiscapacidadotro.discapacidadotro" required style="width: 280px; position: relative; top: 6px;" ng-change='selectedDiscapacidad(obdiscapacidadotro.discapacidadotroId)'></select> 
                               <span class="label label-danger" ng-show="frm.obdiscapacidadotro.discapacidadotroId.$dirty && frm.obdiscapacidadotro.discapacidadotroId.$error.required">Requerido</span>

                            </div>
                          </div>
                          <div class='col-sm-4'>
                            <div class='form-group'>
                              <label for="user_lastname">Otra ¿Cuál?</label>
                              <input type="text" class="form-control" value="@{{otra_discapacidad_beneficiario }}" ng-model="serie.otra_discapacidad_beneficiario" placeholder="Otra ¿Cuál?" ng-disabled="isDisabledDiscapacidad">
                            </div>
                          </div>
                        </div>
                        <div class='row'>
                          <div class='col-sm-6'>
                            <div class='form-group'>
                              <label for="user_email">¿Padece alguna enfermedad permanente (crónica) que limite su actividad física?</label>
                              <select class="form-control" ng-model="obenfermedad.enfermedadId" ng-options="enf.id as enf.nombre for enf in obenfermedad.enfermedad" required style="width: 280px; position: relative; top: 6px;" ng-change='selectedEnfermedad(obenfermedad.enfermedadId)'></select>
                              <span class="label label-danger" ng-show="frm.obenfermedad.enfermedadId.$dirty && frm.obenfermedad.enfermedadId.$error.required">Requerido</span>
                            </div>
                          </div>
                          <div class='col-sm-6'>
                            <div class='form-group'>
                              <label for="user_email">¿Cuál?</label>
                              <input type="text" class="form-control" value="@{{enfermedad_beneficiario }}" ng-model="serie.enfermedad_beneficiario" placeholder="Otra ¿Cuál?" ng-disabled="isDisabledEnfermedad">
                            </div>
                          </div>
                        </div>
                        <div class='row'>
                          <div class='col-sm-6'>
                            <div class='form-group'>
                              <label for="user_email">¿Toma medicamentos de manera permanente?</label>
                             <select class="form-control" ng-model="obmedicamento.medicamentoId" ng-options="medic.id as medic.nombre for medic in obmedicamento.medicamento" required style="width: 280px; position: relative; top: 6px;" ng-change='selectedMedicamento(obmedicamento.medicamentoId)'></select>
                            </div>
                          </div>
                          <div class='col-sm-6'>
                            <div class='form-group'>

                              <label for="user_email">¿Cuál(es)?</label>
                              <input class="form-control" size="30" type="text" placeholder="¿Cuál(es)?" disabled style="position: relative; top: -2px;" ng-disabled="isDisabledMedicamento" value="@{{medicamentos_beneficiario }}" ng-model="serie.medicamentos_beneficiario" />
                            </div>
                          </div>
                        </div>
                        <div class='row'>
                          <div class='col-sm-4'>    
                            <div class='form-group'>
                              <div class="input-group">
                                <p class="input-group">
                                  <label class="item-input"> <span class="input-label">¿Se encuentra afiliado al Sistema General de Seguridad Social en Salud-SGSSS?</span>
                                    <select class="form-control" ng-model="obseguridadsocial.seguridadsocialId" ng-options="seguridad.id as seguridad.nombre for seguridad in obseguridadsocial.seguridadsocial" required style="width: 280px; position: relative; top: 6px;" ng-change='selectedSeguridad(obseguridadsocial.seguridadsocialId)'></select>
                                 <span class="label label-danger" ng-show="frm.obseguridadsocial.seguridadsocialId.$dirty && frm.obseguridadsocial.seguridadsocialId.$error.required">Requerido</span>

                                 <br>
                               </p>
                             </div>
                           </div>
                         </div>
                         <div class='col-sm-4'>
                          <div class='form-group'>
                            <label for="user_firstname" >Cuál?</label>
                              <select class="form-control" ng-model="obsaludsgss.saludsgssId" ng-options="saludsgss.id as saludsgss.nombre for saludsgss in obsaludsgss.saludsgss" required style="width: 280px; position: relative; top: 6px;" ng-change='selectedSaludGgss(obsaludsgss.saludsgssId)'></select>
                          <br>
                        </div>
                      </div>
                      <div class='col-sm-4'>
                        <div class='form-group'>
                          <label for="user_lastname">Nombre de la entidad a la que se encuentra afiliado</label>
                          <input type="text" class="form-control" value="@{{nombre_seguridad_beneficiario }}" ng-model="serie.nombre_seguridad_beneficiario" placeholder="Nombre entidad" ng-disabled="isDisabledSeguridad">
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
                          <input type="text" class="form-control" value="@{{nombres_acudiente }}" ng-model="serie.nombres_acudiente" placeholder="Nombres Familiar">
                          <span class="label label-danger" ng-show="frm.nombres_acudiente.$dirty && frm.nombres_acudiente.$error.required">Requerido</span>
                        </div>
                      </div>
                      <div class='col-sm-6'>
                        <div class='form-group'>
                          <label for="user_firstname">Apellidos</label>
                          <input type="text" class="form-control" value="@{{apellidos_acudiente }}" ng-model="serie.apellidos_acudiente" placeholder="Apellidos">
                          <span class="label label-danger" ng-show="frm.apellidos_acudiente.$dirty && frm.apellidos_acudiente.$error.required">Requerido</span>
                        </div>
                      </div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-6'>
                        <div class='form-group'>
                          <label for="user_email">Tipo Documento</label>
                           <select class="form-control" ng-model="obdoc_acudiente.doc_acudienteId" ng-options="dc_acudiente.id as dc_acudiente.nombre for dc_acudiente in obdoc_acudiente.doc_acudiente" required style="width: 280px; position: relative; top: 6px;" ng-change='selectedTipoDocAcudiente(obdoc_acudiente.doc_acudienteId)'></select>
                          <span class="label label-danger" ng-show="frm.obdoc_acudiente.doc_acudienteId.$dirty && frm.obdoc_acudiente.doc_acudienteId.$error.required">Requerido</span>
                        </div>
                      </div>
                      <div class='col-sm-6'>
                        <div class='form-group'>
                          <label for="user_email">No Documento</label>
                          <input class="form-control" value="@{{documento_acudiente }}" ng-model="serie.documento_acudiente" size="30" type="text" / placeholder="No Documento">
                          <span class="label label-danger" ng-show="frm.documento_acudiente.$dirty && frm.documento_acudiente.$error.required">Requerido</span>
                        </div>
                      </div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'>    
                        <div class='form-group'>
                          <div class="input-group">
                            <p class="input-group">
                              <label class="item-input"> <span class="input-label">Sexo</span>
                                <select class="form-control" ng-model="obsexo_acudiente.sexo_acudienteId" ng-options="sex_acudiente.id as sex_acudiente.nombre for sex_acudiente in obsexo_acudiente.sexo_acudiente" required style="width: 280px; position: relative; top: 6px;" ng-change='selectedTipoDocAcudiente(obsexo_acudiente.sexo_acudienteId)'></select>
                              <span class="label label-danger" ng-show="frm.obsexo_acudiente.sexo_acudienteId.$dirty && frm.obsexo_acudiente.sexo_acudienteId.$error.required">Requerido</span>

                              <br>
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class='col-sm-4'>
                        <div class='form-group'>
                          <label for="user_firstname">Fecha Nacimiento</label>
                           <input type="date"  ng-model="fecha_acudiente" placeholder="Fecha Inscripción" class="form-control" value="@{{ fecha_acudiente }}" ng-change="setStartParentesco(fecha_acudiente)" required validatedateformat calendar> 
                         
                        </div>
                      </div>
                      <div class='col-sm-4'>
                        <div class='form-group'>
                          <label for="user_lastname">Edad</label>
                          <input type="text" class="form-control" value="@{{ edad_acudiente }}" ng-model="serie.edad_acudiente" placeholder="Edad Pariente" required>
                          <span class="label label-danger" ng-show="frm.edad_acudiente.$dirty && frm.edad_acudiente.$error.required">Requerido</span>
                        </div>
                      </div>
                    </div>

                    <div class='row'>
                      <div class='col-sm-6'>
                        <div class='form-group'>
                          <label for="user_email">Telefono</label>
                          <input type="text" class="form-control" value="@{{ telefono_acudiente }}" ng-model="serie.telefono_acudiente" placeholder="Telefono Pariente" required>
                          <span class="label label-danger" ng-show="frm.telefono_pariente.$dirty && frm.telefono_pariente.$error.required">Requerido</span>
                        </div>
                      </div>
                      <div class='col-sm-6'>
                        <div class='form-group'>

                          <label for="user_email">Correo Electronico</label>
                          <input class="form-control" required value="@{{ correo_acudiente }}" ng-model="serie.correo_acudiente" size="30" type="email" required />
                          <span class="label label-danger" ng-show="frm.email_pariente.$dirty && frm.email_pariente.$error.required">Requerido</span>
                        </div>
                      </div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-6'>
                        <div class='form-group'>
                          <label for="user_email">Parentesco:</label>
                            <select class="form-control" ng-model="obparentesco.parentescoId" ng-options="parentes.id as parentes.nombre for parentes in obparentesco.parentesco" required style="width: 280px; position: relative; top: 6px;" ng-change='selectedTipoDocAcudiente(obparentesco.parentescoId)'></select>
                          <span class="label label-danger" ng-show="frm.obparentesco.parentescoId.$dirty && frm.obparentesco.parentescoId.$error.required">Requerido</span>
                        </div>
                      </div>
                      <div class='col-sm-6'>
                        <div class='form-group'>
                          <label for="user_email">¿Cuál?</label>
                          <input class="form-control required email" value="@{{ otro_parentesco_acudiente }}" ng-model="serie.otro_parentesco_acudiente" size="30" type="text" placeholder="¿Cuál?" ng-disabled="isDisabledParentesco"/>
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
                        <button type="submit" class="btn btn-success" ng-click="formsubmit(serie.id, frm.$valid)" ng-disabled="frm.$invalid"><i class="fa fa-save"></i>&nbsp;&nbsp;Actualizar Beneficiario</button>

                        <a href="{{url('/admin/postbeneficiarios#/admin/postbeneficiarios')}}" type="submit" class="btn btn-orange"><i class="fa fa-reply-all"></i>&nbsp;&nbsp;Atras</a>
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



