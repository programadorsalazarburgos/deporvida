document.getElementById('medico').addEventListener('change', function(){
    variable = this.value;


    $.ajax({
        url: base + '/api/v13/medicoagenda/obtenernolaborales',
        type: 'POST',
        dataType: 'JSON',
        data: {variable: variable},

    }).success(function(data){

    var botonEliminar = $('#btn5');
    var data_eliminar = '<td><button name="btn2" class="btn btn-danger" onclick="eliminarAll()"><i class="fa fa-bitbucket"></i></button>'
       data_eliminar += '</td>'
    botonEliminar.append(data_eliminar);

    var laborales = $('#laborales').empty();
    $.each(data, function(index, val) {
    var data_laborales ='<tr id="tableid-'+val.id+'"><td id="datos-'+val.id+'"><input type="checkbox" value="'+ val.id +'" name="foo" id="select"  onclick="seleccionado(this)"/></td>'
        data_laborales += '<td style="text-align:center">'+ val.fecha_nolaboral + '</td>'
        data_laborales += '<td style="text-align:center"><a class="btn btn-danger"  onclick="eliminarnolaboral('  + val.id + ')"><i class="fa fa-bitbucket"></i></a></td>'
        data_laborales += '</tr>'
        laborales.append(data_laborales);
    });
  });


});
function eliminarnolaboral(id) {
swal({
  title: "Eliminar Registro?",
  text: "Realmente desea eliminar este registro",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Si, Eliminar!",
  cancelButtonText: "No, cancelar!",
  closeOnConfirm: false,
  closeOnCancel: false
},
function(isConfirm){
  if (isConfirm) {
        $.ajax({
          url: base + '/api/v13/medicoagenda/eliminarnolaborales',
          type: 'POST',
          dataType: 'JSON',
          data: {variable: id},
        }).success(function(data){
            $.each(data, function(index, val) {
            var varir =  $("#tableid-" +id);
            varir.remove();
            });
          });
    swal("Eliminado!", "Su registro ha sido eliminado.", "success");

  } else {
    swal("Cancelado", "Su registro no ha sido eliminado :)", "error");
  }
});
}

var guardarAgenda = function()
{

var dia = $("#dia").val();

$.ajax({
  url: base + '/api/v13/medicoagenda/crearnolaborales',
  type: 'POST',
  dataType: 'JSON',
  data: {param1: variable, param2: dia },
}).success(function(data){
    var laborales2 = $('#laborales');
    var data_laborales ='<tr id="tableid-'+data.id+'"><td>' + data.fecha_nolaboral + '</td>'
        data_laborales += '<td style="text-align:center"><button class="btn btn-danger"  onclick="eliminarnolaboral('  + data.id + ')"><i class="fa fa-bitbucket"></i></button> </td>'
        data_laborales += '</tr>'
        console.log(data_laborales);
        laborales2  .append(data_laborales);

});
}

var eliminarAllnolaboral = function()
{

alert(222);
}



function toggle(source) {
  checkboxes = document.getElementsByName('foo');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}


var seleccionado = function(source)
{

/*var checkbox = document.getElementById("select");
checkbox.addEventListener('change', function(e){
    if (e.target.checked == true) {
        alert("Gracias por estar en nuestro boletin");
    }else{
        alert("lamentamos tu desicion");
    }
});

*/



}


var eliminarAll = function()
{

var self = this;
    self.ready = false;
    self.data = [];


$("input[type=checkbox]:checked").each(function(){
  var datos =  $(this).serializeArray();


  $.ajax({
    url: base + '/api/v13/medicoagenda/eliminarnolaboralesAll',
    type: 'POST',
    dataType: 'JSON',
    data:  { param1 : datos },
    async:false,
  }).success(function(data){
    console.log(data);
    alert("eliminado");

  })
  .done(function() {
    console.log("success");
  });

});
}




