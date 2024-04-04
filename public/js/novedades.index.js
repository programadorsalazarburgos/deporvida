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
                    ajax:base+'/Novedades/misnovedades',
                    pageLength:$('#pagination_value').val(),
                    "ordering": false,
                    "columns" : [

                        { "data" : "fecha_reportar" , "title": "Fecha de novedad" },
                        { "data" : "novedad_tipo" , "title": "Tipo de novedad" },
                        { "data" : "nombre" , "title": "Titulo" },
                        { "data" : "detalle" , "title": "Detalle" },
                        {
                            data: 'id', "title": "Opciones", 
                            render:function (value) 
                            {
                                return '<div class="btn-group pull-right">'+
                                '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Acciones <span class="fa fa-caret-down"></span></button>'+
                                '    <ul class="dropdown-menu">'+
                                '        <li>'+
                                '           <a href="javascript:print_novedad('+value+')"><i class="fa fa-print" aria-hidden="true"></i>&nbsp;Imprimir novedad</a>'+
                                '        </li>'+
                                '    </ul>'+
                                '</div>';
                            }
                        }
                    ]
        });
}

$(function()
{
	vew_novedades();
});