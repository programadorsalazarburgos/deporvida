@extends('angular.frontend.master')
@section('title', 'Inventario Fisico')
@section('content')
<script type="text/javascript" src="{{url('')}}/js/implementodds.create.js"></script>
<script>
    $(function ()
    {
            
            $('#responsable_user_id').select2();

            $("input#diferencia").val(0);

            $("td input#enfisico").keyup(function() {                
                var filaactual = $(this).closest('tr'); //.index();
                
                var bodega = filaactual.find('input#enbodega').val();
                var fisico = filaactual.find('input#enfisico').val();

                filaactual.find('input#diferencia').val(bodega - fisico);                

            });


        $('#inventario_form').submit(function (e)
        {
            e.preventDefault();

            var detalles=[];
            var parame=[];
            $("table tbody tr").each(function(i,e){
            
                var tr = [];
                $(this).find("td").each(function(index, element){
                        var td = {};
                        td= $(this).find("input").val()+$(this).find("select").val();
                        td = td.replace("undefined","");                        
                        td = parseInt(td);
                        tr.push(td);
                 });
                detalles.push(tr);    
            });
            
            var fecha = $('#fecha').val();
            var responsable_user_id = $('#responsable_user_id').val();
            var observaciones = $('#observaciones').val();

            var data = {
                'fecha': fecha,
                'responsable_user_id': responsable_user_id,
                'observaciones': observaciones,
                'detalles': detalles 
            }  

            $.ajax({
                url: base + '/admin/inventariofisico/save',
                type: 'POST',
                data: data,
                contentType: 'application/x-www-form-urlencoded',
                success: function (data)
                {
                    $('body,html').animate({scrollTop: 0}, 500);
                    swal("Almacenado!", "Proveedor Guardado.", "success");
                    window.location = base + '/admin/inventariofisico';
                }
            });

        });
    });

</script>
<style type="text/css">
    .disable_data{
        background-color: #FFF !important;
        cursor: default !important;
    }

    #diferencia, #descripcion, #enbodega{
        background-color: #FFF;
    }
</style>
<div class="container">
    <ul id="tableactiondTab" class="nav nav-tabs">
        <li class="active">
        	<a href="#table-table-tab" data-toggle="tab">Inventario Fisico</a>
        </li>
    </ul>
    <div id="tableactionTabContent" class="tab-content">
    	<div class="container-fluid">
            <legend>Inventario Fisico</legend>
            <form id="inventario_form">
                <div class="col-md-12">
                    <label><i class="required">*</i> Fecha</label>
                    <input type="date" name="fecha" id="fecha" class="fecha form form-control" value="<?php echo date('Y-m-d', strtotime(date('Y/m/d'))); ?>" required="required"/>
                </div>
                <div class="col-md-12">
                    <label><i class="required">*</i> Responsable</label>
                    <select name="responsable_user_id" id="responsable_user_id" class="form form-control" required="required">
                        <option value="">Seleccione Usuario</option>

                        @foreach($usuario as $temp)
                        <option value="{{$temp->id}}">{{$temp->numero_documento}} - {{$temp->primer_nombre}} {{$temp->segundo_nombre}} {{$temp->primer_apellido}} {{$temp->segundo_apellido}} </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12">
                    <label><i class="required">*</i> Observaciones</label>
                    <textarea name="observaciones" id="observaciones" rows="10" class="form form-control"> </textarea>
                </div>
                <div class="clearfix"></div>
                <br>
                <div class="col-md-12">
                    <div class="table">
                        <table id="table_contrato" class="table table-striped">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Clasificación</th>
                                    <th>Nombre Implemento</th>
                                    <th>Proveedor</th>
                                    <th width="10%">Stock (En Bodega)</th>
                                    <th width="10%">En Fisico</th>
                                    <th width="10%">Diferencia</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($implementos as $data)
                                <tr>
                                    <td>
                                        <input type="hidden" name="implemento" value="{{$data->id}}">
                                    </td>
                                    <td>
                                        <div class="row"> 
                                            <div class="col-sm-12 rango">
                                                <select disabled="true" name="responsable_user_id" class="form form-control disable_data" required="required" readonly="true">
                                                    <option value="">Seleccionar</option>
                                                    @foreach($clasificacion as $temp)
                                                    <option
                                                    @if($temp->id==$data->clasificacion_id)
                                                    selected
                                                    @endif
                                                     value="{{$temp->id}}">{{$temp->nombre}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row"> 
                                            <div class="col-sm-12 rango">
                                                <input type="text" id="descripcion" name="descripcion" class="form-control input-sm" readonly="readonly" value="{{$data->nombre}}">
                                            </div>
                                        </div>                                        
                                    </td>
                                    <td>
                                        <div class="row"> 
                                            <div class="col-sm-12 rango">
                                                <select disabled="true" name="responsable_user_id" class="disable_data form form-control" required="required">
                                                    <option value="">Seleccionar</option>
                                                    @foreach($proveedor as $temp)
                                                    <option
                                                    @if($temp->id==$data->proveedor_id)
                                                    selected
                                                    @endif
                                                      value="{{$temp->id}}">{{$temp->nombre}} asd</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row"> 
                                            <div class="col-sm-12 rango">
                                                <input type="number" id="enbodega" name="enbodega" class="form-control input-sm" value="{{$data->stock}}" readonly="true">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row"> 
                                            <div class="col-sm-12 rango">
                                                <input type="number" id="enfisico" name="enfisico" class="form-control input-sm">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row"> 
                                            <div class="col-sm-12 rango">
                                                <input type="number" id="diferencia" name="diferencia" class="form-control input-sm" readonly="true">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                    @endforeach
                            </tbody>
                        </table>    
                    </div>                
                <div class="col-md-12 row">
                    <button id="submit_button" type="submit" class="btn btn-success"><i class="fa fa-save"></i> Guardar</button>
                </div>
            <form>
    	</div>
    </div>
</div>
@stop