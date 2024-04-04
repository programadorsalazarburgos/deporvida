SeriesApp.controller("CreateBarrioCtrl", function($scope, BarrioService, fileUpload, $http, $location, base_api){
    $scope.title = "Agregar Barrio";
    $scope.disable_submit = false;

    $scope.serie = {};


$http.get(base_api + "/obtenerselect/comunas")
  .success(function(response){

    $scope.comunas = response;


  });


$scope.formsubmit = function(isValid) {     
    
   
if (isValid) {


        var midata = new FormData();
        var nombre_barrio = $scope.nombre_barrio;           
        var comuna = $scope.comuna;           
        var codigo = $scope.codigo;           
        var id_estrato = $scope.id_estrato;         


        midata.append('nombre_barrio',nombre_barrio);
        midata.append('comuna',  comuna);
        midata.append('codigo',  codigo);
        midata.append('id_estrato',id_estrato);
        $.ajax({
            url: base_api + '/postbarrio/create',
            type: 'POST',
            contentType: false,
            data: midata,  // mandamos el objeto formdata que se igualo a la variable data
            processData: false,
            cache: false,
            success: function (respuestaAjax) {
            swal("Almacenado!", "Registro Guardado.", "success");
            window.location="/admin/postbarrios#/admin/postbarrios";
         
            }
          });



           }


        };  
    });






