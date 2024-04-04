SeriesApp.controller("CreateInstitucionCtrl", function($scope, InstitucionService, fileUpload, $http, $location, base_api){
    $scope.title = "Agregar Institucion";
    $scope.disable_submit = false;

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


  
$scope.formsubmit = function(isValid) {     
    
   
if (isValid) {


        var midata = new FormData();
        var nombre_institucion = $scope.nombre_institucion;   
        var codigo_dane = $scope.codigo_dane;   
        var telefono = $scope.telefono;   
        var direccion = $scope.direccion ;   
        var nombre_rector = $scope.nombre_rector;   
        var obt_barrio = $scope.person.id;   
        var barrio = obt_barrio['id']
        


        midata.append('nombre_institucion',nombre_institucion);
        midata.append('codigo_dane',  codigo_dane);
        midata.append('telefono',  telefono);
        midata.append('direccion',  direccion);
        midata.append('codigo_dane',  codigo_dane);
        midata.append('nombre_rector',  nombre_rector);
        midata.append('barrio',  barrio);
       
            
          $.ajax({
            url: base_api + '/postinstitucion/create',
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






