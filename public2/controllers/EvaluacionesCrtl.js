SeriesApp.controller('EvaluacionesCrtl', function ($scope, $routeParams, $location, $http, $timeout, base_api, $q) {

    $scope.title = "Evaluacines Realizadas";
    $scope.series = [];
    $scope.pageSize = 50;
    $scope.tipo = tipo;
    $scope.activo = true;

    console.log('TIPO: ', $scope.tipo);

    /* $http.get(base_api + "/admin/postevaluaciones/" + $scope.tipo).then(function(res) {
        console.log(res);
    }); */

    $scope.getData = function(){
        $http.get(base_api + "/admin/postevaluaciones/get/" + $scope.tipo).then(function(res) {
            // console.log(res);
            if (Object.keys(res.data).length) {
                $scope.activo = true;
                $scope.evPyp = res.data;
                $scope.list = res.data.fk_tbl_dv_evaluaciones;
                $scope.currentPage = 1; //current page
                $scope.entryLimit = 50; //max no of items to display in a page
                $scope.filteredItems = $scope.list.length; //Initially for no filter
                $scope.totalItems = $scope.list.length;
            }
            else {
                $scope.activo = false;
            }
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

                $http.delete(base_api + '/admin/postevaluacionpsicosocial/delete/' + id).then(function(res) {
                    console.log(res);
                    swal("Eliminado!", "Registro Eliminado.", "success");
                    $scope.getData();
                })

            } else {
                swal("Cancelado", "No elimino su registro :)", "error");
            }
        });
    }

});
