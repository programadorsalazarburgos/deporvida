$(function ()
{
    $('#form').submit(function (e)
    {
        e.preventDefault();
        $.ajax(
        {
            type: 'POST',
            url: 'Horarios/SaveBeneficiarios',
            data: $('#form').serialize(),
            success: function (data)
            {
                swal("Almacenado!", "Se ha registrado la asistencia.", "success");
                $('#save').attr('disabled', 'disabled');
            }
        });
    });
    $('#grupos').change(function ()
    {
        $('#table').html('');
        $.ajax(
        {
            type: 'POST',
            url: 'Horarios/FechasGrupos',
            data:
            {
                id: $('#grupos').val()
            },
            dataType: 'json',
            success: function (data)
            {
                if (data.validate)
                {
                    $('#fecha').html(data.data);
                    $('#save').removeAttr('disabled');
                }
            }
        });
    });
    $('#fecha').change(function ()
    {
        if ($('#fecha').val() != 'Seleccione')
        {
            $.ajax(
            {
                type: 'POST',
                url: base+'/Horarios/Beneficiarios',
                data:
                {
                    id: $('#grupos').val(),
                    fecha: $('#fecha').val()
                },
                dataType: 'json',
                success: function (data)
                {
                    $('#table').html('');
                    if (data.validate)
                    {
                        $('#save').removeAttr('disabled');
                        $('#table').html(data.html);
                    }
                    else
                    {
                        swal("Error!", data.msj, "error");
                    }
                }
            });
        }
        else
        {
            $('#table').html('');
        }
    });
});
$(function ()
{
    $('#fecha_calendar').prop('disabled', true);
    $('#form').submit(function (e)
    {
        e.preventDefault();
        $.ajax(
        {
            type: 'POST',
            url: 'Horarios/SaveBeneficiarios',
            data: $('#form').serialize(),
            success: function (data)
            {
                swal("Almacenado!", "Se ha registrado la asistencia.", "success");
                $('#save').attr('disabled', 'disabled');
            }
        });
    });
    $('#grupos').change(function ()
    {
        $('#fecha_calendar').datepicker("destroy");
        $('#fecha_calendar').val("");
        $('#fecha_calendar').prop('disabled', true);
        $('#table').html('');
        $.ajax(
        {
            type: 'POST',
            url: 'Horarios/FechasGrupos',
            data:
            {
                id: $('#grupos').val()
            },
            dataType: 'json',
            success: function (data)
            {
                if (data.validate)
                {
                    $('#fecha_calendar').prop('disabled', false);
                    date1 = data.fecha_min.split("-");
                    date2 = data.fecha_max.split("-");
                    var fechamin = new Date(date1[0], date1[1] - 1, date1[2]);
                    var fechamax = new Date(date2[0], date2[1] - 1, date2[2]);
                    $('#fecha_calendar').datepicker(
                    {
                        dateFormat: 'yy-mm-dd',
                        changeMonth: true,
                        changeYear: true,
                        firstDay: 1,
                        minDate: fechamin,
                        maxDate: fechamax,
                        beforeShowDay: function (date)
                        {
                            var dia = date.getDate();
                            var mes = date.getMonth() + 1;
                            var yyy = date.getFullYear();
                            var fecha_formateada = yyy + '-' + (((mes) < 10) ? '0' + mes : mes) + '-' + ((dia < 10) ? '0' + dia : dia);
                            //console.log({date:date,fecha_formateada:fecha_formateada,fecha_min:data.fecha_min,fecha_max:data.fecha_max});
                            var res = [false, "somecssclass"];
                            $.each(data.data, function (i, values)
                            {
                                if (values.fecha == fecha_formateada)
                                {
                                    var dada = false;
                                    $.each(data.clases_dadas, function (j, val)
                                    {
                                        if (val.fecha_asistencia == fecha_formateada)
                                        {
                                            dada = true;
                                        }
                                    });
                                    if (dada)
                                    {
                                        res = [true, 'dada', 'Asistencia tomada'];
                                    }
                                    else
                                    {
                                        res = [true, "someothercssclass"];
                                    }
                                }
                            })
                            return res;
                        }
                    }).attr('readonly', 'readonly').attr('style', 'background-color: #FFF;cursor: pointer;').attr('placeholder', 'clic para seleccionar una fecha');
                    $('#save').removeAttr('disabled');
                }
                else
                {
                    $('#fecha_calendar').prop('disabled', true);
                }
            }
        });
    });
    $('#fecha_calendar').change(function ()
    {
        if ($('#fecha_calendar').val() != '')
        {
            $.ajax(
            {
                type: 'POST',
                url: base+'/Horarios/Beneficiarios',
                dataType: 'json',
                data:
                {
                    id: $('#grupos').val(),
                    fecha: $('#fecha_calendar').val()
                },
                success: function (data)
                {
                    $('#table').html('');
                    if (data.validate)
                    {
                        $('#save').removeAttr('disabled');
                        $('#table').html(data.html);
                    }
                    else
                    {
                        swal("Error!", data.msj, "error");
                    }
                }
            });
        }
        else
        {
            $('#table').html('');
        }
    });
});