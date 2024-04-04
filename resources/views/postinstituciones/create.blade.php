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


<div class="col-md-12">
<form class="form-horizontal" id="f1" name="frm" submit="submitForm()" novalidate>
<div class="nav-tabs-custom">
<ul class="nav nav-tabs">
<li class="active"><a href="#details" data-toggle="tab" aria-expanded="false">Formulario Crear Institución</a></li>
</ul>
<div class="tab-content">
<div id="resultados_ajax"></div>
<div class="tab-pane active" id="details">
<div class="clearfix"></div>
<br>


<div class="form-group">
<label for="note" class="col-sm-2 control-label">Nombre Institución</label>
<div class="col-sm-8">
    <input class="form-control" placeholder="Digita Nombre Institución" name="nombre_institucion" ng-model="nombre_institucion" required></input>
    <span class="label label-danger" ng-show="frm.nombre_institucion.$dirty && frm.nombre_institucion.$error.required">Requerido</span>
</div>
</div>



<div class="form-group">
<label for="note" class="col-sm-2 control-label">Código Dane</label>
<div class="col-sm-8">
    <input class="form-control" placeholder="Digita Código Dane" name="nombre_comuna" ng-model="codigo_dane" required></input>
    <span class="label label-danger" ng-show="frm.codigo_dane.$dirty && frm.codigo_dane.$error.required">Requerido</span>
</div>
</div>


<div class="form-group">
<label for="note" class="col-sm-2 control-label">Telefono</label>
<div class="col-sm-8">
    <input class="form-control" placeholder="Telefono" name="telefono" ng-model="telefono" required></input>
    <span class="label label-danger" ng-show="frm.telefono.$dirty && frm.telefono.$error.required">Requerido</span>
</div>
</div>


<div class="form-group">
<label for="note" class="col-sm-2 control-label">Dirección</label>
<div class="col-sm-8">
    <input class="form-control" placeholder="Digita Dirección" name="direccion" ng-model="direccion" required></input>
    <span class="label label-danger" ng-show="frm.direccion.$dirty && frm.direccion.$error.required">Requerido</span>
</div>
</div>


<div class="form-group">
<label for="note" class="col-sm-2 control-label">Nombre Rector</label>
<div class="col-sm-8">
    <input class="form-control" placeholder="Digita Nombre Rector" name="nombre_rector" ng-model="nombre_rector" required></input>
    <span class="label label-danger" ng-show="frm.nombre_rector.$dirty && frm.nombre_rector.$error.required">Requerido</span>
</div>
</div>


<div class="form-group">
<label for="note" class="col-sm-2 control-label">Barrios</label>
 <div class="col-sm-6">

  <ui-select ng-model="person.id" theme="select2" ng-disabled="disabled" style="min-width: 300px;">
    <ui-select-match placeholder="Busqueda Barrio con su respectiva Comuna">Barrio: @{{$select.selected.nombre_barrio}} Comuna: @{{$select.selected.nombre_comuna}} </ui-select-match>
    <ui-select-choices repeat="person in people | propsFilter: {nombre_comuna: $select.search, nombre_barrio: $select.search}">
      <div ng-bind-html="person.nombre_barrio | highlight: $select.search"></div>
      <small>
        Barrio:  @{{ person.nombre_barrio }}
        Comuna: @{{person.nombre_comuna}}    
      </small>
    </ui-select-choices>
  </ui-select>
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

 <button type="submit" class="btn btn-success" ng-click="formsubmit(frm.$valid)"  ng-disabled="frm.$invalid"><i class="fa fa-save"></i>&nbsp;&nbsp;Guardar Institución</button>

 <a href="{{url('/admin/postinstituciones#/admin/postinstituciones')}}" type="submit" class="btn btn-orange"><i class="fa fa-reply-all"></i>&nbsp;&nbsp;Atras</a>


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



