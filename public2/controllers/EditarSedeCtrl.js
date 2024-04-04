SeriesApp.controller("EditarSedeCtrl", function($scope, SedeService, $routeParams, fileUpload, $http, $location, $timeout, base_api){
    $scope.title = "Editar Sede";
    $scope.series = [];
    $scope.getData = function(){
    $scope.serie = SedeService.get({id:$routeParams.id});

    

};


$http.get(base_api + "/obtenerselect/institucion/" + $routeParams.id)
  .success(function(response){


        var hashids = new Hashids('', 10);  
         $scope.data = {
        'id': 1,
        'unit': response.id
        }

   
     

  });


$http.get(base_api + "/obtenerselect/instituciones")
  .success(function(response){

    $scope.instituciones = response;
 
  });



$scope.getData();

 $scope.formsubmit = function(id,isValid){
        

if (isValid) {


        var midata = new FormData();
		    var obtener_institucion = $("#institucion").val();    
        var institucion = obtener_institucion.replace('string:', '');
        var literal = $scope.serie.literal;
        var nombre_sede = $scope.serie.nombre_sede;
        var direccion = $scope.serie.direccion;
     
        midata.append('institucion',institucion);
        midata.append('literal',literal);
        midata.append('nombre_sede',nombre_sede);
        midata.append('direccion',direccion);
            
          $.ajax({
            url: base_api + '/postsedes/editarSede/'+ id,
            type: 'POST',
            contentType: false,
            data: midata,  // mandamos el objeto formdata que se igualo a la variable data
            processData: false,
            cache: false,
            success: function (respuestaAjax) {
            swal("Almacenado!", "Registro Actualizado.", "success");
            window.location="/admin/postsedes#/admin/postsedes";

            }
          });

           }


     
   };



});
