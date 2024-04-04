<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Barrio;
use App\Comuna;
use App\Models\TblDvImplementos;
use App\Models\TblDvProveedores;
use App\Models\TblDvClasificacionImplementos;
use App\Models\TblDvDisciplinas;
use App\User;
use response;
use DB;
	
class inventarioController extends Controller
{
	public function __contruct()
	{
	}	
	public static function fn_implementos_cantidad($id_implemento)
	{
		$sql1='SELECT 
		(`tbl_dv_implementos`.`stock`+ COALESCE(`tbl_dv_deatalle_entrada`.`cantidad`,0)) AS total
	  FROM
		`tbl_dv_implementos`
		LEFT OUTER JOIN `tbl_dv_deatalle_entrada` ON (`tbl_dv_implementos`.`id` = `tbl_dv_deatalle_entrada`.`implemento_id`)
		WHERE
		`tbl_dv_implementos`.`id`=?';
		$sql2='SELECT 
		COALESCE(SUM(`tbl_dv_deatalle_prestamo`.`cantidad`),0) AS `total`
	  FROM
		`tbl_dv_deatalle_prestamo`
		INNER JOIN `tbl_dv_prestamo_inventario` ON (`tbl_dv_deatalle_prestamo`.`prestamo_id` = `tbl_dv_prestamo_inventario`.`id`)
	  WHERE
		`tbl_dv_prestamo_inventario`.`estado` = 1 AND 
		`tbl_dv_deatalle_prestamo`.`implemento_id` = ?';
		$sql3='  SELECT 
		COALESCE(SUM(`tbl_dv_deatalle_devolucion`.`cantidad`),0) as total
		FROM
		  `tbl_dv_deatalle_devolucion`
		  LEFT OUTER JOIN `tbl_dv_deatalle_devolucion_estado` ON (`tbl_dv_deatalle_devolucion`.`id_deatalle_prestamo_devolucion_estado` = `tbl_dv_deatalle_devolucion_estado`.`id`)
		WHERE
		  `tbl_dv_deatalle_devolucion`.`implemento_id` = ?';

		$data1=DB::select($sql1,[$id_implemento]);
		$data2=DB::select($sql2,[$id_implemento]);
		$data3=DB::select($sql3,[$id_implemento]);
		$total=($data1[0]->total) - ($data2[0]->total) + ($data3[0]->total);
		return $total;

	}
	public function SaveImplementos(Request $requests)
	{
		$save = new TblDvImplementos();
		$save->nombre 					= $requests->input('nombre');
		$save->clasificacion_id 		= $requests->input('clasificacion_id');
		$save->disciplina_id 			= $requests->input('disciplina_id');
		$save->proveedor_id 			= $requests->input('proveedor_id');
		$save->stock 					= $requests->input('stock');
		$save->especificacion_tecnica 	= $requests->input('especificacion_tecnica');
		$save->save();
		return response()->json(['validate'=>(!is_null($save->id))]);
	}
	public function ShowImplementos()
	{
		$sql='SELECT 
		  `tbl_dv_clasificacion_implementos`.`nombre` as implemento,
		  `tbl_dv_proveedores`.`nombre` as proveedor,
		  `tbl_dv_deatalle_inventario_fisico`.`enbodega` as cantidad_bodega,
		  `tbl_dv_implementos`.`id` as opciones
		FROM
		  `tbl_dv_implementos`
		  INNER JOIN `tbl_dv_clasificacion_implementos` ON (`tbl_dv_implementos`.`clasificacion_id` = `tbl_dv_clasificacion_implementos`.`id`)
		  INNER JOIN `tbl_dv_proveedores` ON (`tbl_dv_implementos`.`proveedor_id` = `tbl_dv_proveedores`.`id`)
		  INNER JOIN `tbl_dv_deatalle_inventario_fisico` ON (`tbl_dv_deatalle_inventario_fisico`.`implemento_id` = `tbl_dv_implementos`.`id`)
		  INNER JOIN `tbl_dv_inventario_fisico` ON (`tbl_dv_deatalle_inventario_fisico`.`inventario_id` = `tbl_dv_inventario_fisico`.`id`)
		  ORDER BY 1';
		$data=DB::select($sql);
		return view('invimplementos.index')->with(['data'=>$data]);
	}
	public function CreateImplementos()
	{
		return view('invimplementos.create')->with([
			'clasificacion'=>TblDvClasificacionImplementos::all(),
			'proveedor'=>TblDvProveedores::all(),
			'disciplina'=>TblDvDisciplinas::orderBy('descripcion')->get()
		]);		
	}
	public function CreateProveedores()
	{
		$data=DB::table('tbl_dv_implementos')

            ->join('tbl_dv_disciplinas', 'tbl_dv_implementos.disciplina_id', '=', 'tbl_dv_disciplinas.id')
            ->join('tbl_dv_proveedores', 'tbl_dv_implementos.proveedor_id', '=', 'tbl_dv_proveedores.id')
        
            ->select(
            	'tbl_dv_implementos.id',
            	'tbl_dv_disciplinas.descripcion as disciplinas',
            	'tbl_dv_implementos.nombre as implementos',
            	'tbl_dv_proveedores.nombre as proveedores',
            	'tbl_dv_implementos.stock'
            	)
            ->get();
		return view('invproveedores.create')->with(['data'=>$data]);
	}
	public function ShowProveedores()
	{
		$sql='SELECT 
		  `tbl_dv_clasificacion_implementos`.`nombre` as implemento,
		  `tbl_dv_proveedores`.`nombre` as proveedor,
		  `tbl_dv_deatalle_inventario_fisico`.`enbodega` as cantidad_bodega,
		  `tbl_dv_implementos`.`id` as opciones
		FROM
		  `tbl_dv_implementos`
		  INNER JOIN `tbl_dv_clasificacion_implementos` ON (`tbl_dv_implementos`.`clasificacion_id` = `tbl_dv_clasificacion_implementos`.`id`)
		  INNER JOIN `tbl_dv_proveedores` ON (`tbl_dv_implementos`.`proveedor_id` = `tbl_dv_proveedores`.`id`)
		  INNER JOIN `tbl_dv_deatalle_inventario_fisico` ON (`tbl_dv_deatalle_inventario_fisico`.`implemento_id` = `tbl_dv_implementos`.`id`)
		  INNER JOIN `tbl_dv_inventario_fisico` ON (`tbl_dv_deatalle_inventario_fisico`.`inventario_id` = `tbl_dv_inventario_fisico`.`id`)
		  ORDER BY 1';
		$data=DB::select($sql);
		return view('invproveedores.index')->with(['data'=>$data]);
	}
	public function entradaInventario()
	{
		return view('inventradas.new');	
	}
}

