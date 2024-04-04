function comuna()
{
    var comuna = $('#id_residencia_barrio option:selected').attr('data-comuna');
    $('#numero_comuna').html(comuna);
}
$(function ()
{
    $('#id_residencia_barrio').change(function ()
    {
        comuna();
    });
    comuna();
    $('#fecha_nacimiento').change(function ()
    {
        $('#edad').html(calcularEdad($('#fecha_nacimiento').val()));
    });
    
    $('form').submit(function (e)
    {
        e.preventDefault();
        $.ajax({
            url: base + '/personal/create', //'ficha_create',
            data: $('form').serialize(),
            type: 'get',
            success: function (data)
            {
                $('#Log').html(data);
            }
        });
    });
});