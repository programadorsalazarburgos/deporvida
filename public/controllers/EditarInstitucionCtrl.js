SeriesApp.controller("EditarInstitucionCtrl", function($scope, InstitucionService, $routeParams, fileUpload, $http, $location, $timeout, base_api){
    $scope.title = "Editar Institución";
    $scope.series = [];
    $scope.getData = function(){
    $scope.serie = InstitucionService.get({id:$routeParams.id});

    

};
 
 $scope.mostrarPistos = function() { 
  
    obtenerPistos($http,$scope,$scope.selCategorias)

         
};


function obtenerPistos($http,$scope,id){
   
 var url = base_api + "/obtenerselect/barrios/" + id;

 $http.get(url ,{ metodo : 'obtenerPistos' , id : id })
        .success(function(data) {
            $scope.JSONPistos  = data;
        })
        .error(function(data) {
            console.log('Error: ' + data);
        });


  }


$http.get(base_api + "/obtenerselect/comunabarrio/" + $routeParams.id)
  .success(function(response){

        $scope.data3 = response;
         $scope.data2 = {
        'id': 1,
        'unit': response.id
        }

     
  });


$http.get(base_api + "/obtenerselect/barrio/" + $routeParams.id)
  .success(function(response){

         $scope.data2 = response;
         $scope.data = {
        'id': 1,
        'unit': response.id
        }

   
  });


    $scope.serie = {};



$scope.disabled = undefined;

  $scope.enable = function() {
    $scope.disabled = false;
  };

  $scope.disable = function() {
    $scope.disabled = true;
  };

  $scope.clear = function() {
    $scope.person.selected = undefined;
    $scope.address.selected = undefined;
    $scope.country.selected = undefined;
  };

  $scope.person = {};
 


$http.get(base_api + "/obtenerselect/barrios")
  .success(function(response){

    $scope.people = response;

  });


  $scope.address = {};
  $scope.refreshAddresses = function(address) {
    var params = {address: address, sensor: false};
    return $http.get(
      'http://maps.googleapis.com/maps/api/geocode/json',
      {params: params}
    ).then(function(response) {
      $scope.addresses = response.data.results
    });
  };



$scope.prueba = function(){
 
  $('#seleccionado').hide();

 }


$scope.getData();

 $scope.formsubmit = function(id,isValid){
        
if (isValid) {


        var midata = new FormData();
        var nombre_institucion = $scope.serie.nombre_institucion;   
        var codigo_dane = $scope.serie.codigo_dane;   
        var telefono = $scope.serie.telefono;   
        var direccion = $scope.serie.direccion ;   
        var nombre_rector = $scope.serie.nombre_rector;   
        var obt_barrio = $scope.person.id;   
       
        if(obt_barrio == undefined){

          obt_barrio = 0;
          var barrio = obt_barrio;

        }
        else{
        var barrio = obt_barrio['id']
        
        }
        midata.append('nombre_institucion',nombre_institucion);
        midata.append('codigo_dane',  codigo_dane);
        midata.append('telefono',  telefono);
        midata.append('direccion',  direccion);
        midata.append('nombre_rector',  nombre_rector);
        midata.append('barrio',  barrio);
       
            
          $.ajax({
            url: base_api + '/postinstituciones/editarInstitucion/' + id,
            type: 'POST',
            contentType: false,
            data: midata,  // mandamos el objeto formdata que se igualo a la variable data
            processData: false,
            cache: false,
            success: function (respuestaAjax) {
            swal("Almacenado!", "Registro Guardado.", "success");
            window.location="/admin/postinstituciones#/admin/postinstituciones";
         
            }
          });
        }
      };
});
