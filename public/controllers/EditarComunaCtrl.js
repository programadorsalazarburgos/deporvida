SeriesApp.controller("EditarComunaCtrl", function($scope, ComunaService, $routeParams, fileUpload, $http, $location, $timeout, base_api){
    $scope.title = "Editar Comuna";
    $scope.series = [];
    $scope.getData = function(){
    $scope.serie = ComunaService.get({id:$routeParams.id});

    

};


$http.get(base_api + "/obtenerselect/zona/" + $routeParams.id)
  .success(function(response){
         $scope.data = {
        'id': 1,
        'unit': response.id
        }

  });


$http.get(base_api + "/obtenerselect/zonas")
  .success(function(response){

    $scope.zonas = response;
  });



$scope.getData();

 $scope.formsubmit = function(id,isValid){
        

if (isValid) {


        var midata = new FormData();
		var codigo_comuna = $scope.serie.codigo_comuna;
        var nombre_comuna = $scope.serie.nombre_comuna;
        var obtener_zona = $("#zona").val();    
        var zona = obtener_zona.replace('number:', '');
    
        midata.append('codigo_comuna',codigo_comuna);
        midata.append('nombre_comuna',nombre_comuna);
        midata.append('zona',zona);
            
          $.ajax({
            url: base_api + '/postcomunas/editarComuna/'+ id,
            type: 'POST',
            contentType: false,
            data: midata,  // mandamos el objeto formdata que se igualo a la variable data
            processData: false,
            cache: false,
            success: function (respuestaAjax) {
            swal("Almacenado!", "Registro Actualizado.", "success");
            window.location="/admin/postcomunas#/admin/postcomunas";

            }
          });

           }


     
   };



});
