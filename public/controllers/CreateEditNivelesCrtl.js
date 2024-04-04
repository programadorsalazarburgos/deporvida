SeriesApp.controller('CreateEditNivelesCrtl', function ($scope, $routeParams, $location, $http, $timeout, base_api, $q) {
    
    $scope.title = "Niveles Técnicos";
    $scope.subtitle = "Nivele Técnico";
    $scope.eje = {};
    $scope.modoUpdate = false;

    if ($routeParams.id) {
        $scope.modoUpdate = true;

        $http.get(base_api + "/admin/postniveles/" + $routeParams.id).then(function(res) {
            $scope.eje = res.data;
            console.log("eje: ", $scope.eje);
        });
    }

    $scope.guardar = function(valid) {

        if (valid) {
            // console.log($scope.eje);

            $http.post(base_api + "/admin/postniveles/create", $scope.eje).then(function(res) {
                console.log(res);

                if (res.data) {
                    swal("Almacenado!", "Registro guardado.", "success");
                    $location.path('/admin/postniveles');
                }
                else{
                    swal("Error!", "Ocurrio un error al intentar guardar!, intente nuevamente...", "error");
                }
            });
    
        }

    }

    $scope.modificar = function(valid) {
        
        if (valid) {

            $http.put(base_api + "/admin/postniveles/edit/" + $routeParams.id, $scope.eje).then(function(res) {
                // console.log(res);

                if (res.data) {
                    swal("Almacenado!", "Registro Actualizado.", "success");
                    $location.path('/admin/postniveles');
                }
                else{
                    swal("Error!", "Ocurrio un error al intentar actualizar!, intente nuevamente...", "error");
                }
            })
        }
    }


});
    
    
    