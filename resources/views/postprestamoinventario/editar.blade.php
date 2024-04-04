@extends('angular.frontend.master')
@section('title', 'Prestamos')
@section('content')

<script>
    $(function ()
    {
        
        $('#contratista_user_id').keyup(function(e){
            //alert($('#contratista_user_id').val());
            //var usuarios = $('#user_id').data('usuarios'); 
            var usuario = $('#contratista_user_id').val(); 
            var user = usuarios.find(x => x.documentos === usuario )
            
            if(user){
                $('#user_id').val(user.id);
                $('#comuna_id').val(user.comunas);
                $('#disciplina').val(user.disciplinas);       
            } else {
                $('#user_id').val();
                $('#comuna_id').val("");
                $('#disciplina').val("");       
            }
            
        });

        var usuarios = $('#user_id').data('user_id'); 
        
        var contratista = $('#contratista_user_id').val(); 
        var user = usuarios.find(x => x.documentos === contratista )

        $('#user_id').val(user.id);
        $('#comuna_id').val(user.comunas);
        $('#disciplina').val(user.disciplinas);

        $('#user_id').select2();

        var detalles = $('#clasificacion_section').data('detalles');

        $('#prestamo_form').submit(function (e)
        {
            e.preventDefault();
                    var elementos=[];
                    $("table tbody tr").each(function(i,e){            
                        var td = [];
                        $(this).find("td").each(function(index, element){
                            var tr = {};
                            tr= $(this).find("input").val();                       
                            td.push(tr);
                        });
                        elementos.push(td);    
                    });
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

            console.log(data)

            $.ajax({
                url: base + '/admin/prestamoinventario/update/'+id,
                type: 'POST',
                data: data, 
                contentType: 'application/x-www-form-urlencoded',
                success: function (data)
                {
                    $('body,html').animate({scrollTop: 0}, 500);
                    swal("Modificado!", "Registro Modificado.", "success");
                    window.location = base + '/admin/prestamoinventario';
                }
            });

        });

        $('#user_id').change(function(e) {           
            $('#comuna_id').val($('#user_id option:selected').attr('data-comunas'));            
            $('#disciplina').val($('#user_id option:selected').attr('data-disciplinas'));
            $('#contratista_user_id').val($('#user_id option:selected').attr('data-documento'));
        });

            var i = 2;
            $('#agrega_clasificacion').bind('click', function(e) {
                e.preventDefault();
                $clone=$("#clasificacion_0").clone();
                $($clone).attr('id','clasificacion_'+i)
                $("#clasificacion_section").append($clone);
                $("#clasificacion_"+i+" .clas_id").attr('id','clasificacion_id_'+(i));
                $("#clasificacion_"+i+" .implementos").attr('id','implementos_'+(i));
                $('#implementos_'+(i)).html('');
                $("#clasificacion_"+i+" .clas_id").attr('data-id',i)
                $("#clasificacion_"+i+" .clas_id").attr('onchange',"changeClasificacion("+i+")");
                console.log(i);
                i++;
            })

        });
    function changeClasificacion(id_implemento)
    {
            var id = $('#clasificacion_id_'+id_implemento).val();
            $.get(base + '/admin/entradainventario/listarimplementos/'+id, function(data)
            {
                var tabla = '<table class="table">';
                    tabla += '<thead>';
                    tabla += '<tr>';
                    tabla += '<th></th><th width="100%">Nombre Implemento</th><th>Cantidad</th>';
                    tabla += '<tr>';
                    tabla += '<tbody>';
                    tr = '';

                    $.each(data, function(key,element){
                        tr += '<tr>';
                        tr += '<td><input type="hidden" name="id" value="'+element["id"]+'" ></td><td>'+element["nombre"]+'</td><td><input type="number" value="0" name="cantidad" style="text-align:right;" ></td>';
                        tr += '</tr>';
                    });
                    tabla += tr;
                    tabla += '</tbody></table>';
                $('#implementos_'+id_implemento).html( tabla );
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
            <a href="#table-table-tab" data-toggle="tab">Prestamo Implementos Deportivos</a>
        </li>
    </ul>
    <div id="tableactionTabContent" class="tab-content">
        <div class="container-fluid">
            <form id="prestamo_form">
                <input type="hidden" name="id" id="id" value="{{$prestamo->id}}">
                <div class="col-md-12">
                    <label><i class="required">*</i> Fecha</label>
                    <input type="date" name="fecha" id="fecha" class="fecha form form-control" value="{{$prestamo->fecha}}" />
                </div>
                <div class="col-md-4">
                    <label><i class="required">*</i> Cedula</label>
                    <input type="text" name="contratista_user_id" id="contratista_user_id" class="form form-control" value="{{$prestamo->contratista_user_id}}" />
                </div>
                <div class="col-md-8">
                    <label><i class="required"></i> Contratista</label>
                    <select name="user_id" id="user_id" class="form form-control select_contratista" data-user_id="{{$usuarios}}" >
                        <option value="">Seleccionar</option>
                        @foreach($usuarios as $temp)
                        <option data-disciplinas="{{$temp->disciplinas}}" data-documento="{{$temp->documentos}}" data-comunas="{{$temp->comunas}}" value="{{$temp->id}}">
                            {{$temp->primer_nombre}} 
                            {{$temp->segundo_nombre}} 
                            {{$temp->primer_apellido}}
                            {{$temp->segundo_apellido}}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label><i class="required"></i>Comuna</label>
                    <input type="text" name="comuna"  id="comuna_id" class="form form-control"  />
                </div>
                <div class="col-md-6">
                    <label><i class="required"></i>Disciplina</label>
                    <input type="text" id="disciplina" name="disciplina" class="form form-control" readonly />
                </div>

                <div class="col-md-12">
                    <label><i class="required"></i> Observaciones</label>
                    <textarea name="observaciones" id="observaciones" rows="6" class="form form-control" required="required">{{$prestamo->observaciones}} </textarea>
                </div>
                <div class="clearfix"></div>
                <br>
                
                @if($detalles->count())
                @php
                $i=0
                @endphp
                    @foreach($detalles as $datadetalles)
                    <div id="clasificacion_section" data-detalles="{{$detalles}}">
                        <div id="clasificacion_{{$i}}">
                            <div class="col-md-4 text-right">
                                <strong>Clasificacion</strong>
                            </div>
                            <div class="col-md-6">
                                <select data-id="1" id="clasificacion_id_1" onchange="changeClasificacion(1)" class="clas_id form-control" >
                                    <option value="">Seleccionar</option>
                                    @foreach($clasificaciones as $temp)

                                    <option 
                                    @if($datadetalles->clasificacion_id == $temp->id)
                                    selected
                                    @endif
                                    value="{{$temp->id}}">{{$temp->nombre}}</option>
                                    @endforeach
                                </select>         
                            </div>
                            <div id="implementos_1" class="implementos">
                                <table class="table">
                                <thead>
                                <tr>
                                <th></th><th width="100%">Nombre Implemento</th><th>Cantidad</th>
                                <tr>
                                <tbody>
                                    @foreach($datadetalles->detalles as $detalles_all)
                                <tr>
                                    <td>
                                        <input type="hidden" name="id" value="{{$detalles_all->implemento_id}}" >
                                    </td>
                                    <td>
                                        {{$detalles_all->nombre}}
                                    </td>
                                    <td>
                                        <input type="number" value="{{$detalles_all->cantidad}}" name="cantidad" style="text-align:right;" >
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @php
                    $i++
                    @endphp

                    @endforeach
                @else
                    <div id="clasificacion_section">
                        <div id="clasificacion_0">
                            <div class="col-md-4 text-right">
                                <strong>Clasificacion</strong>
                            </div>
                            <div class="col-md-6">
                                <select data-id="1" id="clasificacion_id_1" onchange="changeClasificacion(1)" class="clas_id form-control" >
                                    <option value="">Seleccionar</option>
                                    @foreach($clasificaciones as $temp)
                                    <option value="{{$temp->id}}">{{$temp->nombre}}</option>
                                    @endforeach
                                </select>         
                            </div>
                            <div id="implementos_1" class="implementos"></div>
                        </div>
                    </div>

                @endif
                <div class="clearfix"></div>
                <br>
                <div class="row">
                    <div class="col-md-6"  style="float: right;">
                        <button type="button" value="agrega_clasificacion" id="agrega_clasificacion" class="btn btn-warning"><i class="fa fa-plus"></i> Agregar Clasificacion</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <button id="submit_button" type="submit" class="btn btn-success" style="margin-left: 15px; "><i class="fa fa-save"></i> Guardar</button>
                        <a href="{{url('/admin/prestamoinventario')}}" class="btn btn-orange"><i class="fa fa-reply-all"></i>&nbsp;&nbsp;Atras</a>

                    </div>
                </div>

            <form>
        </div>
    </div>
</div>
@stop