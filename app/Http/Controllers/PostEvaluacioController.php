<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TblDvEvaluacionesPlazosyperiodos;
use App\Models\TblDvGrupos;
use App\Models\TblDvIndicadores;
use App\Models\TblDvDisciplinas;
use DB;
class PostEvaluacioController extends Controller
{
    public function index()
    {
        return view('evaluaciones.index')->with([
            'Disciplinas'=>TblDvDisciplinas::orderBy('descripcion')->get(),
            'evaluaciones'=>TblDvEvaluacionesPlazosyperiodos::all(),
            'tipos'=>TblDvEvaluacionesPlazosyperiodos::groupBy('tipo')->get(),
            'fecha_inicio'=>date('Y-m-').'01',
            'fecha_fin'=>date('Y-01-d')]);
    }
    private function valores($id_indicador)
    {
        $valor=DB::select('SELECT 
        `tbl_dv_calificaciones_escala`.`nombre` as `name`,
        count(`tbl_dv_calificaciones_escala`.`numero`) AS `data`
      FROM
        `tbl_dv_calificaciones_escala`
        INNER JOIN `tbl_dv_evaluaciones_resultados` ON (`tbl_dv_calificaciones_escala`.`id` = `tbl_dv_evaluaciones_resultados`.`id_calificacion`)
      WHERE
        `tbl_dv_evaluaciones_resultados`.`id_indicador`=?
      GROUP BY
        `tbl_dv_calificaciones_escala`.`id`
      ',[$id_indicador]); 
      foreach($valor as $key=>$temp)
        {
            $valor[$key]->data=[$temp->data];
        }
      return $valor;
    }
    public function evaluaciones(Request $request)
    {
        $indicadores=DB::select('SELECT 
                        `tbl_dv_indicadores`.`id`,
                        `tbl_dv_indicadores`.`nombre` AS `indicador`
                    FROM
                        `tbl_dv_evaluaciones_resultados`
                        INNER JOIN `tbl_dv_evaluaciones` ON (`tbl_dv_evaluaciones_resultados`.`id_evaluacion` = `tbl_dv_evaluaciones`.`id`)
                        INNER JOIN `tbl_dv_indicadores` ON (`tbl_dv_evaluaciones_resultados`.`id_indicador` = `tbl_dv_indicadores`.`id`)
                        INNER JOIN `tbl_dv_grupos` ON (`tbl_dv_evaluaciones`.`id_grupo` = `tbl_dv_grupos`.`id`)
                    WHERE
                        `tbl_dv_evaluaciones`.`id_evplazoyperiodo` = ? 
                        AND `tbl_dv_grupos`.`id_disciplina` = ?
                    GROUP BY
                        tbl_dv_indicadores.id
                    ORDER BY
                        `tbl_dv_indicadores`.`nombre`',[$request->input('id_EvaluacionesPlazosyperiodos'),$request->input('id_disciplinas')]);
        foreach($indicadores as $key => $temp)
        {
            $indicadores[$key]->data=$this->valores($temp->id);
        }
        return response()->json(['data'=>$indicadores]);
    }
}
