function semana() {
    $.ajax({
        url: base + '/grupos/ProximaSemana',
        dataType: 'json',
        success: function (data) {
            if (data.validate) {
                $('#semana_proxima').html(data.data);
            }
        }
    });

}
function VerDias(id_grupo) {
    $.ajax({
        url: base + '/grupos/DiasTrabajo',
        type: 'POST',
        data: { id_grupo: id_grupo },
        dataType: 'json',
        success: function (data) {
            if (data.validate) {
                var html = '';
                $.each(data.data, function (index, value) {
                    html += '<option value="' + value.dia + '">' + value.dia + '</option>';
                });
                $('#dia').html(html);
            }
        }
    });
}
function reiniciar() {
    $('#reset').hide();
    $('#reset').click(function (event) {
        $('input,select,textarea').val('');
        $('#dia').html('');
        $('body,html').animate({ scrollTop: 0 }, 500);
        $('#save').removeAttr('disabled');
        $('#save').show();
        $('#reset').hide();
        return false;
    });
}
$(function () {
    reiniciar();
    semana();
    $('#id_grupo').change(function () {
        VerDias($('#id_grupo').val());
    });
    $('#form').submit(function (e)
    {
        e.preventDefault();
        if ($(this).valid()) 
        {
            $('#save').attr('disabled', 'disabled');
            $.ajax({
                url: 'Horarios/Saveplanificacion',
                data: $('#form').serialize(),
                type: 'POST',
                success: function (data) {
                    $('#save').hide();
                    toastr.success('Guardado con exito');
                    $('#reset').show();
                }
            });
        }
    });
    $('form').validate();
})