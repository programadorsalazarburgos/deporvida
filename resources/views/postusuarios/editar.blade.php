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
<section class="content">
<div class="row">
<div class="col-md-11">
<form class="form-horizontal" id="f1" name="frm" submit="submitForm()" novalidate>
<div class="nav-tabs-custom">
<ul class="nav nav-tabs">
<li class="active"><a href="#details" data-toggle="tab" aria-expanded="false">Formulario Creación Usuario</a></li>
</ul>
<div class="tab-content">
<div id="resultados_ajax"></div>
<div class="tab-pane active" id="details">
<div class="clearfix"></div>
<br>

<div class="form-group">
<label for="note" class="col-sm-2 control-label">Primer Nombre</label>
<div class="col-sm-8">
    <input class="form-control" placeholder="Digita Primer Nombre" name="primer_nombre" value="@{{primer_nombre}}" ng-model="serie.primer_nombre" required></input>
    <span class="label label-danger" ng-show="frm.primer_nombre.$dirty && frm.primer_nombre.$error.required">Requerido</span>
</div>
</div>

<div class="form-group">
<label for="note" class="col-sm-2 control-label">Segundo Nombre</label>
<div class="col-sm-8">
    <input class="form-control" placeholder="Digita Segundo Nombre" name="segundo_nombre" value="@{{segundo_nombre}}" ng-model="serie.segundo_nombre" required></input>
    <span class="label label-danger" ng-show="frm.segundo_nombre.$dirty && frm.segundo_nombre.$error.required">Requerido</span>
</div>
</div>


<div class="form-group">
<label for="note" class="col-sm-2 control-label">Primer Apellido</label>
<div class="col-sm-8">
    <input class="form-control" placeholder="Digita Primer Apellido" name="primer_apellido" value="@{{primer_apellido}}" ng-model="serie.primer_apellido" required></input>
    <span class="label label-danger" ng-show="frm.primer_apellido.$dirty && frm.primer_apellido.$error.required">Requerido</span>
</div>
</div>


<div class="form-group">
<label for="note" class="col-sm-2 control-label">Segundo Apellido</label>
<div class="col-sm-8">
    <input class="form-control" placeholder="Digita Segundo Apellido" name="segundo_apellido" value="@{{segundo_apellido}}" ng-model="serie.segundo_apellido" required></input>
    <span class="label label-danger" ng-show="frm.segundo_apellido.$dirty && frm.segundo_apellido.$error.required">Requerido</span>
</div>
</div>


<div class="form-group">
 <label for="note" class="col-sm-2 control-label">Tipo Documento</label>
 <div class="col-sm-8">
 <select class="form-control" ng-model="obtener.documentoId" ng-options="documento.id as documento.nombre for documento in obtener.documentos"></select>
 <span class="label label-danger" ng-show="frm.tipo_documento_beneficiario.$dirty && frm.tipo_documento_beneficiario.$error.required">Requerido</span>
    <br>
 </div>
</div>

 
<div class="form-group">
<label for="note" class="col-sm-2 control-label">Número de Documento</label>
<div class="col-sm-8">
   <input class="form-control only_number" placeholder="Digita Número de Documento" type="text" name="integer-data-attribute" data-thousands="."  value="@{{numero_documento}}" ng-model="serie.numero_documento"" required="true" />
    <span class="label label-danger" ng-show="frm.numero_documento.$dirty && frm.numero_documento.$error.required">Requerido</span>
</div>
</div>


<div class="form-group">
<label for="note" class="col-sm-2 control-label">Dirección</label>
<div class="col-sm-8">
    <input class="form-control" placeholder="Digita Dirección" name="direccion" value="@{{direccion}}" ng-model="serie.direccion" required></input>
    <span class="label label-danger" ng-show="frm.direccion.$dirty && frm.direccion.$error.required">Requerido</span>
</div>
</div>


<div class="container-fluid">
  <div class="form-group">
            <label for="note" class="col-sm-2 control-label">Fecha de Nacimiento</label>
            <div class="col-sm-8">
            <p class="input-group">
                <input type="text" data-date-format="dd/mm/yy" class="form-control"  value="@{{fecha_nacimiento}}" ng-model="serie.fecha_nacimiento" id="fecha_nacimiento" name="fecha_nacimiento"/>
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
    <input class="form-control" placeholder="Digita Teléfono móvil
" name="telefono_movil" value="@{{telefono_movil}}" ng-model="serie.telefono_movil" required required ng-pattern-restrict="^\d{0,9}((\d{0,2})?)?$"></input>
    <span class="label label-danger" ng-show="frm.telefono_movil.$dirty && frm.telefono_movil.$error.required">Requerido</span>
</div>
</div>


<div class="form-group">
<label for="note" class="col-sm-2 control-label">Teléfono fijo

</label>
<div class="col-sm-8">
    <input class="form-control" placeholder="Digita Teléfono fijo
" name="telefono_fijo" value="@{{telefono_fijo}}" ng-model="serie.telefono_fijo" required required ng-pattern-restrict="^\d{0,9}((\d{0,2})?)?$"></input>
    <span class="label label-danger" ng-show="frm.telefono_fijo.$dirty && frm.telefono_fijo.$error.required">Requerido</span>
</div>
</div>


<div class="form-group">
<label for="note" class="col-sm-2 control-label">Correo Electrónico</label>
<div class="col-sm-8">
    <input class="form-control" type="email" placeholder="Digita Correo Electrónico
" name="email" value="@{{email}}" ng-blur="onBlur($event)" ng-model="serie.email" required></input>
    <span class="label label-danger" ng-show="frm.email.$dirty && frm.email.$error.required">Requerido</span>
</div>
</div>



<div class="form-group">
<label for="note" class="col-sm-2 control-label">Rol</label>
 <div class="col-sm-6">
  <select class="form-control" name="rol" id="rol" required ng-change="unitChanged()" ng-model="data.unit" ng-options="unit.id as unit.name for unit in roles">
      <option value="">Seleccione</option>
  </select>
  </div>
</div>




<div class="clearfix"></div>
<br>
<div class="form-group">
 <div class="col-sm-6">
<div ng-show="loading" id="cargando" class="loading"><img src="{{ asset('/images/cargando.gif') }}">LOADING...</div>
<div ng-repeat="car in cars">
  <li></li>
</div>



<button ng-disabled="frm.$invalid" ng-click="Actualizar(serie.id, frm.$valid)" class="btn btn-success"><i class="fa fa-save"></i>&nbsp;&nbsp;Actualizar Usuario</button>



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



