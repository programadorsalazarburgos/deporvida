    $(function()
    {
        CargarRegistro();
    });
    function Eliminar(id)
    {
        swal({
        title: "Estas seguro?",
        text: "No podrá recuperar este archivo!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Eliminado!",
        cancelButtonText: "No, lo Elimines!",
        closeOnConfirm: false,
        closeOnCancel: false
    },
    function(isConfirm) 
    {
        if (isConfirm) 
        {
            $.ajax({
                url: base + '/Horario/eliminar/' + id,  
                dataType: 'JSON',
            }).success(function(response)
            {
                swal("Eliminado!", "Registro Eliminado.", "success");
                CargarRegistro();
            });
        }
        else
        {
            swal("Cancelado", "No elimino su registro", "error");
        }
    });
    }
    function Guardar(id)
    {
        alert(id);
    }
function CargarRegistro() 
{
       var table = $("#table_planeacion").DataTable ({
                    destroy: true,
                    language: {url: base + "/js/languages/datatable.Spanish.json"},
                    ajax:base+'/Horarios/misplanificaciones',
                    pageLength:$('#pagination_value').val(),
                    "columns" : [

                        { "data" : "disciplina" , "title": "Disciplina" },
                        { "data" : "nombre_escenario" , "title": "Escenario" },
                        { "data" : "codigo_grupo" , "title": "Codigo" },
                        { "data" : "fecha", "title": "Fecha"  },
                        { "data" : "dia", "title": "Dia"  },
                        { "data" : "hora_inicio" , "title": "Inicio" },
                        { "data" : "hora_fin" , "title": "Fin" },
                        {
                            data: 'id', "title": "Opciones", 
                            render:function (id_grupo) 
                            {
                                return '<div class="btn-group pull-right">'+
                                '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Acciones <span class="fa fa-caret-down"></span></button>'+
                                '    <ul class="dropdown-menu">'+
                                '        <li>'+
                                '           <a href="Horarios/planificacion/'+id_grupo+'"><i class="fa fa-pencil-square-o"></i>&nbsp;Editar</a>'+
                                //'            <a href="#'+base+'/Horario/Editar/'+id_grupo+'"><i class="fa fa-pencil-square-o"></i>&nbsp;Editar</a>'+
                                '        </li>'+
                                '<!--'+
                                '        <li>'+
                                '           <a onclick="Guardar('+id_grupo+')"><i class="fa fa-save"></i>&nbsp;Guardar</a>'+
                                '        </li>'+
                                '-->'+
                                '        <li>'+
                                '            <a class="imp" href="'+base+'/Horarios/planeacion/'+id_grupo+'"><i class="fa fa-print"></i>&nbsp;Imprimir</a>'+
                                '        </li>'+
                                '        <li>'+
                                '            <a onclick="Eliminar('+id_grupo+')"><i class="fa fa-trash-o"></i>&nbsp;Eliminar planeacion</a>'+
                                '        </li>'+
                                '    </ul>'+
                                '</div>';
                                $('.imp').printPage();
                            }
                        }
                    ]
                });
        $('.search_value').on('keyup', function () 
        {
            table.search(this.value).draw();
        });
        $('.pagination_value').change(function()
        {
            $('#table_planeacion_length').hide();
            table.page.len($('.pagination_value').val()).draw();
            console.log(table.rows().count());
        });
}
                //$('.imp').printPage();