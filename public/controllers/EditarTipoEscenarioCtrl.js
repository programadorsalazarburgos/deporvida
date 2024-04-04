SeriesApp.controller("EditarTipoEscenarioCtrl", function($scope, TipoEscenarioService, $routeParams, fileUpload, $http, $location, $timeout, base_api){
    $scope.title = "Editar Tipo Escenario";
    $scope.series = [];
    $scope.getData = function(){
    $scope.serie = TipoEscenarioService.get({id:$routeParams.id});

    

};


$scope.getData();

 $scope.formsubmit = function(id,isValid){
        

if (isValid) {


        var midata = new FormData();
		    var nombre_tipo_escenario = $scope.serie.nombre_tipo_escenario;
       
        midata.append('nombre_tipo_escenario',nombre_tipo_escenario);
            
          $.ajax({
            url: base_api + '/posttipoescenarios/editarTipoEscenario/'+ id,
            type: 'POST',
            contentType: false,
            data: midata,  // mandamos el objeto formdata que se igualo a la variable data
            processData: false,
            cache: false,
            success: function (respuestaAjax) {
            swal("Almacenado!", "Registro Actualizado.", "success");
            window.location="/admin/posttipoescenarios#/admin/posttipoescenarios";

            }
          });

           }


     
   };



});
