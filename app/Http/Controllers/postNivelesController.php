<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TblDvNiveles;
use DB;

class postNivelesController extends Controller
{
    public function __construct()
	{

    }
    
    public function vista()
    {
        // return view("postejestematicos.app");
        return view("postevaluaciones.appevaluaciones");
    }

    public function index($id = null) {

        $modelObject = TblDvNiveles::class;

        if ($id) {
            $modelObject = $modelObject::find($id);
        }
        else {
            $modelObject = $modelObject::all();
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

        $result = TblDvNiveles::insert($request->all());

        return response()->json($result);
    }

    public function eliminar($id) {

        $result = TblDvNiveles::destroy($id);

        return response()->json($result);
    }

    public function editar($id, Request $request) {

        $result = TblDvNiveles::find($id)->update($request->all());

        return response()->json($result);
    } 
    

}
