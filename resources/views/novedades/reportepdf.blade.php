<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Accidente laboral</title>
</head>
<body>
<table border="1" cellpadding="0" cellspacing="0" width="100%">
                <tbody>
                    <tr>
                        <td colspan="2">
                            <center>
                                <img src="{{url('/img/deporvida.png')}}" alt="" style="width: 135px;">
                            </center>
                        </td>
                        <td colspan="4">
                            <h1 align="center">REPORTE ACCIDENTE LABORAL</h1>
                        </td>
                        <td colspan="2">
                            <center>
                                <img src="{{url('img/alcaldia-de-cali.jpg')}}" alt="" style="width: 135px;">
                            </center>
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
                        <td colspan="2">
                            FECHA DEL REPORTE:
                        </td>
                        <td colspan="6">
                            {{$data->fecha_reporte}}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="8" style="background-color:#c3c3c3;font-weight:bold;text-align: center;">
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
                        {{$data->nombre_completo}}
                        </td>
                        <td colspan="2" rowspan="2">
                        {{$data->cedula}}
                        </td>
                        <td colspan="2" rowspan="2">
                        {{$data->telefono}}
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
                        {{$data->fecha_accidente}}
                        </td>
                        <td colspan="2" rowspan="2">
                        {{$data->hora_accidente}}
                        </td>
                        <td colspan="3" rowspan="2">
                        {{$data->hora_ingreso}}
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
                        {{$data->direccion_accidente}}
                        </td>
                        <td colspan="2" rowspan="2">
                        {{$data->barrio_accidente}}
                        </td>
                        <td colspan="2" rowspan="2">
                        {{$data->zona}}
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
                        {{$data->testigo1}}
                        </td>
                        <td rowspan="2">
                        {{$data->cedula1}}
                        </td>
                        <td colspan="3" rowspan="2">
                        {{$data->testigo2}}
                        </td>
                        <td rowspan="2">
                        {{$data->cedula2}}
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
                        <td colspan="8"  style="background-color:#c3c3c3;font-weight:bold;text-align: center;">
                            RELATO DEL HECHO (TERCERA PERSONA)
                        </td>
                    </tr>
                    <tr>
                        <td colspan="8" rowspan="9">
                        {{$data->relato}}
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

                        <td colspan="8" style="background-color:#c3c3c3;font-weight:bold;text-align: center;">
                            OBSERVACIONES (en caso de ser un reporte extemporáneo, especificar por qué)
                        </td>
                    </tr>
                    <tr>
                        <td colspan="8">
                        {{$data->observaciones}}
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
                        <td colspan="8" style="background-color:#c3c3c3;font-weight:bold;text-align: center;">
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
                            {{$data->razon_social}}
                        </td>
                        <td colspan="4">
                            <label>NIT</label>
                            {{$data->nit}}
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
                            
                        </td>
                        <td colspan="2">
                            <label>MUNICIPIO</label>
                            
                        </td>
                        <td colspan="3">
                            <label>JORDANA LABORAL</label><br>
                            {{$data->jornada_laboral}}
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
                            RADICADO</label><br>{{$data->radicado}}
                        </td>
                        <td colspan="4">
                            CARGO QUE DESEMPEÑA</label><br>{{$data->cargo}}
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
                        {{$data->fecha_envio_autorizacion}}
                        </td>
                        <td colspan="3" rowspan="2">
                        {{$data->fecha_envio_autorizacion}}
                        </td>
                        <td colspan="3" rowspan="2">
                        {{$data->fecha_autorizado}}
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

</body>
</html>