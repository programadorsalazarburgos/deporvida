<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Comuna;
use App\TblDvZonas;
use response;
use DB;

class PostComunasController extends Controller
{

    public function __construct()
    {


//    $this->middleware('permission:ver-roles', ['only' => 'vista']);
    }

    public function vista()
    {

        return view("postcomunas.appcomunas");
    }

    public function index()
    {
        $data = DB::select('SELECT 
            `comunas`.id,
            `comunas`.`codigo_comuna`,
            `comunas`.`nombre_comuna`,
            `tbl_dv_zonas`.`nombre_zona`
          FROM
            `comunas`
            LEFT JOIN `tbl_dv_zonas` ON (`comunas`.`zona_id` = `tbl_dv_zonas`.`id`)
            ORDER BY
            `comunas`.`id`,
            `tbl_dv_zonas`.`nombre_zona`', []);
        //$comunas = \App\TblGenComunas::orderBy('nombre_comuna')->get();
        return response()->json($data);
    }

    public function ObtenerZonas()
    {

        $zonas = TblDvZonas::all();
        return response()->json($zonas->toArray());
    }

    public function ObtenerZonaID($id)
    {
        $data = DB::select('SELECT 
  `tbl_dv_zonas`.id,
  `tbl_dv_zonas`.`nombre_zona`
FROM
  `comunas`
  INNER JOIN `tbl_dv_zonas` ON (`comunas`.`zona_id` = `tbl_dv_zonas`.`id`)
  where
  `comunas`.`id`=?', [$id]);
        return response()->json($data[0]);
    }

    public function CrearComuna(Request $request)
    {


        $comuna                = new \App\TblGenComunas();
        $comuna->codigo_comuna = $request->input('codigo_comuna');
        $comuna->nombre_comuna = $request->input('nombre_comuna');
        $comuna->zona_id       = $request->input('zona');
        $comuna->save();
        return response()->json($comuna->toArray());
    }

    public function ObtenerComuna($id)
    {
        $comuna = \App\TblGenComunas::where('id', '=', $id)->firstOrfail();
        return response()->json($comuna->toArray());
    }

    public function EditarComuna(Request $request, $id)
    {
        $comuna                = \App\TblGenComunas::findOrfail($id);
        $comuna->codigo_comuna = $request->input('codigo_comuna');
        $comuna->nombre_comuna = $request->input('nombre_comuna');
        $comuna->zona_id       = $request->input('zona');
        $comuna->save();
        return response()->json($comuna->toArray());
    }

    public function EliminarComuna($id)
    {

        $comuna = \App\TblGenComunas::findOrfail($id);
        $comuna->delete();
        return response()->json($comuna->toArray());
    }

}
