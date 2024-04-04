<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DateTime;
use App\User;
use App\Programa;
use App\RoleUser;
use App\Models\TblGenDocumentoTipo;
use App\TblDvEmpleado;
use App\Models\TblGenEp;
use App\Models\TblGenEstadoCivil;
use App\Models\TblDvFicha;
use App\Models\TblGenPais;
use App\Models\TblGenCiudad;
use App\Models\TblGenBarrio;
use App\Models\TblGenEtnium;
use App\Models\TblGenPersona;
use App\Models\TblDvPrograma;
use App\Models\TblGenOcupacion;
use App\Models\TblGenParentesco;
use App\Models\TblDvDisciplinas;
use App\Models\TblGenDepartamento;
use App\Models\TblGenDiscapacidad;
use App\Models\TblGenSaludRegiman;
use App\Models\TblGenEscolaridadNivel;
use App\Models\TblGenGrupoPoblacional;
use App\Models\ClubesDeportivos;
use App\Models\TblDvPersonaXOcupacion;
use App\Models\TblGenEscolaridadEstado;
use App\Models\TblDvPersonaXDiscapacidad;
use App\Models\TblGenPersonaXGrupoPoblacional;
use App\Models\TblDvHojaVidaCarreras;
use DB;

class PostPersonalController extends Controller
{
    public $id_grupo;
    public function __construct($id_grupo='')
    {
        $this->id_grupo=$id_grupo;
    }
    public function savecambiarmipass(Request $request)
    {
        try
        {
            if (trim($request->input('pass1')) != '' && $request->input('pass1') === $request->input('pass2'))
            {
                $usuario           = User::where('users.id', '=', Auth::user()->id)->firstOrfail();
                $usuario->password = bcrypt($request->input('pass1'));
                $usuario->save();
                return response()->json(['validate' => true, 'msj' => NULL]);
            }
        } catch (Exception $e)
        {
            return response()->json(['validate' => true, 'msj' => $e]);
        }
    }

    public function cambiarmipass()
    {
        if (isset(Auth::user()->id))
        {
            return view("postusuarios.cambiarmipass");
        } else
        {
            return null;
        }
    }

    public function Asignar()
    {
        $user = DB::select('SELECT
                            `users`.`numero_documento`,
                            CONCAT_WS(" ",
                            `users`.`primer_nombre`,
                            `users`.`segundo_nombre`,
                            `users`.`primer_apellido`,
                            `users`.`segundo_apellido`) as usuario,
                            `users`.`fecha_nacimiento`,
                            `users`.`id` as id_user
                          FROM
                            `users`
                          WHERE
                            `users`.`id` NOT IN (SELECT `role_user`.`user_id` FROM `role_user`)
                          ORDER BY
                            `users`.`created_at`');
        return view("personal.asignar")->with([
                    'usuarios' => $user,
                    'roles'    => \App\Role::all()
        ]);
    }

    public function universidades()
    {
        $sql           = 'SELECT
                            `tbl_dv_instituciones_educativas`.`id`,
                            `tbl_dv_instituciones_educativas`.`nombre` as value
                          FROM
                            `tbl_dv_instituciones_educativas`
                            WHERE
                            TRIM(UPPER(`tbl_dv_instituciones_educativas`.`nombre`)) LIKE "%' . trim(strtoupper($_GET['term'])) . '%"
                        ORDER BY
                        `tbl_dv_instituciones_educativas`.`nombre`;';
        $universidades = DB::select($sql);
        return response()->json($universidades);
    }

    public function carreras()
    {
        $sql           = 'SELECT
                            `tbl_dv_hoja_vida_carreras`.`id`,
                            `tbl_dv_hoja_vida_carreras`.`descripcion` as value
                          FROM
                            `tbl_dv_hoja_vida_carreras`
                            WHERE
                            TRIM(UPPER(`tbl_dv_hoja_vida_carreras`.`descripcion`)) LIKE "%' . trim(strtoupper($_GET['term'])) . '%"
                        ORDER BY
                        `tbl_dv_hoja_vida_carreras`.`descripcion`;';
        $universidades = DB::select($sql);
        return response()->json($universidades);
    }

    public static function id_carreras($nombre)
    {
        $nombre=strtoupper(trim($nombre));
        $carrera=TblDvHojaVidaCarreras::firstOrNew(['descripcion'=>$nombre]);
        if(is_null($carrera->id))
        {
            $carrera->descripcion=$nombre;
            $carrera->Save();
        }
        return $carrera->id;
    }
    public function Asignar_roles($id_user, $id_rol)
    {
        try
        {
            $roles          = \App\RoleUser::firstOrNew(['user_id' => $request->input('user')]);
            $roles->user_id = $request->input('user');
            $roles->role_id = $request->input('rol');
            $roles->save();
            return response()->json(['validate' => true, 'msj' => NULL, 'data' => ['id' => $roles->id]]);
        } catch (Exception $ex)
        {
            return response()->json(['validate' => false, 'msj' => $ex, 'data' => NULL]);
        }
    }

    public function EditarUsuario($id)
    {
        $persona          = TblGenPersona::where('id', '=', $id)->firstOrFail();
        $fecha_nacimiento = json_decode(json_encode($persona->fecha_nacimiento, 128), true);
        $data_people      = $this->viewFichaUsuario(TRUE, $id, $persona->nombre_primero, $persona->nombre_segundo, $persona->apellido_primero, $persona->apellido_segundo, $persona->documento, $persona->id_documento_tipo, $persona->sexo, $fecha_nacimiento, $persona->telefono_fijo, $persona->telefono_movil, $persona->correo_electronico, $persona->id_procedencia_pais, $persona->id_procedencia_municipio, $persona->id_procedencia_departamento, $persona->id_residencia_corregimiento, $persona->id_residencia_barrio, $persona->id_residencia_vereda, $persona->residencia_direccion, $persona->residencia_estrato, $persona->sangre_tipo, $persona->id_estado_civil);
        return view("personal.user")->with($data_people);
    }

    public function VercorregimientoXVereda($id)
    {
        $sql  = 'SELECT
                    `tbl_gen_veredas`.`id`,
                    `tbl_gen_veredas`.`codigo_unico`,
                    `tbl_gen_veredas`.`codigo_estudio`,
                    `tbl_gen_veredas`.`nombre`,
                    `tbl_gen_veredas`.`estrato`,
                    `comunas`.`nombre_comuna` as id_comuna
                FROM
                    `tbl_gen_veredas`
                    LEFT JOIN `comunas` ON (`tbl_gen_veredas`.`id_comuna` = `comunas`.`id`)
                WHERE
                    `tbl_gen_veredas`.`corregimiento_id` = ?
                ORDER BY
                    `tbl_gen_veredas`.`nombre`';
        $data = DB::select($sql, [$id]);
        return $data;
    }

    public function viewFichaUsuario(
        $asignar_permisos=false,
        $id = '',
        $nombre_primero = '',
        $nombre_segundo = '',
        $apellido_primero = '',
        $apellido_segundo = '',
        $documento = '',
        $id_documento_tipo = '',
        $sexo = '',
        $fecha_nacimiento = '',
        $telefono_fijo = '',
        $telefono_movil = '',
        $correo_electronico = '',
        $id_procedencia_pais = '',
        $id_procedencia_municipio = '',
        $id_procedencia_departamento = '',
        $id_residencia_corregimiento = '',
        $id_residencia_barrio = '',
        $id_residencia_vereda = '',
        $residencia_direccion = '',
        $residencia_estrato = '',
        $sangre_tipo = '',
        $id_estado_civil = '',
        $nuevo = 1,
        $id_regimen_salud=1
    )
    {
        $max_monitor    = \App\Models\TblDvConfig::where('name', '=', 'max_monitor')->firstOrFail();
        $max_metodologo = \App\Models\TblDvConfig::where('name', '=', 'max_metodologo')->firstOrFail();
        $data           = [
            'escolaridad_estado'          => TblGenEscolaridadEstado::all(),
            'asignar_permisos'            => ($asignar_permisos) ? 'true' : 'false',
            'max_monitor'                 => $max_monitor->value,
            'max_metodologo'              => $max_metodologo->value,
            'veredas'                     => [],
            'corregimiento'               => \App\TblGenCorregimiento::orderBy('descripcion')->get(),
            'id'                          => $id,
            'nuevo'                       => $nuevo,
            'nombre_primero'              => $nombre_primero,
            'nombre_segundo'              => $nombre_segundo,
            'apellido_primero'            => $apellido_primero,
            'apellido_segundo'            => $apellido_segundo,
            'documento'                   => $documento,
            'id_documento_tipo'           => $id_documento_tipo,
            'sexo'                        => $sexo,
            'fecha_nacimiento'            => $fecha_nacimiento,
            'telefono_fijo'               => $telefono_fijo,
            'telefono_movil'              => $telefono_movil,
            'correo_electronico'          => $correo_electronico,
            'id_procedencia_pais'         => $id_procedencia_pais,
            'id_procedencia_municipio'    => $id_procedencia_municipio,
            'id_procedencia_departamento' => $id_procedencia_departamento,
            'id_residencia_corregimiento' => $id_residencia_corregimiento,
            'id_residencia_barrio'        => $id_residencia_barrio,
            'id_residencia_vereda'        => $id_residencia_vereda,
            'residencia_direccion'        => $residencia_direccion,
            'residencia_estrato'          => $residencia_estrato,
            'sangre_tipo'                 => $sangre_tipo,
            'id_estado_civil'             => $id_estado_civil,
            'estado_aspirante'            => \App\TblDvEstadoAspirante::orderBy('descripcion')->get(),
            'presupuesto'                 => \App\TblDvPresupuesto::orderBy('descripcion')->get(),
            'cargo'                       => \App\TblDvEmpleadoCargo::orderBy('descripcion')->get(),
            'disponibilidad'              => \App\TblDvDisponibilidad::orderBy('descripcion')->get(),
            'comunas'                     => \App\TblGenComunas::all(),
            'pais'                        => TblGenPais::orderBy('nombre_pais')->get(),
            'departamento'                => TblGenDepartamento::orderBy('nombre_departamento')->get(),
            'municipio'                   => TblGenCiudad::orderBy('nombre_municipio')->where('departamento_id', '3')->get(),
            'eps'                         => TblGenEp::orderBy('descripcion')->where('activo', '1')->get(),
            'escolaridad_nivel'           => TblGenEscolaridadNivel::all(),
            'escolaridad_estado'          => TblGenEscolaridadEstado::all(),
            'grupo_etnico'                => TblGenGrupoPoblacional::all(),
            'tipo_documento'              => TblGenDocumentoTipo::all(),
            'programa'                    => TblDvPrograma::orderBy('descripcion')->get(),
            'ocupacion'                   => TblGenOcupacion::all(),
            'discapacidad'                => TblGenDiscapacidad::all(),
            'barrio'                      => TblGenBarrio::orderBy('nombre_barrio')->get(),
            'ocupacion_activo_si'         => TblGenOcupacion::all()->where('activo', 'si'),
            'ocupacion_activo_no'         => TblGenOcupacion::all()->where('activo', 'no'),
            'etnia_si'                    => TblGenEtnium::all()->where('activo', 'si'),
            'etnia_no'                    => TblGenEtnium::all()->where('activo', 'no'),
            'discapacidad'                => TblGenDiscapacidad::all(),
			
            'grupo_poblacional'           => TblGenGrupoPoblacional::all(),
			'clubes_deportivos'   		  => ClubesDeportivos::all(),
			
			
            'parentesco'                  => TblGenParentesco::all(),
            'regimen_salud'               => TblGenSaludRegiman::all(),
            'estado_civil'                => TblGenEstadoCivil::all(),
            'disciplinas'                 => \App\Disciplinas::where('activo','=','1')->orderBy('descripcion')->get(),
            'roles'                       => \App\Role::where('tenantId','=','312312312')->orderBy('name')->get(),
            'id_grupo'                    => $this->id_grupo
        ];
        return $data;
    }

    public function CrearUsuario()
    {
        return view("personal.user")->with($this->viewFichaUsuario(TRUE));
    }

    public function vista()
    {
        return view("personal.user")->with($this->viewFichaUsuario(FALSE));
    }

    private function id_institucion($nombre)
    {
        $institucion = \App\TblDvInstitucionesEducativas::firstOrNew(['nombre' => strtoupper($nombre)]);
        if (is_null($institucion->id))
        {
            $institucion->nombre = strtoupper($nombre);
            $institucion->save();
        }
        return $institucion->id;
    }

    private function GuardarFichaPersona($id_persona, $id_usuario, $data)
    {
        $ficha                           = TblDvEmpleado::firstOrNew(['id_usuario' => $id_usuario]);
        $ficha->id_persona               = $id_persona;
        $ficha->id_usuario               = $id_usuario;
        $ficha->id_estado_escolaridad    = isset($data['id_estado_escolaridad']) ? strtoupper($data['id_estado_escolaridad']) : $ficha->id_estado_escolaridad;
        $ficha->tiene_hijos              = isset($data['tiene_hijos']) ? strtoupper($data['tiene_hijos']) : $ficha->tiene_hijos;
        $ficha->cuantos_hijos            = isset($data['cuantos_hijos']) ? strtoupper($data['cuantos_hijos']) : $ficha->cuantos_hijos;
        $ficha->libreta_militar          = isset($data['libreta_militar']) ? strtoupper($data['libreta_militar']) : $ficha->libreta_militar;
        $ficha->no_libreta_militar       = isset($data['no_libreta_militar']) ? strtoupper($data['no_libreta_militar']) : $ficha->no_libreta_militar;
        $ficha->distrito_militar         = isset($data['distrito_militar']) ? strtoupper($data['distrito_militar']) : $ficha->distrito_militar;
        $ficha->skype                    = isset($data['skype']) ? strtoupper($data['skype']) : $ficha->skype;
        $ficha->id_presupuesto           = (isset($data['id_presupuesto'])) ? strtoupper($data['id_presupuesto']) : $ficha->id_presupuesto;
        $ficha->id_estado_aspirante      = (isset($data['id_estado_aspirante'])) ? strtoupper($data['id_estado_aspirante']) : 1;
        $ficha->id_disponibilidad        = (isset($data['id_disponibilidad'])) ? strtoupper($data['id_disponibilidad']) : $ficha->id_disponibilidad;
        $ficha->id_cargo                 = (isset($data['id_cargo'])) ? strtoupper($data['id_cargo']) : $ficha->id_cargo;
        $ficha->profesion                = isset($data['profesion']) ? strtoupper($data['profesion']) : $ficha->profesion;
        $ficha->id_disciplina            = (isset($data['id_disciplina'])) ? strtoupper($data['id_disciplina']) : $ficha->id_disciplina;
        $ficha->id_ocupacion             = isset($data['id_ocupacion']) ? strtoupper($data['id_ocupacion']) : $ficha->id_ocupacion;
        $ficha->tiene_discapacidad       = isset($data['tiene_discapacidad']) ? strtoupper($data['tiene_discapacidad']) : $ficha->tiene_discapacidad;
        $ficha->padece_enfermedad        = isset($data['padece_enfermedad']) ? strtoupper($data['padece_enfermedad']) : $ficha->padece_enfermedad;
        $ficha->enfermedad               = isset($data['enfermedad']) ? strtoupper($data['enfermedad']) : $ficha->enfermedad;
        $ficha->toma_medicamentos        = isset($data['toma_medicamentos']) ? strtoupper($data['toma_medicamentos']) : $ficha->toma_medicamentos;
        $ficha->medicamentos             = isset($data['medicamentos']) ? strtoupper($data['medicamentos']) : $ficha->medicamentos;
        $ficha->afiliado_sgsss           = isset($data['afiliado_sgsss']) ? strtoupper($data['afiliado_sgsss']) : $ficha->afiliado_sgsss;
        $ficha->id_tipo_afiliacion       = isset($data['id_tipo_afiliacion']) ? strtoupper($data['id_tipo_afiliacion']) : $ficha->id_tipo_afiliacion;
        $ficha->id_eps                   = isset($data['id_eps']) ? strtoupper($data['id_eps']) : $ficha->id_eps;
        $ficha->id_etnia                 = isset($data['id_etnia']) ? strtoupper($data['id_etnia']) : $ficha->id_etnia;
        $ficha->proyecto_profesional     = isset($data['proyecto_profesional']) ? strtoupper($data['proyecto_profesional']) : $ficha->proyecto_profesional;
        $ficha->id_escolaridad_nivel     = (isset($data['id_escolaridad_nivel'])) ? strtoupper($data['id_escolaridad_nivel']) : $ficha->id_escolaridad_nivel;
        $ficha->id_institucion_educativa = (isset($data['universidad'])) ? $this->id_institucion($data['universidad']) : $ficha->id_institucion_educativa;
        $ficha->save();
        return $ficha->id;
    }

    public function BuscarPersonal(Request $request)
    {
        $sql  = '';
        $data = DB::select($sql)->get();
        return response()->json($data->toArray());
    }

    private function saveRol($usuario_id, $rol)
    {
        $rol_user          = RoleUser::firstOrNew(['user_id' => $usuario_id]);
        $rol_user->user_id = $usuario_id;
        $rol_user->role_id = $rol;
        $rol_user->save();
        $us_meto           = new PostUsuariosController();
    }

    private function saveUser($request)
    {
        $documento          = trim(str_replace(array('.', ' ', ','), array('', '', ''), $request['documento']));
        $correo_electronico = trim(strtoupper($request['correo_electronico']));
        $usuario            = User::firstOrNew(['numero_documento' => $documento,'tenantId'=>'312312312']);
        if (is_null($usuario->id))
        {
            $usuario->primer_nombre    = $request['nombre_primero'];
            $usuario->segundo_nombre   = isset($request['nombre_segundo']) ? $request['nombre_segundo'] : '';
            $usuario->primer_apellido  = $request['apellido_primero'];
            $usuario->segundo_apellido = isset($request['apellido_segundo']) ? $request['apellido_segundo'] : '';
            $usuario->numero_documento = $documento;
            $usuario->tipo_documento   = $request['id_documento_tipo'];
            $usuario->direccion        = isset($request['residencia_direccion']) ? $request['residencia_direccion'] : NULL;
            $usuario->fecha_nacimiento = date('Y-m-d', strtotime($request['fecha_nacimiento']));
            $usuario->telefono_movil   = isset($request['telefono_movil']) ? $request['telefono_movil'] : NULL;
            $usuario->telefono_fijo    = isset($request['telefono_fijo']) ? $request['telefono_fijo'] : NULL;
            $usuario->email            = $correo_electronico;
            $usuario->password         = bcrypt($documento);
            $usuario->remember_token   = str_random(50);
            $usuario->tenantId         = '312312312';
            $usuario->save();
        }
        if (isset($request['id_rol']))
        {
            $this->saveRol($usuario->id, $request['id_rol']);
        }
        return $usuario->id;
    }

    private function grupo_poblacional($id_ficha_empleado, $grupo_poblacional)
    {
        if (!is_null($grupo_poblacional))
        {
            foreach ($grupo_poblacional as $id_gen_grupo_poblacional => $value)
            {
                switch ($value)
                {
                    case '0':
                        \App\TblDvEmpleadoXGrupoPoblacional::where('id_gen_grupo_poblacional', '=', $id_gen_grupo_poblacional)->where('id_ficha_empleado', '=', $id_ficha_empleado)->delete();
                        break;
                    case '1':
                        $guardar                           = \App\TblDvEmpleadoXGrupoPoblacional::firstOrNew
                        (
                            ['id_gen_grupo_poblacional' => $id_gen_grupo_poblacional],
                            ['id_ficha_empleado' => $id_ficha_empleado]
                        );
                        $guardar->id_ficha_empleado        = $id_ficha_empleado;
                        $guardar->id_gen_grupo_poblacional = $id_gen_grupo_poblacional;
                        $guardar->save();
                        break;
                }
            }
        }
    }

    private function discapacidades_empleado($id_ficha_empleado, $discapacidades)
    {
        if (!is_null($discapacidades))
        {
            foreach ($discapacidades as $id_discapacidad => $value)
            {
                switch ($value)
                {
                    case '0':
                        \App\TblDvEmpleadoXDiscapacidad::where('id_discapacidad', '=', $id_discapacidad)->where('id_empleado', '=', $id_ficha_empleado)->delete();
                        break;
                    case '1':
                        $guardar                  = \App\TblDvEmpleadoXDiscapacidad::firstOrNew(['id_discapacidad' => $id_discapacidad], ['id_empleado' => $id_ficha_empleado]);
                        $guardar->id_empleado     = $id_ficha_empleado;
                        $guardar->id_discapacidad = $id_discapacidad;
                        $guardar->save();
                        break;
                }
            }
        }
    }

    private function disciplina_empleado($id_ficha_empleado, $disciplinas)
    {
        if (!is_null($disciplinas))
        {
            foreach ($disciplinas as $id_disciplinas => $value)
            {
                switch ($value)
                {
                    case '0':
                        \App\TblDvEmpleadoXDisciplina::where('id_disciplina', '=', $id_disciplinas)->where('id_empleado', '=', $id_ficha_empleado)->delete();
                        break;
                    case '1':
                        $guardar                = \App\TblDvEmpleadoXDisciplina::firstOrNew(['id_disciplina' => $id_disciplinas], ['id_empleado' => $id_ficha_empleado]);
                        $guardar->id_empleado   = $id_ficha_empleado;
                        $guardar->id_disciplina = $id_disciplinas;
                        $guardar->save();
                        break;
                }
            }
        }
    }

    private function comuna_empleado($id_ficha_empleado, $comunas)
    {
        if (!is_null($comunas))
        {
            $sql = 'DELETE FROM  `tbl_dv_empleado_x_comuna` WHERE `id_ficha_empleado` = ? ';
            DB::select($sql, [$id_ficha_empleado]);
            foreach ($comunas as $id_comuna => $value)
            {

                $guardar                    = new \App\TblDvEmpleadoXComuna();
                $guardar->id_ficha_empleado = $id_ficha_empleado;
                $guardar->id_comuna         = $id_comuna;
                $guardar->save();
            }
        }
    }

    public function guardarPersonal(Request $request)
    {
        $id_usuario  = (isset(Auth::user()->id)) ? Auth::user()->id : $this->saveUser($request->input('persona'));
        $persona     = new PostBeneficiariosController();
        $id_persona  = $persona->SavePersona($request->input('persona'));
        $id_empleado = $this->GuardarFichaPersona($id_persona, $id_usuario, $request->input('ficha'));
        return response()->json(['validate' => true, 'msj' => 'Ya se registro el empleado']);
    }

    public function guardarPersonal_usuario(Request $request)//Este es el original
    {
        try
        {
            $id_usuario        = $this->saveUser($request->input('persona'));
            $persona           = new PostBeneficiariosController();
            $id_persona        = $persona->SavePersona($request->input('persona'));
            $id_ficha_empleado = $this->GuardarFichaPersona($id_persona, $id_usuario, $request->input('ficha'));
            $this->grupo_poblacional($id_ficha_empleado, $request->input('grupo_poblacional'));
            $this->discapacidades_empleado($id_ficha_empleado, $request->input('discapacidad'));
            $this->disciplina_empleado($id_ficha_empleado, $request->input('disciplina'));
            $this->comuna_empleado($id_ficha_empleado, $request->input('id_comuna_impacto'));
            return response()->json(['validate' => true, 'msj' => 'Ya se registro el empleado']);
        } catch (Exception $e)
        {
            return response()->json(['validate' => false, 'msj' => $e]);
        }
    }

    public function documento_tipo()
    {
        $data = TblGenDocumentoTipo::select('id', 'descripcion', 'descripcion_2')->orderBy('descripcion')->get();
        return response()->json($data->toArray());
    }
    public function data_persona($documento)
    {
        $sql_persona        = 'SELECT
                  `comunas`.`id` AS `comuna`,
                    `tbl_gen_persona`.`id` AS `id_persona`,
                    `tbl_gen_persona`.`nombre_primero`,
                    `tbl_gen_persona`.`nombre_segundo`,
                    `tbl_gen_persona`.`apellido_primero`,
                    `tbl_gen_persona`.`apellido_segundo`,
                    `tbl_gen_persona`.`documento`,
                    `tbl_gen_persona`.`id_documento_tipo`,
                    `tbl_gen_persona`.`sexo`,
                    date(`tbl_gen_persona`.`fecha_nacimiento`) as `fecha_nacimiento`,
                    `tbl_gen_persona`.`telefono_fijo`,
                    `tbl_gen_persona`.`telefono_movil`,
                    `tbl_gen_persona`.`correo_electronico`,
                    `tbl_gen_persona`.`id_procedencia_pais`,
                    `tbl_gen_persona`.`id_procedencia_departamento`,
                    `tbl_gen_persona`.`id_procedencia_municipio`,
                    `tbl_gen_persona`.`id_residencia_corregimiento`,
                    `tbl_gen_persona`.`id_residencia_barrio`,
                    `tbl_gen_persona`.`id_residencia_vereda`,
                    `tbl_gen_persona`.`residencia_direccion`,
                    `tbl_gen_persona`.`residencia_estrato`,
                    `tbl_gen_persona`.`sangre_tipo`,
                    `tbl_gen_persona`.`id_estado_civil`,
                    `role_user`.`role_id` as id_rol
                         FROM `tbl_gen_persona`
                    LEFT OUTER JOIN `barrios` ON (`tbl_gen_persona`.`id_residencia_barrio` = `barrios`.`id`)
                    LEFT OUTER JOIN `comunas` ON (`barrios`.`comuna_id` = `comunas`.`id`)
                    LEFT OUTER JOIN `users` ON (`tbl_gen_persona`.`documento` = `users`.`numero_documento`)
                    LEFT OUTER JOIN `role_user` ON (`users`.`id` = `role_user`.`user_id`)
                         WHERE
                         `tbl_gen_persona`.`documento`=?';
        $documento          = trim(str_replace([',', '.'], ['', ''], $documento));
        $persona            = DB::select($sql_persona, [$documento]);
        return $persona;
    }
    public function BuscarPorCC(Request $request)
    {
        try
        {
            $documento          = trim(str_replace([',', '.'], ['', ''], $request->input('documento')));
            $sql_persona        = 'SELECT
                  `comunas`.`id` AS `comuna`,
                    `tbl_gen_persona`.`id` AS `id_persona`,
                    `tbl_gen_persona`.`nombre_primero`,
                    `tbl_gen_persona`.`nombre_segundo`,
                    `tbl_gen_persona`.`apellido_primero`,
                    `tbl_gen_persona`.`apellido_segundo`,
                    `tbl_gen_persona`.`documento`,
                    `tbl_gen_persona`.`id_documento_tipo`,
                    `tbl_gen_persona`.`sexo`,
                    date(`tbl_gen_persona`.`fecha_nacimiento`) as `fecha_nacimiento`,
                    `tbl_gen_persona`.`telefono_fijo`,
                    `tbl_gen_persona`.`telefono_movil`,
                    `tbl_gen_persona`.`correo_electronico`,
                    `tbl_gen_persona`.`id_procedencia_pais`,
                    `tbl_gen_persona`.`id_procedencia_departamento`,
                    `tbl_gen_persona`.`id_procedencia_municipio`,
                    `tbl_gen_persona`.`id_residencia_corregimiento`,
                    `tbl_gen_persona`.`id_residencia_barrio`,
                    `tbl_gen_persona`.`id_residencia_vereda`,
                    `tbl_gen_persona`.`residencia_direccion`,
                    `tbl_gen_persona`.`residencia_estrato`,
                    `tbl_gen_persona`.`sangre_tipo`,
                    `tbl_gen_persona`.`id_estado_civil`,
                    `role_user`.`role_id` as id_rol
                         FROM `tbl_gen_persona`
                    LEFT OUTER JOIN `barrios` ON (`tbl_gen_persona`.`id_residencia_barrio` = `barrios`.`id`)
                    LEFT OUTER JOIN `comunas` ON (`barrios`.`comuna_id` = `comunas`.`id`)
                    LEFT OUTER JOIN `users` ON (`tbl_gen_persona`.`documento` = `users`.`numero_documento`)
                    LEFT OUTER JOIN `role_user` ON (`users`.`id` = `role_user`.`user_id`)
                         WHERE
                         `tbl_gen_persona`.`documento`=?';
            $sql_comuna_impacto = 'SELECT
                                `tbl_dv_empleado_x_comuna`.`id_comuna` as `id_comuna_impacto`
                              FROM
                                `tbl_dv_empleado_x_comuna`
                                INNER JOIN `tbl_dv_empleado` ON (`tbl_dv_empleado_x_comuna`.`id_ficha_empleado` = `tbl_dv_empleado`.`id`)
                                INNER JOIN `tbl_gen_persona` ON (`tbl_dv_empleado`.`id_persona` = `tbl_gen_persona`.`id`)
                              WHERE
                              `tbl_gen_persona`.`documento`=?';
            $sql_ficha          = 'SELECT
                        `tbl_dv_empleado`.`id_presupuesto`,
                        `tbl_dv_empleado`.`id_estado_aspirante`,
                        `tbl_dv_empleado`.`id_estado_escolaridad`,
                        `tbl_dv_empleado`.`tiene_hijos`,
                        `tbl_dv_empleado`.`cuantos_hijos`,
                        `tbl_dv_empleado`.`libreta_militar`,
                        `tbl_dv_empleado`.`no_libreta_militar`,
                        `tbl_dv_empleado`.`distrito_militar`,
                        `tbl_dv_empleado`.`skype`,
                        `tbl_dv_empleado`.`id_disponibilidad`,
                        `tbl_dv_empleado`.`foto`,
                        `tbl_dv_empleado`.`profesion`,
                        `tbl_dv_empleado`.`id_disciplina`,
                        `tbl_dv_empleado`.`id_ocupacion`,
                        `tbl_dv_empleado`.`tiene_discapacidad`,
                        `tbl_dv_empleado`.`padece_enfermedad`,
                        `tbl_dv_empleado`.`enfermedad`,
                        `tbl_dv_empleado`.`toma_medicamentos`,
                        `tbl_dv_empleado`.`medicamentos`,
                        `tbl_dv_empleado`.`afiliado_sgsss`,
                        `tbl_dv_empleado`.`id_tipo_afiliacion`,
                        `tbl_dv_empleado`.`id_eps`,
                        `tbl_dv_empleado`.`proyecto_profesional`,
                        `tbl_dv_empleado`.`id_cargo`,
                        `tbl_dv_empleado`.`id_etnia`,
                        `tbl_dv_empleado`.`id_escolaridad_nivel`,
                        `tbl_dv_instituciones_educativas`.`nombre` AS `universidad`
                      FROM
                        `users`
                        INNER JOIN `tbl_dv_empleado` ON (`users`.`id` = `tbl_dv_empleado`.`id_usuario`)
                        LEFT OUTER JOIN `tbl_dv_instituciones_educativas` ON (`tbl_dv_empleado`.`id_institucion_educativa` = `tbl_dv_instituciones_educativas`.`id`)
                        WHERE
                        `users`.`numero_documento`=?';
            $sql_grupo_poblacional='SELECT
                              `tbl_dv_empleado_x_grupo_poblacional`.`id_gen_grupo_poblacional` as id_grupo_poblacional
                            FROM
                              `tbl_dv_empleado_x_grupo_poblacional`
                              INNER JOIN `tbl_dv_empleado` ON (`tbl_dv_empleado_x_grupo_poblacional`.`id_ficha_empleado` = `tbl_dv_empleado`.`id`)
                              INNER JOIN `tbl_gen_persona` ON (`tbl_dv_empleado`.`id_persona` = `tbl_gen_persona`.`id`)
                            WHERE
                               `tbl_gen_persona`.`documento` = ?';
            $sql_discapacidades ='SELECT
                              `tbl_dv_empleado_x_discapacidad`.`id_discapacidad`
                            FROM
                              `tbl_dv_empleado`
                              INNER JOIN `tbl_dv_empleado_x_discapacidad` ON (`tbl_dv_empleado`.`id` = `tbl_dv_empleado_x_discapacidad`.`id_empleado`)
                              INNER JOIN `tbl_gen_persona` ON (`tbl_dv_empleado`.`id_persona` = `tbl_gen_persona`.`id`)
                              WHERE
                                `tbl_gen_persona`.`documento`=?';
            $sql_disciplina='SELECT
              `tbl_dv_empleado_x_disciplina`.`id_disciplina`
            FROM
              `tbl_dv_empleado_x_disciplina`
              INNER JOIN `tbl_dv_empleado` ON (`tbl_dv_empleado_x_disciplina`.`id_empleado` = `tbl_dv_empleado`.`id`)
              INNER JOIN `tbl_gen_persona` ON (`tbl_dv_empleado`.`id_persona` = `tbl_gen_persona`.`id`)
              WHERE
                `tbl_gen_persona`.`documento`=?';
            $persona            = $this->data_persona($documento);
            $ficha              = DB::select($sql_ficha, [$documento]);
            $comuna_impacto     = DB::select($sql_comuna_impacto, [$documento]);
            $grupo_poblacional  = DB::select($sql_grupo_poblacional, [$documento]);
            $discapacidad       = DB::select($sql_discapacidades, [$documento]);
            $disciplina         = DB::select($sql_disciplina, [$documento]);

            return response()->json(
                            ['validate' => (count($persona) > 0),
                                'msj'      => NULL,
                                'data'     => array
                                    (
                                    'disciplina'        =>  (count($disciplina) > 0) ? $disciplina : [],
                                    'discapacidad'      =>  (count($discapacidad) > 0) ? $discapacidad : [],
                                    'grupo_poblacional' =>  (count($grupo_poblacional) > 0) ? $grupo_poblacional : [],
                                    'ciudadano'         =>  (count($persona) > 0) ? $persona[0] : [],
                                    'ficha'             =>  (count($ficha) > 0) ? $ficha[0] : [],
                                    'comunas_impacto'   =>  (count($comuna_impacto) > 0) ? $comuna_impacto : []
                                )
                            ]
            );
        } catch (Exception $e)
        {
            return response()->json(['validate' => false, 'msj' => $e, 'data' => NULL]);
        }
    }

    public function BuscarEmailUsuario(Request $request)
    {
        try
        {
            $data = User::where('email', '=', $request->input('email'))->get();
            return response()->json(['validate' => (count($data->toArray()) > 0), 'msj' => NULL, 'data' => $data->toArray()]);
        } catch (Exception $e)
        {
            return response()->json(['validate' => false, 'msj' => $e, 'data' => NULL]);
        }
    }

}
