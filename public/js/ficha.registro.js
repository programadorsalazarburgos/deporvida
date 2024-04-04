var editar_variable=false;
function editar(id_ficha)
{
    editar_variable=true;
    $.ajax({
        url: base + '/ficha/registrar/' + id_ficha,
        dataType: 'json',
        success: function (data, textStatus, jqXHR) 
        {
			console.log("4444");
            $.each(data, function (index, value)
            {
                $('#' + index).val(value);
				// verificamos orientacion sexual
				console.log("4444" +index);
				if(index == "tipo_orientacion_sexual"){
					console.log("aden" +value);
					if(parseInt(value)==13){
						console.log("2222");
						$('#rowOtroOrientacionSexual').show();
					}
				} 
            });
            $(window).load(function ()
            {
                $('#id_persona_acudiente_sexo_'+data.id_persona_acudiente_sexo).prop('checked', true);

                $('#id_persona_beneficiario_sexo_'+data.id_persona_beneficiario_sexo).prop('checked', true);

                SearchVeredas();
                $('#id_persona_beneficiario_id_residencia_vereda').val(data.id_persona_beneficiario_id_residencia_vereda);
                otro_etnia();
                enfermedad();
                medicamentos();
                check_other();
                $('#id_persona_beneficiario_edad').html(calcularEdad($('#id_persona_beneficiario_fecha_nacimiento').val()));
                $('#id_persona_acudiente_edad').html(calcularEdad($('#id_persona_acudiente_fecha_nacimiento').val()));
            });

        }
    });
}
function SearchVeredas()
{
    if($('#id_persona_beneficiario_id_residencia_corregimiento').val()!='')
    {
        $.ajax({
            url: base + '/veredas/corregimiento/' + $('#id_persona_beneficiario_id_residencia_corregimiento').val(),
            dataType: 'json',
            async: false,
            success: function (data, textStatus, jqXHR)
            {
                var temp = '<option>Seleccione</option>';
                $.each(data, function (index, value)
                {
                    temp += '<option value="' + value.id + '">' + value.nombre + '</value>';
                });
                $('#id_persona_beneficiario_id_residencia_vereda').html(temp);
            }
        });
    }
}
function corregimientos_veredas()
{
    $('#id_persona_beneficiario_id_residencia_corregimiento').change(function ()
    {
        SearchVeredas();
    });
}
function change_pais()
{
    $('#id_persona_beneficiario_id_procedencia_pais').change(function ()
    {
        $.ajax({
            url: base + '/ubicacion/departamentos',
            data: {id: $('#id_persona_beneficiario_id_procedencia_pais').val()},
            type: 'POST',
            dataType: 'json',
            success: function (data)
            {
                $('#id_persona_beneficiario_id_procedencia_departamento').select({
                    value: 'id',
                    name: 'nombre_departamento',
                    data: data
                });
                search_municipios();
            }
        });
    });
}
function search_municipios()
{
    $.ajax({
        url: base + '/ubicacion/municipios',
        data: {id: $('#id_persona_beneficiario_id_procedencia_departamento').val()},
        type: 'POST',
        async: false,
        dataType: 'json',
        success: function (data)
        {
            $('#id_persona_beneficiario_id_procedencia_municipio').select({
                value: 'id',
                name: 'nombre_municipio',
                data: data
            });
        }
    });
}
function change_departamento()
{
    $('#id_persona_beneficiario_id_procedencia_departamento').change(function ()
    {
        search_municipios();
    });
}
function comuna()
{
    var comuna = $('#id_persona_beneficiario_id_residencia_barrio option:selected').attr('data-comuna');
    var id_estrato = $('#id_persona_beneficiario_id_residencia_barrio option:selected').attr('data-id_estrato');
    $('#numero_comuna').html(comuna);
    $('#id_persona_beneficiario_residencia_estrato').val(id_estrato);
}
function direccion()
{
    $('.formlista').change(function ()
    {
        var direccion = '';
        $.each($('.formlista'), function (index, value)
        {
            if ($(value).val() != '')
            {
                direccion = direccion + ' ' + $(value).val();
            }
        });
        direccion = $.trim(direccion);
        $('#id_persona_beneficiario_residencia_direccion').val(direccion);
    });
}
function otro_etnia()
{
    $('.other').hide();
    $('.etnia_radio').click(function ()
    {
        if ($(this).val() == '7')
        {
            $('.other').show();
            $('#se_reconoce_como_cual').attr('required', 'required');
            $('#se_reconoce_como_cual').val('');
        } else
        {
            $('.other').hide();
            $('#se_reconoce_como_cual').removeAttr('required');
        }
    });
}
function enfermedad()
{
    $('#ficha_enfermedad_padece_si').change(function ()
    {
        if ($('#ficha_enfermedad_padece_si').val() == 'si')
        {
            $('#ficha_enfermedad_padece_nombre').show();
        } else
        {
            $('#ficha_enfermedad_padece_nombre').hide();
        }
    })
}
function medicamentos()
{
    $('#ficha_medicamentos_toma_si').change(function ()
    {
        if ($('#ficha_medicamentos_toma_si').val() == 'si')
        {
            $('#ficha_medicamentos_toma_nombre').show();
        } else
        {
            $('#ficha_medicamentos_toma_nombre').hide();
        }
    })
    ficha_medicamentos_toma_si
}
function registrar_datos(data)
{
    if (data.beneficiario !== null)
    {
        $.each(data.beneficiario, function (index, value)
        {
            var name='#id_persona_beneficiario_' + index;
            $(name).val(value);
            console.log([name,value]);
        });
    }
    if (data.acudiente !== null)
    {
        $.each(data.acudiente, function (index, value)
        {
            $('#id_persona_acudiente_' + index).val(value);
        });
    }
    $('#id_persona_beneficiario_edad').html(calcularEdad($('#id_persona_beneficiario_fecha_nacimiento').val()));
}
function Buscar_documentos()
{
    $('#id_persona_acudiente_documento').change(function ()
    {
        $.ajax({
            url: base + '/persona/search', //'ficha_create',
            data: {documento: $('#id_persona_acudiente_documento').val()},
            type: 'POST',
            dataType: 'json',
            success: function (data)
            {
                $.each(data.beneficiario, function (index, value)
                {
                    $('#id_persona_acudiente_' + index).val(value);
                });
            }
        });
    })
    $('#persona_documento').change(function ()
    {
        $.ajax({
            url: base + '/persona/search', //'ficha_create',
            data: {documento: $('#persona_documento').val()},
            type: 'POST',
            dataType: 'json',
            success: function (data)
            {
                var documento = $('#id_persona_acudiente_documento').val();
                $('form')[0].reset();
                $('#id_persona_acudiente_documento').val(documento);
                registrar_datos(data);
            }
        });
    });
}
function check_other()
{
    $('#hide_cual').hide();
    $('#ocupacion_8').click(function ()
    {
        if (!$(this).is(':checked'))
        {
            $('#hide_cual').hide();
        } else
        {
            $('#hide_cual').show();
        }
    })
}
$(function ()
{
	// change de cambio de orientacion sexual
	$("#tipo_orientacion_sexual").change(function(){
		$("#rowOtroOrientacionSexual").hide();
		$("#rowOtroOrientacionSexual").val("");
		$("#orientacion_sexual_otro").val("N/A").change();
		if(parseInt($(this).val()) == 13){
			$("#rowOtroOrientacionSexual").show(500,"");
			$("#orientacion_sexual_otro").val("").change();
		}
	});
	
    $('#grupo_poblacional_otro').hide();
    $('#id_grupo_poblacional_10').change(function ()
    {
        if ($('#id_grupo_poblacional_10').is(':checked'))
        {
            $('#grupo_poblacional_otro').show();
            $('#grupo_poblacional_otro').attr('required', 'required');
        } else
        {
            $('#grupo_poblacional_otro').hide();
            $('#grupo_poblacional_otro').val('');
            $('#grupo_poblacional_otro').removeAttr('required');
        }
    });
    corregimientos_veredas();
    $('#hide_cual').hide();
    $('#panel_participado_antes').hide();
    $('#participado_antes').change(function ()
    {
        if ($(this).val() == 'si')
        {
            $('#panel_participado_antes').show();
        } else
        {
            $('#panel_participado_antes').hide();

        }
    });
    //check_other();
    otro_etnia();
    comuna();
    direccion();
    enfermedad();
    medicamentos();
    Buscar_documentos();
    change_pais();
    change_departamento();
    $('input').keyup(function ()
    {
        //$(this).val($(this).val().toUpperCase());
    });
    $('#id_persona_beneficiario_id_residencia_barrio').change(function ()
    {
        comuna();
    });
    $('#id_persona_acudiente_fecha_nacimiento').change(function ()
    {
        $('#id_persona_acudiente_edad').html(calcularEdad($('#id_persona_acudiente_fecha_nacimiento').val()));
    });
    $('#id_persona_beneficiario_fecha_nacimiento').change(function ()
    {
        $('#id_persona_beneficiario_edad').html(calcularEdad($('#id_persona_beneficiario_fecha_nacimiento').val()));
    });
    $('form').submit(function (e)
    {
        //$('button').attr('disabled','disabled');
        e.preventDefault();
        if(editar_variable)
        {
            var url=base + '/ficha/editar';
        }
        else
        {
            var url=base + '/ficha/create';
        }
        $.ajax({
            url: url, //'ficha_create',
            data: $('form').serialize(),
            type: 'get',
            dataType: 'json',
            success: function (data)
            {
                if (data.validate)
                {
                    swal("Almacenado!", "Registro Guardado.", "success");
                    location.href = base + '/admin/postgrupos#/admin/postgrupos/misbeneficiarios/' + id;

                } else
                {
                    $('button').removeAttr('disabled');
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Error", "Se presento un error inesperado", "warning");
                $('#Log').html(jqXHR);
            }
        });
    });
    $('#id_persona_beneficiario_documento').addClass('only_number');
    $('#id_persona_beneficiario_documento').inputmask({alias: 'decimal', rightAlign: true, groupSeparator: ',', digits: 0, autoGroup: true});
    $('#id_persona_beneficiario_id_documento_tipo').change(function ()
    {
        if ($(this).val() == '5')
        {
            $('#id_persona_beneficiario_documento').removeClass('only_number');
            $('#id_persona_beneficiario_documento').inputmask('remove');

        } else
        {
            $('#id_persona_beneficiario_documento').addClass('only_number');
            $('#id_persona_beneficiario_documento').inputmask({alias: 'decimal', rightAlign: true, groupSeparator: ',', digits: 0, autoGroup: true});
        }
    });
    $('#id_persona_acudiente_documento').inputmask({alias: 'decimal', rightAlign: true, groupSeparator: ',', digits: 0, autoGroup: true});
    $('#id_documento_tipo').change(function ()
    {
        if ($(this).val() == '5')
        {
            $('#id_persona_acudiente_documento').removeClass('only_number');
            $('#id_persona_acudiente_documento').inputmask('remove');

        } else
        {
            $('#id_persona_acudiente_documento').addClass('only_number');
            $('#id_persona_acudiente_documento').inputmask({alias: 'decimal', rightAlign: true, groupSeparator: ',', digits: 0, autoGroup: true});
        }
    });
    $('#id_persona_beneficiario_residencia_direccion').add_generator({
        direccion: 'id_persona_beneficiario_residencia_direccion',
        complemento: 'id_persona_beneficiario_residencia_direccion_complemento',
    });
    $('#discapacidad_hide').change(function ()
    {
        if ($(this).val() == '1')
        {
            $('#discapacidad_div').show();
            $('#tiempo_meses').val('');
        } else
        {
            $('#discapacidad_div').hide();
        }
    });
    otros_parentescos();
});

function otros_parentescos()
{
    $('#other_parentesco,#other_vive_con').hide();
    $('#ficha_id_parentesco').change(function ()
    {
        if ($(this).val() == '6')
        {
            $('#other_parentesco').show();
            $('#ficha_persona_acudiente_parentesco_otro').attr('required', 'required');
            $('#ficha_persona_acudiente_parentesco_otro').val('');
        } else
        {
            $('#other_parentesco').hide();
            $('#ficha_persona_acudiente_parentesco_otro').removeAttr('required');
        }
    });
    $('#ficha_id_persona_vive_con_parentesco').change(function ()
    {
        if ($(this).val() == '6')
        {
            $('#other_vive_con').show();
            $('#ficha_persona_vive_con_parentesco_otro').attr('required', 'required');
            $('#ficha_persona_vive_con_parentesco_otro').val('');
        } else
        {
            $('#other_vive_con').hide();
            $('#ficha_persona_vive_con_parentesco_otro').removeAttr('required');
        }
    });
    $('#id_grupo_poblacional_10').change(function ()
    {
        if ($(this).is(':checked'))
        {
            $('#ficha_grupo_poblacional_otro').show();
            $('#ficha_grupo_poblacional_otro').attr('required', 'required');
            $('#ficha_grupo_poblacional_otro').val('');
        } else
        {
            $('#ficha_grupo_poblacional_otro').hide();
            $('#ficha_grupo_poblacional_otro').removeAttr('required');
            $('#ficha_grupo_poblacional_otro').val('');
        }
    });
    $('#ficha_grupo_poblacional_otro').hide();
    search_municipios();
    $('#id_persona_beneficiario_id_procedencia_municipio').val(834);
}