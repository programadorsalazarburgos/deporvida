@extends('angular.frontend.master')
@section('title', 'Carga DCP')
@section('content')
<style>
        .code {
            height: 80px !important;
        }

        textarea.ng-invalid.ng-dirty{border:1px solid red;}
        select.ng-invalid.ng-dirty{border:1px solid red;}
        option.ng-invalid.ng-dirty{border:1px solid red;}
        input.ng-invalid.ng-dirty{border:1px solid red;}

</style>
<script type="text/javascript">
    $(function()
    {
        $('#nombre_tipo_escenario').keyup(function()
        {
            if($(this).val().length >0)
            {
                $('#save').removeAttr('disabled');
            }
            else
            {
                $('#save').attr('disabled','disabled');
            }
        });
        $('form').submit(function(e)
        {
            e.preventDefault();
            $.ajax({
                url:$(this).attr('action'),
                type:'POST',
                data:$(this).serialize(),
                success:function(data)
                {
                    swal("Guardado!", "Registro editado.", "success");
                    window.setTimeout(function(){window.location.href = base+"/admin/posttipoescenarios#/admin/posttipoescenarios";},2000);
                }
            })
        });
    })
</script>
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
<form action="{{url('')}}/api/v0/posttipoescenario/create" method="post" class="form-horizontal" id="f1" name="frm" novalidate>
<div class="nav-tabs-custom">
<ul class="nav nav-tabs">
<li class="active"><a href="#details" data-toggle="tab" aria-expanded="false">Formulario Creación Tipo Escenario</a></li>
</ul>
<div class="tab-content">
<div id="resultados_ajax"></div>
<div class="tab-pane active" id="details">
<div class="clearfix"></div>
<br>


<div class="form-group">
<label for="note" class="col-sm-2 control-label">Nombre Tipo Escenario</label>
<div class="col-sm-8">
    <input class="form-control" placeholder="Digita Nombre Tipo Escenario" name="nombre_tipo_escenario" id="nombre_tipo_escenario" required></input>
</div>
</div>


<div class="clearfix"></div>
<br>
<div class="form-group">
 <div class="col-sm-6">

 <button  id="save" disabled="disabled" type="submit" class="btn btn-success">
    <i class="fa fa-save"></i>&nbsp;&nbsp;Guardar Tipo Escenario
</button>

 <a href="{{url('/admin/posttipoescenarios#/admin/posttipoescenarios')}}" type="submit" class="btn btn-orange"><i class="fa fa-reply-all"></i>&nbsp;&nbsp;Atras</a>


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



@stop