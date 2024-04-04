var direcciones = {
    direccion: '',
    direccion_observacion: '',
    modal: '',
    iframe: ''
};
function url(data)
{
    var res = base + '/dir_generator/diradd.php?';
    $.each(data, function (index, value)
    {
        res = res + index + '=' + value + '&';
    });
    return res;
}
function GeneratorAdd()
{
    $('#' + direcciones.modal).modal('show');
    var configuracion = {
        fieldNamecallbackFunction: 'cerrarModal', //Nombre de la función global  llamada al cerrar el modal
        fieldNameNPNrequerido: 0, //Indica si es requerido el NPN
        activarBusqueda: 1, //1 para activar búsqueda, 0 para inhabilitarla y colocar una dirección nueva
        fieldNameDiv: "modalIngresoDireccion", //Id del div donde se colocará el modal
        fieldNameDireccion: direcciones.direccion, //Id del input donde se colocará la dirección estándar
        fieldNameDireccionAdicional: direcciones.direccion_observacion, //Id del input donde se colocará la información adicional de la dirección como apartamento, local, casa, ...
    };
    $('#' + direcciones.iframe).attr('src', (url(configuracion)));
}
function cerrarModal()
{
    var direccion = $('#' + direcciones.iframe).contents().find("#hiden_direccion");
    var direccion_observacion = $('#' + direcciones.iframe).contents().find("#hiden_direccion_observacion");
    $('#' + direcciones.direccion).val(direccion.val());
    $('#' + direcciones.direccion_observacion).val(direccion_observacion.val());
    $('#' + direcciones.modal).modal('hide');
}
$(function ()
{
    $.fn.extend({
        add_generator: function (data)
        {
            direcciones.modal = 'MyModal_dir';
            direcciones.iframe = 'iframe_dir';
            direcciones.direccion = data.direccion;
            direcciones.direccion_observacion = data.complemento;
            $('#' + direcciones.direccion + ',#' + direcciones.direccion_observacion).attr('style', 'background-color: #FFF;cursor: pointer;');
            $('#' + direcciones.direccion + ',#' + direcciones.direccion_observacion).attr('readonly', 'true');
            $('body').append('<div class="modal fade" id="' + direcciones.modal + '" tabindex="-1" role="dialog" aria-labelledby="' + direcciones.modal + '">\n\
            <div class="modal-dialog" role="document"><div class="modal-content">\n\
            <div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>\n\
            <h4 class="modal-title" id="exampleModalLabel"><span style="color:#FFF">Generador de direcciones</span></h4>\n\
            </div><div class="modal-body"><div class="container-fluid">\n\
            <center><iframe scrolling="no" id="' + direcciones.iframe + '" style="width: 550px;height: 410px; border:none;" src=""></iframe></center>\n\
            </div></div><div class="modal-footer">\n\
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>\n\
            </div></div></div></div>');
            $(this).click(function ()
            {
                GeneratorAdd();
            });
        }
    });
});