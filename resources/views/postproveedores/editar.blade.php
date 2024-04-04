@extends('angular.frontend.master')
@section('title', 'Modificar proveedor')
@section('content')
<script type="text/javascript" src="js/functions.js"></script>

<style>
.code {
height: 80px !important;
}

</style>

<script>
$(function ()
{
    $('#form_edit_proveedor').submit(function (e)
    {
        e.preventDefault();
        var contratos=[];
        var parame=[];
        $("table tbody tr").each(function(i,e){
        
            var tr = [];
            $(this).find("td").each(function(index, element){
                if(index != 3) 
                {
                    var td = {};
                    td= $(this).find("input").val();
                    tr.push(td);
                }
            });
            contratos.push(tr);    
        });

        var id = $('#id').val();
        var nombre = $('#nombre').val();
        var telefono = $('#telefono').val();
        var correo = $('#correo').val();
        var direccion = $('#direccion').val();
        var observaciones = $('#observaciones').val();

        var data = {
            'nombre': nombre, //$(this).serialize(),
            'telefono': telefono,
            'correo': correo,
            'direccion': direccion,
            'observaciones': observaciones,
            'contratos': contratos 
        }

        $.ajax({
            url: base+'/admin/proveedor/update/'+id,
            data: data, //$(this).serialize(),
            type: 'POST',
            contentType: 'application/x-www-form-urlencoded',
            success: function (data)
            {
                console.log(data);
                swal("Editado", "Se ha editado con exito.", "success");
                window.location = base + '/admin/proveedor';
            }
        });
    });

})

    var i=2;
    function agregarfila()
    {
        $clone=$("table tbody tr:first").clone();
        $clone.find(".fecha").attr('id','fecha_'+i);
        $clone.find(".fecha").removeAttr('readonly').removeAttr('style').removeClass('hasDatepicker');
        $clone.find("input").each(function(){
           $(this).val("");
        });
        $("table tbody").append($clone);
        fecha_datepiker();
        i++;
    }


</script>


<div class = 'container'>
<div class="content-wrapper">

<div class="row">

<form class="form-horizontal" id="form_edit_proveedor" name="form_proveedor" >
<input type="hidden" name="id" id="id" value="{{ $proveedor->id}}">
<div class="col-md-12">
    <div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#details" data-toggle="tab" aria-expanded="false">Modificar datos del Proveedor</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="details">
            <div class="clearfix"></div>
            <br>
            <fieldset>
                <div class="col-md-12">
                    <span class="text-danger">*</span>
                    <label class="control-label" for="proveedor-nombre">Nombre</label>
                    <input value="{{ $proveedor->nombre }}"  type="text" title="Solo texto" id="nombre" class="form-control" name="nombre" maxlength="200" required="true" />
                </div>              
                <div class="col-md-6">
                    <label class="control-label" for="proveedor-telefono">Telefono</label>
                    <input value="{{ $proveedor->telefono }}"  type="text" title="Solo texto" id="telefono" class="form-control" name="telefono" maxlength="20"  >
                </div>
                <div class="col-md-6">
                    <label class="control-label" for="proveedor-correo">Correo Electrónico</label>
                    <input value="{{ $proveedor->correo }}"  type="email" title="Solo texto" id="correo" class="form-control" name="correo" maxlength="100" >
                </div>
                <div class="col-md-12">
                    <label class="control-label" for="proveedor-direccion">Dirección</label>
                    <input value="{{ $proveedor->direccion }}"  type="text" title="Solo texto" id="direccion" class="form-control" name="direccion" maxlength="60" >
                </div>
                <div class="col-md-12">
                    <label class="control-label" for="proveedor-observaciones">Observaciones</label>
                    <input value="{{ $proveedor->observaciones }}"  type="text" title="Solo texto" id="observaciones" class="form-control" name="observaciones" maxlength="250" >
                </div>
                <div class="col-md-12">
                    <div class="table">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Contrato No.</th>
                                    <th>Objeto del contrato</th>
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($contratos->count())
                                    @foreach($contratos as $temp)
                                    <tr>
                                        <td>
                                            <div class="row"> 
                                                <div class="col-sm-12 rango">
                                                    <input type="text" value="{{ $temp->no}}" id="contrato" name="contrato" class="form-control input-sm">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row"> 
                                                <div class="col-sm-12 rango">
                                                    <input type="text" value="{{ $temp->descripcion}}"  id="descripcion" name="descripcion" class="form-control input-sm">
                                                </div>
                                            </div>                                        
                                        </td>
                                        <td>
                                            <div class="row"> 
                                                <div class="col-sm-12 rango">
                                                    <input type="date" value="{{ $temp->fecha}}" id="fecha" name="fecha" class="form-control input-sm">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else 
                                    <tr>
                                        <td>
                                            <div class="row"> 
                                                <div class="col-sm-12 rango">
                                                    <input type="text" id="contrato" name="contrato" class="form-control input-sm">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row"> 
                                                <div class="col-sm-12 rango">
                                                    <input type="text" id="descripcion" name="descripcion" class="form-control input-sm">
                                                </div>
                                            </div>                                        
                                        </td>
                                        <td>
                                            <div class="row"> 
                                                <div class="col-sm-12 rango">
                                                    <input type="date" id="fecha_1" name="fecha" class="fecha form-control input-sm">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>    
                    </div>
                    <div class="row" style="float: right;">
                        <a type="submit" value="Agregar Contrato" onclick="agregarfila()" class="btn btn-warning"><i class="fa fa-plus"></i> Agregar Contrato</a>
                    </div>
                </div>         

                <div class="clearfix"></div>
                <br>
                <div class="col-sm-6">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-save"></i>&nbsp;&nbsp;Guardar</button>
                    <a href="{{url('/admin/proveedor')}}" class="btn btn-orange"><i class="fa fa-reply-all"></i>&nbsp;&nbsp;Atras</a>
                </div>
            </fieldset>
        </div>
    </div>
    </div>
</div>
</form>

</div>
</div>
</div>

@stop