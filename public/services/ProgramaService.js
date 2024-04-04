SeriesApp.factory("ProgramaService", function ($http, $resource, base_api) {
    return $resource(base_api + "/admin/postprogramas/:id", null, {
        'update': { 'method':'PUT' }
    });
});