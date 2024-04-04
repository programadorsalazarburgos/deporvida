SeriesApp.controller("CreateTipoEscenarioCtrl", function($scope, fileUpload, $http, $location, base_api){
    $scope.title = "Agregar Tipo Escenario";
    $scope.disable_submit = false;

    $scope.serie = {};



$scope.formsubmit = function(isValid) {     
    
   
if (isValid) {


        var midata = new FormData();
        var nombre_tipo_escenario = $scope.nombre_tipo_escenario;            

        midata.append('nombre_tipo_escenario',nombre_tipo_escenario);
       
            
          $.ajax({
            url: base_api + '/posttipoescenario/create/',
            type: 'POST',
            contentType: false,
            data: midata,  // mandamos el objeto formdata que se igualo a la variable data
            processData: false,
            cache: false,
            success: function (respuestaAjax) {
            swal("Almacenado!", "Registro Guardado.", "success");
            window.location="/admin/posttipoescenarios#/admin/posttipoescenarios";
         
            }
          });



           }


        };	
	});






