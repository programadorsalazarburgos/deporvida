<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\TipoEscenario;
use response;

class PostTipoEscenariosController extends Controller
{


	public function __construct()
	{


//    $this->middleware('permission:ver-roles', ['only' => 'vista']);


	}

	public function vista(){

		return view("posttipoescenarios.apptipoescenarios");
	}

	public function index()
	{

		$tipoescenarios = TipoEscenario::all();
		return response()->json(
			$tipoescenarios->toArray()
		);

	}




public function CrearTipoEscenario(Request $request){


        $tipoescenario = new TipoEscenario();
        $tipoescenario->nombre_tipo_escenario = strtoupper($request->input('nombre_tipo_escenario'));
        $tipoescenario->save();
         return response()->json(
                  $tipoescenario->toArray()
              );

        
}



	public function ObtenerTipoEscenario($id){


		$tipoescenario = TipoEscenario::where('tbl_dv_tipo_escenarios.id', '=', $id)->firstOrfail();

		return response()->json(
			$tipoescenario->toArray()
		);
	}



public function EditarTipoEscenario(Request $request, $id){


  $sede = TipoEscenario::findOrfail($id);
  $sede->nombre_tipo_escenario = $request->input('nombre_tipo_escenario');
  $sede->save();
  return response()->json(
                $sede->toArray()
            );
}

	

	public function EliminarTipoEscenario($id){

		$tipoescenario = TipoEscenario::findOrfail($id);
		$tipoescenario->delete();
		    return response()->json(
		                $tipoescenario->toArray()
		            );


	}

}
