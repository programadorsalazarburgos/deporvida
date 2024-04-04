SeriesApp.factory("GrupoService", function ($http, $resource, base_api) {
    return $resource(base_api + "/admin/postgrupos/:id", null, {
        'update': { 'method':'PUT' }
    });
});