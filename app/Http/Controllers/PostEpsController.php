<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Eps;
use App\Models\TblGenEp;
use response;

class PostEpsController extends Controller
{


	public function __construct()
	{


//    $this->middleware('permission:ver-roles', ['only' => 'vista']);


	}

	public function vista()
	{

		return view("posteps.appeps");
	}
	public function eps_regimen(Request $request)
	{
		$Eps = TblGenEp::where('id_regimen','=',$request->input('id'))->orderBy('descripcion')->get();
		return response()->json($Eps->toArray());
	}
	public function index()
	{

		$Eps = TblGenEp::where('activo','=','1')->get();
		return response()->json(
			$Eps->toArray()
		);

	}
	public function CrearEps(Request $request)
	{
        $eps = new TblGenEp();
        $eps->descripcion = $request->input('descripcion');
	    $eps->save();
    	return response()->json($eps->toArray());
	}



	public function ObtenerEps($id)
	{
		$Eps = TblGenEp::where('id', '=', $id)->firstOrfail();
		return response()->json($Eps->toArray());
	}


public function EditarEps(Request $request, $id){


  $Eps = TblGenEp::findOrfail($id);

  $Eps->descripcion = $request->input('descripcion');
  $Eps->save();
      return response()->json(
                $Eps->toArray()
            );
}

	

	public function EliminarEps($id)
	{
		$Eps = TblGenEp::findOrfail($id);
		$Eps->activo=0;
		$Eps->save();
		return response()->json($Eps->toArray());

	}

}
