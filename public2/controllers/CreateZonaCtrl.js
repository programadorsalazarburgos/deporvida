SeriesApp.controller("CreateZonaCtrl", function($scope, ZonaService, fileUpload, $http, $location, base_api){
    $scope.title = "Agregar Zona";
    $scope.disable_submit = false;

    $scope.serie = {};



$scope.formsubmit = function(isValid) {     
    
    if (isValid) {


        var midata = new FormData();
        var nombre_zona = $scope.nombre_zona;           

        midata.append('nombre_zona',nombre_zona);
            
          $.ajax({
            url: base_api + '/postzona/create',
            type: 'POST',
            contentType: false,
            data: midata,  // mandamos el objeto formdata que se igualo a la variable data
            processData: false,
            cache: false,
            success: function (respuestaAjax) {
            swal("Almacenado!", "Registro Guardado.", "success");
            window.location="/admin/postzonas#/admin/postzonas";

            }
          });

           }
        };	
	});






