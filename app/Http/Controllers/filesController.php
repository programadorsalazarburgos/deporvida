<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Barrio;
use App\Comuna;
use App\User;
use response;
use DB;

class filesController extends Controller
{
	private $i;
	public function __contruct()
	{
		$this->i=0;
	}
	//=============================MIS DOCUMENTOS=============================//
	public function size(Request $request)
	{
		$ds=DIRECTORY_SEPARATOR;
		$url=dirname(__FILE__).$ds.'..'.$ds.'..'.$ds.'..'.$ds.'public'.$ds.$request->input('file');
		if(file_exists ($url))
		{
			$size=filesize($url);
		}
		else{
			$size=0;
		}
		return json_encode(
			[
				'validate'=>true,
				'size'=>$size
			],128);
	}
	public function mis_documentos()
	{
		$ds=DIRECTORY_SEPARATOR;
		$url='documentos'.$ds.Auth::user()->id;
		// if(!file_exists($url))
		// {
		// 	mkdir($url, 0777);
		// }
		return view('documentos.index')->with(['id_user'=>Auth::user()->id]);
	}
	private function listar_archivos($carpeta)
	{
		$html='<ul>';
	    if(is_dir($carpeta))
	    {
	        if($dir = opendir($carpeta))
	        {
	            while(($archivo = readdir($dir)) !== false)
	            {
	                if($archivo != '.' && $archivo != '..' && $archivo != '.htaccess'
	                	&& $archivo!='.quarantine' && $archivo !='.tmb')
	                {
	                	$name=$carpeta.DIRECTORY_SEPARATOR.$archivo;
	                	$html.='<li>';
	                	if(is_dir($name))
	                	{
	                		$html.=$archivo;
	                		$html.=$this->listar_archivos($name);

	                	}
	                	else
	                	{
	                    	$html .=
	                    	'<a target="_blank" href="'.$carpeta.'/'.$archivo.'">'.$archivo.'</a>';
	                	}
	                	$html.='</li>';
	                }
	            }
	            closedir($dir);
	        }
	    }
	    $html.='</ul>';
	    return $html;
	}
	private function NameUser($id_user)
	{
		$data = User::where('id','=',$id_user)->first();
		$nombre=strtoupper($data->primer_nombre.' '.
				$data->segundo_nombre.' '.
				$data->primer_apellido.' '.
				$data->segundo_apellido);
		return $nombre;
	}
	private function recorrer_archivos_users($users)
	{
		$i=1;
		$html='<ul id="miMenu">';
		foreach($users as $temp)
		{
			$data='documentos'.DIRECTORY_SEPARATOR.$temp;
			$nombre='Carpeta '.$i;//$this->NameUser($temp);
			$ruta=$this->listar_archivos($data);
			if($ruta!='<ul></ul>')
			{
				$i++;
				$html.='<li>'.$nombre.$ruta.'</li>';
			}
		}
		$html.='</ul>';
		return $html;
	}
	private function users()
	{
		$sql='SELECT
		  `role_user`.`user_id`
		FROM
		  `role_user`
		WHERE
		  `role_user`.`role_id` IN (1,6,8,9,11,22)';
		  $data = DB::select($sql);
		  $res=array();
		foreach($data as $temp)
		{
			$res[]=$temp->user_id;
		}
		if(!in_array(Auth::user()->id,$res))
		{
			array_unshift($res,Auth::user()->id);
		}
		return $res;
	}
	public function archivos()
	{
		$users=$this->users();
		$archivos=$this->recorrer_archivos_users($users);
		return view('documentos.archivos')->with(['archivos'=>$archivos]);
	}

	//=============================MIS DOCUMENTOS=============================//
}
