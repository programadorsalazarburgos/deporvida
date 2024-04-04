<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Sede;
use App\Institucion;
use response;
use Hashids\Hashids;

class PostSedesController extends Controller
{


	public function __construct()
	{


//    $this->middleware('permission:ver-roles', ['only' => 'vista']);
	$this->hashids = new Hashids('', 10);

	}

	public function vista(){

		return view("postsedes.appsedes");
	}

	public function index()
	{

		$sedes = Sede::select('sedes.id', 'sedes.institucion_id', 'sedes.literal','sedes.nombre_sede','sedes.direccion', 'instituciones.nombre_institucion')->join(
			'instituciones',
			'instituciones.id', '=', 'sedes.institucion_id')->get();
		return response()->json(
			$sedes->toArray()
		);

	}


	public function ObtenerInstituciones()
	{

		$instituciones = Institucion::all();
		return response()->json(
			$instituciones->toArray()
		);

	}


	public function ObtenerInstitucionID($id){


		$instituciones = Sede::select('instituciones.id','instituciones.nombre_institucion')->join('instituciones',
			'instituciones.id','=', 'sedes.institucion_id')->where('sedes.id','=', $this->hashids->decode($id)[0])->firstOrfail();
		return response()->json(
			$instituciones->toArray()
		);

	}



public function CrearSede(Request $request){


        $sede = new Sede();
        $sede->institucion_id = $this->hashids->decode($request->input('institucion'))[0];
        $sede->literal = $request->input('literal');
        $sede->nombre_sede = $request->input('nombre_sede');
        $sede->direccion = $request->input('direccion');
	    $sede->save();
         return response()->json(
                  $sede->toArray()
              );

        
}



	public function ObtenerSede($id){


		$sede = Sede::where('sedes.id', '=', $this->hashids->decode($id)[0])->firstOrfail();

		return response()->json(
			$sede->toArray()
		);
	}



public function EditarSede(Request $request, $id){


  $sede = Sede::findOrfail($this->hashids->decode($id)[0]);
  $sede->institucion_id = $this->hashids->decode($request->input('institucion'))[0];
  $sede->literal = $request->input('literal');
  $sede->nombre_sede = $request->input('nombre_sede');
  $sede->direccion = $request->input('direccion');
  $sede->save();
  return response()->json(
                $sede->toArray()
            );
}

	

	public function EliminarSede($id){

		$sede = Sede::findOrfail($this->hashids->decode($id)[0]);
		$sede->delete();
		    return response()->json(
		                $sede->toArray()
		            );


	}

}
