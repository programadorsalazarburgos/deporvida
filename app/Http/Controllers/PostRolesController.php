<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Role;
use App\PermissionRole;
use App\Permission;
use App\TblDvEmpleado;
use App\Models\TblDvGruposhistoricoEvolucion;
use App\Models\TblDvGrupos;
use App\Comuna;
use response;
use Hashids\Hashids;
use DB;

class PostRolesController extends Controller
{

    protected $hashids;

    public function __construct()
    {
        
    }

    public function vista()
    {
        return view("postroles.approles");
    }

    public static function TieneRol()
    {
        if (!is_null(Auth::user()))
        {
            $sql   = "SELECT count(*) as valido FROM `role_user` WHERE `role_user`.`user_id` = ?";
            $Roles = DB::select($sql, [Auth::user()->id]);
            return ($Roles[0]->valido > 0);
        } else
        {
            return false;
        }
    }

    public static function MiRol()
    {
        if (!is_null(Auth::user()))
        {
            $sql   = "SELECT 
                        UPPER(`roles`.`name`) as rol
                      FROM
                        `role_user`
                        INNER JOIN `roles` ON (`role_user`.`role_id` = `roles`.`id`)
                      WHERE
                        `role_user`.`user_id` = ?";
            $Roles = DB::select($sql, [Auth::user()->id]);
            if (count($Roles) > 0)
            {
                return $Roles[0]->rol;
            }
        } else
        {
            return false;
        }
    }

    public static function verroles_user()
    {
        $temp = new PostRolesController();
        return $temp->verroles();
    }

    public function verroles()
    {
        $sql   = "SELECT 
						  CONCAT('.',`permissions`.`name`) as class
						FROM
						  `permissions`
						WHERE
						  `permissions`.`tenantId` = ?
						  AND
						  `permissions`.`id` NOT IN(SELECT 
						  `permission_role`.`permission_id`
						FROM
						  `permission_role`
						  INNER JOIN `role_user` ON (`permission_role`.`role_id` = `role_user`.`role_id`)
						WHERE
						  `role_user`.`user_id` = ?)
		  ORDER BY 1
          ";
        $Roles = DB::select($sql, [Auth::user()->tenantId, Auth::user()->id]);
        $rol   = array();
        foreach ($Roles as $key => $temp)
        {
            $rol[] = ($temp->class);
        }
        $Roles = $rol;
        unset($rol);
        $Roles = json_decode(json_encode($Roles), true);
        $Roles = array_unique($Roles);
        $class = implode(',', $Roles);
        if (
                strpos($class, '.crear-usuarios') !== false &&
                strpos($class, '.editar-usuarios') !== false &&
                strpos($class, '.eliminar-usuarios') !== false &&
                strpos($class, 'ver-usuarios') !== false
        )
        {
            $class .= ',.mostrar-usuarios';
        }

        if
        (
                strpos($class, '.ver-zonas') !== false &&
                strpos($class, '.editar-zonas') !== false &&
                strpos($class, '.crear-zonas') !== false &&
                strpos($class, '.eliminar-zonas') !== false &&
                strpos($class, '.ver-comunas') !== false &&
                strpos($class, '.editar-comunas') !== false &&
                strpos($class, '.crear-comunas') !== false &&
                strpos($class, '.eliminar-comunas') !== false &&
                strpos($class, '.ver-barrios') !== false &&
                strpos($class, '.editar-barrios') !== false &&
                strpos($class, '.crear-barrios') !== false &&
                strpos($class, '.eliminar-barrios') !== false
        )
        {
            $class .= ',.mostrar-gest-administrativa';
        }
        if
        (
                strpos($class, '.crear-escenarios') !== false &&
                strpos($class, '.editar-escenarios') !== false &&
                strpos($class, '.eliminar-escenarios') !== false &&
                strpos($class, '.ver-tipoescenarios') !== false &&
                strpos($class, '.crear-tipoescenarios') !== false &&
                strpos($class, '.editar-tipoescenarios') !== false &&
                strpos($class, '.eliminar-tipoescenarios') !== false &&
                strpos($class, '.ver-escenarios') !== false
        )
        {
            $class .= ',.mostrar-gest-infraestructura';
        }
        if
        (
                strpos($class, '.ver-beneficiarios') !== false &&
                strpos($class, '.crear-beneficiarios') !== false
        )
        {
            $class .= ',.mostrar-Beneficiarios';
        }
        if
        (
            strpos($class, '.ver-ejes-tematicos') !== false &&
            strpos($class, '.ver-niveles-tecnicos') !== false &&
            strpos($class, '.ver-calificaciones-escala') !== false &&
            strpos($class, '.ver-indicadores') !== false &&
            strpos($class, '.ver-plazos-y-periodos-evaluaciones') !== false &&
            strpos($class, '.ver-evaluaciones-psicosocial') !== false &&
            strpos($class, '.ver-evaluaciones-tecnica') !== false
        )
        {
            $class .= ',.mostrar-evaluaciones';
        }
        if
        (
                strpos($class, '.reporteador') !== false
        )
        {
            $class .= ',.mostrar-reporteador';
        }
        if
        (
            $this->menuReportes($class) &&
            strpos($class, '.reporte-caracterizacion') !== false && 
            strpos($class, '.reporte-parrilla') !== false &&
            strpos($class, '.ver-reporte-sencillo') !== false
        )
        {
            $class .= ',.mostrar-reportes';
        }
        if
        (
            strpos($class, '.reporte-Tablero_de_Control') !== false && 
            strpos($class, '.reporte-Indicadores_Psicosociales') !== false &&
            strpos($class, '.reporte-Indicadores_Tecnicos') !== false
        )
        {
            $class .= ',.mostrar-reportes-graficos';
        }

        return $class;
    }

    public function menuReportes($class) 
    {
        $r = true;
        $reportesReporteador = \App\Http\Controllers\PostReporteadorController::menuReportesReporteador();
        foreach ($reportesReporteador as $repoerte) {
            $r = $r && strpos($class, '.'.$repoerte->name) !== false;
        }
        // dd($r);
        return $r;
    }

    public function index()
    {

        $Roles = Role::where('roles.tenantId', '=', Auth::user()->tenantId)->get();
        return response()->json($Roles->toArray());
    }

    public function ObtenerRol($id)
    {
        $rol_permiso = Role::where('roles.id', '=', $id)->firstOrfail();
        return response()->json($rol_permiso->toArray());
    }

    public function ObtenerPermisosId($id)
    {
        $permission_role = PermissionRole::select('permission_role.permission_id as id', 'permission_role.role_id', 'permissions.name')->where('permission_role.role_id', '=', $id)->join(
                        'permissions', 'permissions.id', '=', 'permission_role.permission_id')->get();
        return response()->json($permission_role->toArray());
    }

    public function ObtenerPermisosTotal()
    {
        $permission_role = Permission::where('permissions.tenantId', '=', Auth::user()->tenantId)->get();
        return response()->json($permission_role->toArray());
    }

    public function CrearPermisosRole(Request $request, $id)
    {
        $permissions = PermissionRole::where('permission_role.role_id', '=', $id)->delete();
        if ($request->isMethod('post'))
        {
            foreach ($request->input() as $dato1)
            {
                $permisos                = new PermissionRole();
                $permisos->permission_id = $dato1[0];
                $permisos->role_id       = $id;
                $permisos->save();
            }
            return response()->json($permisos);
        }
    }

    private function Eliminar($id_permiso, $id_rol)
    {
        $permissions = PermissionRole::where('permission_role.role_id', '=', $id_rol)->where('permission_role.permission_id', '=', $id_permiso)->delete();
    }

    public function EliminarPermisosRole(Request $request, $id)
    {
        $data = $request->input();
        foreach ($data as $temp)
        {
            $this->Eliminar($temp[0], $id);
        }
    }

    public function CrearRol(Request $request)
    {
        $rol               = new Role();
        $rol->name         = $request->nombre;
        $rol->display_name = $request->nombre;
        $rol->description  = $request->descripcion;
        $rol->tenantId     = Auth::user()->tenantId;
        $rol->save();
        return response()->json($rol);
    }

    public function EliminarRol($id)
    {
        Role::whereId($id)->delete();
        return response()->json('eliminado');
    }


    public function cambiar(Request $request)
    {
        date_default_timezone_set('America/Bogota');
        $data=TblDvGrupos::where('id_comuna_impacto','=',$request->input('id_comuna'))->where('activo','=','1')->where('id_metodologo','!=',$request->input('id_usuario'))->get();
        foreach($data as $temp)
        {
            $histo                             = new TblDvGruposhistoricoEvolucion();
            $histo->id_grupo                   = $temp->id;
            $histo->id_escenario               = $temp->id_escenario;
            $histo->id_metodologo              = $temp->id_metodologo;
            $histo->id_disciplina              = $temp->id_disciplina;
            $histo->id_comuna_impacto          = $temp->id_comuna_impacto;
            $histo->id_monitor                 = $temp->id_monitor;
            $histo->id_nivel                   = $temp->id_nivel;
            $histo->observaciones              = $temp->observaciones;
            $histo->codigo_grupo               = $temp->codigo_grupo;
            $histo->fecha_registro             = $temp->fecha_registro;
            $histo->activo                     = 0;
            $histo->fecha_reasignacion         = date('Y-m-d H:i:s');
            $histo->id_usuario_genera_cambio   = Auth::user()->id;
            $histo->save();
            unset($histo);
        }
        $sql='UPDATE
              `tbl_dv_grupos`
            SET
              `tbl_dv_grupos`.`id_metodologo` = ?,
              `tbl_dv_grupos`.`fecha_registro`=?
            WHERE
              `tbl_dv_grupos`.`id_comuna_impacto` = ?
              AND
              `tbl_dv_grupos`.`activo`=1
              ';
        DB::select($sql,[$request->input('id_usuario'),date('Y-m-d H:i:s'),$request->input('id_comuna')]);
        echo json_encode(['validate'=>TRUE]);
    }
    public function reasignar()
    {
        $data=json_decode($this->data_comunas_metodologo());
        return view('reasignar.index')->with(['data'=>$data->data,'comunas'=>Comuna::all()]);
    }
    public function data_comunas_metodologo()
    {

        $sql = '(SELECT 
                  `tbl_dv_empleado`.`id_usuario`,
                  `tbl_gen_persona`.`apellido_primero`,
                  `tbl_gen_persona`.`apellido_segundo`,
                  `tbl_gen_persona`.`nombre_primero`,
                  `tbl_gen_persona`.`nombre_segundo`,
                  `tbl_gen_persona`.`documento`,
                  `tbl_dv_grupos`.`id_comuna_impacto`,
                  `comunas`.`nombre_comuna`,
                  count(`tbl_dv_grupos`.`codigo_grupo`) AS `codigo_grupo`
                  
                FROM
                  `tbl_dv_empleado`
                  INNER JOIN `tbl_dv_grupos` ON (`tbl_dv_empleado`.`id_usuario` = `tbl_dv_grupos`.`id_metodologo`)
                  INNER JOIN `tbl_gen_persona` ON (`tbl_dv_empleado`.`id_persona` = `tbl_gen_persona`.`id`)
                  INNER JOIN `comunas` ON (`tbl_dv_grupos`.`id_comuna_impacto` = `comunas`.`id`)
                WHERE
                `tbl_dv_grupos`.`activo`=1
                GROUP BY
                `tbl_dv_grupos`.`id_comuna_impacto`,
                `tbl_dv_grupos`.`id_metodologo`
                ORDER BY
                `comunas`.`id`)
                UNION
                (SELECT 
              `tbl_dv_empleado`.`id_usuario`,
              `tbl_gen_persona`.`apellido_primero`,
              `tbl_gen_persona`.`apellido_segundo`,
              `tbl_gen_persona`.`nombre_primero`,
              `tbl_gen_persona`.`nombre_segundo`,
              `tbl_gen_persona`.`documento`,
              0 AS `id_comuna_impacto`,
              \'-\' AS `nombre_comuna`,
              \'-\' AS `codigo_grupo`
            FROM
              `tbl_dv_empleado`
              INNER JOIN `tbl_gen_persona` ON (`tbl_dv_empleado`.`id_persona` = `tbl_gen_persona`.`id`)
              INNER JOIN `role_user` ON (`tbl_dv_empleado`.`id_usuario` = `role_user`.`user_id`)
            WHERE
              `role_user`.`role_id` = 8
              AND
              `tbl_dv_empleado`.`id_usuario` NOT IN
              (SELECT `tbl_dv_empleado`.`id_usuario`
              FROM `tbl_dv_empleado`
              INNER JOIN `tbl_dv_grupos` ON (`tbl_dv_empleado`.`id_usuario` = `tbl_dv_grupos`.`id_metodologo`)
              WHERE `tbl_dv_grupos`.`activo`=1
              GROUP BY `tbl_dv_empleado`.`id_usuario`))';
        $data = DB::select($sql);
        return json_encode(array("validate"=>true,'data'=>$data),128);
    }
}
