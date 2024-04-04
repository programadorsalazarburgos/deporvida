<!--<html>-->
   <head>
        <!--<link rel="stylesheet" type="text/css" href="css/bootstrap.css">-->
   	  <!--<title>Imprimir</title>-->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <style type="text/css">
         @page { margin: 6.9cm 2.2cm 3.5cm 2.05cm; }
         body{
            color:#000;
            text-transform: uppercase;
            font-family: "arial" !important;
            font-size:10px;
         }
         .firma{
            text-transform: none !important;
         }
        .table_actividades {
            border: 1px solid black;
            border-collapse: collapse;
         }
         .table_actividades2, .table_actividades2 tr, .table_actividades2 td  {
            border: 1px solid black;
            border-collapse: collapse;
         }
         label{
            font-weight: bold;
         }
         .table_border td{
            font-size: 10px;
             vertical-align: middle;
             text-align: center;
         }

         .table_border {
            width: 100%;
         }
         .table_border {
             border-collapse: collapse;
         }

         .table_border,  .table_border th, .table_border td {
             border: 1px solid black;
         }


         .table_data {
             border-collapse: collapse;
             margin: -1.9cm 0cm 0cm 0cm; 
         }

         .table_data,  .table_data th, .table_data td {
             border: 1px solid black;
         }
         .table_data{

         }
         .td_label{
            text-transform: uppercase;
            background-color: #D9D9D9;
         }
		 .page_break { page-break-after: always; }
      </style>
   </head>>
   <body>
		<div style="position: fixed; left: 0px; top: -183px; right: 0px;  text-align: center; ">
			<img width="100%" src="images/sesiones-clase-encabezado.png"/> 
		</div>
		<table class="table_data" width="100%" style="font-size: 10px;">
         <tr>
            <td style="width:25%" class="td_label">
               <strong>Mes</strong>
            </td>
            <td style="width:25%">
               {{$data->mes}}
            </td>
            <td style="width:25%" class="td_label">
               <strong>Comuna o corregimiento</strong>
            </td>
            <td style="width:25%">
               {{$data->nombre_comuna}}
            </td>
         </tr>
         <tr>
            <td style="width:25%" class="td_label">
               <strong>Monitor</strong>
            </td>
            <td colspan="3">
               {{$data->monitor}}
            </td>
         </tr>
         <tr>
            <td style="width:25%" class="td_label"><strong>Escenario<br>deportivo</strong></td><td  colspan="3" style="width:25%">{{$data->nombre_escenario}}</td>
         </tr>
         <tr>
            <td style="width:25%" class="td_label"><strong>Fecha</strong></td><td style="width:25%">{{$data->fecha}}</td>
            <td style="width:25%" class="td_label"><strong>hora</strong></td><td style="width:25%">{{$data->hora_inicio}}</td>
         </tr>
         <tr>
            <td style="width:25%" class="td_label"><strong>Eje temático psicosocial</strong></td><td style="width:25%">{{$data->eje_tematico}}</td>
            <td style="width:25%" class="td_label"><strong>NÚMERO DE SESIÓN:</strong></td><td style="width:25%">2</td>
         </tr>
         <tr>
            <td style="width:25%" class="td_label"><strong>DISCIPLINA<br>DEPORTIVA:</strong></td><td style="width:25%">{{$data->disciplina}}</td>
            <td style="width:25%" class="td_label"><strong>CONTENIDO PSICOSOCIAL:</strong></td><td style="width:25%">{{$data->cont_psicosocial}}</td>
         </tr>
   		<tr>
   			<td style="width:25%" class="td_label"><strong>Tema tecnico:</strong></td><td style="width:25%">{{$data->tema}}</td>
            <td style="width:25%" class="td_label"><strong>Nivel:</strong></td><td style="width:25%">{{$data->nivel}}</td>
   	 	</tr>
           <td style="width:25%" class="td_label"><strong>Objetivo:</strong></td><td style="width:75%">{{$data->objetivo}}</td>
		   <td style="width:25%" class="td_label"><strong>Grupo:</strong></td><td style="width:25%">{{$data->codigo_grupo}}</td>
      </table>
		<table class="table_actividades" border="1" style="width:100%">
            <tbody>
               <tr style="font-size: 10px;">
                  <th width="10%" style="font-size: 10px; text-align:center" class="td_label">Momento</th>
                  <th width="80%" style="font-size: 10px; text-align:center" class="td_label">Descripcion de la actividad</th>
                  <th width="10%" style="font-size: 10px; text-align:center" class="td_label">Tiempo</th>
               </tr>
               <tr>
                  <td style="text-align: center;font-size: 10px;" style="font-size: 10px;">1</td>
                  <td style="text-align: center;font-size: 10px;">
                     <table style="width:100%">
                        <tbody>
                           <tr>
                              <td style="text-align: center; font-weight: bold;font-size: 10px;">Recibimiento de los niños</td>
                           </tr>
                           <tr>
                              <td style="text-align: center; font-weight: bold;font-size: 10px;">Saludo</td>
                           </tr>
                           <tr>
                              <td style="text-align: center; font-weight: bold;font-size: 10px;">Cuidado del medio ambiente</td>
                           </tr>
                           <tr>
                              <td style="text-align: center; font-weight: bold;font-size: 10px;">Charla inicial</td>
                           </tr>
                        </tbody>
                     </table>
                  </td>
                  <td style="text-align: center; font-weight: bold;font-size: 10px;"><label>En minutos</label>
                     <br/>
                     {{$data->tiempo1}}
                  </td>
               </tr>
               <tr>
                  <td style="text-align: center;font-size: 10px;">2</td>
                  <td style="text-align: center;font-size: 10px;">
                     <table style="width:100%">
                        <tbody>
                           <tr>
                              <td style="text-align: center;font-size: 10px;">
                                 <label>Juego</label>
                                 <br/>
                                 {{$data->juego}}
                              </td>
                           </tr>
                           <tr>
                              <td style="text-align: center; font-weight: bold;font-size: 10px;">
                                 Estiramiento general
                              </td>
                           </tr>
                           <tr>
                              <td style="text-align: center;font-size: 10px;">
                                 <label>
                                 Habilidades motrices y coordinativas
                                 </label>
                                 <br>
                                 {{$data->habilidades}}
                              </td>
                           </tr>
                           <tr>
                              <td style="text-align: center; font-weight: bold;font-size: 10px;">
                                  Hidratación
                              </td>
                           </tr>
                        </tbody>
                     </table>
                  </td>
                  <td style="text-align: center;font-size: 10px;">
                     <label>En minutos</label><br>
                     {{$data->tiempo2}}
                  </td>
               </tr>
               <tr>
                  <td style="text-align: center;font-size: 10px;">3</td>
                  <td style="text-align: center;font-size: 10px;">
                     <table style="width:100%">
                        <tbody>
                           <tr>
                              <td style="text-align: center;font-size: 10px;">
                                 <label>Ejercicios introductorios</label>
                                 <br/>
                                 {{$data->ejercicios_introductorios}}
                              </td>
                           </tr>
                           <tr>
                              <td style="text-align: center;font-size: 10px;">
                                 <label>Ejercicios avanzados</label>
                                 <br/>
                                 {{$data->ejercicios_avanzados}}
                              </td>
                           </tr>
                           <tr>
                              <td style="text-align: center;font-size: 10px;">
                                 <label>Ejercicio evaluativo</label>
                                 <br/>
                                 {{$data->juego_evaluativo}}
                              </td>
                           </tr>
                           <tr>
                              <td style="text-align: center;font-size: 10px;">
                                 <strong> Hidratación</strong>
                              </td>
                           </tr>
                           <tr>
                              <td style="text-align: center;font-size: 10px;">
                                 <strong>Estiramiento final</strong>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                  </td>
                  <td style="text-align: center;font-size: 10px;"><label>En minutos</label>
                     <br/>{{$data->tiempo3}}
                  </td>
               </tr>
               <tr>
                  <td style="text-align: center;font-size: 10px;">4</td>
                  <td style="text-align: center;font-size: 10px;">
                     <table style="width:100%">
                        <tbody>
                           <tr>
                              <td style="text-align: center;font-size: 10px;">
                                 <label>RECOGER IMPLEMENTACIÓN/CUIDADO DEL MEDIO</label>
                              </td>
                           </tr>
                           <tr>
                              <td style="text-align: center;font-size: 10px;">
                                 <label>CHARLA FINAL</label>
                              </td>
                           </tr>
                           <tr>
                              <td style="text-align: center;font-size: 10px;">
                                 <label>DESPEDIDA</label>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                  </td>
                  <td style="text-align: center;font-size: 10px;">
                     <label>En minutos</label>
                     <br>
                     {{$data->tiempo4}}
                  </td>
               </tr>
               <tr>
                  <td style="text-align: center;font-size: 10px;" colspan="3">
                     <label>OBSERVACIONES</label>
                     <br/>
                     {{$data->observaciones}}
                  </td>
               </tr>
               <tr>
                        <td style="text-align: center;font-size: 10px;" colspan="3">
                           <center>
                           <br/>
                           <br/>
                           <br/>
                           __________________________________________________
                           <br/>
                           <span class="firma">Firma del monitor</span>
                        </center>
                  </td>
               </tr>
               <tr>
                        <td style="text-align: center;font-size: 10px;text-transform: uppercase;" colspan="3">
                           <center>
                           <br/>
                           <br/>
                           <br/>
                           __________________________________________________
                           <br/>
                           <span class="firma">Nombre y firma del metodólogo</span>
                        </center>
                  </td>
               </tr>
            </tbody>
   </table>
		<br>
		<img width="100%" src="images/sesiones-clase-footer.png"/>
   <!--</body>-->
<!--</html>-->