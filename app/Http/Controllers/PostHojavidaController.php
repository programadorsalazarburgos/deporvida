<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Http\Requests;
use App\Eps;
use response;
use App\Models\TblGenPais;
use App\Models\TblGenIdiomas;
use App\Models\TblDvHojaVida;
use App\Models\TblDvHojaVidaIdiomas;
use App\Models\TblGenEscolaridadNivel;
use App\Models\TblGenTitulosAcademicos;
use App\Models\TblDvHojaVidaExperiencia;
use App\Models\TblDvHojaVidaEstudioNoFormal;
use App\Models\TblDvHojaVidaEstudioProfesional;
use App\Models\TblDvHojaVidaExperienciaTipo;
use App\Models\TblGenPersona;
use Dompdf\Dompdf;

class PostHojavidaController extends Controller
{



#EXAMPLE#
    public function example(Request $request)
    {
        $order=$request->input('order');
        $limit=$request->input('length');
        $offset=$request->input('start');
        $name=$request->input('search');$name=$name['value'];
        $Res=array();
        $column=($order[0]['column']+1);
        $dir=$order[0]['dir'];
        $total=TblGenPersona
                ::select(DB::raw('count(*) as total'))
                ->take($limit)
                ->orWhere('nombre_primero', 'like', '%' . $name . '%')
                ->orWhere('nombre_segundo', 'like', '%' . $name . '%')
                ->orWhere('apellido_primero', 'like', '%' . $name . '%')
                ->orWhere('apellido_segundo', 'like', '%' . $name . '%')
                ->orWhere('documento', 'like', '%' . $name . '%')
                ->orWhere('fecha_nacimiento', 'like', '%' . $name . '%')
                ->first();
        $Res['draw']=(int)$request->input('draw');
        $Res['recordsTotal']=$total->total;
        $Res['recordsFiltered']=$total->total;
        $Res['data']=TblGenPersona
        ::select
        (
            DB::raw('TRIM(CONCAT_WS(" ",nombre_primero,nombre_segundo,apellido_primero,apellido_segundo)) as nombres'),            
            DB::raw('format(documento,0,\'de_DE\') as documento'),
            DB::raw('date(fecha_nacimiento) as fecha_nacimiento'),
            'id'
        )
        ->orWhere('nombre_primero', 'like', '%' . $name . '%')
        ->orWhere('nombre_segundo', 'like', '%' . $name . '%')
        ->orWhere('apellido_primero', 'like', '%' . $name . '%')
        ->orWhere('apellido_segundo', 'like', '%' . $name . '%')
        ->orWhere('documento', 'like', '%' . $name . '%')
        ->orWhere('fecha_nacimiento', 'like', '%' . $name . '%')
        ->orderBy(DB::raw($column,$dir))
        ->skip($offset)
        ->take($limit)
        ->get();
        return json_encode($Res,128);
    }
#EXAMPLE#

















    private $url_directory;
    public function __construct()
    {
        $ds = DIRECTORY_SEPARATOR;
        $this->url_directory = dirname(__FILE__) . $ds . '..' . $ds . '..' . $ds . '..' . $ds . 'public' . $ds;
    }

    public function filemanager($id)
    {
        return view("hojavida.file")->with(['id' => $id]);
    }
    private function documentos($id_user)
    {
        $data=TblDvHojaVida::where('id_usuario','=',$id_user)->first();
        return (isset($data->archivos))?$data->archivos:'[]';
        
    }

    private function documento_identidad()
    {
        $hojas_vida=TblDvHojaVida::all();
        $msj=[];
        $ds=DIRECTORY_SEPARATOR;
        foreach($hojas_vida as $temp)
        {

            $temp2=array();
            $temp4=array();
            $url_archivos='hojasvidas'.$ds.$temp->id_usuario.$ds.'otros'.$ds;
            if(file_exists ($url_archivos))
            {
                $files=scandir ($url_archivos);
                foreach($files as $temp3)
                {
                    if($temp3!='.'&&$temp3!='..')
                    {
                        $temp4[]=['nombre'=>($temp3),'url'=>$url_archivos.$temp3];

                    }
                }
                if(count($temp4)>0)
                {
                    $temp2[]=$temp4;
                }
            }
            if(count($temp4)>0)
            {
                $update = TblDvHojaVida::firstOrNew(['id_usuario' => $temp->id_usuario]);
                $update->archivos=json_encode($temp4);
                $update->save();
                $msj=($update->archivos);
                unset($update);
            }
        }
        return $msj; 
    }
    public function validar_documentos()
    {
       return $this->documento_identidad();
    }
    public function mihojavida()
    {
        $id = Auth::user()->id;
        $hojavida = $this->searchhojavidauser($id);
        if ($hojavida)
        {
            $id = $hojavida->id;
            $observacion = $hojavida->observacion;
            $estudios = $this->searchestudios($id);
            $cursos = $this->searchcursos($id);
            $experiencia = $this->searchexperiencia($id);
            $idiomas = $this->searchidiomas($id);
            $id_usuario = $hojavida->id_usuario;

            return json_encode([
                'validate' => true,
                'data' =>
                [
                    'id'=>$id,
                    'estudios' => $estudios,
                    'cursos' => $cursos,
                    'experiencia' => $experiencia,
                    'idiomas' => $idiomas,
                    'documentos'=>$this->documentos(Auth::user()->id)
                ]
                    ], 128);
        }
        else
        {
            return json_encode(['validate' => false, 'data' => NULL]);
        }
    }

    public function delete(Request $request)
    {
        $id = $request->input('id');
        if (!is_null($id))
        {
            switch ($request->input('tipo'))
            {
                case 'data_estudios':
                    $borrar = TblDvHojaVidaEstudioProfesional::where('id','=',$id)->delete();

                    break;
                case 'data_estudios_no_formales':
                    $borrar = TblDvHojaVidaEstudioNoFormal::where('id','=',$id)->delete();
                    break;
                case 'data_experiencia_profesional':
                    $borrar = TblDvHojaVidaExperiencia::where('id','=',$id)->delete();
                    break;
            }
        }   
    }
    public function deletefile(Request $request)
    {
        $id=$request->input('id');
        $tipo=$request->input('tipo');
        $url=$request->input('key');

        $archivos=NULL;
        switch ($tipo)
        {
            case 'estudios':
                $archivos=TblDvHojaVidaEstudioProfesional::where('id','=',$id)->firstOrFail();
            break;
            case 'curso':
                $archivos=TblDvHojaVidaEstudioNoFormal::where('id','=',$id)->firstOrFail();
            break;
            case 'experiencia':
                $archivos=TblDvHojaVidaExperiencia::where('id','=',$id)->firstOrFail();
            break;
            case 'documentos':
                $archivos=TblDvHojaVida::where('id','=',$id)->firstOrFail();
            break;

        }
        $files=(json_decode($archivos['archivos'],true));
        if(!is_null($files))
        {

            $key = array_search($url, array_column($files, 'url'));
            if($key!==FALSE)
            {
                if(unlink($files[$key]['url']))
                {
                    unset($files[$key]);
                    $temp=[];
                    foreach($files as $temp2)
                    {
                        $temp[]=$temp2;
                    }
                    $files=$temp;
                    $archivos->archivos=json_encode($files);
                    $archivos->Save();
                    return json_encode(['validate'=>true]);
                }
                else
                {
                    echo 'El servidor no ha permitido eliminar este archivo.';
                }
            }
            else
            {
                return 'No se ha encontrado el registro. Por favor contacte con el administrador del sistema';
            }
        }
        else
        {
                return 'No se encontro el registro. Por favor contacte con el administrador del sistema';
        }
    }
    public function vista()
    {
       
            return view("hojavida.create")->with([
                    'idiomas' => TblGenIdiomas::all(),
                    'paises' => TblGenPais::all(),
                    'nivel_educativo' => TblGenEscolaridadNivel::all(),
                    'titulos'=>TblGenTitulosAcademicos::OrderBy('descripcion')->get(),
                    'experiencia_tipo'=>TblDvHojaVidaExperienciaTipo::all(),
            ]);
       
    }

    public function listado()
    {
        return view("hojavida.index");
    }

    public function index()
    {
        $sql = 'SELECT 
                  `tbl_dv_hoja_vida`.`id` AS hoja_vida,
                  `tbl_dv_hoja_vida`.`id_usuario` AS `id`,
                  `tbl_dv_empleado`.`id` AS `id_empleado`,
                  `tbl_gen_persona`.`nombre_primero`,
                  `tbl_gen_persona`.`nombre_segundo`,
                  `tbl_gen_persona`.`apellido_primero`,
                  `tbl_gen_persona`.`apellido_segundo`,
                  `tbl_gen_persona`.`documento`,
                  COALESCE(`tbl_dv_estado_aspirante`.`descripcion`,"-") AS `estado`,
                  `tbl_dv_hoja_vida`.`fecha_registro`,
                  COALESCE(GROUP_CONCAT(`comunas`.`codigo_comuna`),\'-\') AS `comunas`,
                  COALESCE(`roles`.`name`,"-") AS `rol`,
                  `tbl_dv_empleado_cargo`.`descripcion` as estado_cargo
                FROM
                  `tbl_dv_hoja_vida`
                  LEFT OUTER JOIN `tbl_dv_hoja_vida_estado_contrato` ON (`tbl_dv_hoja_vida`.`id_hoja_vida_estado_contrato` = `tbl_dv_hoja_vida_estado_contrato`.`id`)
                  LEFT OUTER JOIN `tbl_dv_empleado` ON (`tbl_dv_hoja_vida`.`id_usuario` = `tbl_dv_empleado`.`id_usuario`)
                  LEFT OUTER JOIN `tbl_gen_persona` ON (`tbl_dv_empleado`.`id_persona` = `tbl_gen_persona`.`id`)
                  LEFT OUTER JOIN `tbl_dv_empleado_x_comuna` ON (`tbl_dv_empleado`.`id` = `tbl_dv_empleado_x_comuna`.`id_ficha_empleado`)
                  LEFT OUTER JOIN `comunas` ON (`tbl_dv_empleado_x_comuna`.`id_comuna` = `comunas`.`id`)
                  LEFT OUTER JOIN `role_user` ON (`tbl_dv_empleado`.`id_usuario` = `role_user`.`user_id`)
                  LEFT OUTER JOIN `roles` ON (`role_user`.`role_id` = `roles`.`id`)
                  LEFT OUTER JOIN `tbl_dv_estado_aspirante` ON (`tbl_dv_empleado`.`id_estado_aspirante` = `tbl_dv_estado_aspirante`.`id`)
                  LEFT OUTER JOIN `tbl_dv_empleado_cargo` ON (`tbl_dv_empleado`.`id_cargo` = `tbl_dv_empleado_cargo`.`id`)
                GROUP BY
                  `tbl_dv_empleado`.`id`
                ORDER BY
                  `tbl_dv_hoja_vida`.`fecha_registro` DESC';
        $HojaVida = DB::select($sql, []);
        return response()->json(['validate' => true, 'data' => $HojaVida]);
    }

    private function estadosaspirante()
    {
        $sql = '  SELECT 
				  `tbl_dv_estado_aspirante`.`id`,
				  `tbl_dv_estado_aspirante`.`descripcion`
				FROM
				  `tbl_dv_estado_aspirante`
				ORDER BY
				  `tbl_dv_estado_aspirante`.`orden`';
        $data = DB::select($sql, []);
        return $data;
    }

    public function saveobservaciones(Request $request)
    {
        try
        {
            $TblDvHojaVida = TblDvHojaVida::where('id_usuario', '=', $request->input('id'))->firstOrFail();
            $TblDvHojaVida->observacion = $request->input('observaciones');
            $TblDvHojaVida->id_hoja_vida_estado_contrato = $request->input('id_estado_aspirante');
            $TblDvHojaVida->Save();
            echo json_encode(['validate' => true, 'msj' => 'Guardado con exito']);
        }
        catch (Exception $e)
        {
            echo json_encode(['validate' => false, 'msj' => $e]);
        }
    }

    //INICIANDO VER HOJA VIDA
    public function view_hojavida($id)
    {

        try
        {
            $estudios = [];
            $cursos = [];
            $experiencia = [];
            $estadosaspirante = [];
            $idestadosaspirante = '';
            $idiomas = [];
            $observacion = '';
            $url = 'elfinder/elfinder.php';
            $id_usuario = NULL;
            $hojavida = $this->searchhojavida($id);
            if ($hojavida)
            {
                $id = $hojavida->id;
                $estadosaspirante = $this->estadosaspirante();
                $idestadosaspirante = $hojavida->id_hoja_vida_estado_contrato;
                $observacion = $hojavida->observacion;
                $estudios = $this->searchestudios($id);
                $cursos = $this->searchcursos($id);
                $experiencia = $this->searchexperiencia($id);
                $idiomas = $this->searchidiomasuser($id);
                $id_usuario = $hojavida->id_usuario;
                $url.='?user=' . $id_usuario;
            }
            return view("hojavida.search")->with([
                        'observacion' => $observacion,
                        'estadosaspirante' => $estadosaspirante,
                        'idestadosaspirante' => $idestadosaspirante,
                        'hojavida' => $hojavida,
                        'estudios' => $estudios,
                        'cursos' => $cursos,
                        'experiencia' => $experiencia,
                        'idiomas' => $idiomas,
                        'url' => $url,
                        'id' => $id_usuario
            ]);
        }
        catch (Exception $e)
        {
            echo json_encode(['validate' => false, 'id' => NULL, 'msj' => $e]);
        }
    }

    private function searchhojavida($id)
    {
        $sql = 'SELECT 
            `tbl_dv_hoja_vida`.`id`,
            `tbl_dv_hoja_vida`.`id_usuario`,
            `tbl_dv_hoja_vida`.`fecha_registro`,
            `tbl_dv_hoja_vida`.`id_hoja_vida_estado_contrato`,
            `tbl_dv_hoja_vida`.`observacion`,
            UPPER(`users`.`primer_nombre`) AS `primer_nombre`,
            UPPER(`users`.`segundo_nombre`) AS `segundo_nombre`,
            UPPER(`users`.`primer_apellido`) AS `primer_apellido`,
            UPPER(`users`.`segundo_apellido`) AS `segundo_apellido`,
            UPPER(`users`.`email`) AS `correo`,
            FORMAT(`users`.`numero_documento`,0) AS `numero_documento`,
            `users`.`fecha_nacimiento`,
            `users`.`tipo_documento`,
            `users`.`telefono_movil`,
            `users`.`telefono_fijo`,
            `tbl_gen_documento_tipo`.`descripcion` AS `documento_tipo`,
            `tbl_gen_persona`.`residencia_direccion`,
            UPPER(`municipios`.`nombre_municipio`) AS `nombre_municipio`,
            UPPER(`departamentos`.`nombre_departamento`) AS `nombre_departamento`,
            UPPER(`paises`.`nombre_pais`) AS `nombre_pais`,
            UPPER(`tbl_gen_estado_civil`.`descripcion`) AS `estado_civil`
      FROM
            `tbl_dv_hoja_vida`
            `tbl_dv_hoja_vida`
        INNER JOIN `users` ON (`tbl_dv_hoja_vida`.`id_usuario` = `users`.`id`)
        INNER JOIN `tbl_gen_documento_tipo` ON (`users`.`tipo_documento` = `tbl_gen_documento_tipo`.`id`)
        INNER JOIN `tbl_dv_empleado` ON (`users`.`id` = `tbl_dv_empleado`.`id_usuario`)
        INNER JOIN `tbl_gen_persona` ON (`tbl_dv_empleado`.`id_persona` = `tbl_gen_persona`.`id`)
        LEFT JOIN `municipios` ON (`tbl_gen_persona`.`id_procedencia_municipio` = `municipios`.`id`)
        LEFT JOIN `departamentos` ON (`tbl_gen_persona`.`id_procedencia_departamento` = `departamentos`.`id`)
        INNER JOIN `paises` ON (`tbl_gen_persona`.`id_procedencia_pais` = `paises`.`id`)
        LEFT JOIN `tbl_gen_estado_civil` ON (`tbl_gen_persona`.`id_estado_civil` = `tbl_gen_estado_civil`.`id`)
      WHERE
            `tbl_dv_hoja_vida`.`id` = ?';
        $data = DB::select($sql, [$id]);
        return isset($data[0]) ? $data[0] : false;
    }
    private function searchhojavidauser($id)
    {
        $sql = 'SELECT 
            `tbl_dv_hoja_vida`.`id`,
            `tbl_dv_hoja_vida`.`id_usuario`,
            `tbl_dv_hoja_vida`.`fecha_registro`,
            `tbl_dv_hoja_vida`.`id_hoja_vida_estado_contrato`,
            `tbl_dv_hoja_vida`.`observacion`,
            UPPER(`users`.`primer_nombre`) AS `primer_nombre`,
            UPPER(`users`.`segundo_nombre`) AS `segundo_nombre`,
            UPPER(`users`.`primer_apellido`) AS `primer_apellido`,
            UPPER(`users`.`segundo_apellido`) AS `segundo_apellido`,
            UPPER(`users`.`email`) AS `correo`,
            FORMAT(`users`.`numero_documento`,0) AS `numero_documento`,
            `users`.`fecha_nacimiento`,
            `users`.`tipo_documento`,
            `users`.`telefono_movil`,
            `users`.`telefono_fijo`,
            `tbl_gen_documento_tipo`.`descripcion` AS `documento_tipo`,
            `tbl_gen_persona`.`residencia_direccion`,
            UPPER(`municipios`.`nombre_municipio`) AS `nombre_municipio`,
            UPPER(`departamentos`.`nombre_departamento`) AS `nombre_departamento`,
            UPPER(`paises`.`nombre_pais`) AS `nombre_pais`,
            UPPER(`tbl_gen_estado_civil`.`descripcion`) AS `estado_civil`
      FROM
            `tbl_dv_hoja_vida`
            `tbl_dv_hoja_vida`
        LEFT JOIN `users` ON (`tbl_dv_hoja_vida`.`id_usuario` = `users`.`id`)
        LEFT JOIN `tbl_gen_documento_tipo` ON (`users`.`tipo_documento` = `tbl_gen_documento_tipo`.`id`)
        LEFT JOIN `tbl_dv_empleado` ON (`users`.`id` = `tbl_dv_empleado`.`id_usuario`)
        LEFT JOIN `tbl_gen_persona` ON (`tbl_dv_empleado`.`id_persona` = `tbl_gen_persona`.`id`)
        LEFT JOIN `municipios` ON (`tbl_gen_persona`.`id_procedencia_municipio` = `municipios`.`id`)
        LEFT JOIN `departamentos` ON (`tbl_gen_persona`.`id_procedencia_departamento` = `departamentos`.`id`)
        LEFT JOIN `paises` ON (`tbl_gen_persona`.`id_procedencia_pais` = `paises`.`id`)
        LEFT JOIN `tbl_gen_estado_civil` ON (`tbl_gen_persona`.`id_estado_civil` = `tbl_gen_estado_civil`.`id`)
      WHERE
            `users`.`id` = ?';
        $data = DB::select($sql, [$id]);
        return isset($data[0]) ? $data[0] : false;
    }

    private function searchestudios($id)
    {
        $sql = 'SELECT 
			  `tbl_dv_hoja_vida_estudio_profesional`.`id`,
              `tbl_dv_hoja_vida_estudio_profesional`.`archivos`,
			  `tbl_dv_hoja_vida_estudio_profesional`.`estado_estudio`,
			  `tbl_dv_instituciones_educativas`.`nombre` as institucion_educativo,
              `tbl_gen_titulos_academicos`.`descripcion` as carrera,
			  `tbl_gen_titulos_academicos`.`id` as id_carrera,
			  `tbl_dv_hoja_vida_estudio_profesional`.`fecha_grado`,
			  `tbl_dv_hoja_vida_estudio_profesional`.`tarjeta_profesional`,
			  `tbl_dv_hoja_vida_estudio_profesional`.`estudio_estado`,
			  `tbl_dv_hoja_vida_estudio_profesional`.`horario_clases`,
			  `tbl_gen_escolaridad_nivel`.`descripcion` as nivel_escolaridad,
			  `tbl_dv_hoja_vida_estudio_profesional`.`id_gen_escolaridad_nivel`,
			  `paises`.`nombre_pais`,
			  `paises`.`id` as id_pais
			FROM
			  `tbl_dv_hoja_vida_estudio_profesional`
			  INNER JOIN `tbl_gen_escolaridad_nivel` ON (`tbl_dv_hoja_vida_estudio_profesional`.`id_gen_escolaridad_nivel` = `tbl_gen_escolaridad_nivel`.`id`)
			  INNER JOIN `paises` ON (`tbl_dv_hoja_vida_estudio_profesional`.`id_pais` = `paises`.`id`)
			  INNER JOIN `tbl_dv_instituciones_educativas` ON (`tbl_dv_hoja_vida_estudio_profesional`.`id_institucion_educativo` = `tbl_dv_instituciones_educativas`.`id`)
              INNER JOIN `tbl_gen_titulos_academicos` ON (`tbl_dv_hoja_vida_estudio_profesional`.`id_titulos_academicos` = `tbl_gen_titulos_academicos`.`id`)
			  WHERE
			    `tbl_dv_hoja_vida_estudio_profesional`.`id_hoja_vida`=?';
        $data = DB::select($sql, [$id]);
        return $data;
    }

    private function searchcursos($id)
    {
        $sql = 'SELECT
			  `tbl_dv_hoja_vida_estudio_no_formal`.`id`,	 
			  `tbl_dv_instituciones_educativas`.`nombre` as institucion_educativo,
			  `tbl_dv_hoja_vida_estudio_no_formal`.`horas_cursadas`,
			  `tbl_dv_hoja_vida_estudio_no_formal`.`curso_tipo`,
              `tbl_dv_hoja_vida_estudio_no_formal`.`titulo`,
			  `tbl_dv_hoja_vida_estudio_no_formal`.`archivos`
			FROM
			  `tbl_dv_instituciones_educativas`
			INNER JOIN `tbl_dv_hoja_vida_estudio_no_formal` ON (`tbl_dv_instituciones_educativas`.`id` = `tbl_dv_hoja_vida_estudio_no_formal`.`id_institucion_educativo`)
			  WHERE
			  `tbl_dv_hoja_vida_estudio_no_formal`.`id_hoja_vida`=?';

        $data = DB::select($sql, [$id]);
        return $data;
    }

    private function searchexperiencia($id)
    {
        $sql = 'SELECT
			  `tbl_dv_hoja_vida_experiencia`.`id`, 
			  `tbl_dv_hoja_vida_experiencia`.`empresa`,
			  `tbl_dv_hoja_vida_experiencia`.`jefe_inmediato`,
			  `tbl_dv_hoja_vida_experiencia`.`direccion`,
			  `tbl_dv_hoja_vida_experiencia`.`telefono`,
			  `tbl_dv_hoja_vida_experiencia`.`cargo`,
			  `tbl_dv_hoja_vida_experiencia`.`correo_empresa`,
			  `tbl_dv_hoja_vida_experiencia`.`fecha_ingreso`,
			  `tbl_dv_hoja_vida_experiencia`.`fecha_retiro`,
			  `tbl_dv_hoja_vida_experiencia`.`tipo_experiencia`,
              `tbl_dv_hoja_vida_experiencia`.`archivos`
			FROM
			  	`tbl_dv_hoja_vida_experiencia`
			  WHERE
				`tbl_dv_hoja_vida_experiencia`.`id_hoja_vida`=?';
        $data = DB::select($sql, [$id]);
        return $data;
    }

    private function searchidiomas($id)
    {
        $sql = 'SELECT 
                `tbl_gen_idiomas`.`id`,
                `tbl_gen_idiomas`.`descripcion` as nombre_idioma
            FROM
                `tbl_dv_hoja_vida_idiomas`
            INNER JOIN 
                `tbl_gen_idiomas` ON (`tbl_dv_hoja_vida_idiomas`.`id_idioma` = `tbl_gen_idiomas`.`id`)
            WHERE
                `tbl_dv_hoja_vida_idiomas`.`id_hoja_vida`=?
            GROUP BY
                `tbl_gen_idiomas`.`id`';
        $data = DB::select($sql, [$id]);
        $res=array();
        foreach($data as $temp)
        {
            $res[]=$temp->id;
        }
        return $res;
    }
    private function searchidiomasuser($id)
    {
        $sql = 'SELECT 
                `tbl_gen_idiomas`.`id`,
                `tbl_gen_idiomas`.`descripcion` as nombre_idioma
            FROM
                `tbl_dv_hoja_vida_idiomas`
            INNER JOIN 
                `tbl_gen_idiomas` ON (`tbl_dv_hoja_vida_idiomas`.`id_idioma` = `tbl_gen_idiomas`.`id`)
            WHERE
                `tbl_dv_hoja_vida_idiomas`.`id_hoja_vida`=?
            GROUP BY
                `tbl_gen_idiomas`.`id`';
        $data = DB::select($sql, [$id]);
        return json_encode($data);
    }

    //FINALIZANDO VER HOJA VIDA
    private function subirarchivo($file, $dir_subida)
    {
        if (!file_exists($dir_subida))
        {
            mkdir($dir_subida, 0777, true);
        }
        $fichero_subido = $dir_subida . basename($file['fichero_usuario']['name']);
        $valido = (move_uploaded_file($file['fichero_usuario']['tmp_name'], $fichero_subido));
        $fichero_subido = str_replace($this->url_directory, '', $fichero_subido);
        return[
            'validate' => $valido,
            'file' => $file['fichero_usuario']['name'],
            'url' => $fichero_subido,
        ];
    }

    private function urlfies($id)
    {
        $ds = DIRECTORY_SEPARATOR;
        $urlfies = $this->url_directory . 'hojasvidas' . $ds . Auth::user()->id . $ds;
        return $urlfies;
    }

    private function files($data, $id)
    {
        $data_files = [];
        $ds = DIRECTORY_SEPARATOR;
        $urlfies = $this->urlfies($id);
        foreach (isset($data['experiencia']["name"]) ? $data['experiencia']["name"] : [] as $key => $temp)
        {
            foreach ($temp as $key2 => $temp2)
            {
                $file = array();
                $file['fichero_usuario']['name'] = ($data['experiencia']["name"][$key][$key2]['empresa_documentos']);
                $file['fichero_usuario']['tmp_name'] = ($data['experiencia']["tmp_name"][$key][$key2]['empresa_documentos']);
                $urlfiesexperiencia = $urlfies . 'experiencia' . $ds;
                $res = $this->subirarchivo($file, $urlfiesexperiencia);
            }
        }

        foreach (isset($data['estudios']["name"]) ? $data['estudios']["name"] : [] as $key => $temp)
        {
            foreach ($temp as $key2 => $temp2)
            {
                $file = array();
                $file['fichero_usuario']['name'] = ($data['estudios']["name"][$key][$key2]['documentos']);
                $file['fichero_usuario']['tmp_name'] = ($data['estudios']["tmp_name"][$key][$key2]['documentos']);
                $urlfiesestudios = $urlfies . 'estudios' . $ds;
                $res = $this->subirarchivo($file, $urlfiesestudios);
            }
        }
        foreach (isset($data['cursos']["name"]) ? $data['cursos']["name"] : [] as $key => $temp)
        {
            foreach ($temp as $key2 => $temp2)
            {
                $file = array();
                $file['fichero_usuario']['name'] = ($data['cursos']["name"][$key][$key2]['documentos']);
                $file['fichero_usuario']['tmp_name'] = ($data['cursos']["tmp_name"][$key][$key2]['documentos']);
                $urlfiescursos = $urlfies . 'cursos' . $ds;
                $res = $this->subirarchivo($file, $urlfiescursos);
            }
        }
    }
    private function archivo($id,$archivo)
    {
        $files=[];
        $urlfies = $this->urlfies($id);
        $ds = DIRECTORY_SEPARATOR;
        if(isset($archivo['other']))
        {
            for($i=0;$i<count($archivo['other']['name']);$i++)
            {
                $file = array();
                $file['fichero_usuario']['name'] = ($archivo['other']['name'][$i]);
                $file['fichero_usuario']['tmp_name'] = ($archivo['other']["tmp_name"][$i]);
                $urlfiescursos = $urlfies . 'otros' . $ds;
                $res = $this->subirarchivo($file, $urlfiescursos);
                $files[]=[
                    'nombre'=>$res['file'],
                    'url'=>$res['url']
                ];
            }
        }
        $save = TblDvHojaVida::where('id','=',$id)->firstOrFail();
        $files_old=(is_null($save->archivos))?array():(json_decode($save->archivos));
        foreach($files as $temp)
        {
            $files_old[]=$temp;
        }
        $save->archivos = json_encode($files_old);
        $save->save();
        return $files;
    }
    //INICIANDO GUARDANDO
    public function save(Request $request)
    {


        if(isset(Auth::user()->id))
        {
            $res = $this->hojavida();
            $id = $res['id'];
            $id_usuario = $res['id_user'];
            $id_cursos = NULL;
            $id_experiencia = NULL;
            $id_estudios = NULL;
            
            if(!is_null($request->input('estudios')))
            {

                $id_estudios = $this->estudios($request->input('estudios'), $id, $_FILES['estudios']);
            }

            if(!is_null($request->input('cursos')))
            {
                $id_cursos = $this->cursos($request->input('cursos'), $id, $_FILES['cursos']);
            }

            if(!is_null($request->input('experiencia')))
            {
                $id_experiencia = $this->experiencia($request->input('experiencia'), $id, $_FILES['experiencia']);
            }


            $id_idiomas = $this->idiomas($request->input('idiomas'), $id); 
            
            $this->archivo($id,$_FILES);

            echo json_encode(['validate' => true, 'data' => ['id'=>$id,'id_estudios'=>$id_estudios,'id_cursos'=>$id_cursos,'id_experiencia'=>$id_experiencia,'id_idiomas'=>$id_idiomas], 'msj' => NULL]); 
        }
        else
        {
            echo json_encode(['validate' => false,'data'=>[],'msj' => NULL]);
        }
    }

    private function eliminar($id_estudios, $id_cursos, $id_experiencia, $id_idiomas)
    {
        
    }

    private function hojavida()
    {
        $save = TblDvHojaVida::firstOrNew(['id_usuario' => Auth::user()->id]);
        $save->id_usuario = Auth::user()->id;
        $save->fecha_registro = date('Y-m-d');
        $save->Save();
        return ['validate'=>true,'id_user' => "{$save->id_usuario}", 'id' => "{$save->id}"];
    }

    private function estudios($estudios, $id, $files)
    {
        $ids = array();
        $urlfies = $this->urlfies($id);
        if (!is_null($estudios))
        {
            $inst = new PostInstitucionesEducativasController();
            foreach ($estudios as $key => $temp)
            {
                $archivos = [];
                foreach ($files["tmp_name"]['documentos'][$key] as $key2 => $temp2) 
                {
                    $file['fichero_usuario']['tmp_name'] = ($files["tmp_name"]['documentos'][$key][$key2]);
                    $file['fichero_usuario']['name'] = ($files["name"]['documentos'][$key][$key2]);
                    $urlfiesestudios = $urlfies . 'estudios' . DIRECTORY_SEPARATOR;
                    $temp0 = $this->subirarchivo($file, $urlfiesestudios);
                    if ($temp0['validate'])
                    {
                        $archivos[] = ['nombre' => $temp0['file'], 'url' => $temp0['url']];
                    }
                }
                $id_institucion_educativo = $inst->id_search_institucion_educativa_x_nombre($temp['institucion_educativo']);
                if (is_null($temp['id']))
                {
                    $data = new TblDvHojaVidaEstudioProfesional();
                }
                else
                {
                    $data = TblDvHojaVidaEstudioProfesional::firstOrNew(['id' => $temp['id']]);
                }
                $data->id_hoja_vida = $id;
                $data->estado_estudio = $temp['estado_estudio'];
                $data->id_institucion_educativo = $id_institucion_educativo;
                $data->id_titulos_academicos = $temp['carrera'];
                $data->id_gen_escolaridad_nivel = $temp['nivel_educativo'];
                $data->fecha_grado = $temp['fecha_grado'];
                $data->id_pais = $temp['pais_grado'];
                $data->tarjeta_profesional = $temp['tarjeta_profesional'];
                $data->estudio_estado = $temp['estado_estudio'];
                $data->horario_clases = $temp['horario_clases'];
                if(count($archivos)>0)
                {
                    $data_extraer=json_decode($data->archivos,true);
                    foreach($archivos as $temporal)
                    {
                        $data_extraer[]=$temporal;
                    }
                    $archivos=($data_extraer);
                    $data->archivos = json_encode($archivos);
                }
                $data->Save();
                $ids[] = $temp['id'];
            }
        }
        return $ids;
    }

    private function cursos($cursos, $id, $files)
    {
        $ids = [];
        $archivos = [];
        $urlfies = $this->urlfies($id);
        if (!is_null($cursos))
        {
            $inst = new PostInstitucionesEducativasController();
            foreach ($cursos as $key => $temp)
            {
                if(isset($files["tmp_name"]['documentos'][$key]))
                {
                    foreach ($files["tmp_name"]['documentos'][$key] as $key2 => $temp2) 
                    {
                        $file['fichero_usuario']['tmp_name'] = ($files["tmp_name"]['documentos'][$key][$key2]);
                        $file['fichero_usuario']['name'] = ($files["name"]['documentos'][$key][$key2]);
                        $urlfiesexperiencia = $urlfies . 'cursos' . DIRECTORY_SEPARATOR;
                        $temp0 = $this->subirarchivo($file, $urlfiesexperiencia);
                        if ($temp0['validate'])
                        {
                            $archivos[] = ['nombre' => $temp0['file'], 'url' => $temp0['url']];
                        }
                    }
                }
                $id_institucion_educativo = $inst->id_search_institucion_educativa_x_nombre($temp['institucion_educativo']);
                if (is_null($temp['id']))
                {
                    $data = new TblDvHojaVidaEstudioNoFormal();
                }
                else
                {
                    $data = TblDvHojaVidaEstudioNoFormal::firstOrNew(['id' => $temp['id']]);
                }
                $data->id_hoja_vida = $id;
                $data->id_institucion_educativo = $id_institucion_educativo;
                $data->horas_cursadas = $temp['horas'];
                $data->curso_tipo = $temp['curso_tipo'];
                $data->titulo = strtoupper(trim($temp['titulo']));
                if(count($archivos)>0)
                {
                    $data->archivos = json_encode($archivos);
                    $archivos = [];
                }
                $data->Save();
                $ids[] = $data->id;
            }
        }
        return $ids;
    }

    private function experiencia($experiencia, $id, $files)
    {
        $ids = [];
        $archivos = [];
        $urlfies = $this->urlfies($id);
        if (!is_null($experiencia))
        {
            foreach ($experiencia as $key => $temp)
            {
               
                foreach ($files["tmp_name"]['empresa_documentos'][$key] as $key2 => $temp2) 
                {
                    $file['fichero_usuario']['tmp_name'] = ($files["tmp_name"]['empresa_documentos'][$key][$key2]);
                    $file['fichero_usuario']['name'] = ($files["name"]['empresa_documentos'][$key][$key2]);
                    $urlfiesexperiencia = $urlfies . 'experiencia' . DIRECTORY_SEPARATOR;
                    $temp0 = $this->subirarchivo($file, $urlfiesexperiencia);
                    if ($temp0['validate'])
                    {
                        $archivos[] = ['nombre' => $temp0['file'], 'url' => $temp0['url']];
                    }
                }
                if (is_null($temp['id']))
                {
                    $data = new TblDvHojaVidaExperiencia();
                }
                else
                {
                    $data = TblDvHojaVidaExperiencia::firstOrNew(['id' => $temp['id']]);
                }
                $data->id_hoja_vida = $id;
                $data->empresa = $temp['empresa_nombre'];
                $data->jefe_inmediato = $temp['empresa_jefe_nombre'];
                $data->direccion = $temp['empresa_direccion'];
                $data->telefono = $temp['empresa_telefono'];
                $data->cargo = $temp['empresa_cargo'];
                $data->correo_empresa = $temp['empresa_correo'];
                $data->fecha_ingreso = $temp['empresa_fecha_ingreso'];
                $data->fecha_retiro = $temp['empresa_fecha_retiro'];
                $data->tipo_experiencia = isset($temp['empresa_experiencia_tipo'])?$temp['empresa_experiencia_tipo']:NULL;
                if(count($archivos)>0)
                {
                    $data->archivos = json_encode($archivos);
                    $archivos = [];
                }
                $data->Save();
                $ids[] = $temp['id'];
            }
        }
        return $ids;
    }

    private function idiomas($idiomas, $id)
    {
        $ids = [];
        if (!is_null($idiomas))
        {
            foreach ($idiomas as $key => $temp)
            {
                $data = TblDvHojaVidaIdiomas::firstOrNew(['id_hoja_vida' => $id, 'id_idioma' => $temp]);
                $data->id_hoja_vida = $id;
                $data->id_idioma = $temp;
                $data->Save();
                $ids[] = $data->id;
            }
        }
        return $ids;
    }

    //Finalizando GUARDANDO
    private function borrar_experiencia()
    {
        $sql='SELECT 
  GROUP_CONCAT(`tbl_dv_hoja_vida_experiencia`.`id`) as `ids`
FROM
  `tbl_dv_hoja_vida`
  INNER JOIN `tbl_dv_hoja_vida_experiencia` ON (`tbl_dv_hoja_vida`.`id` = `tbl_dv_hoja_vida_experiencia`.`id_hoja_vida`)
GROUP BY
  `tbl_dv_hoja_vida_experiencia`.`id_hoja_vida`,
  `tbl_dv_hoja_vida_experiencia`.`empresa`,
  `tbl_dv_hoja_vida_experiencia`.`jefe_inmediato`,
  `tbl_dv_hoja_vida_experiencia`.`direccion`,
  `tbl_dv_hoja_vida_experiencia`.`telefono`,
  `tbl_dv_hoja_vida_experiencia`.`cargo`,
  `tbl_dv_hoja_vida_experiencia`.`correo_empresa`,
  `tbl_dv_hoja_vida_experiencia`.`fecha_ingreso`,
  `tbl_dv_hoja_vida_experiencia`.`fecha_retiro`,
  `tbl_dv_hoja_vida_experiencia`.`tipo_experiencia`,
  `tbl_dv_hoja_vida_experiencia`.`archivos`
HAVING
  COUNT(*) > 1';
        $data=DB::select($sql);
        if(count($data)>0)
        {
            foreach($data as $temp)
            {
                $ids=explode(',', $temp->ids);
                unset($ids[0]);
                foreach($ids as $id)
                {
                    $del= TblDvHojaVidaExperiencia::find($id);
                    $del->delete();
                }
            }
        }
    }
    private function borrar_cursos()
    {
         $sql='SELECT 

    GROUP_CONCAT(`tbl_dv_hoja_vida_estudio_no_formal`.`id`) as ids
FROM
  `tbl_dv_hoja_vida_estudio_no_formal`
  INNER JOIN `tbl_dv_hoja_vida` ON (`tbl_dv_hoja_vida_estudio_no_formal`.`id_hoja_vida` = `tbl_dv_hoja_vida`.`id`)
GROUP BY
  `tbl_dv_hoja_vida_estudio_no_formal`.`id_hoja_vida`,
  `tbl_dv_hoja_vida_estudio_no_formal`.`id_institucion_educativo`,
  `tbl_dv_hoja_vida_estudio_no_formal`.`horas_cursadas`,
  `tbl_dv_hoja_vida_estudio_no_formal`.`curso_tipo`,
  `tbl_dv_hoja_vida_estudio_no_formal`.`titulo`,
  `tbl_dv_hoja_vida_estudio_no_formal`.`archivos`
HAVING
  COUNT(*) > 1';
        $data=DB::select($sql);
        if(count($data)>0)
        {
            foreach($data as $temp)
            {
                $ids=explode(',', $temp->ids);
                unset($ids[0]);
                foreach($ids as $id)
                {
                    $del= TblDvHojaVidaEstudioNoFormal::find($id);
                    $del->delete();
                }
            }
        }
    }
    private function borrar_carreras()
    {
         $sql='SELECT 
  GROUP_CONCAT(`tbl_dv_hoja_vida_estudio_profesional`.`id`) AS `ids`
FROM
  `tbl_dv_hoja_vida`
  INNER JOIN `tbl_dv_hoja_vida_estudio_profesional` ON (`tbl_dv_hoja_vida`.`id_usuario` = `tbl_dv_hoja_vida_estudio_profesional`.`id_hoja_vida`)
GROUP BY
  `tbl_dv_hoja_vida_estudio_profesional`.`id_hoja_vida`,
  `tbl_dv_hoja_vida_estudio_profesional`.`id_institucion_educativo`,
  `tbl_dv_hoja_vida_estudio_profesional`.`archivos`,
  `tbl_dv_hoja_vida_estudio_profesional`.`estudio_estado`,
  `tbl_dv_hoja_vida_estudio_profesional`.`estado_estudio`,
  `tbl_dv_hoja_vida_estudio_profesional`.`id_titulos_academicos`,
  `tbl_dv_hoja_vida_estudio_profesional`.`id_gen_escolaridad_nivel`,
  `tbl_dv_hoja_vida_estudio_profesional`.`id_pais`,
  `tbl_dv_hoja_vida_estudio_profesional`.`fecha_grado`,
  `tbl_dv_hoja_vida_estudio_profesional`.`horario_clases`,
  `tbl_dv_hoja_vida_estudio_profesional`.`tarjeta_profesional`
HAVING
  COUNT(*) > 1';
        $data=DB::select($sql);
        if(count($data)>0)
        {
            foreach($data as $temp)
            {
                $ids=explode(',', $temp->ids);
                unset($ids[0]);
                foreach($ids as $id)
                {
                    $del = TblDvHojaVidaEstudioProfesional::find($id);
                    $del->delete();
                }
            }
        }
       
    }
    public function borrarndorepetidos()
    {
        $this->borrar_carreras();
        $this->borrar_cursos();
        $this->borrar_experiencia();
        return response()->json(['validate'=>true]);
    }
    public function imp($id)
    {
            $hojavida = $this->searchhojavida($id);
            if ($hojavida)
            {
                $id = $hojavida->id;
                $estadosaspirante = $this->estadosaspirante();
                $idestadosaspirante = $hojavida->id_hoja_vida_estado_contrato;
                $observacion = $hojavida->observacion;
                $estudios = $this->searchestudios($id);
                $cursos = $this->searchcursos($id);
                $experiencia = $this->searchexperiencia($id);
                $idiomas = $this->searchidiomasuser($id);
                $id_usuario = $hojavida->id_usuario;
                $datos=[
                    'observacion' => $observacion,
                    'estadosaspirante' => $estadosaspirante,
                    'idestadosaspirante' => $idestadosaspirante,
                    'hojavida' => $hojavida,
                    'estudios' => $estudios,
                    'cursos' => $cursos,
                    'experiencia' => $experiencia,
                    'idiomas' => $idiomas,
                    'id' => $id_usuario
                ];
                $view =  view('hojavida.imp')->with($datos)->render();
                //echo $view;exit;
                $dompdf = new Dompdf();
                $dompdf->loadHtml($view);
                #format footer
                $dompdf->getCanvas()->page_text(490, 728, "Pagina: {PAGE_NUM} de {PAGE_COUNT}", 3, 10, array(0,0,0));
                //$dompdf->getCanvas()->page_text(57, 715, "Este documento es propiedad de la Administración Central del Municipio de Santiago de Cali. Prohibida su", 3, 10, array(0,0,0));
                //$dompdf->getCanvas()->page_text(57, 728, "alteración o modificación por cualquier medio, sin previa autorización del Alcalde.", 3, 10, array(0,0,0));
                #format footer
                $dompdf->setPaper('letter');
                $dompdf->render();
                $dompdf->stream('file.pdf' , array( 'Attachment'=>0 ));
            }
            else
            {
                abort(404);
            }
    }
}
