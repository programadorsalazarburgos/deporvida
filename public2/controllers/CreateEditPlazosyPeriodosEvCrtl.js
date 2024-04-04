SeriesApp.controller('CreateEditPlazosyPeriodosEvCrtl', function ($scope, $routeParams, $location, $http, $timeout, base_api, $q, $filter) {
    
    $scope.title = "Plazos y Periodos de Evaluación";
    $scope.subtitle = "Plazo y Periodo de Evaluación";
    $scope.pyp = {};
    $scope.pypxe = [];
    $scope.modoUpdate = false;

    if ($routeParams.id) {
        $scope.modoUpdate = true;
        
        $http.get(base_api + "/admin/postplazosyperiodosev/get/" + $routeParams.tipo + "/" + $routeParams.id).then(function(res) {
            $scope.pyp = res.data;
            // console.log("ind: ", $scope.pyp);

            $http.get(base_api + "/admin/postplazosyperiodosev/getselect/TblDvEjesTematicos").then(function(res) {
                $scope.ejes = res.data;

                $http.get(base_api + "/admin/postplazosyperiodosev/getselect/TblDvEvplazosyperiodosXEjes?id_evplazoyperiodo="+$routeParams.id).then(function(res) {
                    // $scope.ejes = res.data;

                    angular.forEach(res.data, function(pypXE) {
                        // let ejesSeleccionados = $filter('filter')($scope.ejes, {'id': res.data.id_eje});
                        let index = $scope.ejes.findIndex( eje => eje.id === pypXE.id_eje );
                        $scope.ejes[index].selected = true;
                    });
                    // console.log($scope.ejes);
                });
            });
        });

    }
    else {
        $http.get(base_api + "/admin/postplazosyperiodosev/getselect/TblDvEjesTematicos").then(function(res) {
            $scope.ejes = res.data;
        });
    }

    $scope.guardar = function(valid) {
        
        if (valid) {
            // console.log($scope.pyp);
            $scope.pypxe = [];

            if ($scope.pyp.tipo == 'PSICOSOCIAL') {
                let ejesSeleccionados = $filter('filter')($scope.ejes, {'selected': true});
    
                angular.forEach(ejesSeleccionados, function(eje) {
                    // this.push(key + ': ' + value);
                    this.push({
                        'id_eje': eje.id
                    });
                }, $scope.pypxe);
            }

            const plazosyPeriodosData = {'pyp': $scope.pyp, 'pypxe': $scope.pypxe};
            // console.log(plazosyPeriodosData);

            $http.post(base_api + "/admin/postplazosyperiodosev/create", plazosyPeriodosData).then(function(res) {
                // console.log(res);

                if (res.data) {
                    swal("Almacenado!", "Registro guardado.", "success");
                    $location.path('/admin/postplazosyperiodosev');
                }
                else{
                    swal("Error!", "Ocurrio un error al intentar guardar!, intente nuevamente...", "error");
                }
            });
    
        }

    }

    $scope.modificar = function(valid) {
        
        if (valid) {

            $scope.pypxe = [];

            if ($scope.pyp.tipo == 'PSICOSOCIAL') {
                let ejesSeleccionados = $filter('filter')($scope.ejes, {'selected': true});
    
                angular.forEach(ejesSeleccionados, function(eje) {
                    // this.push(key + ': ' + value);
                    this.push({
                        'id_eje': eje.id
                    });
                }, $scope.pypxe);
            }

            const plazosyPeriodosData = {'pyp': $scope.pyp, 'pypxe': $scope.pypxe};
            // console.log(plazosyPeriodosData);

            $http.put(base_api + "/admin/postplazosyperiodosev/edit/" + $routeParams.id, plazosyPeriodosData).then(function(res) {
                // console.log(res);

                if (res.data) {
                    swal("Almacenado!", "Registro Actualizado.", "success");
                    $location.path('/admin/postplazosyperiodosev');
                }
                else{
                    swal("Error!", "Ocurrio un error al intentar actualizar!, intente nuevamente...", "error");
                }
            })
        }
    }


});
    
    
    