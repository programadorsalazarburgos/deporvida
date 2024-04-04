SeriesApp.controller("CreateEscenarioCtrl", function ($scope, EscenarioService, fileUpload, $http, $location, base_api)
{
    
    
    $(function ()
    {
        Corregimientos();
    });
    function validarCorregimientos()
    {
        if ($('#id_corregimiento').val() == '')
        {
            $('#hide_divs').show();
            $('#id_vereda').html('');
        } else
        {
            $('#hide_divs').hide();
            veredas();
        }
    }
    function Corregimientos()
    {
        $('#id_corregimiento').change(function ()
        {
            validarCorregimientos();
        });
    }
    function veredas()
    {
        $.ajax({
            url: base + '/veredas/corregimiento/' + $('#id_corregimiento').val(),
            dataType: 'json',
            async: false,
            success: function (data)
            {
                var html = '';
                $.each(data, function (index, value)
                {
                    html += '<option value="' + value.id + '">' + value.nombre + '</option>';
                });
                $('#id_vereda').html(html);
            }
        });
    }
    
    
    
    $('.direcciones').add_generator({
        direccion: 'direccion',
        complemento: 'complemento'
    });
    $('#form_create_escenario').submit(function (e)
    {
        e.preventDefault();
        $.ajax(
                {
                    url: base_api + '/postescenario/create/',
                    type: 'GET',
                    contentType: false,
                    data: $('#form_create_escenario').serialize(), // mandamos el objeto formdata que se igualo a la variable data
                    processData: false,
                    cache: false,
                    success: function (respuestaAjax)
                    {
                        swal("Almacenado!", "Registro Guardado.", "success");
                        window.location = "/admin/postescenarios#/admin/postescenarios";
                    }
                });
    });

    $scope.title = "Agregar Escenario";
    $scope.disable_submit = false;

    $scope.serie = {};



    $scope.disabled = undefined;

    $scope.enable = function () {
        $scope.disabled = false;
    };

    $scope.disable = function () {
        $scope.disabled = true;
    };

    $scope.clear = function () {
        $scope.person.selected = undefined;
        $scope.address.selected = undefined;
        $scope.country.selected = undefined;
    };

    $scope.person = {};


    $http.get(base_api + "/obtenerselect/tipoescenarios")
            .success(function (response) {

                $scope.tipoescenarios = response;

            });


    $http.get("/barrios/listado")
            .success(function (response)
            {
                $scope.data_barrios = response;
            });

    $scope.address = {};
    $scope.refreshAddresses = function (address) {
        var params = {address: address, sensor: false};
        return $http.get(
                'http://maps.googleapis.com/maps/api/geocode/json',
                {params: params}
        ).then(function (response) {
            $scope.addresses = response.data.results
        });
    };



    $scope.formsubmit = function (isValid) {


        if (isValid) {


            var midata = new FormData();
            var tipoescenario = $scope.tipoescenario;
            var nombre_escenario = $scope.nombre_escenario;
            var descripcion = $scope.descripcion;
            var obt_sede = $scope.person.id;
            var sede = obt_sede['id']



            midata.append('tipoescenario', tipoescenario);
            midata.append('nombre_escenario', nombre_escenario);
            midata.append('descripcion', descripcion);
            midata.append('sede', sede);


            $.ajax({
                url: base_api + '/postescenario/create/',
                type: 'POST',
                contentType: false,
                data: midata, // mandamos el objeto formdata que se igualo a la variable data
                processData: false,
                cache: false,
                success: function (respuestaAjax) {
                    swal("Almacenado!", "Registro Guardado.", "success");
                    window.location = "/admin/postescenarios#/admin/postescenarios";

                }
            });





        }


    };
});






