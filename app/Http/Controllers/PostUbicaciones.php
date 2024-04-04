<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use DB;
use response;



class PostUbicaciones extends Controller
{

	public function __construct()
	{
//    $this->middleware('permission:ver-roles', ['only' => 'vista']);
	}
	public function VerDepartamentos(Request $request)//$id=id_pais
	{
		$sql='SELECT 
			  `departamentos`.`id`,
			  `departamentos`.`nombre_departamento`
			FROM
			  `departamentos`
			WHERE
			  `departamentos`.`pais_id`=?
			ORDER BY 2';
		$data=DB::select($sql,[$request->input('id')]);
		return json_encode($data,128);
	}
	public function VerMunicipios(Request $request)//$id=id_pais
	{
		$sql='SELECT 
				  `municipios`.`id`,
				  `municipios`.`nombre_municipio`
				FROM
				  `municipios`
				WHERE
				  `municipios`.`departamento_id` = ?
				  ORDER BY 2';
		$data=DB::select($sql,[$request->input('id')]);
		return json_encode($data,128);
	}
}