<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\inventarioController;
use DB;
use App\Models\TblDvImplementos;
use App\Models\TblDvClasificacionImplementos;
use App\Models\TblDvProveedores;
use App\Models\TblDvDisciplinas;

class PostImplementosController extends Controller
{
    public function create()
    {
    	return view('postimplementos.create')->with([
			'clasificacion'=>TblDvClasificacionImplementos::all(),
			'proveedor'=>TblDvProveedores::all(),
			'disciplina'=>TblDvDisciplinas::orderBy('descripcion')->get()
		]);
    }

    public function index()
    {
    	return view('postimplementos.index');
    }

    public function listarImplementos()
    {
    	$sql = 'SELECT
                  `tbl_dv_implementos`.`id` AS `id`,
                  `tbl_dv_implementos`.`cantidad_actual`  AS `cantidad_actual`,
                  UCASE(`tbl_dv_implementos`.`nombre`) AS `nombre`,
                  `tbl_dv_implementos`.`stock` AS `stock`,
                  UCASE(`tbl_dv_proveedores`.`nombre`) AS `nombre_proveedor`,
                  UCASE(`tbl_dv_clasificacion_implementos`.`nombre`) AS `nombre_clasificacion`
                FROM
                  `tbl_dv_implementos`
                INNER JOIN `tbl_dv_clasificacion_implementos` ON (`tbl_dv_implementos`.`clasificacion_id` = `tbl_dv_clasificacion_implementos`.`id` )
                INNER JOIN `tbl_dv_proveedores` ON (`tbl_dv_implementos`.`proveedor_id` = `tbl_dv_proveedores`.`id` )
              	ORDER BY
                  `tbl_dv_implementos`.`nombre` DESC';
        $implementos = DB::select($sql, []);
        foreach($implementos as $key=>$temp)
        {
            // $implementos[$key]->cantidad_actual=inventarioController::fn_implementos_cantidad($temp->id);
        }

        return response()->json(['validate' => true, 'data' => $implementos]);
    }


    public function save(Request $request)
    {
    	try
        {

    		$implemento = new TblDVImplementos();
    		$implemento->clasificacion_id = $request->clasificacion_id;
    		$implemento->disciplina_id = $request->disciplina_id;
    		$implemento->proveedor_id = $request->proveedor_id;
    		$implemento->nombre = $request->nombre;
    		$implemento->especificacion_tecnica = $request->especificacion_tecnica;
    		$implemento->stock = $request->stock;
    		$implemento->cantidad_actual = $request->stock;

            $implemento->save();

    		 echo json_encode(['validate' => true, 'msj' => 'Guardado con exito']);
    	}
        catch (Exception $e)
        {
            echo json_encode(['validate' => false, 'msj' => $e]);
        }
    }


    public function edit($id)
    {
    	$implemento = TblDVImplementos::find($id);

    	return view('postimplementos.editar')->with([
            'implemento'=>$implemento,
			'clasificacion'=>TblDvClasificacionImplementos::all(),
			'proveedor'=>TblDvProveedores::all(),
			'disciplina'=>TblDvDisciplinas::orderBy('descripcion')->get()
        ]);
    }


    public function update(Request $request, $id)
    {
		try
	        {
		    	$implemento = TblDVImplementos::find($id);
        		$input = $request->all();
        		$implemento->fill($input)->save();

	            echo json_encode(['validate' => true, 'msj' => 'Guardado con exito']);
	        }
	    catch (Exception $e)
	        {
	            echo json_encode(['validate' => false, 'msj' => $e]);
	        }
    }


    public function destroy($id)
    {
        try
	        {
		    	$implemento = TblDVImplementos::find($id);

    			$implemento->delete();

        		echo json_encode(['validate' => true, 'msj' => 'Borrado con exito']);
        	}
    	catch (Exception $e)
        	{
           		echo json_encode(['validate' => false, 'msj' => $e]);
        	}

    }



}
