SeriesApp.controller("EditarEscenarioCtrl", function ($scope, EscenarioService, $routeParams, fileUpload, $http, $location, $timeout, base_api)
{
    $(function ()
    {
        Corregimientos();
        editar();
    });
    function editar()
    {
        $('#form_edit_escenario').submit(function (e)
        {
            console.log(123, base);
            e.preventDefault();
            $.ajax({
                url: base + '/' + $(this).attr('action'),
                type: 'POST',
				dataType:'json',
                data: $(this).serialize(),
                success: function (data)
                {
					if(data.validate)
					{
						swal("Exito", "Registro Actualizado.", "success");
					}
					else
					{
						swal("Exito", "Registro Actualizado.", "warning");
						console.log(data);
					}
                }
            });
        });
    }
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
    function ValidarEscenarios(data)
    {
        $('#descripcion').val(data.escenario.descripcion);
        $('#direccion').val(data.escenario.direccion);
        $('#direccion_complemento').val(data.escenario.direccion_complemento);
        $('#id').val(data.escenario.id);
        $('#id_barrio').val(data.escenario.id_barrio);
        $('#id_corregimiento').val(data.escenario.id_corregimiento);
        $('#nombre_escenario').val(data.escenario.nombre_escenario);
        $('#tipoescenario_id').val(data.escenario.tipoescenario_id);
        if ($('#id_corregimiento').val() != '')
        {
            veredas();
            $('#id_vereda').val(data.escenario.id_vereda);
            validarCorregimientos();
        }
    }
    function ValidarEquipamientos(equipamiento)
    {
        for (var i = 0; i < equipamiento.length; i++)
        {
            tipoesequipamientos();
        }
        $.each($('.data_equipamiento'), function (index, value)
        {
            var tempid = ($(value).attr('id'));
            $('#' + tempid + ' select').val(equipamiento[index].id_equipamiento);
            $('#' + tempid + ' input').val(equipamiento[index].cantidad);
        });
    }
    function insert_data(data)
    {

        ValidarEscenarios(data);
        ValidarEquipamientos(data.equipamiento);
    }
    $scope.title = "Editar Escenario";
    $scope.series = [];
    $scope.getData = function () {
        $scope.serie = EscenarioService.get({id: $routeParams.id});
    };
    $http.get("/barrios/listado")
            .success(function (response)
            {
                $scope.data_barrios = response;
            });
    $http.get(base_api + "/datostipoescenraio/search/" + $routeParams.id)
            .success(function (data)
            {
                insert_data(data);
            });
    $http.get(base_api + "/obtenerselect/tipoescenarios")
            .success(function (response)
            {
                $scope.tipoescenarios = response;
            });
    $scope.serie = {};
    $scope.disabled = undefined;
    $scope.enable = function ()
    {
        $scope.disabled = false;
    };
    $scope.disable = function ()
    {
        $scope.disabled = true;
    };
    $scope.clear = function ()
    {
        $scope.person.selected = undefined;
        $scope.address.selected = undefined;
        $scope.country.selected = undefined;
    };
    $scope.person = {};
    $scope.address = {};
    $scope.refreshAddresses = function (address)
    {
        var params = {address: address, sensor: false};
        return $http.get
                (
                        'http://maps.googleapis.com/maps/api/geocode/json',
                        {params: params}
                ).then(function (response)
        {
            $scope.addresses = response.data.results
        });
    };
    $scope.limpiar = function ()
    {
        $('#seleccionado').hide();
    }
    $scope.getData();
    $scope.formsubmit = function (id, isValid)
    {
        if (isValid)
        {
            var midata = new FormData();
            var nombre_escenario = $scope.serie.nombre_escenario;
            var descripcion = $scope.serie.descripcion;
            var obtener_tipoescenario = $("#tipoescenario").val();
            var tipoescenario = obtener_tipoescenario.replace('number:', '');
            var obt_sede = $scope.person.id;
            if (obt_sede == undefined)
            {
                obt_sede = 0;
                var sede = obt_sede;
            } else
            {
                var sede = obt_sede['id']
            }
            midata.append('nombre_escenario', nombre_escenario);
            midata.append('descripcion', descripcion);
            midata.append('tipoescenario', tipoescenario);
            midata.append('sede', sede);
            $.ajax
                    ({
                        url: base_api + '/postescenarios/EditarEscenario/' + id,
                        type: 'POST',
                        contentType: false,
                        data: midata, // mandamos el objeto formdata que se igualo a la variable data
                        processData: false,
                        cache: false,
                        success: function (respuestaAjax)
                        {
                            swal("Almacenado!", "Registro Actualizado.", "success");
                            window.location = "/admin/postescenarios#/admin/postescenarios";
                        }
                    });
        }
    };
});
