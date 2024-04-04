<abono>


<div class="container">
<div class="page-content">
 <div id="table-action" class="row">
 <div class="col-lg-12">
      <ul id="tableactiondTab" class="nav nav-tabs">
        <li class="active"><a href="#table-table-tab" data-toggle="tab">Cuentas x Cobrar</a></li>
      </ul>
<div id="tableactionTabContent" class="tab-content">
  <div id="table-table-tab" class="tab-pane fade in active">
   <div class="row">
   <div class="col-lg-12">
   <div class="table-container">
   <div class="row mbm">
   <div class="col-lg-6">
   </div>
   </div>

  <div class="portlet-body">


<table id="example-export" class="table table-hover table-striped table-bordered table-advanced tablesorter">
       <thead>
      <tr>
        <th style="width:100px;" class="text-right">No Factura</th>
        <th>Cliente</th>
        <th style="width:160px;" class="text-right">No Cuotas Estblecidas</th>
        <th style="width:160px;" class="text-right">No de Cuotas Restantes</th>
        <th style="width:180px;" class="text-right">Abono</th>
        <th style="width:180px;" class="text-right">Debe</th>
        <th style="width:30px;">Fecha Facturación</th>

     </tr>
       </thead>
    <tbody>
                    <tr each={model}>
                        <td>
                          <a href="/cuentaxcobrar/detalles/{id_cuenta_cobrar}">
                               {no_factura}
                            </a>
                        </td>
                        <td>
                            <a href="">
                              {name}
                            </a>
                        </td>
                        <td class="text-right">{no_cuotas}</td>
                        <td class="text-right">{No_cuota_final}</td>
                        <td class="text-right">$ {abono}</td>
                        <td class="text-right">$ {debe}</td>
                        <td class="text-right">{created_at}</td>

                    </tr>

                </tbody>
       </table>

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
  $.get('/cuentaxcobrar/obtener' , function(r){
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
</abono>