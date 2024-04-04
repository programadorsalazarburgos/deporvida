SeriesApp.controller('ReporteadorVisorCrtl', function ($scope, $sce, $routeParams, $location, BeneficiarioService, $http, $timeout, base_api, $q) {

    $scope.title = "Reporteador - Visor";
    $scope.alertDashboard = false;

    $scope.reporte_uri = atob($routeParams.reporte);
    // console.log($scope.reporte_uri);

    $scope.alertDashboard = ($scope.reporte_uri == '/Deporvida/Reportes/Dashboard_Deporvida') ? true : false;

    $scope.getIframeSrc = function () {
        // {{$jasperServer}}/flow.html?_flowId=viewReportFlow&reportUnit=@{{reporte_uri}}&decorate=no&j_username={{$jasperUser}}&j_password={{$jasperPass}}&viewAsDashboardFrame=false
        let iframeSrc = jasperServer + '/flow.html?_flowId=viewReportFlow&reportUnit=' + $scope.reporte_uri + '&decorate=no&j_username=' + jasperUser + '&j_password=' + jasperPass + '&viewAsDashboardFrame=false&userLocale=es_ES';
        // console.log(iframeSrc);
        return $sce.trustAsResourceUrl(iframeSrc);
    };



});
    