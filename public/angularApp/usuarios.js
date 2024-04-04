'use strict';
// Declare app level module which depends on views, and components
var SeriesApp = angular.module('SeriesApp', ['ui.bootstrap', 'ngRoute', 'ngResource', 'ngCkeditor','truncate', 'ngMessages', 'ngPatternRestrict']).constant('API_URL');


 $.datepicker.regional['es'] = {
 closeText: 'Cerrar',
 prevText: '< Ant',
 nextText: 'Sig >',
 currentText: 'Hoy',
 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
 weekHeader: 'Sm',
 dateFormat: 'dd/mm/yy',
 firstDay: 1,
 isRTL: false,
 showMonthAfterYear: false,
 yearSuffix: ''
 };




 SeriesApp.constant('requestField', function(){
 
  });

SeriesApp.run(function($rootScope) {
  $rootScope.typeOf = function(value) {
    return typeof value;
  };
})

SeriesApp.directive('stringToNumber', function() {
  return {
    require: 'ngModel',
    link: function(scope, element, attrs, ngModel) {
      ngModel.$parsers.push(function(value) {
        return '' + value;
      });
      ngModel.$formatters.push(function(value) {
        return parseFloat(value);
      });
    }
  };
});


SeriesApp.directive('confirmPwd', function($interpolate, $parse) {
  return {
    require: 'ngModel',
    link: function(scope, elem, attr, ngModelCtrl) {

      var pwdToMatch = $parse(attr.confirmPwd);
      var pwdFn = $interpolate(attr.confirmPwd)(scope);

      scope.$watch(pwdFn, function(newVal) {
          ngModelCtrl.$setValidity('password', ngModelCtrl.$viewValue == newVal);
      })

      ngModelCtrl.$validators.password = function(modelValue, viewValue) {
        var value = modelValue || viewValue;
        return value == pwdToMatch(scope);
      };

    }
  }
});

SeriesApp.directive('attachmentFile', function($parse){

  return {
    restrict: 'A',
    link: function(scope, element, attributes){
      var model = $parse(attributes.attachmentFile);
      var assign = model.assign;
      element.bind('change', function(){
        var files = [];
        angular.forEach(element[0].files, function(file){
            files.push(file);
        });
        scope.$apply(function(){
          assign(scope, files);
        });
      });

    }
  }

})


SeriesApp.directive('validFile',function(){
    return {
        require:'ngModel',
        link:function(scope,el,attrs,ctrl){
            ctrl.$setValidity('validFile', el.val() != '');
            //change event is fired when file is selected
            el.bind('change',function(){
                ctrl.$setValidity('validFile', el.val() != '');
                scope.$apply(function(){
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
      if (!ngModel) return;
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
    link: function(scope, element, attrs) {
        var model = $parse(attrs.fileModel);
        var modelSetter = model.assign;

        element.bind('change', function(){
            scope.$apply(function(){
                modelSetter(scope, element[0].files[0]);
            });
        });
    }
   };
}]);

// We can write our own fileUpload service to reuse it in the controller
SeriesApp.service('fileUpload', ['$http', function ($http) {
    this.uploadFileToUrl = function(file, uploadUrl, name, content, sumario){
         var fd = new FormData();
         fd.append('file', file);
         fd.append('name', name);
         fd.append('content', content);
         fd.append('sumario', sumario);

         $http.post(uploadUrl, fd, {
             transformRequest: angular.identity,
             headers: {'Content-Type': undefined,'Process-Data': false}
         })
         .success(function(){
            document.getElementById("cargando").style.display="none";
            toastr.success("Su registro ha sido exitoso", "Registro Noticia");
          
         })
         .error(function(){
            console.log("Success");
         });
     }
 }]);






SeriesApp.filter('startFrom', function() {
    return function(input, start) {
        if(input) {
            start = +start; //parse to int
            return input.slice(start);
        }
        return [];
    }
});


SeriesApp.constant("base_api", "/api/v0");
SeriesApp.config(['$routeProvider', function ($routeProvider) {
    $routeProvider.when("/admin/postusuarios", {redirectTo:"/admin/postusuarios"});

    $routeProvider.when("/admin/postusuarios", {
        controller: "UsuariosCrtl",
        templateUrl: "index-usuarios"
    });

    $routeProvider.when("/admin/postusuarios/create", {
        controller: "CreateUsuarioCtrl",
        templateUrl: "create-usuarios"
    });


$routeProvider.when("/admin/postusuarios/editando/:id", {
        controller: "EditarUsuarioCtrl",
        templateUrl: "editar-usuarios"
    });

$routeProvider.when("/admin/postusuarios/mostrar/:id", {
        controller: "EditarUsuarioCtrl",
        templateUrl: "mostrar-usuarios"
    });

$routeProvider.when("/admin/postusuarios/clave/:id", {
        controller: "EditarUsuarioCtrl",
        templateUrl: "cambiar-clave"
    });


    $routeProvider.otherwise("/admin/postusuarios");
}]);





