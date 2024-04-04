app.controller('profesoresController', function($scope, multipartForm, filterFilter, $http, $parse, API_URL) {

    $http.get(API_URL + "profesores")
        .success(function(response) {
            $scope.profesores = response;
            console.log(response);

    })
});

