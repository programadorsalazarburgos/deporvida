SeriesApp.controller('ReporteadorCrtl', function ($scope, $sce, $routeParams, $location, BeneficiarioService, $http, $timeout, base_api, $q) {

    $scope.title = "Reporteador - Administrador";
    $scope.jasper = {};
    $scope.jasperDelete = {};
    $scope.jasper.dataSource = jasperDataSource;
    $scope.jasper.jrxml = jasperTemplateDefault;
    $scope.uriJasperServer = jasperServer + '/j_spring_security_check?j_username=' + jasperUser + '&j_password=' + jasperPass + '&userLocale=es_ES';
    $scope.iframeJaseperServer = $sce.trustAsResourceUrl($scope.uriJasperServer);
    // {{$jasperServer}}/j_spring_security_check?j_username={{$jasperUser}}&j_password={{$jasperPass}}
    $scope.verFromNuevo = false;
    $scope.verFromEliminar = false;
    $scope.preloader = false;
    $scope.isRefreshing = false;

    $scope.verFormReporte = function () {
        $scope.verFromNuevo = true;
        $scope.verFromEliminar = false;
    }

    $scope.verFormDeleteReporte = function () {
        $scope.verFromNuevo = false;
        $scope.verFromEliminar = true;
    }

    $scope.crearReporte = function () {
        // console.log($scope.form);
        if ($scope.form.$valid) {

            $scope.verFromNuevo = false;
            $scope.preloader = true;
            $scope.isRefreshing = true;
            
            $http.post(base_api + "/admin/postnuevoreporte", $scope.jasper ).then(function(response) {
                // console.log(response);
                $scope.preloader = false;
                $scope.isRefreshing = false;
            });
        }
    }

    $scope.eliminarReporte = function () {
        if($scope.fromDelete.$valid) {
            $scope.verFromEliminar = false;
            $scope.preloader = true;
            $scope.isRefreshing = true;

            $http.post(base_api + "/admin/posteliminarreporte", $scope.jasperDelete). then(function(response) {
                console.log(response);
                $scope.preloader = false;
                $scope.isRefreshing = false;
            });
        }
    }



});
    
    
    