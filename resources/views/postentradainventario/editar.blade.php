@extends('angular.frontend.master')
@section('title', 'Entradas de Inventario')
@section('content')
<script type="text/javascript" src="{{url('')}}/js/implementos.create.jss"></script>
<script>
    $(function ()
    {

        $('#proveedor_id').val( {{$entrada->proveedor_id}} );
        $('#proveedor_id').select2();
        
        $('#implemento_form').submit(function (e)
        {
            e.preventDefault();
            
            var elementos=[];
            var parame=[];
            $("table tbody tr").each(function(i,e){
            
                var tr = [];
                $(this).find("td").each(function(index, element){
                    if(index != 3) 
                    {
                        var td = {};
                        td= $(this).find("select").val() + $(this).find("input").val();
                        td = td.replace("undefined","");                        
                        tr.push(td);
                    }
                });
                elementos.push(tr);    
            });
            
            var id = $('#id').val();
            var fecha = $('#fecha').val();
            var proveedor_id = $('#proveedor_id').val();
            var observaciones = $('#observaciones').val();

            var data = {
                'fecha': fecha, 
                'proveedor_id': proveedor_id,
                'observaciones': observaciones,
                'elementos': elementos 
            }  

            console.log(data)

            $.ajax({
                url: base + '/admin/entradainventario/update/'+id,
                type: 'POST',
                data: data, // $(this).serialize(),
                contentType: 'application/x-www-form-urlencoded',
                success: function (data)
                {
                    $('body,html').animate({scrollTop: 0}, 500);
                    swal("Almacenado!", "Registro Guardado.", "success");
                    window.location = base + '/admin/entradainventario';
                }
            });
        });

        $('#clasificacion_id').change(function() {
            var id = $(this).val();
            $.get(base + '/admin/entradainventario/listarimplementos/'+id, function(data){
                $('#implemento_id').empty();
                $('#implemento_id').append("<option value=''>" +'Selecciona una opción'+ "</option>");
                $.each(data, function(key,element){
                    $('#implemento_id').append("<option value='" +element['id']+ "'>" +element['nombre']+ "</option>");
                });
            });
        });


        $('#agrega_elemento').bind('click', function(){

            $clone=$("table tbody tr:last").clone(true);
            $clone.find("input").each(function(){
                $(this).val("");
            });

            $('#clasificacion_id').attr('id','clasificacion_id_');
            $('#implemento_id').attr('id','implemento_id_');
            $("table tbody").append($clone);         

            $('#implemento_id').empty();
   
        });
    });

</script>
<div class="container">
    <ul id="tableactiondTab" class="nav nav-tabs">
        <li class="active">
        	<a href="#table-table-tab" data-toggle="tab">Entradas de Inventario</a>
        </li>
    </ul>
    <div id="tableactionTabContent" class="tab-content">
    	<div class="container-fluid">
            <legend>Modificar Entrada de Inventario Implemento</legend>
            <form id="implemento_form">
                <input type="hidden" id="id" value="{{$entrada->id}}">
                <div class="col-md-12">
                    <label><i class="required">*</i> Fecha</label>
                    <input type="date" value="{{$entrada->fecha}}" id="fecha" name="fecha" class="form form-control" required="required"/>
                </div>
                <div class="col-md-12">
                    <label><i class="required">*</i> Proveedor</label>
                    <select name="proveedor_id" id="proveedor_id" class="form form-control" required="required">
                        <option value="">Seleccionar</option>
                        @foreach($proveedores as $temp)
                        <option value="{{$temp->id}}">{{$temp->nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12">
                    <label>Observaciones</label>
                    <textarea name="observaciones" id="observaciones" rows="10" class="form form-control">{{$entrada->observaciones}} </textarea>
                </div>
                <div class="col-md-12">
                    <div class="table">
                        <table id="table_contrato" class="table table-striped">
                            <thead>
                                <tr>
                                    <th width="20%">Clasificacion</th>
                                    <th>Nombre Implemento</th>
                                    <th width="10%">Cantidad</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($detalle->count())
                                    @foreach($detalle as $data)
                                        <tr>
                                            <td>
                                                <div class="row"> 
                                                    <select name="clasificacion_id" id="clasificacion_id" class="form form-control" style="margin-left: 10px; width: 90%;">
                                                        @foreach($clasificaciones as $temp)
                                                        <option 
                                                        @if($temp->id == $data->clasificacion_id)
                                                        selected
                                                        @endif
                                                        value="{{$temp->id}}">{{$temp->nombre}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="row"> 
                                                    <select name="implemento_id" id="implemento_id" class="form form-control" style="margin-left: 30px; width: 94%; " >
                                                        @foreach($implementos as $temp)
                                                        <option
                                                        @if($temp->id == $data->implemento_id)
                                                        selected
                                                        @endif
                                                        value="{{$temp->id}}">{{$temp->nombre}}</option>
                                                        @endforeach                     
                                                    </select>
                                                </div>                                        
                                            </td>

                                            <td>
                                                <div class="row"> 
                                                    <div class="col-sm-12 rango">
                                                        <input type="text" value="{{ $data->cantidad}}" id="cantidad" name="cantidad" class="form-control input-sm">
                                                    </div>
                                                </div>
                                            </td>                
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td width="20%">
                                            <div class="row"> 
                                                <select name="clasificacion_id" id="clasificacion_id" class="form form-control" style="margin-left: 10px; width: 90%;">
                                                    <option value="">Seleccionar</option>
                                                    @foreach($clasificaciones as $temp)
                                                    <option value="{{$temp->id}}">{{$temp->nombre}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row"> 
                                                <select name="implemento_id" id="implemento_id" class="form form-control" style="margin-left: 30px; width: 94%; " >                               
                                                </select>
                                            </div>                                        
                                        </td>
                                        <td width="10%">
                                            <div class="row"> 
                                                <div class="col-sm-12 rango">
                                                    <input type="number" id="cantidad" name="cantidad" class="form-control input-sm">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>    
                    </div>
                    <div class="row" style="float: right;">
                        <a type="submit" value="agrega_elemento" id="agrega_elemento" class="btn btn-warning"><i class="fa fa-plus"></i> Agregar Elementos</a>
                    </div>
                <div class="clearfix"></div>
                <br>

                <div class="col-md-12 row">
                    <button id="submit_button" type="submit" class="btn btn-success" style="margin-left: 15px; "><i class="fa fa-save"></i> Guardar</button>
                    <a href="{{url('/admin/entradainventario')}}" class="btn btn-orange"><i class="fa fa-reply-all"></i>&nbsp;&nbsp;Atras</a>

                </div>
            <form>
    	</div>
    </div>
</div>
@stop