<html>
   <head>
   	  <title>INFORME PARCIAL Y/O FINAL DE SUPERVISIÓN CONTRATO DE PRESTACIÓN DE SERVICIOS Y APOYO A LA GESTION PERSONA NATURAL</title>
        <style type="text/css">
        @page { margin: 6.2cm 1.6cm 3.5cm 2.3cm; }
        .table_border td{
            font-size: 10px;
             vertical-align: middle;
             text-align: center;
         }
         .borderyes, .borderyes tr, .borderyes td{
            border: 1px solid #000 !important;
            border-width: 1px 1px 1px 1px !important;
            border-collapse: collapse !important;
            margin-top:12px !important;
            margin-bottom:12px !important;
         }
         .table_border {
            width: 100%;
            border-collapse: collapse;
         }
         .table_border,  .table_border th, .table_border td {
             border: 1px solid black;
         }
         .table_data{
            border: 1px solid black;
            border-collapse: collapse;
            width: 100%;
         }
         .table_data,  .table_data th, .table_data td {
             border: 1px solid black;
         }
         .table_data_in{
            border: 1px solid black;
            border-collapse: collapse;
            border-width: 0px 0px 1px 0px;
            width:100%;
         }
         .table_data_in th, .table_data_in tr, .table_data_in td{
            border: 1px solid black;
            border-width: 1px 0px 0px 0px;
         }
         body{
            font-family: sans-serif;
            border: #000 1px solid;
            font-size:14.5px;
         }
         
         .gris{
            padding-top:    -12px !important;
            padding-bottom: -12px !important;
            background-color: #c3c3c3;
        }
        td{
            padding-top:    -12px !important;
            padding-bottom: -12px !important;
            padding-left: 5px !important;
        }


        .table_hiden{
            width:100%;
            border: 0px solid #FFF;
            border-collapse: collapse;

        }
        .table_hiden tr,.table_hiden td{
            border: 0px solid #FFF !important;
            border-collapse: collapse;
        }
        .cuadros{
            width:100%;
            height:40px;
            border: 1px solid #000;
            border-collapse: collapse;
        }
        </style>
        <link rel="stylesheet" href="images/cdp/font.css">
   </head>	
   <body>
      <div style="position: fixed; left: 0px; top: -160px; right: 0px;  text-align: center; ">
      <img src="images/cdp/enca-informe-parcial.png" width="100%"/>
      </div>

<table  class="table_data_in">
    <tbody>
        <tr>
            <td colspan="5" valign="top" class="gris">
                <p align="center">
                    1. TIPO DE INFORME
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="5" valign="top">
            <table style="margin-left:30px;margin-top:20px;" class="table_hiden">
            <tr>
            <td width="50%"><br/>INFORME PARCIAL</td>
            <td width="50%"><br/>
            @if($informe_final)
            <img src="images/cdp/cuadro-vacio.png" width="20px" height="20px"/>
            @else
            <img src="images/cdp/cuadro-marcado.png" width="20px" height="20px"/>
            @endif
            </td>
            <td width="50%"><br/>INFORME FINAL</td>
            <td width="50%"><br/>
            @if($informe_final)
            <img src="images/cdp/cuadro-marcado.png" width="20px" height="20px"/>
            @else
            <img src="images/cdp/cuadro-vacio.png" width="20px" height="20px"/>
            @endif
            </td>
            </tr>
            </table >
            <br/>
                <p style="margin-left:40px">
                    Cuota Número {{$cuota_numero}}
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="5" class="gris">
                <p align="center">
                    2. ASPECTOS GENERALES DE CONTRATO Y SU EJECUCIÓN
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="5">
                <p>
                    Contrato No. 4162.010.26.1.{{$contrato_numero}} de 2018
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="5">
                <p>
                    Fecha del Informe: {{$fecha_transaccion}}
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="5">
                <p>
                    Nombre completo del contratista: 
                    {{$nombre_primero}}
                    {{$nombre_segundo}}
                    {{$apellido_primero}}
                    {{$apellido_segundo}}
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="5">
                <p>
                    Cédula y/o Nit: {{number_format($documento,0,',','.')}}
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="5">
                <p>
                    Nombre (s) del Supervisor (es): {{$supervisor}}
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <p>
                    Organismo: Secretaría del Deporte y la Recreación
                </p>
            </td>
            <td colspan="2">
                <p>
                    No. Telefónico:5141190
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="5">
                <p>
                    Objeto del contrato: {{$contrato_objeto}}
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="5"  class="gris">
                <p align="center">
                    3. INFORME JURÍDICO
                </p>
            </td>
        </tr>
        <tr>
            <td width="33%" style="border: 1px solid black;" colspan="2" valign="top">
                <p align="center">
                    Fecha de Inicio<br>
                    {{date('d/m/Y',strtotime($fecha_inicio))}}
                </p>
            </td>
            <td width="33%" style="border: 1px solid black;" colspan="2" valign="top">
                <p align="center">
                Plazo de ejecución hasta<br>
                    {{date('d/m/Y',strtotime($fecha_terminacion))}}
                </p>
            </td>
            <td width="34%" style="border: 1px solid black;"  valign="top">
                <p align="center">
                    Fecha terminación<br>
                    {{date('d/m/Y',strtotime($fecha_terminacion))}}
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="5" valign="top">
                <p>
                    Suspensión (Cuando aplique): N/A
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="5" valign="top">
                <p>
                    Fecha de inicio de la suspensión:
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="5" valign="top">
                <p>
                    Fecha final de la suspensión:
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="5" valign="top">
                <p>
                    Cesión (Cuando aplique): N/A
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="5" valign="top">
                <p>
                    Fecha de inicio de la cesión:
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="5" valign="top">
                <p>
                    Fecha final de la cesión:
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="5" valign="top">
                <p>
                    Otrosí (Cuando aplique): N/A
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="5" valign="top">
                <p>
                    Fecha de inicio del Otrosí:
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="5" valign="top">
                <p>
                    Fecha final del Otrosí:
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="5" valign="top">
                <p>
                    Terminación anticipada (Cuando aplique): N/A
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="5" valign="top">
                <p>
                    Acta de Liquidación:
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="5" valign="top">
                <p>
                    Observaciones al informe jurídico:
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="5" class="gris">
                <p align="center">
                    4. INFORME CONTABLE Y FINANCIERO
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="5">
                <p>
                    Valor del contrato: Es hasta por la suma de {{$contrato_valor_letras}} PESOS m/te (${{number_format($contrato_valor,0,',','.')}}).
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="5">
                <p>
                    Adición (Recursos): N/A
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="5">
                <p>
                    Prórroga: N/A
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="5">
                <p>
                    Información para Retención en la fuente:
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="5">
            <table width="100%" class="borderyes">
                        <tr>
                            <td>Para efectos de disminución de la base de
                                retención en la fuente, anexo copia legible
                                de los siguientes documentos:
                                </td>
                            <td>SI</td>
                            <td>NO</td>
                        </tr>
                        <tr>
                            <td>* Recibo de consignación en mi cuenta de
                                        Apoyo al Fomento de la Construcción AFC del
                                        periodo de la cuota.</td>
                            <td>{{$retencion_periodo==1?'X':''}}</td>
                            <td>{{$retencion_periodo==0?'X':''}}</td>
                        </tr>
                        <tr>
                            <td>* Recibo de consignación en mi cuenta del
                                        Fondo de Pensiones voluntarias del periodo
                                        de la cuota.</td>
                            <td>{{$retencion_pensiones==1?'X':''}}</td>
                            <td>{{$retencion_pensiones==0?'X':''}}</td>
                        </tr>

                        </table>
            </td>
        </tr>
        <tr>
            <td colspan="5" valign="top">
                <p>
                    Información:
                </p>
                <table class="table_data_in">
                    <tbody>
                        <tr>
                            <td>
                                <p align="center">
                                    Valor Total del Contrato
                                </p>
                            </td>
                            <td>
                                <p align="center">
                                    Valor Cuota a cancelar
                                </p>
                            </td>
                            <td>
                                <p align="center">
                                    Valor Acumulado Cancelado
                                </p>
                            </td>
                            <td>
                                <p align="center">
                                    Saldo por Cancelar
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top">
                                <p align="center">
                                    $ {{number_format($contrato_valor,0,',','.')}}
                                </p>
                                <br><br>
                            </td>
                            <td valign="top">
                                <p align="center">
                                    $ {{number_format($valor_cuota,0,',','.')}}
                                </p>
                                <br><br>
                            </td>
                            <td valign="top">
                                <p align="center">
                                    $ {{number_format($valor_acumulado,0,',','.')}}
                                </p>
                                <br><br>
                            </td>
                            <td valign="top">
                                <p align="center">
                                    $ {{number_format($valor_saldo,0,',','.')}}
                                </p>
                                <br><br>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="5" valign="top">
            <br><br>
                <p>
                    Observaciones al informe contable y financiero:
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="5">
            <br><br>
                <p>
                    Información del pago de seguridad social:
                </p>
            </td>
        </tr>
        <tr>
            <td style="border: 1px solid black;">
                <p align="center">
                    Obligación
                </p>
            </td>
            <td colspan="4" style="border: 1px solid black;">
                <p align="center">
                    Datos Certificación o Planilla de Pago
                </p>
            </td>
        </tr>
        <tr>
            <td valign="top" width="35%" style="border: 1px solid black;">
                <center>
                    <p style="text-transform:lowercase">
                        Sistema de Salud, Sistema de Pensiones y Riesgos Laborales
                    </p>
                </center>
            </td>
            <td colspan="4" valign="top" width="65%" style="border: 1px solid black;">
                <p>
                    No. Planilla: {{$planilla_numero}}<br/>
                    No. PIN, Autorización, Referencia, Pago: {{$pin_numero}}<br/>
                    Operador: {{$operador}}<br/>
                    Fecha de Pago: {{$fecha_pago}}<br/>
                    Periodo de pago de la seguridad social: {{$periodo}} DE {{$periodo_year}}<br/>
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="5" valign="top">
                <p>
                    Observaciones:<a name="_gjdgxs"></a>
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="5" class="gris">
                <p align="center">
                    5. INFORME TÉCNICO
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="5" valign="top">
                <p>
                    Concepto Supervisor (es):
                </p>
                <p>
                    Durante el desarrollo del contrato de prestación de
                    servicios<strong> No. 4162.010.261.{{$contrato_numero}} </strong>se pudo
                    verificar que el contratista realizó las siguientes
                    actividades en cumplimiento de sus obligaciones y objeto
                    contractual.
                </p>
                <p>
                    Se realizó en el mes de <strong>{{$mes_periodo}}</strong> las
                    siguientes actividades en los escenarios deportivos de
                    Santiago de Cali:
                </p>
                    <?= html_entity_decode ($tareas_supervisor)?>
            </td>
        </tr>
        <tr>
            <td colspan="5" valign="top">
                <p>
Recibo a Satisfacción de Servicios                    <strong>(Solo aplica para el informe final)</strong>:
                </p>
                <p>
                    Con la firma del presente informe se deja constancia del
                    recibo a satisfacción por parte del MUNICIPIO DE SANTIAGO
                    DE CALI, de los servicios prestados pactados en el
                    CN/Aceptación de Oferta No.
                    @if($informe_final)
                    4162.010.26.1.{{$contrato_numero}}  de {{$anno}}
                    @else
                     _________________de _________
                    @endif
                    
                </p>
                <p>
                    Nota: En caso de no recibir a satisfacción los bienes o
                    servicios, se deberán consignar los motivos y
                    circunstancias en el campo “Observaciones”.
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="5" valign="top">
                <p>
                    Revaluación del Contratista o prestador de servicios:{{$revaluacion}}
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="5" valign="top">
                <p>
Constancia de Paz y Salvo                    <strong>(Solo aplica para el informe final)</strong>:
                </p>
                <p>
                    Que el Contratista 
                    @if($informe_final)
                    {{$nombre_primero}} {{$nombre_segundo}} {{$apellido_primero}} {{$apellido_segundo}}
                    identificado(a) con cédula de ciudadanía No.{{$documento}} de
                    ______(_______), vinculado a la Secretaria de deporte y recreación,
                    mediante contrato de Prestación de Servicios No.
                    4162.010.26.1.{{$contrato_numero}}, durante el tiempo comprendido entre el
                     {{$fecha_inicio_letras}} y el {{$fecha_terminacion_letras}}, a la fecha no
                    posee elementos devolutivos a su cargo de propiedad del
                    Municipio de Santiago de Cali, entregados por parte de esta
                    oficina.
                    @else
                    _________________________________,
                    identificado(a) con cédula de ciudadanía No.___________ de
                    ______(_______), vinculado a la ____________________,
                    mediante contrato de Prestación de Servicios No.
                    __________________, durante el tiempo comprendido entre el
                    ___ de ______ y el ____de ___ del _____, a la fecha no
                    posee elementos devolutivos a su cargo de propiedad del
                    Municipio de Santiago de Cali, entregados por parte de esta
                    oficina.
                    @endif
                </p>
                <p>
                    Así mismo se encuentra a Paz y Salvo del Archivo de Gestión
                    Documental, ORFEO y otros sistemas, entrego Backup al área
                    de Sistemas.
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="5" valign="top" class="gris">
                <p align="center">
                    6. FIRMA RESPONSABLES
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="5" valign="top">
                <table width="100%" border="0">
                    <tr>
                        <td style="border-color: #FFF;">
                            <p>
                            <br>
                            <br>
                            <br>
                            <br>
                                _______________________<br>
                                {{strtoupper($supervisor)}} <br>
                                Nombre y firma del Interventor / Supervisor
                            </p>
                            <br/><br/><br/>
                        </td>
                        <td style="border-color: #FFF;">
                        <p>
                        <br>
                            <br>
                            <br>
                            <br>
                        
                            _______________________<br/>
                            {{$nombre_primero}} {{$nombre_segundo}} {{$apellido_primero}} {{$apellido_segundo}}<br>
                            Nombre y firma del Contratista
                        </p>    
                        <br/><br/><br/>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="5" valign="top">
                <p>
                    Ciudad y Fecha de suscripción del informe de supervisión:
                </p>
                <p>
                    Cali, {{$fecha_transaccion}}
                </p>
            </td>
        </tr>
    </tbody>
</table>
   </body>
</html>
