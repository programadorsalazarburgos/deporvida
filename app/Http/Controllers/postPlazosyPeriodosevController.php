<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TblDvEvaluacionesPlazosyperiodos;
use App\Models\TblDvEvplazosyperiodosXEjes;
use DB;

class postPlazosyPeriodosevController extends Controller
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

        $modelObject = TblDvEvaluacionesPlazosyperiodos::class;
        $modelObject = $modelObject::where('tipo', $tipo);

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

        $transac = DB::transaction(function () use ($request) {

            // dd($request->all());
            
            $pypEvId = TblDvEvaluacionesPlazosyperiodos::insertGetId($request->pyp);

            $pypXE = $request->pypxe;
            foreach ($pypXE as $key => $resultados) {
                $pypXE[$key]['id_evplazoyperiodo'] = $pypEvId;
            }

            $result = TblDvEvplazosyperiodosXEjes::insert($pypXE);

            return $result;

        });

        return response()->json($transac);
    }

    public function eliminar($id) {

        $result = TblDvEvaluacionesPlazosyperiodos::destroy($id);

        return response()->json($result);
    }

    public function editar($id, Request $request) {

        $transac = DB::transaction(function () use ($id, $request) {

            TblDvEvaluacionesPlazosyperiodos::find($id)->update($request->pyp);

            TblDvEvplazosyperiodosXEjes::where('id_evplazoyperiodo', $id)->delete();

            $pypXE = $request->pypxe;
            foreach ($pypXE as $key => $resultados) {
                $pypXE[$key]['id_evplazoyperiodo'] = $id;
            }

            $result = TblDvEvplazosyperiodosXEjes::insert($pypXE);

            return $result;

        });

        return response()->json($transac);
    } 
    

}
