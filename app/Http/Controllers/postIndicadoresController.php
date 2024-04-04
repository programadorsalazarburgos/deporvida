<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TblDvIndicadores;
use App\Models\TblDvDisciplinas;
use App\Models\TblDvEvaluaciones;
use App\TblGenComunas;
use DB;

class postIndicadoresController extends Controller
{
    public function __construct()
	{

    }

    public function vista()
    {
        // return view("postejestematicos.app");
        return view("postevaluaciones.appevaluaciones");
    }

    public function index($tipo, $id = null) {

        $modelObject = TblDvIndicadores::with(['fk_tbl_dv_ejes_tematicos','fk_tbl_dv_niveles','fk_tbl_dv_disciplinas']);
        $modelObject = $modelObject->where('tipo', $tipo);

        if ($id) {
            $modelObject = $modelObject->find($id);
        }
        else {
            $modelObject = $modelObject->get();
        }

        return response()->json(
			$modelObject->toArray()
		);

    }

    public function getDataSelect($modelo, Request $request)
	{
        $model = "\\App\\Models\\".$modelo;

        // $dataModel = $model::all();
        // $relaciones = ['tbl_dv_escenarios', 'view_dv_monitores'];

        $metodos_clase = get_class_methods($model);

        $relaciones = array_filter($metodos_clase,function($metodo) {
            return preg_match("/^fk_/", $metodo);
        });

        $model = $model::with($relaciones);

        if($request->all()) {
            $where = array();
            foreach ($request->all() as $wKey => $wValue) {
                array_push($where, [$wKey, $wValue]);
            }
            $model = $model->where($where);
        }

        $dataModel = $model->get();

        return response()->json(
            $dataModel->toArray()
        );

    }

    public function guardar(Request $request) {

        $insertData = $request->all();

        if ($insertData['tipo'] == 'TECNICO') {
            $insertData['id_eje'] = null;
        }
        else {
            $insertData['id_nivel'] = null;
            $insertData['id_disciplina'] = null;
        }

        $result = TblDvIndicadores::insert($insertData);

        return response()->json($result);
    }

    public function eliminar($id) {

        $result = TblDvIndicadores::destroy($id);

        return response()->json($result);
    }

    public function editar($id, Request $request) {

        $result = TblDvIndicadores::find($id)->update($request->all());

        return response()->json($result);
    }
    public function vistareportesindicadores()
    {
        return view('indicadores.reportes')->with([
            'comunas'     => TblGenComunas::orderBy('codigo_comuna')->get(),
            'disciplinas' => TblDvDisciplinas::orderBy('descripcion')->get(),
            'indicadores' => TblDvIndicadores::orderBy('tipo')->groupBy('tipo')->get()
        ]);
    }

    public function datavistareportesindicadores(Request $request)
    {
            $where=array();
            $where2=array();

        if(!is_null($request->input('comuna')))
        {
            $where[]=' `comunas`.`id` = '.$request->input('comuna').' ' ;
        }
        if(!is_null($request->input('disciplina')))
        {
            $where[]=' `tbl_dv_disciplinas`.`id` = '.$request->input('disciplina').' ' ;
        }
        if(!is_null($request->input('indicador')))
        {
            $where[]=' `tbl_dv_indicadores`.`tipo` = "'.$request->input('indicador').'" ' ;
        }

        $anio = @date("Y");

        $where2[]='WHERE YEAR(`tbl_dv_evaluaciones`.`fecha`) = '.$anio.' ' ;

        $where2 = (count($where2)>0) ? '' .implode(' AND ',$where2) : '';

        $where = (count($where)>0) ? $where2. 'AND'.implode(' AND ',$where) : '';


		$sql = "SELECT
                `tbl_dv_evaluaciones_plazosyperiodos`.`nombre` AS `nombre_evalucion`,
                `tbl_dv_grupos`.`codigo_grupo`,
                `tbl_dv_disciplinas`.`descripcion` AS `disciplina`,
                `tbl_dv_niveles`.`descripcion` AS `niveles`,
                `comunas`.`codigo_comuna` AS `comuna_impacto`,
                `tbl_dv_evaluaciones`.`fecha`,
                CONCAT_WS(' ', `tbl_gen_persona`.`nombre_primero`, `tbl_gen_persona`.`nombre_segundo`, `tbl_gen_persona`.`apellido_primero`, `tbl_gen_persona`.`apellido_segundo`) AS `beneficiario`,
                `tbl_gen_persona`.`documento`,
                TIMESTAMPDIFF(YEAR, `tbl_gen_persona`.`fecha_nacimiento`, NOW()) AS `edad`,
                `tbl_dv_evaluaciones_plazosyperiodos`.`plazo_inicial`,
                `tbl_dv_evaluaciones_plazosyperiodos`.`plazo_final`,
			";
			if($request->input('indicador') != "TECNICO"){
				$sql .= "
					`tbl_dv_ejes_tematicos`.`nombre` as indicador_eje,
				";
			}else{
				$sql .= "
					'' as indicador_eje,
				";
			}
			$sql .= "
                `tbl_dv_indicadores`.`nombre` as indicador_nombre,
                `tbl_dv_indicadores`.`tipo` AS `indicador_tipo`,
                `tbl_dv_calificaciones_escala`.`nombre` AS `decripcion`,
                `tbl_dv_calificaciones_escala`.`numero` AS `calificacion`,
                COALESCE(`tbl_dv_calificaciones_escala`.`observaciones`, '') AS `observaciones`
            FROM
                `tbl_dv_evaluaciones_resultados`
                inner JOIN `tbl_dv_evaluaciones` ON (`tbl_dv_evaluaciones_resultados`.`id_evaluacion` = `tbl_dv_evaluaciones`.`id`)
                inner JOIN `tbl_dv_grupos` ON (`tbl_dv_evaluaciones`.`id_grupo` = `tbl_dv_grupos`.`id`)
                inner JOIN `comunas` ON (`tbl_dv_grupos`.`id_comuna_impacto` = `comunas`.`id`)
                inner JOIN `tbl_gen_persona` ON (`tbl_dv_evaluaciones_resultados`.`id_persona_beneficiario` = `tbl_gen_persona`.`id`)
                inner JOIN `tbl_dv_calificaciones_escala` ON (`tbl_dv_evaluaciones_resultados`.`id_calificacion` = `tbl_dv_calificaciones_escala`.`id`)
                inner JOIN `tbl_dv_evaluaciones_plazosyperiodos` ON (`tbl_dv_evaluaciones`.`id_evplazoyperiodo` = `tbl_dv_evaluaciones_plazosyperiodos`.`id`)
                inner JOIN `tbl_dv_niveles` ON (`tbl_dv_grupos`.`id_nivel` = `tbl_dv_niveles`.`id`)
                inner JOIN `tbl_dv_disciplinas` ON (`tbl_dv_grupos`.`id_disciplina` = `tbl_dv_disciplinas`.`id`)
                inner JOIN `tbl_dv_indicadores` ON (`tbl_dv_evaluaciones_resultados`.`id_indicador` = `tbl_dv_indicadores`.`id`)
			";
                
        if($request->input('indicador') != "TECNICO"){
			$sql .= "
				inner JOIN `tbl_dv_ejes_tematicos` ON (`tbl_dv_indicadores`.`id_eje` = `tbl_dv_ejes_tematicos`.`id`)
			";
		}
		$sql .= "
				{$where}
				ORDER BY
					`tbl_dv_evaluaciones`.`fecha` DESC";
        $data = DB::select($sql);

        return json_encode(['data'=>$data]);
    }
}
