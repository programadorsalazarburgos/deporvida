<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Barrio;
use App\Comuna;
use App\User;
use App\Municipio;
use App\TblDvNovedadTipo;
use App\TblDvNovedad;
use App\Models\TblDvAsistencias;
use App\Models\TblDvReporteNovedad;
use App\Models\TblGenDepartamento;
use App\Models\TblGenBarrio;
use response;
use DB;

class NovedadController extends Controller
{
    public function MisGrupos(Request $request)
    {
        $user=Auth::user()->id;
        $fecha=$request->input('fecha');
        $sql="SELECT
              `tbl_dv_grupos`.`id` as id_grupo,
              `tbl_dv_disciplinas`.`descripcion`,
              `tbl_dv_grupos`.`codigo_grupo`,
              `tbl_dv_escenarios`.`nombre_escenario`,
              `tbl_dv_grupos_horario`.`dia`,
              GROUP_CONCAT(CONCAT(`tbl_dv_grupos_horario`.`dia`, ' de ', DATE_FORMAT(`tbl_dv_grupos_horario`.`hora_inicio`, '%r'), ' a ', DATE_FORMAT(`tbl_dv_grupos_horario`.`hora_fin`, '%r'))) AS `horario`
            FROM
              `tbl_dv_grupos`
              INNER JOIN `tbl_dv_disciplinas` ON (`tbl_dv_grupos`.`id_disciplina` = `tbl_dv_disciplinas`.`id`)
              INNER JOIN `tbl_dv_escenarios` ON (`tbl_dv_grupos`.`id_escenario` = `tbl_dv_escenarios`.`id`)
              INNER JOIN `tbl_dv_grupos_horario` ON (`tbl_dv_grupos`.`id` = `tbl_dv_grupos_horario`.`id_grupo`)
            WHERE
            fn_dia_fecha(date('{$fecha}')) = `tbl_dv_grupos_horario`.`dia`
            AND
            `tbl_dv_grupos`.`id_monitor`=?

            AND
            `tbl_dv_grupos`.`activo`=1

            GROUP BY
              `tbl_dv_disciplinas`.`descripcion`,
              `tbl_dv_grupos`.`codigo_grupo`,
              `tbl_dv_escenarios`.`nombre_escenario`
            ORDER BY
              `tbl_dv_grupos`.`id`";
        $data=DB::select($sql,[$user]);
        $html='<option data-horario="" value="">Ninguno</option>';
        foreach($data as $temp)
        {
            $html.='<option data-horario="'.$temp->horario.'" value="'.$temp->id_grupo.'">Disciplina:'.$temp->descripcion.'|Codigo:'.$temp->codigo_grupo.'|Escenario:'.$temp->nombre_escenario.'</option>';
        }
        return json_encode(['validate'=>true,'html'=>$html]);
    }
    public function reportessave(Request $request)
    {
        $data=new TblDvReporteNovedad();
        $data->fecha_reporte=$request->input("fecha_reporte");
        $data->id_metodologo=Auth::user()->id;
        $data->nombre_completo=$request->input("nombre_completo");
        $data->cedula=$request->input("cedula");
        $data->telefono=$request->input("telefono");
        $data->fecha_accidente=$request->input("fecha_accidente");
        $data->hora_accidente=$request->input("hora_accidente");
        $data->hora_ingreso=$request->input("hora_ingreso");
        $data->direccion_accidente=$request->input("direccion_accidente");
        $data->barrio_accidente=$request->input("barrio_accidente");
        $data->zona=$request->input("zona");
        $data->testigo1=$request->input("testigo1");
        $data->cedula1=$request->input("cedula1");
        $data->testigo2=$request->input("testigo2");
        $data->cedula2=$request->input("cedula2");
        $data->relato=$request->input("relato");
        $data->observaciones=$request->input("observaciones");
        $data->razon_social=$request->input("razon_social");
        $data->nit=$request->input("nit");
        $data->radicado=$request->input("radicado");
        $data->cargo=$request->input("cargo");
        $data->fecha_envio_autorizacion=$request->input("fecha_envio_autorizacion");
        $data->fecha_autorizado=$request->input("fecha_autorizado");
        $data->id_departamento=$request->input("id_departamento");
        $data->id_municipio=$request->input("id_municipio");
        $data->jornada_laboral=$request->input("jornada_laboral");
        $data->autorizacion=$request->input('autorizacion');
        $data->save();
        return response()->json(['validate'=>true,'id'=>$data->id]);
    }
    public function mismonitores(Request $request)
    {
        $term=$request->input('term');
        $data=DB::select("SELECT
        UPPER(
        CONCAT_WS(' ',
          `users`.`primer_nombre`,
          `users`.`segundo_nombre`,
          `users`.`primer_apellido`,
          `users`.`segundo_apellido`)) as value,
          `users`.`numero_documento`,
          COALESCE(`users`.`telefono_fijo`,`users`.`telefono_movil`) as telefono
        FROM
          `tbl_dv_grupos`
          INNER JOIN `users` ON (`tbl_dv_grupos`.`id_monitor` = `users`.`id`)
          WHERE
          TRIM(UPPER(`users`.`primer_nombre`)) LIKE TRIM(UPPER('%$term%')) OR
          TRIM(UPPER(`users`.`segundo_nombre`)) LIKE TRIM(UPPER('%$term%')) OR
          TRIM(UPPER(`users`.`primer_apellido`))  LIKE TRIM(UPPER('%$term%')) OR
          TRIM(UPPER(`users`.`segundo_apellido`)) LIKE TRIM(UPPER('%$term%')) OR
          TRIM(UPPER(`users`.`numero_documento`)) LIKE TRIM(UPPER('%$term%'))
          GROUP BY
          `tbl_dv_grupos`.`id_monitor`
          ORDER BY 1");
          return $data;
    }
    public function ReporteImp()
    {
        return view('novedades.reporte')->with([
            'departamentos'=>TblGenDepartamento::orderBy('nombre_departamento')->get(),
            'municipiosvalle'=>Municipio::orderBy('nombre_municipio')->where('departamento_id','=',76)->get(),
            'barrios'=>TblGenBarrio::orderBy('nombre_barrio')->get()
        ]);
    }
    public function informaccidente($id)
    {
        return view('novedades.reportepdf')->with([
            'data'=>DB::table('tbl_dv_novedad_reporte')
            ->select('tbl_dv_novedad_reporte.fecha_reporte',
            'tbl_dv_novedad_reporte.nombre_completo',
            'tbl_dv_novedad_reporte.id_metodologo',
            'tbl_dv_novedad_reporte.cedula',
            'tbl_dv_novedad_reporte.telefono',
            'tbl_dv_novedad_reporte.fecha_accidente',
            'tbl_dv_novedad_reporte.hora_accidente',
            'tbl_dv_novedad_reporte.hora_ingreso',
            'tbl_dv_novedad_reporte.direccion_accidente',
            'tbl_dv_novedad_reporte.barrio_accidente',
            'tbl_dv_novedad_reporte.zona',
            'tbl_dv_novedad_reporte.testigo1',
            'tbl_dv_novedad_reporte.cedula1',
            'tbl_dv_novedad_reporte.testigo2',
            'tbl_dv_novedad_reporte.cedula2',
            'tbl_dv_novedad_reporte.relato',
            'tbl_dv_novedad_reporte.observaciones',
            'tbl_dv_novedad_reporte.razon_social',
            'tbl_dv_novedad_reporte.jornada_laboral',
            'tbl_dv_novedad_reporte.nit',
            'tbl_dv_novedad_reporte.radicado',
            'tbl_dv_novedad_reporte.cargo',
            'tbl_dv_novedad_reporte.fecha_envio_autorizacion',
            'tbl_dv_novedad_reporte.fecha_autorizado',
            'departamentos.nombre_departamento',
            'municipios.nombre_municipio')
            ->leftJoin('departamentos','tbl_dv_novedad_reporte.id_departamento','departamentos.id')
            ->leftJoin('municipios','tbl_dv_novedad_reporte.id_municipio','municipios.id')
            ->where('tbl_dv_novedad_reporte.id','=',$id)
            ->first()
        ]);

        /*
        $pdf = \App::make('dompdf.wrapper'); //crea el pdf
        $pdf->loadHTML($view)->setPaper('Letter', 'landscape');
        $pdf->getDomPDF()->set_option("enable_php", true);
        return $pdf->stream('accidente_laboral'.".pdf");
        */
    }
    public function misnovedades()
    {
        $id=Auth::user()->id;
        $sql='SELECT
              `tbl_dv_novedad`.`id`,
              `tbl_dv_novedad_tipo`.`descripcion` as novedad_tipo,
              `tbl_dv_novedad`.`nombre`,
              `tbl_dv_novedad`.`detalle`,
              date(`tbl_dv_novedad`.`fecha_reportar`) AS `fecha_reportar`,
              `tbl_dv_novedad`.`fecha_creacion`

            FROM
              `tbl_dv_novedad`
              INNER JOIN `tbl_dv_novedad_tipo` ON (`tbl_dv_novedad`.`id_novedad_tipo` = `tbl_dv_novedad_tipo`.`id`)
              WHERE
                `tbl_dv_novedad`.`id_usuario_monitor`=?';
        $data=DB::select($sql,[$id]);
        echo json_encode(['validate'=>true,'data'=>$data]);
    }
    public function new_novedad()
    {
        return view('novedades.create')->with([
        	'novedades_tipo'=>TblDvNovedadTipo::orderBy('descripcion')->get()
        ]);
    }
    public function index()
    {
        return view('novedades.index');
    }
    private function validate_cancel($id_grupo,$fecha_asistencia,$id_novedad_tipo)
    {
        if($id_novedad_tipo=='1')
        {
            $data=TblDvAsistencias::where('id_grupo','=',$id_grupo)->where('fecha_asistencia','=',$fecha_asistencia)->get();
            return (count($data)===0);
        }
        else
        {
            return true;
        }
    }
    public function guardar(Request $request)
    {
    	if(is_null(Auth::user()))
    	{
			return json_encode(['validate'=>false,'id'=>NULL]);
    	}
    	else
    	{
    		if($this->validate_cancel($request->input('id_grupo'),$request->input('fecha_reportar'),$request->input('id_novedad_tipo')))
            {
                $guardar                        = new TblDvNovedad();
                $guardar->id_novedad_tipo       = $request->input('id_novedad_tipo');
                $guardar->nombre                = $request->input('nombre');
                $guardar->detalle               = $request->input('detalle');
                $guardar->id_grupo              = $request->input('id_grupo');
                $guardar->fecha_reportar        = $request->input('fecha_reportar');
                $guardar->fecha_creacion        = date('Y-m-d H:i:s');
                $guardar->id_usuario_monitor    = Auth::user()->id;
                $guardar->save();
                return json_encode(['validate'=>(!is_null($guardar->id)),'id'=>$guardar->id]);
            }
            else
            {
                return json_encode(['validate'=>false,'msj'=>'No puede cancelar esta clase. Ya se ha tomado asistencia.']);
            }
    	}
    }
    public function noticicaciones_metodologo()
    {
        if(Auth::user()->hasRole('METODÓLOGO'))
        {
          $sql='SELECT
                  `tbl_dv_novedad`.`id`,
                  COALESCE(`tbl_dv_novedad`.`nombre`,"") as nombre,
                  `tbl_dv_novedad`.`fecha_creacion`,
                  `tbl_dv_novedad`.`leido_monitor`,
                  CONCAT_WS(" ",
                  `users`.`primer_nombre`,
                  `users`.`segundo_nombre`,
                  `users`.`primer_apellido`,
                  `users`.`segundo_apellido`) as monitor
                FROM
                  `tbl_dv_novedad`
                  INNER JOIN `users` ON (`tbl_dv_novedad`.`id_usuario_monitor` = `users`.`id`)
                WHERE
                  `tbl_dv_novedad`.`id_usuario_monitor` IN (SELECT `tbl_dv_grupos`.`id_monitor` FROM `tbl_dv_grupos` WHERE `tbl_dv_grupos`.`id_metodologo` = ? GROUP BY 1)
                  LIMIT 10';
            $data=DB::select($sql,[Auth::user()->id]);
            $total=0;
            foreach($data as $temp)
            {
              $total+=$temp->leido_monitor;
            }
          return response()->json(['validate'=>true,'data'=>$data,'sin_leer'=>$total]);
        }
        else
        {
            return response()->json(['validate'=>false,'data'=>null]);
        }
    }
    public function novedades_de_monitores()
    {
        $sql='SELECT
              `tbl_dv_novedad`.`id`,
              `tbl_dv_novedad`.`fecha_creacion`,
              `users`.`numero_documento`,
              `tbl_dv_novedad`.`detalle` AS `nombre`,
              `tbl_dv_novedad`.`leido_monitor`,
              CONCAT_WS(\' \', `users`.`primer_nombre`, `users`.`segundo_nombre`, `users`.`primer_apellido`, `users`.`segundo_apellido`) AS `monitor`,
              `tbl_dv_novedad_tipo`.`descripcion` as tipo
            FROM
              `tbl_dv_novedad`
              INNER JOIN `users` ON (`tbl_dv_novedad`.`id_usuario_monitor` = `users`.`id`)
              INNER JOIN `tbl_dv_grupos` ON (`tbl_dv_novedad`.`id_usuario_monitor` = `tbl_dv_grupos`.`id_monitor`)
              INNER JOIN `tbl_dv_novedad_tipo` ON (`tbl_dv_novedad`.`id_novedad_tipo` = `tbl_dv_novedad_tipo`.`id`)
            WHERE
              `tbl_dv_grupos`.`id_metodologo` = ?
            GROUP BY
              `tbl_dv_novedad`.`id`
            ORDER BY
              `tbl_dv_novedad`.`fecha_creacion` DESC';
        $data=DB::select($sql,[Auth::user()->id]);
        return response()->json(['data'=>$data]);
    }
    public function novedades_de_monitores2()
    {
        $sql='SELECT
              `tbl_dv_novedad`.`id`,
              `tbl_dv_novedad`.`fecha_creacion`,
              `tbl_dv_novedad`.`fecha_reportar`,
              `users`.`numero_documento`,
              `tbl_dv_novedad`.`detalle` AS `nombre`,
              `tbl_dv_novedad`.`leido_monitor`,
              CONCAT_WS(\' \', `users`.`primer_nombre`, `users`.`segundo_nombre`, `users`.`primer_apellido`, `users`.`segundo_apellido`) AS `monitor`,
              `tbl_dv_novedad_tipo`.`descripcion` as tipo
            FROM
              `tbl_dv_novedad`
              INNER JOIN `users` ON (`tbl_dv_novedad`.`id_usuario_monitor` = `users`.`id`)
              INNER JOIN `tbl_dv_grupos` ON (`tbl_dv_novedad`.`id_usuario_monitor` = `tbl_dv_grupos`.`id_monitor`)
              INNER JOIN `tbl_dv_novedad_tipo` ON (`tbl_dv_novedad`.`id_novedad_tipo` = `tbl_dv_novedad_tipo`.`id`)

            GROUP BY
              `tbl_dv_novedad`.`id`
            ORDER BY
              `tbl_dv_novedad`.`fecha_creacion` DESC';
        $data=DB::select($sql);

        return response()->json(['data'=>$data]);
    }




    public function show_novedad_metodologo()
    {
        return view('novedades.metodologo');
    }


      public function show_novedad_metodologos()
    {


        return view('novedades.metodologos');
    }
    public function data_novedades_monitor()
    {
        if(Auth::user()->hasRole('Metodólogo'))
        {
            $sql='SELECT
                  `tbl_dv_novedad`.`id`,
                  `tbl_dv_novedad`.`nombre`,
                  `tbl_dv_novedad`.`fecha_creacion`,
                  `tbl_dv_novedad`.`leido_monitor`,
                  CONCAT_WS(" ",
                  `users`.`primer_nombre`,
                  `users`.`segundo_nombre`,
                  `users`.`primer_apellido`,
                  `users`.`segundo_apellido`) as monitor
                FROM
                  `tbl_dv_novedad`
                  INNER JOIN `users` ON (`tbl_dv_novedad`.`id_usuario_monitor` = `users`.`id`)
                WHERE
                  `tbl_dv_novedad`.`id_usuario_monitor` IN (SELECT `tbl_dv_grupos`.`id_monitor` FROM `tbl_dv_grupos` WHERE `tbl_dv_grupos`.`id_metodologo` = ? GROUP BY 1)';
            $data=DB::select($sql,[Auth::user()->id]);
            return response()->json($data);
        }
    }
    public function novedades_monitor_metodologo($id)
    {
        $data=TblDvNovedad::where('id','=',$id)->firstOrFail();
        $data->leido_monitor=0;
        $data->save();
        $data=DB::table('tbl_dv_novedad')
        ->select('tbl_dv_novedad_tipo.descripcion',
              'users.primer_nombre',
              'users.segundo_nombre',
              'users.primer_apellido',
              'users.segundo_apellido',
              'users.numero_documento',
              'tbl_dv_novedad.nombre',
              'tbl_dv_novedad.detalle',
              'tbl_dv_novedad.fecha_reportar',
              'tbl_dv_novedad.fecha_creacion',
              'tbl_dv_grupos.codigo_grupo')
        ->join('tbl_dv_novedad_tipo','tbl_dv_novedad.id_novedad_tipo', '=', 'tbl_dv_novedad_tipo.id')
        ->join('users','tbl_dv_novedad.id_usuario_monitor', '=', 'users.id')
        ->leftJoin('tbl_dv_grupos','tbl_dv_novedad.id_grupo', '=', 'tbl_dv_grupos.id')
        ->where('tbl_dv_novedad.id','=',$id)
        ->first();
        return view('novedades.novedadesmonitorxmetodologo')->with(['data'=>$data]);
    }
    private function personaaccidentelaboral()
    {
        $data=DB::table('tbl_dv_grupos')
        ->select(
            'tbl_dv_grupos.id_monitor',
            'users.primer_nombre',
            'users.segundo_nombre',
            'users.primer_apellido',
            'users.segundo_apellido',
            'users.numero_documento'
          )
        ->groupBy('tbl_dv_grupos.id_monitor')
        ->orderBy('users.primer_nombre')
        ->orderBy('users.segundo_nombre')
        ->orderBy('users.primer_apellido')
        ->orderBy('users.segundo_apellido')
        ->join('users','tbl_dv_grupos.id_monitor','=','users.id')
        ->where('tbl_dv_grupos.id_metodologo', '=', Auth::user()->id)
        ->get();
        return $data;
    }
    public function accidentelaboral()
    {
      return view('novedades.accidentelaboral')->with([
        'personal'=>$this->personaaccidentelaboral()
      ]);
    }
}
