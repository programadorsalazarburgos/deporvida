<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Barrio;
use App\Comuna;
use App\Models\TblDvAsistencias;
use App\Models\TblDvGruposHorarioPlanificacion;
use response;
use DB;
use DateTime;

class PostAsistencias extends Controller
{
    private function VerFechas($id_grupo)
    {
        $sql='  SELECT 
                    `tbl_dv_asistencias`.`fecha_asistencia`
                  FROM
                    `tbl_dv_asistencias`
                  WHERE
                    `tbl_dv_asistencias`.`id_grupo`= ?
                  GROUP BY
                  `tbl_dv_asistencias`.`fecha_asistencia`
                  ORDER BY
                    `tbl_dv_asistencias`.`fecha_asistencia`';
        $data=DB::select($sql,[$id_grupo]);
        return $data;
    }
    private function VerBeneficiario($id_grupo)
    {
        $sql="SELECT 
              `tbl_dv_asistencias`.`id_persona_beneficiario`,
              `tbl_gen_persona`.`documento`,
              CONCAT_WS(' ',`tbl_gen_persona`.`apellido_primero`,
              `tbl_gen_persona`.`apellido_segundo`) as apellidos,
              CONCAT_WS(' ', `tbl_gen_persona`.`nombre_primero`,
              `tbl_gen_persona`.`nombre_segundo`) as nombres
            FROM
              `tbl_dv_asistencias`
              INNER JOIN `tbl_gen_persona` ON (`tbl_dv_asistencias`.`id_persona_beneficiario` = `tbl_gen_persona`.`id`)
            WHERE
              `tbl_dv_asistencias`.`id_grupo` = ?
              GROUP BY
              `tbl_dv_asistencias`.`id_persona_beneficiario`
            ORDER BY
              `tbl_gen_persona`.`apellido_primero`,
              `tbl_gen_persona`.`apellido_segundo`,
              `tbl_gen_persona`.`nombre_primero`,
              `tbl_gen_persona`.`nombre_segundo`
              ";
        $data=DB::select($sql,[$id_grupo]);
        return $data;   
    }
    private function VerAsistenciasEstudiantes($beneficiarios,$id_grupo,$fechas)
    {
        $data=array();
        foreach($beneficiarios as $beneficiario)
        {
            $temp=array();
            $temp['documento']=$beneficiario->documento;
            $temp['apellidos']=$beneficiario->apellidos;
            $temp['nombres']=$beneficiario->nombres;
            foreach($fechas as $fecha)
            {
                $sql="SELECT 
                          `tbl_dv_asistencias`.`siasistio` as siasistio
                    FROM
                          `tbl_dv_asistencias`
                    WHERE
                          `tbl_dv_asistencias`.`fecha_asistencia`=?
                    AND
                          `tbl_dv_asistencias`.`id_persona_beneficiario`=?
                    AND
                          `tbl_dv_asistencias`.`id_grupo`=?";
                $res=DB::select($sql,[$fecha->fecha_asistencia,$beneficiario->id_persona_beneficiario,$id_grupo]);
                $t=0;
                if(isset($res[0]))
                {
                  $t=$res[0]->siasistio;
                }
                $temp['fecha'][$fecha->fecha_asistencia]=$t;
            }
            $data[]=$temp;
        }
        return $data;
    }
    private function table($data,$cabecera)
    {
        $html='<table border="1" class="table table-hover table-striped table-bordered table-advanced tablesorter dataTable no-footer" style="width:100%" id="table_asistencia">'."\n";
        $html.='    <tr>'."\n";
        $html.='        <th>Documento</th>'."\n";
        $html.='        <th>Apellidos</th>'."\n";
        $html.='        <th>Nombres</th>'."\n";
        foreach($cabecera as $temp)
        {
            $html.='        <th>';
            $html.=date('d-m-Y',strtotime($temp->fecha_asistencia));
            $html.='</th>'."\n";    
        }
        $html.='        <th>Total</th>'."\n";
        $html.='    </tr>'."\n";
        foreach($data as $temp)
        {
            $html.='    <tr>'."\n";
            $total=0;
            $html.='        <td>'.number_format($temp['documento'],0,',','.').'</td>'."\n";
            $html.='        <td>'.$temp['apellidos'].'</td>'."\n";
            $html.='        <td>'.$temp['nombres'].'</td>'."\n";
            foreach($temp['fecha'] as $fechas_beneficiarios)
            {
                $total+=$fechas_beneficiarios;
                $html.='        <td>'.(($fechas_beneficiarios=='1')?'SI':'NO').'</td>'."\n";
            }
            $html.='        <td>'.$total.'</td>'."\n";
        $html.='    </tr>'."\n";
        }
        $html.='</table>'."\n";
        return $html;
    }
    public function VerAsistencias($id_grupo)
    {
        $Res=array();
    	  $Res['fechas']=$this->VerFechas($id_grupo);
        $beneficiarios=$this->VerBeneficiario($id_grupo);
        $Res['beneficiarios']=$this->VerAsistenciasEstudiantes($beneficiarios,$id_grupo,$Res['fechas']);
        return view('postasistencias.asistencias')->with(
        [
          'table'=>$this->table($Res['beneficiarios'],$Res['fechas']),
          'id_grupo'=>$id_grupo
         ]
      );


    }
    private function ObtenerGrupo($id_grupo)
    {
      $sql='SELECT 
              `tbl_dv_escenarios`.`nombre_escenario`,
              `tbl_dv_grupos`.`codigo_grupo`,
              `tbl_dv_disciplinas`.`descripcion`
            FROM
              `tbl_dv_grupos`
              INNER JOIN `tbl_dv_escenarios` ON (`tbl_dv_grupos`.`id_escenario` = `tbl_dv_escenarios`.`id`)
              INNER JOIN `tbl_dv_disciplinas` ON (`tbl_dv_grupos`.`id_disciplina` = `tbl_dv_disciplinas`.`id`)
              WHERE
                `tbl_dv_grupos`.`id`=?
              AND 
                `tbl_dv_disciplinas`.`activo`=1';
      $res=DB::select($sql,[$id_grupo]);
      return $res[0];
    }
    public function imprimirasistencia($id_grupo)
    {
        $Resultados=$this->ObtenerGrupo($id_grupo);
        $Res=array();
        $Res['fechas']=$this->VerFechas($id_grupo);
        $beneficiarios=$this->VerBeneficiario($id_grupo);
        $Res['beneficiarios']=$this->VerAsistenciasEstudiantes($beneficiarios,$id_grupo,$Res['fechas']);
        return view('postasistencias.imprimirasistencia')->with(
        [
          'table'=>$this->table($Res['beneficiarios'],$Res['fechas']),
          'codigo_grupo'=>$Resultados->codigo_grupo,
          'Escenario'=>$Resultados->nombre_escenario,
          'disciplina'=>$Resultados->descripcion
        ]
      );

    }
    public function AsistenciasMes($fecha_inicio,$fecha_fin)
    {
      $sql="SELECT 
        `barrios`.`nombre_barrio` as barrio,
        `comunas`.`codigo_comuna` as comuna,
        `tbl_dv_escenarios`.`nombre_escenario` as escenario,
        CONCAT_WS(' ', `users`.`primer_nombre`, `users`.`segundo_nombre`, `users`.`primer_apellido`, `users`.`segundo_apellido`) AS `monitor`,
        `tbl_dv_disciplinas`.`descripcion` as disciplina,
        CONCAT_WS(' ', `tbl_gen_persona`.`nombre_primero`, `tbl_gen_persona`.`nombre_segundo`, `tbl_gen_persona`.`apellido_primero`, `tbl_gen_persona`.`apellido_segundo`) AS `beneficiario`,
        `tbl_gen_persona`.`documento`,
        `tbl_dv_ficha`.`fecha_registro`,
        `tbl_dv_grupos`.`codigo_grupo`,
        CASE WHEN tbl_dv_grupos.activo = 1 THEN 'SI' WHEN tbl_dv_grupos.activo = 0 THEN 'NO' END AS 'activo',
        `tbl_dv_ficha`.`id_persona_beneficiario`,
        `tbl_dv_ficha`.`id_grupo`
      FROM
        `tbl_dv_grupos`
      INNER JOIN `users` ON (`tbl_dv_grupos`.`id_monitor` = `users`.`id`)
      INNER JOIN `tbl_dv_ficha` ON (`tbl_dv_grupos`.`id` = `tbl_dv_ficha`.`id_grupo`)
      INNER JOIN `tbl_gen_persona` ON (`tbl_dv_ficha`.`id_persona_beneficiario` = `tbl_gen_persona`.`id`)
      INNER JOIN `tbl_dv_asistencias` ON (`tbl_gen_persona`.`id` = `tbl_dv_asistencias`.`id_persona_beneficiario`)
      INNER JOIN `tbl_dv_escenarios` ON (`tbl_dv_grupos`.`id_escenario` = `tbl_dv_escenarios`.`id`)
      INNER JOIN `comunas` ON (`tbl_dv_grupos`.`id_comuna_impacto` = `comunas`.`id`)
      INNER JOIN `barrios` ON (`tbl_dv_escenarios`.`id_barrio` = `barrios`.`id`)
      INNER JOIN `tbl_dv_disciplinas` ON (`tbl_dv_grupos`.`id_disciplina` = `tbl_dv_disciplinas`.`id`)
      WHERE
        `tbl_dv_asistencias`.`fecha_asistencia` BETWEEN date(?) AND date(?)
        GROUP BY
        `tbl_dv_ficha`.`id_persona_beneficiario`,
        `tbl_dv_ficha`.`id_grupo`";
      $data=DB::select($sql,[$fecha_inicio,$fecha_fin]);
      return $data;
    }
    private function data_beneficiario($id_grupo,$id_persona_beneficiario,$fecha_i,$fecha_f)
    {
      $data=TblDvAsistencias
      ::where('id_grupo','=',$id_grupo)
      ->where('id_persona_beneficiario','=',$id_persona_beneficiario)
      ->where('fecha_asistencia','>=',$fecha_i)
      ->where('fecha_asistencia','<=',$fecha_f)
      ->groupBy('fecha_asistencia')
      ->groupBy('id_grupo')
      ->groupBy('id_persona_beneficiario')
      ->get();
      $res['total']=count($data);
      $x=0;
      foreach($data as $temp)
      {
        if($temp->siasistio==1)
          {$x=$x+1;}
      }
      $res['asistencias']=$x;
      return (object)$res;
    }
    private function clases_planeadas($id_grupo,$fecha_inicio,$fecha_fin)
    {
        $data=TblDvGruposHorarioPlanificacion
        ::where('id_grupo','=',$id_grupo)
        ->where('fecha','>=',$fecha_inicio)
        ->where('fecha','<=',$fecha_fin)
        ->get();
        return count($data);
    }
    private function format_data_asistencias($data,$inicio,$fin)
    {
        foreach ($data as $key => $temp)
        {
            $x=$this->data_beneficiario(
              $temp->id_grupo,
              $temp->id_persona_beneficiario,
              $inicio,$fin);
            $data[$key]->clases_planeadas=$this->clases_planeadas(
              $temp->id_grupo,
              $inicio,$fin
            );
            $data[$key]->beneficiario_asistencias_registrado=$x->total;
            $data[$key]->beneficiario_asistencias_asisitio=$x->asistencias;
            $data[$key]->beneficiario_asistencias_porcentaje=
            (
                100*
                (
                    $x->asistencias/
                    (($x->total==0)?1:$x->total)
                )
            ).'%';
        };
        return $data;
    }
    public function AsistenciasMesAjax(Request $request)
    {
        $data=$this->AsistenciasMes($request->input('inicio'),$request->input('fin'));
        $data=$this->format_data_asistencias($data,$request->input('inicio'),$request->input('fin'));
        return json_encode(['data'=>$data,'validate'=>true],128);
    }

    public function AsistenciasView()
    {

        $fechai = new DateTime();
        $fechai->modify('first day of this month');

        $fechaf = new DateTime();
        $fechaf->modify('last day of this month');

        return view('postasistencias.informeasistencias')->with([
          'fi'=>$fechai->format('Y-m-d'),
          'ff'=>$fechaf->format('Y-m-d')
        ]);
    }
}
