$(document).ready(function(){
    var tablaDatos = $("#datos");
    var route = base + '/usuarios/listar';
    /*$("#example-export").empty();*/
    $.get(route, function(res){
            $(res).each(function(key, value){
            tablaDatos.append("<tr><td>"+value.roles+"</td><td>"+value.name+" "+value.apellidos+"</td><td>"+value.email+"</td><td>"+value.telefono+"</td><td>"+value.direccion+"</td><td><button class='btn btn-success' value='"+value.id+"' type'button'>Ver</button></td></tr>");
        });
    });
});

/*<button class='btn-success' value='"+value.id+"' type'button'</button>*/
$(document).on('click', '.btn-success', function(e){
    var id = $(this).val();
    $.ajax({
        url: base + '/usuarios/detalle/' + id,
        type: 'POST',
        dataType: 'JSON',

    }).success(function(e){

        var tabla = $('#frm-update');
        var imagen = $('#imagen');
        var botonEditar = $('#botones');
        var botonCerar = $(".modal-footer");
        tabla.empty();
        imagen.empty();
        botonEditar.empty();
        botonCerar.empty();
        var frmupdate = $('#frm-update');
        frmupdate.find('#name').val(e.usuarios.name);
        imagen.append('<img alt="User Pic" src="/'+e.usuarios.foto+'" class="img-circle img-responsive">')
        tabla.append('<tr><td>Nombre</td><td>'+e.usuarios.name+'</td></tr>');
        tabla.append('<tr><td>Apellidos</td><td>'+e.usuarios.apellidos+'</td></tr>');
        tabla.append('<tr><td>Dni</td><td>'+e.usuarios.cedula+'</td></tr>');
        tabla.append('<tr><td>Email</td><td>'+e.usuarios.email+'</td></tr>');
        tabla.append('<tr><td>Dirección</td><td>'+e.usuarios.direccion+'</td></tr>');
        tabla.append('<tr><td>Telefono</td><td>'+e.usuarios.telefono+'</td></tr>');
        tabla.append('<tr><td>Rol</td><td>'+e.usuarios.roles+'</td></tr>');
        botonEditar.append('<button class="btn btn-sm btn-warning" value="'+e.usuarios.id+'" type"button"><i class="glyphicon glyphicon-edit"></i></button>');
        botonEditar.append('<button class="btn btn-sm btn-danger" id="eliminacion" value="'+e.usuarios.id+'" type"button"><i class="glyphicon glyphicon-remove"></i></button>');
        botonCerar.append('<button type="button" class="btn btn-default" value="'+e.usuarios.id+'" id="cerrar" data-dismiss="modal">Cerrar</button>');




        $('#popup-update').modal('show');

    })
    .done(function() {
        console.log("success");
    })
    .fail(function() {
        console.log("error");
    })
    .always(function() {
        console.log("complete");
    });

});


$(document).on('click', '#eliminacion', function(e){

var id = $(this).val();
swal({
  title: "Eliminar registro?",
  text: "Realmente deseas eliminar este registro!",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Si, Eliminalo!",
  closeOnConfirm: false
},
function(){

$.ajax({
    url: base + '/usuario/eliminar/' + id,
    type: 'POST',
    dataType: 'JSON',

}).success(function(){
  carga();
  swal("Eliminado!", "Su Dato ha sido eliminado.", "success");
  $('#popup-update').modal('hide');
})
.done(function() {
    console.log("success");
})
.fail(function() {
    console.log("error");
})
.always(function() {
    console.log("complete");
});


});

});






$(document).on('click', '.btn-warning', function(e){
var id = $(this).val();
var tabla = $('#frm-update');
var imagen = $('#imagen');


imagen.empty();
tabla.empty();
    if(id == id){
    $("#div1").css("display", "block");
    $(".panel-footer").css("display", "none");
    $("#Actualizar").css("display", "block");


     }else{
    $("#div1").css("display", "none");
    $(".panel-footer").css("display", "block");

    }

    $.ajax({
        url: base + '/usuarios/detalle/' + id,
        type: 'POST',
        dataType: 'JSON',

    }).success(function(e){
        var tabla = $('#userForm');
        var imagen = $('#imagen');
        var botonEditar = $('#botones');
        var botonCerar = $(".modal-footer");
        var botonActualizar = $("#Actualizar");

        imagen.empty();
        botonEditar.empty();
        botonCerar.empty();


var rol = $('#rol').empty();
var nombres_input = $('#nombres_input').empty();
var apellidos_input = $('#apellidos_input').empty();
var cedula_input = $('#cedula_input').empty();
var email_input = $('#email_input').empty();
var direccion_input = $('#direccion_input').empty();
var telefono_input = $('#telefono_input').empty();
var password_input = $('#password_input').empty();
var btn_actualizar = $("#btn_actualizar").empty();

$.each(e.roles, function(index, val) {

console.log(val);
var data_area = '<option value="'+val.id+'">' + val.name + '</option>';
    rol.append(data_area);

});
        var frmupdate = $('#frm-update');
        frmupdate.find('#name').val(e.usuarios.name);

        $('#nombres_input').append('<input type="text" name="nombres" value="'+e.usuarios.name+'" class="form-control" />');
        $('#apellidos_input').append('<input type="text" name="apellidos" value="'+e.usuarios.apellidos+'" class="form-control" />');
        $('#cedula_input').append('<input type="text" name="cedula" value="'+e.usuarios.cedula+'" class="form-control" />');
        $('#email_input').append('<input type="email" name="email" value="'+e.usuarios.email+'" class="form-control" />');
        $('#direccion_input').append('<input type="text" name="direccion" value="'+e.usuarios.direccion+'" class="form-control" />');
        $('#telefono_input').append('<input type="text" name="telefono" value="'+e.usuarios.telefono+'" class="form-control" />');
        $('#password_input').append('<input type="password" name="contraseña" class="form-control" />');
        botonCerar.append('<button type="button" class="btn btn-default" value="'+e.usuarios.id+'" id="cerrar" data-dismiss="modal">Cerrar</button>');
        $("#btn_actualizar").append('<button type="button" id="actualizar" class="btn btn-primary" value="'+e.usuarios.id+'">Actualizar</button>');
        var data_area = '<option value="'+e.usuarios.rol_id+'">' + e.usuarios.roles + '</option>';
        rol.append(data_area);
        $('#popup-update').modal('show');

    })
    .done(function() {
        console.log("success");
    })
    .fail(function() {
        console.log("error");
    })
    .always(function() {
        console.log("complete");
    });

});

$(document).on('click', '#cerrar', function(e){
var id = $(this).val();
    if(id == id){
    $("#div1").css("display", "none");
    $(".panel-footer").css("display", "block");
   }

});

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


$(document).on('click', '#actualizar', function(e){
var id = $(this).val();

var formData = new FormData($('.form-modal2')[0]);

$.ajax({
    url: base + '/usuarios/actualizar/' + id,
    type: 'POST',
    dataType: 'JSON',
    data: formData,
   //necesario para subir archivos via ajax
    cache: false,
    contentType: false,
    processData: false,
    success:function(){
    carga();
    $("#msj-success").fadeIn();
    toastr.success("Su registro ha sido exitoso", "Registro Actualizado");
    },
})



});






