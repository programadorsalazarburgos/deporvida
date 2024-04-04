$(document).ready(function() {
    $("#ok").hide();
    $("#f1").validate({
        rules: {
            codigo: { required: true, minlength: 2},
            nombre : { required: true, minlength: 2},
            costo : { required: true, minlength: 2},
            utilidad : { required: true, minlength: 2},
            stock_inicial : { required: true, minlength: 2}
           /*
            years: { required: true},
            */
        },
        messages: {
            codigo: "Debe introducir codigo del producto.",
            nombre: "Debe introducir nombre del producto.",
            costo: "Debe introducir costo.",
            utilidad: "Debe introducir utilidad.",
            stock_inicial: "Debe introducir Stock.",


        },

        submitHandler: function(form){

        var costo1 = document.f1.costo.value;
        var stock_inicial1 = document.f1.stock.value;
        var venta_total = (parseFloat(costo1)*parseFloat(stock_inicial1));
        var formData = new FormData($(".form-horizontal")[0]);
        formData.append('total_venta', venta_total);
        var selectedFile = ($("#imagen"))[0].files[0];//FileControl.files[0];
        var imagen = selectedFile.name;


            $.ajax({
            url: base + '/productos/crearproducto',
            type: 'POST',
            // Form data
            //datos del formulario
            data: formData,
            //necesario para subir archivos via ajax
            cache: false,
            contentType: false,
            processData: false,

                success:function(){
                $("#msj-success").fadeIn();
                toastr.success("Su registro ha sido exitoso", "Registro Producto");
/*                setTimeout('document.f1.reset()',3000);
                return false;
*/
                },

                error:function(data){

                $("#msj-success").fadeIn();
                toastr.error(data.responseText, "Error Registro.");


                },



            });
             }
    });
});

jQuery(document).ready(function(){
            jQuery("#f1").validationEngine({

            });
        });

    $(".messages").hide();
    //queremos que esta variable sea global
    var fileExtension = "";
    //función que observa los cambios del campo file y obtiene información
    $(':file').change(function()
    {
        //obtenemos un array con los datos del archivo
        var file = $("#imagen")[0].files[0];
        //obtenemos el nombre del archivo
        var fileName = file.name;
        //obtenemos la extensión del archivo
        fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
        //obtenemos el tamaño del archivo
        var fileSize = file.size;
        //obtenemos el tipo de archivo image/png ejemplo
        var fileType = file.type;
        //mensaje con la información del archivo
        showMessage("<span class='info'>Archivo para subir: "+fileName+", peso total: "+fileSize+" bytes.</span>");
    });


function showMessage(message){
    $(".messages").html("").show();
    $(".messages").html(message);
}

//comprobamos si el archivo a subir es una imagen
//para visualizarla una vez haya subido
function isImage(extension)
{
    switch(extension.toLowerCase())
    {
        case 'jpg': case 'gif': case 'png': case 'jpeg':
            return true;
        break;
        default:
            return false;
        break;
    }
}




