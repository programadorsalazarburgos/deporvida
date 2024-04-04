SeriesApp.controller("BeneficiarioGrupoCtrl", function($scope, GrupoService, $routeParams, fileUpload, $http, $location, $timeout, base_api){
  $scope.title = "Beneficiario Grupo";
  $scope.series = [];
  $scope.getData = function(){
    $scope.serie = GrupoService.get({id:$routeParams.id});


 };

 $scope.serie = {};
 $scope.getData();


 function calcularEdad(birthday) {
  var birthday_arr = birthday.split("/");
  var birthday_date = new Date(birthday_arr[2], birthday_arr[1] - 1, birthday_arr[0]);
  var ageDifMs = Date.now() - birthday_date.getTime();
  var ageDate = new Date(ageDifMs);
  return Math.abs(ageDate.getUTCFullYear() - 1970);
}



Date.prototype.addDays = function(days) {
  var dat = new Date(this.valueOf());
  dat.setDate(dat.getDate() + days);
  return dat;
}

function init() {
  $scope.startDate = new Date();
  $scope.endDate = $scope.startDate.addDays(14);
  $scope.startDateParentesco = new Date();
  $scope.startDateInscripcion = new Date();
  $scope.endDatep = $scope.startDateParentesco.addDays(14);  
  $scope.endDateInscripcion = $scope.startDateInscripcion.addDays(14);  

}


function load() {

 $scope.fecha_nacimiento = $scope.startDate;
 var d = new Date($scope.fecha_nacimiento); 
 var fecha = $.datepicker.formatDate('dd/mm/yy', d);
 var n = fecha.toString();
 $scope.edad_beneficiario = calcularEdad(n);


}




function load_parentesco() {

 $scope.fecha_nacimiento_pariente = $scope.startDateParentesco;
 var d_pariente = new Date($scope.fecha_nacimiento_pariente); 
 var fecha_pariente = $.datepicker.formatDate('dd/mm/yy', d_pariente);
 var n_pariente = fecha_pariente.toString();
 $scope.edad_pariente = calcularEdad(n_pariente);

}



init();
    // public methods
    $scope.load = load;
    $scope.load_parentesco = load_parentesco;
    $scope.setStart = function(date) {
      $scope.startDate = date;
    };


    $scope.setStartInscripcion = function(date) {
      $scope.startDateInscripcion = date;
    };


    $scope.setStartParentesco = function(date) {
      $scope.startDateParentesco = date;
    };



    $scope.setEnd = function(date) {
      $scope.endDate = date;
      $scope.endDatep = date;
      $scope.endDateInscripcion = date;
    };


    $scope.tipo_documento = [
    {id: '1', nombre: 'Registro Civil'},
    {id: '2', nombre: 'Tarjeta Identidad'},
    {id: '3', nombre: 'Cédula de Ciudadanía'},
    {id: '4', nombre: 'Pasaporte'},
    {id: '5', nombre: 'Sin Información'},

    ];



    $scope.sexo = [
    {id: '1', nombre: 'Femenino'},
    {id: '2', nombre: 'Masculino'},

    ];


    $scope.estado_civil_beneficiario = [
    {id: '1', nombre: 'Casado'},
    {id: '2', nombre: 'Soltero'},
    {id: '3', nombre: 'Unión Libre'},
    {id: '4', nombre: 'Viudo'},

    ];


    $scope.tipo_sangre = [
    {id: '1', nombre: 'O+'},
    {id: '2', nombre: 'O-'},
    {id: '3', nombre: 'A+'},
    {id: '4', nombre: 'A-'},
    {id: '5', nombre: 'B+'},
    {id: '6', nombre: 'B-'},
    {id: '7', nombre: 'AB+'},
    {id: '8', nombre: 'AB-'},

    ];



    $scope.ocupaciones = [
    {id: '1', nombre: 'Ama de casa'},
    {id: '2', nombre: 'Empleado'},
    {id: '3', nombre: 'Estudiante'},
    {id: '4', nombre: 'Desempleado'},
    {id: '5', nombre: 'Independiente'},
    {id: '6', nombre: 'Pensionado-Jubilado'},
    {id: '7', nombre: 'Servidor Público'},
    {id: '8', nombre: 'Otro'},

    ];


    $scope.escolaridades = [
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



    $scope.culturas = [
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


    $scope.grupos_poblacionales = [
    {id: '1', nombre: 'Adulto Mayor'},
    {id: '2', nombre: 'Afrodescendiente/Afrocolombiano'},
    {id: '3', nombre: 'Víctimas del conflicto armado'},
    {id: '4', nombre: 'Habitante calle'},
    {id: '5', nombre: 'LGBTI'},
    {id: '6', nombre: 'Persona con discapacidad'},
    {id: '7', nombre: 'Grupo organizado de Mujeres'},
    {id: '8', nombre: 'Indígenas'},
    {id: '9', nombre: 'Reinsertado'},
    {id: '10', nombre: 'Junta de acción comunal (JAC)'},
    {id: '11', nombre: 'Grupo organizado de Jóvenes'},
    {id: '12', nombre: 'Ninguno'},
    {id: '13', nombre: 'Recluido'},
    {id: '14', nombre: 'Junta de administradora local (JAL)'},
    {id: '15', nombre: 'Otro grupo'},


    ];



  $scope.selected = {
            poblacionales: []
        };
      


    $scope.hijos = [
    {id: '1', nombre: 'Si'},
    {id: '2', nombre: 'No'},

    ];


    $scope.discapacidades = [
    {id: '1', nombre: 'Si'},
    {id: '2', nombre: 'No'},

    ];



    $scope.discapacidad_otra = [
    {id: '1', nombre: 'Auditiva'},
    {id: '2', nombre: 'Cognitiva'},
    {id: '3', nombre: 'Mental'},
    {id: '4', nombre: 'Motriz'},
    {id: '5', nombre: 'Oral'},
    {id: '6', nombre: 'Visual'},

    ];


    $scope.enfermedades = [
    {id: '1', nombre: 'Si'},
    {id: '2', nombre: 'No'},

    ];



    $scope.medicamentos = [
    {id: '1', nombre: 'Si'},
    {id: '2', nombre: 'No'},

    ];



    $scope.medicamentos = [
    {id: '1', nombre: 'Si'},
    {id: '2', nombre: 'No'},

    ];



    $scope.seguridad_social = [
    {id: '1', nombre: 'Si'},
    {id: '2', nombre: 'No'},

    ];



    $scope.salud_sgsss = [
    {id: '1', nombre: 'Regimen Contributivo (EPS)'},
    {id: '2', nombre: 'Regimen Subsidiado (SISBEN-EPS-S)'},
    {id: '3', nombre: 'Especial (FFMM, Policia, etc)'},

    ];


    $scope.parentescos = [
    {id: '1', nombre: 'Madre/Padre'},
    {id: '2', nombre: 'Hermana/Hermano'},
    {id: '3', nombre: 'Tia/Tio'},
    {id: '4', nombre: 'Abuela/Abuelo'},
    {id: '5', nombre: 'Cuidador'},
    {id: '6', nombre: 'Otro'},

    ];



    $http.get(base_api + "/obtener/programas")
    .success(function(response){

      $scope.programas = response;


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
    



    $http.get(base_api + "/obtenerselect/comunas")
    .success(function(response){

      $scope.comunas = response;


    });




    $scope.selectedComuna=function(item){

      $http.get(base_api + "/obtener/barrios/" + item)
      .success(function(response){

        $scope.barrios = response;



      });
    }    


    $scope.isDisabled = true;
    $scope.isDisabledOcupacion = true;
    $scope.isDisabledCultura = true;
    $scope.isDisabledDiscapacidad = true;
    $scope.isDisabledEnfermedad = true;
    $scope.isDisabledMedicamento = true;
    $scope.isDisabledSeguridad = true;
    $scope.isDisabledParentesco = true;


    $scope.selectedHijos=function(item){



      if (item == 1) {
        $scope.isDisabled = false;
      }
      else{

        $scope.isDisabled = true;

      }

    }   




    $scope.selectedOcupacion=function(item){



      if (item == 8) {
        $scope.isDisabledOcupacion = false;
      }
      else{

        $scope.isDisabledOcupacion = true;

      }

    }   



    $scope.selectedCultura=function(item){


      if (item == 10) {
        $scope.isDisabledCultura = false;
      }
      else{

        $scope.isDisabledCultura = true;

      }

    }   


    $scope.selectedDiscapacidad=function(item){


      if (item == 1) {
        $scope.isDisabledDiscapacidad = false;
      }
      else{

        $scope.isDisabledDiscapacidad = true;

      }

    }   





    $scope.selectedEnfermedad=function(item){


      if (item == 1) {
        $scope.isDisabledEnfermedad = false;
      }
      else{

        $scope.isDisabledEnfermedad = true;

      }

    }   



    $scope.selectedMedicamento=function(item){


      if (item == 1) {
        $scope.isDisabledMedicamento = false;
      }
      else{

        $scope.isDisabledMedicamento = true;

      }

    }   


    $scope.selectedSeguridad=function(item){


      if (item == 1) {
        $scope.isDisabledSeguridad = false;
      }
      else{

        $scope.isDisabledSeguridad = true;

      }

    }   


    $scope.selectedParentesco=function(item){


      if (item == 6) {
        $scope.isDisabledParentesco = false;
      }
      else{

        $scope.isDisabledParentesco = true;

      }

    }   


    $scope.selection = [];



    $scope.today = function () {
      $scope.dt = new Date();
    };
    $scope.today();

    $scope.openCalendar = function ($event) {
      $event.preventDefault();
      $event.stopPropagation();
      $scope.opened = true;
    }



    $scope.openCalendarNacimiento = function ($event) {


      $event.preventDefault();
      $event.stopPropagation();
      $scope.opened = true;
    }




    $scope.keyup = function (IsActive) {
      if (!IsActive) {
        $scope.IsActive = true;
                      // alert($scope.firstName);
                      // var age = calcularEdad("26/11/1986");
                      // alert( age );
                    } else {
                      $scope.IsActive = false;
                    }
                  }


    $scope.formsubmit = function(id, isValid){
     $scope.fecha_iscrip = $scope.startDateInscripcion;
     var d_inscripcion_date = new Date($scope.fecha_iscrip); 
     var fecha_inscripcion_date = $.datepicker.formatDate('yy/mm/dd', d_inscripcion_date);
     $scope.fecha_nac_benef = $scope.startDate;
     var d_nacimiento_beneficiario = new Date($scope.fecha_nac_benef); 
     var fecha_nacimiento_beneficiario = $.datepicker.formatDate('yy/mm/dd', d_nacimiento_beneficiario);
     $scope.fecha_nac_acud = $scope.startDateParentesco;
     var d_nacimiento_acudiente = new Date($scope.fecha_nac_acud); 
     var fecha_nacimiento_acudiente = $.datepicker.formatDate('yy/mm/dd', d_nacimiento_acudiente);
     var SelectPoblacional = $scope.selected.poblacionales;     


       if (isValid) {


         var datos ={
          fecha_inscripcion: fecha_inscripcion_date,
          no_ficha: $scope.numero_ficha,
          programa_id: $scope.programa,
          modalidad: $scope.modalidad,
          punto_atencion: $scope.punto_atencion,
          nombres_beneficiario: $scope.nombres_beneficiario,
          apellidos_beneficiario: $scope.apellidos_beneficiario,
          tipo_documento_beneficiario: $scope.tipo_documento_beneficiario,
          no_documento_beneficiario: $scope.no_documento_beneficiario,
          sexo_beneficiario: $scope.sexo_beneficiario,
          fecha_nac_beneficiario: fecha_nacimiento_beneficiario,           
          edad_beneficiario: $scope.edad_beneficiario,           
          telefono_beneficiario: $scope.telefono_beneficiario,           
          correo_beneficiario: $scope.correo_beneficiario,          
          pais_id: $scope.pais,           
          departamento_id: $scope.departamento,           
          municipio_id: $scope.municipio,            
          direccion_beneficiario: $scope.residencia_beneficiario,          
          estrato_beneficiario: $scope.estrato,          
          comuna_id: $scope.comuna,          
          barrio_id: $scope.barrio,         
          corregimiento_beneficiario: $scope.corregimiento,          
          vereda_beneficiario: $scope.vereda,            
          estado_civil_beneficiario: $scope.est_beneficiario,          
          hijos_beneficiario: $scope.hijo,            
          cantidad_hijos_beneficiario: $scope.cantidad_hijos,                    
          tipo_sangre_beneficiario: $scope.tip_sangre,            
          ocupacion_beneficiario: $scope.ocupacion,           
          otra_ocupacion_beneficiario: $scope.ocupacion_otra,          
          escolaridad_beneficiario: $scope.escolaridad,         
          cultura_beneficiario: $scope.cultura,           
          otra_cultura_beneficiario: $scope.cultura_otro,           
          discapacidad_beneficiario: $scope.discapacidad,            
          discapacidad_select_beneficiario: $scope.discapacidad_otro,           
          otra_discapacidad_beneficiario: $scope.otra_discapacidad,           
          enfermedad_permanente_beneficiario: $scope.enfermedad,           
          enfermedad_beneficiario: $scope.otra_enfermedad,           
          medicamentos_permanente_beneficiario: $scope.medicamento,            
          medicamentos_beneficiario: $scope.medicamento_otro,           
          seguridad_social_beneficiario: $scope.seguridad,           
          salud_sgsss_beneficiario: $scope.salud,           
          nombre_seguridad_beneficiario: $scope.nombre_entidad,            
          nombres_acudiente: $scope.nombres_familiar,           
          apellidos_acudiente: $scope.apellidos_familiar,           
          tipo_doc_acudiente: $scope.tipo_familiar,           
          documento_acudiente: $scope.no_documento_pariente,            
          sexo_acudiente: $scope.sex_pariente,           
          fecha_nac_acudiente: fecha_nacimiento_acudiente,           
          edad_acudiente: $scope.edad_pariente,           
          telefono_acudiente: $scope.telefono_pariente,            
          correo_acudiente: $scope.email_pariente,           
          parentesco_acudiente: $scope.parentesco,          
          otro_parentesco_acudiente: $scope.otro_parentesco            
        };



 $.ajax({
          url: base_api + '/postbeneficiario/create/' + id,
          type: 'POST',
          dataType: 'JSON',
          data: {
            datos,
            SelectPoblacional
        },
    
        }).success(function(){
         
            toastr.success("Su registro ha sido exitoso", "Registro Almacenado");
            window.location="/admin/postgrupos#/admin/postgrupos";


        })
        .error(function() {
          console.log("success");
        });


      }


    };



  });
