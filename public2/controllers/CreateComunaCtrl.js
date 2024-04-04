SeriesApp.controller("CreateComunaCtrl", function($scope, ComunaService, fileUpload, $http, $location, base_api){
    $scope.title = "Agregar Comuna";
    $scope.disable_submit = false;

    $scope.serie = {};


$http.get(base_api + "/obtenerselect/zonas")
  .success(function(response){

    $scope.zonas = response;


  });


$scope.formsubmit = function(isValid) {     
    
   
if (isValid) {


        var midata = new FormData();
        var codigo_comuna = $scope.codigo_comuna;           
        var nombre_comuna = $scope.nombre_comuna;           
        var zona = $scope.zona;           


        midata.append('codigo_comuna',codigo_comuna);
        midata.append('nombre_comuna',  nombre_comuna);
        midata.append('zona',  zona);
       
            
          $.ajax({
            url: base_api + '/postcomuna/create',
            type: 'POST',
            contentType: false,
            data: midata,  // mandamos el objeto formdata que se igualo a la variable data
            processData: false,
            cache: false,
            success: function (respuestaAjax) {
            swal("Almacenado!", "Registro Guardado.", "success");
            window.location="/admin/postcomunas#/admin/postcomunas";
         
            }
          });



           }


        };	
	});






