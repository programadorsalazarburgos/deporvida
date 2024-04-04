<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\TblDvInstitucionesEducativas;
use DB;
use response;

class PostInstitucionesEducativasController extends Controller
{
	public function index()
	{
		return view("postinstitucioneseducativas.listado");
	}
	public function create()
	{
		return view("postinstitucioneseducativas.create");
	}
	public function editar($id)
	{
		$data=TblDvInstitucionesEducativas::where('id',$id)->firstOrFail();
		return view("postinstitucioneseducativas.editar")->with([
			'id'=>$id,
			'nombre'=>$data->nombre
		]);	
	}

	public function listado()
	{
		return json_encode([
			'validate'=>true,
			'data'=> TblDvInstitucionesEducativas::where('activo','1')->orderBy('nombre')->get()
		],128);	
	}

	public function editar_instituciones(Request $request)
	{
		$data=TblDvInstitucionesEducativas::where('id','=',$request->input('id'))->firstOrFail();
		$data->nombre=trim(strtoupper($request->input('nombre')));
		$data->save();
		return json_encode(['validate'=>true,'data'=>$data],128);
	}
	public function datos(Request $request)
	{
		$data=TblDvInstitucionesEducativas::where('id','=',$request->input('id'))->firstOrFail();
		return json_encode(['validate'=>true,'data'=>$data],128);
	}
	public function nuevo_registro(Request $request)
	{
		$data = new TblDvInstitucionesEducativas();
		$data->nombre=trim(strtoupper($request->input('nombre')));
		$data->save();
		return json_encode(['validate'=>true,'data'=>$data],128);
	}
	public function combinar_nombres(Request $request)
	{
		$ids=$request->input('data_id');
		$id_nuevo=$ids[0];
		$data_old=TblDvInstitucionesEducativas::where('id','=',$id_nuevo)->firstOrFail();
		$data_old->nombre=trim(strtoupper($request->input('name')));
		foreach($ids as $id_anterior)
		{
			$this->editarInstituciones($id_nuevo,$id_anterior);
			$data 		  =TblDvInstitucionesEducativas::where('id','=',$id_anterior)->firstOrFail();
			$data->activo =0;
			$data->save();
		}
		$data_old->activo =1;
		$data_old->save();
		return json_encode(['validate'=>true]);
	}
	private function editarInstituciones($id_nuevo,$id_anterior)
	{
		$sql=array();
		$sql[]='UPDATE
			  `tbl_dv_empleado`
			SET
			  `id_institucion_educativa` = ?
			WHERE
			  `id_institucion_educativa` = ?';
		$sql[]='UPDATE
			  `tbl_dv_hoja_vida_estudio_profesional`
			SET
			  `id_institucion_educativo` = ?
			WHERE
			  `id_institucion_educativo` = ?';
		foreach($sql as $temp)
		{
			DB::select($temp,[$id_nuevo,$id_anterior]);
		}
	}
	public function id_search_institucion_educativa_x_nombre($nombre)//Busca la institucion. En caso de que no exista la crea
	{
		$nombre=trim(strtoupper($nombre));
		$data=TblDvInstitucionesEducativas::firstOrNew(['nombre'=>$nombre]);
		$data->nombre=$nombre;
		$data->save();
		return $data->id;
	}
}
