function print_novedad(id)
{
    console.log(id);
}
function vew_novedades()
{
       var table = $("#table_novedades").DataTable (
       {
                    destroy: true,
                    language: {url: base + "/js/languages/datatable.Spanish.json"},
                    ajax:base+'/novedad/metodologos2',
                    "ordering": false,
                    "columns" : [
                        { "data" : "fecha_reportar" ,   "title": "Fecha de novedad" },
                        { "data" : "fecha_creacion" ,   "title": "Fecha de creacion" },
                        { "data" : "monitor" ,          "title": "Monitor" },
                        { "data" : "numero_documento" , "title": "Documento" },
                        { "data" : "tipo" ,             "title": "Tipo novedad" },
                        { "data" : "nombre" ,           "title": "Novedad" },
                        {
                            data: 'id', "title": "Opciones",
                            render:function (value)
                            {
                                return '<a href="'+base+'/novedad/registro'+value+'" class="btn btn-default">Ver novedad</a>';
                            }
                        }
                    ]
        });
}
function save()
{
    $('form').submit(function(e)
    {
        $('#save').attr('disabled','disabled');
        e.preventDefault();
        $.ajax({
            url:base+'/novedad/informesave',
            data:$(this).serialize(),
            type:'POST',
            success:function(data)
            {
                if(data.validate)
                {
                    swal('Guardado con exito');
                    $('#imprimir').attr('href',base+'/novedad/accidente/'+data.id);
                    $('#imprimir').show();
                }
                else{
                    $('#save').removeAttr('disabled');
                }
            },
            error:function(data)
            {
                $('#save').removeAttr('disabled');
            }
        });
    });
}
$(function()
{
    $('#imprimir').hide();
	vew_novedades();
    save();
});
