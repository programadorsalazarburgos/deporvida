SeriesApp.factory("LocalizacionService", function ($http, $resource, base_api) {
    return $resource(base_api + "/admin/postlocalizacion/:id", null, {
        'update': { 'method':'PUT' }
    });
});