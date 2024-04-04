<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use response;
use Excel;

use App\Models\TblDvDisciplinas;
use App\Comuna;

/* use App\RoleUser;
use App\Grupo; */

class PostReporteFichaController extends Controller
{

    public function __construct()
	{
        //$this->middleware('permission:ver-roles', ['only' => 'vista']);
	}

    public function vista()
    {
        return view("postreporteficha.appreporteficha");
    }
    public function vistabasica()
    {
        return view("postreporteficha.appreportefichabasica");
    }

    private function dataReporte($fecha_inicial, $fecha_final, $disciplina, $comuna_impacto, $monitor, $sexo, $activo='')
    {


        
        $where = "";
        ($disciplina) ? $where .= " AND tbl_dv_disciplinas.id = $disciplina" : $where .= "";
        ($comuna_impacto) ? $where .= " AND comuna_impacto.id = $comuna_impacto" : $where .= "";
        ($monitor) ? $where .= " AND tbl_dv_empleado.id_usuario = $monitor" : $where .= "";
        ($sexo) ? $where .= " AND tbl_gen_persona.sexo = $sexo" : $where .= "";
        $where .= (!is_null($activo)) ? " AND tbl_dv_grupos.activo = $activo " : "";
        $sql="SELECT 
            @consecutivo:=@consecutivo+1 AS 'FICHA_NO', 
            fichas.* 
        FROM 
            (
                SELECT @consecutivo:=0
            ) AS filas, 
            (
                SELECT
                    -- Datos de la Grupo o la Ficha
                    CASE WHEN `tbl_dv_ficha`.`vinculado`=1 THEN 'SI' WHEN `tbl_dv_ficha`.`vinculado`= 0 THEN 'NO' END
                     AS 'VINCULADO_ACTUALMENTE',
                    `tbl_dv_ficha`.`id` AS 'FICHA_ID',
                    `tbl_dv_ficha`.`fecha_registro` AS 'FECHA_REGISTRO',
                    COALESCE(date(`tbl_dv_ficha`.`fecha_retiro`),'---- -- --') AS 'FECHA_RETIRO',
                    COALESCE(`tbl_motivos_desvinculaciones`.`nombre`, '') AS 'motivo_desvinculacion',
                    'SEMILLEROS' AS 'PROGRAMA',
                    `tbl_dv_disciplinas`.`descripcion` AS 'MODALIDAD',
                    CONCAT_WS(', ',`tbl_dv_escenarios`.`nombre_escenario`,`tbl_dv_escenarios`.`direccion`) AS 'PUNTO_DE_ATENCION',
                    COALESCE(`tbl_barrio_escenario`.`nombre_barrio`, '') AS 'BARRIO_PUNTO_DE_ATENCION',
                    COALESCE(`tbl_comuna_escenario`.`nombre_comuna`, '') AS 'COMUNA_PUNTO_DE_ATENCION',
                    COALESCE(`comuna_impacto`.`nombre_comuna`, '') AS 'COMUNA_DE_IMPACTO',
                    `tbl_dv_monitor`.`id` AS 'ID_MONITOR',
                    CONCAT_WS(' ',tbl_dv_monitor.nombre_primero,tbl_dv_monitor.nombre_segundo,tbl_dv_monitor.apellido_primero,tbl_dv_monitor.apellido_segundo) AS 'MONITOR',
                    '--' AS 'ASISTENCIAS_BENEFICIARIO',

                    -- Datos grupo 
                    tbl_dv_grupos.codigo_grupo AS 'CODIGO_GRUPO',
                    `tbl_dv_niveles`.`descripcion` as 'NIVEL_GRUPO',
                   CASE WHEN `tbl_dv_grupos`.`activo`=1 THEN 'SI' WHEN `tbl_dv_grupos`.`activo`= 0 THEN 'NO' END as 'GRUPO_ACTIVO',

                    -- Datos del Beneficiario 
                    tbl_gen_persona.id AS 'ID_BENEFICIARIO',
                    tbl_gen_persona.nombre_primero AS 'PRIMER_NOMBRE',
                    tbl_gen_persona.nombre_segundo AS 'SEGUNDO_NOMBRE',
                    tbl_gen_persona.apellido_primero AS 'PRIMER_APELLIDO',
                    tbl_gen_persona.apellido_segundo AS 'SEGUNDO_APELLIDO',
                    tbl_gen_documento_tipo.descripcion AS 'DOCUMENTO',
                    tbl_gen_persona.documento AS NUM_DOC,
                       CASE WHEN tbl_gen_persona.sexo = 1 THEN 'HOMBRE' WHEN tbl_gen_persona.sexo = 2 THEN 'MUJER' END AS 'SEXO',
                    date(tbl_gen_persona.fecha_nacimiento) AS 'FECHA_NAC',
                    CONCAT(TIMESTAMPDIFF(YEAR,tbl_gen_persona.fecha_nacimiento,CURDATE()),' años') AS 'EDAD',
                    CONCAT_WS(',',tbl_gen_persona.telefono_fijo,tbl_gen_persona.telefono_movil) AS 'TELEFONO',
                    tbl_gen_persona.correo_electronico AS 'CORREO_ELECTRONICO',
                    COALESCE(paises.nombre_pais, '') AS 'PAIS',
                    COALESCE(departamentos.nombre_departamento, '') AS 'DEPARTAMENTO',
                    COALESCE(municipios.nombre_municipio, '') AS 'MUNICIPIO',
                    COALESCE(tbl_gen_persona.residencia_direccion, '') AS 'DIRECCION',
                    COALESCE(tbl_gen_persona.residencia_estrato, '') AS 'ESTRATO',
                    COALESCE(barrios.nombre_barrio, '') AS 'BARRIO', 
                    COALESCE(comunas.nombre_comuna, '') AS 'COMUNA_RESIDENCIA',
                    COALESCE(tbl_gen_corregimientos.descripcion, '') AS 'CORREGIMIENTO',
                    COALESCE(tbl_gen_veredas.nombre, '') AS 'VEREDA',
                    COALESCE(tbl_gen_ocupacion.descripcion, '') AS 'OCUPACION',
                    COALESCE(tbl_gen_escolaridad_nivel.descripcion, '') AS 'ESCOLARIDAD',
                    COALESCE(tbl_gen_escolaridad_estado.descripcion, '') AS 'ESTADO_ESCOLARIDAD',
                    COALESCE(tbl_dv_ficha.se_reconoce_como_cual, '') AS 'AUTORECONOCE',
                    CASE WHEN tbl_dv_ficha.tiene_discapacidad = 1 THEN 'SI' WHEN tbl_dv_ficha.tiene_discapacidad = 2 THEN 'NO' ELSE '' END AS 'DISCAPACIDAD',
                    COALESCE((SELECT GROUP_CONCAT(DISTINCT d.descripcion SEPARATOR ', ')
                    FROM tbl_dv_persona_x_discapacidad ds
                    INNER JOIN tbl_gen_discapacidad d ON d.id = ds.id_discapacidad
                    WHERE ds.id_persona = tbl_gen_persona.id
                    GROUP BY ds.id_persona), '') AS 'TIPO_DISCAPACIDAD',
                    -- Grupo Poblacional
                    IFNULL((SELECT 'SI'
                    FROM tbl_gen_persona_x_grupo_poblacional pg
                    WHERE pg.id_grupo_poblacional = 1 AND pg.id_persona = tbl_gen_persona.id LIMIT 1), 'NO') AS 'INDIGENA',
                    IFNULL((SELECT 'SI'
                    FROM tbl_gen_persona_x_grupo_poblacional pg
                    WHERE pg.id_grupo_poblacional = 2 AND pg.id_persona = tbl_gen_persona.id LIMIT 1), 'NO') AS 'AFRODESCENDIENTE',
                    IFNULL((SELECT 'SI'
                    FROM tbl_gen_persona_x_grupo_poblacional pg
                    WHERE pg.id_grupo_poblacional = 3 AND pg.id_persona = tbl_gen_persona.id LIMIT 1), 'NO') AS 'VICTIMA_DEL_CONFLICTO',
                    IFNULL((SELECT 'SI'
                    FROM tbl_gen_persona_x_grupo_poblacional pg
                    WHERE pg.id_grupo_poblacional = 4 AND pg.id_persona = tbl_gen_persona.id LIMIT 1), 'NO') AS 'ADULTO_MAYOR',
                    IFNULL((SELECT 'SI'
                    FROM tbl_gen_persona_x_grupo_poblacional pg
                    WHERE pg.id_grupo_poblacional = 5 AND pg.id_persona = tbl_gen_persona.id LIMIT 1), 'NO') AS 'LGBTI',
                    IFNULL((SELECT 'SI'
                    FROM tbl_gen_persona_x_grupo_poblacional pg
                    WHERE pg.id_grupo_poblacional = 6 AND pg.id_persona = tbl_gen_persona.id LIMIT 1), 'NO') AS 'GRUPO_MUJERES',
                    IFNULL((SELECT 'SI'
                    FROM tbl_gen_persona_x_grupo_poblacional pg
                    WHERE pg.id_grupo_poblacional = 7 AND pg.id_persona = tbl_gen_persona.id LIMIT 1), 'NO') AS 'GRUPO_JOVENES',
                    IFNULL((SELECT 'SI'
                    FROM tbl_gen_persona_x_grupo_poblacional pg
                    WHERE pg.id_grupo_poblacional = 8 AND pg.id_persona = tbl_gen_persona.id LIMIT 1), 'NO') AS 'JAC',
                    IFNULL((SELECT 'SI'
                    FROM tbl_gen_persona_x_grupo_poblacional pg
                    WHERE pg.id_grupo_poblacional = 9 AND pg.id_persona = tbl_gen_persona.id LIMIT 1), 'NO') AS 'JAL',
                    tbl_dv_ficha.grupo_poblacional_otro AS 'OTRO_CUAL',
                    
                    -- Datos del Acudiente
                    tbl_gen_persona_acudiente.nombre_primero AS 'PRIMER_NOMBRE_ACUDIENTE',
                    tbl_gen_persona_acudiente.nombre_segundo AS 'SEGUNDO_NOMBRE_ACUDIENTE',
                    tbl_gen_persona_acudiente.apellido_primero AS 'PRIMER_APELLIDO_ACUDIENTE',
                    tbl_gen_persona_acudiente.apellido_segundo AS 'SEGUNDO_APELLIDO_ACUDIENTE',
                    tbl_gen_tipo_doc_acudiente.descripcion AS 'DOCUMENTO_ACUDIENTE',
                    tbl_gen_persona_acudiente.documento AS 'NUM_DOC_ACUDIENTE', 
                    CASE WHEN tbl_gen_persona_acudiente.sexo = 1 THEN 'HOMBRE' WHEN tbl_gen_persona_acudiente.sexo = 2 THEN 'MUJER'
                    ELSE 
                    tbl_gen_persona_acudiente.sexo
                     END AS 'SEXO_ACUDIENTE', 
                    date(tbl_gen_persona_acudiente.fecha_nacimiento) AS 'FECHA_NAC_ACUDIENTE',
                    CONCAT(TIMESTAMPDIFF(YEAR,tbl_gen_persona_acudiente.fecha_nacimiento,CURDATE()), ' años') AS 'EDAD_ACUDIENTE',
                    CONCAT_WS(',',tbl_gen_persona_acudiente.telefono_fijo,tbl_gen_persona_acudiente.telefono_movil) AS 'TELEFONO_ACUDIENTE',
                    tbl_gen_persona_acudiente.correo_electronico AS 'CORREO_ACUDIENTE',
                    tbl_gen_parentesco.descripcion AS 'PARENTESCO',
                    tbl_dv_ficha.persona_acudiente_parentesco_otro AS 'PARENTESCO_OTRO'
        
                FROM
                    tbl_dv_ficha
                LEFT OUTER JOIN tbl_gen_persona ON (
                    tbl_dv_ficha.id_persona_beneficiario = tbl_gen_persona.id
                )

                LEFT OUTER JOIN tbl_motivos_desvinculaciones ON (
                    tbl_dv_ficha.id_motivo = tbl_motivos_desvinculaciones.id
                )

                LEFT OUTER JOIN tbl_dv_grupos ON (
                    tbl_dv_ficha.id_grupo = tbl_dv_grupos.id
                )
                LEFT OUTER JOIN tbl_dv_disciplinas ON (
                    tbl_dv_grupos.id_disciplina = tbl_dv_disciplinas.id
                )
                LEFT OUTER JOIN tbl_dv_escenarios ON (
                    tbl_dv_grupos.id_escenario = tbl_dv_escenarios.id
                )
                LEFT OUTER JOIN barrios tbl_barrio_escenario ON (
                    tbl_dv_escenarios.id_barrio = tbl_barrio_escenario.id
                )
                LEFT OUTER JOIN comunas tbl_comuna_escenario ON (
                    tbl_barrio_escenario.comuna_id = tbl_comuna_escenario.id
                )
                LEFT OUTER JOIN comunas comuna_impacto ON (
                    tbl_dv_grupos.id_comuna_impacto = comuna_impacto.id
                )
                LEFT OUTER JOIN tbl_dv_empleado ON (
                    tbl_dv_grupos.id_monitor = tbl_dv_empleado.id_usuario
                )
                LEFT OUTER JOIN tbl_gen_persona tbl_dv_monitor ON (
                    tbl_dv_empleado.id_persona = tbl_dv_monitor.id
                )
                LEFT OUTER JOIN tbl_gen_documento_tipo ON (
                    tbl_gen_persona.id_documento_tipo = tbl_gen_documento_tipo.id
                )
                LEFT OUTER JOIN paises ON (
                    tbl_gen_persona.id_procedencia_pais = paises.id
                )
                LEFT OUTER JOIN departamentos ON (
                    tbl_gen_persona.id_procedencia_departamento = departamentos.id
                )
                LEFT OUTER JOIN municipios ON (
                    tbl_gen_persona.id_procedencia_municipio = municipios.id
                )
                LEFT OUTER JOIN barrios ON (
                    tbl_gen_persona.id_residencia_barrio = barrios.id
                )
                LEFT OUTER JOIN comunas ON (
                    barrios.comuna_id = comunas.id
                )
                LEFT OUTER JOIN tbl_gen_corregimientos ON (
                    tbl_gen_persona.id_residencia_corregimiento = tbl_gen_corregimientos.id
                )
                LEFT OUTER JOIN tbl_gen_veredas ON (
                    tbl_gen_persona.id_residencia_vereda = tbl_gen_veredas.id
                )
                LEFT OUTER JOIN tbl_gen_ocupacion ON (
                    tbl_dv_ficha.id_ocupacion = tbl_gen_ocupacion.id
                )
                LEFT OUTER JOIN tbl_gen_escolaridad_nivel ON (
                    tbl_dv_ficha.id_escolaridad_nivel = tbl_gen_escolaridad_nivel.id
                )
                LEFT OUTER JOIN tbl_gen_escolaridad_estado ON (
                    tbl_dv_ficha.id_escolaridad_estado = tbl_gen_escolaridad_estado.id
                )
                LEFT OUTER JOIN tbl_gen_persona tbl_gen_persona_acudiente ON (
                    tbl_dv_ficha.id_persona_acudiente = tbl_gen_persona_acudiente.id
                )
                LEFT OUTER JOIN tbl_gen_documento_tipo tbl_gen_tipo_doc_acudiente ON (
                    tbl_gen_persona.id_documento_tipo = tbl_gen_tipo_doc_acudiente.id
                )
                LEFT OUTER JOIN tbl_gen_parentesco ON (
                    tbl_gen_parentesco.id_persona_parentesco = tbl_dv_ficha.id_persona_acudiente_parentesco
                )
                LEFT OUTER JOIN `tbl_dv_niveles` ON (`tbl_dv_grupos`.`id_nivel` = `tbl_dv_niveles`.`id`)
                WHERE
                    `tbl_dv_ficha`.`fecha_registro` BETWEEN ? AND ?
                    {$where}
                GROUP BY
                    `tbl_dv_ficha`.`id`
                ORDER BY 
                `tbl_dv_ficha`.`vinculado`,
                `tbl_dv_ficha`.`fecha_registro`,
                `tbl_dv_ficha`.`fecha_retiro`,
                `tbl_dv_disciplinas`.`descripcion`,
                `tbl_gen_persona`.`nombre_primero`,
                `tbl_gen_persona`.`nombre_segundo`,
                `tbl_gen_persona`.`apellido_primero`,
                `tbl_gen_persona`.`apellido_segundo`
            ) AS fichas
            
        ";
        $dataResource = DB::select($sql,[$fecha_inicial,$fecha_final,$fecha_final]);
        return $dataResource;
    }

    public function consultaTabla(Request $request) 
    {
        set_time_limit(0);
        $consulta = $this->dataReporte($request->fecha_inicial, $request->fecha_final, $request->disciplina, $request->comuna_impacto, $request->monitor, $request->sexo,$request
        ->estado);
		
		if($request->input("_token") == null){
			return response()->json($consulta);
		}
		
		$res=[];
        foreach($consulta as $temp)
        {
            $res[]=[
				'FICHA_NO'=>$temp->FICHA_NO,
				'VINCULADO_ACTUALMENTE'=>$temp->VINCULADO_ACTUALMENTE,
				'FICHA_ID'=>$temp->FICHA_ID,
				'FECHA_REGISTRO'=>$temp->FECHA_REGISTRO,
				'FECHA_RETIRO'=>$temp->FECHA_RETIRO,
				'MOTIVO_DESVINCULACION'=>"",
				'PROGRAMA'=>$temp->PROGRAMA,
				'MODALIDAD'=>$temp->MODALIDAD,
				'PUNTO_DE_ATENCION'=>$temp->PUNTO_DE_ATENCION,
				'BARRIO_PUNTO_DE_ATENCION'=>$temp->BARRIO_PUNTO_DE_ATENCION,
				'COMUNA_PUNTO_DE_ATENCION'=>$temp->COMUNA_PUNTO_DE_ATENCION,
				'COMUNA_DE_IMPACTO'=>$temp->COMUNA_DE_IMPACTO,
				'ID_MONITOR'=>$temp->ID_MONITOR,
				'MONITOR'=>$temp->MONITOR,
				'ASISTENCIAS_BENEFICIARIO'=>$temp->ASISTENCIAS_BENEFICIARIO,
				'CODIGO_GRUPO'=>$temp->CODIGO_GRUPO,
				'NIVEL_GRUPO'=>$temp->NIVEL_GRUPO,
				'GRUPO_ACTIVO'=>$temp->GRUPO_ACTIVO,
				'ID_BENEFICIARIO'=>$temp->ID_BENEFICIARIO,
				'PRIMER_NOMBRE'=>$temp->PRIMER_NOMBRE,
				'SEGUNDO_NOMBRE'=>$temp->SEGUNDO_NOMBRE,
				'PRIMER_APELLIDO'=>$temp->PRIMER_APELLIDO,
				'SEGUNDO_APELLIDO'=>$temp->SEGUNDO_APELLIDO,
				'DOCUMENTO'=>$temp->DOCUMENTO,
				'NUM_DOC'=>$temp->NUM_DOC,
				'SEXO'=>$temp->SEXO,
				'FECHA_NAC'=>$temp->FECHA_NAC,
				'EDAD'=>$temp->EDAD,
				//TELEFONO: "TELEFONO",
				//CORREO_ELECTRONICO: "CORREO_ELECTRONICO",
				'PAIS'=>$temp->PAIS,
				'DEPARTAMENTO'=>$temp->DEPARTAMENTO,
				'MUNICIPIO'=>$temp->MUNICIPIO,
				//DIRECCION: "DIRECCION",
				'ESTRATO'=> $temp->ESTRATO,
				'BARRIO'=> $temp->BARRIO,
				'COMUNA_RESIDENCIA'=> $temp->COMUNA_RESIDENCIA,
				'CORREGIMIENTO'=> $temp->CORREGIMIENTO,
				'VEREDA'=> $temp->VEREDA,
				'OCUPACION'=>$temp->OCUPACION,
				'ESCOLARIDAD'=>$temp->ESCOLARIDAD,
				'ESTADO_ESCOLARIDAD'=>$temp->ESTADO_ESCOLARIDAD,
				'AUTORECONOCE'=>$temp->AUTORECONOCE,
				'DISCAPACIDAD'=>$temp->DISCAPACIDAD,
				'TIPO_DISCAPACIDAD'=>$temp->TIPO_DISCAPACIDAD,
				'INDIGENA'=>$temp->INDIGENA,
				'AFRODESCENDIENTE'=>$temp->AFRODESCENDIENTE,
				'VICTIMA_DEL_CONFLICTO'=>$temp->VICTIMA_DEL_CONFLICTO,
				'ADULTO_MAYOR'=>$temp->ADULTO_MAYOR,
				'LGBTI'=>$temp->LGBTI,
				'GRUPO_MUJERES'=>$temp->GRUPO_MUJERES,
				'GRUPO_JOVENES'=>$temp->GRUPO_JOVENES,
				'JAC'=>$temp->JAC,
				'JAL'=>$temp->JAL,
				'OTRO_CUAL'=>$temp->OTRO_CUAL,
				'PRIMER_NOMBRE_ACUDIENTE'=>$temp->PRIMER_NOMBRE_ACUDIENTE,
				'SEGUNDO_NOMBRE_ACUDIENTE'=>$temp->SEGUNDO_NOMBRE_ACUDIENTE,
				'PRIMER_APELLIDO_ACUDIENTE'=>$temp->PRIMER_APELLIDO_ACUDIENTE,
				'SEGUNDO_APELLIDO_ACUDIENTE'=>$temp->SEGUNDO_APELLIDO_ACUDIENTE,
				'DOCUMENTO_ACUDIENTE'=>$temp->DOCUMENTO_ACUDIENTE,
				'NUM_DOC_ACUDIENTE'=>$temp->NUM_DOC_ACUDIENTE,
				'SEXO_ACUDIENTE'=>$temp->SEXO_ACUDIENTE,
				'FECHA_NAC_ACUDIENTE'=>$temp->FECHA_NAC_ACUDIENTE,
				'EDAD_ACUDIENTE'=>$temp->EDAD_ACUDIENTE,
				//TELEFONO_ACUDIENTE: "TELEFONO_ACUDIENTE",
				//CORREO_ACUDIENTE: "CORREO_ACUDIENTE",
				'PARENTESCO'=>$temp->PARENTESCO,
				'PARENTESCO_OTRO'=>$temp->PARENTESCO_OTRO];
			
        } // END FOREACH

        return response()->json($res);
    }

    public function exportExcel(Request $request)
    {
        set_time_limit(0);
        ini_set('memory_limit', '-1');

        $consulta = $this->dataReporte($request->fecha_inicial, $request->fecha_final, $request->disciplina, $request->comuna_impacto, $request->monitor, $request->sexo);

        $fichaCaracterizacion = json_decode(json_encode($consulta), true);
        Excel::create('fichaCaracterizacion', function($excel) use($fichaCaracterizacion)
        {
            $excel->sheet('ExportFile', function($sheet) use($fichaCaracterizacion)
            {
                $sheet->fromArray($fichaCaracterizacion);
            });
        })->export('xls');
    }
    public function exportExcel_corta(Request $request)
    {
        set_time_limit(0);
        ini_set('memory_limit', '-1');

        $consulta = $this->dataReporte($request->fecha_inicial, $request->fecha_final, $request->disciplina, $request->comuna_impacto, $request->monitor, $request->sexo,'1');
        $res=[];
        foreach($consulta as $temp)
        {
            $res[]=[
                'FICHA_NO'=>$temp->FICHA_NO,
                'FICHA_ID'=>$temp->FICHA_ID,
                'FECHA_REGISTRO'=>$temp->FECHA_REGISTRO,
                'FECHA_RETIRO'=>$temp->FECHA_RETIRO,
                'PROGRAMA'=>$temp->PROGRAMA,
                'MODALIDAD'=>$temp->MODALIDAD,
                'PUNTO_DE_ATENCION'=>$temp->PUNTO_DE_ATENCION,
                'BARRIO_PUNTO_DE_ATENCION'=>$temp->BARRIO_PUNTO_DE_ATENCION,
                'COMUNA_PUNTO_DE_ATENCION'=>$temp->COMUNA_PUNTO_DE_ATENCION,
                'COMUNA_DE_IMPACTO'=>$temp->COMUNA_DE_IMPACTO,
                'ID_MONITOR'=>$temp->ID_MONITOR,
                'MONITOR'=>$temp->MONITOR,
                'ASISTENCIAS_BENEFICIARIO'=>$temp->ASISTENCIAS_BENEFICIARIO,
                'CODIGO_GRUPO'=>$temp->CODIGO_GRUPO,
                'NIVEL_GRUPO'=>$temp->NIVEL_GRUPO,
                'GRUPO_ACTIVO'=>$temp->GRUPO_ACTIVO,
                'ID_BENEFICIARIO'=>$temp->ID_BENEFICIARIO,
                'PRIMER_NOMBRE'=>$temp->PRIMER_NOMBRE,
                'SEGUNDO_NOMBRE'=>$temp->SEGUNDO_NOMBRE,
                'PRIMER_APELLIDO'=>$temp->PRIMER_APELLIDO,
                'SEGUNDO_APELLIDO'=>$temp->SEGUNDO_APELLIDO,
                'DOCUMENTO'=>$temp->DOCUMENTO,
                'NUM_DOC'=>$temp->NUM_DOC,
                'SEXO'=>$temp->SEXO,
                'FECHA_NAC'=>$temp->FECHA_NAC,
                'EDAD'=>$temp->EDAD];
        }
        $fichaCaracterizacion = json_decode(json_encode($res), true);
        Excel::create('fichaCaracterizacion', function($excel) use($fichaCaracterizacion)
        {
            $excel->sheet('ExportFile', function($sheet) use($fichaCaracterizacion)
            {
                $sheet->fromArray($fichaCaracterizacion);
            });
        })->export('xls');
    }

    public function getDataSelect($modelo, Request $request)
	{
        $model = "\\App\\Models\\".$modelo;
        
        $metodos_clase = get_class_methods($model);
        
        $relaciones = array_filter($metodos_clase,function($metodo) {
            return preg_match("/^fk_/", $metodo);
        });
        
        $model = $model::with($relaciones);

        if($request->all()) {
            $where = array();
            $orderBy = array();
            foreach ($request->all() as $wKey => $wValue) {
                if ($wKey == '_ORDERBY') {
                    $model = $model->orderBy($wValue);
                }
                else {
                    array_push($where, [$wKey, $wValue]);
                }
            }
            $model = $model->where($where);
        }
        
        $dataModel = $model->get();

        return response()->json(
            $dataModel->toArray()
        );

    }
    


}
