<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use response;
use App\TblDvZonas;

class PostZonasController extends Controller
{

    public function __construct()
    {
//    $this->middleware('permission:ver-roles', ['only' => 'vista']);
    }

    public function vista()
    {

        return view("postzonas.appzonas");
    }

    public function index()
    {

        $zonas = TblDvZonas::all();
        return response()->json(
                        $zonas->toArray()
        );
    }

    public function ObtenerRoles()
    {

        $roles = Role::all();
        return response()->json(
                        $roles->toArray()
        );
    }

    public function CrearZona(Request $request)
    {

        $zona              = new TblDvZonas();
        $zona->nombre_zona = $request->input('nombre_zona');
        $zona->save();
        return response()->json($zona->toArray());
    }

    public function ObtenerZona($id)
    {
        $zona = TblDvZonas::where('id', '=', $id)->firstOrfail();
        return response()->json(
                        $zona->toArray()
        );
    }

    public function EditarZona(Request $request, $id)
    {


        $zona = TblDvZonas::findOrfail($id);

        $zona->nombre_zona = $request->input('nombre_zona');
        $zona->save();
        return response()->json($zona->toArray());
    }

    public function EliminarZona($id)
    {

        $zona = TblDvZonas::findOrfail($id);
        $zona->delete();
        return response()->json($zona->toArray());
    }

}
