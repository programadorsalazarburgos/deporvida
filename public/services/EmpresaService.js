SeriesApp.factory("EmpresaService", function ($http, $resource, base_api) {
    return $resource(base_api + "/admin/postempresa/:id", null, {
        'update': { 'method':'PUT' }
    });
});