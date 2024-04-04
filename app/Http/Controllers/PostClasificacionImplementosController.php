<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use Validator;
use App\Models\TblDvClasificacionImplementos;


class PostClasificacionImplementosController extends Controller
{
    
    public function create()
    {
      return view('postclasificacionesimplementos.create');
    }
    public function index()
    {
    	return view('postclasificacionesimplementos.index');
    }

    public function listarclasificaciones()
    {
    	$sql = 'SELECT 
          `tbl_dv_clasificacion_implementos`.`id` AS `id`,
           UCASE(`tbl_dv_clasificacion_implementos`.`nombre`) AS `nombre`,
           UCASE(`tbl_dv_clasificacion_implementos`.`observaciones`) AS `observaciones`
        FROM
          `tbl_dv_clasificacion_implementos`
        ORDER BY
          `tbl_dv_clasificacion_implementos`.`nombre` ASC';

        $clasificaciones = DB::select($sql, []);

        return response()->json(['validate' => true, 'data' => $clasificaciones]);
    
    }

    public function edit($id)
    {
      $clasificacion = TblDvClasificacionImplementos::find($id);
      
      return view('postclasificacionesimplementos.editar')->with([
            'clasificacion'=>$clasificacion
        ]);
    }

    public function update(Request $request, $id)
    {
    try
          {
            $clasificacion = TblDvClasificacionImplementos::find($id);
            $input = $request->all();
            $clasificacion->fill($input)->save();

              echo json_encode(['validate' => true, 'msj' => 'Guardado con exito']);
          }
      catch (Exception $e)
          {
              echo json_encode(['validate' => false, 'msj' => $e]);
          }
    }



    public function eliminarClasificacion($id)
    {
    	$clasificacion = TblDvClasificacionImplementos::find($id);

    	$clasificacion->delete();

    	return response()->json($clasificacion->toArray());
    }

    public function save(Request $request)
    {
      try
        {
        $validation = $this->validator($request->all());

        if($validation->fails()) {
          echo json_encode(['validate' => false, 'msj' => $validation->errors()]);
        }

        $clasificacion = new TblDvClasificacionImplementos();
        $clasificacion->nombre = $request->nombre;
        if($request->observaciones){
          $clasificacion->observaciones = $request->observaciones;
        }
        $clasificacion->save();
         echo json_encode(['validate' => true, 'msj' => 'Guardado con exito']);
      }
        catch (Exception $e)
        {
            echo json_encode(['validate' => false, 'msj' => $e]);
        }
    }

    protected function validator(array $data)
    {
      return Validator::make($data,[
        'nombre' => 'required|string'
      ]);
    }

}
