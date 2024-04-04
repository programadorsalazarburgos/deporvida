SeriesApp.factory("EpsService", function ($http, $resource, base_api) {
    return $resource(base_api + "/admin/posteps/:id", null, {
        'update': { 'method':'PUT' }
    });
});