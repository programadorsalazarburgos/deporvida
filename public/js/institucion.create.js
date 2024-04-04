$(function () 
{
    $('form').validate();
    $('form').submit(function (e) 
    {
        e.preventDefault();
        if ($(this).valid()) 
        {
            $.ajax(
            {
                url: base + '/institucioneseducativas/nuevo_registro/',
                type: 'POST',
                data: $(this).serialize(),
                success: function () 
                {
                    swal("Guardado!", "Finalizado.", "success");
                }
            })
        }
    });
});