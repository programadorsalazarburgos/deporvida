$(document).on('click', '#guardar', function(e){
        if( $("#roles").val() == 0){
            $("#roles").focus().after("<span class='error' style='color:red;'>Dato requerido</span>");
            return false;

    } else if( $("#contraseña1").val() == 0){
            $("#contraseña1").focus().after("<span class='error2' style='color:red;'>Dato requerido</span>");
            return false;
    }
function carga(){
    var tablaDatos = $("#datos");
    var route = base + '/usuarios/listar';
    $("#datos").empty();
    $.get(route, function(res){
            $(res).each(function(key, value){
            tablaDatos.append("<tr><td>"+value.roles+"</td><td>"+value.name+" "+value.apellidos+"</td><td>"+value.email+"</td><td>"+value.telefono+"</td><td>"+value.direccion+"</td><td><button class='btn btn-success' value='"+value.id+"' type'button'>Ver</button></td></tr>");
        });
    });
}




var formData = new FormData($(".form-modal")[0]);
            $.ajax({
            url: base + '/usuarios/creacion',
            type: 'POST',
            // Form data
            //datos del formulario
            data: formData,
            //necesario para subir archivos via ajax
            cache: false,
            contentType: false,
            processData: false,

                success:function(){
                carga();
                $("#msj-success").fadeIn();
                toastr.success("Su registro ha sido exitoso", "Registro Usuario");
/*                setTimeout('document.f1.reset()',3000);
                return false;
*/
                },


});






});