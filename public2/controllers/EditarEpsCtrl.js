SeriesApp.controller("EditarEpsCtrl", function($scope, EpsService, $routeParams, fileUpload, $http, $location, $timeout, base_api){
    $scope.title = "Editar Eps";
    $scope.series = [];
    $scope.getData = function(){
    $scope.serie = EpsService.get({id:$routeParams.id});

    

};

$scope.getData();

 $scope.formsubmit = function(id,isValid){
        

if (isValid) {


        var midata = new FormData();
		var descripcion = $scope.serie.descripcion;

        midata.append('descripcion',descripcion);
            
          $.ajax({
            url: base_api + '/posteps/editarEps/'+ id,
            type: 'POST',
            contentType: false,
            data: midata,  // mandamos el objeto formdata que se igualo a la variable data
            processData: false,
            cache: false,
            success: function (respuestaAjax) {
            swal("Almacenado!", "Registro Actualizado.", "success");
            window.location="/admin/posteps#/admin/posteps";

            }
          });

           }


     
   };



});
