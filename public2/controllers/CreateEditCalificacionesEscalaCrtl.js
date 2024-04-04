SeriesApp.controller('CreateEditCalificacionesEscalaCrtl', function ($scope, $routeParams, $location, $http, $timeout, base_api, $q) {
    
    $scope.title = "Escala de Calificaciones";
    $scope.subtitle = "Escala Calificación";
    $scope.cal = {};
    $scope.modoUpdate = false;

    if ($routeParams.id) {
        $scope.modoUpdate = true;

        $http.get(base_api + "/admin/postcalificacionesescala/get/" + $routeParams.tipo + "/" + $routeParams.id).then(function(res) {
            $scope.cal = res.data;
            // console.log("niv: ", $scope.cal);
        });
    }

    $scope.guardar = function(valid) {

        if (valid) {
            // console.log($scope.cal);

            $http.post(base_api + "/admin/postcalificacionesescala/create", $scope.cal).then(function(res) {
                // console.log(res);

                if (res.data) {
                    swal("Almacenado!", "Evaluación Psicosocial guardada.", "success");
                    $location.path('/admin/postcalificacionesescala');
                }
                else{
                    swal("Error!", "Ocurrio un error al intentar guardar!, intente nuevamente...", "error");
                }
            });
    
        }

    }

    $scope.modificar = function(valid) {
        
        if (valid) {

            $http.put(base_api + "/admin/postcalificacionesescala/edit/" + $routeParams.id, $scope.cal).then(function(res) {
                // console.log(res);

                if (res.data) {
                    swal("Almacenado!", "Registro Actualizado.", "success");
                    $location.path('/admin/postcalificacionesescala');
                }
                else{
                    swal("Error!", "Ocurrio un error al intentar actualizar!, intente nuevamente...", "error");
                }
            })
        }
    }


});
    
    
    