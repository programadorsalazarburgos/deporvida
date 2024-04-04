<detalle>


<div class="form-group ">
<label for="product_code" class="col-sm-2 control-label">No Factura</label>
<div class="col-sm-4">
<input type="text" disabled class="validate[required] form-control" id="cliente" name="cliente">

</div>
<label for="model" class="col-sm-2 control-label">Cliente</label>
<div class="col-sm-4">
<input type="text" class="form-control" id="model" disabled name="modelo">
</div>
</div>
<div class="form-group">
<label for="product_name" class="col-sm-2 control-label">No Cuotas Fijadas</label>
<div class="col-sm-4">
<input type="text" class="validate[required] form-control" id="product_name" disabled  name="nombre">
</div>
<label for="presentation" class="col-sm-2 control-label">No de Cuotas Restantes</label>
<div class="col-sm-4">
<input type="text" class="form-control" id="presentation" disabled  name="presentacion" maxlength="100">
</div>
</div>

<div class="form-group">
<label for="product_name" class="col-sm-2 control-label">Abono</label>
<div class="col-sm-4">
<div class="input-group">
<span class="input-group-addon">$</span>
<input type="text" class="form-control" id="product_name" disabled  name="nombre">
</div>
</div>
<label for="presentation" class="col-sm-2 control-label">Debe</label>
<div class="col-sm-4">

<div class="input-group">
<span class="input-group-addon">$</span>
<input type="text" class="form-control" id="product_name" disabled  name="nombre">
</div>
</div>
</div>
<div class="form-group">
<label for="product_name" class="col-sm-2 control-label">Fecha Facturación</label>
<div class="col-sm-4">
<input type="text" class="validate[required] form-control" id="product_name" disabled name="nombre">
</div>
</div>
<div class="form-group">
<div class="col-sm-offset-2 col-sm-6">
<button type="button" class="btn btn-orange" data-toggle="modal" data-target="#myModal2">
        Abonar
    </button>

</div>
</div>
</div>
</div>
</div>


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

        getDataFromServer();

    })

function getDataFromServer(){
  $.get('/cuentaxcobrar/detalles/{1}' , function(r){
     console.log(r);
     self.model = r;
     self.ready = true;
     self.update();
  }, 'json')
}

this.tags = opts.tags
jQuery(document).ready(function(){
            jQuery("#clienteForm").validationEngine({

            });
        });

</script>
</detalle>