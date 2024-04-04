<?php
namespace App\Http\Controllers;

use DB;
use response;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Grupo;
use App\MotivoDesvinculacion;
use App\HorarioGrupo;
use App\Programa;
use App\Pais;
use App\Departamento;
use App\Municipio;
use App\Barrio;
use App\Beneficiario;
use App\PoblacionalBeneficiario;
use App\RoleUser;
use App\User;
use App\Escenario;
use App\Niveles;
use App\Disciplinas;
use TblDvGrupoHorario;
use Hashids\Hashids;

class PostGruposController extends Controller
{

    public function __construct()
    {
        $this->hashids = new Hashids('', 10);
    }

    public function vista()
    {
        return view("postgrupos.appgrupos");
    }

    public function Obtenermonitores(Request $request)
    {
        $results = DB::select('SELECT *
        FROM
          `role_user`
          INNER JOIN `users` ON (`role_user`.`user_id` = `users`.`id`)
          INNER JOIN `roles` ON (`role_user`.`role_id` = `roles`.`id`)
        WHERE
          `roles`.`name` = ?', ['Monitor']);
        return (json_encode($results, 128));
    }

    private function tipe_role()
    {
        $rol    = RoleUser::where('user_id', '=', Auth::id())->firstOrfail();
        $string = '';
        if ($rol->role_id == 8)
        {
            $string = ' `tbl_dv_grupos`.`id_metodologo`=? ';
        } else
        {
            $string = ' `tbl_dv_grupos`.`id_monitor`=? ';
        }
        return $string;
    }

    public function index()
    {
        $sql    = "SELECT 
                `tbl_dv_grupos`.`codigo_grupo`,
                `tbl_dv_grupos`.`id`,
                `tbl_dv_escenarios`.`nombre_escenario` AS `escenario`,
                `tbl_dv_disciplinas`.`descripcion` AS `disciplina`,
                `tbl_dv_niveles`.`descripcion` AS `niveles`,
                UPPER(COALESCE(CONCAT_WS(' ', `tbl_gen_persona`.`nombre_primero`, `tbl_gen_persona`.`nombre_segundo`, `tbl_gen_persona`.`apellido_primero`, `tbl_gen_persona`.`apellido_segundo`), 'NN')) AS `monitor`,
                (SELECT 
                  GROUP_CONCAT(CONCAT(
                  `tbl_dv_grupos_horario`.`dia`,  
                  '[',
                  DATE_FORMAT(`tbl_dv_grupos_horario`.`hora_inicio`, '%h:%i %p'),' - ',
                  DATE_FORMAT(`tbl_dv_grupos_horario`.`hora_fin`, '%h:%i %p'),']'
                  )) 
              FROM
                `tbl_dv_grupos_horario`
              WHERE
                `tbl_dv_grupos_horario`.`id_grupo`=`tbl_dv_grupos`.`id`
                )as horario
              FROM
                `tbl_dv_grupos`
                LEFT OUTER JOIN `tbl_dv_escenarios` ON (`tbl_dv_grupos`.`id_escenario` = `tbl_dv_escenarios`.`id`)
                LEFT OUTER JOIN `tbl_dv_disciplinas` ON (`tbl_dv_grupos`.`id_disciplina` = `tbl_dv_disciplinas`.`id`)
                LEFT OUTER JOIN `tbl_dv_niveles` ON (`tbl_dv_grupos`.`id_nivel` = `tbl_dv_niveles`.`id`)
                LEFT OUTER JOIN `tbl_dv_empleado` ON (`tbl_dv_grupos`.`id_monitor` = `tbl_dv_empleado`.`id_usuario`)
                LEFT OUTER JOIN `tbl_gen_persona` ON (`tbl_dv_empleado`.`id_persona` = `tbl_gen_persona`.`id`)
            WHERE
            `tbl_dv_disciplinas`.`activo`=1 
            AND
                `tbl_dv_grupos`.`activo` =1 
                AND
              " . $this->tipe_role()."
              ORDER BY
              `tbl_dv_disciplinas`.`activo`,`tbl_dv_grupos`.`activo`" ;
        $grupos = DB::select($sql, array(Auth::id()));
        $Res    = response()->json($grupos);
        return $Res;
    }

    public function ObtenerCountGrupos()
    {
        $grupos       = Grupo::all();
        $count_grupos = count($grupos) + 1;
        return response()->json($count_grupos);
    }

    private function format_hour($hora)
    {
        return date('H:i:s', strtotime($hora));
    }

    private function DiaHoraRepetidos($hora_inicio, $hora_fin, $dia, $id_user_monitor)
    {
        $hora_fin    = date("H:i:s", strtotime($hora_fin));
        $hora_inicio = date("H:i:s", strtotime($hora_inicio));
        $sql         = 'SELECT 
            count(*) as total
          FROM
            `tbl_dv_grupos_horario`
            INNER JOIN `tbl_dv_grupos` ON (`tbl_dv_grupos_horario`.`id_grupo` = `tbl_dv_grupos`.`id`)
          WHERE
            `tbl_dv_grupos`.`id_monitor` = ?
            AND
            `tbl_dv_grupos`.`activo`=1
            AND
            (
              (
                TIME(?) 
                BETWEEN
                (TIME(`tbl_dv_grupos_horario`.`hora_inicio`) + INTERVAL 1 SECOND)
                  AND
                (TIME(`tbl_dv_grupos_horario`.`hora_fin`)- INTERVAL 1 SECOND)
              )
              OR
              (
                TIME(?) 
                BETWEEN
                (TIME(`tbl_dv_grupos_horario`.`hora_inicio`) + INTERVAL 1 SECOND)
                  AND
                (TIME(`tbl_dv_grupos_horario`.`hora_fin`)- INTERVAL 1 SECOND)
              )
              OR
              (
              (TIME(`tbl_dv_grupos_horario`.`hora_inicio`) + INTERVAL 1 SECOND)
              BETWEEN ? AND ?
              )
              OR
              (
              (TIME(`tbl_dv_grupos_horario`.`hora_fin`)- INTERVAL 1 SECOND)
              BETWEEN ? AND ?
              )
            )
            AND `tbl_dv_grupos_horario`.`dia`=?';
        $data        = DB::select($sql, [$id_user_monitor, $hora_inicio, $hora_fin, $hora_inicio, $hora_fin, $hora_inicio, $hora_fin, $dia]);
        return ($data[0]->total > 0);
    }

    private function repetido($data)
    {
        $return = false;
        foreach ($data['hora'] as $dia => $temp)
        {
            if (!is_null($temp['inicio']))
            {
                if ($this->DiaHoraRepetidos($temp['inicio'], $temp['fin'], $dia, $data['id_user']))
                {
                    $return = true;
                }
            }
        }
        return $return;
    }

    public function CrearGrupo(Request $request)
    {
        try
        {
            $data = $request->all();
            if (!$this->repetido($data))
            {
                if (isset($data["dia"]))
                {
                    $grupo                    = new Grupo();
                    $grupo->id_metodologo     = Auth::id();
                    $grupo->id_comuna_impacto = $request->input('id_comuna_impacto');
                    $grupo->id_escenario      = $request->input('id_escenario');
                    $grupo->id_monitor        = $request->input('id_user');
                    $grupo->id_disciplina     = $request->input('id_disciplina');
                    $grupo->id_nivel          = $request->input('id_nivel');
                    $grupo->observaciones     = $request->input('observaciones');
//$grupo->id_programa     = $request->input('id_programa');
                    $grupo->save();
                    $grupo->codigo_grupo      = str_pad($grupo->id, 5, "0", STR_PAD_LEFT);
                    $grupo->save();
                    foreach ($data["dia"] as $dia)
                    {
                        if (!is_null($data['hora'][$dia]['inicio']))
                        {
                            $horario_grupo                  = new HorarioGrupo();
                            $horario_grupo->id_grupo        = $grupo->id;
                            $horario_grupo->dia             = $dia;
                            $horario_grupo->hora_inicio     = $this->format_hour(trim($data['hora'][$dia]['inicio']));
                            $horario_grupo->hora_fin        = $this->format_hour(trim($data['hora'][$dia]['fin']));
                            $horario_grupo->id_equipamiento = $data['hora'][$dia]['equipamiento'];
                            $horario_grupo->save();
                        }
                    }
                    return response()->json(["mensaje" => "guardado", 'validate' => true]);
                } else
                {
                    return response()->json(["mensaje" => "No ha seleccionado hora", 'validate' => false]);
                }
            } else
            {
                return response()->json(["mensaje" => "El monitor ya tiene asignado un grupo en este horario", 'validate' => false]);
            }
        } catch (Exception $e)
        {
            return response()->json(["mensaje" => $e, 'validate' => false]);
        }
    }

    public function ObtenerGrupo($id)
    {
        $grupo = Grupo::where('tbl_dv_grupos.id', '=', $id)->where('tbl_dv_grupos.activo', '=', '1')->firstOrfail();
        return response()->json($grupo->toArray());
    }

    public function ObtenerSedeGrupoID($id)
    {

        $sedes = Grupo::select('sedes.id', 'sedes.nombre_sede', 'instituciones.nombre_institucion')->join(
                        'sedes', 'sedes.id', '=', 'grupos.sede_id')->join('instituciones', 'instituciones.id', '=', 'sedes.institucion_id')->where('grupos.id', '=', $id)->firstOrfail();
        return response()->json(
                        $sedes->toArray()
        );
    }

    public function ObtenerGrupoHorarioID($id)
    {

        $horario = HorarioGrupo::select('horario_grupos.id', 'horario_grupos.dia', 'horario_grupos.hora_inicio', 'horario_grupos.hora_fin')->join(
                        'grupos', 'grupos.id', '=', 'horario_grupos.grupo_id')->where('horario_grupos.grupo_id', '=', $id)->get();
        return response()->json(
                        $horario->toArray()
        );
    }

    public function ObtenerProgramas()
    {

        $programas = Programa::all();
        return response()->json(
                        $programas
        );
    }

    public function ObtenerPaises()
    {

        $paises = Pais::all();
        return response()->json($paises);
    }

    public function ObtenerDepartamentos($id)
    {

        $departamentos = Departamento::select('departamentos.id', 'departamentos.nombre_departamento')->
                join('paises', 'paises.id', '=', 'departamentos.pais_id')->
                where('paises.id', '=', $id)->get();
        return response()->json($departamentos);
    }

    public function ObtenerMunicipios($id)
    {

        $municipios = Municipio::select('municipios.id', 'municipios.nombre_municipio')->join(
                        'departamentos', 'departamentos.id', '=', 'municipios.departamento_id')->where('departamentos.id', '=', $id)->get();
        return response()->json($municipios);
    }

    public function ObtenerBarrios($id)
    {

        $barrios = Barrio::select('barrios.id', 'barrios.nombre_barrio')->join(
                        'comunas', 'comunas.id', '=', 'barrios.comuna_id')->where('comunas.id', '=', $id)->get();
        return response()->json(
                        $barrios
        );
    }

    public function ObtenerMisBeneficiarios($id)
    {
        $sql = 'SELECT 
                `tbl_dv_grupos`.`id` AS `grupo`,
                `tbl_dv_grupos`.`id_monitor`,
                `tbl_dv_grupos`.`codigo_grupo`,
                `tbl_dv_grupos`.`observaciones`,
                concat_ws(" ",
                `tbl_gen_persona`.`nombre_primero`,
                `tbl_gen_persona`.`nombre_segundo`) as nombres_beneficiario,
                CONCAT_WS(" ",
                `tbl_gen_persona`.`apellido_primero`,
                `tbl_gen_persona`.`apellido_segundo`) as apellidos_beneficiario,
                `tbl_gen_persona`.`residencia_direccion`,
                TIMESTAMPDIFF(YEAR,`tbl_gen_persona`.`fecha_nacimiento`, now()) as edad,
                CONCAT_WS(\' \',
                `tbl_acudiente`.`nombre_primero`,
                `tbl_acudiente`.`nombre_segundo`,
                `tbl_acudiente`.`apellido_primero`,
                `tbl_acudiente`.`apellido_segundo`) as acudiente,
                CONCAT_WS(\',\',
                `tbl_acudiente`.`telefono_fijo`,
                `tbl_acudiente`.`telefono_movil`) as telefono,
                `tbl_gen_persona`.`id`,
                `tbl_dv_ficha`.`fecha_registro` as fecha_inscripcion,
                `tbl_dv_ficha`.`id` as id_ficha,
                `tbl_gen_persona`.`documento`,
                COALESCE(`tbl_gen_eps`.`descripcion`,"NN") as eps
              FROM
                `tbl_dv_ficha`
                INNER JOIN `tbl_gen_persona` ON (`tbl_dv_ficha`.`id_persona_beneficiario` = `tbl_gen_persona`.`id`)
                INNER JOIN `tbl_dv_grupos` ON (`tbl_dv_ficha`.`id_grupo` = `tbl_dv_grupos`.`id`)
                LEFT OUTER JOIN `tbl_gen_eps` ON (`tbl_dv_ficha`.`id_eps` = `tbl_gen_eps`.`id`)
                INNER JOIN `tbl_gen_persona` `tbl_acudiente` ON (`tbl_dv_ficha`.`id_persona_acudiente` = `tbl_acudiente`.`id`)
              WHERE
                `tbl_dv_grupos`.`id` = ?
                AND
                `tbl_dv_ficha`.`vinculado`=1';
        $Res = DB::select($sql, [$id]);
        return response()->json($Res);
    }

    public function ObtenerAllGrupos()
    {
        $grupos_monitor = Grupo::select('id', 'codigo_grupo')->where('id_monitor', '=', Auth::id())->get();
        return response()->json($grupos_monitor->toArray());
    }

    public function motivos()
    {
        $motivos = MotivoDesvinculacion::select('id', 'nombre')->get();
        return response()->json($motivos->toArray());
    }

    public function EliminarGrupo($id)
    {

        $horario_grupo = HorarioGrupo::where('horario_grupos.grupo_id', '=', $id)->get();

        foreach ($horario_grupo as $value)
        {
            $value->delete();
        }
        $grupo = Grupo::findOrfail($id);
        $grupo->delete();
        return response()->json($grupo->toArray());
    }

    public function editsave(Request $request)
    {



        try
        {
            $data = $request->all();
            if (isset($data["dia"]))
            {
                try
                {
                    $grupo = Grupo::where
                    (
                        'id', 
                        '=', 
                        $request->input('id_grupo')
                    )->firstOrFail();
					$grupo->id_comuna_impacto  = $request->input('id_comuna_impacto');
                    $grupo->id_escenario  = $request->input('id_escenario');
                    $grupo->id_monitor    = $request->input('id_user');
                    $grupo->id_disciplina = $request->input('id_disciplina');
                    $grupo->id_nivel      = $request->input('id_nivel');
                    $grupo->observaciones = $request->input('observaciones');
                    $grupo->save();
                    // DB::select("DELETE FROM `tbl_dv_grupos_horario` WHERE `tbl_dv_grupos_horario`.`id_grupo` = ?", [$grupo->id]);

                    
                    $EliminarGrupoHorario = HorarioGrupo::where('id_grupo', '=', $grupo->id)->delete();

                    foreach ($data["dia"] as $dia)
                    {



                        $horario_grupo = new HorarioGrupo();
                        $horario_grupo->dia             = $dia;
                        $horario_grupo->id_grupo        = $grupo->id;
                        $horario_grupo->hora_inicio     = $this->format_hour(trim($data['hora'][$dia]['inicio']));
                        $horario_grupo->hora_fin        = $this->format_hour(trim($data['hora'][$dia]['fin']));
                        $horario_grupo->id_equipamiento = $data['hora'][$dia]["equipamiento"];

                        $horario_grupo->save();
                    }
                    return response()->json(["mensaje" => "guardado", 'validate' => true,'error'=>null]);
                }
                catch(Illuminate\Database\QueryException $e)
                {
                    return response()->json(["mensaje" => "Error desconocido", 'validate' => false,'error'=>$e->getMessage()]);   
                }
            } else
            {
                return response()->json(["mensaje" => "No ha seleccionado hora", 'validate' => false,'error'=>null]);
            }
        } catch (Exception $e)
        {
            return response()->json(["mensaje" => $e, 'validate' => false]);
        }
    }
    public function view_grupos($id)
    {
        $grupo = \App\Models\TblDvGrupos::where('id', '=', $id)->where('activo', '=', 1)->get();
        return json_encode(['grupos'=>$grupo[0], 'dias'=>\App\Models\TblDvGrupoHorario::where('tbl_dv_grupos_horario.id_grupo', '=', $id)->get()]);
    }
    public function editarView($id)
    {
        $grupo = \App\Models\TblDvGrupos::where('id', '=', $id)->where('activo', '=', 1)->get();
        return view('grupos.edit')->with([
                    'monitores_mios'       => $this->monitores_mios(),
                    'monitores_no_mios'    => $this->monitores_no_mios(),
                    'comunas_impacto_mios' => $this->comunas_impacto_mios(),
                    'escenarios'           => Escenario::where('activo','=','1')->orderBy('nombre_escenario')->get(),
                    'niveles'              => Niveles::all(),
                    'disciplinas'          => Disciplinas::where('activo','=','1')->orderBy('descripcion')->get(),
                    'id'                   => $id 
        ]);
    }

    public function Desactivar($id)
    {
        try
        {
            DB::table('tbl_dv_grupos')->where('id', $id)->update(['activo' => 0]);
            return json_encode(['validate' => true, 'msj' => NULL]);
        } catch (Exception $ex)
        {
            return json_encode(['validate' => false, 'msj' => $ex]);
        }
    }

    private function SaberSemanaActual()
    {
        $mes              = array(
            '01' => 'Enero',
            '02' => 'Febrero',
            '03' => 'Marzo',
            '04' => 'Abril',
            '05' => 'Mayo',
            '06' => 'Junio',
            '07' => 'Julio',
            '08' => 'Agosto',
            '09' => 'Septiembre',
            '10' => 'Octubre',
            '11' => 'Noviembre',
            '12' => 'Diciembre'
        );
        date_default_timezone_set('America/Bogota');
        $fecha            = date('Y-m-j');
        $dia              = date('N', strtotime($fecha));
        $dia              = ((8 - $dia) == 0) ? 8 : (8 - $dia);
        $nuevafechainicio = strtotime('+' . $dia . ' day', strtotime($fecha));
        $nuevafechainicio = date('Y-m-j', $nuevafechainicio);
        $nuevafechafin    = strtotime('+6 day', strtotime($nuevafechainicio));
        $nuevafechafin    = date('Y-m-j', $nuevafechafin);
        $fechassemanas=['inicio' => $nuevafechainicio, 'fin' => $nuevafechafin, 'mes' => $mes];
        return $fechassemanas;
    }

    public function DiasSemana(Request $request)
    {
        $dias = $this->SaberSemanaActual();
        $sql  = "SELECT 
                `tbl_dv_grupos_horario`.`dia`
              FROM
                `tbl_dv_grupos_horario`
              WHERE
                `tbl_dv_grupos_horario`.`id_grupo`=?
                AND
                `tbl_dv_grupos_horario`.`dia` NOT IN 
                (
                    SELECT
                        `fn_dia_fecha`(`tbl_dv_grupos_horario_planificacion`.`fecha`) 
                    FROM 
                        `tbl_dv_grupos_horario_planificacion` 
                    WHERE 
                        (`tbl_dv_grupos_horario_planificacion`.`fecha` BETWEEN ? AND ?) 
                    AND `tbl_dv_grupos_horario_planificacion`.`id_grupo`=? 
                    AND `tbl_dv_grupos_horario_planificacion`.`activo`=1
                )";
        $id   = $request->input('id_grupo');
        $data = DB::select($sql, [$id, $dias['inicio'], $dias['fin'], $id]);
        return (json_encode(array('validate' => true, 'data' => $data,$dias['inicio'], $dias['fin']), 128));
    }

    public function SemanaPlaneacion()
    {
        $dias             = $this->SaberSemanaActual();
        $mes              = $dias['mes'];
        $nuevafechafin    = $dias['inicio'];
        $nuevafechainicio = $dias['fin'];
        $texto='Semana del ' .
                date('j', strtotime($nuevafechafin)) . ' de ' .
                $mes[date('m', strtotime($nuevafechafin))] . ' del ' . date('Y', strtotime($nuevafechafin)) .
                ' al ' .
                date('j', strtotime($nuevafechainicio)) .
                ' ' . $mes[date('m', strtotime($nuevafechainicio))] .
                ' del ' . date('Y', strtotime($nuevafechafin));
        return json_encode(['validate'=>true,'data'=>$texto]);
    }
    private function FormatearHora($hora)
    {
        $hora=strtotime($hora);
        $hora=date('H:i:s',$hora);
        return $hora;
    }
    public function equipamientodeescenario(Request $request)
    {
        $hora_inicio = $this->FormatearHora($request->input('hora_inicio'));
        $hora_fin    = $this->FormatearHora($request->input('hora_fin'));
        $dia         = $request->input('dia');
        $sql = 'SELECT 
                    `tbl_dv_equipamento_tipo`.`id`,
                    `tbl_dv_equipamento_tipo`.`descripcion`,
                    `tbl_dv_escenario_x_equipamiento`.`cantidad`,
                    (SELECT 
                    count(*) AS `total`
                  FROM
                    `tbl_dv_grupos_horario`
                    INNER JOIN `tbl_dv_grupos` ON (`tbl_dv_grupos_horario`.`id_grupo` = `tbl_dv_grupos`.`id`)
                  WHERE
                    `tbl_dv_grupos`.`activo` = 1
                    AND
                      `tbl_dv_grupos_horario`.`dia`=?
                      AND
                      (
                      TIME(`tbl_dv_grupos_horario`.`hora_inicio`) >=TIME(?)
                      AND
                      TIME(`tbl_dv_grupos_horario`.`hora_fin`) <= TIME(?)
                      )
                    AND 

                    `tbl_dv_grupos_horario`.`id_equipamiento` = `tbl_dv_equipamento_tipo`.`id`) AS `uso`
                  FROM
                    `tbl_dv_escenario_x_equipamiento`
                    INNER JOIN `tbl_dv_equipamento_tipo` ON (`tbl_dv_escenario_x_equipamiento`.`id_equipamiento` = `tbl_dv_equipamento_tipo`.`id`)
                  WHERE
                    `tbl_dv_escenario_x_equipamiento`.`id_escenario` = ?';
        try
        {
            $data = DB::select($sql, array($dia,$hora_inicio,$hora_fin,$request->input('id')));

            $html = $this->renderEquipamiento($data);
            
            return json_encode(array('validate' => true, 'data' => $html, 'msj' => NULL));
        } catch (Exception $ex)
        {
            return json_encode(array('validate' => false, 'data' => NULL, 'msj' => $ex));
        }
    }

    private function renderEquipamiento($data)
    {
        $html = '';
        foreach ($data as $temp)
        {
            $html .= '<option value="' . $temp->id . '">' . $temp->cantidad . ' ' . $temp->descripcion . ' (' . $temp->uso . ' en uso)</option>' . "\n";
        }
        return $html;
    }

    private function monitores_mios()
    {
        $sql = "SELECT 
                `tbl_dv_empleado`.`id_usuario` as id,
                `comunas`.`nombre_comuna`,  
                CONCAT_WS(' - ',`comunas`.`nombre_comuna`,UPPER(CONCAT_WS(' ', `tbl_gen_persona`.`nombre_primero`, `tbl_gen_persona`.`nombre_segundo`, `tbl_gen_persona`.`apellido_primero`, `tbl_gen_persona`.`apellido_segundo`))) AS `nombre`
              FROM
                `role_user`
                INNER JOIN `roles` ON (`role_user`.`role_id` = `roles`.`id`)
                INNER JOIN `tbl_dv_empleado` ON (`role_user`.`user_id` = `tbl_dv_empleado`.`id_usuario`)
                INNER JOIN `tbl_dv_empleado_x_comuna` ON (`tbl_dv_empleado`.`id` = `tbl_dv_empleado_x_comuna`.`id_ficha_empleado`)
                INNER JOIN `tbl_gen_persona` ON (`tbl_dv_empleado`.`id_persona` = `tbl_gen_persona`.`id`)
                INNER JOIN `comunas` ON (`tbl_dv_empleado_x_comuna`.`id_comuna` = `comunas`.`id`)
                WHERE
                `roles`.`id` = 7 
                AND `tbl_dv_empleado_x_comuna`.`id_comuna` IN (SELECT `tbl_dv_empleado_x_comuna`.`id_comuna` FROM `tbl_dv_empleado` INNER JOIN `tbl_dv_empleado_x_comuna` ON (`tbl_dv_empleado`.`id` = `tbl_dv_empleado_x_comuna`.`id_ficha_empleado`) WHERE `tbl_dv_empleado`.`id_usuario` = ?)
              ORDER BY `comunas`.id, 3";
        if (!is_null(Auth::user()))
        {
            return DB::select($sql, [Auth::user()->id]);
        } else
        {
            return array();
        }
    }

    private function monitores_no_mios()
    {
        $sql = "SELECT 
                `tbl_dv_empleado`.`id_usuario` as id,
                `comunas`.`nombre_comuna`,  
                CONCAT_WS(' - ',`comunas`.`nombre_comuna`,UPPER(CONCAT_WS(' ', `tbl_gen_persona`.`nombre_primero`, `tbl_gen_persona`.`nombre_segundo`, `tbl_gen_persona`.`apellido_primero`, `tbl_gen_persona`.`apellido_segundo`))) AS `nombre`
              FROM
                `role_user`
                INNER JOIN `roles` ON (`role_user`.`role_id` = `roles`.`id`)
                INNER JOIN `tbl_dv_empleado` ON (`role_user`.`user_id` = `tbl_dv_empleado`.`id_usuario`)
                LEFT JOIN `tbl_dv_empleado_x_comuna` ON (`tbl_dv_empleado`.`id` = `tbl_dv_empleado_x_comuna`.`id_ficha_empleado`)
                LEFT JOIN `tbl_gen_persona` ON (`tbl_dv_empleado`.`id_persona` = `tbl_gen_persona`.`id`)
                LEFT JOIN `comunas` ON (`tbl_dv_empleado_x_comuna`.`id_comuna` = `comunas`.`id`)
                WHERE
                `roles`.`id` = 7 
                AND `tbl_dv_empleado_x_comuna`.`id_comuna` NOT IN (SELECT `tbl_dv_empleado_x_comuna`.`id_comuna` FROM `tbl_dv_empleado` INNER JOIN `tbl_dv_empleado_x_comuna` ON (`tbl_dv_empleado`.`id` = `tbl_dv_empleado_x_comuna`.`id_ficha_empleado`) WHERE `tbl_dv_empleado`.`id_usuario` = ?)
              ORDER BY
              `comunas`.id, 3";
        if (!is_null(Auth::user()))
        {
            return DB::select($sql, [Auth::user()->id]);
        } else
        {
            return array();
        }
    }

    private function comunas_impacto_mios()
    {
        $sql = "SELECT 
                `comunas`.`id`,
                `comunas`.`nombre_comuna`
              FROM
                `tbl_dv_empleado`
                INNER JOIN `tbl_dv_empleado_x_comuna` ON (`tbl_dv_empleado`.`id` = `tbl_dv_empleado_x_comuna`.`id_ficha_empleado`)
                INNER JOIN `comunas` ON (`tbl_dv_empleado_x_comuna`.`id_comuna` = `comunas`.`id`)
              WHERE
                `tbl_dv_empleado`.`id_usuario` = ?
                ORDER BY
                `comunas`.`id`";
        if (!is_null(Auth::user()))
        {
            return DB::select($sql, [Auth::user()->id]);
        } else
        {
            return array();
        }
    }

    public function IniciarCrearGrupo()
    {
        $dias=[
            'Lunes',
            'Martes',
            'Miercoles',
            'Jueves',
            'Viernes',
            'Sabado',
            'Domingo'
        ];
        $data_escenarios=DB::select("SELECT 
  `tbl_dv_escenarios`.`id`,
  UPPER(CONCAT_WS(' - ', `tbl_dv_escenarios`.`nombre_escenario`, `barrios`.`nombre_barrio`, `tbl_dv_escenarios`.`direccion`, `tbl_dv_escenarios`.`direccion_complemento`,`comunas`.`nombre_comuna`, `tbl_gen_corregimientos`.`descripcion`)) AS `nombre_escenario`


  
FROM
  `tbl_dv_escenarios`
  LEFT JOIN `barrios` ON (`tbl_dv_escenarios`.`id_barrio` = `barrios`.`id`)
  LEFT JOIN `comunas` ON (`barrios`.`comuna_id` = `comunas`.`id`)
  LEFT JOIN `tbl_gen_corregimientos` ON (`tbl_dv_escenarios`.`id_corregimiento` = `tbl_gen_corregimientos`.`id`)

WHERE
  `tbl_dv_escenarios`.`id` IN (SELECT `tbl_dv_escenario_x_equipamiento`.`id_escenario` FROM `tbl_dv_escenario_x_equipamiento`) AND 
  `tbl_dv_escenarios`.`activo` = 1
ORDER BY
  2");
        return view('grupos.create')->with([
                    'escenarios'           => $data_escenarios,
                    'dias'                 => $dias,
                    'niveles'              => Niveles::all(),
                    'disciplinas'          => Disciplinas::where('activo','=','1')->orderBy('descripcion')->get(),
                    'monitores_mios'       => $this->monitores_mios(),
                    'monitores_no_mios'    => $this->monitores_no_mios(),
                    'comunas_impacto_mios' => $this->comunas_impacto_mios()
        ]);
    }

}
