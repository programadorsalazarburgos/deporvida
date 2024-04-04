<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TblDvEvaluacionesPlazosyperiodos;
use App\Models\TblDvEvaluaciones;
use App\Models\TblDvEvaluacionesResultados;
use DB;
use Auth;
use Carbon\Carbon;

class PostEvaluacionesController extends Controller
{
    public function __construct()
	{

    }

    public function vista()
    {
        return view("postevaluaciones.appevaluaciones");
    }

    public function index($tipo, $id = null) {


        $return = [];

        if ($id != null) {

            $ev = $this->evaluaciones(null, $id);
            $return = $ev->toArray();

        }
        else {


            $evs = $this->evaluacionPlazo($tipo);

            if ($evs != null) {


                $return = $evs->toArray();



                $ev = $this->evaluaciones($evs->id);


                $return['fk_tbl_dv_evaluaciones'] = $ev->toArray();

                $idsGruposEv = [];
                foreach ($ev as $registro) {
                    $idsGruposEv[] = $registro->id_grupo;
                }
                $grupos = $this->gruposPendientesEv($idsGruposEv);

                $return['grupos_pendientes'] = $grupos->toArray();
            }
        }

        return response()->json(
			$return
		);

    }

    public function evaluacionPlazo($tipo) {
        // Consulta Periodos y Evaluaciones Realizadas del Monitor atenticado

        // DB::enableQueryLog();

        $ev = TblDvEvaluacionesPlazosyperiodos::with([
            'fk_tbl_dv_evaluaciones'
        ]);

        // $ev = $ev->where('tipo', $tipo)->whereBetween(Carbon::now(),['plazo_inicial', 'plazo_final'])->toSql();
        $ev = $ev->where('tipo', $tipo)->whereRaw('? between plazo_inicial and plazo_final', [date('Y-m-d')]);

        /* $ev = $ev->whereHas('fk_tbl_dv_evaluaciones.fk_tbl_dv_grupos', function ($query) {
            $query->where('id_monitor', Auth::id());
        })->get(); */

        // $ev = $ev->get();
        $ev = $ev->first();

        // dd(DB::getQueryLog());

        return $ev;
    }

    public function gruposPendientesEv($idsGruposEv) {

        // Consulta Grupos pendientes por Evaluar

        $grupos = \App\Models\TblDvGrupos::with([
            'fk_tbl_dv_escenarios',
            'fk_tbl_dv_disciplinas',
            'fk_view_dv_monitores',
            'fk_tbl_dv_niveles'
        ]);

        $grupos = $grupos->where('id_monitor', Auth::id())->whereNotIn('id', $idsGruposEv)->get();

        return $grupos;
    }

    public function evaluaciones($id_evplazoyperiodo = null, $id = null) {

        // DB::enableQueryLog();

        $ev = TblDvEvaluaciones::with([
            'fk_tbl_dv_grupos.fk_view_dv_monitores',
            'fk_tbl_dv_grupos.fk_tbl_dv_escenarios',
            'fk_tbl_dv_grupos.fk_tbl_dv_disciplinas',
            'fk_tbl_dv_grupos.fk_tbl_dv_niveles'
        ]);


        if ($id != null) {
            $ev = $ev->with([
                'fk_tbl_dv_evaluaciones_plazosyperiodos',
                'fk_tbl_dv_evaluaciones_resultados'
            ])->find($id);
        }
        else {

            if ($id_evplazoyperiodo) {
              // dd($id_evplazoyperiodo);
                $ev = $ev->where('id_evplazoyperiodo', $id_evplazoyperiodo);

            }

            $ev = $ev->whereHas('fk_tbl_dv_grupos', function ($query) {

                $query->where('id_monitor', Auth::id());
            })->get();




        }

        // dd(DB::getQueryLog());

        return $ev;
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
                if ($wKey == 'Auth') {
                    array_push($where, [$wValue, Auth::id()]);
                }
                else {
                    array_push($where, [$wKey, $wValue]);
                }
            }
            $model = $model->where($where);
        }

        $dataModel = $model->get();

        return response()->json(
            $dataModel->toArray()
        );

    }

    public function guardarResultados(Request $request) {

        $transac = DB::transaction(function () use ($request) {

            TblDvEvaluaciones::where([
                ['id_grupo', '=', $request->encabezadoEvData[0]['id_grupo']],
                ['id_evplazoyperiodo', '=', $request->encabezadoEvData[0]['id_evplazoyperiodo']]
            ])->delete();

            $evaluacionId = TblDvEvaluaciones::insertGetId($request->encabezadoEvData[0]);

            $resultadosEv = $request->resultadosEvData;
            foreach ($resultadosEv as $key => $resultados) {
                $resultadosEv[$key]['id_evaluacion'] = $evaluacionId;
            }

            $result = TblDvEvaluacionesResultados::insert($resultadosEv);

            return $result;

        });

        return response()->json($transac);

    }

    public function eliminarEv($evaluacionId) {

        $result = TblDvEvaluaciones::destroy($evaluacionId);
        return response()->json($result);
    }


}
