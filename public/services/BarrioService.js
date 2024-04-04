SeriesApp.factory("BarrioService", function ($http, $resource, base_api) {
    return $resource(base_api + "/admin/postbarrios/:id", null, {
        'update': { 'method':'PUT' }
    });
});