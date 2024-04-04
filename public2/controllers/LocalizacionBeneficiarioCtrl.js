SeriesApp.controller("LocalizacionBeneficiarioCtrl", function($scope, BeneficiarioService, $routeParams, fileUpload, $http, $location, $timeout, base_api){
  $scope.title = "Editar Beneficiario";
  $scope.series = [];
  $scope.getData = function(){

    $http.get(base_api + "/admin/postbeneficiarios/" + $routeParams.id)
    .success(function(response){

      $scope.serie = response;

      console.log($scope.serie);
      var n = $scope.serie.fecha_inscripcion.toString();
      $scope.fecha_inscripcions = new Date(n);

      var nac_beneficiario = $scope.serie.fecha_nac_beneficiario.toString();
      $scope.fecha_nac = new Date(nac_beneficiario);


      var na = $scope.serie.fecha_nac_acudiente.toString();
     $scope.fecha_acudiente = new Date(na);

    });



  };

$http.get(base_api + "/obtener/programa/" + $routeParams.id)
  .success(function(response){
   
    $scope.programa = response;
    

  });



  $http.get(base_api + "/obtener/tipodocumento/" + $routeParams.id)
  .success(function(response){

    var caseStr = response.id;

    if (caseStr == 1) {
      $scope.tipodocumento = 'Registro Civil';
    }
    else if (caseStr == 2) {
      $scope.tipodocumento = 'Tarjeta Identidad';
    }

    else if (caseStr == 3) {
      $scope.tipodocumento = 'Cédula de Ciudadanía';
    }
    
    else if (caseStr == 4) {
      $scope.tipodocumento = 'Pasaporte';
    }

    else if (caseStr == 5) {
      $scope.tipodocumento = 'Sin Información';
    }



  });



  $http.get(base_api + "/obtener/sexo/" + $routeParams.id)
  .success(function(response){


    var caseSexo = response.id;

   
    if (caseSexo == 1) {
      $scope.sexo_benef = 'Femenino';
    }
    else if (caseSexo == 2) {
      $scope.sexo_benef = 'Masculino';
    }


  });



  $http.get(base_api + "/obtener/civil/" + $routeParams.id)
  .success(function(response){


var caseCivil = response.id;

   
    if (caseCivil == 1) {
      $scope.estado_civ_benef = 'Casado';
    }
    else if (caseCivil == 2) {
      $scope.estado_civ_benef = 'Soltero';
    }
    else if (caseCivil == 3) {
      $scope.estado_civ_benef = 'Unión Libre';
    }
    else if (caseCivil == 4) {
      $scope.estado_civ_benef = 'Viudo';
    }

  });




  $http.get(base_api + "/obtener/hijos/" + $routeParams.id)
  .success(function(response){


 var caseHijos = response.id;

   
    if (caseHijos == 1) {
      $scope.hijos_benef = 'Si';
    }
    else if (caseHijos == 2) {
      $scope.hijos_benef = 'No';
    }

  });



  $http.get(base_api + "/obtener/tiposangre/" + $routeParams.id)
  .success(function(response){




 var caseSangre = response.id;

   
    if (caseSangre == 1) {
      $scope.sangre_benef = 'O+';
    }
    else if (caseSangre == 2) {
      $scope.sangre_benef = 'O-';
    }
    else if (caseSangre == 3) {
      $scope.sangre_benef = 'A+';
    }
    else if (caseSangre == 4) {
      $scope.sangre_benef = 'A-';
    }
    else if (caseSangre == 5) {
      $scope.sangre_benef = 'B+';
    }
    else if (caseSangre == 6) {
      $scope.sangre_benef = 'B-';
    }
    else if (caseSangre == 7) {
      $scope.sangre_benef = 'AB+';
    }
    else if (caseSangre == 8) {
      $scope.sangre_benef = 'AB-';
    }


  });




  $http.get(base_api + "/obtener/ocupacion/" + $routeParams.id)
  .success(function(response){

    var caseOcupacion = response.id;

   
    if (caseOcupacion == 1) {
      $scope.ocupacion_benef = 'Ama de casa';
    }
    else if (caseOcupacion == 2) {
      $scope.ocupacion_benef = 'Empleado';
    }
    else if (caseOcupacion == 3) {
      $scope.ocupacion_benef = 'Estudiante';
    }
    else if (caseOcupacion == 4) {
      $scope.ocupacion_benef = 'Desempleado';
    }
    else if (caseOcupacion == 5) {
      $scope.ocupacion_benef = 'Independiente';
    }
    else if (caseOcupacion == 6) {
      $scope.ocupacion_benef = 'Pensionado-Jubilado';
    }
    else if (caseOcupacion == 7) {
      $scope.ocupacion_benef = 'Servidor Público';
    }
    else if (caseOcupacion == 8) {
      $scope.ocupacion_benef = 'Otro';
    }

  });



  $http.get(base_api + "/obtener/escolaridad/" + $routeParams.id)
  .success(function(response){


var caseEscolaridad = response.id;

   
    if (caseEscolaridad == 1) {
      $scope.escolaridad_benef = 'Educación inicial';
    }
    else if (caseEscolaridad == 2) {
      $scope.escolaridad_benef = 'Preescolar';
    }
    else if (caseEscolaridad == 3) {
      $scope.escolaridad_benef = 'Primaria';
    }
    else if (caseEscolaridad == 4) {
      $scope.escolaridad_benef = 'Secundaria';
    }
    else if (caseEscolaridad == 5) {
      $scope.escolaridad_benef = 'Técnico';
    }
    else if (caseEscolaridad == 6) {
      $scope.escolaridad_benef = 'Tecnológico';
    }
    else if (caseEscolaridad == 7) {
      $scope.escolaridad_benef = 'Universitario';
    }
    else if (caseEscolaridad == 8) {
      $scope.escolaridad_benef = 'Posgrado';
    }
    else if (caseEscolaridad == 9) {
      $scope.escolaridad_benef = 'Ninguno';
    }

  });



  $http.get(base_api + "/obtener/cultura/" + $routeParams.id)
  .success(function(response){



var caseCultura = response.id;

   
    if (caseCultura == 1) {
      $scope.cultura_benef = 'Negro';
    }
    else if (caseCultura == 2) {
      $scope.cultura_benef = 'Blanco';
    }
    else if (caseCultura == 3) {
      $scope.cultura_benef = 'Índigena';
    }
    else if (caseCultura == 4) {
      $scope.cultura_benef = 'Mestizo';
    }
    else if (caseCultura == 5) {
      $scope.cultura_benef = 'Mulato';
    }
    else if (caseCultura == 6) {
      $scope.cultura_benef = 'ROM, Gitano';
    }
    else if (caseCultura == 7) {
      $scope.cultura_benef = 'Palenquero';
    }
    else if (caseCultura == 8) {
      $scope.cultura_benef = 'Raizal';
    }
    else if (caseCultura == 9) {
      $scope.cultura_benef = 'No sabe-No responde';
    }
    else if (caseCultura == 10) {
      $scope.cultura_benef = 'Otro';
    }

  });




  $http.get(base_api + "/obtener/discapacidad/" + $routeParams.id)
  .success(function(response){



 var caseDiscapacidad = response.id;

   
    if (caseDiscapacidad == 1) {
      $scope.discapacidad_benef = 'Si';
    }
    else if (caseDiscapacidad == 2) {
      $scope.discapacidad_benef = 'No';
    }


  });



  $http.get(base_api + "/obtener/DiscapacidadOtra/" + $routeParams.id)
  .success(function(response){



 var caseDiscapacidadOtra = response.id;

   
    if (caseDiscapacidadOtra == 1) {
      $scope.discapacidad_otra_benef = 'Auditiva';
    }
    else if (caseDiscapacidadOtra == 2) {
      $scope.discapacidad_otra_benef = 'Cognitiva';
    }
    else if (caseDiscapacidadOtra == 3) {
      $scope.discapacidad_otra_benef = 'Mental';
    }
    else if (caseDiscapacidadOtra == 4) {
      $scope.discapacidad_otra_benef = 'Motriz';
    }
    else if (caseDiscapacidadOtra == 5) {
      $scope.discapacidad_otra_benef = 'Oral';
    }
    else if (caseDiscapacidadOtra == 6) {
      $scope.discapacidad_otra_benef = 'Visual';
    }


  });



  $http.get(base_api + "/obtener/enfermedadpermanente/" + $routeParams.id)
  .success(function(response){


 var caseEnfemerdad = response.id;

   
    if (caseEnfemerdad == 1) {
      $scope.enfermedad_benef = 'Si';
    }
    else if (caseEnfemerdad == 2) {
      $scope.enfermedad_benef = 'No';
    }


  });



  $http.get(base_api + "/obtener/medicamentopermanente/" + $routeParams.id)
  .success(function(response){



 var caseMedicamento = response.id;

   
    if (caseMedicamento == 1) {
      $scope.medicamento_benef = 'Si';
    }
    else if (caseMedicamento == 2) {
      $scope.medicamento_benef = 'No';
    }

  });


  $http.get(base_api + "/obtener/seguridadsocial/" + $routeParams.id)
  .success(function(response){



 var caseSeguridad = response.id;

   
    if (caseSeguridad == 1) {
      $scope.seguridad_benef = 'Si';
    }
    else if (caseSeguridad == 2) {
      $scope.seguridad_benef = 'No';
    }

  });



  $http.get(base_api + "/obtener/saludsgss/" + $routeParams.id)
  .success(function(response){



 var caseSalud = response.id;

   
    if (caseSalud == 1) {
      $scope.salud_benef = 'Regimen Contributivo (EPS)';
    }
    else if (caseSalud == 2) {
      $scope.salud_benef = 'Regimen Subsidiado (SISBEN-EPS-S)';
    }

    else if (caseSalud == 3) {
      $scope.salud_benef = 'Especial (FFMM, Policia, etc)';
    }

  });




  $http.get(base_api + "/obtener/documentoacudiente/" + $routeParams.id)
  .success(function(response){


 var caseTipoAcudiente = response.id;

    if (caseTipoAcudiente == 1) {
      $scope.tipodocumento_acudiente = 'Registro Civil';
    }
    else if (caseTipoAcudiente == 2) {
      $scope.tipodocumento_acudiente = 'Tarjeta Identidad';
    }

    else if (caseTipoAcudiente == 3) {
      $scope.tipodocumento_acudiente = 'Cédula de Ciudadanía';
    }
    
    else if (caseTipoAcudiente == 4) {
      $scope.tipodocumento_acudiente = 'Pasaporte';
    }

    else if (caseTipoAcudiente == 5) {
      $scope.tipodocumento_acudiente = 'Sin Información';
    }


  });


  $http.get(base_api + "/obtener/sexo_acudiente/" + $routeParams.id)
  .success(function(response){



    var caseSexoAcudiente = response.id;

   
    if (caseSexoAcudiente == 1) {
      $scope.sexo_acudient = 'Femenino';
    }
    else if (caseSexoAcudiente == 2) {
      $scope.sexo_acudient = 'Masculino';
    }

  });



  $http.get(base_api + "/obtener/parentesco/" + $routeParams.id)
  .success(function(response){


    var caseParentesco = response.id;

   
    if (caseParentesco == 1) {
      $scope.parentesco_acudient = 'Madre/Padre';
    }
    else if (caseParentesco == 2) {
      $scope.parentesco_acudient = 'Hermana/Hermano';
    }
    else if (caseParentesco == 3) {
      $scope.parentesco_acudient = 'Tia/Tio';
    }
   
    else if (caseParentesco == 4) {
      $scope.parentesco_acudient = 'Abuela/Abuelo';
    }

    else if (caseParentesco == 5) {
      $scope.parentesco_acudient = 'Cuidador';
    }

    else if (caseParentesco == 6) {
      $scope.parentesco_acudient = 'Otro';
    }


  });


  $scope.serie = {};
  $scope.getData();
  $http.get(base_api + "/obtenerselect/SedeGrupo/" + $routeParams.id)
  .success(function(response){
    $scope.dataSede = response;

  });


  $http.get(base_api + "/obtener/pais/" + $routeParams.id)
  .success(function(response){
    $scope.data = {
      'id': 1,
      'unit': response.id
    }

    $http.get(base_api + "/obtener/departamentos/" + $scope.data.unit)
    .success(function(response){
      $scope.departamentos = response;

    });

  });


  $http.get(base_api + "/obtener/paises")
  .success(function(response){
    $scope.paises = response;

  });

  $scope.selectedPais=function(item){

    $http.get(base_api + "/obtener/departamentos/" + item)
    .success(function(response){
      $scope.departamentos = response;

    });
  }    

  $scope.selectedDepartamento=function(item){

    $http.get(base_api + "/obtener/municipios/" + item)
    .success(function(response){
      $scope.municipios = response;

    });
  }    

  $http.get(base_api + "/obtener/departamento/" + $routeParams.id)
  .success(function(response){
    $scope.datas = {
      'id': 1,
      'unit': response.id
    }

    $http.get(base_api + "/obtener/municipios/" + $scope.datas.unit)
    .success(function(response){
      $scope.municipios = response;

    });

  });

  $http.get(base_api + "/obtener/municipio/" + $routeParams.id)
  .success(function(response){
    $scope.data_municipio = {
      'id': 1,
      'unit': response.id
    }
  });


  $http.get(base_api + "/obtenerselect/comunas")
  .success(function(response){
    $scope.comunas = response;
 // console.log($scope.comunas);

});

  $http.get(base_api + "/obtener/comuna/" + $routeParams.id)
  .success(function(response){
    $scope.data_comuna = {
      'id': 1,
      'unit': response.id
    }


    $http.get(base_api + "/obtener/barrios/" + $scope.data.unit)
    .success(function(response){
      $scope.barrios = response;

    });


  });

  $http.get(base_api + "/obtener/barrio/" + $routeParams.id)
  .success(function(response){
    $scope.data_barrio = {
      'id': 1,
      'unit': response.id
    }

  });


  $scope.selectedComuna=function(item){

    $http.get(base_api + "/obtener/barrios/" + item)
    .success(function(response){

      $scope.barrios = response;



    });
  }    



  Array.prototype.indexOfObjectWithProperty = function(propertyName, propertyValue)
  {
    for (var i = 0, len = this.length; i < len; i++)
    {
      if (this[i][propertyName] === propertyValue) return i;
    }

    return -1;
  };


  Array.prototype.containsObjectWithProperty = function(propertyName, propertyValue)
  {
    return this.indexOfObjectWithProperty(propertyName, propertyValue) != -1;
  };


  $scope.allGrupos_poblacionales = [
  {id: 1, name: 'Adulto Mayor'},
  {id: 2, name: 'Afrodescendiente/Afrocolombiano'},
  {id: 3, name: 'Víctimas del conflicto armado'},
  {id: 4, name: 'Habitante calle'},
  {id: 5, name: 'LGBTI'},
  {id: 6, name: 'Persona con discapacidad'},
  {id: 7, name: 'Grupo organizado de Mujeres'},
  {id: 8, name: 'Indígenas'},
  {id: 9, name: 'Reinsertado'},
  {id: 10, name: 'Junta de acción comunal (JAC)'},
  {id: 11, name: 'Grupo organizado de Jóvenes'},
  {id: 12, name: 'Ninguno'},
  {id: 13, name: 'Recluido'},
  {id: 14, name: 'Junta de administradora local (JAL)'},
  {id: 15, name: 'Otro grupo'},


  ];



  $http.get(base_api + "/obtener/poblacionales/" + $routeParams.id)
  .success(function(response){

    $scope.selectedPoblacionales = response;


  });


  $scope.toggleSelection = function toggleSelection(seleccion)
  {

    var index = $scope.selectedPoblacionales.indexOfObjectWithProperty('id', seleccion.id);


    if (index > -1)
    {
      $scope.selectedPoblacionales.splice(index, 1);

    }
    else
    {
      $scope.selectedPoblacionales.push(seleccion);
      console.log($scope.selectedPoblacionales);
    }
  };


  $scope.time1 = new Date();
  $scope.time2 = new Date();
  $scope.time2.setHours(7, 30);
  $scope.showMeridian = true;
  $scope.disabled = false;


  $scope.formsubmit = function(id, isValid){


 $scope.fecha_iscrip = $scope.fecha_inscripcions;
 var d_inscripcion_date = new Date($scope.fecha_iscrip); 
 var fecha_inscripcion_date = $.datepicker.formatDate('yy/mm/dd', d_inscripcion_date);
 var d_nacimiento_beneficiario = new Date($scope.fecha_nac); 
 var fecha_nacimiento_beneficiario = $.datepicker.formatDate('yy/mm/dd', d_nacimiento_beneficiario);
 $scope.fecha_nac_acud = $scope.fecha_acudiente;
 var d_nacimiento_acudiente = new Date($scope.fecha_nac_acud); 
 var fecha_nacimiento_acudiente = $.datepicker.formatDate('yy/mm/dd', d_nacimiento_acudiente);
    

if (isValid) {

   var datos ={

          grupo_id: $scope.serie.grupo_id,
          fecha_inscripcion: fecha_inscripcion_date,
          no_ficha: $scope.serie.no_ficha,
          programa_id: $scope.data_programa.unit,
          modalidad: $scope.serie.modalidad,
          punto_atencion: $scope.serie.punto_atencion,
          nombres_beneficiario: $scope.serie.nombres_beneficiario,
          apellidos_beneficiario: $scope.serie.apellidos_beneficiario,
          tipo_documento_beneficiario: $scope.obtener.documentoId,
          no_documento_beneficiario: $scope.serie.no_documento_beneficiario,
          sexo_beneficiario: $scope.obsexo.sexoId,
          fecha_nac_beneficiario: fecha_nacimiento_beneficiario,           
          edad_beneficiario: $scope.serie.edad_beneficiario,           
          telefono_beneficiario: $scope.serie.telefono_beneficiario,           
          correo_beneficiario: $scope.serie.correo_beneficiario,          
          pais_id: $scope.data.unit,           
          departamento_id: $scope.datas.unit,           
          municipio_id: $scope.data_municipio.unit,            
          direccion_beneficiario: $scope.serie.direccion_beneficiario,          
          estrato_beneficiario: $scope.serie.estrato_beneficiario,          
          comuna_id: $scope.data_comuna.unit,          
          barrio_id: $scope.data_barrio.unit,         
          corregimiento_beneficiario: $scope.serie.corregimiento_beneficiario,          
          vereda_beneficiario: $scope.serie.vereda_beneficiario,            
          estado_civil_beneficiario: $scope.obcivil.civilId,          
          hijos_beneficiario: $scope.obhijos.hijosId,            
          cantidad_hijos_beneficiario: $scope.serie.cantidad_hijos_beneficiario,                    
          tipo_sangre_beneficiario: $scope.obtipo_sangre.tipo_sangreId,            
          ocupacion_beneficiario: $scope.obocupacion.ocupacionId,           
          otra_ocupacion_beneficiario: $scope.serie.ocupacion_beneficiario,          
          escolaridad_beneficiario: $scope.obescolaridad.escolaridadId,         
          cultura_beneficiario: $scope.obcultura.culturaId,           
          otra_cultura_beneficiario: $scope.serie.otra_cultura_beneficiario,           
          discapacidad_beneficiario: $scope.obdiscapacidad.discapacidadId,            
          discapacidad_select_beneficiario: $scope.obdiscapacidadotro.discapacidadotroId,           
          otra_discapacidad_beneficiario: $scope.serie.otra_discapacidad_beneficiario,           
          enfermedad_permanente_beneficiario: $scope.obenfermedad.enfermedadId,           
          enfermedad_beneficiario: $scope.serie.enfermedad_beneficiario,           
          medicamentos_permanente_beneficiario: $scope.obmedicamento.medicamentoId,            
          medicamentos_beneficiario: $scope.serie.medicamentos_beneficiario,           
          seguridad_social_beneficiario: $scope.obseguridadsocial.seguridadsocialId,           
          salud_sgsss_beneficiario: $scope.obsaludsgss.saludsgssId,           
          nombre_seguridad_beneficiario: $scope.serie.nombre_seguridad_beneficiario,            
          nombres_acudiente: $scope.serie.nombres_acudiente,           
          apellidos_acudiente: $scope.serie.apellidos_acudiente,           
          tipo_doc_acudiente: $scope.obdoc_acudiente.doc_acudienteId,           
          documento_acudiente: $scope.serie.documento_acudiente,            
          sexo_acudiente: $scope.obsexo_acudiente.sexo_acudienteId,           
          fecha_nac_acudiente: fecha_nacimiento_acudiente,           
          edad_acudiente: $scope.serie.edad_acudiente,           
          telefono_acudiente: $scope.serie.telefono_acudiente,            
          correo_acudiente: $scope.serie.correo_acudiente,           
          parentesco_acudiente: $scope.obparentesco.parentescoId,          
          otro_parentesco_acudiente: $scope.serie.otro_parentesco_acudiente            
        };


    var poblacionales = $scope.selectedPoblacionales;
    
    $.ajax({
      url: base_api + '/postbeneficiario/actualizar/' + id,
      type: 'POST',
      dataType: 'JSON',
      data: {

        datos,
        poblacionales
      },
    }).success(function(){
      toastr.success("Su registro ha sido exitoso", "Registro Actualizado");
      window.location="/admin/postbeneficiarios#/admin/postbeneficiarios";

    })
    .error(function() {
      console.log("success");
    });

    }

  };

});
