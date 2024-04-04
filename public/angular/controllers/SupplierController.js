//creamos el modulo e inyectamos bootstrap ui
var app = angular.module('paginacion', ['ui.bootstrap']);

//creamos el controlador pasando $scope y $http, así los tendremos disponibles
app.controller('PaginacionController', function($scope,$http)
{
    $scope.results = [],//array para almacenar los resultados
    $scope.currentPage = 1,//página al cargar
    $scope.numPerPage = 2,//resultados por página
    $scope.showLinks = 7;//número de links que queremos mostrar
    $scope.createPagination = function()
    {
        //obtenemos los resultados del archivo data.php con http
        $http.get('http://localhost:8888/api/supplier').success(function (data)
        {
            console.log(data);
            //array que obtenemos de la bd
            $scope.results = data;
            //calculamos el numero de páginas para pasarlo a la vista
            //gracias a $scopo
            $scope.numPages = function ()
            {
              return Math.ceil($scope.results.length / $scope.numPerPage);
            };

            //observamos con watch para devolver los resultados segun la
            //posicion de la paginacion
            $scope.$watch('currentPage + numPerPage', function()
            {
                //desde el resultado que queremos mostrar
                var desde = (($scope.currentPage - 1) * $scope.numPerPage),
                //hasta el resultado que queremos mostrar
                hasta = desde + $scope.numPerPage;
                //devolvemos el numero de objetos que queremos mostrar
                //conforme nos movemos en la paginación, por ejemplo, en el
                //enlace dos devolvemos del 5 al 9 ambos inclusive
                $scope.total = $scope.results.slice(desde, hasta);
            });
        });
    };
    //hacemos que todo funcione :)
    $scope.createPagination();
});