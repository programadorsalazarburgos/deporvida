<invoice>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel" style="color: #efefef;">Crear Cliente</h4>
      </div>

<div class="modal-body">


<!--formulario modal -->
<form method="POST" id="clienteForm" name="clienteForm">
<input name="_token" type="hidden" value="4BRX8b03ycb7AU4J0iCCXhSWFfxaMC6ugZ19oy75">


    <div class="form-group">
        <label for="email" class="control-label">Nombre Cliente:</label>
        <input class="form-control" name="nombre" type="text" id="nombre" data-rule="required|nombre">
    </div>

<div class="form-group">
        <label for="email" class="control-label">Cedula:</label>
        <input class="form-control" name="cedula" type="text" id="cedula">
    </div>


<div class="form-group">
        <label for="email" class="control-label">Dirección:</label>
        <input class="form-control" name="direccion" type="text" id="direccion">
    </div>


      </div>
      <div class="modal-footer">
        <button onclick="{ __agergarCliente }" type="button" class="btn btn-primary">Guardar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
     </form>
    </div>
  </div>
</div>



<div class="well well-sm">
        <div class="row">
            <div class="col-xs-4">
                <input id="client" class="form-control" type="text" placeholder="cliente" />
            </div>

             <div class="col-xs-1">
                <button type="button" class="btn btn-primary form-control" data-toggle="modal" data-target="#myModal">
                  <i class="glyphicon glyphicon-user"></i>
                </button>
            </div>

            <div class="col-xs-2">
                <input class="form-control" type="text" placeholder="Cedula" readonly value="{ruc}" />
            </div>
            <div class="col-xs-4">
                <input class="form-control" type="text" placeholder="Direccion" readonly value="{address}" />
            </div>
        </div>
</div>

<div class="row">
    <div class="col-xs-7">
        <input id="product" class="form-control" type="text" placeholder="nombre del producto" />
    </div>
    <div class="col-xs-2">
        <input id="cantidad"  class="form-control" type="text" placeholder="cantidad" />
    </div>
    <div class="col-xs-2">
        <div class="input-group">
           <select class="form-control" id="precio">
              <option value="{precio_producto_unidad}">{precio_producto_unidad} Unidad</option>
              <option value="{precio_producto_volumen}">{precio_producto_volumen} Volumen</option>
            </select>
       </div>
    </div>


    <div class="col-xs-1">
        <button onclick="{ __addProductoToDetail }" class="btn btn-primary form-control" id="btn-agregar">
            <i class="glyphicon glyphicon-plus"></i>
        </button>
    </div>
</div>

<hr />


  <div id="table-advanced" class="row">
    <div class="col-lg-12">
     <ul id="tableadvancedTab" class="nav nav-tabs">
       <li class="active"><a href="#table-sorter-tab" data-toggle="tab">Info</a></li>
     </ul>
<div id="tableadvancedTabContent" class="tab-content">
   <div id="table-sorter-tab" class="tab-pane fade in active">
     <div class="row">
      <div class="col-lg-12"><h3 class="mtn">Información Ventas</h3>
        <table class="table table-hover table-striped table-bordered table-advanced tablesorter">
          <thead>
           <tr>
             <th style="width: 40px;"></th>
             <th>Producto</th>
             <th style="width: 100px;">Cantidad</th>
             <th style="width: 100px;">P.U</th>
             <th style="width: 100px;">Total</th>
           </tr>
          </thead>
           <tbody>
             <tr each={detail}>
              <td>
               <button onclick={__removeProductFromDetail} class="btn btn-danger btn-xs btn-block">X</button>
              </td>
                <td>{name}</td>
                <td class="text-right">{cantidad}</td>
                <td class="text-right">$ {precio}</td>
                <td class="text-right">$ {total}</td>
             </tr>
           </tbody>
              <tfoot>
                <tr>
                 <td colspan="4" class="text-right"><b>IVA</b></td>
                 <td class="text-right">$ {iva.toFixed(2)}</td>
                </tr>
                <tr>
                <td colspan="4" class="text-right"><b>Sub Total</b></td>
                <td class="text-right">$ {subTotal.toFixed(2)}</td>
            </tr>
            <tr>
                <td colspan="4" class="text-right"><b>sTotal</b></td>
                <td class="text-right">$ {total.toFixed(2)}</td>
            </tr>
        </tfoot>
       </table>

   <div class="col-xs-2">
      <button type="button" class="btn btn-success form-control" data-toggle="modal" data-target="#myModal2"><i class="fa fa-dollar"></i> Tipo de Pago
      </button>
              </div>
            </div>
          </div>
         </div>
        </div>
      </div>
    </div>


<!-- Modal -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">

<div class="card wizard-card ct-wizard-orange" id="wizardProfile">
  <form method="POST" id="myform" name="myform" class="form-modal" enctype="multipart/form-data">
    <input name="_token" type="hidden" value="4BRX8b03ycb7AU4J0iCCXhSWFfxaMC6ugZ19oy75">
      <div class="wizard-header">
        <h3>
         <b>TIPO</b>&nbsp;DE PAGO<br>
     <small>Seleccione tipo de pago.</small>
        </h3>
</div>
<div class="tab-content">
  <div class="row">
    <div class="col-sm-5 col-sm-offset-0">
      <div class="picture-container">
       <div class="picture">
        <img src="/assets/img/pago.png" class="picture-src" id="wizardPicturePreview"  width="150" height="150" title=""/>
        <div class="container">
          <div class="col-md-1">
            <label class="radio-inline">
              <input name="pago1" class="pago" type="radio">Credito
            </label>
          </div>
         <div class="col-md-2">
           <label class="radio-inline">
            <input class="pago" name="pago1" type="radio" value="Deposito">Contado
        </label>
       </div>
     </div>
    </div>
  </div>
</div>
<!--formulario modal -->
<div id="div1" style="display:none;">
<h3>{ title }</h3>
<h1 class="text-right" id="total">$ {total.toFixed(2)}</h1>
<p class="text-right" id="total" style="display:none;">$ {total.toFixed(2)}</p>
  <div class="col-sm-6">
      <div class="form-group">
        <label>Paga con</label>
        <input name="paga_con2" class="form-control" onkeyup={ keyup3 }>
      </div>
      <div class="form-group">
        <label>Devolución</label>
      <p  id="devolucion2" name="cambio" class="form-control" placeholder="debe"><raw content="{ html }"/> </p>
   </div>
  </div>
 </div>
<div id="div2" style="display:none;">
<h3>{ title }</h3>
<h1 class="text-right" id="total">$ {total.toFixed(2)}</h1>
<div id="divTxt2"></div>
  <div class="col-sm-6">
      <div class="form-group">
                <label for="male">No de Cuotas</label>
                <input id="no_cuotas" class="form-control" type="text" onkeyup={ keyup6 }/>
      </div>
      <div class="form-group">
        <label for="sel1">Division de cuotas</label>
          <input id="div_cuotas" class="form-control" type="text" onkeyup={ keyupww26 }/>
      </div>
     <div class="form-group">
            <label for="male">Fecha:</label>
            <i class="fa fa-usd"></i>
            <input type='text' class='form-control' id='txtDate' onchange={ keyup26 } />
      </div>
        <div class="form-group">
            <label for="male">Tus cuotas de:</label>
            <i class="fa fa-usd"></i>
            <p  id="cuotas_de" class="form-control" placeholder="tus cuotas de"><raw content="{ html }"/> </p>
      </div>

<div class="clearfix"></div>
<br>

      </div>
    </div>
       </div>

            <div class="modal-footer" style="display:none;" id="modal_save">
              <button onclick="{ __save }" type="button" class="btn btn-primary">Guardar</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          </div>
      </form>
    </div>
   </div>
  </div>
</div>
  </div>
  </div>
<script>
    var self = this;

self.detail = [];
self.iva = 0;
self.subTotal = 0;
self.total = 0;




    self.on('mount', function(){
        __clientAutocomplete();
        __productAutocomplete();
        __eventoRadio();
        __calendario();
        sumaFecha();



    })

function __calendario(){

    $("#txtDate").datepicker({
        showOn: 'button',
        buttonText: 'Show Date',
        format: 'dd/mm/yyyy',
        buttonImageOnly: true,
        buttonImage: 'http://jqueryui.com/resources/demos/datepicker/images/calendar.gif'
    });
}

sumaFecha = function(d, fecha)
{
     var Fecha = new Date();
     var sFecha = fecha || (Fecha.getDate() + "/" + (Fecha.getMonth() +1) + "/" + Fecha.getFullYear());
     var sep = sFecha.indexOf('/') != -1 ? '/' : '-';
     var aFecha = sFecha.split(sep);
     var fecha = aFecha[2]+'/'+aFecha[1]+'/'+aFecha[0];
     fecha= new Date(fecha);
     fecha.setDate(fecha.getDate()+parseInt(d));
     var anno=fecha.getFullYear();
     var mes= fecha.getMonth()+1;
     var dia= fecha.getDate();
     mes = (mes < 10) ? ("0" + mes) : mes;
     dia = (dia < 10) ? ("0" + dia) : dia;
     var fechaFinal = dia+sep+mes+sep+anno;
     return (fechaFinal);
 }


this.tags = opts.tags

    keyup(e) {
      var val = this.editor.value
      var total = self.total
      var operacion = total - val
      self.operacion = operacion
        adjustEditorWidth(this)
        return false
    }


    function adjustEditorWidth(elem) {
      elem.measure.innerHTML = self.operacion
      var h = $('#measure').text()
      self.deber = h


    }


keyup2(e) {
      var paga_con = this.paga_con.value
      var abono = self.editor.value
      var operacion2 = paga_con - abono
      self.operacion2 = operacion2
        adjustEditorWidth2(this)
        return false
    }


    function adjustEditorWidth2(elem) {

    elem.devolucion.innerHTML = self.operacion2


    }
keyup3(e) {
  var paga_con2 = this.paga_con2.value
  var total = self.total
  var operacion3 = paga_con2 - total
  self.operacion3 = operacion3
  adjustEditorWidth3(this)
  return false
}
function adjustEditorWidth3(elem) {
 elem.devolucion2.innerHTML = self.operacion3
}
keyup6(e){
  var no_cuotas = this.no_cuotas.value
  self.num_cuotas = no_cuotas;
  var pintar_campos = $("#divTxt2");
      if (no_cuotas == 0) {
        pintar_campos.empty();
   }
for (var i = 0; i < no_cuotas; i++) {
     $("#divTxt2")
    .append('<p  name="morein['+i+']" id="fechas-'+i+'" style="display:none" class="form-control" placeholder="tus cuotas de"><raw content="{ html }"/> </p>');


}
  var total = self.total
  var operacion4 = parseFloat(total) / parseFloat(no_cuotas)
  self.operacion4 = operacion4
  adjustEditorWidth6(this)
  return false
}
function adjustEditorWidth6(elem) {
    elem.cuotas_de.innerHTML = self.operacion4
}

keyup26(e){
  var no_cuotas2 = this.txtDate.value
  self.operacion45 = no_cuotas2

for (var i = 0; i < self.num_cuotas; i++) {

  var div_cuotas = $('#div_cuotas').val();
  self.div_cuotas_recor = div_cuotas;
  var numero = self.div_cuotas_recor * i;
  if (i > 0) {

      var fecha = sumaFecha(numero, self.operacion45);
      self.fecha = fecha;
      var recorrido = i;
      document.getElementById('fechas-'+i+'').innerHTML = self.fecha;

  }
    else if (i == 0) {

      document.getElementById('fechas-'+i+'').innerHTML = self.operacion45;

}

}
  adjustEditorWidth26(this)
  return false
}
function adjustEditorWidth26(elem) {

}

edit(e) {
      this.text = e.target.value
/*
     this.text = this.debe.input.value = ''
*/
this.push({ title: this.text })

    }

__save() {


var div_cuotas = $('#div_cuotas').val();
var importe_recibido = $('input:text[name=paga_con2]').val();
var cambio = self.operacion3;

var no_cuotas = self.no_cuotas.value
dataString2=[];
var newArray = new Array();
var newPosiciones = new Array();
$("p[name^='morein']").each(function(indice, valor){
   var posicionesinput = indice + 1;
   var valorinput = valor.innerHTML;
/*
  elem.devolucion.innerHTML = self.operacion2
*/
   newArray.push(valorinput);
   newPosiciones.push(posicionesinput);

});



var No_cuota_final = self.no_cuotas.value - 1

    $.ajax({
      url: base + '/facturas/save',
      type: 'POST',
      dataType: 'JSON',
      data: {
         client_id: self.client_id,
         iva: self.iva,
         subTotal: self.subTotal,
         total: self.total,
         detail: self.detail,
         no_cuotas: no_cuotas,
         debe: self.deber,
         No_cuota_final: No_cuota_final,
         div_cuotas: div_cuotas,
         importe_recibido: importe_recibido,
         cambio: cambio,
         newArray,
         newPosiciones

      },
    }).success(function(data){

      console.log(data);
      console.log(data.asisistente[0].invoice_id);
      location.href = "gestorVentas/" + data.asisistente[0].invoice_id;

      alert("olalao");

$.ajax({
  url: base + '/facturas/gestorVentas/' + data.asisistente[0].invoice_id,
  type: 'GET',
  dataType: 'JSON',
  data: {param1: 'value1'},
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




    }).error(function() {
      alert("mal");
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

/*            $.post(base + '/facturas/save', {
                client_id: self.client_id,
                iva: self.iva,
                subTotal: self.subTotal,
                total: self.total,
                detail: self.detail,
                no_cuotas: no_cuotas,
                abono: abono,
                debe: self.deber,
                No_cuota_final: No_cuota_final,
                newArray,
                newPosiciones



            }, function(r){
                console.log(r);
                if(r.response) {
                $("#msj-success").fadeIn();
                toastr.success("Su registro ha sido exitoso", "Registro Facturación");
                window.location.href = '/facturacion';
                return false;
                    alert("hola");
                } else {
                    alert('Ocurrio un error');
                }
            }, 'json')
*/        }

  __removeProductFromDetail(e) {
            var item = e.item,
                index = this.detail.indexOf(item);

            this.detail.splice(index, 1);
            __calculate();
        }


__addProductoToDetail(){
    self.detail.push({

id: self.product_id,
name: self.product.value,
cantidad: parseFloat(self.cantidad.value),
precio: parseFloat(self.precio.value),
total: parseFloat(self.precio.value * self.cantidad.value)

    });


self.product_id = 0;
self.product.value = '';
self.cantidad.value = '';
self.precio.value = '';



__calculate();


}




/*__agergarCliente(){

var nombre = $('#nombre').val();
var cedula = $('#cedula').val();
var direccion = $('#direccion').val();


              $.post(base + '/cliente/save', {
                nombre: nombre,
                cedula: cedula,
                direccion: direccion

            }, function(r){
                if(r.response) {
                $("#msj-success").fadeIn();
                toastr.success("Su registro ha sido exitoso", "Registro Proveedor");


                    alert("hola");
                } else {
                    alert('Ocurrio un error');
                }
            }, 'json')




}
*/
__agergarCliente(){


var nombre = $('#nombre').val();
var cedula = $('#cedula').val();
var direccion = $('#direccion').val();


$.ajax({
    url: base + '/cliente/save',
    type: 'POST',
    dataType: 'JSON',
    data: {
        nombre: nombre,
        cedula: cedula,
        direccion: direccion},
}).success(function(){
   $("#msj-success").fadeIn();
   toastr.info("Su registro ha sido exitoso", "Registro cliente");
   setTimeout('document.clienteForm.reset()',3000);
   return false;


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



}









function __calculate(){

   var total = 0;
    self.detail.forEach(function(e){
    total += e.total;
    });

    self.total = total;
    self.subTotal = parseFloat(total / 1.18);
    self.iva = parseFloat(total - self.subTotal);


}

function __clientAutocomplete(){

        var options = {

            url: function(q){
                return base + '/facturas/findClient?q=' + q;
            },

            getValue: "name",
            list: {
                onClickEvent: function(){
                    var e = $("#client").getSelectedItemData();
                    self.client_id = e.id;
                    self.ruc = e.ruc;
                    self.address = e.address;
                    self.update();
                }
            }
        };
        $("#client").easyAutocomplete(options);
}

function __eventoRadio(){

    $(".pago").click(function(evento){
            var valor = $(this).val();

            if(valor == 'Deposito'){
                $("#div1").css("display", "block");
                $("#div2").css("display", "none");
                $("#modal_save").css("display", "block");

            }else{

                $("#div1").css("display", "none");
                $("#div2").css("display", "block");
                $("#modal_save").css("display", "block");

            }
    });

}

function __productAutocomplete(){

        var options = {

            url: function(q){
                return base + '/facturas/findProduct?q=' + q;
            },

            getValue: "nombre",
            list: {
                onClickEvent: function(){
                    var e = $("#product").getSelectedItemData();
                    self.product_id = e.id;
                    self.precio_producto_unidad = e.precio_venta;
                    self.precio_producto_volumen = e.precio_venta_volumen;
                    self.update();

                }
            }
        };
        $("#product").easyAutocomplete(options);
}



jQuery(document).ready(function(){
            jQuery("#clienteForm").validationEngine({

            });
        });

</script>
<script>
  $(document).ready(function() {

    $("#txtDate").datepicker({
        showOn: 'button',
        buttonText: 'Show Date',
        buttonImageOnly: true,
        buttonImage: 'http://jqueryui.com/resources/demos/datepicker/images/calendar.gif'
    });
});
</script>

</invoice>