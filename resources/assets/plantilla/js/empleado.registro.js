var id_ciudad_procedencia = false;
var Iniciado;
function abrirModal()
{
    GeneratorAdd('persona_residencia_direccion', 'persona_residencia_direccion_observacion');
}
function buscadores()
{
    $('.select2_create').select2();
}
function universidades()
{
    $('#ficha_universidad').autocomplete({source: base + '/universidades/get'});
}
function insert_data_input(name_input, index, value)
{
    try {
        var name = name_input + index;
        var tag = $(name);
        $(name).val(value);
        if (tag[0].tagName === 'SELECT')
        {
            $(name).val(value).trigger('change');
        }
    } catch (e)
    {
    }
}

function change_documento()
{
    var temp = $('#persona_documento').val();
    $('input[type="text"],input[type="email"],input[type="number"]').val('');
    $('#persona_documento').val(temp);
    $.ajax({
        url: base + '/personal/validate_doc',
        type: 'POST',
        dataType: 'json',
        data: {documento: $('#persona_documento').val()},
        success: function (data)
        {
            if (data.validate)
            {
                id_ciudad_procedencia = (data.data.ciudadano.id_procedencia_municipio);
                $.each(data.data.ciudadano, function (index, value)
                {
                    insert_data_input('#persona_', index, value);
                });
                $.each(data.data.ficha, function (index, value)
                {
                    insert_data_input('#ficha_', index, value);
                });
                $('.comuna_impacto').prop('checked', false);
                $.each(data.data.comunas_impacto, function (index, value)
                {
                    $.each(value, function (index1, value1)
                    {
                        var temp = '#' + index1 + value1;
                        $(temp).prop('checked', true);
                    });
                });
                if (Object.keys(data.data.ficha).length)
                {

                    if (Iniciado)
                    {
                        //swal("Usuario ya registrado!", "El documento " + $('#persona_documento').val() + " ya se encuentra registrado en el sistema.", "warning");
                    } else
                    {
                        Iniciado = true;
                    }

                } else
                {
                    $('.data_hide').removeAttr('style');
                    $('.data_hide').attr('style', 'display:block !important');
                    $('#persona_id_procedencia_pais').val(1);
                    $('#persona_id_procedencia_departamento').val(3);

                    $('#persona_id_procedencia_pais').val(1).trigger('change');
                    $('#persona_id_procedencia_departamento').val(3).trigger('change');
                    $('#persona_id_ciudad').val(131).trigger('change');
                }
            }
            cheques_comunas();
        }
    });
}
function seleccionar_municipio_procedencia()
{
    $('#persona_id_procedencia_municipio').val(id_ciudad_procedencia);
    $('#persona_id_procedencia_municipio').val(id_ciudad_procedencia).trigger('change');
    console.log(id_ciudad_procedencia, $('#persona_id_procedencia_municipio').html());

}
function cambio_check_comuna()
{
    var total = $('.comuna_impacto:checked').length;
    switch ($('#persona_id_rol').val())
    {
        case '7':
            if (total >= parseInt(max_monitor))
            {
                $('.comuna_impacto').attr("disabled", true);
                $('.comuna_impacto:checked').attr("disabled", false);
                if (total > max_monitor)
                {
                    swal("Se han seleccionado mas opciones de las permitidas", "Recuerde que este rol solo tiene permitido seleccionar " + max_monitor + " territorios de impacto como máximo ", "warning");
                }
            } else
            {
                $('.comuna_impacto').attr("disabled", false);
            }
            break;
        case '8':
            if (total >= parseInt(max_metodologo))
            {
                $('.comuna_impacto').attr("disabled", true);
                $('.comuna_impacto:checked').attr("disabled", false);
                if (total > max_metodologo)
                {
                    swal("Se han seleccionado mas opciones de las permitidas", "Recuerde que este rol solo tiene permitido seleccionar " + max_metodologo + " territorios de impacto como máximo ", "warning");
                }
            } else
            {
                $('.comuna_impacto').attr("disabled", false);
            }
            break;
    }
}
function cheques_comunas()
{
    $('.comuna_impacto').attr("disabled", true);
    cambio_check_comuna();
    $('.comuna_impacto').change(function ()
    {
        cambio_check_comuna();
    });
    $('#persona_id_rol').change(function ()
    {
        $('.comuna_impacto').attr('checked', false);
        if ($('#persona_id_rol').val() == '7' || $('#persona_id_rol').val() == '8')
        {
            $('.comuna_impacto').attr("disabled", false);
        } else
        {
            $('.comuna_impacto').attr("disabled", true);
        }
    });
}
function guardar()
{


    $('#empleado_form').submit(function (e)
    {
        e.preventDefault();
        $.ajax({
            url: base + '/personal/save_user',
            type: 'POST',
            data: $(this).serialize(),
            success: function (data)
            {
                $('body,html').animate({scrollTop: 0}, 500);
                swal("Almacenado!", "Registro Guardado.", "success");
                //window.location = base + '/admin/postusuarios#/admin/postusuarios';
            }
        });
    });
}
function other()
{
    if (!PoseePermisos)
    {
        $('#other').html('');
    }
    if ($('#persona_id_persona').val() != '')
    {
        change_documento();
    }
}
function select(id, data)
{
    $(id).html('');
    var temp = '<option data-comuna="" data-estrato="" value="">Seleccione</option>';
    $.each(data, function (index, value)
    {
        temp += '<option data-comuna="' + value.id_comuna + '" data-estrato="' + value.estrato + '" value="' + value.id + '">' + value.nombre + '</option>';
    });
    $(id).html(temp);
}
function BuscarVeredas()
{
    $('#persona_id_residencia_corregimiento').change(function ()
    {
        if ($('#persona_id_residencia_corregimiento').val() != '')
        {
            $.ajax({
                url: base + '/veredas/corregimiento/' + $('#persona_id_residencia_corregimiento').val(),
                dataType: 'json',
                success: function (data)
                {
                    $('#ficha_id_vereda').val('');
                    select('#ficha_id_vereda', data);
                    $('#ficha_id_vereda').select2();
                }
            });
        }
    });
}
$(function ()
{
    Iniciado = true;
    if (window.location.href == base + '/')
    {
        Iniciado = false;
        $('#persona_documento').attr('readonly', 'true');
        $('#persona_documento').attr('style', 'background-color:#FFF;');
    }
    $('#label_ficha_toma_medicamentos').hide();
    $('#persona_residencia_direccion').add_generator({
        direccion: 'persona_residencia_direccion',
        complemento: 'persona_residencia_direccion_observacion'
    });
    $('#ficha_toma_medicamentos').change(function ()
    {
        if ($(this).val() == '1')
        {
            $('#ficha_medicamentos').show();
            $('#label_ficha_toma_medicamentos').show();
        } else
        {
            $('#ficha_medicamentos').hide();
            $('#label_ficha_toma_medicamentos').hide();
        }
    });
    $('#posee_discapacidad').hide();
    $('#ficha_tiene_discapacidad').change(function ()
    {
        if ($('#ficha_tiene_discapacidad').val() == '1')
        {
            $('#posee_discapacidad').show();
        } else
        {
            $('#posee_discapacidad').hide();
        }
    });

    buscadores();
    cheques_comunas();
    universidades();
    guardar();
    BuscarVeredas();
    $('#generar_direccion').add_generator({
        direccion: 'persona_residencia_direccion',
        complemento: 'persona_residencia_direccion_observacion'
    });
    $('#persona_documento').change(function ()
    {
        change_documento();
    });
    $('#grupo_poblacional_otro').hide();
    $('#div_enfermedad').hide();
    $('#ficha_medicamentos').hide();
    $('#persona_toma_medicamentos').change(function ()
    {
        if ($(this).val() == '1')
        {
            $('#ficha_medicamentos').show();
            $('#ficha_medicamentos').attr('required', 'required');
        } else
        {
            $('#ficha_medicamentos').hide();
            $('#ficha_medicamentos').removeAttr('required');
        }
    });
    $('#ficha_padece_enfermedad').change(function ()
    {
        if ($('#ficha_padece_enfermedad').val() == '1')
        {
            $('#div_enfermedad').show();
            $('#label_ficha_enfermedad').show();
            $('#ficha_enfermedad').attr('required', 'required');
        } else
        {
            $('#div_enfermedad').hide();
            $('#label_ficha_enfermedad').hide();
            $('#ficha_enfermedad').removeAttr('required');
        }
    });
    $('#id_grupo_poblacional_10').click(function ()
    {
        if ($('#id_grupo_poblacional_10').attr('checked'))
        {
            $('#grupo_poblacional_otro').show();
            $('#grupo_poblacional_otro').attr('required', 'required');
        } else
        {
            $('#grupo_poblacional_otro').hide();
            $('#grupo_poblacional_otro').removeAttr('required');
        }
    });
    $('input').keyup(function ()
    {
        //$(this).val($(this).val().toUpperCase());
    });
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
        $('#persona_residencia_direccion').val(direccion);
    });
    $('#persona_id_documento_tipo').change(function ()
    {
        if ($(this).val() == '5')
        {
            $('#persona_documento').removeClass('only_number');
            $('#persona_documento').inputmask('remove');

        } else
        {
            $('#persona_documento').addClass('only_number');
            $('#persona_documento').inputmask({alias: 'decimal', rightAlign: true, groupSeparator: ',', digits: 0, autoGroup: true});
        }
    });
    $('#persona_id_procedencia_departamento').val($('#persona_id_procedencia_departamento').val()).trigger('change');
    $('#persona_id_procedencia_municipio').val($('#persona_id_procedencia_municipio').val()).trigger('change');
    $('#ficha_id_vereda').change(function ()
    {
        if ($(this).val() !== '')
        {
            $('#div_persona_id_residencia_barrio').hide();
            $('#div_direccion').hide();
            $('#div_complemento').removeClass('col-md-6');
            $('#div_complemento').addClass('col-md-12');
            $('#persona_residencia_direccion_observacion').removeAttr('readonly');
            $('#persona_residencia_direccion_observacion').removeAttr('style');
            $('#persona_residencia_direccion_observacion').attr('style', 'background-color: #FFF;cursor: initial;');

        } else
        {
            $('#div_persona_id_residencia_barrio').show();
            $('#div_direccion').show();
            $('#div_complemento').removeClass('col-md-12');
            $('#div_complemento').addClass('col-md-6');
            $('#persona_residencia_direccion_observacion').attr('readonly', 'readonly');
            $('#persona_residencia_direccion_observacion').removeAttr('style');
            $('#persona_residencia_direccion_observacion').attr('style', 'background-color: #FFF;cursor: pointer;');
        }
        $('#comuna').val($("#ficha_id_vereda option:selected").attr('data-comuna'));
        $('#persona_residencia_estrato').val($("#ficha_id_vereda option:selected").attr('data-estrato'));
    });
    $('#show_contry').hide();
    $('#persona_id_procedencia_pais').change(function ()
    {
        if ($(this).val() == '1')
        {
            $('#show_contry').hide();
            $('#other_contry').show();
            $('#persona_id_procedencia_municipio').attr('required', 'required');
        } else
        {
            $('#show_contry').show();
            $('#other_contry').hide();
            $('#persona_id_procedencia_municipio').removeAttr('required');
        }
    });
    other();
});