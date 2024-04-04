var app = angular.module('employeeRecords', ['ui.bootstrap'])
.constant('API_URL', 'http://localhost:8000/api/v13/');

app.filter('startFrom', function () {
    return function (input, start) {
        if (input) {
            start = +start;
            return input.slice(start);
        }
        return [];
    };
});
