@extends('angular.frontend.master')
@section('title', 'Prestamos')
@section('content')
<script>
    $(function ()
    {
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
            $('#submit_button').attr("disabled", true);
            $.ajax({
                url: base + '/admin/devolucioninventario/save',
                type: 'POST',
                data: data,
                success: function (data)
                {
                    $('#submit_button').attr("disabled", true);
                    $('body,html').animate({scrollTop: 0}, 500);
                    swal("Almacenado!", "Registro Guardado.", "success");
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
                                '<td><input type="number" value="0" name="devuelta" onkeypress="myFunction()"  class="form form-control"></td>'+
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
        	<a href="#table-table-tab" data-toggle="tab">Prestamos</a>
        </li>
    </ul>
    <div id="tableactionTabContent" class="tab-content">
    	<div class="container-fluid">
            <legend>Préstamos</legend>
            <form id="devolucion_form">
                <div class="col-md-12">
                    <label><i class="required">*</i> Fecha</label>
                    <input type="date" name="fecha" id="fecha" class="fecha form form-control" value="<?php echo date('Y-m-d', strtotime(date('Y/m/d'))); ?>" />
                </div>
                <input type="hidden" name="contratista_user_id" readonly="true" style="background-color: #FFF;" id="contratista_user_id" class="form form-control" />

                <div class="col-md-7">
                    <label><i class="required">*</i>Contratista</label>
                    <select name="user_id" id="user_id" class="form form-control" >
                        <option value="">Seleccionar</option>
                        @foreach($usuarios as $temp)
                        <option
                            data-disciplinas="{{$temp->disciplinas}}"
                            data-documento="{{$temp->documentos}}"
                            data-comunas="{{$temp->comunas}}"
                            value="{{$temp->id}}">
                                {{$temp->documentos}} -
                                {{$temp->primer_apellido}}
                                {{$temp->segundo_apellido}}
                                {{$temp->primer_nombre}}
                                {{$temp->segundo_nombre}}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label><i class="required"></i>Comuna</label>
                    <input type="text" name="comuna"  id="comuna_id" class="form form-control"  style="background-color: #FFF;" readonly="true"  />
                </div>
                <div class="col-md-3">
                    <label><i class="required"></i>Disciplina</label>
                    <input type="text" name="disciplina" id="disciplina" class="form form-control" readonly="true"  style="background-color: #FFF;" />
                </div>

                <div class="col-md-12">
                    <label><i class="required"></i> Observaciones</label>
                    <textarea name="observaciones" id="observaciones" rows="6" class="form form-control" required="required"> </textarea>
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
                        <tbody id="devprestamo">
                            <tr>
                                <td colspan="8">No hay registro</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="clearfix"></div>
                <br>
                <div class="col-md-12 row">
                    <button id="submit_button" type="submit" class="btn btn-success" style="margin-left: 15px; "><i class="fa fa-save"></i> Guardar</button>
                    <a class="btn btn-primary" href="">Imprimir Acta Formal</a>
                </div>
            <form>
    	</div>
    </div>
</div>
@stop
