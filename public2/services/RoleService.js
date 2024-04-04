SeriesApp.factory("RoleService", function ($http, $resource, base_api) {
    return $resource(base_api + "/admin/postroles/:id", null, {
        'update': { 'method':'PUT' }
    });
});