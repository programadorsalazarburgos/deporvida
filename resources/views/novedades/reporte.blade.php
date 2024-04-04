@extends('angular.frontend.master')
@section('title', 'Reporte de accidente laboral')
@section('content')
<?php
$v='?v='.date('YmdHis');
?>
<link rel="stylesheet" href="{{url('js/jquery/jquery-clockpicker.min.css')}}"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.16/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.16/datatables.min.js"></script>
<script type="text/javascript" src="js/jquery/jquery.printPage.js"></script>
<script type="text/javascript" src="{{url('js/jquery/crvclockpicker.js')}}"></script>

<script type="text/javascript" src="{{url('js/novedades.metodologo.js')}}"></script>
<script>
$(function()
{
    $('.hora').clockpicker({
            donetext: 'Guardar',
            placement: 'bottom',
            align: 'left',
            autoclose: true,
            twelvehour: true,
            vibrate: true
        });
    $( "#nombre_completo" ).autocomplete({
      source: base+"/monitores",
      minLength: 2,
      select: function( event, ui ) {
          $('#cedula').val(ui.item.numero_documento);
          $('#telefono').val(ui.item.telefono);
        
      }
    });
})
</script>
<div class="container">
    <ul id="tableactiondTab" class="nav nav-tabs">
        <li class="active"><a href="#table-table-tab" data-toggle="tab">Reporte de accidente laboral<strong></strong></a></li>
    </ul>
    <div id="tableactionTabContent" class="tab-content">
    <style type="text/css">
        .icon-logo{
            width: 150px;
        }
        td{
            padding: 2px;
        }
    </style>
    <form>
        <div class="container-fluid">
        <div class="col-md-12">
            <table border="1" cellpadding="0" cellspacing="0" width="100%">
                <tbody>
                    <tr>
                    </tr>
                    <tr>
                    </tr>
                    <tr>
                    </tr>
                    <tr>
                    </tr>
                    <tr>
                        <td colspan="2">
                            FECHA DEL REPORTE:
                        </td>
                        <td colspan="6">
                            <input type="" class="fecha form form-control" name="fecha_reporte" required/>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="8">
                            INFORMACIÓN DEL ACCIDENTE
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            NOMBRE COMPLETO
                        </td>
                        <td colspan="2">
                            CEDULA
                        </td>
                        <td colspan="2">
                            TELEFONO
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" rowspan="2">
                            <input type="" class="form form-control" name="nombre_completo" id="nombre_completo" required/>
                        </td>
                        <td colspan="2" rowspan="2">
                            <input type="" class="form form-control" name="cedula" id="cedula" required/>
                        </td>
                        <td colspan="2" rowspan="2">
                            <input type="" class="form form-control" name="telefono"  id="telefono">
                        </td>
                    </tr>
                    <tr>
                    </tr>
                    <tr>
                        <td colspan="3">
                            FECHA DEL ACCIDENTE
                        </td>
                        <td colspan="2">
                            HORA DEL ACCIDENTE
                        </td>
                        <td colspan="3">
                            HORA DE INGRESO (ACTIVIDADES)
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" rowspan="2">
                            <input type="" class="fecha form form-control" name="fecha_accidente">
                        </td>
                        <td colspan="2" rowspan="2">
                            <input type="" class="form form-control hora" name="hora_accidente" >
                        </td>
                        <td colspan="3" rowspan="2">
                            <input type="" class="form form-control hora" name="hora_ingreso">
                        </td>
                    </tr>
                    <tr>
                    </tr>
                    <tr>
                        <td colspan="4">
                            DIRRECCIÓN DONDE OCURRIO EL ACCIDENTE
                        </td>
                        <td colspan="2">
                            BARRIO
                        </td>
                        <td colspan="2">
                            ZONA (RU-UR)
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" rowspan="2">
                            <input type="" class="form form-control" name="direccion_accidente">
                        </td>
                        <td colspan="2" rowspan="2">
                            <select class="form form-control" name="barrio_accidente">
                                @foreach($barrios as $temp)
                                <option value="{{$temp->nombre_barrio}}">{{$temp->nombre_barrio}}</option>
                                @endforeach    
                            </select>
                        </td>
                        <td colspan="2" rowspan="2">
                            <input type="" class="form form-control" name="zona">
                        </td>
                    </tr>
                    <tr>
                    </tr>
                    <tr>
                        <td colspan="3">
                            TESTIGO 1
                        </td>
                        <td>
                            CEDULA
                        </td>
                        <td colspan="3">
                            TESTIGO 2
                        </td>
                        <td>
                            CEDULA
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" rowspan="2">
                            <input type="" class="form form-control" name="testigo1">
                        </td>
                        <td rowspan="2">
                            <input type="" class="form form-control" name="cedula1">
                        </td>
                        <td colspan="3" rowspan="2">
                            <input type="" class="form form-control" name="testigo2">
                        </td>
                        <td rowspan="2">
                            <input type="" class="form form-control" name="cedula2">
                        </td>
                    </tr>
                    <tr>
                    </tr>
                    <tr>
                        <td colspan="8">
                            RELATO DEL HECHO (TERCERA PERSONA)
                        </td>
                    </tr>
                    <tr>
                        <td colspan="8" rowspan="9">
                            <textarea class="form form-control" name="relato" required></textarea>
                        </td>
                    </tr>
                    <tr>
                    </tr>
                    <tr>
                    </tr>
                    <tr>
                    </tr>
                    <tr>
                    </tr>
                    <tr>
                    </tr>
                    <tr>
                    </tr>
                    <tr>
                    </tr>
                    <tr>
                    </tr>
                    <tr>
                        <td colspan="8">
                            OBSERVACIONES (en caso de ser un reporte extemporáneo,
                            especificar por qué)
                        </td>
                    </tr>
                    <tr>
                        <td colspan="8">
                            <textarea class="form form-control" name="observaciones"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="8" rowspan="5">
                        </td>
                    </tr>
                    <tr>
                    </tr>
                    <tr>
                    </tr>
                    <tr>
                    </tr>
                    <tr>
                    </tr>
                    <tr>
                        <td colspan="8">
                            INFORMACIÓN DE LA EMPRESA (exclusivo recursos humano Deporvida)
                        </td>
                    </tr>
                    <tr>
                        <td colspan="8">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <label>NOMBRE O RAZÓN SOCIAL</label>
                            <input type="" class="form form-control" name="razon_social">
                        </td>
                        <td colspan="4">
                            <label>NIT</label><input type="" class="form form-control" name="nit">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" rowspan="2">
                        </td>
                        <td colspan="4" rowspan="2">
                        </td>
                    </tr>
                    <tr>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <label>DEPARTAMENTO</label>
                            <select type="" class="form form-control" name="id_departamento" id="id_departamento" required>
                                @foreach($departamentos as $temp)    
                                <option value="{{$temp->id}}"
                                @if($temp->id==76)
                                selected
                                @endif    834
                                >{{$temp->nombre_departamento}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td colspan="2">
                            <label>MUNICIPIO</label>
                            <select type="" class="form form-control" name="id_municipio" id="id_municipio">
                                @foreach($municipiosvalle as $temp)    
                                <option value="{{$temp->id}}"
                                @if($temp->id==834)
                                selected
                                @endif        
                                >{{$temp->nombre_municipio}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td colspan="3">
                            <label>JORDANA LABORAL</label>
                            <select type="" class="form form-control" name="jornada_laboral" required>
                                <option value="">Seleccione</option>
                                <option value="3">Mañana</option>
                                <option value="2">Parcial</option>
                                <option value="4">Tarde</option>
                                <option value="1">Total</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" rowspan="2">
                        </td>
                        <td colspan="2" rowspan="2">
                        </td>
                        <td colspan="3" rowspan="2">
                        </td>
                    </tr>
                    <tr>
                    </tr>
                    <tr>
                        <td colspan="4">
                            RADICADO</label><input type="" class="form form-control" name="radicado">
                        </td>
                        <td colspan="4">
                            CARGO QUE DESEMPEÑA</label><input type="" class="form form-control" name="cargo">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" rowspan="2">
                        </td>
                        <td colspan="4" rowspan="2">
                        </td>
                    </tr>
                    <tr>
                    </tr>
                    <tr>
                        <td colspan="2">
                            AUTORIZACIÓN
                        </td>
                        <td colspan="3">
                            FECHA DE ENVIO DE AUTORIZACIÓN
                        </td>
                        <td colspan="3">
                            FECHA DE AUTORIZADO
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" rowspan="2">
                            SI<input type="radio" name="autorizacion" value="si">
                            NO<input type="radio" name="autorizacion" value="no">
                        </td>
                        <td colspan="3" rowspan="2">
                            </label><input type="" class="fecha form form-control" name="fecha_envio_autorizacion">
                        </td>
                        <td colspan="3" rowspan="2">
                            </label><input type="" class="fecha form form-control" name="fecha_autorizado">
                        </td>
                    </tr>
                    <tr>
                    </tr>
                    <tr>
                    </tr>
                    <tr>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-12 row">
            <button id="save" class="btn btn-success">Guardar</button>
            <a id="imprimir" class="btn btn-success">Imprimir</a>
        </div>
        </div>
    </form>
    </div>
</div>
@stop