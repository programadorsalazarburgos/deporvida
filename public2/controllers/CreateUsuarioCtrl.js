
SeriesApp.controller("CreateUsuarioCtrl", function ($scope, UsuarioService, fileUpload, $http, $location, base_api) 
{



function asignar_rol(id_user, id_rol)
{
    alert(123);
    /*
        $.ajax({
            url: 'asignar/roles',
            data: {user: id_user, rol: id_rol},
            type: 'POST',
            dataType: 'json',
            success: function (data)
            {
                if (data.validate)
                {
                    swal("Asignado!", "Se asigno el usuario un rol.", "success");
                    window.location = base + '/postusuarios/asignar';
                }
                else
                {
                    swal("Error", "Se presento un error inexperado", "warning");
                    console.log(data.msj);
                }
            }
        });*/
 }
 function buscar(a)
 {
    console.log(a);
 }
$(document).ready(function () 
{
    $('.btn_rol_click').clic(function()
    {
        console.log(
            $(this).attr('data-user'),
            $(this).attr('data-rol')
            );
    });
  $('[name=integer-data-attribute]').maskNumber({integer: true});
    $('.formlista').change(function()
    {
        var direccion='';
        $.each($('.formlista'),function(index,value)
        {
            if($(value).val()!='')
            {
                direccion = direccion + ' ' + $(value).val();
            }
        });
        direccion=$.trim(direccion);
        $('[name=direccion]').val(direccion);
    });
});


$.datepicker.setDefaults($.datepicker.regional['es']);
$(function () 
{
$("#fecha_nacimiento").datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange:'-100:+0'
  });
});


    $scope.onBlurDocumento = function ($event)
    {
        if($('[name=integer-data-attribute]').val()!='')
        {
            var url = base_api + '/verificar/documento_usuario/' + $('[name=integer-data-attribute]').val();
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'JSON',
                async: false,
            }).success(function (data)
            {
                if(data.validate)
                {
                    $scope.numero_documento = null;
                    toastr.warning(data.data.primer_nombre+' '+data.data.segundo_nombre+' '+data.data.primer_apellido+' '+data.data.segundo_apellido+' ya se encuentra en el sistema.', 'No Documento: ' + data.data.numero_documento);
                    $scope.numero_documento = null;
                    $('[name=integer-data-attribute]').val('');
                }
            })
            .error(function () {
                $('#repetido_documento').hide();
            });
        }
    }



    $scope.onBlurCorreo = function ($event)
    {
        if($('#email').val()!='')
        {
            $.ajax({
                type:'POST',
                url:base+'/user/validaremail',
                data:{email:$('#email').val()},
                dataType:'json',
                success:function(data)
                {
                    if(data.validate)
                    {
                        swal("Error!", "El correo "+$('#email').val()+" ya se encuentra registrado en el sistema.", "warning");
                            $('#myModal').modal('hide');
                            $('#email').val('');
                    }
                }
            });
        }
    }
    function ngChangeCtrl($scope, requestField) 
    {
        $scope.email = requestField();
        $scope.myFieldDisplay = angular.copy($scope.email);
        $scope.changeField = function (newVal, oldVal) 
        {
            $scope.newVal = newVal;
            alert($scope.newVal);
        };
    }
    $.ajax({
        url:base+'/documento/tipos',
        type:'get',
        dataType:'json',
        success:function(data)
        {
            $scope.tipo_documento = data;
        }
    });
    $scope.title = "Agregar Usuario";
    //$scope.disable_submit = false;
    $scope.serie = {};
    $scope.today = function () 
    {
        $scope.dt = new Date();
    };
    $scope.today();
    $scope.openCalendar = function ($event) 
    {
        $event.preventDefault();
        $event.stopPropagation();
        $scope.opened = true;
    }
    $http.get(base_api + "/obtenerselect/roles").success(function (response) 
    {
        $scope.roles = response;
    });
    $scope.formsubmit = function (isValid) 
    {
        if (isValid) 
        {
            var midata = new FormData();
            var primer_nombre = $scope.primer_nombre;
            var segundo_nombre = $scope.segundo_nombre;
            var primer_apellido = $scope.primer_apellido;
            var segundo_apellido = $scope.segundo_apellido;
            var tipo_documento = $scope.tipo_documento_usuario;
            var numero_documento = $scope.numero_documento;
            var direccion = $scope.direccion;
            var fecha = $("#fecha_nacimiento").val();
            var telefono_movil = $scope.telefono_movil;
            var telefono_fijo = $scope.telefono_fijo;
            var correo = $scope.email;
            var rol = $scope.rol;
            var password = $scope.registerData.password_confirmation;
            var d = new Date(fecha);
            var fecha_nacimiento = $.datepicker.formatDate('yy-mm-dd', d);

            midata.append('primer_nombre', primer_nombre);
            midata.append('segundo_nombre', segundo_nombre);
            midata.append('primer_apellido', primer_apellido);
            midata.append('segundo_apellido', segundo_apellido);
            midata.append('tipo_documento', tipo_documento);
            midata.append('numero_documento', numero_documento);
            midata.append('direccion', direccion);
            midata.append('fecha_nacimiento', fecha);
            midata.append('telefono_movil', telefono_movil);
            midata.append('telefono_fijo', telefono_fijo);
            midata.append('correo', correo);
            midata.append('rol', rol);
            midata.append('password', password);
            $.ajax({
                url: base_api + '/guardar/usuario',
                type: 'POST',
                contentType: false,
                data: midata, // mandamos el objeto formdata que se igualo a la variable data
                processData: false,
                cache: false,
                dataType: 'json',
                success: function (respuestaAjax)
                {
                    if (respuestaAjax.validate)
                    {
                        swal("Almacenado!", "Registro Guardado.", "success");
                        $('#myModal').modal('hide');
                    } else
                    {
                        swal("Error!", respuestaAjax.msj, "success");
                        console.log(respuestaAjax.log);
                    }
                }
            });
        }
    };
});