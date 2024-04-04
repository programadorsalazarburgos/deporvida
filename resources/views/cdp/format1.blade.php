<html>
   <head>
   	  <title>DOCUMENTO EQUIVALENTE – REGIMEN SIMPLIFICADO</title>
        <style type="text/css">
          @page { margin: 5cm 2.2cm 3.5cm 2.05cm; }
         .table_border td{
            font-size: 10px;
             vertical-align: middle;
             text-align: center;
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
          border-width: 0px 0px 1px 0px;
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
            border: #000 1px solid;
            font-family: sans-serif;
            font-size:14.5px;
         }
        </style>
   </head>	
   <body>
      <div style="position: fixed; left: 0px; top: -111px; right: 0px;  text-align: center; ">
         <img src="images/cdp/inf1.png" width="100%"/>
      </div>
<table class="table_data_in">
  <tr>
    <td>
      <center>
        <strong align="center">
          DOCUMENTO EQUIVALENTE – REGIMEN SIMPLIFICADO<br>Art. 3 Decreto 522 de 2003
        </strong>
      </center>
    </td>
  </tr>
  <tr>
    <td><strong>Dependencia: SECRETARIA DE DEPORTE Y RECREACION              No.</strong></td>
  </tr>
  <tr>
    <td><strong>Fecha de la Transacción: {{$data->fecha_transaccion}}</strong>
</td>
  </tr>
  <tr>
    <td><strong>Nombre y/o Razón Social Adquiriente:</strong>MUNICIPIO SANTIAGO DE CALI</td>
  </tr>
  <tr>
    <td>
      <strong>Nit:</strong> 8903990113   
      <strong>Dirección:</strong> Torre Alcaldía Av. 2 N Cl 10 y 11  
      <strong> No. Teléfono:</strong>   5141190
    </td>
  </tr>
  <tr>
    <td><strong>Ciudad:</strong>Santiago de Cali</td>
  </tr>
  <tr>
    <td><strong>Nombre y/o Razón Social Beneficiario:</strong>
      {{$data->nombre_primero}} 
      {{$data->nombre_segundo}} 
      {{$data->apellido_primero}} 
      {{$data->apellido_segundo}} 
    </td>
  </tr>
  <tr>
    <td><strong>Cedula o Nit:</strong> {{$data->documento}}
      <strong>Dirección Beneficiario:</strong> {{$data->residencia_direccion}}</td>
  </tr>
  <tr>
    <td>
      <strong>Teléfono:</strong>  {{$data->telefono}}
      <strong>Correo Electrónico:</strong>{{$data->correo_electronico}}
      <strong>Ciudad:</strong>Cali
    </td>
  </tr>
  <tr>
    <td><center><strong>INFORMACION CONTRACTUAL</strong></center></td>
  </tr>
  <tr>
    <td><strong>Objeto del Contrato:</strong> 
        <br><br>
        {{$data->contrato_objeto}}
        <br><br>
        <strong>
        INFORMACION DETALLADA: VER FORMATO INFORME DEL SUPERVISOR.
        </strong>
</td>
  </tr>
  <tr>
    <td>
      <strong>No. RPC:</strong>{{$data->rpc}} 
      <strong>No. CDP:</strong>{{$data->dcp}}
      <strong>Vr. Contrato</strong>$ {{$data->contrato_valor}}
    </td>
  </tr>
  <tr>
    <td><strong>Concepto:</strong>Cancelación cuota {{$data->numero_cuota_letras}} ({{$data->cuota_numero}}), Cuota según Contrato de Prestación de Servicios No. 4162.010.26.1.{{$data->contrato_numero}} <strong> Valor $</strong>: {{number_format($data->valor_cuota,0,',','.')}}</td>
  </tr>
  <tr>
    <td><strong>Son:</strong> {{$data->valor_cuota_letras}} PESOS MTE</td>
  </tr>
  
</table>
   </body>
</html>
