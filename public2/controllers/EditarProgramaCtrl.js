SeriesApp.controller("EditarProgramaCtrl", function($scope, ProgramaService, $routeParams, fileUpload, $http, $location, $timeout, base_api){
    $scope.title = "Editar Programa";
    $scope.series = [];
    $scope.getData = function(){
    $scope.serie = ProgramaService.get({id:$routeParams.id});

    

};

$scope.getData();

 $scope.formsubmit = function(id){
 $scope.loading = true;
        var file = $scope.myFile;
        var nombre_programa = $scope.serie.nombre_programa;
        var descripcion_programa = $scope.serie.descripcion_programa;
        var uploadUrl = base_api + "/postprogramas/editarPrograma/"+ id;
        fileUpload.uploadFileToUrl(file, uploadUrl, nombre_programa, descripcion_programa);
   };



});
