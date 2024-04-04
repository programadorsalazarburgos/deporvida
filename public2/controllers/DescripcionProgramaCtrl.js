SeriesApp.controller("DescripcionProgramaCtrl", function($scope, SiderService, $routeParams, fileUpload, $http, $location, $timeout, base_api){
    $scope.title = "Descripcion Programa";
    $scope.series = [];
    $scope.getData = function(){
    $scope.serie = SiderService.get({id:$routeParams.id});

    console.log($scope.serie);

};

$scope.serie = {};
$scope.getData();


});
