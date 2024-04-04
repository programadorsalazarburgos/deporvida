function validarHoras()
{
    var resultado = true;
    $.each($('.dias'), function (index, value)
    {
        if ($(value).is(":checked"))
        {
            var data = validar_hora($('#hi_' + $(value).val()).val(), $('#hf_' + $(value).val()).val());
            if (!data)
            {
                resultado = false;
                var tooltips = $('#hi_' + $(value).val()).tooltip({'trigger': 'focus', 'title': 'Texto'});
                tooltips.tooltip('open');
                $('#hi_' + $(value).val()).attr('style', 'border-color:red !important');
                $('#hf_' + $(value).val()).attr('style', 'border-color:red !important');
            } else
            {
                $('#hi_' + $(value).val()).attr('style', 'border-color:#e5e5e5 !important');
                $('#hf_' + $(value).val()).attr('style', 'border-color:#e5e5e5 !important');
            }
        }
    });
    return resultado;
}
function validar_hora(horaDesde, horaHasta)
{
    var desde = (new Date(2000, 1, 1,
            (horaDesde.indexOf("PM") > -1) ?
            (
                    (parseInt(horaDesde.split(':')[0]) != 12) ?
                    parseInt(horaDesde.split(':')[0]) + 12 :
                    parseInt(horaDesde.split(':')[0])
                    ) :
            (parseInt(horaDesde.split(':')[0]) == 12) ?
            0 :
            parseInt(horaDesde.split(':')[0]),
            parseInt(horaDesde.split(':')[1]),
            0,
            0)
            );
    var hasta = (new Date(2000, 1, 1,
            (horaHasta.indexOf("PM") > -1) ?
            (
                    (parseInt(horaHasta.split(':')[0]) != 12) ?
                    parseInt(horaHasta.split(':')[0]) + 12 :
                    parseInt(horaHasta.split(':')[0])
                    ) :
            (parseInt(horaHasta.split(':')[0]) == 12) ?
            0 :
            parseInt(horaHasta.split(':')[0]),
            parseInt(horaHasta.split(':')[1]),
            0,
            0)
            );
    console.log(desde, hasta, (desde < hasta));
    return (desde < hasta);
}
function hora(e)
{
    var id = ('#ch_' + e);
    if ($('#ch_' + e).is(':checked'))
    {
        $('#hi_' + e).show();
        $('#hf_' + e).show();
        $('#he_' + e).show();
        $('#hi_' + e).attr('required', 'required');
        $('#hf_' + e).attr('required', 'required');
        $('#he_' + e).attr('required', 'required');
    } else
    {
        $('#he_' + e).removeAttr('required');
        $('#hi_' + e).removeAttr('required');
        $('#hf_' + e).removeAttr('required');
        $('#hi_' + e).hide();
        $('#he_' + e).hide();
        $('#hf_' + e).hide();
    }

}
function redireccionar()
{
    window.location = 'admin/postgrupos#/admin/postgrupos';
}
function ver_tipo_escenarios(dia,hora_inicio,hora_fin)
{
    $.ajax({
        url: base + '/escenarios/equipamiento',
        data: {
            id: $('#id_escenario').val(),
            dia:dia,
            hora_inicio:hora_inicio,
            hora_fin:hora_fin
        },
        type: 'POST',
        dataType: 'json',
        success: function (data)
        {
            if (data.validate)
            {
                $('#he_'+dia).html(data.data);
            } else
            {
                console.log(data.msj);
            }
        }
    });
}
$(function ()
{
    $('#id_disciplina').select2();
    $('#id_escenario').select2();
    try {

        $('.hora').clockpicker({
            donetext: 'Guardar',
            placement: 'bottom',
            align: 'left',
            autoclose: true,
            twelvehour: true,
            vibrate: true
        }).change(function()
        {
            var dia         = $(this).attr('data-dia');
            var hora_inicio = $('#hi_'+dia).val();
            var hora_fin    = $('#hf_'+dia).val();
            if($('#hi_'+dia).val()!='' && $('#hf_'+dia).val()!='' )
            {
                ver_tipo_escenarios(dia,hora_inicio,hora_fin)
            }
        });
    } 
    catch (Exception)
    {
        console.log(Exception);
    }
    $('.hora').css('display', 'none');
    $('.tipos_equipamiento').css('display', 'none');
    $('form').submit(function (e)
    {
        e.preventDefault();
        if (validarHoras())
        {
            $.ajax({
                url: 'grupos/ajaxcreate',
                data: $('#form').serialize(),
                type: 'POST',
                dataType: 'json',
                success: function (data)
                {
                    if (data.validate)
                    {
                        swal("Guardado!", "El nuevo grupo se ha creado.", "success");
                        setTimeout('redireccionar', 3000);
                        $('#save').attr('disabled', 'disabled');
                    } else
                    {

                        toastr.warning('Error al guardar', data.mensaje);
                    }
                },
                error: function (data)
                {
                    toastr.warning('Error al guardar', 'Se ha presentado un error');
                }
            });
        } else
        {
            toastr.warning('Error al guardar', 'Por favor revise las horas. La hora de inicio debe ser menor a la hora de fin');
        }
    });
});