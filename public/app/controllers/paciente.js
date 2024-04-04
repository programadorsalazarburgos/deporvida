 //Listar
app.controller('pacientesController', function($scope, $http, API_URL) {
  //retrieve employees listing from API
    $http.get(API_URL + "pacientesRuta")
        .success(function(response) {
/*            console.log(response);*/
            $scope.pacientes = response;
        });

//Guardar Pacientes

    $scope.save = function(modalstate, id) {
        var url = API_URL + "pacientesRuta";
        //append employee id to the URL if the form is in edit mode
        $http({
            method: 'POST',
            url: url,
            data: $.param($scope.paciente),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(response) {
            console.log($.param($scope.paciente));
            /*console.log(response);*/

            location.reload();
        }).error(function(response) {
/*            console.log(response);*/
            alert('Ocurrio un error verificar');
        });
    }
});