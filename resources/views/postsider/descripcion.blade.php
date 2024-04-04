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



<div class="page-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="portlet box">
                <div class="portlet-header">
                <h5><strong>PROGRAMA @{{ serie.nombre_programa | uppercase }}</strong></h5>


<div id="tab-activity" class="tab-pane fade in active">
          <ul class="list-activity list-unstyled">
            <li>
         <div class="avatar"><img data-ng-src="@{{serie.image}}" class="img-circle" style="width: 89px; height: 82px; display: inline-block;">
        </div>
        <div class="body">
        <br>

         </div>
          <div class="content"><strong style="color: #039be5;">Descripción del Programa</strong>
        <p align="justify">@{{ serie.descripcion_programa }}</p>
            </div>
             </div>
           </li>
 </ul>
 </div>
 <div class="row nav">    
        <div class="col-md-4"></div>
        <div class="col-md-8 col-xs-12" style="margin: 0px;padding: 0px;">
          
            <div class="col-md-4 col-xs-4 well" style="color: #fff;"><i class="fa fa-thumbs-o-up fa-lg"></i> Programa</div>
        </div>
    </div>

</div>
</div>
</div>
</div>
</div>
    

</div>




