SeriesApp.controller('ReporteFichaCrtl', function ($scope, $routeParams, $location, BeneficiarioService, $http, $timeout, base_api, $q) {

    $scope.title = "Ficha caracterización";
    $scope.series = [];

    $scope.pageSize = 10;

    $scope.filtros = {};
    $scope.filtros.fecha_inicial = '';
    $scope.filtros.fecha_final = '';

    $scope.filtros.disciplina = null;
    $scope.disciplinas = [];
    $scope.filtros.comuna_impacto = null;
    $scope.comuna_impacto = [];
    $scope.filtros.monitor = null;
    $scope.monitores = [];
    $scope.filtros.sexo = null;

    $scope.formValido = true;

    $('#preloader').hide();

    $scope.getData = function() {
        // console.log($scope.filtros);
        $scope.validar();

        if($scope.formValido) {
            $('#preloader').show();
            $('.reporte').hide();
    
            $http.post(base_api + "/admin/postreporteficha", $scope.filtros ).then(function(response) {
                // console.log(response);
                $('#preloader').hide();
                $('.reporte').show();
                $scope.list = response.data;
                $scope.currentPage = 1; //current page
                $scope.entryLimit = 50; //max no of items to display in a page
                $scope.filteredItems = $scope.list.length; //Initially for no filter
                $scope.totalItems = $scope.list.length;
            });
        }

    }

    $scope.sort_by = function(predicate) {
        $scope.predicate = predicate;
        $scope.reverse = !$scope.reverse;
    };

    $scope.validar = function() {
        if ($scope.filtros.fecha_inicial != '' && $scope.filtros.fecha_final != '') {
            $scope.formValido = true;
        }
        else {
            $scope.formValido = false;
        }
        // console.log($scope.formValido);
    }

    $http.get(base_api + "/admin/postreporteficha/getselect/TblDvDisciplinas").then(function(res) {
        // console.log(res);
        $scope.disciplinas = res.data;
    });
    
    $http.get(base_api + "/admin/postreporteficha/getselect/Comuna").then(function(res) {
        // console.log(res);
        $scope.comuna_impacto = res.data;
    });

    $http.get(base_api + "/admin/postreporteficha/getselect/ViewDvMonitores?_ORDERBY=per_mon_nombre_primero").then(function(res) {
        // console.log(res);
        $scope.monitores = res.data;
    });

});
    
    
    