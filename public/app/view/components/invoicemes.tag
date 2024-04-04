<invoicemes>
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <label for="manufacturer_id" class="col-sm-2 control-label">Fecha</label>
                    <div class="col-md-6">
                    <select onchange={__obtenerMes} class="validate[required] form-control" name="fabricante" id="meses" required>
                        <option value="">Selecciona</option>
                        <option value="01">Enero</option>
                        <option value="02">Febrero</option>
                        <option value="03">Marzo</option>
                        <option value="04">Abril</option>
                        <option value="05">Mayo</option>
                        <option value="06">Junio</option>
                        <option value="07">Julio</option>
                        <option value="08">Agosto</option>
                        <option value="09">Septiembre</option>
                        <option value="10">Octubre</option>
                        <option value="11">Noviembre</option>
                        <option value="12">diciembre</option>
                    </select>
            </div>
              <div class="demo-btn">
                <button onclick={__buscaVentas} class="btn btn-warning ">Buscar &nbsp;<i class="fa fa-search"></i></button>
              </div>
            </div>
       </div>
    </div>


                <div id="table-advanced" class="row">
                    <div class="col-lg-12">
                        <ul id="tableadvancedTab" class="nav nav-tabs">
                            <li class="active"><a href="#table-sorter-tab" data-toggle="tab">Ventas</a></li>
                        </ul>
                        <div id="tableadvancedTabContent" class="tab-content">
                            <div id="table-sorter-tab" class="tab-pane fade in active">
                                <div class="row">
                                    <div class="col-lg-12"><h3 class="box-heading" style="color: #0a819c;">Información Ventas</h3>
                                        <table class="table table-hover table-striped table-bordered table-advanced tablesorter">
                                            <thead>
                                            <tr>
                                              <th>Cliente</th>
                                              <th>Producto</th>
                                              <th>Cantidad</th>
                                              <th style="width: 100px;">SubTotal</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr each={ model }>
                                                  <td>{ cliente }</td>
                                                  <td>{ producto }</td>
                                                  <td>{ cantidad }</td>
                                                  <td class="text-right">$ {total}</td>
                                                </tr>
                                            </tbody>
                                          <tfoot>
                                          <tr>
                                            <td  colspan="3" class="text-right"><b><span class="label label-sm label-primary" style="font-size: 16px;">Total</span></b></td>
                                            <td class="text-right"><span class="label label-sm label-success" style="font-size: 16px;">$ {carreras}</span></td>
                                          </tr>
                                        </tfoot>

                                        </table>
                            </div>
                        </div>
                    </div>
                </div>



<script>
    var self = this;

self.detail = [];
self.detalles = [];

self.iva = 0;
self.subTotal = 0;
self.total = 0;
self.carreras = [];
self.cliente = [];
self.on('mount', function(){
        __clientAutocomplete();
        __productAutocomplete();
    })

__save() {
            $.post(base + '/facturas/save', {
                client_id: self.client_id,
                iva: self.iva,
                subTotal: self.subTotal,
                total: self.total,
                detail: self.detail
            }, function(r){
                if(r.response) {
                    $("#msj-success").fadeIn();
                    toastr.success("Su registro ha sido exitoso", "Registro Proveedor");
                    setTimeout('document.f1.reset()',3000);


                } else {
                    alert('Ocurrio un error');
                }
            }, 'json')
        }


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
__obtenerMes(){

var d = new Date();
var n = d.getFullYear();
mes = self.meses.value;
var variable = (n + "-" + mes);
self.fechaMes = variable;
}
__buscaVentas(){

$.post(base + '/facturas/findMes', {
 fecha: self.fechaMes
 } , function(r) {
var totalPeriod = 0;
self.detalles2 = [];
self.model = r;
var newArray = new Array();

$.each(r, function(index, val) {
totalPeriod+=val.total;
var subtotal = parseFloat(val.total);
newArray.push(subtotal);
  });
var total = 0;
  for(i=0; i<newArray.length; i++){
        total += newArray[i];
    }

self.carreras = total;
console.log(self.carreras);
self.update();

   }, 'json')
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
                    self.precio_producto = e.precio_venta;
                    /*self.address = e.address;*/
                    self.update();
                }
            }
        };
        $("#product").easyAutocomplete(options);
}

</script>



</invoicemes>