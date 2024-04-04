SeriesApp.controller("CreateProgramaCtrl", function($scope, ProgramaService, fileUpload, $http, $location, base_api){
    $scope.title = "Agregar Programa";
    $scope.disable_submit = false;

    $scope.serie = {};



$scope.formsubmit = function(isValid) {     
    
    if (isValid) {



		$scope.loading = true;
        var file = $scope.myFile;
        var uploadUrl = base_api + "/postprograma/create";
        var nombre_programa = $scope.nombre_programa;
        var descripcion_programa = $scope.descripcion_programa;
        fileUpload.uploadFileToUrl(file, uploadUrl, nombre_programa, descripcion_programa);






           }
        };	
	});






