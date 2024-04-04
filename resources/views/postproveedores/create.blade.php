@extends('angular.frontend.master')
@section('title', 'Registro de proveedores')
@section('content')
<script type="text/javascript" src="js/functions.js"></script>
<script type="text/javascript" src="{{url('')}}/js/GeneratorAdd.js<?php echo '?v='.date('YmdHis');?>"></script>
<style>
    input[type=number]::-webkit-inner-spin-button, 
    input[type=number]::-webkit-outer-spin-button { 
        -webkit-appearance: none; 
        margin: 0; 
    }

    input[type=number] { -moz-appearance:textfield; }
    input{text-transform: uppercase;}
    .dir_format{
        width: 100%;
    }
    .row{
        padding-top: 10px;
    }
    .data_hide{
        display: none !important;
    }
</style>
<script>
    $(function ()
    {
        $('#direccion').add_generator({
            direccion: 'direccion'
        });
        $('#proveedor_form').submit(function (e)
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
                url: base + '/admin/proveedor/save',
                type: 'POST',
                data: data, //$(this).serialize(),
                contentType: 'application/x-www-form-urlencoded',
                success: function (data)
                {
                    $('body,html').animate({scrollTop: 0}, 500);
                    swal("Almacenado!", "Proveedor Guardado.", "success");
                    window.location = base + '/admin/proveedor';
                }
            });
        });
    });
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

    function eliminafila()
    {
        var numeroFilas = $('#table_contrato tr').length;
        console.log()
        if(numeroFilas>2){ 
            $("#table tr").remove();
            //$(this).closest(‘tr’).remove(); 
        }
    }

</script>

<div class="container">
    <ul id="tableactiondTab" class="nav nav-tabs">
        <li class="active"><a href="#table-table-tab" data-toggle="tab">Proveedores<strong></strong></a></li>
    </ul>

    <div id="tableactionTabContent" class="tab-content">
        <div id="log"></div>
        <form id="proveedor_form">
            <fieldset>
                <div class="col-md-12">
                    <span class="text-danger">*</span>
                    <label class="control-label" for="proveedor-nombre">Nombre</label>
                    <input value=""  type="text" title="Solo texto" id="nombre" class="form-control" name="nombre" maxlength="200" required="true"/>
                </div>              
                <div class="col-md-6">
                    <label class="control-label" for="proveedor-telefono">Telefono</label>
                    <input value=""  type="text" title="Solo texto" id="telefono" class="form-control" name="telefono" maxlength="20" >
                </div>
                <div class="col-md-6">
                    <label class="control-label" for="proveedor-correo">Correo Electrónico</label>
                    <input value=""  type="email" title="Solo texto" id="correo" class="form-control" name="correo" maxlength="100">
                </div>
                <div class="col-md-12">
                    <label class="control-label" for="proveedor-direccion">Dirección</label>
                    <input value=""  type="text" title="Solo texto" id="direccion" class="form-control" name="direccion" maxlength="60" >
                </div>
                <div class="col-md-12">
                    <label class="control-label" for="proveedor-observaciones">Observaciones</label>
                    <input value=""  type="text" title="Solo texto" id="observaciones" class="form-control" name="observaciones" maxlength="250" >
                </div>
                <div class="clearfix"></div>
                <br>
                <div class="col-md-12">
                    <div class="table">
                        <table id="table_contrato" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Contrato No.</th>
                                    <th>Descripción</th>
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
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
                            </tbody>
                        </table>    
                    </div>
                    <div class="row" style="float: right;">
                        <a type="submit" value="Agregar Contrato" onclick="agregarfila()" class="btn btn-warning"><i class="fa fa-plus"></i> Agregar Contrato</a>
                    </div>
                <div class="clearfix"></div>
                <br>
                <fieldset>
                  <div class="col-md-6">
                    <button class="btn btn-success">Guardar</button>            
                  </div>  
                </fieldset>
                </div>
            </fieldset>
            
        </form>
    </div>
</div>
@stop