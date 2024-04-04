$(document).ready(function(){

    var tablaDatos = $("#datos");
    var route = base + '/cuentaxcobraras';
    /*$("#example-export").empty();*/
    $.get(route, function(res){
        $(res).each(function(key, value){
            tablaDatos.append("<tr><td>"+value.no_factura+"</td><td><a onclick='mostrar("+value.id_cuenta_cobrar+")' href='/cuentaxcobrar/detalles/"+value.id_cuenta_cobrar+"'>"+value.name+"</a></td><td>"+value.no_cuotas+"</td><td>"+value.No_cuota_final+"</td><td>"+value.abono+"</td><td>"+value.debe+"</td><td>"+value.created_at+"</td></tr>");
        });
    });
});

var mostrar = function(element){

    var tabla = $("#detalles").empty();
    var route = base + '/cuentaxcobrar/detalles2/' + element;
    $.get(route, function(res){
        tabla.append("<a>"+res.name+"</a>");

        });

}

jQuery(document).ready(function ($) {
    $('#myform').validate({
        rules: {


            nombre: { required: true, minlength: 2}

        },
         messages: {


            nombre: "Debe introducir nombre del proveedor.",

        },
        submitHandler: function (form) {

             var formData = $("#myform").serialize();
            $.ajax({
                url: base + '/cuentaxcobrar/abono',
                type: 'POST',
                dataType: 'JSON',
                data: formData,
                success: function (data) {
                $("#msj-success").fadeIn();
                swal("Felicidades!", "Abono realizado con exito!", "success")
                location.reload(true);
                return false;
                },
                error: function (data) {
                $("#msj-success").fadeIn();
                toastr.error(data.responseText, "Error Registro.");
                },
            });

        }
    });
});