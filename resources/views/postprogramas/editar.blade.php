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
<div class="col-md-10">
<form class="form-horizontal" id="f1" name="frm" submit="submitForm()" novalidate>
<div class="nav-tabs-custom">
<ul class="nav nav-tabs">
<li class="active"><a href="#details" data-toggle="tab" aria-expanded="false">Formulario Editar Programa</a></li>
</ul>
<div class="tab-content">
<div id="resultados_ajax"></div>
<div class="tab-pane active" id="details">
<div class="clearfix"></div>
<br>
<div class="form-group">
<label for="note" class="col-sm-2 control-label">Nombre Programa</label>
<div class="col-sm-8">
    <input class="form-control" placeholder="Digita Nombre Programa" name="nombre_programa" value="@{{nombre_programa}}" ng-model="serie.nombre_programa" required></input>
    <span class="label label-danger" ng-show="frm.nombre_programa.$dirty && frm.nombre_programa.$error.required">Requerido</span>
</div>
</div>

<div class="form-group">
<label for="note" class="col-sm-2 control-label">Descripción Programa</label>
<div class="col-sm-8">
    <textarea class="form-control" placeholder="Digita Descripción Programa" name="descripcion_programa" value="@{{descripcion_programa}}" ng-model="serie.descripcion_programa" required></textarea>
    <span class="label label-danger" ng-show="frm.descripcion_programa.$dirty && frm.descripcion_programa.$error.required">Requerido</span>
</div>
</div>


<div class="form-group">
  <div class="col-md-1">
    <img class="img-responsive" ng-model="serie.image" src="/@{{ image }}">
  </div>
  </div>

  <img src="/@{{ serie.image }}" alt="Product Image" ng-model="serie.image" class="img-rounded" style="width: 60px; height: 60px;">

<div class="form-group">
<label for="note" class="col-sm-2 control-label">Imagen Articulo</label>
 <div class="col-sm-6">
 <input type="file" file-model="myFile" class="img-responsive"/><br /><br />


 </div>
</div>
</div>

<div class="clearfix"></div>
<br>
<div class="form-group">
 <div class="col-sm-6">
<div ng-show="loading" id="cargando" class="loading"><img src="{{ asset('/images/cargando.gif') }}" style="width: 160px; height: 160px;">LOADING...</div>
<div ng-repeat="car in cars">
  <li></li>
</div>

 <button type="submit" class="btn btn-success" ng-click="formsubmit(serie.id, frm.$valid)"  ng-disabled="frm.$invalid"><i class="fa fa-save"></i>&nbsp;&nbsp;Actualizar Programa</button>

 <a href="{{url('/admin/postprogramas#/admin/postprogramas')}}" type="submit" class="btn btn-orange"><i class="fa fa-reply-all"></i>&nbsp;&nbsp;Atras</a>


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



