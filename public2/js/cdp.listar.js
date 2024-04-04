$(function() {
    CargarRegistro();
});

function Eliminar(id) {
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
        function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: base + '/Horario/eliminar/' + id,
                    dataType: 'JSON',
                }).success(function(response) {
                    swal("Eliminado!", "Registro Eliminado.", "success");
                    CargarRegistro();
                });
            } else {
                swal("Cancelado", "No elimino su registro", "error");
            }
        });
}

function Guardar(id) {
    alert(id);
}

function CargarRegistro() {
    var table = $("#table_hoja_vida").DataTable({
        destroy: true,
        //paging: false,
        language: {
            url: base + "/js/languages/datatable.Spanish.json"
        },
        ajax: base + '/cdp/data_contratos',
        //pageLength:$('#pagination_value').val(),
        "columns": [{
                data: 'id',
                "title": "Opciones",
                render: function(id) {
                    var html =  '<button role="group" type="button" id="editar_' + id + '" onclick="editar_cdp(' + id + ')" class="btn btn-primary"><i class="fa fa-wrench"></i> Editar</button>'+
                                '<button type="button"  role="group"id="cancel_' + id + '" class="hide btn btn-primary" onclick="cancelar('+id+')"><i class="glyphicon glyphicon-remove"></i> cancelar</button>';
                    return html;
                }
            },
            {
                data: 'documento',
                "title": "Documento",
                render: function(value, display, data) 
                {
                    return value;
                }
            },
            {
                data: 'nombres',
                "title": "Nombre",
            },
            {
                data: 'contrato_numero',
                "title": "Contrato numero",
                render: function(value, display, data) {
                    var html = '<span class="value_edit_' + data.id + '" id="value_contrato_numero_' + data.id + '">' + value + '</span><input type="number" min="1" id="contrato_numero_' + data.id + '" class="hide form form-control" value="' + value + '">';
                    return html;
                }
            },
            {
                data: 'rcp',
                "title": "RPC",
                render: function(value, display, data) {
                    var html = '<span class="value_edit_' + data.id + '" id="value_rcp_' + data.id + '">' + value + '</span><input type="text" id="rcp_' + data.id + '" class="hide form form-control" value="' + value + '">';
                    return html;
                }
            },
            {
                data: 'dcp',
                "title": "CDP",
                render: function(value, display, data) {
                    var html = '<span class="value_edit_' + data.id + '" id="value_dcp_' + data.id + '">' + value + '</span><input type="text" id="dcp_' + data.id + '" class="hide form form-control" value="' + value + '">';
                    return html;
                }
            },
            {
                data: 'contrato_valor',
                "title": "Valor contrato",
                render: function(value, display, data) {
                    var html = '<span class="value_edit_' + data.id + '" id="value_contrato_valor_' + data.id + '">' + value + '</span><input type="text" id="contrato_valor_' + data.id + '" class="hide form form-control only_number" value="' + value + '">';
                    return html;
                }
            },
            {
                data: 'cuotas',
                "title": "Cuotas",
                render: function(value, display, data) {
                    var html = '<span class="value_edit_' + data.id + '" id="value_cuotas_' + data.id + '">' + value + '</span><input type="number" min="1"  id="cuotas_' + data.id + '" class="hide only_number form form-control" value="' + value + '">';
                    return html;
                }
            },
            {
                data: 'fecha_inicio',
                "title": "Fecha inicio",
                render: function(value, display, data) {
                    var html = '<span class="value_edit_' + data.id + '" id="value_fecha_inicio_' + data.id + '">' + value + '</span><input type="date" id="fecha_inicio_' + data.id + '" class="fecha hide form form-control" value="' + value + '">';
                    return html;
                }
            },
            {
                data: 'fecha_terminacion',
                "title": "Fecha terminacion",
                render: function(value, display, data) {
                    var html = '<span class="spanid value_edit_' + data.id + '" id="value_fecha_terminacion_' + data.id + '">' + value + '</span><input type="date" id="fecha_terminacion_' + data.id + '" class="fecha hide form form-control" value="' + value + '">';
                    return html;
                }
            },
            {
                data: 'fecha_plazo_ejecucion',
                "title": "Plazo de ejecicion",
                render: function(value, display, data) {
                    var html = '<span class="spanid value_edit_' + data.id + '" id="value_fecha_plazo_ejecucion_' + data.id + '">' + value + '</span><input type="date" id="fecha_plazo_ejecucion_' + data.id + '" class="fecha hide form form-control" value="' + value + '">';
                    return html;
                }
            },

            {
                data: 'contrato_objeto',
                "title": "Objeto contrato",
                render: function(value, display, data) {
                    var html = '<span class="value_edit_' + data.id + '" id="value_contrato_objeto_' + data.id + '">' + value + '</span><textarea row="4" id="contrato_objeto_' + data.id + '" class="hide form form-control" style="margin: 0px;min-width: 480px;min-height: 231px;">' + value + '</textarea>';
                    return html;
                }
            }
        ],
        drawCallback: function(response) {
            var info = table.page.info();
            $('.count_datatable').html(info.recordsTotal);
        }

    });
    $('.dataTables_info').hide();
    $('.search_value').on('keyup', function() {});
    $('.pagination_value').change(function() {
        table.page.length($('.pagination_value').val()).draw();
    });
}

function guardar_cdp(id) {
    swal({
            title: "¿Va a modificar información importante?",
            text: "Va a alterar la información de contratación de este empleado",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Si lo edito",
            cancelButtonText: "No lo edito",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function(isConfirm) {
            if (isConfirm) {
                var data = {
                    id: id,
                    rcp: $('#rcp_' + id).val(),
                    dcp: $('#dcp_' + id).val(),
                    contrato_valor: $('#contrato_valor_' + id).val(),
                    contrato_objeto: $('#contrato_objeto_' + id).val(),
                    cuotas: $('#cuotas_' + id).val(),
                    fecha_inicio: $('#fecha_inicio_' + id).val(),
                    fecha_terminacion: $('#fecha_terminacion_' + id).val(),
                    contrato_numero: $('#contrato_numero_' + id).val(),
                    fecha_plazo_ejecucion: $('#fecha_plazo_ejecucion_' + id).val()
                };
                $.ajax({
                    url: base + '/cdp/editar_empleado',
                    data: data,
                    dataType: 'JSON',
                    type: 'POST',
                }).success(function(response) {
                    console.log(response);
                    swal("Editado", "Empleado editado.", "success");
                    $('#contrato_numero_' + id + ',#rcp_' + id + ',#dcp_' + id + ',#contrato_valor_' + id + ',#contrato_objeto_' + id + ',#cuotas_' +
                        id + ',#fecha_inicio_' + id + ',#fecha_terminacion_' + id+',#fecha_plazo_ejecucion_' + id).addClass('hide');
                    $('#editar_' + id).removeClass('btn-danger');
                    $('#editar_' + id).addClass('btn-primary');
                    $('#editar_' + id).html('<i class="fa fa-wrench"></i> Editar');
                    $('#editar_' + id).removeAttr('onclick');
                    $('#editar_' + id).attr('onclick', 'editar_cdp(' + id + ')');

                    $('#rcp_' + id).val(data.rcp);
                    $('#dcp_' + id).val(data.dcp);
                    $('#contrato_valor_' + id).val(data.contrato_valor);
                    $('#contrato_objeto_' + id).val(data.contrato_objeto);
                    $('#contrato_numero_' + id).val(data.contrato_numero);
                    $('#cuotas_' + id).val(data.cuotas);
                    $('#fecha_inicio_' + id).val(data.fecha_inicio);
                    $('#fecha_terminacion_' + id).val(data.fecha_terminacion);

                    $('#contrato_numero_' + id).html(data.contrato_numero);
                    $('#value_rcp_' + id).html(data.rcp);
                    $('#value_dcp_' + id).html(data.dcp);
                    $('#value_contrato_valor_' + id).html(data.contrato_valor);
                    $('#value_contrato_objeto_' + id).html(data.contrato_objeto);
                    $('#value_contrato_numero_' + id).html(data.contrato_numero);
                    $('#value_cuotas_' + id).html(data.cuotas);
                    $('#value_fecha_inicio_' + id).html(data.fecha_inicio);
                    $('#value_fecha_terminacion_' + id).html(data.fecha_terminacion);
                    $('.value_edit_' + id).show();
                    $('#cancel_' + id).hide();
                });
            } else {
                swal("Cancelado", "No elimino su registro", "error");
                cancelar(id);
            }
        });
}

function cancelar(id) {
    var inputs = '#cancel_' + id +
        ',#contrato_numero_' + id +
        ',#rcp_' + id + ',#dcp_' + id +
        ',#contrato_valor_' + id +
        ',#contrato_objeto_' + id +
        ',#cuotas_' + id + ',#fecha_inicio_' + id +
        ',#fecha_terminacion_' + id;
    $(inputs).addClass('hide');

    $('#editar_' + id).removeClass('btn-danger');
    $('#editar_' + id).addClass('btn-primary');
    $('#editar_' + id).html('<i class="fa fa-wrench"></i> Editar');
    $('#editar_' + id).removeAttr('onclick');
    $('#editar_' + id).attr('onclick', 'editar_cdp(' + id + ')');
    $('.value_edit_' + id).show();

    $('#contrato_numero_' + id).val($('#value_contrato_numero_'+id).html());
    $('#rcp_' + id).val($('#value_rcp_'+id).html());
    $('#dcp_' + id).val($('#value_dcp_'+id).html());
    $('#contrato_valor_' + id).val($('#value_contrato_valor_'+id).html());
    $('#contrato_objeto_' + id).val($('#value_contrato_objeto_'+id).html());
    $('#cuotas_' + id).val($('#value_cuotas_'+id).html());
    $('#fecha_inicio_' + id).val($('#value_fecha_inicio_'+id).html());
    $('#fecha_terminacion_' + id).val($('#value_fecha_terminacion_'+id).html());
}

function editar_cdp(id) 
{    
    $('#cancel_' + id + ',#contrato_numero_' + id + ',#rcp_' + id + ',#dcp_' + id + ',#contrato_valor_' + id + ',#contrato_objeto_' + id + ',#cuotas_' + id + ',#fecha_inicio_' + id + ',#fecha_terminacion_' + id+',#fecha_plazo_ejecucion_' + id).removeClass('hide');
    $('#editar_' + id).removeClass('btn-primary');
    $('#editar_' + id).addClass('btn-danger');
    $('#editar_' + id).html('<i class="fa fa-save"></i> Guardar');
    $('#editar_' + id).removeAttr('onclick');
    $('#editar_' + id).attr('onclick', 'guardar_cdp(' + id + ')');
    $('.value_edit_' + id).hide();
    $('.fecha').datepicker({
        dateFormat: 'yy-mm-dd'
    });
    $('.only_number').inputmask({alias: 'decimal', rightAlign: true, groupSeparator: ',', digits: 0, autoGroup: true});
}
$(window).load(function() {});