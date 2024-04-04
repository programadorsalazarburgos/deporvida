var data_grupo='';
    $(window).load(function ()
    {
        $('.tipos_equipamiento').hide();
        $('#id_user').val(data_grupo.id_monitor);
        $('#id_comuna_impacto').val(data_grupo.id_comuna_impacto);
        $('#id_escenario').val(data_grupo.id_escenario);
        $('#id_nivel').val(data_grupo.id_nivel);
        $('#id_disciplina').val(data_grupo.id_disciplina);
        $('#observaciones').val(data_grupo.observaciones);
        $('#codigo').html(data_grupo.codigo_grupo);
        $('#id_user').val($('#id_user').val()).trigger('change');
        $('#id_user').select2();
        $('#id_escenario').val($('#id_escenario').val()).trigger('change');
        $('#id_escenario').select2();
        $('#id_disciplina').val($('#id_disciplina').val()).trigger('change');
        $('#id_disciplina').select2();
        $.ajax({
            async: false,
            url: base + '/escenarios/equipamiento',
            data: {id: $('#id_escenario').val()},
            type: 'POST',
            dataType: 'json',
            success: function (data)
            {
                if (data.validate)
                {
                    $('.tipos_equipamiento').html(data.data);
                    horarios();
                }
            }
        });

    });
    function view_grupos()
    {
        $.ajax({
            url:base+'/grupos/view_grupos/'+id_grupos,
            dataType:'json',
            async:false,
            success:function(data)
            {
                data_dias=data.dias;
                data_grupo=data.grupos;
            }
        })
    }
    function ver_tipo_escenarios()
    {
        $.ajax({
            async: false,
            url: base + '/escenarios/equipamiento',
            data: {id: $('#id_escenario').val()},
            type: 'POST',
            dataType: 'json',
            success: function (data)
            {
                if (data.validate)
                {
                    $('.tipos_equipamiento').html(data.data);
                }
            }
        });
    }
    function formatTime(timeString)
    {
        var hourEnd = timeString.indexOf(":");
        var H = +timeString.substr(0, hourEnd);
        var h = H % 12 || 12;
        var ampm = H < 12 ? "AM" : "PM";
        timeString = h + timeString.substr(hourEnd, 3) + ampm;
        return (timeString);
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
    function horarios()
    {
        data = data_dias;
        $.each(data, function (index, value)
        {
            $('#ch_' + value.dia).attr('checked', true);
            $('#hi_' + value.dia).val(formatTime(value.hora_inicio));
            $('#hf_' + value.dia).val(formatTime(value.hora_fin));
            $('#he_' + value.dia).val(value.id_equipamiento);
            hora(value.dia);
        });
    }
    $(function ()
    {
        view_grupos();
        $('.hora').clockpicker({
            donetext: 'Guardar',
            placement: 'bottom',
            align: 'left',
            autoclose: true,
            twelvehour: true,
            vibrate: true
        });
        $('.hora').css('display', 'none');
        var data =data_grupo;
        $.each(data, function (index, value)
        {
            $('#' + index).val(value);
        });
        $('#form').submit(function (e)
        {
            $('#save').attr('disabled', 'disabled');
            e.preventDefault();
            $.ajax({
                async: false,
                url: base + '/grupos/ajaxedit',
                type: 'POST',
                data: $('#form').serialize(),
                dataType: 'json',
                success: function (data)
                {
                    if (data.validate)
                    {
                        swal("Guardado!", "El grupo ha sido editado.", "success");
                        setTimeout(function () {window.location = base + '/admin/postgrupos#/admin/postgrupos';}, 3000);
                    }
                    else
                    {
                        swal("Error!", "El grupo no ha sido editado. "+data.mensaje, "warning");
                        $('#save').removeAttr('disabled');
                    }
                },error:function(data)
                {
                    console.log(data);
                    swal("Error!", "El grupo no ha sido editado. ","warning");
                    $('#save').removeAttr('disabled');
                }
            })
        });
});