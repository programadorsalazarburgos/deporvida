SeriesApp.controller("CreateSedeCtrl", function($scope, SedeService, fileUpload, $http, $location, base_api){
    $scope.title = "Agregar Sede";
    $scope.disable_submit = false;

    $scope.serie = {};


$http.get(base_api + "/obtenerselect/instituciones")
  .success(function(response){

    $scope.instituciones = response;


  });


$scope.formsubmit = function(isValid) {     
    
   
if (isValid) {


        var midata = new FormData();
        var institucion = $scope.institucion;           
        var literal = $scope.literal;           
        var nombre_sede = $scope.nombre_sede;           
        var direccion = $scope.direccion;           
        

        midata.append('institucion',institucion);
        midata.append('literal',  literal);
        midata.append('nombre_sede',  nombre_sede);
        midata.append('direccion',  direccion);
       
            
          $.ajax({
            url: base_api + '/postsede/create/',
            type: 'POST',
            contentType: false,
            data: midata,  // mandamos el objeto formdata que se igualo a la variable data
            processData: false,
            cache: false,
            success: function (respuestaAjax) {
            swal("Almacenado!", "Registro Guardado.", "success");
            window.location="/admin/postsedes#/admin/postsedes";
         
            }
          });



           }


        };	
	});






