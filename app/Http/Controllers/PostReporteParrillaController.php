<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Auth;
use App\RoleUser;
use App\Grupo;
use App\Http\Requests;
use response;
use Excel;

class PostReporteParrillaController extends Controller
{

    public function __construct()
	{
        //$this->middleware('permission:ver-roles', ['only' => 'vista']);
	}

    public function vista()
    {
        return view("postreporteparrilla.appreporteparrilla");
    }

    private function dataReporte()
    {
        $sql="SELECT
            CONCAT_WS(' ',m.nombre_primero,m.nombre_segundo,m.apellido_primero,m.apellido_segundo) AS 'Monitor',
            g.codigo_grupo AS 'Grupo',
            n.descripcion AS 'Nivel',
            CASE WHEN g.activo = 1 THEN 'SI' WHEN g.activo = 0 THEN 'NO' END AS 'Grupo_Activo',
            ci.nombre_comuna AS 'Comuna_de_Impacto',
            c.nombre_comuna AS 'Comuna_Escenario',
            b.nombre_barrio AS 'Barrio_Escenario',
            e.nombre_escenario AS 'Nombre_Escenario',
            e.direccion AS 'Direccion',
            e.direccion_complemento AS 'Direccion_Complemento',
            e.descripcion AS 'descripcion_escenario',
            d.descripcion AS 'Disciplina_Actividad',
            GROUP_CONCAT(h.dia SEPARATOR ' - ') AS Dias,
            CONCAT_WS(' - ',h.hora_inicio,h.hora_fin) AS Horarios,
            COALESCE(`cor `.`descripcion`,'-') AS corregimiento,
            COALESCE(`ver`.`nombre`,'-')  AS vereda,
            pre.`descripcion` as `presupuesto`,
            g.`observaciones` as `grupo_observaciones`
        FROM
            tbl_dv_grupos g

            INNER JOIN tbl_dv_empleado em ON g.id_monitor = em.id_usuario
            INNER JOIN tbl_gen_persona m ON em.id_persona = m.id
            INNER JOIN tbl_dv_escenarios e ON g.id_escenario = e.id
            LEFT JOIN barrios b ON e.id_barrio = b.id
            LEFT JOIN tbl_dv_niveles n ON g.id_nivel = n.id
            LEFT JOIN comunas c ON b.comuna_id = c.id
            LEFT JOIN comunas ci ON g.id_comuna_impacto = ci.id
            INNER JOIN tbl_dv_disciplinas d ON g.id_disciplina = d.id
            INNER JOIN tbl_dv_grupos_horario h ON h.id_grupo = g.id
            LEFT OUTER JOIN `tbl_gen_corregimientos` `cor ` ON (`e`.`id_corregimiento` = `cor `.`id`)
            LEFT OUTER JOIN `tbl_gen_veredas` `ver` ON (`e`.`id_vereda` = `ver`.`id`)
            LEFT OUTER JOIN `tbl_dv_presupuesto` `pre` ON (`em`.`id_presupuesto` = `pre`.`id`)       
            WHERE
                  `g`.`activo`=1


        GROUP BY
            g.id, Horarios
        ORDER BY 
            ci.codigo_comuna, d.id
        ";
        $dataResource = DB::select($sql);

        return $dataResource;
    }
    private function dataReporteBasica()
    {
        $sql="SELECT
            CONCAT_WS(' ',m.nombre_primero,m.nombre_segundo,m.apellido_primero,m.apellido_segundo) AS 'Monitor',
            g.codigo_grupo AS 'Grupo',
            CASE WHEN g.activo = 1 THEN 'SI' WHEN g.activo = 0 THEN 'NO' END AS 'Grupo_Activo',
            ci.nombre_comuna AS 'Comuna_de_Impacto',
            c.nombre_comuna AS 'Comuna_Escenario',
            b.nombre_barrio AS 'Barrio_Escenario',
            CONCAT_WS(' ',e.nombre_escenario,e.direccion,e.direccion_complemento) AS 'Escenario_Direccion',
            d.descripcion AS 'Disciplina_Actividad',
            GROUP_CONCAT(h.dia SEPARATOR ' - ') AS Dias,
            CONCAT_WS(' - ',h.hora_inicio,h.hora_fin) AS Horarios,
            COALESCE(`cor `.`descripcion`,'-') AS corregimiento,
            COALESCE(`ver`.`nombre`,'-')  AS vereda,
            pre.`descripcion` as `presupuesto`,
            g.`observaciones` as `grupo_observaciones`
        FROM
            tbl_dv_grupos g
            INNER JOIN tbl_dv_empleado em ON g.id_monitor = em.id_usuario
            INNER JOIN tbl_gen_persona m ON em.id_persona = m.id
            INNER JOIN tbl_dv_escenarios e ON g.id_escenario = e.id
            LEFT JOIN barrios b ON e.id_barrio = b.id
            LEFT JOIN comunas c ON b.comuna_id = c.id
            LEFT JOIN comunas ci ON g.id_comuna_impacto = ci.id
            INNER JOIN tbl_dv_disciplinas d ON g.id_disciplina = d.id
            INNER JOIN tbl_dv_grupos_horario h ON h.id_grupo = g.id
            LEFT OUTER JOIN `tbl_gen_corregimientos` `cor ` ON (`e`.`id_corregimiento` = `cor `.`id`)
            LEFT OUTER JOIN `tbl_gen_veredas` `ver` ON (`e`.`id_vereda` = `ver`.`id`)
            LEFT OUTER JOIN `tbl_dv_presupuesto` `pre` ON (`em`.`id_presupuesto` = `pre`.`id`)
        GROUP BY
            g.id, Horarios
        ORDER BY 
            ci.codigo_comuna, d.id
        ";
        $dataResource = DB::select($sql);

        return $dataResource;
    }
    
    public function consultaTablaBasica(Request $request) 
    {
        set_time_limit(0);
        $consulta = $this->dataReporteBasica();
        return response()->json($consulta);
    }
    public function consultaTabla(Request $request) 
    {
        set_time_limit(0);
        $consulta = $this->dataReporte();
        return response()->json($consulta);
    }

    public function exportExcel(Request $request)
    {
        set_time_limit(0);
        ini_set('memory_limit', '-1');

        $consulta = $this->dataReporte();

        $parrillaActividades = json_decode(json_encode($consulta), true);
        Excel::create('parrillaActividades', function($excel) use($parrillaActividades)
        {
            $excel->sheet('ExportFile', function($sheet) use($parrillaActividades)
            {
                $sheet->fromArray($parrillaActividades);
            });
        })->export('xls');
    }
    


}
