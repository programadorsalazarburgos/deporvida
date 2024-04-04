SeriesApp.controller('CreateEditIndicadoresCrtl', function ($scope, $routeParams, $location, $http, $timeout, base_api, $q) {
    
    $scope.title = "Indicadores";
    $scope.subtitle = "Indicador";
    $scope.ind = {};
    $scope.modoUpdate = false;

    if ($routeParams.id) {
        $scope.modoUpdate = true;
        
        $http.get(base_api + "/admin/postindicadores/get/" + $routeParams.tipo + "/" + $routeParams.id).then(function(res) {
            $scope.ind = res.data;
            // console.log("ind: ", $scope.ind);

            $http.get(base_api + "/admin/postindicadores/getselect/TblDvEjesTematicos").then(function(res) {
                $scope.ejes = res.data;
            });
    
            $http.get(base_api + "/admin/postindicadores/getselect/TblDvNiveles").then(function(res) {
                $scope.niveles = res.data;
            });
            $http.get(base_api + "/admin/postindicadores/getselect/TblDvDisciplinas").then(function(res) {
                $scope.disciplinas = res.data;
            });
        });

    }
    else {
        $http.get(base_api + "/admin/postindicadores/getselect/TblDvEjesTematicos").then(function(res) {
            $scope.ejes = res.data;
        });

        $http.get(base_api + "/admin/postindicadores/getselect/TblDvNiveles").then(function(res) {
            $scope.niveles = res.data;
        });
        $http.get(base_api + "/admin/postindicadores/getselect/TblDvDisciplinas").then(function(res) {
            $scope.disciplinas = res.data;
        });
    }

    $scope.guardar = function(valid) {

        if (valid) {
            // console.log($scope.ind);

            $http.post(base_api + "/admin/postindicadores/create", $scope.ind).then(function(res) {
                // console.log(res);

                if (res.data) {
                    swal("Almacenado!", "Registro guardado.", "success");
                    $location.path('/admin/postindicadores');
                }
                else{
                    swal("Error!", "Ocurrio un error al intentar guardar!, intente nuevamente...", "error");
                }
            });
    
        }

    }

    $scope.modificar = function(valid) {
        
        if (valid) {

            $http.put(base_api + "/admin/postindicadores/edit/" + $routeParams.id, $scope.ind).then(function(res) {
                // console.log(res);

                if (res.data) {
                    swal("Almacenado!", "Registro Actualizado.", "success");
                    $location.path('/admin/postindicadores');
                }
                else{
                    swal("Error!", "Ocurrio un error al intentar actualizar!, intente nuevamente...", "error");
                }
            })
        }
    }

    $scope.$watch('ind.tipo', function (newValue, oldValue) {
        if($scope.ind.tipo == 'TECNICO') {
            $scope.ind.id_eje = null;
        }
        else {
            $scope.ind.id_nivel = null;
            $scope.ind.id_disciplina = null;
        }
        // console.log($scope.ind);
    });


});
    
    
    