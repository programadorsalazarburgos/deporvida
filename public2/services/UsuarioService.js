SeriesApp.factory("UsuarioService", function ($http, $resource, base_api) {
    return $resource(base_api + "/admin/postusuarios/:id", null, {
        'update': { 'method':'PUT' }
    });
});