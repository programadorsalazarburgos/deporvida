SeriesApp.controller('CalificacionesEscalaCrtl', function ($scope, $routeParams, $location, $http, $timeout, base_api, $q) {
    
    $scope.title = "Escala de Calificaciones";
    $scope.subtitle = "Escala de Calificacion";
    $scope.series = [];
    $scope.pageSize = 50;
    $scope.tec = {};
    $scope.psi = {};
    $scope.tipo = 'TECNICO';
  
    $scope.getData = function(tipo){
        $http.get(base_api + "/admin/postcalificacionesescala/get/"+tipo).then(function(res) {
            $scope.list = res.data;
            $scope.currentPage = 1; //current page
            $scope.entryLimit = 50; //max no of items to display in a page
            $scope.filteredItems = $scope.list.length; //Initially for no filter
            $scope.totalItems = $scope.list.length;
        });
    };
    
    $scope.setPage = function(pageNo) {
        $scope.currentPage = pageNo;
    };

    $scope.filter = function() {
        $timeout(function() {
            $scope.filteredItems = $scope.filtered.length;
        }, 10);
    };

    $scope.sort_by = function(predicate) {
        $scope.predicate = predicate;
        $scope.reverse = !$scope.reverse;
    };

    $scope.eliminar = function(id) {
        swal({
            title: "Estas seguro?",
            text: "No podrá recuperar este registro!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Si, Eliminalo!",
            cancelButtonText: "No, lo Elimines!",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function (isConfirm) {
            if (isConfirm) {

                $http.delete(base_api + '/admin/postcalificacionesescala/delete/' + id).then(function(res) {
                    console.log(res);
                    swal("Eliminado!", "Registro Eliminado.", "success");
                    $scope.getData($scope.tipo);
                })

            } else {
                swal("Cancelado", "No elimino su registro :)", "error");
            }
        });
    }

    $scope.selectTipo = function(tipo) {
        $scope.tipo = tipo;
        if (tipo == 'TECNICO') {
            $scope.tec.class = 'btn-success';
            $scope.tec.icono = 'fa-dot-circle-o';
            $scope.psi.class = 'btn-default';
            $scope.psi.icono = 'fa-circle-o';
        }
        else {
            $scope.tec.class = 'btn-default';
            $scope.tec.icono = 'fa-circle-o';
            $scope.psi.class = 'btn-success';
            $scope.psi.icono = 'fa-dot-circle-o';
        }
        $scope.getData($scope.tipo);
    }

    $scope.selectTipo($scope.tipo);

});
    
    
    