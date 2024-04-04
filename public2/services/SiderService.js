SeriesApp.factory("SiderService", function ($http, $resource, base_api) {
    return $resource(base_api + "/:id", null, {
        'update': { 'method':'PUT' }
    });
});