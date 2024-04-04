SeriesApp.factory("EscenarioService", function ($http, $resource, base_api) {
    return $resource(base_api + "/admin/postescenarios/:id", null, {
        'update': { 'method':'PUT' }
    });
});