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
<div class="col-md-3">
<div class="cajabox cajabox-primary">
<div class="cajabox-body cajabox-profile">
<div id="load_img">
<img class=" img-responsive" src="{{ asset('/noticias/img/noticias.png') }}" alt="Bussines profile picture">
<br>
<br>
<div class="container">
<a href="/admin/postitemssolicitud#/admin/postitemssolicitud" class="btn btn-success"><i class="fa fa-home"></i>&nbsp;&nbsp;Vista Principal Item Solicitud </a>
</div>
</div>
<h3 class="profile-username text-center"></h3>
<p class="text-muted text-center mail-text"></p>
</div>
</div>
</div>

<div class="col-md-8">
<form class="form-horizontal" id="f1" name="frm">
<div class="nav-tabs-custom">
<ul class="nav nav-tabs">
<li class="active"><a href="#details" data-toggle="tab" aria-expanded="false">Formulario Creación</a></li>
</ul>
<div class="tab-content">
<div id="resultados_ajax"></div>
<div class="tab-pane active" id="details">
<div class="clearfix"></div>
<br>


<div class="form-group">
<label for="note" class="col-sm-2 control-label">Descripción Item Solicitud</label>
<div class="col-sm-10">
    <textarea class="form-control" name="descripcion" ng-model="descripcion" required></textarea>
    <span class="label label-danger" ng-show="frm.descripcion.$dirty && frm.descripcion.$error.required">Requerido</span>
</div>
</div>


<div class="form-group">
<label for="note" class="col-sm-2 control-label">Tipo Solicitud</label>
 <div class="col-sm-6">

<select name="tiposolicitud" ng-model="tiposolicitud" class="form-control" required>
    <option value="">Seleccione Tipo Solicitud</option>
    <option ng-repeat="tiposolicitud in tipossolicitud" value="@{{ tiposolicitud.id }}">@{{ tiposolicitud.nombre }}</option>

</select>
<span class="label label-danger" ng-show="frm.tiposolicitud.$dirty && frm.tiposolicitud.$error.required">Requerido</span>
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


 <button type="submit" class="btn btn-orange" ng-click="formsubmit(frm.$valid)"  ng-disabled="frm.$invalid"><i class="fa fa-save"></i>&nbsp;&nbsp;Guardar Item Solicitud</button>



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



