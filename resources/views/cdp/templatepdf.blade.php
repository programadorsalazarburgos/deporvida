<html>
   <head>
   	  <title>Imprimir</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <style type="text/css">
         @page { margin: 4.9cm 2cm 3.5cm 2cm; }
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
             border: 1px solid black;
         }
         body{
            text-transform: uppercase;
            font-family: arial;
         }
        </style>
   </head>	
   <body>
      <div style="position: fixed; left: 0px; top: -111px; right: 0px;  text-align: center; ">
         <table style="width: 929px" class="table_border" page-break-inside: auto;>
             <tbody>
                 <tr>
                     <td width="20%" rowspan="3" valign="top">
                           <img src="img/alcaldia-de-cali.jpg" style="width: 2cm;margin: 2px;x"><br><br>
                           <span style="font-size:7px !important;">GESTION HACIENDA PUBLICA<br>CONTABILIDAD GENERAL<span>
                        <br>
                     </td>
                     <td width="60%" rowspan="3" valign="top">
                        <center>SISTEMAS DE GESTIÓN Y CONTROL INTEGRADOS <br>(SISTEDA, SGC y MECI)<br><br>
                        <strong>@yield('title')</strong></center>
                     </td>
                     <td width="20%" colspan="2" valign="top" style="font-size: 9px;">
                        MAHP03.03.01.18.P11.F01
                     </td>
                 </tr>
                 <tr>
                     <td width="97" valign="top" style="font-size: 8px;">
                        VERSIÓN
                     </td>
                     <td width="99" valign="top" style="font-size: 8px;">
                        1
                     </td>
                 </tr>
                 <tr>
                     <td width="97" valign="top" style="font-size: 8px;">
                        FECHA<br>DE ENTRADA<br>EN VIGENCIA 
                     </td>
                     <td width="99" valign="top" style="font-size: 8px;">
                        27/oct/2015
                     </td>
                 </tr>
             </tbody>
         </table>
      </div>
      @yield('content')
   </body>
</html>