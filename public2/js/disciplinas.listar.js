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
                url: base + '/disciplinas/borrar/' + id,  
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
function CargarRegistro() 
{
    var table = $("#table_disciplina").DataTable (
    {
        destroy: true,
        language: {url: base + "/js/languages/datatable.Spanish.json"},
        ajax:base+'/disciplinas/disciplinas',
        pageLength:$('#pagination_value').val(),
        "columns" : 
        [
            { "data" : "descripcion" , "title": "Nombre" },
            {
                data: 'id', "title": "Opciones", 
                render:function (id) 
                {
                    var html = '<a href="'+base+'/disciplinas/editar/'+id+'" class="btn btn-default"><i class="fa fa-wrench"></i> Editar</a>';
                    var html = html +'<button onclick="Eliminar('+id+')" class="btn btn-default"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>';
                    return html;
                }
            }
        ],
        drawCallback:function(response)
        {
            var info = table.page.info();
            $('.count_datatable').html(info.recordsTotal);
            $('.dataTables_info').hide();
            $('#table_disciplina_filter').hide();
            $('#table_disciplina_length').hide();
        }
    });
    $('#pagination_value').on( 'keyup', function () 
    {
        table.page.len(this.value).draw();
    });
    $('#search').on( 'keyup', function () 
    {
        table.search( this.value ).draw();
    });
}