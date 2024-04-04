@extends('angular.frontend.master')
@section('title', 'Devoluciones')
@section('content')
<script>
    $(function ()
    {

        var detalles = $('#devprestamo').data('detalle');
        var tabla = '';
        tr = '';

        $.each(detalles, function(key,element){
            $.each(element, function(k,e){
                console.log(e)
                tr += '<tr>';
                tr += '<td><input type="hidden" name="implemento_id" value="'+e["implemento_id"]+'"></td>'+
                '<td>'+e["clasificacion"]+'</td>'+
                '<td>'+e["nombreImplemento"]+'</td>'+
                '<td width="60%">'+e["proveedor"]+'</td>'+
                '<td><strong>'+(parseInt(e["cantidad"]))+'</strong></td>'+
                '<td><strong>'+(parseInt(e["devuelto"]))+'</strong></td>'+
                '<td><input type="number" value="0" name="devuelta" class="form form-control"></td>'+
                '<td><input type="number" value="'+e["dano"]+'" name="daño" class="form form-control"></td>'+
                '<td><input type="number" value="'+e["perdida_robo"]+'" name="robo" class="form form-control"></td>';
                tr += '</tr>';
            });
        });
        tabla += tr;
        $('#devprestamo').html( tabla );


        var usuarios = $('#user_id').data('user_id'); 
        
        var contratista = $('#contratista_user_id').val(); 
        var user = usuarios.find(x => x.documentos === contratista )

        $('#user_id').val(user.id);
        $('#comuna_id').val(user.comunas);
        $('#disciplina').val(user.disciplinas);
        $('#user_id').select2();

        $('#devolucion_form').submit(function (e)
        {
            e.preventDefault();
 
                   var elementos=[];
                    $("table tbody tr").each(function(i,e){            
                        var td = [];
                        $(this).find("td").each(function(index, element){
                            var tr = {};
                            tr= $(this).find("input").val();
                            tr = parseInt(tr);

                            td.push(tr);

                        });
                        elementos.push(td);    
                    });
                    
                    console.log(elementos);

            var id = $('#id').val(); 
            var fecha = $('#fecha').val();
            var contratista_user_id = $('#contratista_user_id').val();
            var observaciones = $('#observaciones').val();
            var comuna_id = $('#comuna_id').val();

            var data = {
                'fecha': fecha, 
                'contratista_user_id': contratista_user_id,
                'observaciones': observaciones,
                'comuna_id': comuna_id,
                'elementos': elementos 
            }  

            $.ajax({
                url: base + '/admin/devolucioninventario/update/'+id,
                type: 'POST',
                data: data, 
                success: function (data)
                {
                    $('body,html').animate({scrollTop: 0}, 500);
                    swal("Actualizado!", "Registro Actualizado.", "success");
                    window.location = base + '/admin/devolucioninventario';
                }
            });

        });

        $('#user_id').change(function(e) {           
            $('#comuna_id').val($('#user_id option:selected').attr('data-comunas'));            
            $('#disciplina').val($('#user_id option:selected').attr('data-disciplinas'));
            $('#contratista_user_id').val($('#user_id option:selected').attr('data-documento'));
            Devolucion_inventario();
        });
    });

    function Devolucion_inventario(){
        var user = $('#contratista_user_id').val();
         
         $.get(base + '/admin/devolucioninventario/prestamos/'+user, function(data){
                var tabla = '';
                    tr = '';

                    $.each(data, function(key,element){
                        $.each(element, function(ke,elem){
                            $.each(elem, function(k,e){
                                tr += '<tr>';
                                tr += '<td><input type="hidden" name="implemento_id" value="'+e["implemento_id"]+'"></td>'+
                                '<td>'+e["clasificacion"]+'</td>'+
                                '<td>'+e["nombreImplemento"]+'</td>'+
                                '<td width="60%">'+e["proveedor"]+'</td>'+
                                '<td><strong>'+(parseInt(e["cantidad"]))+'</strong></td>'+
                                '<td><strong>'+parseInt(e["devuelto"])+'</strong></td>'+
                                '<td><input type="number" value="0" name="devuelta" class="form form-control"></td>'+
                                '<td><input type="number" value="0" name="daño" class="form form-control"></td>'+
                                '<td><input type="number" value="0" name="robo" class="form form-control"></td>';
                                tr += '</tr>';
                            });
                        });
                    });
        
                    tabla += tr;
                $('#devprestamo').html( tabla );
            });
    }

    function agregarclasificacion()
    {
        $clone=$("#clasificacion_0").clone();
        $("#clasificacion_id").attr('id','clasificacion_id_');
        $("#clasificacion_section").append($clone);
        
    }

</script>
<div class="container">
    <ul id="tableactiondTab" class="nav nav-tabs">
        <li class="active">
        	<a href="#table-table-tab" data-toggle="tab">Devoluciones</a>
        </li>
    </ul>
    <div id="tableactionTabContent" class="tab-content">
    	<div class="container-fluid">
            <legend>Modificar Devolución de Implementos Deportivos</legend>
            <form id="devolucion_form">
                <input type="hidden" id="id" value="{{$devolucion->id}}">
                <div class="col-md-12">
                    <label><i class="required">*</i> Fecha</label>
                    <input type="date" name="fecha" id="fecha" class="fecha form form-control" value="{{$devolucion->fecha}}" />
                </div>
                <div class="col-md-4">
                    <label><i class="required">*</i> Contratista</label>
                    <input type="text" name="contratista_user_id" id="contratista_user_id" class="form form-control" value="{{$devolucion->contratista_user_id}}" />
                </div>
                <div class="col-md-8">
                    <label><i class="required"></i>. </label>
                    <select name="user_id" id="user_id" class="form form-control" data-user_id="{{$usuarios}}">
                        <option value="">Seleccionar</option>
                        @foreach($usuarios as $temp)
                        <option data-disciplinas="{{$temp->disciplinas}}" data-documento="{{$temp->documentos}}" data-comunas="{{$temp->comunas}}" value="{{$temp->id}}">{{$temp->primer_nombre}} {{$temp->primer_apellido}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label><i class="required"></i>Comuna</label>
                    <input type="text" name="comuna"  id="comuna_id" class="form form-control" readonly="true"  />
                </div>
                <div class="col-md-6">
                    <label><i class="required"></i>Disciplina</label>
                    <input type="text" name="disciplina" class="form form-control" readonly="true" />
                </div>

                <div class="col-md-12">
                    <label><i class="required"></i> Observaciones</label>
                    <textarea name="observaciones" id="observaciones" rows="6" class="form form-control" required="required">{{$devolucion->observaciones}} </textarea>
                </div>
                <div class="clearfix"></div>
                <br>
                <div>
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th colspan="6"></th>
                                <th colspan="2">Dados de Baja</th>
                            </tr>
                            <tr>
                                <th></th>
                                <th>Clasificacion</th>
                                <th>Nombre Implemento</th>
                                <th>Proveedor</th>
                                <th width="10%">Cantidad Prestada</th>
                                <th width="10%">Cantidad Devuelta</th>
                                <th width="10%">Cantidad a devolver</th>    
                                <th width="10%">Daño</th>
                                <th width="10%">Robo/ Perdida</th>
                            </tr>
                        </thead>
                        <tbody id="devprestamo" data-detalle="{{$detalle}}">
                            @if($detalle)
                                @foreach($detalle as $data)
                                    <tr>
                                        <td>
                                            <input type="hidden" value="">
                                        </td>
                                        <td>
                                            <div class="row"> 
                                                <div class="col-sm-12 rango">
                                                    <input type="text" id="categoria" name="categoria" class="form-control input-sm" readonly="readonly" value="" style=" background: #FFF;">
                                                </div>
                                            </div>    
                                        </td>
                                        <td>
                                            <div class="row"> 
                                                <div class="col-sm-12 rango">
                                                    <input type="text" id="implemento" name="implemento" class="form-control input-sm" readonly="readonly" value="" style=" background: #FFF;">
                                                </div>
                                            </div> 
                                        </td>
                                        <td>
                                            <div class="row"> 
                                                <div class="col-sm-12 rango">
                                                    <input type="text" id="proveedor" name="proveedor" class="form-control input-sm" readonly="readonly" value="" style=" background: #FFF;">
                                                </div>
                                            </div> 
                                        </td>
                                        <td>
                                            <div class="row"> 
                                                <div class="col-sm-12 rango">
                                                    <input type="text" id="cantidad" name="cantidad" class="form-control input-sm" readonly="readonly" value="" style="width:95%;text-align:right; background: #FFF;">
                                                </div>
                                            </div> 
                                        </td>
                                        <td>
                                            <div class="row"> 
                                                <div class="col-sm-12 rango">
                                                    <input type="text" id="cantidad_devuelta" name="cantidad_devuelta" class="form-control input-sm" value="" style="width:95%;text-align:right; ">
                                                </div>
                                            </div> 
                                        </td>
                                        <td>
                                            <div class="row"> 
                                                <div class="col-sm-12 rango">
                                                    <input type="text" id="dano" name="dano" class="form-control input-sm" value="" style="width:95%;text-align:right;">
                                                </div>
                                            </div> 
                                        </td>
                                        <td>
                                            <div class="row"> 
                                                <div class="col-sm-12 rango">
                                                    <input type="text" id="perdida_robo" name="perdida_robo" class="form-control input-sm" value="" style="width:95%;text-align:right;">
                                                </div>
                                            </div> 
                                        </td>
                                    </tr>

                                @endforeach
                            @else
                                <tr>
                                    <td colspan="8">No hay registro</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="clearfix"></div>
                <br>           
                <div class="col-md-12 row">
                    <button id="submit_button" type="submit" class="btn btn-success" style="margin-left: 15px; "><i class="fa fa-save"></i> Guardar</button>
                    <a href="{{url('/admin/devolucioninventario')}}" class="btn btn-orange"><i class="fa fa-reply-all"></i>&nbsp;&nbsp;Atras</a>
                </div>
            <form>
    	</div>
    </div>
</div>
@stop