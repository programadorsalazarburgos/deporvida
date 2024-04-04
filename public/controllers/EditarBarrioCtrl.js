SeriesApp.controller("EditarBarrioCtrl", function($scope, BarrioService, $routeParams, fileUpload, $http, $location, $timeout, base_api)
{
    $scope.title = "Editar Barrio";
    $scope.series = [];
    $scope.getData = function()
    {
      $scope.serie = BarrioService.get({id:$routeParams.id});
    };
    $http.get(base_api + "/obtenerselect/comuna/" + $routeParams.id).success(function(response)
    {
         $scope.data = 
         {
            'id': 1,
            'unit': response.id,
         }
        $('#id_estrato').val(response.id_estrato);
        $scope.codigo=response.codigo;
    });
    $http.get(base_api + "/obtenerselect/comunas").success(function(response)
    {
      $scope.comunas = response;
    });
    $scope.getData();
    $scope.formsubmit = function(id,isValid)
    {
      if (isValid) 
      {
        var midata = new FormData();
        var nombre_barrio = $scope.serie.nombre_barrio;
		    var codigo = $scope.codigo;
        var obtener_comuna = $("#comuna").val();
        var id_estrato = $("#id_estrato").val();    
        var comuna = obtener_comuna.replace('number:', '');    
        var url=base_api + '/postbarrios/editarBarrio/'+ id;
        midata.append('nombre_barrio',nombre_barrio);
        midata.append('comuna',comuna);
        midata.append('codigo',codigo);
        midata.append('id_estrato',id_estrato);
        $.ajax(
        {
              url: url,
              type: 'POST',
              contentType: false,
              data: midata,  // mandamos el objeto formdata que se igualo a la variable data
              processData: false,
              cache: false,
              success: function (respuestaAjax) 
              {
                  swal("Almacenado!", "Registro Actualizado.", "success");
                  window.location="/admin/postbarrios";
              }
        });
      }
    };
});
