<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\User;
use App\TblDvMetodologosXMonitores;
use App\Role;
use App\RoleUser;
use response;
use Hashids\Hashids;
use respondNotFound;
use Exception;
use DB;

class PostUsuariosController extends Controller
{

    public function __construct()
    {
        //$this->middleware('permission:ver-instituciones', ['only' => 'vista']);
        //$this->middleware('permission:crear-instituciones', ['only' => 'CrearUsuario']);	
        //$this->middleware('permission:crear-instituciones', ['only' => 'CrearUsuario']);  
    }

    public function vista()
    {
        return view("postusuarios.appusuarios")->with(['permisos' => \App\Http\Controllers\PostRolesController::verroles_user()]);
    }

    public function index()
    {
        if(isset(Auth::user()->tenantId))
        {
            $sql='SELECT 
                    `tbl_dv_empleado`.`id_persona`,
                    `users`.`id`,
                    `users`.`numero_documento`,
                    `tbl_gen_persona`.`nombre_primero` AS `primer_nombre`,
                    `tbl_gen_persona`.`nombre_segundo` AS `segundo_nombre`,
                    `tbl_gen_persona`.`apellido_primero` AS `primer_apellido`,
                    `tbl_gen_persona`.`apellido_segundo` AS `segundo_apellido`,
                    `users`.`email`,
                    `users`.`telefono_movil`,
                    `users`.`direccion`,
                    `roles`.`display_name`,
                    GROUP_CONCAT(`comunas`.`codigo_comuna`) AS `comunas`,
                      `tbl_dv_estado_aspirante`.`descripcion` as estado_aspirante,
                      `tbl_dv_empleado_cargo`.`descripcion` as empleado_cargo
                FROM
                    `users`
                LEFT OUTER JOIN `role_user` ON (`users`.`id` = `role_user`.`user_id`)
                LEFT OUTER JOIN `roles` ON (`role_user`.`role_id` = `roles`.`id`)
                LEFT OUTER JOIN `tbl_dv_empleado` ON (`users`.`id` = `tbl_dv_empleado`.`id_usuario`)
                LEFT OUTER JOIN `tbl_gen_persona` ON (`tbl_dv_empleado`.`id_persona` = `tbl_gen_persona`.`id`)
                LEFT OUTER JOIN `tbl_dv_empleado_x_comuna` ON (`tbl_dv_empleado`.`id` = `tbl_dv_empleado_x_comuna`.`id_ficha_empleado`)
                LEFT OUTER JOIN `comunas` ON (`tbl_dv_empleado_x_comuna`.`id_comuna` = `comunas`.`id`)
                LEFT OUTER JOIN `tbl_dv_estado_aspirante` ON (`tbl_dv_empleado`.`id_estado_aspirante` = `tbl_dv_estado_aspirante`.`id`)
                LEFT OUTER JOIN `tbl_dv_empleado_cargo` ON (`tbl_dv_empleado`.`id_cargo` = `tbl_dv_empleado_cargo`.`id`)
                WHERE
                    `users`.`tenantId`=?
                GROUP BY
                    `users`.`numero_documento`';
            $usuarios=DB::select($sql,[Auth::user()->tenantId]);
            return json_encode($usuarios, 128);
        }
        else
        {
            return json_encode([]);
        }
    }

    public function ObtenerRoles()
    {

        $roles = Role::all();
        return response()->json($roles->toArray());
    }

    public function CorreoUsuario(Request $request)
    {
        $correo = User::where('users.email', '=', $request->input('email'))->firstOrfail();
        return response()->json($correo->toArray());
    }

    public function DocumentoUsuario($id)
    {
        $documento = trim(str_replace(array('.', ' ', ','), array('', '', ''), $id));
        try
        {
            $query = User::where('users.numero_documento', '=', $documento)->firstOrfail();
            return response()->json(['validate' => true, 'mjs' => NULL, 'data' => $query->toArray()]);
        } catch (Exception $e)
        {
            return response()->json(array('validate' => false, 'data' => NULL, 'msj' => $e));
        }
    }

    public function UserMetodologo($id_monitor, $id_rol)
    {
        $sql  = 'SELECT 
                  count(`roles`.`id`) as validate
                FROM `role_user`
                INNER JOIN `roles` ON (`role_user`.`role_id` = `roles`.`id`)
                WHERE `role_user`.`user_id`=? AND `roles`.`id`=8';
        $data = DB::select($sql, [Auth::user()->id]);
        if ($data[0]->validate > 0 && $id_rol == '7')
        {
            $MetoMonitor                = new TblDvMetodologosXMonitores();
            $MetoMonitor->id_monitor    = $id_monitor;
            $MetoMonitor->id_metodologo = Auth::user()->id;
            $MetoMonitor->save();
        }
    }

    private function ValidarUsuario($Usuario)
    {
        $user = User::where([['email', $Usuario["correo"]], ['tenantId', Auth::user()->tenantId]])->get();
        return (count($user) == 0);
    }

    private function RegistrarPersona($data)
    {
        $persona                         = [];
        $persona['nombre_primero']       = (isset($data['primer_nombre'])) ? $data['primer_nombre'] : null;
        $persona['nombre_segundo']       = (isset($data['segundo_nombre'])) ? $data['segundo_nombre'] : null;
        $persona['apellido_primero']     = (isset($data['primer_apellido'])) ? $data['primer_apellido'] : null;
        $persona['apellido_segundo']     = (isset($data['segundo_apellido'])) ? $data['segundo_apellido'] : null;
        $persona['documento']            = (isset($data['numero_documento'])) ? $data['numero_documento'] : null;
        $persona['id_documento_tipo']    = (isset($data['tipo_documento'])) ? $data['tipo_documento'] : null;
        $persona['fecha_nacimiento']     = (isset($data['fecha_nacimiento'])) ? date('Y-m-d', strtotime($data['fecha_nacimiento'])) : null;
        $persona['telefono_fijo']        = (isset($data['telefono_fijo'])) ? $data['telefono_fijo'] : null;
        $persona['telefono_movil']       = (isset($data['telefono_movil'])) ? $data['telefono_movil'] : null;
        $persona['correo_electronico']   = (isset($data['correo'])) ? $data['correo'] : null;
        $persona['residencia_direccion'] = (isset($data['direccion'])) ? $data['direccion'] : null;
        $SavePersona                     = new PostBeneficiariosController();
        $Res                             = $SavePersona->SavePersona($persona);
        return $Res;
    }

    public function CrearUsuario(Request $request)
    {
        try
        {
            $res = $this->ValidarUsuario($request->all());
            if ($res)
            {
                $usuario                   = new User();
                $usuario->primer_nombre    = $request->input('primer_nombre');
                $usuario->segundo_nombre   = $request->input('segundo_nombre');
                $usuario->primer_apellido  = $request->input('primer_apellido');
                $usuario->segundo_apellido = $request->input('segundo_apellido');
                $usuario->numero_documento = trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('numero_documento')));
                $usuario->tipo_documento   = $request->input('tipo_documento');
                $usuario->direccion        = $request->input('direccion');
                $usuario->fecha_nacimiento = date('Y-m-d', strtotime($request->input('fecha_nacimiento')));
                $usuario->telefono_movil   = $request->input('telefono_movil');
                $usuario->telefono_fijo    = $request->input('telefono_fijo');
                $usuario->email            = $request->input('correo');
                $usuario->password         = bcrypt($request->input('password'));
                $usuario->remember_token   = str_random(50);
                $usuario->tenantId         = Auth::user()->tenantId;
                $usuario->save();
                $this->RegistrarPersona($request->all());
                $rol_user                  = RoleUser::firstOrNew(['user_id' => $usuario->id]);
                $rol_user->user_id         = $usuario->id;
                $rol_user->role_id         = $request->input('rol');
                $rol_user->save();
                $this->UserMetodologo($usuario->id, $request->input('rol'));
                return response()->json(['validate' => true, 'msj' => null]);
            } else
            {
                return response()->json(['validate' => false, 'msj' => 'El correo ' . $request->input('correo') . ' ya se encuentra registrado', 'log' => $request->input('correo')]);
            }
        } catch (Exception $e)
        {
            return response()->json(['validate' => false, 'msj' => 'Error inexperado. Contacte con el administrador', 'log' => $e]);
        }
    }

    public function ObtenerUsuario($id)
    {
        $usuario = DB::select('select id, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, numero_documento, direccion, DATE_FORMAT(users.fecha_nacimiento, "%d/%m/%Y") as fecha_nacimiento, telefono_movil, telefono_fijo, email, FORMAT(users.numero_documento, 0, \'de_DE\') as numero_documento from users where users.id =?', [$id]);
        return response()->json($usuario);
    }

    public function ObtenerTipoDocumento($id)
    {
        $tipodocumento = User::select('users.tipo_documento as id')->where('users.id', '=', $id)->firstOrfail();
        return response()->json($tipodocumento->toArray());
    }

    public function ObtenerRolID($id)
    {
        $roles = RoleUser::select('roles.id', 'roles.name')->join('roles', 'roles.id', '=', 'role_user.role_id')->where('role_user.user_id', '=', $id)->firstOrfail();
        return response()->json($roles->toArray());
    }

    public function ActualizarUsuario(Request $request, $id)
    {
        if ($request->isMethod('post'))
        {
            $usuario                   = User::where('users.id', '=', $id)->firstOrfail();
            $usuario->primer_nombre    = $request->input('primer_nombre');
            $usuario->segundo_nombre   = $request->input('segundo_nombre');
            $usuario->primer_apellido  = $request->input('primer_apellido');
            $usuario->segundo_apellido = $request->input('segundo_apellido');
            $usuario->tipo_documento   = $request->input('tipo_documento');
            $usuario->numero_documento = trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('numero_documento')));
            $usuario->direccion        = $request->input('direccion');
            //$usuario->fecha_nacimiento = date('Y-m-d',$request->input('fecha_nacimiento'));
            $usuario->telefono_movil   = $request->input('telefono_movil');
            $usuario->telefono_fijo    = $request->input('telefono_fijo');
            $usuario->email            = $request->input('correo');
            $usuario->save();
            $rol_user                  = RoleUser::firstOrNew(['user_id' => $id]);
            $rol_user->user_id         = $usuario->id;
            $rol_user->role_id         = str_replace('number:', '', $request->input('rol'));
            //$rol_user->role_id = $this->hashids->decode($request->input('rol'))[0];
            $rol_user->save();
            return response('Actualizado');
        }
    }

    public function ActualizarClave(Request $request, $id)
    {
        if ($request->isMethod('post'))
        {
            $usuario           = User::where('users.id', '=', $id)->firstOrfail();
            $usuario->password = bcrypt($request->input('password'));
            $usuario->save();
            return response()->json($usuario->toArray());
        }
    }

    public function EliminarUsuario($id)
    {
        $usuario = User::findOrfail($id);
        $usuario->delete();
        return response()->json($usuario->toArray());
    }

}
