SeriesApp.controller('ReporteParrillaCrtl', function ($scope, $routeParams, $location, BeneficiarioService, $http, $timeout, base_api) {

    $scope.title = "Cronograma de Actividades - Parrilla";
    $scope.series = [];

    $scope.pageSize = 15;

    $scope.getData = function() {
        // console.log($scope.filtros);
        $('#preloader').show();
        $('.reporte').hide();

        $http.post(base_api + "/admin/postreporteparrilla").then(function(response) {
            // console.log(response);
            $('#preloader').hide();
            $('.reporte').show();
            $scope.list = response.data;
            $scope.currentPage = 1; //current page
            $scope.entryLimit = 50; //max no of items to display in a page
            $scope.filteredItems = $scope.list.length; //Initially for no filter
            $scope.totalItems = $scope.list.length;
        });
    }

    $scope.sort_by = function(predicate) {
        $scope.predicate = predicate;
        $scope.reverse = !$scope.reverse;
    };


    
});
    
    
    