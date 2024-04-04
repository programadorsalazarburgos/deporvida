<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Beneficiario;
use Excel;
use DB;
use App\User;
use Auth;

class ItemController extends Controller
{

    /**
     * Display a listing of the resource
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('items');
    }

    public function export()
    {
        $sql='SELECT 
                  `beneficiario_tbl_gen_persona`.`nombre_primero` AS `beneficiario_nombre_primero`,
                  `beneficiario_tbl_gen_persona`.`nombre_segundo` AS `beneficiario_nombre_segundo`,
                  `beneficiario_tbl_gen_persona`.`apellido_primero` AS `beneficiario_apellido_primero`,
                  `beneficiario_tbl_gen_persona`.`apellido_segundo` AS `beneficiario_apellido_segundo`,
                  `beneficiario_tbl_gen_documento_tipo`.`descripcion_2` AS `beneficiario_documento_tipo_abreviatura`,
                  `beneficiario_tbl_gen_documento_tipo`.`descripcion` AS `beneficiario_documento_tipo_nombre`,
                  `beneficiario_tbl_gen_persona`.`documento` AS `beneficiario_documento`,
                  date(`beneficiario_tbl_gen_persona`.`fecha_nacimiento`) AS `beneficiario_fecha_nacimiento`,
                  `beneficiario_tbl_gen_persona`.`telefono_fijo` AS `beneficiario_telefono_fijo`,
                  `beneficiario_tbl_gen_persona`.`telefono_movil` AS `beneficiario_telefono_movil`,
                  `beneficiario_tbl_gen_persona`.`sangre_tipo` AS `beneficiario_sangre_tipo`,
                  `beneficiario_tbl_gen_persona`.`correo_electronico` AS `beneficiario_correo_electronico`,
                  `beneficiario_paises`.`nombre_pais` AS `beneficiario_nombre_pais`,
                  `beneficiario_departamentos`.`nombre_departamento` AS `beneficiario_nombre_departamento`,
                  `beneficiario_municipios`.`nombre_municipio` AS `beneficiario_nombre_municipio`,
                  `beneficiario_tbl_gen_corregimientos`.`descripcion` AS `beneficiario_nombre_corregimiento`,
                  `beneficiario_tbl_gen_veredas`.`nombre` AS `beneficiario_nombre_vereda`,
                  `beneficiario_tbl_gen_persona`.`residencia_direccion` AS `beneficiario_residencia_direccion`,
                  `beneficiario_tbl_gen_persona`.`residencia_estrato` AS `beneficiario_residencia_estrato`,
                  `beneficiario_tbl_gen_corregimientos`.`codigo_unico` AS `beneficiario_codigo_corregimiento`,
                  `acudiente_tbl_gen_persona`.`nombre_primero` AS `acudiente_nombre_primero`,
                  `acudiente_tbl_gen_persona`.`nombre_segundo` AS `acudiente_nombre_segundo`,
                  `acudiente_tbl_gen_persona`.`apellido_primero` AS `acudiente_apellido_primero`,
                  `acudiente_tbl_gen_persona`.`apellido_segundo` AS `acudiente_apellido_segundo`,
                  `acudiente_tbl_gen_documento_tipo`.`descripcion_2` AS `acudiente_documento_tipo_abreviatura`,
                  `acudiente_tbl_gen_documento_tipo`.`descripcion` AS `acudiente_documento_tipo_nombre`,
                  `acudiente_tbl_gen_persona`.`documento` AS `acudiente_documento`,
                  date(`acudiente_tbl_gen_persona`.`fecha_nacimiento`) AS `acudiente_fecha_nacimiento`,
                  `acudiente_tbl_gen_persona`.`telefono_fijo` AS `acudiente_telefono_fijo`,
                  `acudiente_tbl_gen_persona`.`telefono_movil` AS `acudiente_telefono_movil`,
                  `acudiente_tbl_gen_persona`.`sangre_tipo` AS `acudiente_sangre_tipo`,
                  `acudiente_tbl_gen_persona`.`correo_electronico` AS `acudiente_correo_electronico`,
                  `acudiente_paises`.`nombre_pais` AS `acudiente_nombre_pais`,
                  `acudiente_departamentos`.`nombre_departamento` AS `acudiente_nombre_departamento`,
                  `acudiente_municipios`.`nombre_municipio` AS `acudiente_nombre_municipio`,
                  `acudiente_tbl_gen_corregimientos`.`descripcion` AS `acudiente_nombre_corregimiento`,
                  `acudiente_tbl_gen_veredas`.`nombre` AS `acudiente_nombre_vereda`,
                  `acudiente_tbl_gen_persona`.`residencia_direccion` AS `acudiente_residencia_direccion`,
                  `acudiente_tbl_gen_persona`.`residencia_estrato` AS `acudiente_residencia_estrato`,
                  `acudiente_tbl_gen_corregimientos`.`codigo_unico` AS `acudiente_codigo_corregimiento`,
                  `tbl_dv_ficha`.`fecha_registro`,
                  `tbl_dv_ficha`.`enfermedad_padece_si`,
                  `tbl_dv_ficha`.`enfermedad_padece_nombre`,
                  `tbl_dv_ficha`.`medicamentos_toma_si`,
                  `tbl_dv_ficha`.`medicamentos_toma_nombre`,
                  `tbl_dv_ficha`.`fecha_retiro`,
                  `tbl_dv_ficha`.`participacion_anterior_meses`,
                  `tbl_dv_ficha`.`participacion_anterior_annos`,
                  `tbl_dv_ficha`.`toma_medicamentos`,
                  `tbl_dv_ficha`.`tiene_discapacidad`,
                  `tbl_dv_escenarios`.`nombre_escenario`,
                  `tbl_dv_disciplinas`.`descripcion` as disciplina
                FROM
                  `tbl_dv_ficha`
                  LEFT OUTER JOIN `tbl_gen_persona` `beneficiario_tbl_gen_persona` ON (`tbl_dv_ficha`.`id_persona_beneficiario` = `beneficiario_tbl_gen_persona`.`id`)
                  LEFT OUTER JOIN `tbl_gen_documento_tipo` `beneficiario_tbl_gen_documento_tipo` ON (`beneficiario_tbl_gen_persona`.`id_documento_tipo` = `beneficiario_tbl_gen_documento_tipo`.`id`)
                  LEFT OUTER JOIN `paises` `beneficiario_paises` ON (`beneficiario_tbl_gen_persona`.`id_procedencia_pais` = `beneficiario_paises`.`id`)
                  LEFT OUTER JOIN `departamentos` `beneficiario_departamentos` ON (`beneficiario_tbl_gen_persona`.`id_procedencia_departamento` = `beneficiario_departamentos`.`id`)
                  LEFT OUTER JOIN `municipios` `beneficiario_municipios` ON (`beneficiario_tbl_gen_persona`.`id_procedencia_municipio` = `beneficiario_municipios`.`id`)
                  LEFT OUTER JOIN `tbl_gen_corregimientos` `beneficiario_tbl_gen_corregimientos` ON (`beneficiario_tbl_gen_persona`.`id_residencia_corregimiento` = `beneficiario_tbl_gen_corregimientos`.`id`)
                  LEFT OUTER JOIN `tbl_gen_veredas` `beneficiario_tbl_gen_veredas` ON (`beneficiario_tbl_gen_persona`.`id_residencia_vereda` = `beneficiario_tbl_gen_veredas`.`id`)
                  LEFT OUTER JOIN `tbl_gen_estado_civil` `beneficiario_tbl_gen_estado_civil` ON (`beneficiario_tbl_gen_persona`.`id_estado_civil` = `beneficiario_tbl_gen_estado_civil`.`id`)
                  LEFT OUTER JOIN `tbl_gen_persona` `acudiente_tbl_gen_persona` ON (`tbl_dv_ficha`.`id_persona_acudiente` = `acudiente_tbl_gen_persona`.`id`)
                  LEFT OUTER JOIN `tbl_gen_documento_tipo` `acudiente_tbl_gen_documento_tipo` ON (`acudiente_tbl_gen_persona`.`id_documento_tipo` = `acudiente_tbl_gen_documento_tipo`.`id`)
                  LEFT OUTER JOIN `paises` `acudiente_paises` ON (`acudiente_tbl_gen_persona`.`id_procedencia_pais` = `acudiente_paises`.`id`)
                  LEFT OUTER JOIN `municipios` `acudiente_municipios` ON (`acudiente_tbl_gen_persona`.`id_procedencia_municipio` = `acudiente_municipios`.`id`)
                  LEFT OUTER JOIN `departamentos` `acudiente_departamentos` ON (`acudiente_tbl_gen_persona`.`id_procedencia_departamento` = `acudiente_departamentos`.`id`)
                  LEFT OUTER JOIN `tbl_gen_corregimientos` `acudiente_tbl_gen_corregimientos` ON (`acudiente_tbl_gen_persona`.`id_residencia_corregimiento` = `acudiente_tbl_gen_corregimientos`.`id`)
                  LEFT OUTER JOIN `tbl_gen_veredas` `acudiente_tbl_gen_veredas` ON (`acudiente_tbl_gen_persona`.`id_residencia_vereda` = `acudiente_tbl_gen_veredas`.`id`)
                  LEFT OUTER JOIN `tbl_gen_estado_civil` `acudiente_tbl_gen_estado_civil` ON (`acudiente_tbl_gen_persona`.`id_estado_civil` = `acudiente_tbl_gen_estado_civil`.`id`)
                  INNER JOIN `tbl_dv_grupos` ON (`tbl_dv_ficha`.`id_grupo` = `tbl_dv_grupos`.`id`)
                  INNER JOIN `tbl_dv_escenarios` ON (`tbl_dv_grupos`.`id_escenario` = `tbl_dv_escenarios`.`id`)
                  INNER JOIN `tbl_dv_disciplinas` ON (`tbl_dv_grupos`.`id_disciplina` = `tbl_dv_disciplinas`.`id`)
                GROUP BY
                  tbl_dv_ficha.id_persona_beneficiario
                ORDER BY
                  `beneficiario_tbl_gen_persona`.`apellido_primero`,
                  `beneficiario_tbl_gen_persona`.`apellido_segundo`,
                  `beneficiario_tbl_gen_persona`.`nombre_primero`,
                  `beneficiario_tbl_gen_persona`.`nombre_segundo`';
        $data = DB::select($sql,[]);
        $items = json_decode(json_encode($data), true);
        Excel::create('items', function($excel) use($items)
        {
            $excel->sheet('ExportFile', function($sheet) use($items)
            {
                $sheet->fromArray($items);
            });
        })->export('xls');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Responsee
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function postreporteUsuarios()
    {


      $data = User::select(
      	  'tbl_gen_persona.fecha_nacimiento',
          'tbl_gen_documento_tipo.descripcion as tipo_documento',
         'users.numero_documento', 
         'roles.name as nombre_rol',
         'tbl_dv_presupuesto.descripcion as presupuesto',
         'tbl_dv_estado_aspirante.descripcion as estado_aspirante',
         'tbl_gen_persona.nombre_primero as primer_nombre',
          'tbl_gen_persona.nombre_segundo as segundo_nombre', 
          'tbl_gen_persona.apellido_primero as primer_apellido', 
          'tbl_gen_persona.apellido_segundo as segundo_apellido',
           'users.email', 
           'users.telefono_movil',
            'users.direccion',
           'tbl_dv_estado_aspirante.descripcion as estado_aspirante',
            'tbl_dv_empleado_cargo.descripcion as empleado_cargo',
            DB::raw('group_concat(comunas.codigo_comuna) as comunas'),
            'paises.nombre_pais',
            'departamentos.nombre_departamento',
            'municipios.nombre_municipio',
            'tbl_gen_corregimientos.descripcion as corregimiento',
            'tbl_gen_veredas.nombre as vereda',
            'comuna_barrios.nombre_comuna as comuna_residencia',
            'barrios.nombre_barrio as barrio',
            'tbl_gen_persona.residencia_estrato',
            'tbl_gen_persona.direccion_residencia',
            'tbl_gen_escolaridad_nivel.descripcion as nivel_escolaridad',
            'tbl_gen_escolaridad_estado.descripcion as estado_escolaridad',
            'tbl_dv_empleado.profesion',
            'tbl_dv_instituciones_educativas.nombre as institucion_educativa',
            'tbl_gen_ocupacion.descripcion as ocupacion',
            'tbl_gen_estado_civil.descripcion as estado_civil',

            DB::raw('(CASE WHEN (tbl_dv_empleado.tiene_hijos = 1) THEN "Si" ELSE "No" END) as tiene_hijos'),
            'tbl_dv_empleado.cuantos_hijos',
            'tbl_gen_etnia.descripcion as etnia',
            DB::raw('(CASE WHEN (tbl_dv_empleado.padece_enfermedad = 1) THEN "Si" ELSE "No" END) as padece_enfermedad'),
            'tbl_dv_empleado.enfermedad',
            DB::raw('(CASE WHEN (tbl_dv_empleado.toma_medicamentos = 1) THEN "Si" ELSE "No" END) as toma_medicamentos'
),
            'tbl_dv_empleado.medicamentos',

            'tbl_gen_persona.sangre_tipo',
            DB::raw('(CASE WHEN (tbl_dv_empleado.tiene_discapacidad = 1) THEN "Si" ELSE "No" END) as tiene_discapacidad',
            '(CASE WHEN (tbl_dv_empleado.afiliado_sgsss = 1) THEN "Si" ELSE "No" END) as afiliado_sgsss'
),

            'tbl_gen_eps.descripcion as eps',
            'tbl_dv_empleado.libreta_militar',
            'tbl_dv_empleado.no_libreta_militar',
            'tbl_dv_empleado.distrito_militar',
            'tbl_dv_empleado.skype',
            'tbl_dv_empleado.proyecto_profesional')

        ->leftjoin('tbl_gen_documento_tipo', 'users.tipo_documento', '=', 'tbl_gen_documento_tipo.id')
        ->leftjoin('role_user', 'users.id', '=', 'role_user.user_id')
        ->leftjoin('roles', 'role_user.role_id', '=', 'roles.id')
        ->leftjoin('tbl_dv_empleado', 'users.id', '=', 'tbl_dv_empleado.id_usuario')
        ->leftjoin('tbl_dv_presupuesto', 'tbl_dv_empleado.id_presupuesto', '=', 'tbl_dv_presupuesto.id')
        ->leftjoin('tbl_dv_estado_aspirante', 'tbl_dv_empleado.id_estado_aspirante', '=', 'tbl_dv_estado_aspirante.id')


        ->leftjoin('tbl_gen_persona', 'tbl_dv_empleado.id_persona', '=', 'tbl_gen_persona.id')
        ->leftjoin('tbl_dv_empleado_x_comuna', 'tbl_dv_empleado.id', '=', 'tbl_dv_empleado_x_comuna.id_ficha_empleado')
        ->leftjoin('comunas', 'tbl_dv_empleado_x_comuna.id_comuna', '=', 'comunas.id')
      

        ->leftjoin('paises', 'tbl_gen_persona.id_procedencia_pais', '=', 'paises.id')
        ->leftjoin('departamentos', 'tbl_gen_persona.id_procedencia_departamento', '=', 'departamentos.id')
        ->leftjoin('municipios', 'tbl_gen_persona.id_procedencia_municipio', '=', 'municipios.id')
        ->leftjoin('tbl_gen_corregimientos', 'tbl_gen_persona.id_residencia_corregimiento', '=', 'tbl_gen_corregimientos.id')
        ->leftjoin('tbl_gen_veredas', 'tbl_gen_persona.id_residencia_vereda', '=', 'tbl_gen_veredas.id')
        ->leftjoin('barrios', 'tbl_gen_persona.id_residencia_barrio', '=', 'barrios.id')
        ->leftjoin('comunas as comuna_barrios', 'barrios.comuna_id', '=', 'comuna_barrios.id')
      



        ->leftjoin('tbl_gen_escolaridad_nivel', 'tbl_dv_empleado.id_escolaridad_nivel', '=', 'tbl_gen_escolaridad_nivel.id')

         ->leftjoin('tbl_gen_escolaridad_estado', 'tbl_dv_empleado.id_estado_escolaridad', '=', 'tbl_gen_escolaridad_estado.id')


        ->leftjoin('tbl_dv_empleado_cargo', 'tbl_dv_empleado.id_cargo', '=', 'tbl_dv_empleado_cargo.id')
        ->leftjoin('tbl_dv_instituciones_educativas', 'tbl_dv_empleado.id_institucion_educativa', '=', 'tbl_dv_instituciones_educativas.id')
        ->leftjoin('tbl_gen_ocupacion', 'tbl_dv_empleado.id_ocupacion', '=', 'tbl_gen_ocupacion.id')
        ->leftjoin('tbl_gen_estado_civil', 'tbl_gen_persona.id_estado_civil', '=', 'tbl_gen_estado_civil.id')
        ->leftjoin('tbl_gen_etnia', 'tbl_dv_empleado.id_etnia', '=', 'tbl_gen_etnia.id')
        ->leftjoin('tbl_gen_eps', 'tbl_dv_empleado.id_tipo_afiliacion', '=', 'tbl_gen_eps.id')
      
        ->where('users.tenantId', '=', Auth::user()->tenantId)
        ->groupBy('users.numero_documento')

        ->get();


        return response()->json(
        $data
      );
  

    }

}
