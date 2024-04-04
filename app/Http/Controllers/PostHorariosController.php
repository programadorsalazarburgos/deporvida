<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Institucion;
use App\Grupo;
use App\Http\Controllers\PostGruposController;
use App\Models\TblDvAsistencias;
use App\Models\TblDvGruposHorarioPlanificacion;
use App\Models\TblDvGrupoHorario;
use App\TblDvNovedad;
use response;
use Hashids\Hashids;
use DB;
use Barryvdh\DomPDF\Facade as PDF;
use Dompdf\Dompdf;

class PostHorariosController extends Controller
{
    public function todasplaneaciones($fecha_inicio,$fecha_fin)
    {
        $data=array();
        $sql="SELECT 
              `tbl_dv_grupos_horario_planificacion`.`id`,
              `tbl_dv_grupos_horario_planificacion`.`fecha`,
              `tbl_dv_grupos`.`codigo_grupo`,
              CONCAT(
                fn_dia_fecha(`tbl_dv_grupos_horario_planificacion`.`fecha`),
                ' de ',
                DATE_FORMAT(`tbl_dv_grupos_horario_planificacion`.`hora_inicio`,'%r'),
                ' a ',
                DATE_FORMAT(`tbl_dv_grupos_horario_planificacion`.`hora_fin`,'%r')
              ) AS `horario`,
              `tbl_dv_escenarios`.`nombre_escenario`,
              `tbl_dv_disciplinas`.`descripcion` as disciplina,
              CONCAT_WS(' ',
              `tbl_gen_persona`.`nombre_primero`,
              `tbl_gen_persona`.`nombre_segundo`,
              `tbl_gen_persona`.`apellido_primero`,
              `tbl_gen_persona`.`apellido_segundo`) as monitor,
              `tbl_gen_persona`.`documento`
            FROM
              `tbl_dv_grupos_horario`
  INNER JOIN `tbl_dv_grupos` ON (`tbl_dv_grupos_horario`.`id_grupo` = `tbl_dv_grupos`.`id`)
  INNER JOIN `tbl_dv_grupos_horario_planificacion` ON (`tbl_dv_grupos`.`id` = `tbl_dv_grupos_horario_planificacion`.`id_grupo`)
  INNER JOIN `tbl_dv_escenarios` ON (`tbl_dv_grupos`.`id_escenario` = `tbl_dv_escenarios`.`id`)
  INNER JOIN `tbl_dv_disciplinas` ON (`tbl_dv_grupos`.`id_disciplina` = `tbl_dv_disciplinas`.`id`)
  INNER JOIN `tbl_dv_empleado` ON (`tbl_dv_grupos`.`id_monitor` = `tbl_dv_empleado`.`id_usuario`)
  INNER JOIN `tbl_gen_persona` ON (`tbl_dv_empleado`.`id_persona` = `tbl_gen_persona`.`id`)
            WHERE
              `tbl_dv_grupos_horario_planificacion`.`activo`= 1 AND
              `tbl_dv_grupos`.`activo`=1 AND
              date(`tbl_dv_grupos_horario_planificacion`.`fecha`) BETWEEN date(?) AND date(?)
              GROUP BY 
              `tbl_dv_grupos_horario_planificacion`.`id`
              ORDER BY
              `tbl_dv_grupos_horario_planificacion`.`fecha` DESC,
              7 ASC,#es el monitor
              `tbl_dv_disciplinas`.`descripcion` ASC";
        $data['validate']=true;
        $data['data']=DB::select($sql,[$fecha_inicio,$fecha_fin]);
        return $data;

    }
    public function planeaciones()
    {
        return view("posthorarios.vertodasplaneaciones"); 
    }
    public function EliminarPlanificacion($id)
    {
        try
        {
            $res=array();
            $Planificacion = TblDvGruposHorarioPlanificacion::where('id', '=', $id)->first();
            $res['validate']=(is_null($Planificacion))?FALSE:TRUE;
            $res['id']=$id;
            if(!is_null($Planificacion))
            {
                $Planificacion->activo=0;
                $Planificacion->save();
            }
            return json_encode($res);
        }
        catch(Exception $e)
        {
            var_dump($e->getMessage());
        }
    }
    public function index()
    {
        return view("posthorarios.listarplaneacion");
    }
    public function MisAsistencias()
    {
        $data=array();
        $sql="SELECT 
                  `tbl_dv_asistencias`.`id_grupo`,
                  `tbl_dv_asistencias`.`fecha_asistencia`,
                  `tbl_dv_grupos`.`codigo_grupo`,
                  `tbl_dv_disciplinas`.`descripcion` as disciplina,
                  `tbl_dv_escenarios`.`nombre_escenario`
              FROM
                  `tbl_dv_asistencias`
              INNER JOIN `tbl_dv_grupos` ON (`tbl_dv_asistencias`.`id_grupo` = `tbl_dv_grupos`.`id`)
              INNER JOIN `tbl_dv_escenarios` ON (`tbl_dv_grupos`.`id_escenario` = `tbl_dv_escenarios`.`id`)
              INNER JOIN `tbl_dv_grupos_horario` ON (`tbl_dv_grupos`.`id` = `tbl_dv_grupos_horario`.`id_grupo`)
              INNER JOIN `tbl_dv_disciplinas` ON (`tbl_dv_grupos`.`id_disciplina` = `tbl_dv_disciplinas`.`id`)
                  WHERE `tbl_dv_grupos`.`id_monitor`=?
              GROUP BY
                  `tbl_dv_asistencias`.`fecha_asistencia`, `tbl_dv_asistencias`.`id_grupo`
              ORDER BY
                `tbl_dv_asistencias`.`fecha_asistencia` DESC";
        $data['validate']=true;
        $data['data']=DB::select($sql,[
            Auth::id()
        ]);
        return $data;
    }
    private function total()
    {
        $sql="SELECT
        count(*) as total
    FROM
        `tbl_dv_asistencias`
      INNER JOIN `tbl_dv_grupos` ON (`tbl_dv_asistencias`.`id_grupo` = `tbl_dv_grupos`.`id`)
      INNER JOIN `tbl_dv_escenarios` ON (`tbl_dv_grupos`.`id_escenario` = `tbl_dv_escenarios`.`id`)
      INNER JOIN `tbl_dv_grupos_horario` ON (`tbl_dv_grupos`.`id` = `tbl_dv_grupos_horario`.`id_grupo`)
      INNER JOIN `tbl_dv_disciplinas` ON (`tbl_dv_grupos`.`id_disciplina` = `tbl_dv_disciplinas`.`id`)
      INNER JOIN `users` ON (`tbl_dv_grupos`.`id_monitor` = `users`.`id`)
    WHERE    
     `tbl_dv_grupos`.`id_metodologo`=?
        AND
    `tbl_dv_asistencias`.`fecha_asistencia`
        BETWEEN date(?) AND date(?)
    GROUP BY  `tbl_dv_asistencias`.`fecha_asistencia`, `tbl_dv_asistencias`.`id_grupo`
    ORDER BY
      `tbl_dv_asistencias`.`fecha_asistencia` DESC";
    }
    public function monitores_grupos()
    {
        $sql="SELECT 
        CONCAT_WS(' ', `users_monitor`.`primer_nombre`, `users_monitor`.`segundo_nombre`, `users_monitor`.`primer_apellido`, `users_monitor`.`segundo_apellido`) AS `monitor`,
        `users_monitor`.`numero_documento` AS `monitor_numero_documento`,
        CONCAT_WS(' ', `users_metodologo`.`primer_nombre`, `users_metodologo`.`segundo_nombre`, `users_metodologo`.`primer_apellido`, `users_metodologo`.`segundo_apellido`) AS `metodoloog`,
        `users_metodologo`.`numero_documento` AS `metodologo_numero_documento`,
        `tbl_dv_grupos`.`codigo_grupo`,
        `comunas`.`codigo_comuna`
      FROM
        `tbl_dv_grupos`
        INNER JOIN `users` `users_monitor` ON (`tbl_dv_grupos`.`id_monitor` = `users_monitor`.`id`)
        INNER JOIN `users` `users_metodologo` ON (`tbl_dv_grupos`.`id_metodologo` = `users_metodologo`.`id`)
        INNER JOIN `comunas` ON (`tbl_dv_grupos`.`id_comuna_impacto` = `comunas`.`id`)
      ORDER BY 1,3";
        $data=DB::select($sql);
        return view("metodologos.index")->with(['data'=>$data]);
    }
    public function AsistenciasMonitor($fi,$ff,Request $request)
    {
        $data=array();
        $search = $request->input('search');
        $search = $search['value'];
        $sql="SELECT
                  `tbl_dv_asistencias`.`fecha_asistencia`,
                  `tbl_dv_asistencias`.`id_grupo`,
                  `tbl_dv_grupos`.`codigo_grupo`,
                  `tbl_dv_disciplinas`.`descripcion` as disciplina,
                  `tbl_dv_escenarios`.`nombre_escenario`,
                   CONCAT_WS(' ', `users`.`primer_nombre`, `users`.`segundo_nombre`, `users`.`primer_apellido`, `users`.`segundo_apellido`) as monitor
              FROM
                  `tbl_dv_asistencias`
                INNER JOIN `tbl_dv_grupos` ON (`tbl_dv_asistencias`.`id_grupo` = `tbl_dv_grupos`.`id`)
                INNER JOIN `tbl_dv_escenarios` ON (`tbl_dv_grupos`.`id_escenario` = `tbl_dv_escenarios`.`id`)
                INNER JOIN `tbl_dv_grupos_horario` ON (`tbl_dv_grupos`.`id` = `tbl_dv_grupos_horario`.`id_grupo`)
                INNER JOIN `tbl_dv_disciplinas` ON (`tbl_dv_grupos`.`id_disciplina` = `tbl_dv_disciplinas`.`id`)
                INNER JOIN `users` ON (`tbl_dv_grupos`.`id_monitor` = `users`.`id`)
              WHERE    
               `tbl_dv_grupos`.`id_metodologo`=?
                  AND
              `tbl_dv_asistencias`.`fecha_asistencia`
                  BETWEEN date(?) AND date(?)
            AND
            (
                UPPER(`users`.`primer_nombre`) like '%" . strtoupper($search) . "%'
                OR
                UPPER(`users`.`segundo_nombre`) like '%" . strtoupper($search) . "%'
                OR
                UPPER(`users`.`primer_apellido`) like '%" . strtoupper($search) . "%'
                OR
                UPPER(`users`.`segundo_apellido`) like '%" . strtoupper($search) . "%'
                OR
                UPPER(`tbl_dv_asistencias`.`fecha_asistencia`) like '%" . strtoupper($search) . "%'
                OR
                UPPER(`tbl_dv_asistencias`.`id_grupo`) like '%" . strtoupper($search) . "%'
                OR
                UPPER(`tbl_dv_grupos`.`codigo_grupo`) like '%" . strtoupper($search) . "%'
                OR
                UPPER(`tbl_dv_disciplinas`.`descripcion`) like '%" . strtoupper($search) . "%'
                OR
                UPPER(`tbl_dv_escenarios`.`nombre_escenario`) like '%" . strtoupper($search) . "%'

            )
              GROUP BY  `tbl_dv_asistencias`.`fecha_asistencia`, `tbl_dv_asistencias`.`id_grupo`
              ORDER BY
                `tbl_dv_asistencias`.`fecha_asistencia` DESC
                LIMIT ? OFFSET ?
                ";
        $data['validate']=true;
        $data['data']=DB::select($sql,[
            Auth::id(),
            $fi,$ff,
            $request->input('length'),
            $request->input('start')
        ]);
        return response()->json($data);
    }

    public function misplanificaciones()
    {
        $data=array();
        $sql="SELECT 
              `tbl_dv_grupos_horario_planificacion`.`id`,
              `tbl_dv_grupos_horario_planificacion`.`fecha`,
              `tbl_dv_grupos`.`codigo_grupo`,
              `fn_dia_fecha`(`tbl_dv_grupos_horario_planificacion`.`fecha`) as `dia`,
              DATE_FORMAT(`tbl_dv_grupos_horario_planificacion`.`hora_inicio`,'%r') AS `hora_inicio`,
              DATE_FORMAT(`tbl_dv_grupos_horario_planificacion`.`hora_fin`,'%r') AS `hora_fin`,
              `tbl_dv_escenarios`.`nombre_escenario`,
              `tbl_dv_disciplinas`.`descripcion` as disciplina
            FROM
              `tbl_dv_grupos_horario`
              INNER JOIN `tbl_dv_grupos` ON (`tbl_dv_grupos_horario`.`id_grupo` = `tbl_dv_grupos`.`id`)
              INNER JOIN `tbl_dv_grupos_horario_planificacion` ON (`tbl_dv_grupos`.`id` = `tbl_dv_grupos_horario_planificacion`.`id_grupo`)
              INNER JOIN `tbl_dv_escenarios` ON (`tbl_dv_grupos`.`id_escenario` = `tbl_dv_escenarios`.`id`)
              INNER JOIN `tbl_dv_disciplinas` ON (`tbl_dv_grupos`.`id_disciplina` = `tbl_dv_disciplinas`.`id`)
            WHERE
              `tbl_dv_grupos`.`id_monitor` = ? AND 
              `tbl_dv_grupos_horario_planificacion`.`activo`= 1 AND
              `tbl_dv_grupos`.`activo`=1 
            GROUP BY
            `tbl_dv_grupos_horario_planificacion`.`id`
            ORDER BY 
              `tbl_dv_grupos_horario_planificacion`.`id`
            ";
        $data['validate']=true;
        $data['data']=DB::select($sql,[Auth::id()]);
        return response()->json($data);
    }
    public function actualizarhorasplanificacion()
    {
     
        $Planificaciones=DB::select('select `id`, `fecha`, `id_grupo` from `tbl_dv_grupos_horario_planificacion` where `hora_inicio` is null');
        echo '<pre>';
        foreach($Planificaciones as $temp)
        {
            $data=TblDvGrupoHorario
            ::select('id','hora_inicio','hora_fin')
            ->whereRaw('fn_dia_fecha(?)=tbl_dv_grupos_horario.dia',[$temp->fecha])
            ->where('id_grupo','=',$temp->id_grupo)
            ->first();
            if(!is_null($data))
            {
                $update=TblDvGruposHorarioPlanificacion::find($temp->id);
                $update->hora_inicio=$data->hora_inicio;
                $update->hora_fin=$data->hora_fin;
                $update->Save();
                unset($update);
            }
        }
        return response()->json(['validate'=>TRUE]);
    }
    public function imprimirPlanificacion($id)
    {
        $sql="SELECT 
                    `tbl_dv_grupos_horario_planificacion`.`id`,
                    `tbl_dv_grupos_horario_planificacion`.`id_grupo`,
                    `tbl_dv_grupos_horario_planificacion`.`fecha`,
                    `tbl_dv_grupos_horario_planificacion`.`eje_tematico`,
                    `tbl_dv_grupos_horario_planificacion`.`tema`,
					`tbl_dv_grupos_horario_planificacion`.`cont_psicosocial`,
                    `tbl_dv_grupos_horario_planificacion`.`objetivo`,
                    `tbl_dv_grupos_horario_planificacion`.`tiempo1`,
                    `tbl_dv_grupos_horario_planificacion`.`tiempo2`,
                    `tbl_dv_grupos_horario_planificacion`.`tiempo3`,
                    `tbl_dv_grupos_horario_planificacion`.`tiempo4`,
                    `tbl_dv_grupos_horario_planificacion`.`juego`,
                    `tbl_dv_grupos_horario_planificacion`.`habilidades`,
                    `tbl_dv_grupos_horario_planificacion`.`ejercicios_introductorios`,
                    `tbl_dv_grupos_horario_planificacion`.`juego_correctivo`,
                    `tbl_dv_grupos_horario_planificacion`.`observaciones`,
                    `tbl_dv_grupos_horario_planificacion`.`juego_evaluativo`,
                    `tbl_dv_grupos_horario_planificacion`.`ejercicios_avanzados`,
                    `tbl_dv_grupos_horario_planificacion`.`activo`,
                    `fn_mes_fecha`(`tbl_dv_grupos_horario_planificacion`.`fecha`) as mes,
                    `fn_dia_fecha`(`tbl_dv_grupos_horario_planificacion`.`fecha`) AS `dia`,
                    `tbl_dv_grupos`.`codigo_grupo`,
                    `tbl_dv_escenarios`.`nombre_escenario`,
                    (select `comunas`.`nombre_comuna` from comunas WHERE id = `tbl_dv_grupos`.`id_comuna_impacto`) as nombre_comuna,
                    CONCAT_WS(' ', `tbl_gen_persona`.`nombre_primero`, `tbl_gen_persona`.`nombre_segundo`, `tbl_gen_persona`.`apellido_primero`, `tbl_gen_persona`.`apellido_segundo`) AS `monitor`,
                    COALESCE(
                      `tbl_dv_grupos_horario_planificacion`.`hora_inicio`,
                      DATE_FORMAT(`tbl_dv_grupos_horario`.`hora_inicio`,'%r')
                      ) as `hora_inicio`,
                    `tbl_dv_disciplinas`.`descripcion` AS `disciplina`,
                    (select  `tbl_dv_niveles`.`descripcion` FROM tbl_dv_niveles WHERE `tbl_dv_niveles`.`id` = `tbl_dv_grupos`.`id_nivel`) as nivel
                  FROM
                ";    
				if(\Request::input("f_dia") != null){
					$sql .= "
						tbl_dv_grupos_horario
						  INNER JOIN tbl_dv_grupos ON (tbl_dv_grupos_horario.id_grupo = tbl_dv_grupos.id)
						  INNER JOIN tbl_dv_grupos_horario_planificacion ON (tbl_dv_grupos.id = tbl_dv_grupos_horario_planificacion.id_grupo)
						  INNER JOIN tbl_dv_escenarios ON (tbl_dv_grupos.id_escenario = tbl_dv_escenarios.id)
						  INNER JOIN tbl_dv_disciplinas ON (tbl_dv_grupos.id_disciplina = tbl_dv_disciplinas.id)
						  INNER JOIN tbl_dv_empleado ON (tbl_dv_grupos.id_monitor = tbl_dv_empleado.id_usuario)
						  INNER JOIN tbl_gen_persona ON (tbl_dv_empleado.id_persona = tbl_gen_persona.id)
					";
				}else{
					$sql .= "
						tbl_dv_grupos_horario_planificacion
						INNER JOIN tbl_dv_grupos ON (`tbl_dv_grupos_horario_planificacion`.`id_grupo` = `tbl_dv_grupos`.`id`)
						INNER JOIN tbl_dv_escenarios ON (`tbl_dv_grupos`.`id_escenario` = `tbl_dv_escenarios`.`id`)
						INNER JOIN comunas ON (`tbl_dv_grupos`.`id_comuna_impacto` = `comunas`.`id`)
						INNER JOIN tbl_dv_empleado ON (`tbl_dv_grupos`.`id_monitor` = `tbl_dv_empleado`.`id_usuario`)
						INNER JOIN tbl_gen_persona ON (`tbl_dv_empleado`.`id_persona` = `tbl_gen_persona`.`id`)
						INNER JOIN tbl_dv_grupos_horario ON (`tbl_dv_grupos`.`id` = `tbl_dv_grupos_horario`.`id_grupo`)
						INNER JOIN tbl_dv_disciplinas ON (`tbl_dv_grupos`.`id_disciplina` = `tbl_dv_disciplinas`.`id`)
						INNER JOIN tbl_dv_niveles ON (`tbl_dv_grupos`.`id_nivel` = `tbl_dv_niveles`.`id`)
					";
				}
			$sql .= "
                  WHERE
				";
			if(\Request::input("f_dia") != null){
				$sql .= " 
						date(`tbl_dv_grupos_horario_planificacion`.`fecha`) BETWEEN date(?) AND date(?)
						
						 and tbl_dv_grupos_horario_planificacion.activo = 1
						 AND tbl_dv_grupos.activo = 1 
					";
				$sql .= " GROUP BY 
				  `tbl_dv_grupos_horario_planificacion`.`id`  ";
			  
				$sql .= "
					ORDER BY
						`tbl_dv_grupos_horario_planificacion`.`fecha` DESC,
						monitor ASC,#es el monitor
						`tbl_dv_disciplinas`.`descripcion` ASC
					 LIMIT ".\Request::input("iniRango").",".\Request::input("finRango")."
				";
			}else{
				$sql .= " tbl_dv_grupos_horario_planificacion.id =  ?";
			}
			
		$fecha = \Request::input("f_mes")."-".str_pad(\Request::input("f_dia"),2,"0", STR_PAD_LEFT);
			
		if(\Request::input("f_dia") != null){
			$data = DB::select($sql, [$fecha, $fecha]);
			$co = count($data);
		}else{
			$data = DB::select($sql, [$id]);
			$co = 1;
		}
        //echo '<pre>=>'.dd($data)."<=";exit();
		//echo $co; exit;
		$view_f = "";
		for($i=0; $i<$co; $i++){
			$data_f=$data[$i];
			//echo '<pre>=>'.dd($data_f)."<=";
			$view=view('posthorarios.imprimirPlanificacion',['data'=>$data_f])->render();
			
			$view_f .= $view."<div class='page_break'></div>";
		}
        $dompdf = new Dompdf();
        $dompdf->loadHtml($view_f);
        $fontzise=7;
        #format footer
        $dompdf->getCanvas()
        ->page_text(518, 718, "Pagina: {PAGE_NUM} de {PAGE_COUNT}", 3, $fontzise, array(0,0,0));
        $dompdf->getCanvas()
        ->page_text(56, 705, "Este documento es propiedad de la Administración Central del Municipio de Santiago de Cali. Prohibida su alteración o modificación por cualquier medio, sin previa autorización ", 3, $fontzise, array(0,0,0));
        $dompdf->getCanvas()
        ->page_text(56, 715, "del Alcalde.", 3, $fontzise, array(0,0,0));
        #format footer
        $dompdf->setPaper('letter');
		
		//$output = $dompdf->output();
		//file_put_contents('/var/www/html/deporvida/resources/views/posthorarios/files/'.$data[$i]->id_grupo."-".$data[$i]->id.'.pdf', $output);
		//} // FIN FOR
		//exit;
		
        $dompdf->render();
        $dompdf->stream('file.pdf' , array( 'Attachment'=>0 ));
    }
    public function imprimirPlanificacion1($id)
    {

/*
       DB::select("SELECT 
                    `tbl_dv_grupos_horario_planificacion`.`id`,
                    `tbl_dv_grupos_horario_planificacion`.`id_grupo`,
                    `tbl_dv_grupos_horario_planificacion`.`fecha`,
                    `fn_mes_fecha`(`tbl_dv_grupos_horario_planificacion`.`fecha`) as mes,
                    `fn_dia_fecha`(`tbl_dv_grupos_horario_planificacion`.`fecha`) AS `dia`,
                    `tbl_dv_grupos_horario_planificacion`.`eje_tematico`,
                    `tbl_dv_grupos_horario_planificacion`.`tema`,
                    `tbl_dv_grupos_horario_planificacion`.`objetivo`,
                    `tbl_dv_grupos_horario_planificacion`.`tiempo1`,
                    `tbl_dv_grupos_horario_planificacion`.`tiempo2`,
                    `tbl_dv_grupos_horario_planificacion`.`tiempo3`,
                    `tbl_dv_grupos_horario_planificacion`.`tiempo4`,
                    `tbl_dv_grupos_horario_planificacion`.`juego`,
                    `tbl_dv_grupos_horario_planificacion`.`habilidades`,
                    `tbl_dv_grupos_horario_planificacion`.`ejercicios_introductorios`,
                    `tbl_dv_grupos_horario_planificacion`.`juego_correctivo`,
                    `tbl_dv_grupos_horario_planificacion`.`observaciones`,
                    `tbl_dv_grupos_horario_planificacion`.`juego_evaluativo`,
                    `tbl_dv_grupos_horario_planificacion`.`ejercicios_avanzados`,
                    `tbl_dv_grupos_horario_planificacion`.`activo`,
                    `tbl_dv_grupos`.`codigo_grupo`,
                    `tbl_dv_escenarios`.`nombre_escenario`,
                    `comunas`.`nombre_comuna`,
                    CONCAT_WS(' ', `tbl_gen_persona`.`nombre_primero`, `tbl_gen_persona`.`nombre_segundo`, `tbl_gen_persona`.`apellido_primero`, `tbl_gen_persona`.`apellido_segundo`) AS `monitor`,
                    DATE_FORMAT(`tbl_dv_grupos_horario`.`hora_inicio`,'%r') as `hora_inicio`,
                    `tbl_dv_disciplinas`.`descripcion` AS `disciplina`,
                    `tbl_dv_niveles`.`descripcion` as nivel
                  FROM
                    `tbl_dv_grupos_horario_planificacion`
                    INNER JOIN `tbl_dv_grupos` ON (`tbl_dv_grupos_horario_planificacion`.`id_grupo` = `tbl_dv_grupos`.`id`)
                    INNER JOIN `tbl_dv_escenarios` ON (`tbl_dv_grupos`.`id_escenario` = `tbl_dv_escenarios`.`id`)
                    INNER JOIN `comunas` ON (`tbl_dv_grupos`.`id_comuna_impacto` = `comunas`.`id`)
                    INNER JOIN `tbl_dv_empleado` ON (`tbl_dv_grupos`.`id_monitor` = `tbl_dv_empleado`.`id_usuario`)
                    INNER JOIN `tbl_gen_persona` ON (`tbl_dv_empleado`.`id_persona` = `tbl_gen_persona`.`id`)
                    INNER JOIN `tbl_dv_grupos_horario` ON (`tbl_dv_grupos`.`id` = `tbl_dv_grupos_horario`.`id_grupo`)
                    INNER JOIN `tbl_dv_disciplinas` ON (`tbl_dv_grupos`.`id_disciplina` = `tbl_dv_disciplinas`.`id`)
                    INNER JOIN `tbl_dv_niveles` ON (`tbl_dv_grupos`.`id_nivel` = `tbl_dv_niveles`.`id`)
                  WHERE
                    `fn_dia_fecha`(`tbl_dv_grupos_horario_planificacion`.`fecha`)=`tbl_dv_grupos_horario`.`dia` 
                    AND
                    `tbl_dv_grupos_horario_planificacion`.`id`=?",[$id]);
        $data=$data[0];*/
        $data_select=DB::table('tbl_dv_grupos_horario_planificacion')
            ->select(
              'tbl_dv_grupos_horario_planificacion.id',
              'tbl_dv_grupos_horario_planificacion.id_grupo',
              'tbl_dv_grupos_horario_planificacion.fecha',
              'tbl_dv_grupos_horario_planificacion.fecha as mes',
              'tbl_dv_grupos_horario_planificacion.fecha AS dia',
              'tbl_dv_grupos_horario_planificacion.eje_tematico',
              'tbl_dv_grupos_horario_planificacion.tema',
              'tbl_dv_grupos_horario_planificacion.objetivo',
              'tbl_dv_grupos_horario_planificacion.tiempo1',
              'tbl_dv_grupos_horario_planificacion.tiempo2',
              'tbl_dv_grupos_horario_planificacion.tiempo3',
              'tbl_dv_grupos_horario_planificacion.tiempo4',
              'tbl_dv_grupos_horario_planificacion.juego',
              'tbl_dv_grupos_horario_planificacion.habilidades',
              'tbl_dv_grupos_horario_planificacion.ejercicios_introductorios',
              'tbl_dv_grupos_horario_planificacion.juego_correctivo',
              'tbl_dv_grupos_horario_planificacion.observaciones',
              'tbl_dv_grupos_horario_planificacion.juego_evaluativo',
              'tbl_dv_grupos_horario_planificacion.ejercicios_avanzados',
              'tbl_dv_grupos_horario_planificacion.activo',
              'tbl_dv_grupos.codigo_grupo',
              'tbl_dv_escenarios.nombre_escenario',
              'comunas.nombre_comuna',
              'tbl_gen_persona.nombre_primero AS monitor',
              "tbl_dv_grupos_horario.hora_inicio as hora_inicio",
              'tbl_dv_disciplinas.descripcion AS disciplina',
              'tbl_dv_niveles.descripcion as nivel'
            )
            ->join('tbl_dv_grupos','tbl_dv_grupos_horario_planificacion.id_grupo', '=', 'tbl_dv_grupos.id')
            ->join('tbl_dv_escenarios','tbl_dv_grupos.id_escenario', '=', 'tbl_dv_escenarios.id')
            ->join('comunas','tbl_dv_grupos.id_comuna_impacto', '=', 'comunas.id')
            ->join('tbl_dv_empleado','tbl_dv_grupos.id_monitor', '=', 'tbl_dv_empleado.id_usuario')
            ->join('tbl_gen_persona','tbl_dv_empleado.id_persona', '=', 'tbl_gen_persona.id')
            ->join('tbl_dv_grupos_horario','tbl_dv_grupos.id', '=', 'tbl_dv_grupos_horario.id_grupo')
            ->join('tbl_dv_disciplinas','tbl_dv_grupos.id_disciplina', '=', 'tbl_dv_disciplinas.id')
            ->join('tbl_dv_niveles','tbl_dv_grupos.id_nivel', '=', 'tbl_dv_niveles.id')
            ->where('tbl_dv_grupos_horario_planificacion.id','=',$id)
            //->where('fn_dia_fecha(tbl_dv_grupos_horario_planificacion.fecha)','=','tbl_dv_grupos_horario.dia')
            ->get();

            $data=$data_select[0];
            //echo '<pre>'.($data);exit;
      $pdf = PDF::loadView('posthorarios.imprimirPlanificacion');
       var_dump($pdf);
    }
    private function clases_dadas($id_grupo)
    {
      $data = TblDvAsistencias::select('fecha_asistencia')->where('id_grupo','=',$id_grupo)->groupBy('fecha_asistencia')->get();
      return $data;
    }
    public function viewfechasgrupo(Request $request)
    {
        $sql  = 'SELECT 
                `fn_dia_fecha`(`tbl_dv_grupos_horario_planificacion`.`fecha`) as dia,
                `tbl_dv_grupos_horario_planificacion`.`fecha` as fecha
              FROM
                  `tbl_dv_grupos_horario`
                  INNER JOIN `tbl_dv_grupos_horario_planificacion` ON (`tbl_dv_grupos_horario`.`id_grupo` = `tbl_dv_grupos_horario_planificacion`.`id_grupo`)
              WHERE
                `tbl_dv_grupos_horario_planificacion`.`id_grupo` = ? AND
                `tbl_dv_grupos_horario_planificacion`.`activo` = 1 AND 
                now()>=CONCAT_WS(" " ,date(`tbl_dv_grupos_horario_planificacion`.`fecha`),TIME(`tbl_dv_grupos_horario`.`hora_inicio`)) 
                './*
                AND
                DATE(`tbl_dv_grupos_horario_planificacion`.`fecha`) BETWEEN
                DATE(DATE_ADD(now(), INTERVAL -(WEEKDAY(now())) DAY)) AND
                DATE(DATE_ADD(now(), INTERVAL (6-WEEKDAY(now())) DAY))
              GROUP BY 2
                ';*/
                ' 
              ORDER BY
                `tbl_dv_grupos_horario_planificacion`.`fecha` ';
        $data = DB::select($sql, [$request->input('id')]);
        $min='';
        $max='';
        if(count($data)>0)
        {
          $min=$data[0]->fecha;
          $max=$data[(count($data)-1)]->fecha;
        }
        return json_encode(['validate' => (count($data)>0), 'data' => $data,'fecha_min'=>$min,'fecha_max'=>$max,'clases_dadas'=>$this->clases_dadas($request->input('id'))], 128);
    }

    public function ViewAsistencia()
    {
        $grupos_monitor =$this->grupos_mios_monitor();
        return view("posthorarios.horarios")->with([
                    'grupos_clase' => $grupos_monitor
        ]);
    }
    public function ListAsistencia()
    {
        $grupos_monitor =$this->grupos_mios_monitor();
        return view("posthorarios.listasistencias")->with([
                    'grupos_clase' => $grupos_monitor
        ]);
    }
    public function ListAsistenciaMetodologo()
    {
        $grupos_monitor =$this->grupos_mios_monitor();
        return view("posthorarios.listasistenciasmetodologo")->with([
                    'grupos_clase' => $grupos_monitor,
                    'fi'=>date('Y-m-').'01',
                    'ff'=>date('Y-m-d')
                    
        ]);
    }

    public function ViewPlanificacion()
    {
        $comunas = Institucion::select('instituciones.id', 'instituciones.nombre_institucion', 'instituciones.codigo_dane', 'instituciones.telefono', 'instituciones.direccion', 'instituciones.nombre_rector', 'instituciones.barrio_id', 'comunas.nombre_comuna', 'barrios.nombre_barrio')->join(
                        'barrios', 'barrios.id', '=', 'instituciones.barrio_id')->join(
                        'comunas', 'comunas.id', '=', 'barrios.comuna_id')->get();
        return response()->json($comunas);
    }
    public function grupos_mios_monitor()
    {
        $grupos= Grupo::select(
            'tbl_dv_disciplinas.descripcion',
            'tbl_dv_niveles.descripcion as nombre_nivel',
            'tbl_dv_escenarios.nombre_escenario',
            'tbl_dv_grupos.id',
            'tbl_dv_grupos.codigo_grupo')
        ->join('tbl_dv_disciplinas', 'tbl_dv_grupos.id_disciplina', '=', 'tbl_dv_disciplinas.id')
        ->join('tbl_dv_escenarios', 'tbl_dv_grupos.id_escenario', '=', 'tbl_dv_escenarios.id')
        ->join('tbl_dv_niveles', 'tbl_dv_grupos.id_nivel', '=', 'tbl_dv_niveles.id')
        ->where('id_monitor', '=', Auth::id())
        ->where('tbl_dv_grupos.activo','=',1)
        ->OrderBy('tbl_dv_niveles.descripcion')
        ->OrderBy('tbl_dv_disciplinas.descripcion')
        ->OrderBy('tbl_dv_escenarios.nombre_escenario')
        ->get();
        $max=0;
        foreach($grupos as $temp)
        {
            $max=(strlen($temp->descripcion)>$max)?strlen($temp->descripcion):$max;
        }
        foreach($grupos as $key => $temp)
        {
            $grupos[$key]['descripcion']=$temp->descripcion.str_repeat('&nbsp;',$max-strlen($temp->descripcion));
        }
        return $grupos;
    }
    public function createPlanificacion()
    {
        $grupos_monitor =$this->grupos_mios_monitor();
        return view("posthorarios.planeacion")->with(['grupos_clase' => $grupos_monitor]);
    }
    private function grupos_clase_dias($id_planeacion)
    {
        $grupos= Grupo::select(
            'tbl_dv_disciplinas.descripcion as disciplina',
            'tbl_dv_escenarios.nombre_escenario',
            'tbl_dv_grupos.codigo_grupo')
        ->join('tbl_dv_grupos_horario_planificacion',   'tbl_dv_grupos.id',     '=', 'tbl_dv_grupos_horario_planificacion.id_grupo')
        ->join('tbl_dv_disciplinas',                    'tbl_dv_grupos.id_disciplina', '=', 'tbl_dv_disciplinas.id')
        ->join('tbl_dv_escenarios',                     'tbl_dv_grupos.id_escenario', '=', 'tbl_dv_escenarios.id')

        ->where('tbl_dv_grupos_horario_planificacion.id', '=', $id_planeacion)
        ->get();
        return $grupos[0];
    }
    private function grupo_planeacion($id_planeacion)
    {
        $sql='';
        $data=DB::select($sql,[$id_planeacion]);
        return $data;
    }
    public function editPlanificacion($id)
    {
        $readonly=(Auth::user()->roles[0]->display_name!='monitor')?' readonly=readonly ':'';
        $grupos_monitor =$this->grupos_mios_monitor();
        $grupos_clase_dias = $this->grupos_clase_dias($id);
        $data = \App\Models\TblDvGruposHorarioPlanificacion::where('id', '=', $id)->get();
        return view("posthorarios.editar")->with([
            'readonly'=>$readonly,
            'data'=>$data[0],
            'grupos_clase' => $grupos_monitor,
            'grupos_clase_dias'=>$grupos_clase_dias
        ]);
    }

    private function renderBeneficiarios($data)
    {
        $html = '<table class="table table-hover">';
        if (count($data) > 0)
        {
            $html .= '<tr>
          <th>#</th>
          <th>Beneficiario</th>
          <th>Documento</th>
          <th>¿Asistió?</th>
          <th>Observacion</th>
          <th>Si</th>
          <th>No</th>
          <th>Total</th>
          </tr>';
            foreach ($data as $key => $temp)
            {

                $cheked='';
                if($temp->asistio=='1')
                {
                  $cheked=' checked ';
                }
                $html .= '<tr>';
                $html .= '<td>' . ($key + 1) . '</td>';
                $html .= '<td>' . $temp->beneficiario . '</td>';
                $html .= '<td>' . $temp->documento . '</td>';
                $html .= '<td><div class="onoffswitch">
                        <input type="hidden" name="id_persona_asistieron[' . $temp->id . ']"  value="0">
                        <input type="checkbox" name="id_persona_asistieron[' . $temp->id . ']" '.$cheked.' class="onoffswitch-checkbox" id="myonoffswitch_' . $temp->id . '" value="1">
                        <label class="onoffswitch-label" for="myonoffswitch_' . $temp->id . '">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                        </label>
                    </div></td>
                    <td><textarea name="observacion[' . $temp->id . ']" class="form form-control"></textarea></td>
                    <td>' . $temp->si_asistio . '</td>
                    <td>' . $temp->no_asistio . '</td>
                    <td>' . $temp->total . '</td>
                    ';
                $html .= '<tr>';
            }
        }
        $html .= '</table>';
        return $html;
    }

    private function reportarInsistencias($data_estudiantes, $Fecha, $id_grupo)
    {
        $sql  = "SELECT 
              `tbl_gen_persona`.`id`,
              concat_ws(' ', `tbl_gen_persona`.`nombre_primero`, `tbl_gen_persona`.`nombre_segundo`, `tbl_gen_persona`.`apellido_primero`, `tbl_gen_persona`.`apellido_segundo`) AS `beneficiario`,
              `tbl_gen_persona`.`documento`
            FROM
              `tbl_gen_persona`
            WHERE
              `tbl_gen_persona`.`id` IN (SELECT 
                `tbl_dv_ficha`.`id_persona_beneficiario`
              FROM
                `tbl_dv_ficha`
              WHERE
                `tbl_dv_ficha`.`id_grupo` = ? AND 
                `tbl_dv_ficha`.`id_persona_beneficiario` NOT IN (SELECT `tbl_dv_asistencias`.`id_persona_beneficiario` FROM `tbl_dv_asistencias` WHERE `tbl_dv_asistencias`.`id_grupo` = ? AND `tbl_dv_asistencias`.`fecha_asistencia`=?))
            ORDER BY
              `tbl_gen_persona`.`apellido_primero`,
              `tbl_gen_persona`.`apellido_segundo`,
              `tbl_gen_persona`.`nombre_primero`,
              `tbl_gen_persona`.`nombre_segundo`";
        $data = DB::select($sql, [$id_grupo, $id_grupo, $Fecha]);
        foreach ($data as $temp)
        {
            $asistencia                          = new TblDvAsistencias();
            $asistencia->id_grupo                = $id_grupo;
            $asistencia->id_persona_beneficiario = $temp->id;
            $asistencia->fecha_asistencia        = $Fecha;
            $asistencia->fecha_creacion          = date('Y-m-d H:i:s');
            $asistencia->siasistio               = 0;
            $asistencia->Save();
        }
    }

    private function reportarAsistencias($data_estudiantes, $Fecha, $id_grupo, $observacion)
    {
        foreach ($data_estudiantes as $id_persona_beneficiario => $asistio)
        {
            $sql          = 'select 
          `tbl_dv_asistencias`.`id` 
          FROM `tbl_dv_asistencias`
          WHERE 
          `tbl_dv_asistencias`.`id_grupo`=? AND 
          `tbl_dv_asistencias`.`id_persona_beneficiario`=? AND 
          date(`tbl_dv_asistencias`.`fecha_asistencia`)=date(?)';
            $dbasistencia = DB::select($sql, [$id_grupo, $id_persona_beneficiario, $Fecha]);
            if (count($dbasistencia) === 0)
            {
                $asistencia                          = new TblDvAsistencias();
                $asistencia->id_grupo                = $id_grupo;
                $asistencia->id_persona_beneficiario = $id_persona_beneficiario;
                $asistencia->fecha_asistencia        = $Fecha;
                $asistencia->fecha_creacion          = date('Y-m-d H:i:s');
                $asistencia->siasistio               = $asistio;
                $asistencia->observacion             = $observacion[$id_persona_beneficiario];
                $asistencia->Save();
            } else
            {
                $asistencia                          = TblDvAsistencias::where('id', '=', $dbasistencia[0]->id)->firstOrFail();
                $asistencia->id_grupo                = $id_grupo;
                $asistencia->id_persona_beneficiario = $id_persona_beneficiario;
                $asistencia->fecha_asistencia        = $Fecha;
                $asistencia->siasistio               = $asistio;
                $asistencia->observacion             = $observacion[$id_persona_beneficiario];
                $asistencia->Save();
            }
        }
        //$this->reportarInsistencias($data_estudiantes, $Fecha, $id_grupo);
    }

    public function SaveBeneficiarios(Request $request)
    {
        $data = $request->all();
        if (isset($data['id_persona_asistieron']))
        {
            $this->reportarAsistencias($data['id_persona_asistieron'], $data['fecha'], $data['grupos'], $data['observacion']);
        }
    }

    private function CalcularFechaPlanificacion($Dia)
    {
        $x = 0; //Este es el dia de la semana con valor
        switch ($Dia)
        {
            case 'Lunes':$x = 0;
                break;
            case 'Martes':$x = 1;
                break;
            case 'Miercoles':$x = 2;
                break;
            case 'Jueves':$x = 3;
                break;
            case 'Viernes':$x = 4;
                break;
            case 'Sabado':$x = 5;
                break;
            case 'Domingo':$x = 6;
                break;
        }
        date_default_timezone_set('America/Bogota');
        $fecha            = date('Y-m-j');
        $dia              = date('N', strtotime($fecha));
        $dia              = ((8 - $dia) == 0) ? 8 : (8 - $dia);
        $nuevafechainicio = strtotime('+' . ($dia + $x) . ' day', strtotime($fecha));
        $nuevafechainicio = date('Y-m-j', $nuevafechainicio);

        return $nuevafechainicio;
    }
    private function HorasPlanificacion($id_grupo,$dia)
    {
        return  TblDvGrupoHorario
        ::select('hora_inicio','hora_fin')
        ->where('id_grupo','=',$id_grupo)
        ->where('dia','=',$dia)
        ->first();
    }
    public function SavePlanificacion(Request $request)
    {

        $horas                                    = $this->HorasPlanificacion($request->input('id_grupo'),$request->input('dia'));
        $Planificacion                            = new \App\Models\TblDvGruposHorarioPlanificacion();
        $Planificacion->id_grupo                  = $request->input('id_grupo');
        $Planificacion->fecha                     = $this->CalcularFechaPlanificacion($request->input('dia'));
        $Planificacion->hora_inicio               = $horas->hora_inicio;
        $Planificacion->hora_fin                  = $horas->hora_fin;
        $Planificacion->eje_tematico              = $request->input('eje_tematico');
        $Planificacion->tema                      = $request->input('tema');
		$Planificacion->cont_psicosocial          = $request->input('cont_psicosocial');
        $Planificacion->objetivo                  = $request->input('objetivo');
        $Planificacion->tiempo1                   = $request->input('tiempo1');
        $Planificacion->tiempo2                   = $request->input('tiempo2');
        $Planificacion->tiempo3                   = $request->input('tiempo3');
        $Planificacion->tiempo4                   = $request->input('tiempo4');
        $Planificacion->juego                     = $request->input('juego');
        $Planificacion->habilidades               = $request->input('habilidades');
        $Planificacion->ejercicios_introductorios = $request->input('ejercicios_introductorios');
        $Planificacion->juego_evaluativo          = $request->input('juego_evaluativo');
        $Planificacion->ejercicios_avanzados      = $request->input('ejercicios_avanzados');
        $Planificacion->observaciones             = $request->input('observaciones');
        $Planificacion->save();
        return json_encode(['validate'=>true,'id'=>$Planificacion->id,'fecha'=>$Planificacion->fecha]);
    }
    public function SaveEditPlanificacion(Request $request)
    {
        $Planificacion                            = TblDvGruposHorarioPlanificacion::where('id','=',$request->input('id'))->firstOrFail();
        $Planificacion->eje_tematico              = $request->input('eje_tematico');
        $Planificacion->tema                      = $request->input('tema');
		$Planificacion->cont_psicosocial          = $request->input('cont_psicosocial');
        $Planificacion->objetivo                  = $request->input('objetivo');
        $Planificacion->tiempo1                   = $request->input('tiempo1');
        $Planificacion->tiempo2                   = $request->input('tiempo2');
        $Planificacion->tiempo3                   = $request->input('tiempo3');
        $Planificacion->tiempo4                   = $request->input('tiempo4');
        $Planificacion->juego                     = $request->input('juego');
        $Planificacion->habilidades               = $request->input('habilidades');
        $Planificacion->ejercicios_introductorios = $request->input('ejercicios_introductorios');
        $Planificacion->juego_evaluativo          = $request->input('juego_evaluativo');
        $Planificacion->ejercicios_avanzados      = $request->input('ejercicios_avanzados');
        $Planificacion->observaciones             = $request->input('observaciones');
        $Planificacion->save();
        return json_encode(['validate'=>true,'id'=>$Planificacion->id]);
    }

    public function Beneficiarios(Request $request)
    {
        $id_grupo=$request->input('id');
        $sql           = "SELECT 
                              `tbl_gen_persona`.`id`,
                              CONCAT_WS
                              (
                                  ' ', 
                                  `tbl_gen_persona`.`nombre_primero`,
                                  `tbl_gen_persona`.`nombre_segundo`,
                                  `tbl_gen_persona`.`apellido_primero`,
                                  `tbl_gen_persona`.`apellido_segundo`
                              ) AS `beneficiario`,
                              `tbl_gen_persona`.`documento`,
                              (
                                  SELECT 
                                      count(*) as siasistio
                                  FROM 
                                    `tbl_dv_asistencias` `al_asistencia`
                                  WHERE
                                    `al_asistencia`.`siasistio`=1
                                  AND
                                    `al_asistencia`.`id_persona_beneficiario`=`tbl_gen_persona`.`id`
                              ) as si_asistio,
                              (
                                  SELECT 
                                      count(*) as siasistio
                                  FROM
                                      `tbl_dv_asistencias` `al_asistencia`
                                  WHERE
                                      `al_asistencia`.`siasistio`=0
                                  AND
                                      `al_asistencia`.`id_persona_beneficiario`=`tbl_gen_persona`.`id`
                              ) as no_asistio,
                              (
                                SELECT 
                                    count(*) as siasistio
                                FROM 
                                    `tbl_dv_asistencias` `al_asistencia`
                                WHERE 
                                    `al_asistencia`.`id_persona_beneficiario`=`tbl_gen_persona`.`id`
                              ) as total,
                              1 as asistio
                            FROM
                                `tbl_gen_persona`
                            WHERE
                                `tbl_gen_persona`.`id` IN 
                                (
                                    SELECT 
                                        `tbl_dv_ficha`.`id_persona_beneficiario` 
                                    FROM 
                                        `tbl_dv_ficha` 
                                    WHERE 
                                        `tbl_dv_ficha`.`id_grupo` = ? 
                                    AND 
                                        `tbl_dv_ficha`.`vinculado`=1
                                )
                            ORDER BY
                                `tbl_gen_persona`.`apellido_primero`,
                                `tbl_gen_persona`.`apellido_segundo`,
                                `tbl_gen_persona`.`nombre_primero`,
                                `tbl_gen_persona`.`nombre_segundo`";
        $Beneficiarios = DB::select($sql, [$id_grupo]);
        $validate=$this->ver_cancelaciones($id_grupo,$request->input('fecha'));
        return response()->json([
          'validate'=>$validate,
          'html'=> $this->renderBeneficiarios($Beneficiarios),
          'msj'=>($validate)?NULL:'Hay una cancelacion sobre esta clase. No se puede tomar asistencia'
        ]) ;

    }
    private function ver_cancelaciones($id_grupo,$fecha)
    {
        $data=TblDvNovedad::where('id_grupo','=',$id_grupo)->where('fecha_reportar','=',$fecha)->get();
        return (count($data)===0);

    }
}
