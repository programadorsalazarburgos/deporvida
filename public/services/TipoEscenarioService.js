SeriesApp.factory("TipoEscenarioService", function ($http, $resource, base_api) {
    return $resource(base_api + "/admin/posttipoescenarios/:id", null, {
        'update': { 'method':'PUT' }
    });
});