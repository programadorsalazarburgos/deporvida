'use strict';
var SeriesApp = angular.module('SeriesApp',['ngRoute', 'ngResource']).constant('API_URL');

SeriesApp.constant("base_api", "/api/v0");

SeriesApp.config(['$routeProvider', function ($routeProvider) {
    $routeProvider.when("/admin/postreporteador", {redirectTo:"/admin/postreporteador"});

    $routeProvider.when("/admin/postreporteador", {
        controller: "ReporteadorCrtl",
        templateUrl: "index-reporteador"
    });

    $routeProvider.when("/admin/postreporteadorvisor", {redirectTo:"/admin/postreporteadorvisor"});
    
    $routeProvider.when("/admin/postreporteadorvisor/:reporte", {
        controller: "ReporteadorVisorCrtl",
        templateUrl: "visor-reporteador"
    });

    $routeProvider.otherwise("/admin/postreporteador");
}]);
