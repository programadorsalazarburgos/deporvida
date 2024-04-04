SeriesApp.factory("BeneficiarioService", function ($http, $resource, base_api) {
    return $resource(base_api + "/admin/postbeneficiarios/:id", null, {
        'update': { 'method':'PUT' }
    });
});