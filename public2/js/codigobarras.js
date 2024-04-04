var myFunction = function(boton){
var codigo = $("#product_code").val();
JsBarcode("#barcode", codigo);
var imprimir = $("#imprimir");
imprimir.empty();
imprimir.append('<a class="btn btn-primary" href="codigobarras/pdf/'+codigo+'">Imprimir</a>')

 }
