@extends('angular.frontend.master')
@section('title', 'Inventario Fisico')
@section('content')
<script>
    $(function ()
    {
        
        $("td input#enfisico").keyup(function() {                
                var filaactual = $(this).closest('tr'); //.index();
                var bodega = filaactual.find('input#enbodega').val();
                var fisico = filaactual.find('input#enfisico').val();

                filaactual.find('input#diferencia').val(bodega - fisico);                
        });

        $('#responsable_user_id').val({{$inventario->responsable_user_id}});
        $('#responsable_user_id').select2();

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

            console.log(detalles)

            var id = $('#id').val();
            var fecha = $('#fecha').val();
            var responsable_user_id = $('#responsable_user_id').val();
            var observaciones = $('#observaciones').val();

            console.log(id)
            var data = {
                'fecha': fecha,
                'responsable_user_id': responsable_user_id,
                'observaciones': observaciones,
                'elementos': detalles 
            }  

            $.ajax({
                url: base + '/admin/inventariofisico/update/'+id,
                type: 'POST',
                data: data,
                contentType: 'application/x-www-form-urlencoded',
                success: function (data)
                {
                    $('body,html').animate({scrollTop: 0}, 500);
                    swal("Modificado!", "Registro Actualizado.", "success");
                    window.location = base + '/admin/inventariofisico';
                }
            });

        });
    });

</script>

<div class="container">
    <ul id="tableactiondTab" class="nav nav-tabs">
        <li class="active">
            <a href="#table-table-tab" data-toggle="tab">Inventario Fisico</a>
        </li>
    </ul>
    <div id="tableactionTabContent" class="tab-content">
        <div class="container-fluid">
            <legend>Modificar Inventario Fisico</legend>
            <form id="inventario_form">
                <input type="hidden" name="id" id="id" value="{{$inventario->id}}">
                <div class="col-md-12">
                    <label><i class="required">*</i> Fecha</label>
                    <input type="date" value="{{$inventario->fecha}}" name="fecha" id="fecha" class="form form-control" required="required"/>
                </div>
                <div class="col-md-12">
                    <label><i class="required">*</i> Responsable</label>
                    <select name="responsable_user_id" id="responsable_user_id" class="form form-control" required="required">
                        <option value="">Seleccione Usuario</option>
                        @foreach($usuario as $temp)
                        <option value="{{$temp->id}}">{{$temp->primer_nombre}} {{$temp->primer_apellido}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12">
                    <label><i class="required">*</i> Observaciones</label>
                    <textarea name="observaciones" id="observaciones" rows="10" class="form form-control">{{$inventario->observaciones}}</textarea>
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
                                        <input type="hidden" name="implemento_id" id="implemento_id" value="{{$data->id}}">
                                    </td>
                                    <td>
                                        <div class="row"> 
                                            <div class="col-sm-12 rango">
                                                <select name="clasificacion_id" class="form form-control" required="required">
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
                                                <input type="text" id="implemento" name="implemento" class="form-control input-sm" readonly="readonly" value="{{$data->nombre}}">
                                            </div>
                                        </div>                                        
                                    </td>
                                    <td>
                                        <div class="row"> 
                                            <div class="col-sm-12 rango">
                                                <select name="responsable_user_id" class="form form-control" required="required">
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
                                                <input type="number" id="enbodega" name="enbodega" class="form-control input-sm" value="{{$data->stock}}">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row"> 
                                            <div class="col-sm-12 rango">
                                                <input type="number" id="enfisico" 
                                                @foreach($detalles as $temp)
                                                @if($data->id==$temp->implemento_id)
                                                value="{{$temp->enfisico}}"
                                                @endif
                                                @endforeach
                                                name="enfisico" class="form-control input-sm">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row"> 
                                            <div class="col-sm-12 rango">
                                                <input type="number" id="diferencia" 
                                                @foreach($detalles as $temp)
                                                @if($data->id==$temp->implemento_id)
                                                value="{{$temp->diferencia}}"
                                                @endif
                                                @endforeach
                                                name="diferencia" class="form-control input-sm" readonly="true">
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
                    <a href="{{url('/admin/inventariofisico')}}" class="btn btn-orange"><i class="fa fa-reply-all"></i>&nbsp;&nbsp;Atras</a>

                </div>
            <form>
        </div>
    </div>
</div>
@stop