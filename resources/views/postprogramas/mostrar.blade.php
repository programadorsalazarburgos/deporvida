<style>
.code {
height: 80px !important;
}

textarea.ng-invalid.ng-dirty{border:1px solid red;}
select.ng-invalid.ng-dirty{border:1px solid red;}
option.ng-invalid.ng-dirty{border:1px solid red;}
input.ng-invalid.ng-dirty{border:1px solid red;}

</style>

<div class = 'container'>
<div class="clearfix"></div>
<br>
<div class="content-wrapper">
<section class="content-header">
<!-- <h3><i class='fa fa-edit'></i> Agregar nuevo producto</h3> -->
</section>
<section class="content">
<div class="row">


<div class="col-md-10">
<form class="form-horizontal" id="f1" name="frm" submit="submitForm()" novalidate>
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#details" data-toggle="tab" aria-expanded="false">Información Usuario</a></li>
    </ul>
    <div class="tab-content">
        <div id="resultados_ajax"></div>
        <div class="tab-pane active" id="details">
            <div class="clearfix"></div>
            <br>


            <div class="form-group">
                <label for="note" class="col-sm-2 control-label">Primer Nombre</label>
                <div class="col-sm-8">
                    <input class="form-control" disabled placeholder="Digita Primer Nombre" name="primer_nombre" value="@{{primer_nombre}}" ng-model="serie.primer_nombre" required></input>
                    <span class="label label-danger" ng-show="frm.primer_nombre.$dirty && frm.primer_nombre.$error.required">Requerido</span>
                </div>
            </div>

            <div class="form-group">
                <label for="note" class="col-sm-2 control-label">Segundo Nombre</label>
                <div class="col-sm-8">
                    <input class="form-control" disabled placeholder="Digita Segundo Nombre" name="segundo_nombre" value="@{{segundo_nombre}}" ng-model="serie.segundo_nombre" required></input>
                    <span class="label label-danger" ng-show="frm.segundo_nombre.$dirty && frm.segundo_nombre.$error.required">Requerido</span>
                </div>
            </div>


            <div class="form-group">
                <label for="note" class="col-sm-2 control-label">Primer Apellido</label>
                <div class="col-sm-8">
                    <input class="form-control" disabled placeholder="Digita Primer Apellido" name="primer_apellido" value="@{{primer_apellido}}" ng-model="serie.primer_apellido" required></input>
                    <span class="label label-danger" ng-show="frm.primer_apellido.$dirty && frm.primer_apellido.$error.required">Requerido</span>
                </div>
            </div>


            <div class="form-group">
                <label for="note" class="col-sm-2 control-label">Segundo Apellido</label>
                <div class="col-sm-8">
                    <input class="form-control" disabled placeholder="Digita Segundo Apellido" name="segundo_apellido" value="@{{segundo_apellido}}" ng-model="serie.segundo_apellido" required></input>
                    <span class="label label-danger" ng-show="frm.segundo_apellido.$dirty && frm.segundo_apellido.$error.required">Requerido</span>
                </div>
            </div>


            <div class="form-group">
               <label for="note" class="col-sm-2 control-label">Tipo Documento</label>
               <div class="col-sm-8">
                <select class="form-control" disabled name="tipo_documento" id="tipo_documento" required>
                    <option <?php if (1 == 2 ) echo 'selected' ; ?> value="1">Cédula de ciudadanía</option>
                    <option <?php if (1 == 1 ) echo 'selected' ; ?> value="2">Pasaporte</option>
                    <option <?php if (1 == 3 ) echo 'selected' ; ?> value="3">Cédula extranjera</option>
                    <option <?php if (1 == 4 ) echo 'selected' ; ?> value="4">Tarjeta de Identidad</option>
                </select>
                <br>
            </div>
        </div>


        <div class="form-group">
            <label for="note" class="col-sm-2 control-label">Número de Documento</label>
            <div class="col-sm-8">
                <input class="form-control" disabled placeholder="Digita Número de Documento" name="numero_documento" value="@{{numero_documento}}" ng-model="serie.numero_documento" required></input>
                <span class="label label-danger" ng-show="frm.numero_documento.$dirty && frm.numero_documento.$error.required">Requerido</span>
            </div>
        </div>


        <div class="form-group">
            <label for="note" class="col-sm-2 control-label">Dirección</label>
            <div class="col-sm-8">
                <input class="form-control" disabled placeholder="Digita Dirección" name="direccion" value="@{{direccion}}" ng-model="serie.direccion" required></input>
                <span class="label label-danger" ng-show="frm.direccion.$dirty && frm.direccion.$error.required">Requerido</span>
            </div>
        </div>


        <div class="container-fluid">
          <div class="form-group">
            <label for="note" class="col-sm-2 control-label">Fecha de Nacimiento</label>
            <div class="col-sm-8">
                <p class="input-group">
                    <input type="text" disabled class="form-control" datepicker-popup="yyyy/MM/dd" value="@{{fecha_nacimiento}}" ng-model="serie.fecha_nacimiento" name="fecha_nacimiento" is-open="opened"
                    close-text="Close"/>
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-default" ng-click="openCalendar($event)"><i
                            class="glyphicon glyphicon-calendar"></i></button>
                        </span>
                    </p>
                </div>
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                </div>
            </div>
        </div>


        <div class="form-group">
            <label for="note" class="col-sm-2 control-label">Teléfono móvil
            </label>
            <div class="col-sm-8">
                <input class="form-control" disabled placeholder="Digita Teléfono móvil
                " name="telefono_movil" value="@{{telefono_movil}}" ng-model="serie.telefono_movil" required></input>
                <span class="label label-danger" ng-show="frm.telefono_movil.$dirty && frm.telefono_movil.$error.required">Requerido</span>
            </div>
        </div>


        <div class="form-group">
            <label for="note" class="col-sm-2 control-label">Teléfono fijo

            </label>
            <div class="col-sm-8">
                <input class="form-control" disabled placeholder="Digita Teléfono fijo
                " name="telefono_fijo" value="@{{telefono_fijo}}" ng-model="serie.telefono_fijo" required></input>
                <span class="label label-danger" ng-show="frm.telefono_fijo.$dirty && frm.telefono_fijo.$error.required">Requerido</span>
            </div>
        </div>


        <div class="form-group">
            <label for="note" class="col-sm-2 control-label">Correo Electrónico

            </label>
            <div class="col-sm-8">
                <input class="form-control" disabled type="email" placeholder="Digita Correo Electrónico
                " name="email" value="@{{email}}" ng-model="serie.email" required></input>
                <span class="label label-danger" ng-show="frm.email.$dirty && frm.email.$error.required">Requerido</span>
            </div>
        </div>



        <div class="form-group">
            <label for="note" class="col-sm-2 control-label">Rol</label>
            <div class="col-sm-6">
              <select class="form-control" disabled name="rol" id="rol" required ng-change="unitChanged()" ng-model="data.unit" ng-options="unit.id as unit.name for unit in roles"></select>

          </div>
      </div>

      <div class="clearfix"></div>
      <br>

      <a href="{{url('/admin/postusuarios#/admin/postusuarios')}}" type="submit" class="btn btn-orange"><i class="fa fa-reply-all"></i>&nbsp;&nbsp;Atras</a>

  </div>
</div>
</div>
</div>
</div>
</div>
</div>

</form>

<div class="messages"></div><br /><br />
<!--div para visualizar en el caso de imagen-->
<div class="showImage"></div>

</div>


</div>
</section>



