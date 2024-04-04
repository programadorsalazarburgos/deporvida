<stock>


<div class="row">
    <div class="col-xs-7">
        <input id="product" class="form-control" type="text" placeholder="nombre del producto" />
    </div>
</div>
<div class="clearfix"></div>
<br>

<div class="container">
<div class="col-md-1">
    <label class="radio-inline">
      <input name="pago1" class="pago" value="volumen" type="radio" onclick={ onclick }>Volumen
    </label>
    </div>

   <div class="col-md-2">
    <label class="radio-inline">
      <input checked="checked" class="pago" name="pago1" type="radio" value="Unidad" onclick={ onclick }>Unidad
    </label>
    </div>

<div id="div2" style="display:none;">
    <div class="col-xs-2">
        <input id="cantidad"  class="form-control" type="text" placeholder="cantidad Volumen" />
        <p align="center" id="requerido"></p>
    </div>


    <div class="col-xs-2">
        <div class="input-group">
           <select class="form-control" id="precio">
              <option value="{cantidades_volumen}">{cantidades_volumen} Cajas</option>

            </select>
       </div>
    </div>

<div class="col-xs-3">
    <div class="input-group">
    <div class="input-group-addon">
    <i class="fa fa-usd"></i>
    </div>
        <input type="text" class="form-control" placeholder="Precio Compra x Volumen" id="costo_compra" name="costo_compra">
    </div>
        <p align="center" id="requerido2"></p>
  </div>



    <div class="col-xs-1">
        <button onclick="{ __addProductoToDetail }" class="btn btn-primary form-control" id="btn-agregar">
            <i class="glyphicon glyphicon-plus"></i>
        </button>
    </div>


       <div class="page-content">
                <div id="table-advanced" class="row">
                    <div class="col-lg-12">
                        <ul id="tableadvancedTab" class="nav nav-tabs">
                            <li class="active"><a href="#table-sorter-tab" data-toggle="tab">Info</a></li>
                        </ul>
                        <div id="tableadvancedTabContent" class="tab-content">
                            <div id="table-sorter-tab" class="tab-pane fade in active">
                                <div class="row">
                                    <div class="col-lg-12"><h3 class="mtn">Stock Volumen</h3>
                                        <table class="table table-hover table-striped table-bordered table-advanced tablesorter" id="myTable">
                                            <thead>
                                            <tr>
                                              <th style="width: 40px;"></th>
                                              <th>Producto</th>
                                              <th style="width: 100px;">Stock Agregar</th>
                                              <th style="width: 100px;">Stock Bodega</th>
                                              <th style="width: 100px;">Stock Final</th>


                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr each={detail}>
                                                <td>
                                                    <button onclick={__removeProductFromDetail} class="btn btn-danger btn-xs btn-block">X</button>
                                                </td>
                                                 <td>{name}</td>
                                                <td class="text-right">{cantidad}</td>
                                                <td class="text-right">{precio}</td>
                                                <td class="text-right">{total}</td>

                                            </tr>
                                            </tbody>
                                            <tfoot>
                                              <tr>
                                                <td colspan="4" class="text-right"><b>Stock Volumen</b></td>
                                                <td class="text-right"> {total} {tipo_volumen}</td>
                                              </tr>
                                                 <tr>
                                                    <td colspan="4" class="text-right"><b>Stock Unidades</b></td>
                                                    <td class="text-right"> {totales} Unidades</td>
                                                </tr>

                                            </tfoot>
                                        </table>



             <div class="col-xs-2">
                 <button type="button" class="btn btn-success form-control" onclick={__save}><i class="fa fa-dollar"></i> Agregar al Stock
                </button>
            </div>

<p id="demo"></p>
  </div>
  </div>
  </div>
  </div>
  </div>
  </div>
  </div>
</div>

<div id="div1" style="display:none;">

 <div class="col-xs-2">
        <input id="cantidad_unidad"  class="form-control" type="text" placeholder="cantidad Unidad" />
        <p align="center" id="requerido2"></p>
    </div>


    <div class="col-xs-2">
        <div class="input-group">
           <select class="form-control" id="precio_unidades">
              <option value="{unidades}">{unidades} Unidades</option>

            </select>
       </div>
    </div>



<div class="col-xs-3">
    <div class="input-group">
    <div class="input-group-addon">
    <i class="fa fa-usd"></i>
    </div>
        <input type="text" class="form-control" placeholder="Precio Compra x Unidad" id="costo_compra_unidad" name="costo_compra_unidad">
    </div>
        <p align="center" id="requerido2"></p>
  </div>


    <div class="col-xs-1">
        <button onclick="{ __addProductoToDetailUnidad }" class="btn btn-primary form-control" id="btn-agregar2">
            <i class="glyphicon glyphicon-plus"></i>
        </button>
    </div>



       <div class="page-content">
                <div id="table-advanced2" class="row">
                    <div class="col-lg-12">
                        <ul id="tableadvancedTab2" class="nav nav-tabs">
                            <li class="active"><a href="#table-sorter-tab" data-toggle="tab">Info</a></li>
                        </ul>
                        <div id="tableadvancedTabContent2" class="tab-content">
                            <div id="table-sorter-tab2" class="tab-pane fade in active">
                                <div class="row">
                                    <div class="col-lg-12"><h3 class="mtn">Stock Unidad</h3>
                                        <table class="table table-hover table-striped table-bordered table-advanced tablesorter" id="myTable2">
                                            <thead>
                                            <tr>
                                              <th style="width: 40px;"></th>
                                              <th>Producto</th>
                                              <th style="width: 100px;">Stock Unidades Agregar</th>
                                              <th style="width: 100px;">Stock Unidades Bodega</th>
                                              <th style="width: 100px;">Stock Unidades Final</th>


                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr each={detail2}>
                                                <td>
                                                    <button onclick={__removeProductFromDetailUnidad} class="btn btn-danger btn-xs btn-block">X</button>
                                                </td>
                                                 <td>{name}</td>
                                                <td class="text-right">{cantidad_unidad}</td>
                                                <td class="text-right">{precio_unidad}</td>
                                                <td class="text-right">{total_unidad}</td>

                                            </tr>
                                            </tbody>
                                            <tfoot>



                                            </tfoot>
                                        </table>



             <div class="col-xs-2">
                 <button type="button" class="btn btn-success form-control" onclick={__save2}><i class="fa fa-dollar"></i> Agregar al Stock
                </button>
            </div>

<p id="demo"></p>


  </div>
  </div>
  </div>
  </div>
  </div>


    </div>
  </div>
</div>

<hr />


<script>
    var self = this;

self.detail = [];
self.detail2 = [];
self.iva = 0;
self.subTotal = 0;
self.total = 0;



    self.on('mount', function(){

        __productAutocomplete();
        getDataFromServer();

    })

function getDataFromServer(){
  $.get('/cuentaxcobrar/obtener' , function(r){
     console.log(r);
     self.model = r;

     self.ready = true;
     self.update();
  }, 'json')
}






this.tags = opts.tags


  __removeProductFromDetail(e) {
            var item = e.item,
                index = this.detail.indexOf(item);

            this.detail.splice(index, 1);
            __calculate();
        }


__addProductoToDetail(){


var dato1 = (parseFloat(self.precio_compra_volumen) * parseFloat(self.cantidades_volumen));
var dato2 = (parseFloat(self.costo_compra.value) * parseFloat(self.cantidad.value));
var dato3 = (parseFloat(dato1) + parseFloat(dato2));
var dato4 = (parseFloat(self.cantidades_volumen) + parseFloat(self.cantidad.value));
var dato5 = (parseFloat(dato3) / parseFloat(dato4));
self.promediocompra_volumen = dato5;


var x = $("#myTable > tbody").children().length;
document.getElementById("demo").innerHTML = "Found " + x + " tr elements in the table.";
if (x < 1 && self.cantidad.value > 0 && self.costo_compra.value > 0) {
    self.detail.push({

id: self.product_id,
name: self.product.value,
cantidad: parseFloat(self.cantidad.value),
precio: parseFloat(self.precio.value),
total: parseFloat(self.precio.value) + parseFloat(self.cantidad.value),

    });

self.product_id = 0;
self.product.value = '';
self.cantidad.value = '';
self.precio.value = '';

__calculate();

document.getElementById("cantidad").style.border = "1px solid #e5e5e5";
document.getElementById("requerido").innerHTML = "";
document.getElementById("costo_compra").style.border = "1px solid #e5e5e5";
document.getElementById("requerido2").innerHTML = "";



  }else{


document.getElementById("cantidad").style.border = "1px solid #FA513B";
document.getElementById("requerido").innerHTML = "dato requerido";
document.getElementById("costo_compra").style.border = "1px solid #FA513B";
document.getElementById("requerido2").innerHTML = "dato requerido";


  }
}

__removeProductFromDetailUnidad(e) {
            var item = e.item,
                index2 = this.detail2.indexOf(item);
            this.detail2.splice(index2, 1);
            __calculate2();
        }


__addProductoToDetailUnidad(){


var campo = $('#costo_compra_unidad').val();


var x2 = $("#myTable2 > tbody").children().length;
if (x2 < 1 && self.cantidad_unidad.value > 0 && campo !='') {
self.detail2.push({
id: self.product_id,
name: self.product.value,
cantidad_unidad: parseFloat(self.cantidad_unidad.value),
precio_unidad: parseFloat(self.precio_unidades.value),
total_unidad: parseFloat(self.precio_unidades.value) + parseFloat(self.cantidad_unidad.value),

});

self.product_id = 0;

__calculate2();

document.getElementById("cantidad_unidad").style.border = "1px solid #e5e5e5";
document.getElementById("costo_compra_unidad").style.border = "1px solid #e5e5e5";
  }
  else{

document.getElementById("cantidad_unidad").style.border = "1px solid #FA513B";
document.getElementById("costo_compra_unidad").style.border = "1px solid #FA513B";

  }
}


function __calculate(){

   var total = 0;
   var cantidad = 0;
   var producto_id = 0;

    self.detail.forEach(function(e){
    total += e.total;
    cantidad += e.cantidad;
    producto_id += e.id;

    });

    self.total = total;
    self.cantidades = cantidad;
    self.producto_id = producto_id;
    self.subTotal = parseFloat(total / 1.18);
    self.iva = parseFloat(total - self.subTotal);
    self.totales = parseFloat(self.cantidades) * parseFloat(self.unidad_volumen) + parseFloat(self.unidades);
    self.compras = parseFloat(self.costo_compra.value) * parseFloat(self.cantidades);
    self.total_compras_v = parseFloat(self.compras) + parseFloat(self.total_compras_volumen);
    self.precio_venta_v1 = parseFloat((self.costo_compra.value) * parseFloat(self.utilidad_v) /100);
    self.precio_venta_v2 = parseFloat(self.precio_venta_v1) + parseFloat(self.costo_compra.value);
    self.costo_unidad = parseFloat(self.costo_compra.value) / parseFloat(self.unidad_volumen);
    self.precio_venta_unidad_v1 = parseFloat((self.costo_unidad) * parseFloat(self.utilidad_unidad_v) /100);
    self.precio_venta_unidad_v2 = parseFloat(self.precio_venta_unidad_v1) + parseFloat(self.costo_unidad);
    self.promedio_venta_v1 = parseFloat((self.promediocompra_volumen) * parseFloat(self.utilidad_v) /100);
    self.promedio_venta_v2 = parseFloat(self.promedio_venta_v1) + parseFloat(self.promediocompra_volumen);
    self.promediocosto_unidad = (parseFloat(self.promediocompra_volumen) / parseFloat(self.unidad_volumen));

    self.promedio_venta_unidadv1 = parseFloat((self.promediocosto_unidad) * parseFloat(self.utilidad_unidad_v) /100);
    self.promedio_venta_unidadv2 = parseFloat(self.promedio_venta_unidadv1) + parseFloat(self.promediocosto_unidad);



}

function __calculate2(){

   var total = 0;
   var total_unidad = 0;
   var cantidad_unidad = 0;
   var producto_id = 0;

alert(2);
    self.detail2.forEach(function(e){

    total_unidad += e.total_unidad;
    cantidad_unidad += e.cantidad_unidad;
    producto_id += e.id;


    });


    self.total = total;
    self.total_unidad = total_unidad;
    self.cantidades_unidad = cantidad_unidad;
    self.producto = producto_id;
    console.log(self.producto);
    self.compras_total = parseFloat(self.costo_compra_unidad.value) * parseFloat(self.cantidad_unidad.value);
    self.costo_compra_unidad = parseFloat(self.costo_compra_unidad.value);



    self.precio_venta_unidades_v1 = parseFloat((self.costo_compra_unidad) * parseFloat(self.utilidad_unidad_v) /100);

    self.precio_venta_unidades_v2 = parseFloat(self.precio_venta_unidades_v1) + parseFloat(self.costo_compra_unidad);
    self.producto_id = producto_id;


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
                    self.cantidades_volumen = e.stock_volumen_final;
                    self.precio_producto_volumen = e.precio_venta_volumen;
                    self.codigo = e.codigo;
                    self.precio_producto_unidad = e.stock_volumen_final;
                    self.unidades = e.stock_unidad_final;
                    self.unidad_volumen = e.unidad_volumen;
                    self.utilidad_v = e.utilidad_volumen;
                    self.tipo_volumen = e.tipo_volumen;
                    self.utilidad_unidad_v = e.utilidad_unidad;
                    self.precio_compra_volumen = e.precio_compra_volumen;
                    self.precio_producto_volumen = e.precio_venta_volumen;
                    self.total_compras_volumen = e.total_compras_volumen;
                    self.update();

                }
            }
        };
        $("#product").easyAutocomplete(options);
}


__save(){


var producto_id = self.producto_id
var valor = $('input[name=pago1]:radio:checked').val();

$.ajax({
    url: base + '/stockProductos/save',
    type: 'POST',
    dataType: 'JSON',
    data: {


          valor: valor,
          producto: self.producto_id,
          stock_volumen_final: self.total,
          stock_unidad_final: self.totales,
          venta_total: self.compras,
          codigo: self.codigo,
          precio_compra_volumen: self.costo_compra.value,
          promediocompra_volumen: self.promediocompra_volumen,
          precio_venta_volumen: self.promedio_venta_v2,
          total_compras_volumen: self.total_compras_v,
          costo_unidad: self.promediocosto_unidad,
          precio_venta: self.promedio_venta_unidadv2

      },
}).success(function(){
   $("#msj-success").fadeIn();
   toastr.success("Su registro ha sido exitoso", "Agregación Stock");
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

__save2(){

var valor = $('input[name=pago1]:radio:checked').val();

$.ajax({
    url: base + '/stockProductos/save',
    type: 'POST',
    dataType: 'JSON',
    data: {
          valor: valor,
          producto: self.producto_id,
          stock_unidad_final: self.total_unidad,
          venta_total: self.compras_total,
          codigo: self.codigo,
          precio_compra_unidad: self.costo_compra_unidad,
          precio_venta_unidad: self.precio_venta_unidades_v2,

      },
}).success(function(){
   $("#msj-success").fadeIn();
   toastr.success("Su registro ha sido exitoso", "Agregación Stock");
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







this.onclick = function(event) {

var valor = $('input[name=pago1]:radio:checked').val();


 if(valor == 'Unidad'){
                $("#div1").css("display", "block");
                $("#div2").css("display", "none");
            }else{
                $("#div1").css("display", "none");
                $("#div2").css("display", "block");
            }



  }



jQuery(document).ready(function(){
            jQuery("#clienteForm").validationEngine({

            });
        });





</script>

</stock>