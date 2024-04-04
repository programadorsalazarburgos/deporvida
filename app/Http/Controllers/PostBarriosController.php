<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Barrio;
use App\Comuna;
use response;
use DB;

class PostBarriosController extends Controller
{


	public function __construct()
	{


//    $this->middleware('permission:ver-roles', ['only' => 'vista']);


	}

	public function vista()
	{

		return view("postbarrios.appbarrios");
	}

	public function index()
	{

		$barrios = DB::select('SELECT 
				  `barrios`.`id`,
				  `barrios`.`nombre_barrio`,
				  COALESCE(`barrios`.`codigo`,"NN") as codigo,
				  `comunas`.`nombre_comuna`,
				  `tbl_dv_zonas`.`nombre_zona`,
				  COALESCE(`barrios`.`id_estrato`,"NN") as estrato
				FROM
				  `barrios`
				  left JOIN `comunas` ON (`barrios`.`comuna_id` = `comunas`.`id`)
				  left JOIN `tbl_dv_zonas` ON (`comunas`.`zona_id` = `tbl_dv_zonas`.`id`)
				ORDER BY
				  `barrios`.`nombre_barrio`');
		return json_encode($barrios,128);
	}

	public function ObtenerComunas()
	{

		$comunas = Comuna::all();
		return response()->json(
			$comunas->toArray()
		);

	}


	public function ObtenerComunaID($id)
	{
		$comunas = Barrio::select('comunas.id','comunas.nombre_comuna','barrios.codigo','barrios.id_estrato')
			->join('comunas','comunas.id','=', 'barrios.comuna_id')
			->where('barrios.id','=', $id)
			->firstOrfail();
		return response()->json($comunas->toArray());

	}



public function CrearBarrio(Request $request){


        $barrio = new Barrio();
        $barrio->nombre_barrio 	= $request->input('nombre_barrio');
        $barrio->comuna_id 		= $request->input('comuna');
        $barrio->codigo 		= $request->input('codigo');
        $barrio->id_estrato		= $request->input('id_estrato');
	    $barrio->save();
         return response()->json(
                  $barrio->toArray()
              );

}



	public function ObtenerBarrio($id)
	{
		$barrio = Barrio::where('id', '=', $id)->firstOrfail();
		return response()->json(
			$barrio->toArray()
		);
	}



public function EditarBarrio(Request $request, $id)
{
	$barrio 				= Barrio::findOrfail($id);
  	$barrio->nombre_barrio 	= $request->input('nombre_barrio');
  	$barrio->comuna_id 		= $request->input('comuna');
  	$barrio->codigo 		= $request->input('codigo');
  	$barrio->save();
  	return response()->json($barrio->toArray());
}

	

	public function EliminarBarrio($id){

		$barrio = Barrio::findOrfail($id);
		$barrio->delete();
		    return response()->json(
		                $barrio->toArray()
		            );


	}

}
