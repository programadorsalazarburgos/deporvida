SeriesApp.controller("EditarBeneficiarioCtrl", function($scope, BeneficiarioService, $routeParams, fileUpload, $http, $location, $timeout, base_api){
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

  $scope.serie = {};
  $scope.getData();
  $http.get(base_api + "/obtenerselect/SedeGrupo/" + $routeParams.id)
  .success(function(response){
    $scope.dataSede = response;

  });

  $http.get(base_api + "/obtener/programa/" + $routeParams.id)
  .success(function(response){
    $scope.data_programa = {
      'id': 1,
      'unit': response.id
    }

  });

  $http.get(base_api + "/obtener/programas")
  .success(function(response){
    $scope.programas = response;

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



  $http.get(base_api + "/obtener/tipodocumento/" + $routeParams.id)
  .success(function(response){


    $scope.obtener = {};
    $scope.obtener.documentoId = response.id.toString();

    $scope.obtener.documentos = [
    {id: '1', nombre: 'Registro Civil'},
    {id: '2', nombre: 'Tarjeta Identidad'},
    {id: '3', nombre: 'Cédula de Ciudadanía'},
    {id: '4', nombre: 'Pasaporte'},
    {id: '5', nombre: 'Sin Información'},

    ];

  });


  $http.get(base_api + "/obtener/sexo/" + $routeParams.id)
  .success(function(response){


    $scope.obsexo = {};
    $scope.obsexo.sexoId = response.id.toString();

    $scope.obsexo.sexo = [
    {id: '1', nombre: 'Femenino'},
    {id: '2', nombre: 'Masculino'},

    ];

  });


  $http.get(base_api + "/obtener/civil/" + $routeParams.id)
  .success(function(response){


    $scope.obcivil = {};
    $scope.obcivil.civilId = response.id.toString();

    $scope.obcivil.civil = [
    {id: '1', nombre: 'Casado'},
    {id: '2', nombre: 'Soltero'},
    {id: '3', nombre: 'Unión Libre'},
    {id: '4', nombre: 'Viudo'},
    ];


  });



  $http.get(base_api + "/obtener/hijos/" + $routeParams.id)
  .success(function(response){


    $scope.obhijos = {};
    $scope.obhijos.hijosId = response.id.toString();

    $scope.obhijos.hijos = [
    {id: '1', nombre: 'Si'},
    {id: '2', nombre: 'No'},

    ];
  });


  $http.get(base_api + "/obtener/tiposangre/" + $routeParams.id)
  .success(function(response){


    $scope.obtipo_sangre = {};
    $scope.obtipo_sangre.tipo_sangreId = response.id.toString();

    $scope.obtipo_sangre.tipo_sangre = [
    {id: '1', nombre: 'O+'},
    {id: '2', nombre: 'O-'},
    {id: '3', nombre: 'A+'},
    {id: '4', nombre: 'A-'},
    {id: '5', nombre: 'B+'},
    {id: '6', nombre: 'B-'},
    {id: '7', nombre: 'AB+'},
    {id: '8', nombre: 'AB-'},

    ];
  });



  $http.get(base_api + "/obtener/ocupacion/" + $routeParams.id)
  .success(function(response){


    $scope.obocupacion = {};
    $scope.obocupacion.ocupacionId = response.id.toString();

    $scope.obocupacion.ocupacion = [
    {id: '1', nombre: 'Ama de casa'},
    {id: '2', nombre: 'Empleado'},
    {id: '3', nombre: 'Estudiante'},
    {id: '4', nombre: 'Desempleado'},
    {id: '5', nombre: 'Independiente'},
    {id: '6', nombre: 'Pensionado-Jubilado'},
    {id: '7', nombre: 'Servidor Público'},
    {id: '8', nombre: 'Otro'},

    ];
  });

  $http.get(base_api + "/obtener/escolaridad/" + $routeParams.id)
  .success(function(response){


    $scope.obescolaridad = {};
    $scope.obescolaridad.escolaridadId = response.id.toString();

    $scope.obescolaridad.escolaridad = [
    {id: '1', nombre: 'Educación inicial'},
    {id: '2', nombre: 'Preescolar'},
    {id: '3', nombre: 'Primaria'},
    {id: '4', nombre: 'Secundaria'},
    {id: '5', nombre: 'Técnico'},
    {id: '6', nombre: 'Tecnológico'},
    {id: '7', nombre: 'Universitario'},
    {id: '8', nombre: 'Posgrado'},
    {id: '9', nombre: 'Ninguno'},

    ];
  });


  $http.get(base_api + "/obtener/cultura/" + $routeParams.id)
  .success(function(response){


    $scope.obcultura = {};
    $scope.obcultura.culturaId = response.id.toString();

    $scope.obcultura.cultura = [
    {id: '1', nombre: 'Negro'},
    {id: '2', nombre: 'Blanco'},
    {id: '3', nombre: 'Índigena'},
    {id: '4', nombre: 'Mestizo'},
    {id: '5', nombre: 'Mulato'},
    {id: '6', nombre: 'ROM, Gitano'},
    {id: '7', nombre: 'Palenquero'},
    {id: '8', nombre: 'Raizal'},
    {id: '9', nombre: 'No sabe-No responde'},
    {id: '10', nombre: 'Otro'},

    ];
  });



  $http.get(base_api + "/obtener/discapacidad/" + $routeParams.id)
  .success(function(response){


    $scope.obdiscapacidad = {};
    $scope.obdiscapacidad.discapacidadId = response.id.toString();

    $scope.obdiscapacidad.discapacidad = [
    {id: '1', nombre: 'Si'},
    {id: '2', nombre: 'No'},

    ];
  });


  $http.get(base_api + "/obtener/DiscapacidadOtra/" + $routeParams.id)
  .success(function(response){


    $scope.obdiscapacidadotro = {};
    $scope.obdiscapacidadotro.discapacidadotroId = response.id.toString();

    $scope.obdiscapacidadotro.discapacidadotro = [
    {id: '1', nombre: 'Auditiva'},
    {id: '2', nombre: 'Cognitiva'},
    {id: '3', nombre: 'Mental'},
    {id: '4', nombre: 'Motriz'},
    {id: '5', nombre: 'Oral'},
    {id: '6', nombre: 'Visual'},        

    ];
  });


  $http.get(base_api + "/obtener/enfermedadpermanente/" + $routeParams.id)
  .success(function(response){

console.log(response);
    $scope.obenfermedad = {};
    $scope.obenfermedad.enfermedadId = response.id.toString();

    $scope.obenfermedad.enfermedad = [
      {id: '1', nombre: 'Si'},
      {id: '2', nombre: 'No'},
      

    ];
  });




  $http.get(base_api + "/obtener/medicamentopermanente/" + $routeParams.id)
  .success(function(response){

console.log(response);
    $scope.obmedicamento = {};
    $scope.obmedicamento.medicamentoId = response.id.toString();

    $scope.obmedicamento.medicamento = [
      {id: '1', nombre: 'Si'},
      {id: '2', nombre: 'No'},
      

    ];
  });




  $http.get(base_api + "/obtener/seguridadsocial/" + $routeParams.id)
  .success(function(response){

console.log(response);
    $scope.obseguridadsocial = {};
    $scope.obseguridadsocial.seguridadsocialId = response.id.toString();

    $scope.obseguridadsocial.seguridadsocial = [
      {id: '1', nombre: 'Si'},
      {id: '2', nombre: 'No'},
      

    ];
  });




  $http.get(base_api + "/obtener/saludsgss/" + $routeParams.id)
  .success(function(response){

    $scope.obsaludsgss = {};
    $scope.obsaludsgss.saludsgssId = response.id.toString();

    $scope.obsaludsgss.saludsgss = [

      {id: '1', nombre: 'Regimen Contributivo (EPS)'},
      {id: '2', nombre: 'Regimen Subsidiado (SISBEN-EPS-S)'},
      {id: '3', nombre: 'Especial (FFMM, Policia, etc)'},

      

    ];
  });




  $http.get(base_api + "/obtener/documentoacudiente/" + $routeParams.id)
  .success(function(response){

    $scope.obdoc_acudiente = {};
    $scope.obdoc_acudiente.doc_acudienteId = response.id.toString();

    $scope.obdoc_acudiente.doc_acudiente = [

        {id: '1', nombre: 'Registro Civil'},
        {id: '2', nombre: 'Tarjeta Identidad'},
        {id: '3', nombre: 'Cédula de Ciudadanía'},
        {id: '4', nombre: 'Pasaporte'},
        {id: '5', nombre: 'Sin Información'},
      

    ];
  });



  $http.get(base_api + "/obtener/sexo_acudiente/" + $routeParams.id)
  .success(function(response){

    $scope.obsexo_acudiente = {};
    $scope.obsexo_acudiente.sexo_acudienteId = response.id.toString();

    $scope.obsexo_acudiente.sexo_acudiente = [

     {id: '1', nombre: 'Femenino'},
     {id: '2', nombre: 'Masculino'},
 

    ];
  });




  $http.get(base_api + "/obtener/parentesco/" + $routeParams.id)
  .success(function(response){

    $scope.obparentesco = {};
    $scope.obparentesco.parentescoId = response.id.toString();

    $scope.obparentesco.parentesco = [
 
        {id: '1', nombre: 'Madre/Padre'},
        {id: '2', nombre: 'Hermana/Hermano'},
        {id: '3', nombre: 'Tia/Tio'},
        {id: '4', nombre: 'Abuela/Abuelo'},
        {id: '5', nombre: 'Cuidador'},
        {id: '6', nombre: 'Otro'},


    ];
  });



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
