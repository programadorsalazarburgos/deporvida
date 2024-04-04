<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class PanelControlController extends Controller
{
	private function TotalBeneficiarios()
	{
		$sql="SELECT 
		  count(DISTINCT `tbl_dv_ficha`.`id_persona_beneficiario`) as total
		FROM
		  `tbl_dv_ficha`
		WHERE
		  `tbl_dv_ficha`.`vinculado` = 1";
		$data=DB::select($sql);
		return $data[0]->total;
	}
	private function Generos()
	{
		$sql="SELECT 
		  count(*) AS `data`,
		  CASE
		  WHEN `tbl_gen_persona`.`sexo`=1
		  THEN 'HOMBRE'
		  WHEN `tbl_gen_persona`.`sexo`=2
		  THEN 'MUJER'
		  ELSE 'Sin Dato'
		  END AS name
		FROM
		  `tbl_dv_ficha`
		  INNER JOIN `tbl_gen_persona` ON (`tbl_dv_ficha`.`id_persona_beneficiario` = `tbl_gen_persona`.`id`)
		WHERE
		  `tbl_dv_ficha`.`vinculado` = 1
		GROUP BY
		  `tbl_gen_persona`.`sexo`";
		$data=DB::select($sql);
		foreach($data as $key=>$temp)
		{
			$data[$key]->data=array($temp->data);
		}
		return $data;
	}
	private function edad_promedio()
	{
		$sql="SELECT   round(SUM(TIMESTAMPDIFF(YEAR, `tbl_gen_persona`.`fecha_nacimiento`, NOW()))/count(*))
			   AS `edad_promedio`,
			   0 as edad_minima,
			   19 as edad_maxima
			FROM
			  `tbl_dv_ficha`
			  
			  INNER JOIN `tbl_gen_persona` ON (`tbl_dv_ficha`.`id_persona_beneficiario` = `tbl_gen_persona`.`id`)
			  WHERE
			  TIMESTAMPDIFF(YEAR, `tbl_gen_persona`.`fecha_nacimiento`, NOW())<=19
			  AND
			  `tbl_dv_ficha`.`vinculado`=1";
		$data=DB::select($sql);
		return $data[0]->edad_promedio;
	}
	private function Comunas_residencia()
	{
		$sql="SELECT 
				COALESCE(`comunas`.`nombre_comuna`,'NN') AS `name`,
				count(*) as data
				FROM
				  `tbl_dv_ficha`
				  LEFT OUTER JOIN `tbl_gen_persona` ON (`tbl_dv_ficha`.`id_persona_beneficiario` = `tbl_gen_persona`.`id`)
				  LEFT OUTER JOIN `barrios` ON (`tbl_gen_persona`.`id_residencia_barrio` = `barrios`.`id`)
				  LEFT OUTER JOIN `comunas` ON (`barrios`.`comuna_id` = `comunas`.`id`)
				WHERE
				  `tbl_dv_ficha`.`vinculado`=1  
				GROUP BY `comunas`.`nombre_comuna`
				ORDER BY `comunas`.`codigo_comuna`";
		$data=DB::select($sql);
		foreach($data as $key=>$temp)
		{
			$data[$key]->data=array($temp->data);
		}
		return $data;		
	}
	private function estratos_socioeconomicos()
	{
		$sql="SELECT 
			  count(*) AS `data`,
			  CONCAT('Estrato ',COALESCE(`tbl_gen_persona`.`residencia_estrato`,'NN')) as name
			FROM
			  `tbl_dv_ficha`
			  LEFT OUTER JOIN `tbl_gen_persona` ON (`tbl_dv_ficha`.`id_persona_beneficiario` = `tbl_gen_persona`.`id`)
			WHERE
				  `tbl_dv_ficha`.`vinculado`=1
			GROUP BY
			  `tbl_gen_persona`.`residencia_estrato`
			ORDER BY
			  `tbl_gen_persona`.`residencia_estrato`";
		$data=DB::select($sql);
		foreach($data as $key=>$temp)
		{
			$data[$key]->data=array($temp->data);
		}
		return $data;			
	}
	private function nivel_escolaridad()
	{
		$sql="SELECT 
			  count(*) as data,
			  `tbl_gen_escolaridad_nivel`.`descripcion` as name
			FROM
			  `tbl_gen_escolaridad_nivel`
			  LEFT OUTER JOIN `tbl_dv_ficha` ON (`tbl_gen_escolaridad_nivel`.`id` = `tbl_dv_ficha`.`id_escolaridad_nivel`)
			  WHERE
				  `tbl_dv_ficha`.`vinculado`=1
			GROUP BY
			  `tbl_dv_ficha`.`id_escolaridad_nivel`
			ORDER BY
			  `tbl_gen_escolaridad_nivel`.`descripcion`";
		$data=DB::select($sql);
		foreach($data as $key=>$temp)
		{
			$data[$key]->data=array($temp->data);
		}
		return $data;	 		
	}
	private function corregimiento_residencia()
	{
		$sql="SELECT 
			count(*) as data,
			  COALESCE(`tbl_gen_corregimientos`.`descripcion`,'NN') AS `name`
			FROM
			  `tbl_dv_ficha`
			  INNER JOIN `tbl_gen_persona` ON (`tbl_dv_ficha`.`id_persona_beneficiario` = `tbl_gen_persona`.`id`)
			  LEFT OUTER JOIN `tbl_gen_corregimientos` ON (`tbl_gen_persona`.`id_residencia_corregimiento` = `tbl_gen_corregimientos`.`id`)
			    WHERE
				  `tbl_dv_ficha`.`vinculado`=1
			GROUP BY
			  `tbl_gen_corregimientos`.`descripcion`
			ORDER BY
			  `tbl_gen_corregimientos`.`descripcion`";
		$data=DB::select($sql);
		foreach($data as $key=>$temp)
		{
			$data[$key]->data=array($temp->data);
		}
		return $data;		
	}
	private function cobertura_comuna_impacto()
	{
		$sql="SELECT 
				  `comunas`.`nombre_comuna` AS `name`,
				  count(*) AS `data`
				FROM
				  `tbl_dv_ficha`
				  INNER JOIN `tbl_dv_grupos` ON (`tbl_dv_ficha`.`id_grupo` = `tbl_dv_grupos`.`id`)
				  LEFT OUTER JOIN `comunas` ON (`tbl_dv_grupos`.`id_comuna_impacto` = `comunas`.`id`)
				WHERE
				  `tbl_dv_ficha`.`vinculado` = 1
				GROUP BY
				  `comunas`.`nombre_comuna`
				ORDER BY
				  `comunas`.`nombre_comuna`";
		$data=DB::select($sql);
		foreach($data as $key=>$temp)
		{
			$data[$key]->data=array($temp->data);
		}
		return $data;	
	}
	private function cobertura_disciplina()
	{
		$sql="SELECT 
				  `tbl_dv_disciplinas`.`descripcion` AS `name`,
				  count(*) AS `data`
				FROM
				  `tbl_dv_ficha`
				  INNER JOIN `tbl_dv_grupos` ON (`tbl_dv_ficha`.`id_grupo` = `tbl_dv_grupos`.`id`)
				  INNER JOIN `tbl_dv_disciplinas` ON (`tbl_dv_grupos`.`id_disciplina` = `tbl_dv_disciplinas`.`id`)
				WHERE
				  `tbl_dv_ficha`.`vinculado` = 1
				GROUP BY
				  `tbl_dv_disciplinas`.`descripcion`
				ORDER BY
				  `tbl_dv_disciplinas`.`descripcion`";
		$data=DB::select($sql);
		foreach($data as $key=>$temp)
		{
			$data[$key]->data=array($temp->data);
		}
		return $data;
	}
	private function con_discapacidad()
	{
		$sql="SELECT 
				  count(*) AS `data`,
				  CASE
				  WHEN `tbl_dv_ficha`.`tiene_discapacidad`=1
				  THEN 'Si'
				  WHEN `tbl_dv_ficha`.`tiene_discapacidad`=0
				  THEN 'No'
				  ELSE
				  'Sin Datos'
				  END AS name
			FROM
				  `tbl_dv_ficha`
			WHERE
				  `tbl_dv_ficha`.`vinculado` = 1
			GROUP BY
				`tbl_dv_ficha`.`tiene_discapacidad`
			ORDER BY
				`tbl_dv_ficha`.`tiene_discapacidad`";
		$data=DB::select($sql);
		foreach($data as $key=>$temp)
		{
			$data[$key]->data=array($temp->data);
		}
		return $data; 		
	}
	private function etnias()
	{
		$sql="SELECT 
				  COALESCE(`tbl_gen_etnia`.`descripcion`,'NN') AS `name`,
				  count(*) AS `data`
				FROM
				  `tbl_dv_ficha`
				  LEFT OUTER JOIN `tbl_gen_etnia` ON (`tbl_dv_ficha`.`id_etnia` = `tbl_gen_etnia`.`id`)
				WHERE
				  `tbl_dv_ficha`.`vinculado` = 1
				GROUP BY
				  `tbl_gen_etnia`.`descripcion`
				ORDER BY
				  `tbl_gen_etnia`.`descripcion`";
		$data=DB::select($sql);
		foreach($data as $key=>$temp)
		{
			$data[$key]->data=array($temp->data);
		}
		return $data; 	
	}
	private function ingreso_retiros_beneficiarios()
	{
		$sql="SELECT 
				  date(`tbl_dv_ficha`.`fecha_registro`) as `name`,
				  count(*) AS `data`
				FROM
				  `tbl_dv_ficha`
				GROUP BY
				  DATE(`tbl_dv_ficha`.`fecha_registro`)
				ORDER BY
				  `tbl_dv_ficha`.`fecha_registro`";
		$data=DB::select($sql);
		foreach($data as $key=>$temp)
		{
			$data[$key]->data=array($temp->data);
		}
		return $data; 
	}
	public function PanelControl(Request $request)
	{
		$data=array(
			'TotalBeneficiarios'			=>	number_format($this->TotalBeneficiarios()),
			'Generos'						=>	$this->Generos(),
			'edad_promedio'					=>	$this->edad_promedio(),
			'Comunas_residencia'			=>	$this->Comunas_residencia(),
			'estratos_socioeconomicos'		=>	$this->estratos_socioeconomicos(),
			'nivel_escolaridad'				=>	$this->nivel_escolaridad(),
			'corregimiento_residencia'		=>	$this->corregimiento_residencia(),
			'cobertura_comuna_impacto'		=>	$this->cobertura_comuna_impacto(),
			'cobertura_disciplina'			=>	$this->cobertura_disciplina(),
			'con_discapacidad'				=>	$this->con_discapacidad(),
			'etnias'						=>	$this->etnias(),
			'ingreso_retiros_beneficiarios'	=>	$this->ingreso_retiros_beneficiarios(),
		);
		//echo '<pre>'.json_encode($data,128);exit;
		return response()->json($data);
	}
	public function index()
	{
		return view('postpanel.index')->with(['total'=>number_format($this->TotalBeneficiarios())]);
	}
}
