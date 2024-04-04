<invoiceventas>

    <div class="well well-sm">
        <div class="row">

            <div class="col-xs-4">
               <input type="text" size="12" id="field" class="form-control" />
            </div>



              <div class="demo-btn">
                <button onclick={__buscaVentas} class="btn btn-warning ">Buscar &nbsp;<i class="fa fa-search"></i></button>

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
                                    <div class="col-lg-12"><h3 class="mtn">Información Ventas</h3>
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



     $('#field').datepicker({
            format: 'YYYY-MM-DD'
        });







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
                    alert("hola");
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

__buscaVentas(){

var kol = self.field.value;



$.post(base + '/facturas/findVenta', {

 fecha: self.field.value
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



<!--
<script>
         $('#field').datepicker({
            format: 'YYYY/MM/DD'
        });
        </script>
 -->










</invoiceventas>