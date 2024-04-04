$(function ()
{
    $('#form').submit(function (e)
    {
        e.preventDefault();
        $.ajax({
            url: base+'/Horarios/SaveEditPlanificacion',
            data: $('#form').serialize(),
            type: 'POST',
            success: function (data)
            {
                swal("Editado", "Se ha editado con exito.", "success");
            }
        });
    });
})