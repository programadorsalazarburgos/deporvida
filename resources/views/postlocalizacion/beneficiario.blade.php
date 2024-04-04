<style>
.code {
  height: 80px !important;
}

textarea.ng-invalid.ng-dirty{border:1px solid red;}
select.ng-invalid.ng-dirty{border:1px solid red;}
option.ng-invalid.ng-dirty{border:1px solid red;}
input.ng-invalid.ng-dirty{border:1px solid red;}

.form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
    cursor: not-allowed;
    background-color: #fff;
    opacity: 1;
}

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
                    
                    <div class="tab-content">
                      <div id="resultados_ajax"></div>
                      <div class="tab-pane active" id="details">
                        <div class="clearfix"></div>
                        <br>
                       

<center>
                        <table width="90%" border="1" cellspacing="4" cellpadding="2" bordercolor="#eeeeee">
<tbody><tr>
    <th colspan="2" height="30" bgcolor="#039be5" scope="row"><center>
  <font color="#FFFFFF" size="5"><strong>HISTORIA DEL BENEFICIARIO</strong></font>  
</center></th>
  </tr>
  <tr>
    <th colspan="2" height="30" scope="row"><center> <font color="#000000" size="5">  @{{serie.apellidos_beneficiario|uppercase}} </font></center></th>
  </tr>
  <tr>
    <th colspan="2" height="30" scope="row"><center><font color="#000000" size="5">  @{{serie.nombres_beneficiario|uppercase}}</font>  </center></th>
  </tr>
  
  </tbody></table>
</center>
<div class="clearfix"></div><br>
<center>

<table width="80%" border="0" cellspacing="2">
  <tbody><tr>
    <th colspan="2" height="30" bgcolor="#039be5" scope="row"><center style="
    color:  white;
">INFORMACIÓN IED</center></th>
  </tr>
  <tr>
    <th height="30" width="50%" scope="row">Fecha de Inscripción :</th>
    <td width="50%"><font color="#000000" size="2">@{{ serie.fecha_inscripcion }}</font></td>
  </tr>
  <tr>
    <th height="30" scope="row">Ficha No:</th>
    <td><font color="#000000" size="2">@{{serie.no_ficha}}</font></td>
  </tr> 
  <tr>
    <th height="30" scope="row">Programa:</th>
    <td><font color="#000000" size="2">@{{programa.nombre_programa}} </font></td>
  </tr>
  <tr>
    <th height="30" scope="row">Modalidad:</th>
    <td><font color="#000000" size="2">@{{serie.modalidad}}</font></td>
  </tr>
  <tr>
    <th height="30" scope="row">Punto de atención:</th>
    <td><font color="#000000" size="2">@{{serie.punto_atencion}}</font></td>
  </tr>
  
  </tbody></table>
<div class="clearfix"></div><br>
</center>


<center>
  <table width="80%" border="1" cellspacing="4" cellpadding="2" bordercolor="#eeeeee">
  <tbody><tr>
    <th height="30" bgcolor="#039be5" colspan="2" scope="row"><center style="
    color:  white;
">DATOS BASICOS DEL BENEFICIARIO</center></th>
  </tr>
  <tr>
    <th height="30" width="50%" scope="row">Nombres:</th>
    <td width="50%"><font color="#000000" size="2">@{{serie.nombres_beneficiario}}</font></td>
  </tr>
  <tr>
    <th height="30" scope="row">Apellidos:</th>
    <td><font color="#000000" size="2">@{{serie.apellidos_beneficiario}}</font></td>
  </tr>
  <tr>
    <th height="30" scope="row">Tipo Documento:</th>
    <td><font color="#000000" size="2">@{{tipodocumento}}</font></td>
  </tr>
  <tr>
    <th height="30" scope="row">No Documento: </th>
    <td><font color="#000000" size="2">@{{serie.no_documento_beneficiario}}</font></td>
  </tr>
  <tr>
    <th height="30" scope="row">Sexo:</th>
    <td><font color="#000000" size="2">@{{sexo_benef}}</font></td>
  </tr>
  <tr>
    <th height="30" scope="row">Fecha Nacimiento:</th>
    <td><font color="#000000" size="2">@{{serie.fecha_nac_beneficiario}}</font></td>
  </tr>
  <tr>
    <th height="30" scope="row">Edad:</th>
    <td><font color="#000000" size="2">@{{serie.edad_beneficiario}}</font></td>
  </tr>
  <tr>
    <th height="30" scope="row">Telefono:</th>
    <td><font color="#000000" size="2">@{{serie.telefono_beneficiario}}</font></td>
  </tr>
  <tr>
    <th height="30" scope="row">Correo Electronico:</th>
    <td><font color="#000000" size="2">@{{serie.correo_beneficiario}}</font></td>
  </tr>
  <tr>
    <th height="30" scope="row">Pais:</th>
    <td><font color="#000000" size="2"><select class="form-control" disabled name="pais" id="pais" required ng-change='selectedPais(data.unit)' ng-model="data.unit" ng-options="unit.id as unit.nombre_pais for unit in paises"  style="border: 0px solid white; position: relative; left: -9px;"></select>
</font></td>
  </tr>
  <tr>
    <th height="30" scope="row">Departamento:</th>
    <td><font color="#000000" size="2">  <select class="form-control" name="departamento" id="departamento" required disabled  ng-model="datas.unit" ng-change='selectedDepartamento(datas.unit)' ng-options="unit.id as unit.nombre_departamento for unit in departamentos" style="border: 0px solid white; position: relative; left: -9px;"></select>
                              </font></td>
  </tr>
  <tr>
    <th height="30" scope="row">Municipio:</th>
    <td><font color="#000000" size="2"> <select class="form-control" name="municipio" id="municipio" required  ng-model="data_municipio.unit" disabled ng-options="unit.id as unit.nombre_municipio for unit in municipios" style="border: 0px solid white; position: relative; left: -9px;"></select>
                              </font></td>
  </tr>
  <tr>
    <th height="30" scope="row">Dirección de residencia:</th>
    <td><font color="#000000" size="2">@{{serie.direccion_beneficiario}} </font></td>
  </tr>
  <tr>
    <th height="30" scope="row">Estrato:</th>
    <td><font color="#000000" size="2">@{{serie.estrato_beneficiario}}</font></td>
  </tr>

  <tr>
    <th height="30" scope="row">Comuna:</th>
    <td><font color="#000000" size="2"><select class="form-control" disabled name="comuna" id="comuna" required ng-change='selectedComuna(data_comuna.unit)' ng-model="data_comuna.unit" ng-options="unit.id as unit.nombre_comuna for unit in comunas" style="border: 0px solid white; position: relative; left: -9px;"></select></font></td>
  </tr>

  <tr>
    <th height="30" scope="row">Barrio:</th>
    <td><font color="#000000" size="2">   <select class="form-control" name="barrio" id="barrio" required  ng-model="data_barrio.unit" disabled ng-options="unit.id as unit.nombre_barrio for unit in barrios" style="border: 0px solid white; position: relative; left: -9px;"></select>
                             </font></td>
  </tr>

  <tr>
    <th height="30" scope="row">Corregimiento:</th>
    <td><font color="#000000" size="2">@{{serie.corregimiento_beneficiario}}</font></td>
  </tr>
 
 <tr>
    <th height="30" scope="row">Vereda:</th>
    <td><font color="#000000" size="2">@{{serie.vereda_beneficiario}}</font></td>
  </tr>
<tr>
    <th height="30" scope="row">Estado Civil:</th>
    <td><font color="#000000" size="2">@{{estado_civ_benef}}</font></td>
  </tr>

  <tr>
    <th height="30" scope="row">¿Tiene hijos?:</th>
    <td><font color="#000000" size="2">@{{hijos_benef}}</font></td>
  </tr>

<tr>
    <th height="30" scope="row">¿Cuántos?:</th>
    <td><font color="#000000" size="2">@{{serie.cantidad_hijos_beneficiario}}</font></td>
  </tr>
<tr>
    <th height="30" scope="row">Tipo de Sangre:</th>
    <td><font color="#000000" size="2">@{{sangre_benef}}</font></td>
  </tr>
<tr>
    <th height="30" scope="row">¿Cuál es su ocupación actual?:</th>
    <td><font color="#000000" size="2">@{{ocupacion_benef}}</font></td>
  </tr>
<tr>
    <th height="30" scope="row">¿Cuál?:</th>
    <td><font color="#000000" size="2">@{{serie.ocupacion_beneficiario}}</font></td>
  </tr>
<tr>
    <th height="30" scope="row">Nivel de escolaridad:</th>
    <td><font color="#000000" size="2">@{{escolaridad_benef}}</font></td>
  </tr>
<tr>
    <th height="30" scope="row">¿De acuerdo con su cultura, pueblo o rasgos físicos, es o se reconoce como?:</th>
    <td><font color="#000000" size="2">@{{cultura_benef}}</font></td>
  </tr>

<tr>
    <th height="30" scope="row">¿Cuál?:</th>
    <td><font color="#000000" size="2">@{{serie.otra_cultura_beneficiario  }}</font></td>
</tr>

<tr>
    <th height="30" scope="row">¿Presenta alguna discapacidad?:</th>
    <td><font color="#000000" size="2">@{{discapacidad_benef}}</font></td>
</tr>
<tr>
    <th height="30" scope="row">Cuál?:</th>
    <td><font color="#000000" size="2">@{{discapacidad_otra_benef}}</font></td>
</tr>

<tr>
    <th height="30" scope="row">Otra ¿Cuál?:</th>
    <td><font color="#000000" size="2">@{{serie.otra_discapacidad_beneficiario }}</font></td>
</tr>

<tr>
    <th height="30" scope="row">¿Padece alguna enfermedad permanente (crónica) que limite su actividad física?:</th>
    <td><font color="#000000" size="2">@{{enfermedad_benef}}</font></td>
</tr>

<tr>
    <th height="30" scope="row">¿Cuál?:</th>
    <td><font color="#000000" size="2">@{{serie.enfermedad_beneficiario }}</font></td>
</tr>
<tr>
    <th height="30" scope="row">¿Toma medicamentos de manera permanente?:</th>
    <td><font color="#000000" size="2">@{{medicamento_benef}}</font></td>
</tr>

<tr>
    <th height="30" scope="row">¿Cuál(es)?:</th>
    <td><font color="#000000" size="2">@{{serie.medicamentos_beneficiario }}</font></td>
</tr>
<tr>
    <th height="30" scope="row">¿Se encuentra afiliado al Sistema General de Seguridad Social en Salud-SGSSS? :</th>
    <td><font color="#000000" size="2">@{{seguridad_benef}}</font></td>
</tr>
<tr>
    <th height="30" scope="row">Cuál?:</th>
    <td><font color="#000000" size="2">@{{salud_benef}}</font></td>
</tr>
<tr>
    <th height="30" scope="row">Nombre de la entidad a la que se encuentra afiliado:</th>
    <td><font color="#000000" size="2">@{{serie.nombre_seguridad_beneficiario }}</font></td>
</tr>


  </tbody></table>
</center>


<center>
  <table width="80%" border="1" cellspacing="4" cellpadding="2" bordercolor="#eeeeee">
  <tbody><tr>
    <th height="30" bgcolor="#039be5" colspan="2" scope="row"><center style="
    color:  white;
">DATOS BASICOS DEL ACUDIENTE</center></th>
  </tr>
  <tr>
    <th height="30" width="50%" scope="row">Nombres:</th>
    <td width="50%"><font color="#000000" size="2">@{{serie.nombres_acudiente }}</font></td>
  </tr>
  <tr>
    <th height="30" scope="row">Apellidos:</th>
    <td><font color="#000000" size="2">@{{serie.apellidos_acudiente }}</font></td>
  </tr>
  <tr>
    <th height="30" scope="row">Tipo Documento:</th>
    <td><font color="#000000" size="2">@{{tipodocumento_acudiente}}</font></td>
  </tr>
  <tr>
    <th height="30" scope="row">No Documento: </th>
    <td><font color="#000000" size="2">@{{serie.documento_acudiente }}</font></td>
  </tr>
  <tr>
    <th height="30" scope="row">Sexo:</th>
    <td><font color="#000000" size="2">@{{sexo_acudient}}</font></td>
  </tr>
  <tr>
    <th height="30" scope="row">Fecha Nacimiento:</th>
    <td><font color="#000000" size="2">@{{ serie.fecha_nac_acudiente }}</font></td>
  </tr>
  <tr>
    <th height="30" scope="row">Edad:</th>
    <td><font color="#000000" size="2">@{{ serie.edad_acudiente }}</font></td>
  </tr>
  <tr>
    <th height="30" scope="row">Telefono:</th>
    <td><font color="#000000" size="2">@{{ serie.telefono_acudiente }}</font></td>
  </tr>
  <tr>
    <th height="30" scope="row">Correo Electronico:</th>
    <td><font color="#000000" size="2">@{{ serie.correo_acudiente }}</font></td>
  </tr>
  <tr>
    <th height="30" scope="row">Parentesco:</th>
    <td><font color="#000000" size="2">@{{parentesco_acudient}}</font></td>
  </tr>
  <tr>
    <th height="30" scope="row">¿Cuál?:</th>
    <td><font color="#000000" size="2">@{{ serie.otro_parentesco_acudiente }}</font></td>
  </tr>


 


  </tbody></table>
</center>



      <div class="messages"></div><br /><br />
      <!--div para visualizar en el caso de imagen-->
      <div class="showImage"></div>
    </div>
  </div>
</section> 



