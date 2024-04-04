
app.controller('employeesController', function ($scope, multipartForm, filterFilter, $http, $parse, API_URL) {

    $http.get(API_URL + "employees444")
            .success(function (response) {

                $scope.items = response;
                $scope.search = '';
                $scope.resetFilters = function () {
                    // needs to be a function or it won't trigger a $watch
                    $scope.search = '';
                };

                // pagination controls
                $scope.currentPage = 1;
                $scope.totalItems = $scope.items.length;
                $scope.entryLimit = 8; // items per page
                $scope.noOfPages = Math.ceil($scope.totalItems / $scope.entryLimit);

                // $watch search to update pagination
                $scope.$watch('search', function (newVal, oldVal) {
                    $scope.filtered = filterFilter($scope.items, newVal);
                    $scope.totalItems = $scope.filtered.length;
                    $scope.noOfPages = Math.ceil($scope.totalItems / $scope.entryLimit);
                    $scope.currentPage = 1;
                }, true);


                //show modal form
                $scope.toggle = function (modalstate, id) {
                    $scope.modalstate = modalstate;
                    switch (modalstate) {
                        case 'agregar':
                            $scope.form_title = "Agregrar Usuarios";
                            break;
                        case 'edit':
                            $scope.form_title = "Actualizar Usuarios";
                            $scope.id = id;
                            $http.get(API_URL + 'employees444/' + id)
                                    .success(function (response) {
                                        $scope.employee = response;
                                        console.log($scope.employee);
                                    });
                            break;
                        default:
                            break;
                    }

                    $('#myModal').modal('show');
                }


                //save new record / update existing record
                $scope.employee = {};
                $scope.save = function (modalstate, id) {

                    var url = API_URL + "employees444";
                    //append employee id to the URL if the form is in edit mode
                    if (modalstate === 'edit') {
                        url += "/" + id;
                    }

                    multipartForm.post(url, $scope.employee);


                }

                //delete record
                $scope.confirmDelete = function (id)
                {
                    var isConfirmDelete = confirm('Desea eliminar?');
                    if (isConfirmDelete)
                    {
                        $http({
                            method: 'DELETE',
                            url: API_URL + 'employees444/' + id
                        }).success(function (data)
                        {

                            location.reload();
                        }).error(function (data)
                        {
                            alert('No se pudo eliminar');
                        });
                    } else
                    {
                        return false;
                    }
                }
            });
});


app.directive('fileModel', ['$parse', function ($parse) {
        return {
            restrict: 'A',
            link: function (scope, element, attrs) {
                var model = $parse(attrs.fileModel);
                var modelSetter = model.assign;

                element.bind('change', function () {
                    scope.$apply(function () {
                        modelSetter(scope, element[0].files[0]);
                    })
                })
            }
        }
    }])

app.service('multipartForm', ['$http', function ($http) {
        this.post = function (url, data) {
            var fd = new FormData();
            for (var key in data)
                fd.append(key, data[key]);
            $http.post(url, fd, {
                transformRequest: angular.indentity,
                headers: {'Content-Type': undefined}
            });
        }
    }])

app.controller('profesoresController', function ($scope, $http, API_URL) {


    $http.get("listarfilesangular")
            .success(function (response) {
                $scope.employees = response;
            });

    //show modal form
    $scope.toggle = function (modalstate, id) {
        $scope.modalstate = modalstate;

        switch (modalstate) {
            case 'add':
                $scope.form_title = "Add New Employee";
                break;
            case 'edit':
                $scope.form_title = "Employee Detail";
                $scope.id = id;
                $http.get('listarfilesangular/' + id)
                        .success(function (response) {
                            console.log(response);
                            $scope.employee = response;
                        });
                break;
            default:
                break;
        }
        console.log(id);
        $('#myModal').modal('show');
    }
    //save new record / update existing record
    $scope.save = function (modalstate, id) {
        var url = API_URL + "profesores";
        console.log($scope.employee);
        //append employee id to the URL if the form is in edit mode
        if (modalstate === 'edit') {
            url += "/actualizar/" + id;
        }
        $http({
            method: 'POST',
            url: url,
            data: $.param($scope.employee),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function (response) {
            console.log(response);
            location.reload();
        }).error(function (response) {
            console.log(response);
            alert('This is embarassing. An error has occured. Please check the log for details');
        });
    }




});
