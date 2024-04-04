    $(function ()
    {
        $('#contratista_user_id').keyup(function(e)
        {
            var usuarios = $('#user_id').data('usuarios');
            var usuario = $('#contratista_user_id').val();
            var user = usuarios.find(x => x.documentos === usuario )
            if(user)
            {
                $('#user_id').val(user.id).trigger('change.select2');;
                $('#comuna_id').val(user.comunas);
                $('#disciplina').val(user.disciplinas);
            }
            else
            {
                $('#user_id').val();
                $('#comuna_id').val("");
                $('#disciplina').val("");
            }

        });

        $('.select_user_id').select2();


        $('#prestamo_form').submit(function (e)
        {
            e.preventDefault();
                    var elementos=[];
                    $("table tbody tr").each(function(i,e){
                        var td = [];
                        $(this).find("td").each(function(index, element){
                            var tr = {};
                            tr= $(this).find("input").val();
                            td.push(tr);
                        });
                        elementos.push(td);
                    });

            var fecha = $('#fecha').val();
            var contratista_user_id = $('#contratista_user_id').val();
            var observaciones = $('#observaciones').val();
            var comuna_id = $('#comuna_id').val();
            var data = {
                'fecha': fecha,
                'contratista_user_id': contratista_user_id,
                'observaciones': observaciones,
                'comuna_id': comuna_id,
                'elementos': elementos
            }
            $('#submit_button').attr("disabled", true);
            $.ajax({
                url: base + '/admin/prestamoinventario/save',
                type: 'POST',
                data: data,
                contentType: 'application/x-www-form-urlencoded',
                success: function (data)
                {

                    $('#submit_button').attr("disabled", true);
                    $('body,html').animate({scrollTop: 0}, 500);
                    swal("Almacenado!", "Registro Guardado.", "success");
                    window.location = base + '/admin/prestamoinventario';
                }
            });

        });
        $('#user_id').change(function(e) {
            $('#comuna_id').val($('#user_id option:selected').attr('data-comunas'));
            $('#disciplina').val($('#user_id option:selected').attr('data-disciplinas'));
            $('#contratista_user_id').val($('#user_id option:selected').attr('data-documento'));
        });

        $('.clas_id').change(function(e)
        {
            e.preventDefault();
            var i = 2;
            $('#agrega_clasificacion').bind('click', function(e)
            {
                e.preventDefault();
                $clone=$("#clasificacion_0").clone();
                $($clone).attr('id','clasificacion_'+i)
                $("#clasificacion_section").append($clone);
                $("#clasificacion_"+i+" .clas_id").attr('id','clasificacion_id_'+(i));
                $("#clasificacion_"+i+" .implementos").attr('id','implementos_'+(i));
                $('#implementos_'+(i)).html('');
                $("#clasificacion_"+i+" .clas_id").attr('data-id',i)
                $("#clasificacion_"+i+" .clas_id").attr('onchange',"changeClasificacion("+i+")");
                i++;
            })
        });
    });
    function changeClasificacion(id_implemento)
    {
            var id = $('#clasificacion_id_'+id_implemento).val();
            $.get(base + '/admin/entradainventario/listarimplementos/'+id, function(data)
            {
                var tabla = '<table class="table">';
                    tabla += '<thead>';
                    tabla += '<tr>';
                    tabla += '<th></th><th width="100%">Nombre Implemento</th><th>Cantidad</th>';
                    tabla += '<tr>';
                    tabla += '<tbody>';
                    tr = '';

                    $.each(data, function(key,element){
                        tr += '<tr>';
                        tr += '<td><input type="hidden" name="id" value="'+element["id"]+'" ></td><td><input type="text" class="form form-control" style="background-color:#FFF" value="'+element["nombre"]+'" readonly></td><td><input class="form form-control" type="number" value="0" max="' + element["maximo"] + '" min="0" name="cantidad" style="text-align:right; background-color:#FFF" ></td>';
                        tr += '</tr>';
                    });
                    tabla += tr;
                    tabla += '</tbody></table>';
                $('#implementos_'+id_implemento).html( tabla );
            });
    }

    function agregarclasificacion()
    {
        $clone=$("#clasificacion_0").clone();
        $("#clasificacion_id").attr('id','clasificacion_id_');
        $("#clasificacion_section").append($clone);

    }
