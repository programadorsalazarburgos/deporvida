var id = 0;
$(window).load(function () 
{
    Barrios();
    $('#barrio').select2();
    Corregimientos();
});
function Corregimientos()
{
    $('#id_corregimiento').change(function ()
    {
        if ($(this).val() == '')
        {
            $('#hide_divs').show();
            $('#id_vereda').html('');
        } else
        {
            $('#hide_divs').hide();
            veredas();
        }
    });
}
function veredas()
{
    $.ajax({
        url: base + '/veredas/corregimiento/' + $('#id_corregimiento').val(),
        dataType: 'json',
        success: function (data)
        {
            var html = '';
            $.each(data, function (index, value)
            {
                html += '<option value="' + value.id + '">' + value.nombre + '</option>';
            });
            $('#id_vereda').html(html);
        }
    });
}
function div(data)
{

    id = id + 1;
    var html = '';
    // html+='<table class="table">';
    html += '<tr id="remove_' + id + '" class="data_equipamiento">';
    html += '<td><select class="form form-control" name="escenario[tipo][]">';
    $.each(data, function (index, value)
    {
        html = html + '<option value="' + value.id + '">' + value.descripcion + '</option>';
    })
    html += '</select></td>';
    html += '<td><input class="form form-control" name="escenario[cantidad][]"/></td>';
    html += '<td><button class="btn btn-danger" onclick="remove_table(' + id + ')"><i class="fa fa-times" aria-hidden="true"></i> Eliminar</button></td>';
    html += '</tr>';
    return html;
}
function remove_table(removeid)
{
    $('#remove_' + removeid).html('')
}
function tipoesequipamientos()
{
    $.ajax({
        url: 'tipoesequipamientos',
        async: false,
        dataType: 'json',
        success: function (data)
        {
            $('#new_equipamento').after(div(data));
        }
    })
}
function Barrios()
{
    $.ajax({
        url: '/barrios/listado',
        dataType: 'json',
        success: function (data)
        {
            var html = '';
            $.each(data, function (index, value)
            {
                html += '<option value="' + value.id_barrio + '">' + value.nombre_barrio + '</option>';
            });
            $('#barrio').html(html);
        }
    });
}
'use strict';
// Declare app level module which depends on views, and components
var SeriesApp = angular.module('SeriesApp', ['ui.bootstrap', 'ngRoute', 'ngResource', 'ngCkeditor', 'truncate', 'ngMessages', 'selector', 'ui.select']).constant('API_URL');
tipoesequipamientos();
SeriesApp.filter('propsFilter', function () {




    return function (items, props) {
        var out = [];

        if (angular.isArray(items)) {
            items.forEach(function (item) {
                var itemMatches = false;

                var keys = Object.keys(props);
                for (var i = 0; i < keys.length; i++) {
                    var prop = keys[i];
                    var text = props[prop].toLowerCase();
                    if (item[prop].toString().toLowerCase().indexOf(text) !== -1) {
                        itemMatches = true;
                        break;
                    }
                }

                if (itemMatches) {
                    out.push(item);
                }
            });
        } else {
            // Let the output be the input untouched
            out = items;
        }

        return out;
    }
});
SeriesApp.directive('confirmPwd', function ($interpolate, $parse) {
    return {
        require: 'ngModel',
        link: function (scope, elem, attr, ngModelCtrl) {

            var pwdToMatch = $parse(attr.confirmPwd);
            var pwdFn = $interpolate(attr.confirmPwd)(scope);

            scope.$watch(pwdFn, function (newVal) {
                ngModelCtrl.$setValidity('password', ngModelCtrl.$viewValue == newVal);
            })

            ngModelCtrl.$validators.password = function (modelValue, viewValue) {
                var value = modelValue || viewValue;
                return value == pwdToMatch(scope);
            };

        }
    }
});
SeriesApp.directive('attachmentFile', function ($parse) {

    return {
        restrict: 'A',
        link: function (scope, element, attributes) {
            var model = $parse(attributes.attachmentFile);
            var assign = model.assign;
            element.bind('change', function () {
                var files = [];
                angular.forEach(element[0].files, function (file) {
                    files.push(file);
                });
                scope.$apply(function () {
                    assign(scope, files);
                });
            });

        }
    }

})
SeriesApp.directive('validFile', function () {
    return {
        require: 'ngModel',
        link: function (scope, el, attrs, ctrl) {
            ctrl.$setValidity('validFile', el.val() != '');
            //change event is fired when file is selected
            el.bind('change', function () {
                ctrl.$setValidity('validFile', el.val() != '');
                scope.$apply(function () {
                    ctrl.$setViewValue(el.val());
                    ctrl.$render();
                });
            });
        }
    }
})
SeriesApp.directive('ckEditor', function () {
    return {
        require: '?ngModel',
        link: function (scope, elm, attr, ngModel) {
            var ck = CKEDITOR.replace(elm[0]);
            if (!ngModel)
                return;
            ck.on('instanceReady', function () {
                ck.setData(ngModel.$viewValue);
            });
            function updateModel() {
                scope.$apply(function () {
                    ngModel.$setViewValue(ck.getData());
                });
            }
            ck.on('change', updateModel);
            ck.on('key', updateModel);
            ck.on('dataReady', updateModel);

            ngModel.$render = function (value) {
                ck.setData(ngModel.$viewValue);
            };
        }
    };
});
SeriesApp.directive('fileModel', ['$parse', function ($parse) {
        return {
            restrict: 'A',
            link: function (scope, element, attrs) {
                var model = $parse(attrs.fileModel);
                var modelSetter = model.assign;

                element.bind('change', function () {
                    scope.$apply(function () {
                        modelSetter(scope, element[0].files[0]);
                    });
                });
            }
        };
    }]);
// We can write our own fileUpload service to reuse it in the controller
SeriesApp.service('fileUpload', ['$http', function ($http) {
        this.uploadFileToUrl = function (file, uploadUrl, nombre_programa, descripcion_programa) {
            var fd = new FormData();
            fd.append('file', file);
            fd.append('nombre_programa', nombre_programa);
            fd.append('descripcion_programa', descripcion_programa);

            $http.post(uploadUrl, fd, {
                transformRequest: angular.identity,
                headers: {'Content-Type': undefined, 'Process-Data': false}
            })
                    .success(function () {
                        document.getElementById("cargando").style.display = "none";
                        toastr.success("Su registro ha sido exitoso", "Registro Almacenado");
                        window.location = "/admin/postprogramas#/admin/postprogramas";

                    })
                    .error(function () {
                    });
        }
    }]);
SeriesApp.filter('startFrom', function () {
    return function (input, start) {
        if (input) {
            start = +start; //parse to int
            return input.slice(start);
        }
        return [];
    }
});
SeriesApp.constant("base_api", "/api/v0");
SeriesApp.config(['$routeProvider', function ($routeProvider) 
{
        $routeProvider.when("/admin/postescenarios", {redirectTo: "/admin/postescenarios"});

        $routeProvider.when("/admin/postescenarios", {
            controller: "EscenariosCrtl",
            templateUrl: "index-escenarios"
        });

        $routeProvider.when("/admin/postescenarios/create", {
            controller: "CreateEscenarioCtrl",
            templateUrl: "create-escenarios"
        });


        $routeProvider.when("/admin/postescenarios/editando/:id",
                {
                    controller: "EditarEscenarioCtrl",
                    templateUrl: "editar-escenarios"
                });



        $routeProvider.otherwise("/admin/postescenarios");
    }]);