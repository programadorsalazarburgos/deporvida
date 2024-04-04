@extends('angular.frontend.master')
@section('title', 'Grupos')
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
                    <form class="form-horizontal" id="f1" name="frm" >
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
                                        <label for="note" class="col-sm-2 control-label">Nueva contraseña</label>
                                        <div class="col-sm-8">
                                            <input id="pass1" name="pass1" type="password" class="form-control" name="password" title="No puede dejar la contraseña vacia" required="required"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="note" class="col-sm-2 control-label">Confirmar la contraseña</label>
                                        <div class="col-sm-8">
                                            <input id="pass2" name="pass2" type="password" class="form-control" name="password_confirmation" required="required"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <br>
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <button  type="submit"  class="btn btn-success"><i class="fa fa-save"></i>&nbsp;&nbsp;Actualizar Password</button>
                                        <a href="javascript:history.back(1)" type="submit" class="btn btn-orange"><i class="fa fa-reply-all"></i>&nbsp;&nbsp;Atras</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
<script>
    $(function ()
    {
        $('form').validate();
        $('form').submit(function (e)
        {
            e.preventDefault();
            if($(this).valid())
            {
                if ($.trim($('#pass1').val()) === $.trim($('#pass2').val()))
                {
                    $.ajax({
                        url: base + '/usuario/passguardar',
                        type: 'POST',
                        data: $('form').serialize(),
                        dataType: 'json',
                        success: function (data, textStatus, jqXHR) {
                            if (data.validate)
                            {
                                swal("Guardado", "Su contraseña ha sido modificada con éxito.", "success");
                            } else
                            {
                                swal("Error", "Se ha presentado un error.", "error");
                                console.log(data.msj);
                            }
                        }
                    });
                } else
                {
                    swal("Error", "Las contraseñas no coinciden.", "error");
                }
            }
        });
    });
</script>
<!-- AQUI VA TODO EL CONTENDIDO -->
@stop