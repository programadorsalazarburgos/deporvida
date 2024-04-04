<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Disciplinas;
use DB;
use response;

class PostDisciplinasController extends Controller
{
	public function index()//Vista de listado de todas las disciplinas
	{
		return view("postdisciplinas.index");
	}
	public function editar($id)//Vista de un registro
	{
		$data=Disciplinas::where('id','=',$id)->where('activo','=','1')->firstOrfail();
		return view("postdisciplinas.editar")->with([
			'nombre'=>$data->descripcion,
			'id'=>$id
		]);
	}
	public function create()//Vista Nueva disciplina
	{
		return view("postdisciplinas.create");
	}

	public function listado()//Muestra todas las disciplinas activas JSON
	{
		$Disciplinas = Disciplinas::where('activo','=','1')->orderBy('descripcion')->get();
		return response()->json(['validate'=>true,'data'=>$Disciplinas->toArray()]);

	}
	public function nuevo_registro(Request $request)//Post guarda el nuevo registro
	{
		$Disciplinas = new Disciplinas();
		$Disciplinas->descripcion=trim(strtoupper($request->input('descripcion')));
		$Disciplinas->activo=1;
		$Disciplinas->save();
		return response()->json(['validate'=>true,'data'=>$Disciplinas]);
	}
	public function borrar($id)//Post desactiva la disciplina
	{
		$Disciplinas = Disciplinas::where('id','=',$id)->firstOrfail();
		$Disciplinas->activo=0;
		$Disciplinas->save();
		return response()->json(['validate'=>true]);
	}
	public function editar_registro(Request $request)//Post editar la disciplina
	{
		$Disciplinas = Disciplinas::where('id','=',$request->input('id'))->where('activo','=','1')->firstOrfail();
		$Disciplinas->descripcion=trim(strtoupper($request->input('descripcion')));
		$Disciplinas->save();
		return response()->json(['validate'=>true,'data'=>$Disciplinas]);
	}
}
