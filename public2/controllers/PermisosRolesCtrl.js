SeriesApp.controller("PermisosRolesCtrl", function($scope, RoleService, $routeParams, fileUpload, $http, $location, $timeout, base_api){
    $scope.title = "Visualizar  cuentas";
     $scope.form_title = "User Detail";
    $scope.series = [];
    $scope.getData = function(){
    $scope.serie = RoleService.get({id:$routeParams.id});
 
};



$scope.role = $routeParams.id;
  

$http.get(base_api + "/admin/postroles/" + $scope.role)
  .success(function(response){

    $scope.rol = response;
   

  });



$http.get(base_api + "/ObtenerPermisos/Rol/")
  .success(function(response){
          $scope.myData = [];
          
          $scope.mySelectedData = [];
          var permisos = response;
          

$http.get(base_api + "/ObtenerPermisos/Rol/" + $routeParams.id)
  .success(function(response){



var permisosID = response;



for (var i = 0; i < permisos.length; i++) {

        var uno = [permisos[i].id];
        var dos = [permisos[i].name];
        var alphaNumeric1 = uno.concat(dos);
        

        $scope.myData.push(alphaNumeric1);

 for(var e = 0; e < permisosID.length; e++ ){
   

    var tres = [permisosID[e].id];
    var cuatro = [permisosID[e].name];
    var alphaNumeric2 =tres.concat(cuatro);

    if (alphaNumeric1[0] == alphaNumeric2[0]) {
        $scope.mySelectedData.push(alphaNumeric2);

        var prueba2 = $scope.myData.splice(_.indexOf($scope.myData, _.findWhere($scope.myData, [1, $scope.mySelectedData])), 1);
    }


  }
}

  });
  });






});
