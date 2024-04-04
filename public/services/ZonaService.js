SeriesApp.factory("ZonaService", function ($http, $resource, base_api) {
    return $resource(base_api + "/admin/postzonas/:id", null, {
        'update': { 'method':'PUT' }
    });
});