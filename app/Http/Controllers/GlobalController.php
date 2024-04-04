<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comuna;
use App\Models\TblDvGrupos;
use App\Models\TblDvGrupoHorario;
use App\Models\TblDvGruposHorarioPlanificacion;
use DB;
USE DateTime;



class GlobalController extends Controller
{
    

    public function obtener_comunas()
    {

        $datos = Comuna::all();
        return ['datos' => $datos];
    }

    public function pruebas2222()
    {

          $dia_inicio='2019-'.$mes.'-01';
        dd($dia_inicio);
    }

    public function reportemes(Request $request)
    {


 
        $from = \DateTime::createFromFormat('D M d Y H:i:s e+', $request->fecha_inicial); 
        $to = \DateTime::createFromFormat('D M d Y H:i:s e+', $request->fecha_final); 

      
        $data = TblDvGrupos::select('tbl_dv_grupos.id','tbl_dv_grupos.id_escenario','tbl_dv_grupos.id_metodologo','tbl_dv_grupos.id_disciplina','tbl_dv_grupos.id_comuna_impacto','tbl_dv_grupos.id_monitor','tbl_dv_grupos.id_nivel','tbl_dv_grupos.observaciones','tbl_dv_grupos.codigo_grupo','tbl_dv_grupos.fecha_registro','activo', 'users.primer_nombre','users.primer_apellido')
            ->where('id_comuna_impacto', '=', $request->comuna)





        ->join('users', 'tbl_dv_grupos.id_monitor', '=', 'users.id')
        ->get();
     
        foreach ($data as $key => $temp) {

            $temp->horarios = $this->horarios_grupos($temp->id);
            $temp->clases_programadas = $this->clases_programadas($temp->id,  $from->format("Y-m-d"), $to->format("Y-m-d"));
            $temp->clases_asistencias = $this->clases_asistencias($temp->id,  $from->format("Y-m-d"), $to->format("Y-m-d"));
            $data[$key] = $temp;
        }



      
        return ['data'=> $data];

    }


        public function clases_programadas($grupo, $from, $to)

    {

        $data = TblDvGruposHorarioPlanificacion::select('tbl_dv_grupos_horario.dia')
            ->where('tbl_dv_grupos_horario_planificacion.id_grupo', '=', (int)$grupo)
            ->where('tbl_dv_grupos_horario_planificacion.activo', '=', 1)
            ->whereBetween('tbl_dv_grupos_horario_planificacion.fecha', [$from, $to])
            ->count();

        return $data;
    
    }


  public function clases_asistencias($grupo, $from, $to)

    {

  
    $data = DB::select('SELECT 
                 tbl_dv_asistencias.fecha_asistencia     
        FROM
          `tbl_dv_grupos_horario_planificacion`
        INNER JOIN `tbl_dv_grupos` ON (`tbl_dv_grupos_horario_planificacion`.`id_grupo` = `tbl_dv_grupos`.`id`)
                INNER JOIN `tbl_dv_asistencias` ON (`tbl_dv_asistencias`.`id_grupo` = `tbl_dv_grupos`.`id`)
        
        WHERE
          `tbl_dv_grupos_horario_planificacion`.`id_grupo`='.(int)$grupo.'  
          AND
          `tbl_dv_grupos_horario_planificacion`.`activo`=1
                    
                    AND
          `tbl_dv_asistencias`.`siasistio`=1
         
            AND
          date(`tbl_dv_asistencias`.`fecha_asistencia`)
            BETWEEN date("'.$from.'") AND date("'.$to.'")
                        GROUP BY tbl_dv_asistencias.fecha_asistencia    
                        ORDER BY COUNT(tbl_dv_asistencias.fecha_asistencia) DESC');



        $cantidad = count($data);

        return $cantidad;




    }




     public function horarios_grupos($grupo)

    {

        $data = TblDvGrupoHorario::select('tbl_dv_grupos_horario.dia')
            ->where('tbl_dv_grupos_horario.id_grupo', '=', $grupo)
            ->get();

        return $data;
    }


    public function sesiones(Request $request)
    {

        dd($request->all());

    }
        



    
}
