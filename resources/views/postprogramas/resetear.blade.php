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
<li class="active"><a href="#details" data-toggle="tab" aria-expanded="false"> Cambio Password Usuario</a></li>
</ul>
<div class="tab-content">
<div id="resultados_ajax"></div>
<div class="tab-pane active" id="details">
<div class="clearfix"></div>
<br>


<div class="form-group">
<label for="note" class="col-sm-2 control-label">Password

</label>
<div class="col-sm-8">

      <input type="password" class="form-control" name="password" ng-model="registerData.password" required />
      <div class="form-errors" ng-messages="frm.password.$error" ng-if='frm.password.$touched'>
        <span class="form-error" ng-message="required">Por favor ingresa el password</span>
      </div>
</div>
</div>

<div class="form-group">
<label for="note" class="col-sm-2 control-label">Password confirmacion
</label>

<div class="col-sm-8">


      <input type="password" class="form-control" name="password_confirmation" ng-model="registerData.password_confirmation" required="" confirm-pwd="registerData.password" />
      <div class="form-errors" ng-messages="autentication_form.password_confirmation.$error" ng-if='autentication_form.password_confirmation.$touched'>
        <span class="form-error" ng-message="required">Password confirmacion required</span>
        <span class="form-error" ng-message="password">Password diferente</span>
      </div>
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



<button ng-disabled="frm.$invalid" ng-click="p(serie.id, frm.$valid)" class="btn btn-success"><i class="fa fa-save"></i>&nbsp;&nbsp;Actualizar Password</button>



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



