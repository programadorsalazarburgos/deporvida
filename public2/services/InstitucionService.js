SeriesApp.factory("InstitucionService", function ($http, $resource, base_api) {
    return $resource(base_api + "/admin/postinstituciones/:id", null, {
        'update': { 'method':'PUT' }
    });
});