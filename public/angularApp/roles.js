'use strict';
// Declare app level module which depends on views, and components
var SeriesApp = angular.module('SeriesApp', ['ui.bootstrap', 'ngRoute', 'ngResource', 'ngCkeditor','truncate']).constant('API_URL');



SeriesApp.directive('twinList', function() {
  return {
    restrict: 'E',
    scope: {
      data: '=listData',
      selected: '=selectedData',
      minSelections: '=minSelections',
      maxSelections: '=maxSelections'
    },
    link: function (scope, element) {
      //remove any selected elements from the list data
      scope.data = _.difference(scope.data, scope.selected);
      
      //sort both lists
      scope.data = _.sortBy(scope.data, function(num){ return num; });
      scope.selected = _.sortBy(scope.selected, function(num){ return num; });
      
    },
    templateUrl: function() {
      return 'twinList';
    },
    controller: function($scope) {
 
      function sort(data) {
        return _.sortBy(data, function(num){ return num; });
      }
      
      $scope.addSelected = function() {
        var selections = sort(_.union($scope.dataSet, $scope.selected));
        console.log(selections);
        var rol = $("#rolsider").val();
       
            $.ajax({
                    url: base + '/creacionpermisos/rol/' + rol,
                    type: 'POST',
                    dataType:'json',
                    data: JSON.stringify(selections),
                    contentType: 'application/json; charset=utf-8',
                    success: function (response) {
                       
                    },
                    error: function () {
                        alert("error");
                    }
                }); 
        
        if (angular.isNumber($scope.maxSelections) && selections.length > $scope.maxSelections) {
          return alert("You cannot make more than " + $scope.maxSelections + " selections.");
        }
        
        $scope.selected = selections;
        $scope.data = sort(_.difference($scope.data, $scope.dataSet));
      

      }
      
      $scope.removeSelected = function() {
        var selections = sort(_.union($scope.selectedSet, $scope.data));
        var difference = sort(_.difference($scope.selected, $scope.selectedSet));
        var rol = $("#rolsider").val();
        

          console.log(JSON.stringify(selections));
            $.ajax({
                    url: base + '/eliminarpermisos/rol/' + rol,
                    type: 'POST',
                    dataType:'json',
                    data: JSON.stringify(selections),
                    contentType: 'application/json; charset=utf-8',
                    success: function (response) {
                       
                    },
                    error: function () {
                        alert("error");
                    }
                }); 

        //console.log($scope.selected);
        /*if (angular.isNumber($scope.minSelections) && difference.length < $scope.minSelections) {
          return alert("You must have at least " + $scope.minSelections + " selections.");
        }
        */
        $scope.data = selections;
        $scope.selected = difference;
      }
      
      $scope.selectAll = function() {
        var selections = sort(_.union($scope.selected, $scope.data));
        if (angular.isNumber($scope.maxSelections) && selections.length > $scope.maxSelections) {
          return alert("You cannot make more than " + $scope.maxSelections + " selections.");
        }
        
        $scope.selected = selections;
        $scope.data = [];
      }
      
      $scope.deselectAll = function() {
        if (angular.isNumber($scope.minSelections) && $scope.minSelections) {
          return alert("You must have at least " + $scope.minSelections + " selections.");
        }
        
        $scope.data = sort(_.union($scope.selected, $scope.data));
        $scope.selected = [];
      }
    },
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
            window.location="/admin/postnoticias#/admin/postnoticias";

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
    $routeProvider.when("/admin/postroles", {redirectTo:"/admin/postroles"});

    $routeProvider.when("/admin/postroles", {
        controller: "RolesCrtl",
        templateUrl: "index-roles"
    });

    $routeProvider.when("/admin/postroles/create", {
        controller: "CreateItemsSolicitudCtrl",
        templateUrl: "create-itemssolicitud"
    });


$routeProvider.when("/admin/postroles/permisos/:id", {
        controller: "PermisosRolesCtrl",
        templateUrl: "permisos-roles"
    });

    $routeProvider.otherwise("/admin/postroles");
}]);





