<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\CreateNumberController;
use App\Models\TblGenContrato;
use App\Models\TblGenContratoCuota;
use App\Models\TblGenContratoCuentaCobro;
use App\Models\TblGenPersona;
use App\TblGenContratoCuentaCobroEstado;
use App\Models\TblGenContratoCuotaEstado;
use App\Models\TblGenContratoCuentaCobroLugar;
use App\Models\TblDvGrupos;
use App\Comuna;
use App\User;
use Barryvdh\DomPDF\Facade as PDF;
use Dompdf\Dompdf;
use response;
use DB;

class PostDCPController extends Controller
{
    private function supervisor()
    {
        $data=DB::table('tbl_dv_config')
        ->where('name','=','supervisor')
        ->select('value')
        ->first();
        return $data->value;
    }
    private function pdfcdp($view,$name='file.pdf')
    {
        //echo $view;exit;
        $dompdf = new Dompdf();
        $dompdf->loadHtml($view);
        #format footer
        $fontzise=7;
        $dompdf->getCanvas()
        ->page_text(518, 718, "Pagina: {PAGE_NUM} de {PAGE_COUNT}", 3, $fontzise, array(0,0,0));
        $dompdf->getCanvas()
        ->page_text(56, 705, "Este documento es propiedad de la Administración Central del Municipio de Santiago de Cali. Prohibida su alteración o modificación por cualquier medio, sin previa autorización ", 3, $fontzise, array(0,0,0));
        $dompdf->getCanvas()
        ->page_text(56, 715, "del Alcalde.", 3, $fontzise, array(0,0,0));

        if($name=='DOCUMENTO EQUIVALENTE')
        {
          $dompdf->getCanvas()
          ->page_text(170, 645, "___________________________________________________", 3, 10, array(0,0,0));
          $dompdf->getCanvas()
          ->page_text(204, 665, "FIRMA Y CÉDULA DEL BENEFICIARIO.", 3, 11, array(0,0,0));
        }

        #format footer
        $dompdf->setPaper('letter');
        $dompdf->render();
        $dompdf->stream(
         'file.pdf' , array( 'Attachment'=>0 ) 
        );
    }

    private function formatcdp1($id)
    {
        $number=new CreateNumberController();
        $sql="SELECT 
              `view_cdp_documento_equivalente`.`id`,
              `view_cdp_documento_equivalente`.`id_gen_persona`,
              concat_ws(
              ' de ',
              DATE_FORMAT(`view_cdp_documento_equivalente`.`fecha_transaccion`, \"%d\"),
              fn_mes_fecha(`view_cdp_documento_equivalente`.`fecha_transaccion`),
              DATE_FORMAT(`view_cdp_documento_equivalente`.`fecha_transaccion`, \"%Y\")
              ) as fecha_transaccion,
              `view_cdp_documento_equivalente`.`nombre_primero`,
              `view_cdp_documento_equivalente`.`nombre_segundo`,
              `view_cdp_documento_equivalente`.`apellido_primero`,
              `view_cdp_documento_equivalente`.`apellido_segundo`,
              FORMAT(`view_cdp_documento_equivalente`.`documento`,0, 'de_DE') as `documento`,
              `view_cdp_documento_equivalente`.`residencia_direccion`,
              `view_cdp_documento_equivalente`.`telefono`,
              `view_cdp_documento_equivalente`.`contrato_objeto`,
              `view_cdp_documento_equivalente`.`rpc`,
              `view_cdp_documento_equivalente`.`dcp`,
              FORMAT(`view_cdp_documento_equivalente`.`contrato_valor`,0, 'de_DE') as `contrato_valor`,
              `view_cdp_documento_equivalente`.`cuota_numero`,
              `view_cdp_documento_equivalente`.`contrato_numero`,
              `view_cdp_documento_equivalente`.`valor_cuota`,
              `view_cdp_documento_equivalente`.`correo_electronico`
            FROM
              `view_cdp_documento_equivalente`
            WHERE
              `view_cdp_documento_equivalente`.`id` = ?";
        $data=DB::select($sql,[$id]);
        //echo'<pre>'.(str_replace('?',$id,$sql));exit;
        $data=$data[0];
        $data->valor_cuota_letras=$number->convertir($data->valor_cuota);
        $data->numero_cuota_letras=$number->convertir($data->cuota_numero);   
        return $data;
    }
    private function formatcdp3($id)
    {
        $sql='SELECT 
          `tbl_gen_persona`.`nombre_primero`,
          `tbl_gen_persona`.`nombre_segundo`,
          `tbl_gen_persona`.`apellido_primero`,
          `tbl_gen_persona`.`apellido_segundo`,
          `tbl_gen_persona`.`documento`,
          `tbl_gen_contrato_cuenta_cobro`.`fecha_transaccion`,
          fn_mes_fecha(`tbl_gen_contrato_cuenta_cobro`.`fecha_transaccion`) as mes,
          `tbl_gen_contrato_cuenta_cobro`.`planilla_numero`,
          `tbl_gen_contrato_cuenta_cobro`.`pin_numero`,
          `tbl_gen_contrato_cuenta_cobro`.`operador`,
          `tbl_gen_contrato_cuenta_cobro`.`fecha_pago`,
          `tbl_gen_contrato_cuenta_cobro`.`tareas_supervisor`,
          `tbl_gen_contrato_cuenta_cobro`.`tareas_informe_mensual`,
          \'\' as lugar,
          `tbl_gen_contrato`.`contrato_objeto`
        FROM
          `tbl_gen_contrato_cuenta_cobro`
          INNER JOIN `tbl_gen_contrato` ON (`tbl_gen_contrato_cuenta_cobro`.`id_contrato` = `tbl_gen_contrato`.`id`)
          INNER JOIN `tbl_gen_persona` ON (`tbl_gen_contrato`.`id_persona` = `tbl_gen_persona`.`id`)
          WHERE
          `tbl_gen_contrato_cuenta_cobro`.`id`=?';  
        $data=DB::select($sql,[$id]);
        $data[0]->supervisor=$this->supervisor();
        return ($data[0]);
    }
    public function editinf1($id)
    {
        return view('editcdp.inf1');
    }
    public function editinf2($id)
    {
        return view('editcdp.inf2');
    }
    public function editinf3($id)
    {
        return view('editcdp.inf3');        
    }
    private function fecha_letras($fecha,$MostrarAnno=true)
    {
        $mes=array();
        $mes['01']='Enero';
        $mes['02']='Febrero';
        $mes['03']='Marzo';
        $mes['04']='Abril';
        $mes['05']='Mayo';
        $mes['06']='Junio';
        $mes['07']='Julio';
        $mes['08']='Agosto';
        $mes['09']='Septiembre';
        $mes['10']='Octubre';
        $mes['11']='Noviembre';
        $mes['12']='Diciembre';
        $fecha=(explode('-',$fecha));
        $dmes=$fecha[1];
        $fecha1=
        $fecha[2]
        .' de '.($mes[$dmes]);
        if($MostrarAnno)
        {$fecha1.=' del '.$fecha[0];}

        return ($fecha1);
    }
    private function mes_periodo($date)
    {

    }
    private function formatcdp2($id)
    {
        $number=new CreateNumberController();
        $data=DB::table('view_cdp_informe_parcial')
        ->where('id','=',$id)
        ->first();
        $data->contrato_valor_letras=$number->convertir($data->contrato_valor);
        $data->fecha_transaccion=$number->FechaNombre($data->fecha_transaccion);
        $data->supervisor=$this->supervisor();
        $data->anno=date('Y',strtotime($data->fecha_inicio));
        $data->informe_final=($data->cuotas==$data->cuota_numero);
        $data->fecha_inicio_letras=$this->fecha_letras($data->fecha_inicio,false);
        $data->fecha_terminacion_letras=$this->fecha_letras($data->fecha_terminacion);
        $data->mes_periodo=explode(' de ',$data->fecha_transaccion);
        $data->mes_periodo=$data->mes_periodo[1];
        return (array)$data;
    }
    public function informedias($id_grupo,$mes, $id_comuna)
    {

        $res=array();
        if($mes=='todo')
        {
            for($i=1;$i<=12;$i++)
            {

                $res[]=$this->informeDiasMes($id_grupo,($i<10)?'0'.$i:$i, $id_comuna);

            }
        }
        else{
            $res[]=$this->informeDiasMes($id_grupo,$mes, $id_comuna);
        }
        return $res;
    }
    private function informeDiasMes($id_grupo,$mes, $id_comuna)
    {


        $dia_inicio='2019-'.$mes.'-01';

        $date1      = new \DateTime($dia_inicio);
        $date2      = new \DateTime($dia_inicio);

        $date2->modify('last day of this month');
        
        $dia_fin  = $date2->format('Y-m-d');
        $diff = $date1->diff($date2);
        $dias=$diff->days;
        $total=0;
        $fecha_actual=$dia_inicio;
        $dias_laborales = $this->DiasAsignados($id_grupo, $id_comuna);
        for($i=0;$i<=$dias;$i++)
        {
            $dia = date('w',strtotime($fecha_actual));
            $arrayDias = array( 'Domingo', 'Lunes', 'Martes','Miercoles', 'Jueves', 'Viernes', 'Sabado');
            $fecha_actual = date("Y-m-d",strtotime($fecha_actual."+ 1 days"));
            $encontrado = array_search($arrayDias[$dia], array_column($dias_laborales, 'dia'));
            if($encontrado!==false)
            {
                $total=$total + 1;
            }

        }
        $nombremes['01']='Enero';
        $nombremes['02']='Febrero';
        $nombremes['03']='Marzo';
        $nombremes['04']='Abril';
        $nombremes['05']='Mayo';
        $nombremes['06']='Junio';
        $nombremes['07']='Julio';
        $nombremes['08']='Agosto';
        $nombremes['09']='Septiembre';
        $nombremes['10']='Octubre';
        $nombremes['11']='Noviembre';
        $nombremes['12']='Diciembre';
        $total_programadas=$this->clases_programadas($id_grupo,$dia_inicio,$dia_fin, $id_comuna);
        $total_programadas_asistencias=$this->clases_programadas_asistencias($id_grupo,$dia_inicio,$dia_fin, $id_comuna);
        return ['mes'=>$nombremes[$mes],'grupo'=>$id_grupo,'clases_asignadas'=>$total,'Clases_programadas'=>$total_programadas, 'total_asistencias' => $total_programadas_asistencias, 'Diferencia'=>($total_programadas-$total)];
    }
    public function grupodia()
    {

        return view('fechas.index')->with(['grupos'=>TblDvGrupos::orderBy('codigo_grupo')->where('activo', '=', 1)->get(), 'comunas' => Comuna::select('id', 'nombre_comuna')->orderBy('nombre_comuna', 'asc')->get()]);
    }
    private function clases_programadas($id_grupo,$inicio,$fin, $id_comuna)
    {


        if ($id_comuna == 'noseleccionado') 
        {


        $data = DB::select('SELECT 
        count(*) as total
        FROM
          `tbl_dv_grupos_horario_planificacion`
        WHERE
          `tbl_dv_grupos_horario_planificacion`.`id_grupo`='.(int)$id_grupo.' 
          AND
          `tbl_dv_grupos_horario_planificacion`.`activo`=1
            AND
          date(`tbl_dv_grupos_horario_planificacion`.`fecha`)
            BETWEEN date("'.$inicio.'") AND date("'.$fin.'")');

        return $data[0]->total;

        }

        else if ($id_comuna != 'noseleccionado' && $id_grupo != 'null') {
        

        $data = DB::select('SELECT 
        count(*) as total
        FROM
          `tbl_dv_grupos_horario_planificacion`
        WHERE
          `tbl_dv_grupos_horario_planificacion`.`id_grupo`='.(int)$id_grupo.' 
          AND
          `tbl_dv_grupos_horario_planificacion`.`activo`=1
            AND
          date(`tbl_dv_grupos_horario_planificacion`.`fecha`)
            BETWEEN date("'.$inicio.'") AND date("'.$fin.'")');

        return $data[0]->total;

        }

        else if($id_comuna != 'noseleccionado' && $id_grupo == 'null')
        {


        $data = DB::select('SELECT 
        count(*) as total
        FROM
          `tbl_dv_grupos_horario_planificacion`

         INNER JOIN `tbl_dv_grupos` ON (`tbl_dv_grupos_horario_planificacion`.`id_grupo` = `tbl_dv_grupos`.`id`)
         INNER JOIN `comunas` ON (`tbl_dv_grupos`.`id_comuna_impacto` = `comunas`.`id`)


        WHERE
          `tbl_dv_grupos`.`id_comuna_impacto`='.(int)$id_comuna.' 
          AND
          `tbl_dv_grupos_horario_planificacion`.`activo`=1
            AND
          date(`tbl_dv_grupos_horario_planificacion`.`fecha`)
            BETWEEN date("'.$inicio.'") AND date("'.$fin.'")');

        return $data[0]->total;


        }
    }


 private function clases_programadas_asistencias($id_grupo,$inicio,$fin, $id_comuna)
    { 


              if ($id_comuna == 'noseleccionado') 
        {


        $data = DB::select('SELECT 
                 tbl_dv_asistencias.fecha_asistencia     
        FROM
          `tbl_dv_grupos_horario_planificacion`
        INNER JOIN `tbl_dv_grupos` ON (`tbl_dv_grupos_horario_planificacion`.`id_grupo` = `tbl_dv_grupos`.`id`)
                INNER JOIN `tbl_dv_asistencias` ON (`tbl_dv_asistencias`.`id_grupo` = `tbl_dv_grupos`.`id`)
        
        WHERE
          `tbl_dv_grupos_horario_planificacion`.`id_grupo`='.(int)$id_grupo.'  
          AND
          `tbl_dv_grupos_horario_planificacion`.`activo`=1
                    
                    AND
          `tbl_dv_asistencias`.`siasistio`=1
         
            AND
          date(`tbl_dv_grupos_horario_planificacion`.`fecha`)
            BETWEEN date("'.$inicio.'") AND date("'.$fin.'")
                        GROUP BY tbl_dv_asistencias.fecha_asistencia    
                        ORDER BY COUNT(tbl_dv_asistencias.fecha_asistencia) DESC');



        $cantidad = count($data);

        return $cantidad;

      }

              else if ($id_comuna != 'noseleccionado' && $id_grupo != 'null') {

        $data = DB::select('SELECT 
                 tbl_dv_asistencias.fecha_asistencia     
        FROM
          `tbl_dv_grupos_horario_planificacion`
        INNER JOIN `tbl_dv_grupos` ON (`tbl_dv_grupos_horario_planificacion`.`id_grupo` = `tbl_dv_grupos`.`id`)
                INNER JOIN `tbl_dv_asistencias` ON (`tbl_dv_asistencias`.`id_grupo` = `tbl_dv_grupos`.`id`)
        
        WHERE
          `tbl_dv_grupos_horario_planificacion`.`id_grupo`='.(int)$id_grupo.'  
          AND
          `tbl_dv_grupos_horario_planificacion`.`activo`=1
                    
                    AND
          `tbl_dv_asistencias`.`siasistio`=1
         
            AND
          date(`tbl_dv_grupos_horario_planificacion`.`fecha`)
            BETWEEN date("'.$inicio.'") AND date("'.$fin.'")
                        GROUP BY tbl_dv_asistencias.fecha_asistencia    
                        ORDER BY COUNT(tbl_dv_asistencias.fecha_asistencia) DESC');



        $cantidad = count($data);

        return $cantidad;



}

        else if($id_comuna != 'noseleccionado')
        {


        $data = DB::select('SELECT 
                 tbl_dv_asistencias.fecha_asistencia     
        FROM
          `tbl_dv_grupos_horario_planificacion`
        INNER JOIN `tbl_dv_grupos` ON (`tbl_dv_grupos_horario_planificacion`.`id_grupo` = `tbl_dv_grupos`.`id`)
                INNER JOIN `tbl_dv_asistencias` ON (`tbl_dv_asistencias`.`id_grupo` = `tbl_dv_grupos`.`id`)
        
         INNER JOIN `comunas` ON (`tbl_dv_grupos`.`id_comuna_impacto` = `comunas`.`id`)


        WHERE 
          `tbl_dv_grupos`.`id_comuna_impacto`='.(int)$id_comuna.' 
          AND
          `tbl_dv_grupos_horario_planificacion`.`activo`=1
                    
                    AND
          `tbl_dv_asistencias`.`siasistio`=1
         
            AND
          date(`tbl_dv_grupos_horario_planificacion`.`fecha`)
            BETWEEN date("'.$inicio.'") AND date("'.$fin.'")
                        GROUP BY tbl_dv_asistencias.fecha_asistencia    
                        ORDER BY COUNT(tbl_dv_asistencias.fecha_asistencia) DESC');



        $cantidad = count($data);


        return $cantidad;

        

        }



    }

    private function DiasAsignados($id_grupo, $id_comuna)
    {


        if ($id_grupo != 'null') {

        $data = DB::select('SELECT 
        `tbl_dv_grupos_horario`.`dia`
      FROM
        `tbl_dv_grupos_horario`
             INNER JOIN `tbl_dv_grupos` ON (`tbl_dv_grupos_horario`.`id_grupo` = `tbl_dv_grupos`.`id`)
     INNER JOIN `comunas` ON (`tbl_dv_grupos`.`id_comuna_impacto` = `comunas`.`id`)


      WHERE
        `tbl_dv_grupos_horario`.`id_grupo` = '.(int)$id_grupo);


        return $data;

        }

        else if($id_grupo == 'null' && $id_comuna != 'null')
        {

        $data = DB::select('SELECT 
        `tbl_dv_grupos_horario`.`dia`
      FROM
        `tbl_dv_grupos_horario`
             INNER JOIN `tbl_dv_grupos` ON (`tbl_dv_grupos_horario`.`id_grupo` = `tbl_dv_grupos`.`id`)
     INNER JOIN `comunas` ON (`tbl_dv_grupos`.`id_comuna_impacto` = `comunas`.`id`)


      WHERE
        `comunas`.`id` = '.(int)$id_comuna);


        return $data;


        }



    }


    public function obtener_grupos()
    {
        $grupos = TblDvGrupos::select('tbl_dv_grupos.id', 'tbl_dv_grupos.codigo_grupo')->orderBy('codigo_grupo')->where('activo', '=', 1)->get();
        return $grupos;

    }


        public function obtener_monitores($comuna)
    {

        $grupos = User::select(
        'users.id',
         DB::raw("CONCAT(users.primer_nombre, ' ', users.primer_apellido) AS nombres"))
        ->join('role_user', 'role_user.user_id', '=', 'users.id')
        ->join('tbl_dv_grupos', 'tbl_dv_grupos.id_monitor', '=', 'users.id')
        ->join('comunas', 'tbl_dv_grupos.id_comuna_impacto', '=', 'comunas.id')
        ->join('tbl_dv_empleado', 'tbl_dv_empleado.id_usuario', '=', 'users.id')
        ->where('tbl_dv_empleado.id_estado_aspirante', '!=', 6)
        ->where('role_user.role_id', '=', 7)
        ->where('tbl_dv_grupos.id_comuna_impacto', '=', (int)$comuna)
        ->groupBy('users.id')
        ->get();
        return $grupos;


    }

    public function obtener_grupos_monitores($monitor)
    {

        $grupos = TblDvGrupos::select('tbl_dv_grupos.id', 'tbl_dv_grupos.codigo_grupo')
        ->where('tbl_dv_grupos.id_monitor', '=', (int)$monitor)
        ->where('tbl_dv_grupos.activo', '=', 1)
        ->orderBy('tbl_dv_grupos.codigo_grupo')
        ->get();
        return $grupos;

    }


    public function grupos_comunas($comuna)
    {
        $grupos = TblDvGrupos::join('comunas', 'tbl_dv_grupos.id_comuna_impacto', '=', 'comunas.id')->where('tbl_dv_grupos.id_comuna_impacto', '=', $comuna)->get();

        return $grupos;
    }
    public function cdp1($id)
    {
        $view=view('cdp.format1',['data'=>$this->formatcdp1($id)])->render();
        $this->pdfcdp($view,'DOCUMENTO EQUIVALENTE');        
    }
    public function cdp2($id)
    {
        $data=$this->formatcdp2($id);
        $view=view('cdp.format2',$data)->render();
        //exit($view);
        $this->pdfcdp($view,'INFORME PARCIAL');
    }
    public function cdp3($id_cuenta_cobro)
    {
        $view=view('cdp.format3',
            [
                'data'=>$this->formatcdp3($id_cuenta_cobro),
                'fotos'=>$this->fotos($id_cuenta_cobro)
            ])->render();
        //echo $view;exit;
        $this->pdfcdp($view,'INFORME MENSUAL');
    }
    private function fotos($id_gen_contrato_cuenta_cobro)
    {
        $res = TblGenContratoCuentaCobroLugar::where('id_gen_contrato_cuenta_cobro','=',$id_gen_contrato_cuenta_cobro)->get();
        return($res);
    }
    #informes de cdp


    public function data()
    {
        return view('cdp.filters');
    }
    private function contrato()
    {
     $sql='SELECT 
                  `tbl_gen_contrato`.`contrato_objeto`
                FROM
                  `tbl_gen_contrato`
                  INNER JOIN `tbl_dv_empleado` ON (`tbl_gen_contrato`.`id_persona` = `tbl_dv_empleado`.`id_persona`)
                  WHERE
                    `tbl_dv_empleado`.`id_usuario`=?';
        $contrato=DB::select($sql,[Auth::user()->id]);
        return $contrato;
    }
    private function cuotascontrato()
    {
        $sql='SELECT 
                `tbl_gen_contrato_cuota`.`id`,
                `tbl_gen_contrato_cuota`.`cuota_numero`,
                `tbl_gen_contrato_cuota`.`valor_saldo`,
                `tbl_gen_contrato_cuota`.`valor_cuota`
            FROM
                `tbl_gen_contrato_cuota`
                INNER JOIN `tbl_gen_contrato` ON (`tbl_gen_contrato_cuota`.`id_contrato` = `tbl_gen_contrato`.`id`)
                INNER JOIN `tbl_dv_empleado` ON (`tbl_gen_contrato`.`id_persona` = `tbl_dv_empleado`.`id_persona`)
            WHERE
                `tbl_dv_empleado`.`id_usuario` = ? AND 
                `tbl_gen_contrato_cuota`.`id` NOT IN (SELECT `tbl_gen_contrato_cuenta_cobro`.`id_contrato_cuota` FROM `tbl_gen_contrato_cuenta_cobro` WHERE `tbl_gen_contrato_cuenta_cobro`.`id_cuenta_cobro_estado` IN (1,3))
            ORDER BY
                `tbl_gen_contrato_cuota`.`cuota_numero`';
        $contrato=DB::select($sql,[Auth::user()->id]);
        return $contrato;
    } 
    public function newcdp()
    {
        $contrato=$this->contrato();
        $cuotas=$this->cuotascontrato();
        $tareas_mensuales='';
        $tareas_supervisor='';
        $objeto_contrato='';
        if(count($contrato)>0)
        {
            $data=$contrato[0];
            $tareas_mensuales='';
            $tareas_supervisor='';
            $objeto_contrato=$data->contrato_objeto;
        }
        $cuotas = (count($cuotas)>0)?$cuotas:[];
        return view('cdp.new')->with([
            'cuotas'=>$cuotas,
            'tareas_mensuales'=>$tareas_mensuales,
            'tareas_supervisor'=>$tareas_supervisor,
            'objeto_contrato'=>$objeto_contrato
        ]);
    }
    private function saveimages($file,$id_cuenta_cobro,$lugar)
    {
        if(isset($file['fotos']))
        {
            $ds=DIRECTORY_SEPARATOR;
            $id_user=Auth::user()->id;
            $url2='cdp'.$ds.$id_user.$ds.$id_cuenta_cobro;
            $url=dirname(__FILE__).$ds.'..'.$ds.'..'.$ds.'..'.$ds.'public'.$ds.$url2;
            
            if(!file_exists($url))
            {
                mkdir($url, 0777, true);
            }
            foreach($file['fotos']['name'] as $key=> $temp)
            {
                $fichero=$file['fotos']['tmp_name'][$key];
                $nuevo_fichero=$url.$ds.$file['fotos']['name'][$key];
                if (!copy($fichero, $nuevo_fichero)) 
                {
                    echo "Error al copiar $fichero...\n";
                } 
                else{
                    $insert                               = new TblGenContratoCuentaCobroLugar();
                    $insert->lugar                        = $lugar[$key];
                    $insert->id_gen_contrato_cuenta_cobro = $id_cuenta_cobro;
                    $insert->url_imagen                    = $url2.$ds.$file['fotos']['name'][$key];
                    $insert->save();
                }
            }
        }
    }
    public function savecuentacobro(Request $request)
    {
        $file = $_FILES;
        $data=DB::table('tbl_gen_contrato')
            ->join('tbl_dv_empleado', 'tbl_gen_contrato.id_persona', '=', 'tbl_dv_empleado.id_persona')
            ->select('tbl_gen_contrato.id')
            ->where('tbl_gen_contrato.activo','=',1)
            ->where('tbl_dv_empleado.id_usuario','=', Auth::user()->id)
            ->first();
        $save                                   = TblGenContratoCuentaCobro::firstOrNew(['id_contrato_cuota'=>$request->input('Cuota')]);
        $save->id_cuenta_cobro_estado           = 3;
        $save->id_contrato                      = $data->id;
        $save->fecha_transaccion                = $request->input('fecha_transaccion');
        $save->planilla_numero                  = $request->input('Planilla');
        $save->pin_numero                       = $request->input('pin');
        $save->operador                         = $request->input('operador');
        $save->fecha_pago                       = $request->input('fecha_pago');
        $save->periodo_pago_seguridad_social    = $request->input('periodo_seguridad_social');
        $save->tareas_supervisor                = $request->input('tareas_supervisor');
        $save->tareas_informe_mensual           = $request->input('tareas_mensuales');
        $save->id_contrato_cuota                = $request->input('Cuota');
        $save->periodo_seguridad_social_year    = $request->input('periodo_seguridad_social_year');
        $save->retencion_pensiones              = $request->input('retencion_pensiones');
        $save->retencion_periodo                = $request->input('retencion_periodo');
        $save->revaluacion                      = $request->input('revaluacion');
        $save->Save();
        $this->saveimages($_FILES,$save->id,$request->lugar);
        if(!is_null($request->input('edit')))
        {
            $data=$request->input('edit');
            foreach($data as $key=>$temp)
            {
                $insert         = TblGenContratoCuentaCobroLugar::find($key);
                $insert->lugar  = $temp;
                $insert->save();
            }
        }
        return json_encode(['validate'=>TRUE,'id'=>$save->id]);
    }
    public function data_contratos()
    {
        $sql="SELECT 
        `tbl_gen_persona`.`id`,
        concat_ws(' ',
              `tbl_gen_persona`.`nombre_primero`,
              `tbl_gen_persona`.`nombre_segundo`,
              `tbl_gen_persona`.`apellido_primero`,
              `tbl_gen_persona`.`apellido_segundo`,'') as nombres,
              COALESCE(`tbl_gen_persona`.`documento`,'') as documento,
              COALESCE(`tbl_gen_contrato`.`contrato_numero`,'') as contrato_numero,
              COALESCE(`tbl_gen_contrato`.`rcp`,'') as rcp,
              COALESCE(`tbl_gen_contrato`.`dcp`,'') as dcp,
              COALESCE(`tbl_gen_contrato`.`contrato_valor`,'') as contrato_valor,
              COALESCE(`tbl_gen_contrato`.`contrato_objeto`,'') as contrato_objeto,
              COALESCE(`tbl_gen_contrato`.`cuotas`,'') as cuotas,
              COALESCE(`tbl_gen_contrato`.`fecha_inicio`,'') as fecha_inicio,
              COALESCE(`tbl_gen_contrato`.`fecha_plazo_ejecucion`,'') as fecha_plazo_ejecucion,
              COALESCE(`tbl_gen_contrato`.`fecha_terminacion`,'') as fecha_terminacion
            FROM
              `tbl_gen_persona`
              LEFT OUTER JOIN `tbl_dv_empleado` ON (`tbl_gen_persona`.`id` = `tbl_dv_empleado`.`id_persona`)
              LEFT OUTER JOIN `tbl_gen_contrato` ON (`tbl_gen_persona`.`id` = `tbl_gen_contrato`.`id_persona`)
              ORDER BY 
              `tbl_gen_contrato`.`fecha_inicio`";
              $data = DB::select($sql,[]);
              return json_encode(['data'=>$data, 'validate'=>TRUE],128);
    }
    public function index()
    {
    	$sql="SELECT 
				  `tbl_gen_persona`.`documento`,
				  `tbl_gen_contrato`.`rcp`,
				  `tbl_gen_contrato`.`dcp`,
				  `tbl_gen_contrato`.`contrato_numero`,
				  `tbl_gen_contrato`.`contrato_valor`,
				  `tbl_gen_contrato`.`cuotas`,
				  DATE_FORMAT(`tbl_gen_contrato`.`fecha_inicio`,'%d/%m/%Y') as fecha_inicio,
          DATE_FORMAT(`tbl_gen_contrato`.`fecha_terminacion`,'%d/%m/%Y') as fecha_terminacion,
				  DATE_FORMAT(`tbl_gen_contrato`.`fecha_plazo_ejecucion`,'%d/%m/%Y') as fecha_plazo_ejecucion,
				  `tbl_gen_contrato`.`contrato_objeto`
				FROM
				  `tbl_gen_contrato`
				  INNER JOIN `tbl_gen_persona` ON (`tbl_gen_contrato`.`id_persona` = `tbl_gen_persona`.`id`)
                  WHERE
                  `tbl_gen_contrato`.`activo`=1
                  ORDER BY
                  `tbl_gen_contrato`.`fecha_inicio` DESC,
                  `tbl_gen_persona`.`documento` ASC";
    	$data = DB::select($sql,[]);
    	$res=(count($data)===0)?[['','','','','','','','','']]:array();
        foreach($data as $temp)
        {
            $temp1=[];
        	foreach($temp as $temp2)
        	{
        	   $temp1[]=$temp2;
        	}
        	$res[]=$temp1;
        }
    	return json_encode($res,128);
    }
    public function load(Request $request)
    {
        $persona = new PostPersonalController();
        $res=$request->input('getdata');
        $res=json_decode($res,TRUE);
        foreach($res as $temp)
        { 
            $x=$persona->data_persona($temp[0]);
            $value = (count($x)===0)?-1:$x[0]['id_persona'];
        }
    }
    ######################################VALIDANDO DATOS######################################
    private function ValidarDocumento($documento)
    {
        if(trim($documento)==='' ||trim($documento)=='0' )
            {return false;}
        $documento=trim(str_replace(',','', $documento));
        $persona=TblGenPersona::where('documento','=',$documento)->get();
        return(count($persona)>0);
    }
    private function ValidarRCP($RCP)
    {
        if(!is_numeric(trim($RCP)))
        {
            return false;
        }
        $sql  ='SELECT `tbl_gen_contrato`.`id`
              FROM `tbl_gen_contrato`
              WHERE TRIM(UPPER(`tbl_gen_contrato`.`rcp`)) = TRIM(UPPER(?))';
        $data = DB::select($sql,[$RCP]);
        return true;//(count($data)==0);
    }
    private function ValidarDCP($DCP)
    {
        if(!is_numeric(trim($DCP)))
        {
            return false;
        }
        $sql  ='SELECT `tbl_gen_contrato`.`id`
              FROM `tbl_gen_contrato`
              WHERE TRIM(UPPER(`tbl_gen_contrato`.`dcp`)) = TRIM(UPPER(?))';
        $data = DB::select($sql,[$DCP]);
        return true;//(count($data)==0);
    }
    private function ValidarContrato($Contrato)
    {
        $long=strlen($Contrato);
        return true;//(($long>=1 && $long<=4) && (ctype_digit($Contrato)));
    }
    private function ValidarValorContrato($ValorContrato)
    {
        $valores=explode('.',$ValorContrato);
        if(count($valores)>1)
        {
            return FALSE;
        }
        else
        {
            $ValorContrato=$valores[0];
        }
        $ValorContrato_filter=trim(str_replace(['$',','], ['',''], $ValorContrato));
        return is_numeric($ValorContrato_filter);
    }
    private function ValidarCuotas($Cuotas)
    {
        if(is_numeric($Cuotas))
        {
            return (ctype_digit($Cuotas));
            
        }
        else
        {
            return false;
        }
    }
    private function ValidarFecha($fecha)
    {
        $tempDate = explode('/', $fecha);
        if(count($tempDate)!=3)
        {
            return false;
        }
        else
        {
            return (checkdate($tempDate[1], $tempDate[0], $tempDate[2]));
        }
    }
    private function ValidarFechaFin($FechaInicio,$FechaFin,$Cuotas)
    {
        return $this->ValidarFecha($FechaFin);
    }

    ######################################VALIDANDO DATOS######################################
    public function Validar(Request $request)
    {
        $valido=true;
        $errores=0;
        $data=($request->all());
        $tipodato=(object)[
            'documento'=>0,
            'RCP'=>1,
            'DCP'=>2,
            'Contrato'=>3,
            'ValorContrato'=>4,
            'Cuotas'=>5,
            'FechaInicio'=>6,
            'FechaFin'=>7,
            'fecha_plazo_ejecucion'=>8,
        ];
        $error=array();
        foreach($data['data'] as $key   =>  $temp)
        {
            $documento      = $temp[$tipodato->documento];
            $RCP            = $temp[$tipodato->RCP];
            $DCP            = $temp[$tipodato->DCP];
            $Contrato       = $temp[$tipodato->Contrato];
            $ValorContrato  = $temp[$tipodato->ValorContrato];
            $Cuotas         = $temp[$tipodato->Cuotas];
            $FechaInicio    = $temp[$tipodato->FechaInicio];
            $FechaFin       = $temp[$tipodato->FechaFin];
            $fecha_plazo_ejecucion  = $temp[$tipodato->fecha_plazo_ejecucion];

            $temperror=[];
            $temperror[$tipodato->documento]=($this->ValidarDocumento($documento));
            $temperror[$tipodato->RCP]=($this->ValidarRCP($RCP));
            $temperror[$tipodato->DCP]=($this->ValidarDCP($DCP));
            $temperror[$tipodato->Contrato]=($this->ValidarContrato($Contrato));
            $temperror[$tipodato->ValorContrato]=($this->ValidarValorContrato($ValorContrato));
            $temperror[$tipodato->Cuotas]=($this->ValidarCuotas($Cuotas));
            $temperror[$tipodato->FechaInicio]=($this->ValidarFecha($FechaInicio));
            $temperror[$tipodato->fecha_plazo_ejecucion]=($this->ValidarFecha($fecha_plazo_ejecucion));
            $temperror[$tipodato->FechaFin]=($this->ValidarFechaFin($FechaInicio,$FechaFin,$Cuotas));
            if(in_array(false, $temperror))
            {
                $valido=FALSE;
                $errores=$errores+1;
            }
            $error[$key]=$temperror;
        }
        return json_encode(['validate'=>$valido,'validations'=>$error,'rows_fails'=>$errores],128);
    }
    private function cuotas($id_contrato,$contrato_valor,$cantidad_cuotas) 
    {
        $contrato_valor=str_replace([',','$'],['',''], $contrato_valor);
        $cantidad_cuotas=str_replace([',','$'],['',''], $cantidad_cuotas);
        $valor_cuota=$contrato_valor/$cantidad_cuotas;
        for($i=0;$i<$cantidad_cuotas;$i++)
        {
            $cuotas=TblGenContratoCuota
            ::where('cuota_numero','=',$i+1)
            ->where('id_contrato','=',$id_contrato)
            ->where('valor_cuota','=',$valor_cuota)->get();
            if(count($cuotas)==0)
            {
              $cuotas = new TblGenContratoCuota();
              $cuotas->cuota_numero = $i+1;
              $cuotas->id_contrato  = $id_contrato;
              $cuotas->valor_cuota  = $valor_cuota;
              $cuotas->valor_saldo  = ($contrato_valor-( $valor_cuota*($i+1) ));
              $cuotas->Save();
              unset($cuotas);
            }
        }
    }
    private function saveEditar($data)
    {
        $contrato = TblGenContrato::firstOrNew(['id_persona'       => $data->id]);
        $contrato->contrato_objeto       = str_replace([',','$'],['',''], $data->contrato_objeto);
        $contrato->contrato_valor        = str_replace([',','$'],['',''], $data->contrato_valor);
        $contrato->cuotas                = str_replace([',','$'],['',''], $data->cuotas);
        $contrato->dcp                   = $data->dcp;
        $contrato->fecha_inicio          = $data->fecha_inicio;
        $contrato->contrato_numero       = $data->contrato_numero;
        $contrato->fecha_terminacion     = $data->fecha_terminacion;
        $contrato->id_persona            = $data->id;
        $contrato->fecha_plazo_ejecucion = $data->fecha_plazo_ejecucion;
        $contrato->rcp                   = $data->rcp;
        $contrato->activo                = 1;
        $contrato->tenantId              = Auth::user()->tenantId;
        $contrato->save();
        $this->cuotas(
            $contrato->id,
            $data->contrato_valor,
            $data->cuotas
        );
        return $contrato->id;
    }
    public function editar(Request $request)
    {
        $id= $this->saveEditar((object)$request->all());
        return json_encode(['validate'=>TRUE,'id'=>$id]);
    }
    public function orderdata(Request $request)
    {
        $data=($request->input('data'));
        $data=json_decode($data);
        $res=[];
        foreach($data as $temp)
        {
            $i=0;
            $temp1=[];
            foreach($temp as $temp2)
            {
               $temp1[]=$temp2;
            }
            $res[]=$temp1;
        }
        return json_encode($res,128);
    }
    public function formatdate($date)
    {
        $dates=explode('/',$date);
        return ($dates[2].'-'.$dates[1].'-'.$dates[0]);
    }
    public function saveContratos(Request $request)
    {
        $data=$request->input('data');
        $persona = new PostPersonalController();
        $ids=[];
        foreach($data as $key=>$temp)
        {
            $data_res_persona=$persona->data_persona($temp[0]);
            $id_persona=($data_res_persona[0]->id_persona);
            $data=[
                "id"=>$id_persona,//Id de la persona
                "rcp"=> $temp[1],
                "dcp"=> $temp[2],
                "contrato_numero"=> $temp[3],
                "contrato_valor"=> $temp[4],
                "cuotas"=> $temp[5],
                "fecha_inicio"=> $this->formatdate($temp[6]),
                "fecha_terminacion"=> $this->formatdate($temp[7]),
                "fecha_plazo_ejecucion"=> $this->formatdate($temp[8]),
                "contrato_objeto"=> $temp[9],
            ];
            $ids[]= $this->saveEditar((object)$data);
        }
        return json_encode(['validate'=>true,'data'=>$ids],128);
    }
    public function phpini()
    {
        echo phpinfo();
    }
    private function cuotaActual($id_cuenta_cobro)
    {
        $sql='SELECT 
                    `tbl_gen_contrato_cuota`.`id`,
                    `tbl_gen_contrato_cuota`.`cuota_numero`,
                    `tbl_gen_contrato_cuota`.`valor_saldo`,
                    `tbl_gen_contrato_cuota`.`valor_cuota`
                FROM
                    `tbl_gen_contrato_cuenta_cobro`
                    INNER JOIN `tbl_gen_contrato_cuota` ON (`tbl_gen_contrato_cuenta_cobro`.`id_contrato_cuota` = `tbl_gen_contrato_cuota`.`id`)
            WHERE
            `tbl_gen_contrato_cuenta_cobro`.`id`=?';
        $contrato=DB::select($sql,[$id_cuenta_cobro]);
        
        $contrato=$contrato[0];
        return $contrato;        
    }
    public function editarCuentaCobro($id)
    {
        $datos_cuenta_cobro=$this->cuenta_cobro($id);
        if($datos_cuenta_cobro->id_cuenta_cobro_estado==1)
        {
            return view('cdp.editfail');
        }
        else
        {
            $contrato=$this->contrato();
            $fotos = $this->fotos_cuota($id);
            $cuotas=$this->cuotaActual($id);
            $objeto_contrato=$contrato[0]->contrato_objeto;

            return view('cdp.edit')->with([
                'cuota'=>$cuotas,
                'datos_cuenta_cobro'=>$datos_cuenta_cobro,
                'objeto_contrato'=>$objeto_contrato,
                'fotos'=>$fotos
            ]);
        }
    }
    public function fotodelete(Request $request)
    {
        $data = TblGenContratoCuentaCobroLugar::find($request->id);
        $data->delete();
        return ['borrado'=>true,'id'=>$request->id];
    }
    private function cuenta_cobro($id_gen_contrato_cuenta_cobro)
    {
        $data =  TblGenContratoCuentaCobro::find($id_gen_contrato_cuenta_cobro);
        $mes['1']='Enero';
        $mes['2']='Febrero';
        $mes['3']='Marzo';
        $mes['4']='Abril';
        $mes['5']='Mayo';
        $mes['6']='Junio';
        $mes['7']='Julio';
        $mes['8']='Agosto';
        $mes['9']='Septiembre';
        $mes['10']='Octubre';
        $mes['11']='Noviembre';
        $mes['12']='Diciembre';
        $data->periodo_pago_seguridad_social_nombre=$mes[$data->periodo_pago_seguridad_social];
        return $data;
    }
    private function fotos_cuota($id_gen_contrato_cuenta_cobro)
    {
        $data = TblGenContratoCuentaCobroLugar::where('id_gen_contrato_cuenta_cobro','=',$id_gen_contrato_cuenta_cobro)->get();
        return $data;
    }
    public function miscuentas()
    {
        return view('cdp.miscuentas');
    }
    public function todascuentas()
    {
        return view('cdp.cuentascobros');
    }
    public function allview()
    {
        return view('cdpadmin.revision')->with([
          'estadoscuota'=>TblGenContratoCuentaCobroEstado::all()
        ]);
    }
    public function alldata()
    {
        $data=DB::select("SELECT 
              `tbl_gen_contrato_cuota`.`id_contrato` AS `id`,
              `tbl_gen_contrato_cuenta_cobro`.`periodo_seguridad_social_year`,
              `fn_mes_fecha`(CONCAT_WS('-', `tbl_gen_contrato_cuenta_cobro`.`periodo_seguridad_social_year`, `tbl_gen_contrato_cuenta_cobro`.`periodo_pago_seguridad_social`, '01')) AS `mes`,
              `tbl_gen_contrato_cuota_estado`.`descripcion` AS `estado`,
              `tbl_gen_persona`.`nombre_primero`,
              `tbl_gen_persona`.`nombre_segundo`,
              `tbl_gen_persona`.`apellido_primero`,
              `tbl_gen_persona`.`apellido_segundo`,
              `tbl_gen_persona`.`documento`
            FROM
              `tbl_gen_contrato_cuenta_cobro`
            INNER JOIN `tbl_gen_contrato_cuenta_cobro_estado` ON (`tbl_gen_contrato_cuenta_cobro`.`id_cuenta_cobro_estado` = `tbl_gen_contrato_cuenta_cobro_estado`.`id`)
            INNER JOIN `tbl_gen_contrato_cuota` ON (`tbl_gen_contrato_cuenta_cobro`.`id_contrato_cuota` = `tbl_gen_contrato_cuota`.`id`)
            INNER JOIN `tbl_gen_contrato_cuota_estado` ON (`tbl_gen_contrato_cuota`.`id_estado` = `tbl_gen_contrato_cuota_estado`.`id`)
            INNER JOIN `tbl_gen_contrato` ON (`tbl_gen_contrato_cuota`.`id_contrato` = `tbl_gen_contrato`.`id`)
            INNER JOIN `tbl_gen_persona` ON (`tbl_gen_contrato`.`id_persona` = `tbl_gen_persona`.`id`)");
        return response()->json($data);
    }
    public function dataMisCuentas()
    {
        $data=DB::table('tbl_gen_contrato')
        ->select(
          'tbl_gen_contrato_cuenta_cobro.id',
          'tbl_gen_contrato_cuenta_cobro.fecha_transaccion',
          'tbl_gen_contrato_cuenta_cobro.id_contrato_cuota',
          'tbl_gen_contrato_cuenta_cobro_estado.id as id_estado',
          'tbl_gen_contrato_cuenta_cobro_estado.descripcion as estado',

          DB::raw('FORMAT(tbl_gen_contrato_cuota.valor_cuota,0) as valor_cuota'),
          DB::raw('FORMAT(tbl_gen_contrato_cuota.valor_saldo,0) as valor_saldo'),
          'tbl_gen_contrato_cuota.cuota_numero'
        )
        ->join('tbl_dv_empleado','tbl_gen_contrato.id_persona','=','tbl_dv_empleado.id_persona')
        ->join('tbl_gen_contrato_cuenta_cobro','tbl_gen_contrato.id','=','tbl_gen_contrato_cuenta_cobro.id_contrato')
        ->join('tbl_gen_contrato_cuota','tbl_gen_contrato_cuenta_cobro.id_contrato_cuota','=','tbl_gen_contrato_cuota.id')
        ->join('tbl_gen_contrato_cuenta_cobro_estado','tbl_gen_contrato_cuenta_cobro.id_cuenta_cobro_estado','=','tbl_gen_contrato_cuenta_cobro_estado.id')
        ->orderBy('tbl_gen_contrato_cuenta_cobro_estado.id')
        ->where('tbl_dv_empleado.id_usuario','=',Auth::user()->id)
        ->get();
        //->toSql();exit(str_replace('?',Auth::user()->id, $data));

        return json_encode(['data'=>$data,'validate'=>TRUE],128);
    }
    public function revisarCuentasCobros($id_cuota_estado)
    {
        $where=($id_cuota_estado=='-1')?'':' WHERE `tbl_gen_contrato_cuenta_cobro_estado`.`id` ='.$id_cuota_estado;
        $data=DB::select('SELECT 
        `tbl_gen_contrato_cuenta_cobro`.`id`,
        `tbl_gen_contrato_cuenta_cobro`.`fecha_transaccion`,
		`tbl_gen_contrato_cuenta_cobro`.`id_contrato_cuota`,
        `tbl_gen_contrato_cuenta_cobro_estado`.`descripcion` AS `estado`,
        `tbl_gen_contrato_cuenta_cobro_estado`.`id` AS `id_estado`,
        `tbl_gen_contrato_cuota`.`cuota_numero`,
        `tbl_gen_persona`.`documento` as numero_documento,
        CONCAT_WS(\' \', `tbl_gen_persona`.`nombre_primero`, `tbl_gen_persona`.`nombre_segundo`, `tbl_gen_persona`.`apellido_primero`, `tbl_gen_persona`.`apellido_segundo`) AS `user`
      FROM
        `tbl_gen_contrato_cuenta_cobro`
        INNER JOIN `tbl_gen_contrato` ON (`tbl_gen_contrato_cuenta_cobro`.`id_contrato` = `tbl_gen_contrato`.`id`)
        INNER JOIN `tbl_gen_persona` ON (`tbl_gen_contrato`.`id_persona` = `tbl_gen_persona`.`id`)
        INNER JOIN `tbl_gen_contrato_cuenta_cobro_estado` ON (`tbl_gen_contrato_cuenta_cobro`.`id_cuenta_cobro_estado` = `tbl_gen_contrato_cuenta_cobro_estado`.`id`)
        INNER JOIN `tbl_gen_contrato_cuota` ON (`tbl_gen_contrato_cuenta_cobro`.`id_contrato_cuota` = `tbl_gen_contrato_cuota`.`id`)
      '.$where.'
      ORDER BY
        `tbl_gen_contrato_cuenta_cobro`.`fecha_transaccion` DESC');
        //->toSql();exit(str_replace('?',$id_cuota_estado, $data));
        return json_encode(['data'=>$data,'validate'=>TRUE],128);
    }
    public function cambiarestado(Request $request)
    {
        $data = TblGenContratoCuentaCobro::where('id','=',$request->input('id_cuenta_cobro'))->firstOrFail();
        $data->id_cuenta_cobro_estado=$request->input('estado');
        $data->save();
        return response()->json(['validate'=>true,'data'=>$data]);
    }
}
