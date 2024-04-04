SeriesApp.factory("ComunaService", function ($http, $resource, base_api) {
    return $resource(base_api + "/admin/postcomunas/:id", null, {
        'update': { 'method':'PUT' }
    });
});