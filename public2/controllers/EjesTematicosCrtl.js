SeriesApp.controller('EjesTematicosCrtl', function ($scope, $routeParams, $location, $http, $timeout, base_api, $q) {
    
    $scope.title = "Evaluación Psicosocial";
    $scope.series = [];
    $scope.pageSize = 50;
  
    $scope.getData = function(){
        $http.get(base_api + "/admin/postejestematicos").then(function(res) {
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

                $http.delete(base_api + '/admin/postejestematicos/delete/' + id).then(function(res) {
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
    
    
    