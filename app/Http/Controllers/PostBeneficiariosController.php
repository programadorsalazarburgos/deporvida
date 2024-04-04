<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Beneficiario;
use App\Programa;
use App\PoblacionalBeneficiario;
use App\RoleUser;
use App\Grupo;
use App\Models\TblGenEp;
use App\Models\TblDvFicha;
use App\Models\TblGenPais;
use App\Models\TblDvConfig;
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
use App\Models\TblGenDocumentoTipo;
use App\Models\TblGenEscolaridadNivel;
use App\Models\TblGenGrupoPoblacional;
use App\Models\ClubesDeportivos;
use App\Models\TblDvPersonaXOcupacion;
use App\Models\TblGenEscolaridadEstado;
use App\Models\TblDvPersonaXDiscapacidad;
use App\Models\TblGenPersonaXGrupoPoblacional;
use response;

class PostBeneficiariosController extends Controller
{

    public function __construct()
    {


//    $this->middleware('permission:ver-roles', ['only' => 'vista']);
    }

    public function desactivar(Request $request)
    {

      
        try
        {
            $ficha = TblDvFicha::where('id','=',(int)$request->ficha)->firstOrFail();
            $ficha->vinculado=0;
            $ficha->fecha_retiro=date('Y-m-d');
            $ficha->id_motivo=(int)$request->motivo;
            $ficha->save();
            echo json_encode(['validate' => true, 'msj' => '']);
        } catch (Exception $e)
        {
            echo json_encode(['validate' => false, 'msj' => $e]);
        }
    }

    public function SavePersona($data,$permitir_change_documento=false)
    {


        if ($data['nombre_segundo'] == null) {
            $nombre_segundo = '';
        }

        else
        {
            $nombre_segundo = $data['nombre_segundo'];
        }

        if (isset($data['id_residencia_vereda']))
        {
            if (!is_numeric($data['id_residencia_vereda']))
            {
                $data['id_residencia_vereda'] = NULL;
            }
        }
        $data['documento'] = str_replace(',', '', $data['documento']);
        if (isset($data['id_persona']))
        {
            $persona = TblGenPersona::firstOrNew(array('id' => $data['id_persona']));
        } 
        else
        {
            $persona = TblGenPersona::firstOrNew(array('documento' => $data['documento']));
        }
        if ($permitir_change_documento)
        {
            $persona->documento=$data['documento'];
        }
        $persona->nombre_primero              = (isset($data['nombre_primero'])) ? strtoupper($data['nombre_primero']) : strtoupper($persona->nombre_primero);

        $persona->nombre_segundo              = $nombre_segundo;


        $persona->apellido_primero            = (isset($data['apellido_primero'])) ? strtoupper($data['apellido_primero']) : strtoupper($persona->apellido_primero);
        $persona->apellido_segundo            = (isset($data['apellido_segundo'])) ? strtoupper($data['apellido_segundo']) : strtoupper($persona->apellido_segundo);
        $persona->documento                   = (isset($data['documento'])) ? strtoupper($data['documento']) : strtoupper($persona->documento);
        $persona->id_documento_tipo           = (isset($data['id_documento_tipo'])) ? $data['id_documento_tipo'] : $persona->id_documento_tipo;
        $persona->id_procedencia_pais         = (isset($data['id_procedencia_pais'])) ? $data['id_procedencia_pais'] : $persona->id_procedencia_pais;
        $persona->id_procedencia_municipio    = (isset($data['id_procedencia_municipio'])) ? $data['id_procedencia_municipio'] : $persona->id_procedencia_municipio;
		$persona->otro_municipio    = (isset($data['other_municipio_nombre'])) ? $data['other_municipio_nombre'] : $persona->other_municipio_nombre;
		
        $persona->id_procedencia_departamento = (isset($data['id_procedencia_departamento'])) ? $data['id_procedencia_departamento'] : $persona->id_procedencia_departamento;
        $persona->id_residencia_corregimiento = (isset($data['id_residencia_corregimiento'])) ? $data['id_residencia_corregimiento'] : $persona->id_residencia_corregimiento;
        $persona->id_residencia_barrio        = (isset($data['id_residencia_barrio'])) ? $data['id_residencia_barrio'] : $persona->id_residencia_barrio;
        $persona->id_residencia_vereda        = (isset($data['id_residencia_vereda'])) ? $data['id_residencia_vereda'] : $persona->id_residencia_vereda;
        $persona->id_estado_civil             = (isset($data['id_estado_civil'])) ? $data['id_estado_civil'] : $persona->id_estado_civil;
        $persona->sexo                        = (isset($data['sexo'])) ? $data['sexo'] : $persona->sexo;
		$persona->sexo_acudiente_otro         = (isset($data['sexo_acudiente_otro'])) ? $data['sexo_acudiente_otro'] : $persona->sexo_acudiente_otro;
		
		$persona->tipo_genero_r = (isset($data['tipo_genero_r'])?$data['tipo_genero_r']:$persona->tipo_genero_r);
		$persona->tipo_orientacion_sexual = (isset($data['tipo_orientacion_sexual'])?$data['tipo_orientacion_sexual']:$persona->tipo_orientacion_sexual);
		$persona->orientacion_sexual_otro = (isset($data['orientacion_sexual_otro'])?$data['orientacion_sexual_otro']:$persona->orientacion_sexual_otro);
       
        $persona->fecha_nacimiento            = 
        (isset($data['fecha_nacimiento']) ) 
        ?
        	(($data['fecha_nacimiento']=='')?NULL:trim($data['fecha_nacimiento'])) 
        :
        	$persona->fecha_nacimiento;


        $persona->telefono_fijo               = (isset($data['telefono_fijo'])) ? strtoupper($data['telefono_fijo']) : strtoupper($persona->telefono_fijo);
        $persona->telefono_movil              = (isset($data['telefono_movil'])) ? strtoupper($data['telefono_movil']) : strtoupper($persona->telefono_movil);
        $persona->correo_electronico          = (isset($data['correo_electronico'])) ? strtoupper($data['correo_electronico']) : strtoupper($persona->correo_electronico);
        $persona->residencia_direccion        = (isset($data['residencia_direccion'])) ? strtoupper($data['residencia_direccion']) : strtoupper($persona->residencia_direccion);
        $persona->residencia_estrato          = (isset($data['residencia_estrato'])) ? strtoupper($data['residencia_estrato']) : strtoupper($persona->residencia_estrato);
        $persona->sangre_tipo                 = (isset($data['sangre_tipo'])) ? strtoupper($data['sangre_tipo']) : $persona->sangre_tipo;
        $persona->Save();
        return $persona->id;
    }

    private function searchPersonaFicha($id_persona)
    {
        $sql = 'SELECT 
				  `tbl_dv_ficha`.`id`,
				  `tbl_dv_ficha`.`fecha_registro`,
				  `tbl_dv_ficha`.`id_persona_beneficiario`,
				  `tbl_dv_ficha`.`id_escolaridad_nivel`,
				  `tbl_dv_ficha`.`id_escolaridad_estado` as id_estado_escolaridad,
				  `tbl_dv_ficha`.`id_etnia`,
				  `tbl_dv_ficha`.`id_persona_acudiente`,
				  `tbl_dv_ficha`.`id_persona_acudiente_parentesco`,
				  `tbl_dv_ficha`.`id_persona_vive_con_parentesco`,
				  `tbl_dv_ficha`.`enfermedad_padece_si`,
				  `tbl_dv_ficha`.`enfermedad_padece_nombre`,
    			  `tbl_dv_ficha`.`medicamentos_toma_si`,
				  `tbl_dv_ficha`.`medicamentos_toma_nombre`,
				  `tbl_dv_ficha`.`salud_afiliado`,
				  `tbl_dv_ficha`.`id_salud_regimen`,
				  `tbl_dv_ficha`.`id_eps`,
				  `tbl_gen_persona`.`documento`,
                  `tbl_dv_ficha`.`grupo_poblacional_otro`,
				  `tbl_dv_ficha`.`grupo_poblacional_club`,
				  `tbl_dv_ficha`.`condicion_discapacidad_otro`,
				  
                  `tbl_dv_ficha`.`participacion_anterior_meses`,
                  `tbl_dv_ficha`.`id_ocupacion`,
                  `tbl_dv_ficha`.`participacion_anterior_annos`,
                  `tbl_dv_ficha`.`persona_vive_con_parentesco_otro`,
                  `tbl_dv_ficha`.`persona_acudiente_parentesco_otro`,
                  `tbl_dv_ficha`.`se_reconoce_como_cual`,
                  `tbl_dv_ficha`.`id_ocupacion`,
                  `tbl_dv_ficha`.`tiene_discapacidad`,
                  `tbl_dv_ficha`.`toma_medicamentos`,
                  `tbl_dv_ficha`.`id_salud_regimen`
				FROM
				  `tbl_dv_ficha`
				  LEFT OUTER JOIN `tbl_gen_persona` ON (`tbl_dv_ficha`.`id_persona_acudiente` = `tbl_gen_persona`.`id`)
				WHERE
				  `tbl_dv_ficha`.`id_persona_beneficiario` = ?
				ORDER BY 
				   `tbl_dv_ficha`.`id` DESC
				LIMIT 1';
        $res = DB::select($sql, array($id_persona));
        if (count($res) > 0)
        {
            return $res[0];
        } else
        {
            return null;
        }
    }
    private function SearchBeneficiarioFicha($data,$id_grupo,$id_ficha)
    {
        $id_persona_beneficiario=(isset($data['id_persona_beneficiario'])) ? $data['id_persona_beneficiario'] : null;
        $ficha = TblDvFicha::firstOrNew(['id'=>$id_ficha]);
        if(is_null($ficha->id_ficha))
        {
            $ficha=TblDvFicha::firstOrNew(['id_persona_beneficiario'=>$id_persona_beneficiario,'id_grupo'=>$id_grupo,'vinculado'=>1]);
        }
        return $ficha;
    }
    private function insertficha($data, $id_grupo,$id_ficha, $grupo_poblacional)
    {
        $ficha=$this->SearchBeneficiarioFicha($data,$id_grupo,$id_ficha);
        if(is_null($ficha->id))
        {
            $ficha->fecha_registro                  = date('Y-m-d H:i:s');
        }
		
        $ficha->id_grupo                        = $id_grupo;
        $ficha->id_persona_beneficiario         = (isset($data['id_persona_beneficiario'])) ? $data['id_persona_beneficiario'] : null;
        $ficha->toma_medicamentos            = (isset($data['toma_medicamentos'])) ? $data['toma_medicamentos'] : null;
        $ficha->id_escolaridad_nivel            = (isset($data['id_escolaridad_nivel'])) ? $data['id_escolaridad_nivel'] : null;
        $ficha->id_ocupacion                    = (isset($data['id_ocupacion'])) ? $data['id_ocupacion'] : null;
        $ficha->tiene_discapacidad              = (isset($data['tiene_discapacidad'])) ? $data['tiene_discapacidad'] : null;
        $ficha->id_escolaridad_estado           = (isset($data['id_escolaridad_estado'])) ? $data['id_escolaridad_estado'] : null;
        $ficha->id_etnia                        = (isset($data['id_etnia'])) ? $data['id_etnia'] : null;
        $ficha->id_persona_acudiente            = (isset($data['id_persona_acudiente'])) ? $data['id_persona_acudiente'] : null;
        $ficha->id_persona_acudiente_parentesco = (isset($data['id_persona_acudiente_parentesco'])) ? $data['id_persona_acudiente_parentesco'] : null;
        $ficha->id_persona_vive_con_parentesco  = (isset($data['id_persona_vive_con_parentesco'])) ? $data['id_persona_vive_con_parentesco'] : null;
        $ficha->enfermedad_padece_si            = (isset($data['enfermedad_padece_si'])) ? $data['enfermedad_padece_si'] : null;
        $ficha->enfermedad_padece_nombre        = (isset($data['enfermedad_padece_nombre'])) ? $data['enfermedad_padece_nombre'] : null;
        $ficha->medicamentos_toma_si            = (isset($data['medicamentos_toma_si'])) ? $data['medicamentos_toma_si'] : null;
        $ficha->medicamentos_toma_nombre        = (isset($data['medicamentos_toma_nombre'])) ? $data['medicamentos_toma_nombre'] : null;
        $ficha->salud_afiliado                  = (isset($data['salud_afiliado'])) ? $data['salud_afiliado'] : null;
        $ficha->id_salud_regimen                = (isset($data['id_salud_regimen'])) ? $data['id_salud_regimen'] : null;
        $ficha->id_eps                          = (isset($data['id_eps'])) ? $data['id_eps'] : null;
        $ficha->grupo_poblacional_otro          = (isset($grupo_poblacional[1]['otro'])) ? $grupo_poblacional[1]['otro'] : null;
		$ficha->grupo_poblacional_club          = (isset($grupo_poblacional[3]['club'])) ? $grupo_poblacional[3]['club'] : null;
		$ficha->condicion_discapacidad_otro     = (isset($data['condicion_discapacidad_otro'])) ? $data['condicion_discapacidad_otro'] : null;
		
        $ficha->participacion_anterior_meses    = (isset($data['participacion_anterior_meses'])) ? $data['participacion_anterior_meses'] : null;
        $ficha->participacion_anterior_annos    = (isset($data['participacion_anterior_annos'])) ? $data['participacion_anterior_annos'] : null;
        $ficha->se_reconoce_como_cual           = (isset($data['se_reconoce_como_cual'])) ? $data['se_reconoce_como_cual'] : null;

        $ficha->persona_acudiente_parentesco_otro = (isset($data['persona_acudiente_parentesco_otro'])) ? $data['persona_acudiente_parentesco_otro'] : null;
        $ficha->persona_vive_con_parentesco_otro  = (isset($data['persona_vive_con_parentesco_otro'])) ? $data['persona_vive_con_parentesco_otro'] : null;
        $ficha->vinculado=1;
        $ficha->Save();
        $id = $ficha->id;
        return $id;
    }

    private function saveocupacion($id_persona, $data_ocupacion)
    {
        foreach ($data_ocupacion as $temp)
        {
            $ocupacion               = new TblDvPersonaXOcupacion();
            $ocupacion->id_persona   = $id_persona;
            $ocupacion->id_ocupacion = $temp;
            $ocupacion->Save();
        }
    }

    private function saveodiscapacidad($id_beneficiario, $data_discapacidad)
    {
        foreach ($data_discapacidad as $temp)
        {
            $discapacidad                  = new TblDvPersonaXDiscapacidad();
            $discapacidad->id_persona      = $id_beneficiario;
            $discapacidad->id_discapacidad = $temp;
            $discapacidad->Save();
        }
    }

    private function savegrupopoblacional($id_beneficiario, $data_grupo_poblacional, $id_ficha='')
    {
        $ids=[];
        foreach ($data_grupo_poblacional as $key => $value)
        {
            if(is_numeric($value))
            {
                $ids[]=$value;
                $TblGenPersonaXGrupoPoblacional = TblGenPersonaXGrupoPoblacional::where([['id_persona','=',$id_beneficiario],['id_grupo_poblacional','=',$value]])->first();
                if(is_null($TblGenPersonaXGrupoPoblacional))
                {
                    unset($TblGenPersonaXGrupoPoblacional);
                    $TblGenPersonaXGrupoPoblacional= new TblGenPersonaXGrupoPoblacional();
                    $TblGenPersonaXGrupoPoblacional->id_grupo_poblacional = $value;
                    $TblGenPersonaXGrupoPoblacional->id_persona           = $id_beneficiario;
                    $TblGenPersonaXGrupoPoblacional->Save();
                }
            }
        }
        $ids=implode(',', $ids);
        if($ids!='')
        {
            $sql='DELETE FROM `tbl_gen_persona_x_grupo_poblacional`
                  WHERE
                    `tbl_gen_persona_x_grupo_poblacional`.`id_grupo_poblacional` NOT IN ('.$ids.') AND 
                    `tbl_gen_persona_x_grupo_poblacional`.`id_persona` = '.$id_beneficiario;
            DB::select($sql);
        }
    }


    public function editarbeneficiarios(Request $request)
    {


        try
        {
           
            $change=false;
            if(isset($data['change']))
            {
                if($data['change']==='true')
                    {$change=true;}
            }
            $data                                     = $request->all();
            $id_ficha                                 = (isset($data['id_ficha']))?($data['id_ficha']>0?$data['id_ficha']:'-1'):'-1';
            $id_beneficiario                          = $this->SavePersona($data['id_persona_beneficiario'],$change);
            $id_acudiente                             = $this->SavePersona($data['id_persona_acudiente']);
            $data['ficha']['id_persona_acudiente']    = $id_acudiente;
            $data['ficha']['id_persona_beneficiario'] = $id_beneficiario;
            $id_ficha                                 = $this->insertficha($data['ficha'], $data['id_grupo'],$id_ficha, $data['grupo_poblacional']);
			
			if (isset($data['ocupacion']))
            {
                $this->saveocupacion($id_beneficiario, $data['ocupacion']);
            }
            if (isset($data['discapacidad']))
            {
                $this->saveodiscapacidad($id_beneficiario, $data['discapacidad']);
            }
            if (isset($data['grupo_poblacional']))
            {
                $this->savegrupopoblacional($id_beneficiario, $data['grupo_poblacional'],$id_ficha);
            }
            return json_encode(array('validate' => true, 'msj' => 'Ha guardado', 'validacion' => 2, 'grupo' => $request['id_grupo'], 'ficha' => $id_ficha));
            
        } catch (Exception $ex)
        {
            return json_encode(array('validate' => false, 'msj' => $ex));
        }
    }


    public function savebeneficiarios(Request $request)
    {
        try
        {
           $validacion = TblDvFicha::select('tbl_dv_grupos.codigo_grupo')->join('tbl_gen_persona',
            'tbl_gen_persona.id', '=', 'tbl_dv_ficha.id_persona_beneficiario')
           ->join('tbl_dv_grupos', 'tbl_dv_ficha.id_grupo', '=', 'tbl_dv_grupos.id')
           ->join('users', 'tbl_dv_grupos.id_monitor', '=', 'users.id')

           ->where('tbl_gen_persona.documento', '=', str_replace(',', '', $request->id_persona_beneficiario['documento']))
           ->where('users.id', '=', Auth::user()->id)
           ->where('tbl_dv_ficha.vinculado', '=', 1)
           ->where('tbl_dv_grupos.activo', '=', 1)

           ->get();


           if (count($validacion) > 0) {
                
                return ['validacion' => 1, 'datos' => $validacion];
           }

            else
            {

            $change=false;
            if(isset($data['change']))
            {
                if($data['change']==='true')
                    {$change=true;}
            }
            $data                                     = $request->all();
            $id_ficha                                 = (isset($data['id_ficha']))?($data['id_ficha']>0?$data['id_ficha']:'-1'):'-1';
            $id_beneficiario                          = $this->SavePersona($data['id_persona_beneficiario'],$change);
            $id_acudiente                             = $this->SavePersona($data['id_persona_acudiente']);
            $data['ficha']['id_persona_acudiente']    = $id_acudiente;
            $data['ficha']['id_persona_beneficiario'] = $id_beneficiario;
            $id_ficha                                 = $this->insertficha($data['ficha'], $data['id_grupo'],$id_ficha, $data['grupo_poblacional']);
            if (isset($data['ocupacion']))
            {
                $this->saveocupacion($id_beneficiario, $data['ocupacion']);
            }
            if (isset($data['discapacidad']))
            {
                $this->saveodiscapacidad($id_beneficiario, $data['discapacidad']);
            }
            if (isset($data['grupo_poblacional']))
            {
                $this->savegrupopoblacional($id_beneficiario, $data['grupo_poblacional'],$id_ficha);
            }
            return json_encode(array('validate' => true, 'msj' => 'Ha guardado', 'validacion' => 2, 'grupo' => $request['id_grupo'], 'ficha' => $id_ficha));
            }
        } catch (Exception $ex)
        {
            return json_encode(array('validate' => false, 'msj' => $ex));
        }
    }

    public function registro($id)
    {
        $disciplinas = DB::select('SELECT 
                        `tbl_dv_grupos`.`id`,
                        `tbl_dv_disciplinas`.`descripcion`,
                        `tbl_dv_escenarios`.`nombre_escenario`
                    FROM
                      `tbl_dv_grupos`
                        INNER JOIN `tbl_dv_disciplinas` ON (`tbl_dv_grupos`.`id_disciplina` = `tbl_dv_disciplinas`.`id`)
                        INNER JOIN `tbl_dv_escenarios` ON (`tbl_dv_grupos`.`id_escenario` = `tbl_dv_escenarios`.`id`)
                    WHERE
                    `tbl_dv_disciplinas`.`activo`=1 AND
                      `tbl_dv_grupos`.`id` = ?', [$id]);
        //$disciplinas=(count($disciplinas)>0)?$disciplinas[0]:[];
        return view('ficha.registro')->with([
                    'pais'                => TblGenPais::orderBy('nombre_pais')->get(),
                    'departamento'        => TblGenDepartamento::orderBy('nombre_departamento')->get(),
                    'municipio'           => TblGenCiudad::orderBy('nombre_municipio')->where('departamento_id', '3')->get(),
                    'corregimiento'       => \App\TblGenCorregimiento::orderBy('descripcion')->get(),
                    'veredas'             => [],
                    'eps'                 => TblGenEp::orderBy('descripcion')->where('activo','1')->get(),
                    'escolaridad_nivel'   => TblGenEscolaridadNivel::all(),
                    'escolaridad_estado'  => TblGenEscolaridadEstado::all(),
                    'grupo_etnico'        => TblGenGrupoPoblacional::all(),
                    'tipo_documento'      => TblGenDocumentoTipo::all(),
                    'programa'            => TblDvPrograma::all(),
                    'ocupacion'           => TblGenOcupacion::all(),
                    'discapacidad'        => TblGenDiscapacidad::all(),
                    'barrio'              => TblGenBarrio::orderBy('nombre_barrio')->get(),
                    'ocupacion_activo_si' => TblGenOcupacion::all()->where('activo', 'si'),
                    'ocupacion_activo_no' => TblGenOcupacion::all()->where('activo', 'no'),
                    'etnia_si'            => TblGenEtnium::all()->where('activo', 'si'),
                    'etnia_no'            => TblGenEtnium::all()->where('activo', 'no'),
                    'discapacidad'        => TblGenDiscapacidad::all(),
                    'grupo_poblacional'   => TblGenGrupoPoblacional::all(),
					
					'clubes_deportivos'   => ClubesDeportivos::all(),
					
                    'parentesco'          => TblGenParentesco::all(),
                    'regimen_salud'       => TblGenSaludRegiman::all(),
                    'disciplinas'         => $disciplinas,
                    'id'                  => $id
        ]);
    }
    public function registro2($id)
    {
        $disciplinas = DB::select('SELECT 
                        `tbl_dv_grupos`.`id`,
                        `tbl_dv_disciplinas`.`descripcion`,
                        `tbl_dv_escenarios`.`nombre_escenario`
                    FROM
                      `tbl_dv_grupos`
                        INNER JOIN `tbl_dv_disciplinas` ON (`tbl_dv_grupos`.`id_disciplina` = `tbl_dv_disciplinas`.`id`)
                        INNER JOIN `tbl_dv_escenarios` ON (`tbl_dv_grupos`.`id_escenario` = `tbl_dv_escenarios`.`id`)
                    WHERE
                     `tbl_dv_disciplinas`.`activo`=1 
                     AND
                      `tbl_dv_grupos`.`id` = ?', [$id]);

        $personal= new PostPersonalController($id);
        $data=$personal->viewFichaUsuario();
        $data['nombre_grupo']=$disciplinas[0]->descripcion;
        $data['nombre_escenario']=$disciplinas[0]->nombre_escenario;
        return view('ficha.registro2')->with($data);
    }
    private function DatosFicha($id_ficha)
    {
        $sql='SELECT 
              `tbl_gen_persona`.`id_procedencia_pais`,
              `tbl_gen_persona`.`id_procedencia_departamento`
            FROM
              `tbl_gen_persona`
              INNER JOIN `tbl_dv_ficha` ON (`tbl_gen_persona`.`id` = `tbl_dv_ficha`.`id_persona_beneficiario`)
              WHERE
              `tbl_dv_ficha`.`id`=?';
        $datosficha = DB::select($sql,[$id_ficha]);
        return $datosficha[0];
    }
    public function editarregistro($id_ficha)
    {
        $disciplinas = DB::select('SELECT 
                              `tbl_dv_grupos`.`id`,
                              `tbl_dv_escenarios`.`nombre_escenario`,
                              `tbl_dv_disciplinas`.`descripcion`,
                              `tbl_gen_persona`.`documento`,
                              `tbl_gen_persona`.`id` as id_persona
                            FROM
                              `tbl_dv_ficha`
                              INNER JOIN `tbl_dv_grupos` ON (`tbl_dv_ficha`.`id_grupo` = `tbl_dv_grupos`.`id`)
                              INNER JOIN `tbl_dv_disciplinas` ON (`tbl_dv_grupos`.`id_disciplina` = `tbl_dv_disciplinas`.`id`)
                              INNER JOIN `tbl_dv_escenarios` ON (`tbl_dv_grupos`.`id_escenario` = `tbl_dv_escenarios`.`id`)
                              INNER JOIN `tbl_gen_persona` ON (`tbl_dv_ficha`.`id_persona_beneficiario` = `tbl_gen_persona`.`id`)
                            WHERE
                              `tbl_dv_disciplinas`.`activo` = 1 AND 
                              `tbl_dv_ficha`.`id` = ?', [$id_ficha]);
        $disciplinas = $disciplinas[0];
        $datos_ficha=$this->DatosFicha($id_ficha);
        $municipios=TblGenCiudad::orderBy('nombre_municipio')->where('departamento_id','=', $datos_ficha->id_procedencia_departamento)->get();
        return view('ficha.registro')->with([
                    'id'                  => $id_ficha,
                    'id_ficha'            => $id_ficha,
                    'id_grupo'            => $disciplinas->id,
                    'barrio'              => TblGenBarrio::orderBy('nombre_barrio')->get(),
                    'pais'                => TblGenPais::orderBy('nombre_pais')->get(),
                    'departamento'        => TblGenDepartamento::orderBy('nombre_departamento')->get(),
                    'municipio'           => $municipios,
                    'corregimiento'       => \App\TblGenCorregimiento::orderBy('descripcion')->get(),
                    'veredas'             => [],
                    'eps'                 => TblGenEp::all(),
                    'documento'           => $disciplinas->documento,
                    'id_persona'          => $disciplinas->id_persona,
                    'escolaridad_nivel'   => TblGenEscolaridadNivel::all(),
                    'escolaridad_estado'  => TblGenEscolaridadEstado::all(),
                    'grupo_etnico'        => TblGenGrupoPoblacional::all(),
                    'tipo_documento'      => TblGenDocumentoTipo::all(),
                    'programa'            => $disciplinas->descripcion,
                    'escenario'           => $disciplinas->nombre_escenario,
                    'ocupacion'           => TblGenOcupacion::all(),
                    'discapacidad'        => TblGenDiscapacidad::all(),
                    'ocupacion_activo_si' => TblGenOcupacion::all()->where('activo', 'si'),
                    'ocupacion_activo_no' => TblGenOcupacion::all()->where('activo', 'no'),
                    'etnia_si'            => TblGenEtnium::all()->where('activo', 'si'),
                    'etnia_no'            => TblGenEtnium::all()->where('activo', 'no'),
                    'discapacidad'        => TblGenDiscapacidad::all(),
                    'grupo_poblacional'   => TblGenGrupoPoblacional::all(),
					
					'clubes_deportivos'   => ClubesDeportivos::all(),
					
                    'parentesco'          => TblGenParentesco::all(),
                    'regimen_salud'       => TblGenSaludRegiman::all(),
                    'disciplinas'         => $disciplinas,
                    'editar'              => true
        ]);
    }

    public function datos_ficha($id_ficha)
    {
        $datos_ficha = DB::select('SELECT 
                    `tbl_dv_ficha`.`fecha_registro` as ficha_fecha_registro,
                    `tbl_dv_ficha`.`id_escolaridad_nivel` as ficha_id_escolaridad_nivel,
                    `tbl_dv_ficha`.`id_escolaridad_estado` as ficha_id_escolaridad_estado,
                    `tbl_dv_ficha`.`id_etnia` as ficha_id_etnia,
                    `tbl_dv_ficha`.`id_persona_acudiente` as ficha_id_persona_acudiente,
                    `tbl_dv_ficha`.`id_persona_acudiente_parentesco` as ficha_id_persona_acudiente_parentesco,
                    `tbl_dv_ficha`.`id_persona_vive_con_parentesco` as ficha_id_persona_vive_con_parentesco,
                    `tbl_dv_ficha`.`enfermedad_padece_si` as ficha_enfermedad_padece_si,
                    `tbl_dv_ficha`.`enfermedad_padece_nombre` as ficha_enfermedad_padece_nombre,
                    `tbl_dv_ficha`.`medicamentos_toma_si` as ficha_medicamentos_toma_si,
                    `tbl_dv_ficha`.`medicamentos_toma_nombre` as ficha_medicamentos_toma_nombre,
                    `tbl_dv_ficha`.`salud_afiliado` as ficha_salud_afiliado,
                    `tbl_dv_ficha`.`id_salud_regimen` as ficha_id_salud_regimen,
                    `tbl_dv_ficha`.`id_eps` as ficha_id_eps,
                    `tbl_dv_ficha`.`id_grupo` as ficha_id_grupo,
                    `tbl_dv_ficha`.`fecha_retiro` as ficha_fecha_retiro,
                    `tbl_dv_ficha`.`grupo_poblacional_otro` as grupo_poblacional_otro,
					`tbl_dv_ficha`.`grupo_poblacional_club` as grupo_poblacional_club,
					`tbl_dv_ficha`.`condicion_discapacidad_otro` as condicion_discapacidad_otro,
					
                    `tbl_dv_ficha`.`participacion_anterior_meses` as ficha_participacion_anterior_meses,
                    `tbl_dv_ficha`.`participacion_anterior_annos` as ficha_participacion_anterior_annos,
                    `tbl_dv_ficha`.`persona_vive_con_parentesco_otro` as ficha_persona_vive_con_parentesco_otro,
                    `tbl_dv_ficha`.`persona_acudiente_parentesco_otro` as ficha_persona_acudiente_parentesco_otro,
                    `tbl_dv_ficha`.`se_reconoce_como_cual` as ficha_se_reconoce_como_cual,     
                    `tbl_dv_ficha`.`id_ocupacion` as ficha_id_ocupacion,
                    `tbl_gen_persona`.`nombre_primero` as id_persona_beneficiario_nombre_primero,
                    `tbl_gen_persona`.`nombre_segundo` as id_persona_beneficiario_nombre_segundo,
                    `tbl_gen_persona`.`apellido_primero` as id_persona_beneficiario_apellido_primero,
                    `tbl_gen_persona`.`apellido_segundo` as id_persona_beneficiario_apellido_segundo,
                    `tbl_gen_persona`.`documento` as id_persona_beneficiario_documento,
                    `tbl_gen_persona`.`id_documento_tipo` as id_persona_beneficiario_id_documento_tipo,
                    
					`tbl_gen_persona`.`sexo` as id_persona_beneficiario_sexo,
					`tbl_gen_persona`.`tipo_genero_r` as tipo_genero_r,
					`tbl_gen_persona`.`tipo_orientacion_sexual` as tipo_orientacion_sexual,
					`tbl_gen_persona`.`orientacion_sexual_otro` as orientacion_sexual_otro,
					
					
                    date(`tbl_gen_persona`.`fecha_nacimiento`) as id_persona_beneficiario_fecha_nacimiento,
                    `tbl_gen_persona`.`telefono_fijo` as id_persona_beneficiario_telefono_fijo,
                    `tbl_gen_persona`.`telefono_movil` as id_persona_beneficiario_telefono_movil,
                    `tbl_gen_persona`.`correo_electronico` as id_persona_beneficiario_correo_electronico,
                    `tbl_gen_persona`.`id_procedencia_pais` as id_persona_beneficiario_id_procedencia_pais,
                    `tbl_gen_persona`.`id_procedencia_municipio` as id_persona_beneficiario_id_procedencia_municipio,
					`tbl_gen_persona`.`otro_municipio` as id_persona_beneficiario_other_municipio_nombre,
                    `tbl_gen_persona`.`id_procedencia_departamento` as id_persona_beneficiario_id_procedencia_departamento,
                    `tbl_gen_persona`.`id_residencia_corregimiento` as id_persona_beneficiario_id_residencia_corregimiento,
                    `tbl_gen_persona`.`id_residencia_barrio` as id_persona_beneficiario_id_residencia_barrio,
                    `tbl_gen_persona`.`id_residencia_vereda` as id_persona_beneficiario_id_residencia_vereda,
                    `tbl_gen_persona`.`residencia_direccion` as id_persona_beneficiario_residencia_direccion,
                    `tbl_gen_persona`.`residencia_estrato` as id_persona_beneficiario_residencia_estrato,
                    `tbl_gen_persona`.`sangre_tipo` as id_persona_beneficiario_sangre_tipo,
                    `tbl_gen_persona`.`id_estado_civil` as id_persona_beneficiario_id_estado_civil,
					
                    `tbl_gen_persona_acudiente`.`nombre_primero` as id_persona_acudiente_nombre_primero,
                    `tbl_gen_persona_acudiente`.`nombre_segundo` as id_persona_acudiente_nombre_segundo,
                    `tbl_gen_persona_acudiente`.`apellido_primero` as id_persona_acudiente_apellido_primero,
                    `tbl_gen_persona_acudiente`.`apellido_segundo` as id_persona_acudiente_apellido_segundo,
                    `tbl_gen_persona_acudiente`.`documento` as id_persona_acudiente_documento,
                    `tbl_gen_persona_acudiente`.`id_documento_tipo` as id_persona_acudiente_id_documento_tipo,
					
                    `tbl_gen_persona_acudiente`.`sexo` as id_persona_acudiente_sexo,
					`tbl_gen_persona_acudiente`.`sexo_acudiente_otro` as id_persona_acudiente_sexo_otro,
					
                    date(`tbl_gen_persona_acudiente`.`fecha_nacimiento`) as id_persona_acudiente_fecha_nacimiento,
                    `tbl_gen_persona_acudiente`.`telefono_fijo` as id_persona_acudiente_telefono_fijo,
                    `tbl_gen_persona_acudiente`.`telefono_movil` as id_persona_acudiente_telefono_movil,
                    `tbl_gen_persona_acudiente`.`correo_electronico` as id_persona_acudiente_correo_electronico,
                    `tbl_gen_persona_acudiente`.`id_procedencia_pais` as id_persona_acudiente_id_procedencia_pais,
                    `tbl_gen_persona_acudiente`.`id_procedencia_municipio` as id_persona_acudiente_id_procedencia_municipio,
                    `tbl_gen_persona_acudiente`.`id_procedencia_departamento` as id_persona_acudiente_id_procedencia_departamento,
                    `tbl_gen_persona_acudiente`.`id_residencia_corregimiento` as id_persona_acudiente_id_residencia_corregimiento,
                    `tbl_gen_persona_acudiente`.`id_residencia_barrio` as id_persona_acudiente_id_residencia_barrio,
                    `tbl_gen_persona_acudiente`.`id_residencia_vereda` as id_persona_acudiente_id_residencia_vereda,
                    `tbl_gen_persona_acudiente`.`residencia_direccion` as id_persona_acudiente_residencia_direccion,
                    `tbl_gen_persona_acudiente`.`residencia_estrato` as id_persona_acudiente_residencia_estrato,
                    `tbl_gen_persona_acudiente`.`sangre_tipo` as id_persona_acudiente_sangre_tipo,
                    `tbl_gen_persona_acudiente`.`id_estado_civil` as id_persona_acudiente_id_estado_civil
					
                  FROM
                    `tbl_gen_persona`
                    INNER JOIN `tbl_dv_ficha` ON (`tbl_gen_persona`.`id` = `tbl_dv_ficha`.`id_persona_beneficiario`)
                    INNER JOIN `tbl_gen_persona` `tbl_gen_persona_acudiente` ON (`tbl_dv_ficha`.`id_persona_acudiente` = `tbl_gen_persona_acudiente`.`id`)
                  WHERE
                    `tbl_dv_ficha`.`id` = ?', [$id_ficha]);
					
		// grupo poblacional
        $grupos_poblacional=DB::select('SELECT 
                     `tbl_gen_persona_x_grupo_poblacional`.`id_grupo_poblacional` as id
                    FROM
                      `tbl_gen_persona_x_grupo_poblacional`
                      INNER JOIN `tbl_gen_persona` ON (`tbl_gen_persona_x_grupo_poblacional`.`id_persona` = `tbl_gen_persona`.`id`)
                      INNER JOIN `tbl_dv_ficha` ON (`tbl_gen_persona`.`id` = `tbl_dv_ficha`.`id_persona_beneficiario`)
                    WHERE
                      `tbl_dv_ficha`.`id` = ?',[$id_ficha]);
        $temp=[];
        foreach ($grupos_poblacional as $key => $value) 
        {
            $name='id_grupo_poblacional_'.$value->id;
            $datos_ficha[0]->{$name}=$value->id;
        }
		
		// discapacidades
		$grupos_poblacional=DB::select('SELECT 
                     `tbl_dv_persona_x_discapacidad`.`id_discapacidad` as id
                    FROM
                      `tbl_dv_persona_x_discapacidad`
                      INNER JOIN `tbl_gen_persona` ON (`tbl_dv_persona_x_discapacidad`.`id_persona` = `tbl_gen_persona`.`id`)
                      INNER JOIN `tbl_dv_ficha` ON (`tbl_gen_persona`.`id` = `tbl_dv_ficha`.`id_persona_beneficiario`)
                    WHERE
                      `tbl_dv_ficha`.`id` = ?',[$id_ficha]);
        $temp=[];
        foreach ($grupos_poblacional as $key => $value) 
        {
            $name='id_discapacidad_'.$value->id;
            $datos_ficha[0]->{$name}=$value->id;
        }
		
        return json_encode($datos_ficha[0],128);
    }

    private function searchPersonaData($documento)
    {
        $sql = "SELECT 
                  `tbl_gen_persona`.`id` as id_persona,
                  `tbl_gen_persona`.`nombre_primero`,
                  `tbl_gen_persona`.`nombre_segundo`,
                  `tbl_gen_persona`.`apellido_primero`,
                  `tbl_gen_persona`.`apellido_segundo`,
                  `tbl_gen_persona`.`documento`,
                  `tbl_gen_persona`.`id_documento_tipo`,
                  `tbl_gen_persona`.`sexo`,
                  date(`tbl_gen_persona`.`fecha_nacimiento`) as fecha_nacimiento,
                  `tbl_gen_persona`.`telefono_fijo`,
                  `tbl_gen_persona`.`telefono_movil`,
                  `tbl_gen_persona`.`correo_electronico`,
                  `tbl_gen_persona`.`id_procedencia_pais`,
                  `tbl_gen_persona`.`id_procedencia_departamento`,
                  `tbl_gen_persona`.`id_procedencia_municipio`,
				  `tbl_gen_persona`.`otro_municipio` as otro_municipio,
                  `tbl_gen_persona`.`id_residencia_corregimiento`,
                  `tbl_gen_persona`.`id_residencia_barrio`,
                  `tbl_gen_persona`.`id_residencia_vereda`,
                  `tbl_gen_persona`.`residencia_direccion`,
                  `tbl_gen_persona`.`residencia_estrato`,
                  `tbl_gen_persona`.`sangre_tipo`,
                  `tbl_gen_persona`.`id_estado_civil`,
				  `tbl_gen_persona`.`sexo_acudiente_otro`,
                  `tbl_gen_persona`.`other_municipio_nombre`
                FROM
                  `tbl_gen_persona`
                WHERE
                  `tbl_gen_persona`.`documento` = ?";
        $res = DB::select($sql, array($documento));
        return $res;
    }
    private function searchPersonaAcudienteData($documento_beneficiario)
    {
        $sql = "SELECT 
                  `acudiente`.`id`,
                  `acudiente`.`nombre_primero`,
                  `acudiente`.`nombre_segundo`,
                  `acudiente`.`apellido_primero`,
                  `acudiente`.`apellido_segundo`,
                  `acudiente`.`documento`,
                  `acudiente`.`id_documento_tipo`,
                  `acudiente`.`sexo`,
                  date(`acudiente`.`fecha_nacimiento`) as fecha_nacimiento,
                  `acudiente`.`telefono_fijo`,
                  `acudiente`.`telefono_movil`,
                  `acudiente`.`correo_electronico`,
                  `acudiente`.`id_procedencia_pais`,
                  `acudiente`.`id_procedencia_municipio`,
                  `acudiente`.`id_procedencia_departamento`,
                  `acudiente`.`id_residencia_corregimiento`,
                  `acudiente`.`otro_municipio`,
                  `acudiente`.`id_residencia_barrio`,
                  `acudiente`.`id_residencia_vereda`,
                  `acudiente`.`residencia_direccion`,
                  `acudiente`.`residencia_estrato`,
                  `acudiente`.`sangre_tipo`,
                  `acudiente`.`id_estado_civil`,
                  `acudiente`.`tenantId`,
                  `acudiente`.`other_municipio_nombre`
                FROM
                  `tbl_dv_ficha`
                  INNER JOIN `tbl_gen_persona` `beneficiario` ON (`tbl_dv_ficha`.`id_persona_beneficiario` = `beneficiario`.`id`)
                  INNER JOIN `tbl_gen_persona` `acudiente` ON (`tbl_dv_ficha`.`id_persona_acudiente` = `acudiente`.`id`)
                  WHERE
                    `beneficiario`.`documento`=?";
        $res = DB::select($sql, array($documento_beneficiario));
        return $res;
    }

    private function discapacidad($id_persona)
    {
        return [];
    }
    private function grupo_poblacional($id_persona)
    {
        $res=null;
        $grupos_poblacional=DB::select('SELECT 
                     `tbl_gen_persona_x_grupo_poblacional`.`id_grupo_poblacional` as id
                    FROM
                      `tbl_gen_persona_x_grupo_poblacional`
                    WHERE
                      `tbl_gen_persona_x_grupo_poblacional`.`id_persona` = ?',[$id_persona]);
        foreach($grupos_poblacional as $temp)
        {
            $res[]=$temp->id;
        }
        return $res;

    }
    private function max_grupo_x_beneficiario($documento)
    {
        $data= TblDvConfig::where('name','=','max_ben_x_grupo')->firstOrfail();
        $sql='SELECT 
                    count(*) as cantidad
                FROM
                    `tbl_dv_ficha`
                INNER JOIN `tbl_gen_persona` ON (`tbl_dv_ficha`.`id_persona_beneficiario` = `tbl_gen_persona`.`id`)
                INNER JOIN `tbl_dv_grupos` ON (`tbl_dv_ficha`.`id_grupo` = `tbl_dv_grupos`.`id`)
                WHERE 
                    `tbl_gen_persona`.`documento`=? 
                AND 
                    `tbl_dv_grupos`.`activo` = 1
                AND
                    `tbl_dv_ficha`.`vinculado`=1';
        $ben=DB::select($sql,[$documento]);
        $max =$data->value; 
        $inscritos=$ben[0]->cantidad;
        return ['max'=>$max,'inscritos'=>$inscritos];
    }
    private function InfoGruposBeneficiario($id_persona_beneficiario)
    {
        $sql='SELECT 
              `tbl_dv_disciplinas`.`descripcion` AS `disciplina`,
              `tbl_dv_grupos`.`codigo_grupo`,
              UPPER(CONCAT_WS(" ", `users`.`primer_nombre`, `users`.`segundo_nombre`, `users`.`primer_apellido`, `users`.`segundo_apellido`)) AS `monitor`,
              GROUP_CONCAT(
              UPPER(CONCAT(
                `tbl_dv_grupos_horario`.`dia`,
                " de ",
                DATE_FORMAT(`tbl_dv_grupos_horario`.`hora_inicio`,"%r")," a ",
                DATE_FORMAT(`tbl_dv_grupos_horario`.`hora_fin` ,"%r")
              ))) as horario,
                `comunas`.`codigo_comuna` as comuna
            FROM
              `tbl_dv_ficha`
              INNER JOIN `tbl_dv_grupos` ON (`tbl_dv_ficha`.`id_grupo` = `tbl_dv_grupos`.`id`)
              INNER JOIN `tbl_dv_disciplinas` ON (`tbl_dv_grupos`.`id_disciplina` = `tbl_dv_disciplinas`.`id`)
              INNER JOIN `users` ON (`tbl_dv_grupos`.`id_monitor` = `users`.`id`)
              INNER JOIN `tbl_dv_grupos_horario` ON (`tbl_dv_grupos`.`id` = `tbl_dv_grupos_horario`.`id_grupo`)
              INNER JOIN `comunas` ON (`tbl_dv_grupos`.`id_comuna_impacto` = `comunas`.`id`)
            WHERE
              `tbl_dv_ficha`.`id_persona_beneficiario` = ?
              GROUP BY
              `tbl_dv_grupos`.`codigo_grupo`';
              return DB::select($sql,[$id_persona_beneficiario]);
    }
    public function searchficha(Request $request)
    {
        $documento            = $request->input('documento');
        $documento            = trim(str_replace(array(',', '.', ' '), array('', '', ''), $documento));
        $res                  = $this->searchPersonaData($documento);
        $max_grupo_x_beneficiario=$this->max_grupo_x_beneficiario($documento);
        $data['beneficiario'] = null;
        $data['beneficiario'] = true;
        $data['acudiente']    = $this->searchPersonaAcudienteData($documento);
        $data['grupos']['maximo']=$max_grupo_x_beneficiario['max'];
        $data['grupos']['cantidad_inscritos']=$max_grupo_x_beneficiario['inscritos'];
        $data['grupos']['data'] = NULL;
        $data['ficha']        = null;
        if (count($res) > 0)
        {

            $data['beneficiario'] = $res[0];
            $data['ficha']        = $this->searchPersonaFicha($data['beneficiario']->id_persona);
            $data['grupo_poblacional']=$this->grupo_poblacional($data['beneficiario']->id_persona);
            $data['discapacidad']=$this->discapacidad($data['beneficiario']->id_persona);
            $data['acudiente']    = (count($data['acudiente']) > 0) ? $data['acudiente'][0] : null;
            $data['grupos']['data']=$this->InfoGruposBeneficiario($data['beneficiario']->id_persona);
        }
        return json_encode($data, 128);
    }

    public function vista()
    {

        return view("postbeneficiarios.appbeneficiarios");
    }

    public function index()
    {
        $sql = "SELECT 
                    CONCAT_WS
                    (
                        ' ', 
                        `tbl_gen_persona_beneficiario`.`nombre_primero`, 
                        `tbl_gen_persona_beneficiario`.`nombre_segundo`, 
                        `tbl_gen_persona_beneficiario`.`apellido_primero`, 
                        `tbl_gen_persona_beneficiario`.`apellido_segundo`
                    ) AS `beneficiario_nombre`,
                    `tbl_gen_persona_beneficiario`.`documento` AS `beneficiario_documento`,
                    CONCAT_WS
                    (
                        ' ', 
                        `tbl_gen_persona_beneficiario`.`telefono_fijo`, 
                        `tbl_gen_persona_beneficiario`.`telefono_movil`
                    ) AS `beneficiario_telefono`,
                    CONCAT_WS
                    (
                        ' ', 
                        `tbl_gen_persona_acudiente`.`nombre_primero`, 
                        `tbl_gen_persona_acudiente`.`nombre_segundo`, 
                        `tbl_gen_persona_acudiente`.`apellido_primero`, 
                        `tbl_gen_persona_acudiente`.`apellido_segundo`
                    ) AS `acudiente_nombre`,
                    `tbl_gen_persona_acudiente`.`documento` AS `acudiente_documento`,
                    CONCAT_WS
                    (
                        ' ', 
                        `tbl_gen_persona_acudiente`.`telefono_fijo`, 
                        `tbl_gen_persona_acudiente`.`telefono_movil`
                    ) AS `acudiente_telefono`,
                    (SELECT 
                        CASE WHEN count(`activo`.`vinculado`)>0
                        THEN 'SI'
                        ELSE  'NO'
                        END AS `activo`
                        FROM `tbl_dv_ficha` `activo`
                        WHERE `activo`.`vinculado` = 1 
                        AND `activo`.`id_persona_beneficiario` = `tbl_gen_persona_beneficiario`.`id` 
                    ) AS `activo`
                FROM `tbl_dv_ficha`
                INNER JOIN 
                    `tbl_gen_persona` `tbl_gen_persona_beneficiario` 
                    ON (`tbl_dv_ficha`.`id_persona_beneficiario` = `tbl_gen_persona_beneficiario`.`id`)
                INNER JOIN 
                    `tbl_gen_persona` `tbl_gen_persona_acudiente` 
                    ON
                     (`tbl_dv_ficha`.`id_persona_acudiente` = `tbl_gen_persona_acudiente`.`id`)
                GROUP BY 
                `tbl_gen_persona_beneficiario`.`documento`
                ORDER BY 1";
        $mis_beneficiarios = DB::select($sql);
        return response()->json($mis_beneficiarios);
    }
    private function data_ficha($id_ficha)
    {
        $sql='SELECT 
  `tbl_dv_ficha`.`fecha_registro`,
  `tbl_dv_ficha`.`enfermedad_padece_si`,
  `tbl_dv_ficha`.`enfermedad_padece_nombre`,
  `tbl_dv_ficha`.`medicamentos_toma_si`,
  `tbl_dv_ficha`.`medicamentos_toma_nombre`,
  `tbl_dv_ficha`.`salud_afiliado`,
  `tbl_dv_ficha`.`grupo_poblacional_otro`,
  `tbl_dv_ficha`.`grupo_poblacional_club`,
  `tbl_dv_ficha`.`condicion_discapacidad_otro`,
  `tbl_dv_ficha`.`participacion_anterior_meses`,
  `tbl_dv_ficha`.`participacion_anterior_annos`,
  `tbl_dv_ficha`.`persona_vive_con_parentesco_otro`,
  `tbl_dv_ficha`.`persona_acudiente_parentesco_otro`,
  `tbl_dv_ficha`.`se_reconoce_como_cual`,
  `tbl_dv_ficha`.`tiene_discapacidad`,
  `tbl_dv_ficha`.`toma_medicamentos`,
  `tbl_gen_persona`.`nombre_primero`,
  `tbl_gen_persona`.`nombre_segundo`,
  `tbl_gen_persona`.`apellido_primero`,
  `tbl_gen_persona`.`apellido_segundo`,
  `tbl_gen_persona`.`documento`,
  `tbl_gen_persona`.`sexo`,
  `tbl_gen_persona`.`fecha_nacimiento`,
  `tbl_gen_persona`.`telefono_fijo`,
  `tbl_gen_persona`.`telefono_movil`,
  `tbl_gen_persona`.`correo_electronico`,
  `tbl_gen_persona`.`otro_municipio`,
  `tbl_gen_persona`.`residencia_direccion`,
  `tbl_gen_persona`.`residencia_estrato`,
  `tbl_gen_persona`.`sangre_tipo`,
  `tbl_gen_persona`.`id_estado_civil`,
  `tbl_gen_persona`.`sexo_acudiente_otro`,
  
  `tbl_gen_persona`.`other_municipio_nombre`,
  `tbl_gen_documento_tipo`.`descripcion`,
  `paises`.`nombre_pais`,
  `municipios`.`nombre_municipio`,
  `departamentos`.`nombre_departamento`,
  `barrios`.`nombre_barrio`,
  `comunas`.`nombre_comuna`,
  `tbl_gen_estado_civil`.`descripcion`,
  `tbl_gen_escolaridad_nivel`.`descripcion`,
  `tbl_gen_escolaridad_estado`.`descripcion`,
  `tbl_gen_etnia`.`descripcion`,
  `tbl_gen_salud_regimen`.`descripcion`,
  `tbl_gen_eps`.`descripcion`,
  `tbl_gen_corregimientos`.`descripcion`,
  `tbl_dv_disciplinas`.`descripcion` AS `disciplina`,
  `tbl_gen_persona_acudiente`.`nombre_primero` AS `beneficiario_nombre_primero`,
  `tbl_gen_persona_acudiente`.`nombre_segundo` AS `beneficiario_nombre_segundo`,
  `tbl_gen_persona_acudiente`.`apellido_primero` AS `beneficiario_apellido_primero`,
  `tbl_gen_persona_acudiente`.`apellido_segundo` AS `beneficiario_apellido_segundo`,
  `tbl_gen_persona_acudiente`.`documento` AS `beneficiario_documento`,
  `tbl_gen_persona_acudiente`.`fecha_nacimiento` AS `beneficiario_fecha_nacimiento`,
  `tbl_gen_persona_acudiente`.`telefono_fijo` AS `beneficiario_telefono_fijo`,
  `tbl_gen_persona_acudiente`.`telefono_movil` AS `beneficiario_telefono_movil`,
  `tbl_gen_persona_acudiente`.`correo_electronico` AS `beneficiario_correo_electronico`
FROM
  `tbl_dv_ficha`
  LEFT OUTER JOIN `tbl_gen_persona` ON (`tbl_dv_ficha`.`id_persona_beneficiario` = `tbl_gen_persona`.`id`)
  LEFT OUTER JOIN `tbl_gen_documento_tipo` ON (`tbl_gen_persona`.`id_documento_tipo` = `tbl_gen_documento_tipo`.`id`)
  LEFT OUTER JOIN `paises` ON (`tbl_gen_persona`.`id_procedencia_pais` = `paises`.`id`)
  LEFT OUTER JOIN `municipios` ON (`tbl_gen_persona`.`id_procedencia_municipio` = `municipios`.`id`)
  LEFT OUTER JOIN `departamentos` ON (`tbl_gen_persona`.`id_procedencia_departamento` = `departamentos`.`id`)
  LEFT OUTER JOIN `tbl_gen_corregimientos` ON (`tbl_gen_persona`.`id_residencia_corregimiento` = `tbl_gen_corregimientos`.`id`)
  LEFT OUTER JOIN `barrios` ON (`tbl_gen_persona`.`id_residencia_barrio` = `barrios`.`id`)
  LEFT OUTER JOIN `comunas` ON (`barrios`.`comuna_id` = `comunas`.`id`)
  LEFT OUTER JOIN `tbl_gen_estado_civil` ON (`tbl_gen_persona`.`id_estado_civil` = `tbl_gen_estado_civil`.`id`)
  LEFT OUTER JOIN `tbl_gen_escolaridad_nivel` ON (`tbl_dv_ficha`.`id_escolaridad_nivel` = `tbl_gen_escolaridad_nivel`.`id`)
  LEFT OUTER JOIN `tbl_gen_escolaridad_estado` ON (`tbl_dv_ficha`.`id_escolaridad_estado` = `tbl_gen_escolaridad_estado`.`id`)
  LEFT OUTER JOIN `tbl_gen_etnia` ON (`tbl_dv_ficha`.`id_etnia` = `tbl_gen_etnia`.`id`)
  LEFT OUTER JOIN `tbl_gen_salud_regimen` ON (`tbl_dv_ficha`.`id_salud_regimen` = `tbl_gen_salud_regimen`.`id`)
  LEFT OUTER JOIN `tbl_gen_eps` ON (`tbl_dv_ficha`.`id_eps` = `tbl_gen_eps`.`id`)
  LEFT OUTER JOIN `tbl_dv_grupos` ON (`tbl_dv_ficha`.`id_grupo` = `tbl_dv_grupos`.`id`)
  LEFT OUTER JOIN `tbl_dv_disciplinas` ON (`tbl_dv_grupos`.`id_disciplina` = `tbl_dv_disciplinas`.`id`)
  LEFT OUTER JOIN `tbl_gen_persona` `tbl_gen_persona_acudiente` ON (`tbl_dv_ficha`.`id_persona_acudiente` = `tbl_gen_persona_acudiente`.`id`)
WHERE
  `tbl_dv_ficha`.`id` = ?';
        $data=DB::select($sql,[$id_ficha]);
        return $data[0];
    }
    private function array_data($data)
    {
        echo '<pre>$data=[';
        foreach(array_keys((array)$data) as $temp)
        {
            echo '            \''.$temp.'\'=>$data->'.$temp.',<br>';
        }
        echo '];';
        exit;
    }
    public function detalle_ficha_beneficiario($id_ficha)
    {
        $data=$this->data_ficha($id_ficha);
        //$this->array_data($data);   
        return view('postbeneficiarios.beneficiarioficha')->with([            
            'fecha_registro'=>$data->fecha_registro,
            'enfermedad_padece_si'=>$data->enfermedad_padece_si,
            'enfermedad_padece_nombre'=>$data->enfermedad_padece_nombre,
            'medicamentos_toma_si'=>$data->medicamentos_toma_si,
            'medicamentos_toma_nombre'=>$data->medicamentos_toma_nombre,
            'salud_afiliado'=>$data->salud_afiliado,
            'grupo_poblacional_otro'=>$data->grupo_poblacional_otro,
			'grupo_poblacional_club'=>$data->grupo_poblacional_club,
			'condicion_discapacidad_otro'=>$data->condicion_discapacidad_otro,
            'participacion_anterior_meses'=>$data->participacion_anterior_meses,
            'participacion_anterior_annos'=>$data->participacion_anterior_annos,
            'persona_vive_con_parentesco_otro'=>$data->persona_vive_con_parentesco_otro,
            'persona_acudiente_parentesco_otro'=>$data->persona_acudiente_parentesco_otro,
            'se_reconoce_como_cual'=>$data->se_reconoce_como_cual,
            'tiene_discapacidad'=>$data->tiene_discapacidad,
            'toma_medicamentos'=>$data->toma_medicamentos,
            'nombre_primero'=>$data->nombre_primero,
            'nombre_segundo'=>$data->nombre_segundo,
            'apellido_primero'=>$data->apellido_primero,
            'apellido_segundo'=>$data->apellido_segundo,
            'documento'=>$data->documento,
            'documento_tipo'=>$data->documento_tipo,
            'sexo'=>$data->sexo,
			'sexo_acudiente_otro'=>$data->sexo_acudiente_otro,
            'fecha_nacimiento'=>$data->fecha_nacimiento,
            'telefono_fijo'=>$data->telefono_fijo,
            'telefono_movil'=>$data->telefono_movil,
            'correo_electronico'=>$data->correo_electronico,
            'otro_municipio'=>$data->otro_municipio,
            'residencia_direccion'=>$data->residencia_direccion,
            'residencia_estrato'=>$data->residencia_estrato,
            'sangre_tipo'=>$data->sangre_tipo,
            'id_estado_civil'=>$data->id_estado_civil,
            'other_municipio_nombre'=>$data->other_municipio_nombre,
            'descripcion'=>$data->descripcion,
            'nombre_pais'=>$data->nombre_pais,
            'nombre_municipio'=>$data->nombre_municipio,
            'nombre_departamento'=>$data->nombre_departamento,
            'nombre_barrio'=>$data->nombre_barrio,
            'nombre_comuna'=>$data->nombre_comuna,
            'disciplina'=>$data->disciplina,
            'beneficiario_nombre_primero'=>$data->beneficiario_nombre_primero,
            'beneficiario_nombre_segundo'=>$data->beneficiario_nombre_segundo,
            'beneficiario_apellido_primero'=>$data->beneficiario_apellido_primero,
            'beneficiario_apellido_segundo'=>$data->beneficiario_apellido_segundo,
            'beneficiario_documento'=>$data->beneficiario_documento,
            'beneficiario_fecha_nacimiento'=>$data->beneficiario_fecha_nacimiento,
            'beneficiario_telefono_fijo'=>$data->beneficiario_telefono_fijo,
            'beneficiario_telefono_movil'=>$data->beneficiario_telefono_movil,
            'beneficiario_correo_electronico'=>$data->beneficiario_correo_electronico,
]);
    }
    public function beneficiario_x_escenario($id_disciplina)
    {
        $sql='SELECT 
            `tbl_dv_ficha`.`id`,
              `tbl_gen_persona`.`documento`,
              CONCAT_WS(" ",
                `tbl_gen_persona`.`apellido_primero`,
                `tbl_gen_persona`.`apellido_segundo`) as apellidos,
              CONCAT_WS(" ",
                `tbl_gen_persona`.`nombre_primero`,
                `tbl_gen_persona`.`nombre_segundo`) as nombres,
              DATE(`tbl_gen_persona`.`fecha_nacimiento`) as `fecha_nacimiento`,
              TIMESTAMPDIFF(YEAR,`tbl_gen_persona`.`fecha_nacimiento`,CURDATE()) as edad,
              (CASE WHEN TRIM(`tbl_gen_persona`.`telefono_fijo`)="" THEN "-" ELSE `tbl_gen_persona`.`telefono_fijo` END) AS `telefono_fijo`,
              (CASE WHEN TRIM(`tbl_gen_persona`.`telefono_movil`)="" THEN "-" ELSE `tbl_gen_persona`.`telefono_movil` END) AS `telefono_movil`,
              `tbl_dv_disciplinas`.`descripcion` AS `disciplina` 
            FROM
              `tbl_dv_ficha`
              INNER JOIN `tbl_dv_grupos` ON (`tbl_dv_ficha`.`id_grupo` = `tbl_dv_grupos`.`id`)
              INNER JOIN `tbl_gen_persona` ON (`tbl_dv_ficha`.`id_persona_acudiente` = `tbl_gen_persona`.`id`)
              INNER JOIN `tbl_dv_disciplinas` ON (`tbl_dv_grupos`.`id_disciplina` = `tbl_dv_disciplinas`.`id`)
            WHERE
              `tbl_dv_grupos`.`activo` = 1 AND 
              `tbl_dv_grupos`.`id_escenario` = ?
              ORDER BY 4,3';
        $data=DB::select($sql,[$id_disciplina]);
        return view('postbeneficiarios.beneficiariosxescenario')->with([
            'Escenario'=>'Prueba de nombre',
            'data'=>$data]);
    }
}
