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
<li class="active"><a href="#details" data-toggle="tab" aria-expanded="false">Formulario Editar Barrio</a></li>
</ul>
<div class="tab-content">
<div id="resultados_ajax"></div>
<div class="tab-pane active" id="details">
<div class="clearfix"></div>
<br>


<div class="form-group">
<label for="note" class="col-sm-2 control-label">Nombre Barrio</label>
<div class="col-sm-8">
    <input class="form-control" placeholder="Digita Nombre Barrio" name="nombre_barrio" value="@{{nombre_barrio}}" ng-model="serie.nombre_barrio" required></input>
    <span class="label label-danger" ng-show="frm.nombre_barrio.$dirty && frm.nombre_barrio.$error.required">Requerido</span>
</div>
</div>

<div class="form-group">
<label for="note" class="col-sm-2 control-label">Codigo de barrio</label>
 <div class="col-sm-6">

<input name="codigo" ng-model="codigo" class="form-control" required/>
<span class="label label-danger" ng-show="frm.zona.$dirty && frm.zona.$error.required">Requerido</span>
  </div>
</div>


<div class="form-group">
<label for="note" class="col-sm-2 control-label">Comuna</label>
 <div class="col-sm-6">
  <select class="form-control" name="comuna" id="comuna" required ng-change="unitChanged()" ng-model="data.unit" ng-options="unit.id as unit.nombre_comuna for unit in comunas"></select>

  </div>
</div>
<div class="form-group">
<label for="note" class="col-sm-2 control-label">Estrato</label>
 <div class="col-sm-6">
  <select class="form-control" name="id_estrato" ng-model="id_estrato" id="id_estrato" required>
      <option value="">Seleccione</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
      <option value="6">6</option>
      <option value="7">7</option>
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

 <button type="submit" class="btn btn-success" ng-click="formsubmit(serie.id, frm.$valid)"  ng-disabled="frm.$invalid"><i class="fa fa-save"></i>&nbsp;&nbsp;Actualizar Barrio</button>

 <a href="{{url('/admin/postbarrios#/admin/postbarrios')}}" type="submit" class="btn btn-orange"><i class="fa fa-reply-all"></i>&nbsp;&nbsp;Atras</a>


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



