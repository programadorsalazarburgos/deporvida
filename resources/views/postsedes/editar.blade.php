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
<li class="active"><a href="#details" data-toggle="tab" aria-expanded="false">Formulario Editar Sede</a></li>
</ul>
<div class="tab-content">
<div id="resultados_ajax"></div>
<div class="tab-pane active" id="details">
<div class="clearfix"></div>
<br>


<div class="form-group">
<label for="note" class="col-sm-2 control-label">Institucion</label>
 <div class="col-sm-6">
  <select class="form-control" name="institucion" id="institucion" required ng-change="unitChanged()" ng-model="data.unit" ng-options="unit.id as unit.nombre_institucion for unit in instituciones"></select>

  </div>
</div>


<div class="form-group">
<label for="note" class="col-sm-2 control-label">Literal</label>
<div class="col-sm-8">
    <input class="form-control" placeholder="Digita Literal" name="literal" value="@{{literal}}" ng-model="serie.literal" required></input>
    <span class="label label-danger" ng-show="frm.literal.$dirty && frm.literal.$error.required">Requerido</span>
</div>
</div>



<div class="form-group">
<label for="note" class="col-sm-2 control-label">Nombre Sede</label>
<div class="col-sm-8">
    <input class="form-control" placeholder="Digita Nombre Sede" name="nombre_sede" value="@{{nombre_sede}}" ng-model="serie.nombre_sede" required></input>
    <span class="label label-danger" ng-show="frm.nombre_sede.$dirty && frm.nombre_sede.$error.required">Requerido</span>
</div>
</div>



<div class="form-group">
<label for="note" class="col-sm-2 control-label">Direccion Sede</label>
<div class="col-sm-8">
    <input class="form-control" placeholder="Digita Direccion Sede" name="direccion" value="@{{direccion}}" ng-model="serie.direccion" required></input>
    <span class="label label-danger" ng-show="frm.direccion.$dirty && frm.direccion.$error.required">Requerido</span>
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

 <button type="submit" class="btn btn-success" ng-click="formsubmit(serie.id, frm.$valid)"  ng-disabled="frm.$invalid"><i class="fa fa-save"></i>&nbsp;&nbsp;Actualizar Sede</button>

 <a href="{{url('/admin/postsedes#/admin/postsedes')}}" type="submit" class="btn btn-orange"><i class="fa fa-reply-all"></i>&nbsp;&nbsp;Atras</a>


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



