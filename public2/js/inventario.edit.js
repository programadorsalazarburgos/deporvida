    $(function ()
    {
        $("td input#enfisico").keyup(function() {                
                var filaactual = $(this).closest('tr'); //.index();
                var bodega = filaactual.find('input#enbodega').val();
                var fisico = filaactual.find('input#enfisico').val();

                filaactual.find('input#diferencia').val(bodega - fisico);                
        });

        $('#responsable_user_id').val({{$inventario->responsable_user_id}});

        $('#inventario_form').submit(function (e)
        {
            e.preventDefault();

            var detalles=[];
            var parame=[];
            $("table tbody tr").each(function(i,e){
            
                var tr = [];
                $(this).find("td").each(function(index, element){
                        var td = {};
                        td= $(this).find("input").val()+$(this).find("select").val();
                        td = td.replace("undefined","");                        
                        td = parseInt(td);
                        tr.push(td);
                 });
                detalles.push(tr);    
            });

            var id = $('#id').val();
            var fecha = $('#fecha').val();
            var responsable_user_id = $('#responsable_user_id').val();
            var observaciones = $('#observaciones').val();

            var data = {
                'fecha': fecha,
                'responsable_user_id': responsable_user_id,
                'observaciones': observaciones,
                'elementos': detalles 
            }  

            $.ajax({
                url: base + '/admin/inventariofisico/update/'+id,
                type: 'POST',
                data: data,
                contentType: 'application/x-www-form-urlencoded',
                success: function (data)
                {
                    $('body,html').animate({scrollTop: 0}, 500);
                    swal("Modificado!", "Registro Actualizado.", "success");
                    window.location = base + '/admin/inventariofisico';
                }
            });

        });
    });

