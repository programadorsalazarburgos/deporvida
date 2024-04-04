$(window).load(function() 
{
    $('#combinar_button').attr('disabled','disabled');
    $('.checkuniversity').click(function()
    {
      buscar_check();
    });
});
function buscar_check()
{
    if(($("input[name='combinar[]']:checked").length)>1)
    {
        $('#combinar_button').removeAttr('disabled');
    }
    else
    {
        $('#combinar_button').attr('disabled','disabled');
    }
}
    function modal_iniciar()
    {
      $('#combinar_button').click(function()
      {
          var id=$($("input[name='combinar[]']:checked")[0]).val()
          $.ajax({
            url:base+'/institucioneseducativas/name',
            type:'post',
            dataType:'json',
            data:{id:id},
            success:function(data)
            {
                if(data.validate)
                {
                    $('#name').val(data.data.nombre);
                    $('#myModal').modal('show');
                }
            }
          });
      })
    }
    $(function()
    {
        modal_iniciar();
        CargarRegistro();
        combinar_nombres_save();
    });
    function combinar_nombres_save()
    {
        $('#cambiar_nombre').click(function()
        {
            var data=[];
            $.each($("input[name='combinar[]']:checked"),function(index,value)
            {
                data.push($(value).val());
            })
            $.ajax({
                url:base+'/institucioneseducativas/change_name',
                type:'post',
                //dataType:'json',
                data:{name:$('#name').val(),data_id:data},
                success:function(data)
                {
                    $('#myModal').modal('hide');
                    CargarRegistro();
                }
            })
            console.log(data);
        });
    }
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
       var table = $("#table_hoja_vida").DataTable ({
                    destroy: true,
                    paging: false,

                    language: {url: base + "/js/languages/datatable.Spanish.json"},
                    ajax:base+'/institucioneseducativas/instituciones',
                    //pageLength:$('#pagination_value').val(),
                    "columns" : 
                    [
                       {
                            data: 'id', "title": "COMBINAR", 
                            render:function (id,nombre) 
                            {
                                var html = '<label><input onchange="buscar_check()" type="checkbox"   value="'+id+'" class="checkuniversity" name="combinar[]" /> Seleccionar</label>';
                                return html;
                            }
                        },
                        { "data" : "nombre" , "title": "Nombre" },
                        {
                            data: 'id', "title": "Opciones", 
                            render:function (id) 
                            {
                                var html = '<a href="'+base+'/institucioneseducativas/editar/'+id+'" class="btn btn-default"><i class="fa fa-wrench"></i> Editar</button>';
                                return html;
                            }
                        }
                    ],
                    drawCallback:function(response)
                    {
                        var info = table.page.info();
                        $('.count_datatable').html(info.recordsTotal);
                    }
                    
                });
        $('.dataTables_info').hide();
        $('.search_value').on('keyup', function () 
        {
        });
        $('.pagination_value').change(function()
        {
            table.page.length($('.pagination_value').val()).draw();
        });
}