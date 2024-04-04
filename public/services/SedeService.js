SeriesApp.factory("SedeService", function ($http, $resource, base_api) {
    return $resource(base_api + "/admin/postsedes/:id", null, {
        'update': { 'method':'PUT' }
    });
});