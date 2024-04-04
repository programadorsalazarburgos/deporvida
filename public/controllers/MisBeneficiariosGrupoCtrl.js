SeriesApp.controller("MisBeneficiariosGrupoCtrl", function ($scope, GrupoService, $routeParams, fileUpload, $http, $location, $timeout, base_api) {
    $scope.title = "Mis Beneficiarios";
    $scope.series = [];

    $scope.getData = function () {
        $scope.series_grupos = GrupoService.get({id: $routeParams.id});

        $scope.grupo = $routeParams.id;
        $http.get(base_api + "/obtener/misbeneficiarios/" + $routeParams.id)
                .success(function (response) {
                    $scope.list = response;
                    $scope.currentPage = 1; //current page
                    $scope.entryLimit = 50; //max no of items to display in a page
                    $scope.filteredItems = $scope.list.length; //Initially for no filter
                    $scope.totalItems = $scope.list.length;
                });
    };



    $scope.setPage = function (pageNo) {
        $scope.currentPage = pageNo;

    };
    $scope.filter = function () {
        $timeout(function () {
            $scope.filteredItems = $scope.filtered.length;
        }, 10);
    };
    $scope.sort_by = function (predicate) {
        $scope.predicate = predicate;
        $scope.reverse = !$scope.reverse;
    };

    $scope.getData();
    $scope.series = GrupoService.query();



    $http.get(base_api + "/obtenerselect/comunas")
            .success(function (response) {

                $scope.comunas = response;


            });



    $scope.toggle = function (modalstate, id) {
        $scope.modalstate = modalstate;
        switch (modalstate) {

            case 'CambiarGrupo':
                $scope.form_contenido = "GRUPOS";
                $scope.form_title = "obtener";
                $scope.id = id;


                break;
            default:
                break;
        }

        $('#myModal').modal('show');
    }




    $http.get(base_api + "/obtener/allgruposmonitor")
            .success(function (response) {
                $scope.grupos = response;


            });


    $scope.formCambiar = function (isValid, id) {


        if (isValid) {

            $.ajax({
                url: base_api + '/postbeneficiario/asociargrupo/' + id,
                type: 'POST',
                dataType: 'JSON',
                data: {
                    grupo_id: $scope.grupo
                },

            }).success(function () {

                $scope.getData();
                toastr.success("Su registro ha sido exitoso", "Grupo Asociado");
                window.location = "/admin/postgrupos#/admin/postgrupos/misbeneficiarios/" + $routeParams.id;
                $('#myModal').modal('hide');


            })
                    .error(function () {
                        console.log("success");
                    });

        }

    }



    $scope.formsubmit = function (id, isValid) {
        $scope.fecha_iscrip = $scope.startDateInscripcion;
        var d_inscripcion_date = new Date($scope.fecha_iscrip);
        var fecha_inscripcion_date = $.datepicker.formatDate('yy/mm/dd', d_inscripcion_date);
        $scope.fecha_nac_benef = $scope.startDate;
        var d_nacimiento_beneficiario = new Date($scope.fecha_nac_benef);
        var fecha_nacimiento_beneficiario = $.datepicker.formatDate('yy/mm/dd', d_nacimiento_beneficiario);
        $scope.fecha_nac_acud = $scope.startDateParentesco;
        var d_nacimiento_acudiente = new Date($scope.fecha_nac_acud);
        var fecha_nacimiento_acudiente = $.datepicker.formatDate('yy/mm/dd', d_nacimiento_acudiente);
        var SelectPoblacional = $scope.selected.poblacionales;


        if (isValid) {


            var datos = {
                fecha_inscripcion: fecha_inscripcion_date,
                no_ficha: $scope.numero_ficha,
                programa_id: $scope.programa,
                modalidad: $scope.modalidad,
                punto_atencion: $scope.punto_atencion,
                nombres_beneficiario: $scope.nombres_beneficiario,
                apellidos_beneficiario: $scope.apellidos_beneficiario,
                tipo_documento_beneficiario: $scope.tipo_documento_beneficiario,
                no_documento_beneficiario: $scope.no_documento_beneficiario,
                sexo_beneficiario: $scope.sexo_beneficiario,
                fecha_nac_beneficiario: fecha_nacimiento_beneficiario,
                edad_beneficiario: $scope.edad_beneficiario,
                telefono_beneficiario: $scope.telefono_beneficiario,
                correo_beneficiario: $scope.correo_beneficiario,
                pais_id: $scope.pais,
                departamento_id: $scope.departamento,
                municipio_id: $scope.municipio,
                direccion_beneficiario: $scope.residencia_beneficiario,
                estrato_beneficiario: $scope.estrato,
                comuna_id: $scope.comuna,
                barrio_id: $scope.barrio,
                corregimiento_beneficiario: $scope.corregimiento,
                vereda_beneficiario: $scope.vereda,
                estado_civil_beneficiario: $scope.est_beneficiario,
                hijos_beneficiario: $scope.hijo,
                cantidad_hijos_beneficiario: $scope.cantidad_hijos,
                tipo_sangre_beneficiario: $scope.tip_sangre,
                ocupacion_beneficiario: $scope.ocupacion,
                otra_ocupacion_beneficiario: $scope.ocupacion_otra,
                escolaridad_beneficiario: $scope.escolaridad,
                cultura_beneficiario: $scope.cultura,
                otra_cultura_beneficiario: $scope.cultura_otro,
                discapacidad_beneficiario: $scope.discapacidad,
                discapacidad_select_beneficiario: $scope.discapacidad_otro,
                otra_discapacidad_beneficiario: $scope.otra_discapacidad,
                enfermedad_permanente_beneficiario: $scope.enfermedad,
                enfermedad_beneficiario: $scope.otra_enfermedad,
                medicamentos_permanente_beneficiario: $scope.medicamento,
                medicamentos_beneficiario: $scope.medicamento_otro,
                seguridad_social_beneficiario: $scope.seguridad,
                salud_sgsss_beneficiario: $scope.salud,
                nombre_seguridad_beneficiario: $scope.nombre_entidad,
                nombres_acudiente: $scope.nombres_familiar,
                apellidos_acudiente: $scope.apellidos_familiar,
                tipo_doc_acudiente: $scope.tipo_familiar,
                documento_acudiente: $scope.no_documento_pariente,
                sexo_acudiente: $scope.sex_pariente,
                fecha_nac_acudiente: fecha_nacimiento_acudiente,
                edad_acudiente: $scope.edad_pariente,
                telefono_acudiente: $scope.telefono_pariente,
                correo_acudiente: $scope.email_pariente,
                parentesco_acudiente: $scope.parentesco,
                otro_parentesco_acudiente: $scope.otro_parentesco
            };



            $.ajax({
                url: base_api + '/postbeneficiario/create/' + id,
                type: 'POST',
                dataType: 'JSON',
                data: {
                    datos,
                    SelectPoblacional
                },

            }).success(function () {

                toastr.success("Su registro ha sido exitoso", "Registro Almacenado");
                window.location = "/admin/postgrupos#/admin/postgrupos";


            })
                    .error(function () {
                        console.log("success");
                    });


        }


    };


    $scope.GuardarMotivo = function(isValid, ficha)
    {

        if (isValid) {

             $.ajax({
                    url: base + '/beneficiario/desvincular?ficha=' + ficha + '&motivo=' + $scope.motivo,
                    type: 'GET',
                    dataType: 'JSON',
                }).success(function (response)
                {
                    swal("Desvinculado!", "Registro Desvinculado.", "success");
                    $scope.getData();
                     $('#myModal2').modal('toggle');
                }).error(function ()
                {
                    
                });

        }

        else{
            alert('rellene los campos');
        }

       
    }

    $scope.eliminar = function (id)
    {
        swal({
            title: "Va a desvincular este beneficiario",
            text: "¿Desea continuar?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Si, Desvincular!",
            cancelButtonText: "No, lo Elimines!",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function (isConfirm)
        {
            if (isConfirm)
            {

            $http.get(base_api + "/obtener/motivos")
            .success(function (response) {
                $scope.motivos = response;
                $scope.ficha = id;

            });


                swal("Porque deseas desvincular este beneficiario", "Elije tu opción");
                $("#myModal2").modal();
               
            } else
            {
                swal("Cancelado", "No desvinculo su beneficiario :)", "error");
            }
        });
    }
});
