SeriesApp.factory("LocalizacionInstitucionService", function ($http, $resource, base_api) {
    return $resource(base_api + "/admin/postlocalizacion/institucion/:id", null, {
        'update': { 'method':'PUT' }
    });
});

