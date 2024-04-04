    var id = 0;

    $(function ()
    {
        validar_form();
        id = $('.delete_button').length;
        editar();
        validarCorregimientos();
        Corregimientos();
        $('.direcciones').add_generator({
            direccion: 'direccion',
            complemento: 'complemento'
        });
    });
    function editar()
    {
        $('#form_edit_escenario').submit(function (e)
        {
            e.preventDefault();
            if(required_form())
            {
                var form=$(this).serialize();
                console.log(form);
                $.ajax({
                    url: base + '/' + $(this).attr('action'),
                    type: 'POST',
    				dataType:'json',
                    data: form,
                    success: function (data)
                    {
    					if(data.validate)
    					{
    						swal("Exito", "Registro Actualizado.", "success");
    					}
    					else
    					{
    						swal("Exito", "Registro Actualizado.", "warning");
    						console.log(data);
    					}
                    }
                });
            }
        });
    }
    function remove_table(removeid)
    {
        $('#remove_' + removeid).html('')
    }
    function tipoesequipamientos()
    {
        $.ajax({
            url: 'tipoesequipamientos',
            async: false,
            dataType: 'json',
            success: function (data)
            {
                $('#new_equipamento').after(div(data));
            }
        })
    }
    function div(data)
    {

        id = id + 1;
        var html = '';
        // html+='<table class="table">';
        html += '<tr id="remove_' + id + '" class="data_equipamiento">';
        html += '<td><select class="form form-control" name="escenario[tipo][]">';
        $.each(data, function (index, value)
        {
            html = html + '<option value="' + value.id + '">' + value.descripcion + '</option>';
        })
        html += '</select></td>';
        html += '<td><input class="form form-control" name="escenario[cantidad][]"/></td>';
        console.log(id);
        html += '<td><button type="button" class="btn btn-danger" onclick="remove_table(' + id + ')"><i class="fa fa-times" aria-hidden="true"></i> Eliminar</button></td>';
        html += '</tr>';
        return html;
    }
    function tipoesequipamientos()
    {
        $.ajax({
            url: 'tipoesequipamientos',
            async: false,
            dataType: 'json',
            success: function (data)
            {
                $('#new_equipamento').after(div(data));
            }
        })
    }
    function validarCorregimientos()
    {
        if ($('#id_corregimiento').val() == '')
        {
            $('#hide_divs').show();
            $('#id_vereda').html('');
        } else
        {
            $('#hide_divs').hide();
            veredas();
        }
    }
    function Corregimientos()
    {
        $('#id_corregimiento').change(function ()
        {
            validarCorregimientos();
        });
    }
    function veredas()
    {
        $.ajax({
            url: base + '/veredas/corregimiento/' + $('#id_corregimiento').val(),
            dataType: 'json',
            async: false,
            success: function (data)
            {
                var html = '';
                $.each(data, function (index, value)
                {
                    html += '<option value="' + value.id + '">' + value.nombre + '</option>';
                });
                $('#id_vereda').html(html);
            }
        });
    }
    function ValidarEscenarios(data)
    {
        $('#descripcion').val(data.escenario.descripcion);
        $('#direccion').val(data.escenario.direccion);
        $('#direccion_complemento').val(data.escenario.direccion_complemento);
        $('#id').val(data.escenario.id);
        $('#id_barrio').val(data.escenario.id_barrio);
        $('#id_corregimiento').val(data.escenario.id_corregimiento);
        $('#nombre_escenario').val(data.escenario.nombre_escenario);
        $('#tipoescenario_id').val(data.escenario.tipoescenario_id);
        if ($('#id_corregimiento').val() != '')
        {
            veredas();
            $('#id_vereda').val(data.escenario.id_vereda);
            validarCorregimientos();
        }
    }
    function ValidarEquipamientos(equipamiento)
    {
        for (var i = 0; i < equipamiento.length; i++)
        {
            tipoesequipamientos();
        }
        $.each($('.data_equipamiento'), function (index, value)
        {
            var tempid = ($(value).attr('id'));
            $('#' + tempid + ' select').val(equipamiento[index].id_equipamiento);
            $('#' + tempid + ' input').val(equipamiento[index].cantidad);
        });
    }
    function insert_data(data)
    {

        ValidarEscenarios(data);
        ValidarEquipamientos(data.equipamiento);
    }