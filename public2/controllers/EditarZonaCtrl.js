SeriesApp.controller("EditarZonaCtrl", function($scope, ZonaService, $routeParams, fileUpload, $http, $location, $timeout, base_api){
    $scope.title = "Editar Zona";
    $scope.series = [];
    $scope.getData = function(){
    $scope.serie = ZonaService.get({id:$routeParams.id});

    

};

$scope.getData();

 $scope.formsubmit = function(id,isValid){
        

if (isValid) {


        var midata = new FormData();
		var nombre_zona = $scope.serie.nombre_zona;

        midata.append('nombre_zona',nombre_zona);
            
          $.ajax({
            url: base_api + '/postzonas/editarZona/'+ id,
            type: 'POST',
            contentType: false,
            data: midata,  // mandamos el objeto formdata que se igualo a la variable data
            processData: false,
            cache: false,
            success: function (respuestaAjax) {
            swal("Almacenado!", "Registro Actualizado.", "success");
            window.location="/admin/postzonas#/admin/postzonas";

            }
          });

           }


     
   };



});
