SeriesApp.controller('LocalizacionSedeBeneficiarioCtrl', function ($scope, $routeParams, $location, LocalizacionInstitucionService, $http, $timeout, base_api) {



$scope.title = "Beneficiarios";
$scope.series = [];


$scope.getData = function(){
  $http.get(base_api + "/admin/postlocalizacion_sede_beneficiarios/" + $routeParams.id)
    .success(function(response){
    $scope.list = response;
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

$scope.getData();




});



