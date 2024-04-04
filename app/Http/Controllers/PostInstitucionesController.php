<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Institucion;
use App\Barrio;
use response;
use Hashids\Hashids;

class PostInstitucionesController extends Controller
{

protected $hashids;

	public function __construct(Hashids $hashids)
	{


	    $this->middleware('permission:ver-instituciones', ['only' => 'vista']);
		$this->hashids = new Hashids('', 10);
	

	}

	public function vista(){

		return view("postinstituciones.appinstituciones");
	}

	public function index()
	{

		$comunas = Institucion::select('instituciones.id','instituciones.nombre_institucion','instituciones.codigo_dane','instituciones.telefono','instituciones.direccion', 'instituciones.nombre_rector', 'instituciones.barrio_id', 'comunas.nombre_comuna', 'barrios.nombre_barrio')->join(
			'barrios',
			'barrios.id', '=', 'instituciones.barrio_id')->join(
			'comunas',
			'comunas.id', '=', 'barrios.comuna_id')->get();
		return response()->json(
			$comunas->toArray()
		);


	}

	public function ObtenerBarrios()
	{

		$barrios = Barrio::select('barrios.id', 'barrios.nombre_barrio', 'comunas.nombre_comuna')->join('comunas',
			'comunas.id', '=', 'barrios.comuna_id'
	)->get();
		return response()->json(
			$barrios->toArray()
		);

	}


	public function ObtenerBarrioID($id){


		$barrios = Institucion::select('barrios.id', 'barrios.nombre_barrio', 'comunas.nombre_comuna')->join(
			'barrios',
			'barrios.id', '=', 'instituciones.barrio_id')->join('comunas',
			'comunas.id', '=', 'barrios.comuna_id')->where('instituciones.id', '=', $this->hashids->decode($id))->firstOrfail();
			return response()->json(
			$barrios->toArray()
		);

	}


public function obtenerbarriosID($id){


		$barrios = Barrio::select('barrios.id', 'barrios.nombre_barrio')->join('comunas',
			'comunas.id', '=', 'barrios.comuna_id')->get();
			return response()->json(
			$barrios->toArray()
		);

	}



public function obtenerBarrioComunaID($id){


		$barrios = Institucion::select('comunas.id', 'comunas.nombre_comuna')->join(
			'barrios',
			'barrios.id', '=', 'instituciones.barrio_id')->join('comunas',
			'comunas.id', '=', 'barrios.comuna_id')->where('instituciones.id', '=', $this->hashids->decode($id))->firstOrfail();
			return response()->json(
			$barrios->toArray()
		);

	}

public function CrearInstitucion(Request $request){


        $institucion = new Institucion();
        $institucion->nombre_institucion = $request->input('nombre_institucion');
        $institucion->codigo_dane = $request->input('codigo_dane');
        $institucion->telefono = $request->input('telefono');
        $institucion->direccion = $request->input('direccion');
        $institucion->nombre_rector = $request->input('nombre_rector');
        $institucion->barrio_id = $request->input('barrio');
        $institucion->save();
         return response()->json(
                  $institucion->toArray()
              );


}

public function ObtenerInstitucionId($id){


	$institucion = Institucion::where('instituciones.id', '=', $this->hashids->decode($id))->firstOrfail();
		return response()->json(
			$institucion->toArray()
		);
	}


public function EditarInstitucion(Request $request, $id){




if ($request->input('barrio') == 0) {
	



	  $institucion = Institucion::findOrfail($this->hashids->decode($id)[0]);
	  $institucion->nombre_institucion = $request->input('nombre_institucion');
	  $institucion->codigo_dane = $request->input('codigo_dane');
	  $institucion->telefono = $request->input('telefono');
	  $institucion->direccion = $request->input('direccion');
	  $institucion->nombre_rector = $request->input('nombre_rector');
	  $institucion->save();
	  return response()->json(
	          $institucion->toArray()
	      );

	}
else {

	  $institucion = Institucion::findOrfail($this->hashids->decode($id)[0]);
	  $institucion->nombre_institucion = $request->input('nombre_institucion');
      $institucion->codigo_dane = $request->input('codigo_dane');
      $institucion->telefono = $request->input('telefono');
      $institucion->direccion = $request->input('direccion');
      $institucion->nombre_rector = $request->input('nombre_rector');
      $institucion->barrio_id = $request->input('barrio');
      $institucion->save();
      return response()->json(
            $institucion->toArray()
         );

	}

}


	public function EliminarInstitucion($id){

		$institucion = Institucion::findOrfail($this->hashids->decode($id)[0]);
		$institucion->delete();
		    return response()->json(
		                $institucion->toArray()
		            );


	}

}
