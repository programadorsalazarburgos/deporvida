'use strict';
// var SeriesApp = angular.module('SeriesApp',['ui.bootstrap', 'ngRoute', 'ngResource', 'ngCkeditor','truncate', 'ngMessages', 'selector', 'ui.select', 'timepickerPop', 'angularUtils.directives.dirPagination']).constant('API_URL');
var SeriesApp = angular.module('SeriesApp',['ui.bootstrap', 'ngRoute', 'ngResource', 'ngCkeditor','truncate', 'ngMessages', 'selector', 'ui.select', 'timepickerPop', 'angularUtils.directives.dirPagination']).constant('API_URL');

SeriesApp.constant("base_api", "/api/v0");

SeriesApp.directive("idatepicker", function () {
    return {
        restrict: "A",
        require: "ngModel",
        link: function (scope, elem, attrs, ngModelCtrl) {
        var updateModel = function (dateText) {
            scope.$apply(function () {
                ngModelCtrl.$setViewValue(dateText);
            });
        };
        var options = {
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true,
            onSelect: function (dateText) {
                updateModel(dateText);
            }
        };
        var idatepicker = elem.datepicker(options);
        // console.log("next",$(elem).next());
        $(elem).next().click(function(e) {
          idatepicker.datepicker( "show" );
        });
        }
    }
});

SeriesApp.directive("idatepickerRango", function () {
    return {
        restrict: "A",
        require: "ngModel",
        link: function (scope, elem, attrs, ngModelCtrl) {
            // console.log(attrs['rango']);
            var updateModel = function (dateText) {
                scope.$apply(function () {
                    ngModelCtrl.$setViewValue(dateText);
                });
            };
            var getDate = function (dateText) {
                let date;
                let dateFormat = "yy-mm-dd";
                try {
                    date = $.datepicker.parseDate( dateFormat, dateText );
                } catch( error ) {
                    date = null;
                }
                return date;
            }
            var options = {
                dateFormat: "yy-mm-dd",
                changeMonth: true,
                changeYear: true,
                defaultDate: "+1w",
                numberOfMonths: 3,
                onSelect: function (dateText, ui) {
                    updateModel(dateText);
                    $("[name=" + attrs['input2'] + "]").datepicker( "option", attrs['rango'], getDate( dateText ) );
                }
            };
            var idatepicker = elem.datepicker(options);

            $(elem).next().click(function(e) {
                idatepicker.datepicker( "show" );
            });
        }
    }
});


SeriesApp.directive('uiSlider', function ($filter) {
    'use strict';
    return {
        restrict: 'A',
        require: 'ngModel',            
        scope: {
            value: '=?',
            min: '=',
            max: '=',
            step: '=?',
            niveles: '=',
            ngModel: '='
        },
        link: function (scope, elem ) {

            var options = {
                range: 'min',
                value: (parseInt(scope.value)) ? parseInt(scope.value) : parseInt(scope.min),
                min: parseInt(scope.min),
                max: parseInt(scope.max),
                animate: "fast",
                slide: function (event, ui) {
                    scope.$apply(function () {
                        // console.log('Value sl: ', ui.value);
                        scope.ngModel = $filter('filter')(scope.niveles, {'numero': ui.value})[0];
                    });
                },
                create: function(event, ui) {
                    // console.log('ui.value: ', ui.value);
                    if (!scope.ngModel) {
                        scope.ngModel = $filter('filter')(scope.niveles, {'numero': parseInt(scope.min)})[0];
                    }
                }
            };
            
            elem.slider(options);
        }
    };
});


SeriesApp.config(['$routeProvider', function ($routeProvider) {
    $routeProvider.when("/admin/postevaluacionpsicosocial", {redirectTo:"/admin/postevaluacionpsicosocial"});

    //Evaluacion Psicosocial
    $routeProvider.when("/admin/postevaluacionpsicosocial", {
        controller: "EvaluacionesCrtl",
        templateUrl: "index-evpsicosocial"
    });

    //Evaluacion Tecnica
    $routeProvider.when("/admin/postevaluaciontecnica", {
        controller: "EvaluacionesCrtl",
        templateUrl: "index-evtecnica"
    });

    // Creacion y Edicion de Evaluaciones
    $routeProvider.when("/admin/postevaluacion/create-edit/:tipo/:id?", {
        controller: "CreateEditEvaluacionesCrtl",
        templateUrl: "create-edit-evaluacion"
    });




    //Ejes Tematicos
    $routeProvider.when("/admin/postejestematicos", {
        controller: "EjesTematicosCrtl",
        templateUrl: "index-ejestematicos"
    });
    $routeProvider.when("/admin/postejestematicos/create-edit/:id?", {
        controller: "CreateEditEjesTematicosCrtl",
        templateUrl: "create-edit-ejestematicos"
    });

    //Niveles
    $routeProvider.when("/admin/postniveles", {
        controller: "NivelesCrtl",
        templateUrl: "index-niveles"
    });
    $routeProvider.when("/admin/postniveles/create-edit/:id?", {
        controller: "CreateEditNivelesCrtl",
        templateUrl: "create-edit-niveles"
    });

    //Indicadores
    $routeProvider.when("/admin/postindicadores", {
        controller: "IndicadoresCrtl",
        templateUrl: "index-indicadores"
    });
    $routeProvider.when("/admin/postindicadores/create-edit/:tipo?/:id?", {
        controller: "CreateEditIndicadoresCrtl",
        templateUrl: "create-edit-indicadores"
    });
    
    //Calificciones
    $routeProvider.when("/admin/postcalificacionesescala", {
        controller: "CalificacionesEscalaCrtl",
        templateUrl: "index-calificacionesescala"
    });
    $routeProvider.when("/admin/postcalificacionesescala/create-edit/:tipo?/:id?", {
        controller: "CreateEditCalificacionesEscalaCrtl",
        templateUrl: "create-edit-calificacionesescala"
    });
    
    //Plazos y Periodos
    $routeProvider.when("/admin/postplazosyperiodosev", {
        controller: "PlazosyPeriodosEvCrtl",
        templateUrl: "index-plazosyperiodosev"
    });
    $routeProvider.when("/admin/postplazosyperiodosev/create-edit/:tipo?/:id?", {
        controller: "CreateEditPlazosyPeriodosEvCrtl",
        templateUrl: "create-edit-plazosyperiodosev"
    });

    // $routeProvider.otherwise("/admin/postevaluacionpsicosocial");
}]);
