SeriesApp.controller("CreateEpsCtrl", function($scope, EpsService, fileUpload, $http, $location, base_api){
    $scope.title = "Agregar Eps";
    $scope.disable_submit = false;

    $scope.serie = {};


$scope.formsubmit = function(isValid) {     
    
    if (isValid) {


        var midata = new FormData();
        var descripcion = $scope.descripcion;           

        midata.append('descripcion',descripcion);
            
          $.ajax({
            url: base_api + '/posteps/create',
            type: 'POST',
            contentType: false,
            data: midata,  // mandamos el objeto formdata que se igualo a la variable data
            processData: false,
            cache: false,
            success: function (respuestaAjax) {
            swal("Almacenado!", "Registro Guardado.", "success");
            window.location="/admin/posteps#/admin/posteps";

            }
          });

           }
        };	
	});






