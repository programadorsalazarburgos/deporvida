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
<li class="active"><a href="#details" data-toggle="tab" aria-expanded="false">Formulario Crear Comuna</a></li>
</ul>
<div class="tab-content">
<div id="resultados_ajax"></div>
<div class="tab-pane active" id="details">
<div class="clearfix"></div>
<br>


<div class="form-group">
<label for="note" class="col-sm-2 control-label">Código Comuna</label>
<div class="col-sm-8">
    <input class="form-control" placeholder="Digita Código Comuna" name="codigo_comuna" ng-model="codigo_comuna" required></input>
    <span class="label label-danger" ng-show="frm.codigo_comuna.$dirty && frm.codigo_comuna.$error.required">Requerido</span>
</div>
</div>



<div class="form-group">
<label for="note" class="col-sm-2 control-label">Nombre Comuna</label>
<div class="col-sm-8">
    <input class="form-control" placeholder="Digita Nombre Comuna" name="nombre_comuna" ng-model="nombre_comuna" required></input>
    <span class="label label-danger" ng-show="frm.nombre_comuna.$dirty && frm.nombre_comuna.$error.required">Requerido</span>
</div>
</div>

<div class="form-group">
<label for="note" class="col-sm-2 control-label">Zonas</label>
 <div class="col-sm-6">

<select name="zona" ng-model="zona" class="form-control" required>
    <option value="">Seleccione Zona</option>
    <option ng-repeat="zona in zonas" value="@{{ zona.id }}">@{{ zona.nombre_zona }}</option>

</select>
<span class="label label-danger" ng-show="frm.zona.$dirty && frm.zona.$error.required">Requerido</span>
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

 <button type="submit" class="btn btn-success" ng-click="formsubmit(frm.$valid)"  ng-disabled="frm.$invalid"><i class="fa fa-save"></i>&nbsp;&nbsp;Guardar Comuna</button>

 <a href="{{url('/admin/postcomunas#/admin/postcomunas')}}" type="submit" class="btn btn-orange"><i class="fa fa-reply-all"></i>&nbsp;&nbsp;Atras</a>


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



