
function change_pais()
{
    $('#persona_id_procedencia_pais').change(function ()
    {
        $.ajax({
            url: base + '/ubicacion/departamentos',
            type: 'POST',
            data: {id: $('#persona_id_procedencia_pais').val()},
            async:false,
            dataType: 'json',
            success: function (data)
            {
                var res = '<option value="">Seleccione</option>';
                $('#persona_id_ciudad').val('');
                $.each(data, function (index, value)
                {
                    res += '<option value="' + value.id + '">' + value.nombre_departamento + '</option>';
                });
                $('#persona_id_procedencia_departamento').html(res);
                $('#persona_id_ciudad').val('');
            }
        });
    });
}
function departamentos()
{
    $.ajax({
        url: base + '/ubicacion/municipios',
        type: 'POST',
        data: {id: $('#persona_id_procedencia_departamento').val()},
        dataType: 'json',
        async:false,
        success: function (data)
        {
            var res = '<option value="">Seleccione</option>\n\
                        ';
            $('#persona_id_ciudad').val('');
            $.each(data, function (index, value)
            {
                res += '<option value="' + value.id + '">' + value.nombre_municipio + '</option>\n\
                        ';
            });
            $('#persona_id_ciudad').html(res);
            $('#persona_id_procedencia_municipio').html(res);
            try
            {
                seleccionar_municipio_procedencia();
            } catch (Exception)
            {
                console.log('No hay datos');
            }
        }
    });
}
function change_departamento()
{
    $('#persona_id_procedencia_departamento').change(function ()
    {
        departamentos();
    });
}
function cambios()
{
    $('#persona_id_procedencia_pais').val(1);
    $('#persona_id_procedencia_departamento').val(3);
    $('#persona_id_ciudad').val(131);
}
function estratos_barrios()
{
    $('#persona_id_residencia_barrio').change(function ()
    {
        var comuna = $('#persona_id_residencia_barrio option:selected').attr('data-comuna');
        var estrato = $('#persona_id_residencia_barrio option:selected').attr('data-estrato');
        $('#persona_residencia_estrato').val(estrato);
        $('#persona_residencia_estrato').val(estrato).trigger('change');
        $('#comuna').val(comuna);
    });
}
$(function ()
{
    estratos_barrios();
    change_pais();
    change_departamento();
    cambios();
});