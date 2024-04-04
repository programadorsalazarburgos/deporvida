$( document ).ready(function() {
    $(":checkbox").click(obtenerID);

function obtenerID() {
  var nombre = $(this).attr("id");
   if(nombre == 'checkbox5'){

    if ($(this).is(':checked')) {

             document.getElementById("otro").disabled = false;

    }else{

             document.getElementById("otro").disabled = true;
    }
  }
}
});
