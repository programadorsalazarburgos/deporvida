<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Programa;
use DateTime;
use DB;
use App\Models\TblGenDocumentoTipo;
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
use App\Models\TblDvPersonaXOcupacion;
use App\Models\TblGenEscolaridadEstado;
use App\Models\TblDvPersonaXDiscapacidad;
use App\Models\TblGenPersonaXGrupoPoblacional;

class HomeController extends Controller
{

    public function __construct()
    {
        
    }

    private function validar_ficha_empleado()
    {
        $data1    = DB::select('SELECT 
                `tbl_dv_empleado`.`nuevo` as validar
              FROM
                `tbl_dv_empleado`
              WHERE
                `tbl_dv_empleado`.`id_usuario` = ?
                 AND `tbl_dv_empleado`.`nuevo`=1', [Auth::user()->id]);
        $Personal = new PostPersonalController();
        $sql      = 'SELECT 
                  `tbl_gen_persona`.`id`,
                  `tbl_gen_persona`.`nombre_primero`,
                  `tbl_gen_persona`.`nombre_segundo`,
                  `tbl_gen_persona`.`apellido_primero`,
                  `tbl_gen_persona`.`apellido_segundo`,
                  `tbl_gen_persona`.`documento`,
                  `tbl_gen_persona`.`id_documento_tipo`,
                  `tbl_gen_persona`.`sexo`,
                  `tbl_gen_persona`.`fecha_nacimiento`,
                  `tbl_gen_persona`.`telefono_fijo`,
                  `tbl_gen_persona`.`telefono_movil`,
                  `tbl_gen_persona`.`correo_electronico`,
                  `tbl_gen_persona`.`id_procedencia_pais`,
                  `tbl_gen_persona`.`id_procedencia_municipio`,
                  `tbl_gen_persona`.`id_procedencia_departamento`,
                  `tbl_gen_persona`.`id_residencia_corregimiento`,
                  `tbl_gen_persona`.`id_residencia_barrio`,
                  `tbl_gen_persona`.`id_residencia_vereda`,
                  `tbl_gen_persona`.`residencia_direccion`,
                  `tbl_gen_persona`.`residencia_estrato`,
                  `tbl_gen_persona`.`sangre_tipo`,
                  `tbl_gen_persona`.`id_estado_civil`,
                  `tbl_dv_empleado`.`id_tipo_afiliacion`,
                  `tbl_dv_empleado`.`nuevo`
                FROM
                  `tbl_dv_empleado`
                  INNER JOIN `tbl_gen_persona` ON (`tbl_dv_empleado`.`id_persona` = `tbl_gen_persona`.`id`)
                  WHERE
                  `tbl_dv_empleado`.`id_usuario`=?';
        $data     = DB::select($sql, [Auth::user()->id]);
        if (count($data) > 0)
        {
            $data = (json_decode(json_encode($data[0]), True));
            extract($data);
            if (isset($data1[0]))
            {
                if ($data1[0]->validar == 0)
                {
                    return view("personal.user");
                } else
                {
                    return view("personal.user")->with($Personal->viewFichaUsuario(FALSE, $data['id'], $data['nombre_primero'], $data['nombre_segundo'], $data['apellido_primero'], $data['apellido_segundo'], $data['documento'], $data['id_documento_tipo'], $data['sexo'], $data['fecha_nacimiento'], $data['telefono_fijo'], $data['telefono_movil'], $data['correo_electronico'], $data['id_procedencia_pais'], $data['id_procedencia_municipio'], $data['id_procedencia_departamento'], $data['id_residencia_corregimiento'], $data['id_residencia_barrio'], $data['id_residencia_vereda'], $data['residencia_direccion'], $data['residencia_estrato'], $data['sangre_tipo'], $data['id_estado_civil'], $data['nuevo'],$data['id_tipo_afiliacion']));
                }
            } else
            {
                return view("personal.user")->with($Personal->viewFichaUsuario(FALSE, $data['id'], $data['nombre_primero'], $data['nombre_segundo'], $data['apellido_primero'], $data['apellido_segundo'], $data['documento'], $data['id_documento_tipo'], $data['sexo'], $data['fecha_nacimiento'], $data['telefono_fijo'], $data['telefono_movil'], $data['correo_electronico'], $data['id_procedencia_pais'], $data['id_procedencia_municipio'], $data['id_procedencia_departamento'], $data['id_residencia_corregimiento'], $data['id_residencia_barrio'], $data['id_residencia_vereda'], $data['residencia_direccion'], $data['residencia_estrato'], $data['sangre_tipo'], $data['id_estado_civil'], $data['nuevo'],$data['id_tipo_afiliacion']));
            }
        } else
        {
            return view("personal.user")->with($Personal->viewFichaUsuario());
        }
    }

    public function vista()
    {
        $view = null;
        if (is_null(Auth::user()))
        {
            $view = view("auth.login");
        } 
        else
        {
            $view = view("georeferenciacion.index");
        }
        return $view;
    }
    public function fichaempleado()
    {
      return $this->validar_ficha_empleado();

    }
    public function index()
    {
        $programas = Programa::all();
        return view("welcome", compact('programas'));
    }

    public function ObtenerProgramas()
    {
        $programas = Programa::all();
        return response()->json($programas->toArray());
    }

    public function DescripcionPrograma($id)
    {
        $descripcion = Programa::select('programas.id', 'programas.nombre_programa', 'programas.descripcion_programa', 'programas.image')->where('programas.id', '=', $id)->firstOrfail();
        return response()->json($descripcion->toArray());
    }

}
