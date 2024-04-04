<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Escenario;
use App\TipoEscenario;
use App\Sede;
use App\Models\TblDvEquipamentoTipo;
use App\Barrio;
use App\Models\TblGenCorregmientos;
use App\Models\TblGenVeredas;
use App\Models\TblGenBarrio;
use App\Models\TblDvEscenarios;
use App\Models\TblDvTipoEscenarios;
use App\Models\TblDvEscenarioXEquipamiento;
use DB;
use Exception;
use response;

class PostEscenariosController extends Controller
{

    public function __construct()
    {
//$this->middleware('permission:ver-roles', ['only' => 'vista']);
    }

    public function vista()
    {

        return view("postescenarios.appescenarios");
    }

    public function index()
    {
        $sql = "SELECT 
                          `tbl_dv_escenarios`.`id`,
                          `tbl_dv_escenarios`.`nombre_escenario`,
                          `tbl_dv_tipo_escenarios`.`nombre_tipo_escenario`,
                          GROUP_CONCAT(`tbl_dv_escenario_x_equipamiento`.`cantidad`, ' ', `tbl_dv_equipamento_tipo`.`descripcion`) AS `equipamiento`
                        FROM
                          `tbl_dv_escenarios`
                          LEFT OUTER JOIN `tbl_dv_tipo_escenarios` ON (`tbl_dv_escenarios`.`tipoescenario_id` = `tbl_dv_tipo_escenarios`.`id`)
                          LEFT OUTER JOIN `tbl_dv_escenario_x_equipamiento` ON (`tbl_dv_escenario_x_equipamiento`.`id_escenario` = `tbl_dv_escenarios`.`id`)
                          LEFT OUTER JOIN `tbl_dv_equipamento_tipo` ON (`tbl_dv_escenario_x_equipamiento`.`id_equipamiento` = `tbl_dv_equipamento_tipo`.`id`)
                          WHERE
                          `tbl_dv_escenarios`.`activo`=1
                        GROUP BY
                          `tbl_dv_escenarios`.`id`,
                          `tbl_dv_escenarios`.`nombre_escenario`,
                          `tbl_dv_tipo_escenarios`.`nombre_tipo_escenario`
                        ORDER BY
                          `tbl_dv_escenarios`.`nombre_escenario`";
        $escenarios = DB::select($sql, []);
        return json_encode($escenarios);
    }

    public function ListarBarrios()
    {
        $Barrios = TblGenBarrio::orderBy('nombre_barrio')->get();
        return response()->json($Barrios->toArray());
    }

    public function ObtenerTipoEscenarios()
    {
        $sql = 'SELECT 
				  `tbl_dv_tipo_escenarios`.`id`,
				  `tbl_dv_tipo_escenarios`.`nombre_tipo_escenario`
				FROM
				  `tbl_dv_tipo_escenarios`';
        $tipoescenarios = DB::select($sql);
        return response()->json($tipoescenarios);
    }

    public function ObtenerTipoEquipamientos()
    {
        $tipoescenarios = TblDvEquipamentoTipo::orderBy('descripcion')->get();
        return response()->json($tipoescenarios->toArray());
    }

    private function Escenario($id)
    {

        $sql   = 'SELECT 
                `tbl_dv_escenarios`.`id`,
                `tbl_dv_escenarios`.`tipoescenario_id`,
                `tbl_dv_escenarios`.`direccion`,
                `tbl_dv_escenarios`.`direccion_complemento`,
                `tbl_dv_escenarios`.`id_corregimiento`,
                `tbl_dv_escenarios`.`id_vereda`,
                `tbl_dv_escenarios`.`id_barrio`,
                `tbl_dv_escenarios`.`nombre_escenario`,
                `tbl_dv_escenarios`.`descripcion`
              FROM
                `tbl_dv_escenarios`
                WHERE
                `tbl_dv_escenarios`.`id` = ?';
        $datos = DB::select($sql, [$id]);
        if (count($datos) === 0)
        {
            throw new Exception('No hay datos para este codigo');
        }
        return $datos[0];
    }

    private function EscenarioEquipamiento($id)
    {
        $sql   = 'SELECT 
                    `tbl_dv_escenario_x_equipamiento`.`id`,
                    `tbl_dv_escenario_x_equipamiento`.`id_escenario`,
                    `tbl_dv_escenario_x_equipamiento`.`id_equipamiento`,
                    `tbl_dv_escenario_x_equipamiento`.`cantidad`
                  FROM
                    `tbl_dv_escenario_x_equipamiento`
                    WHERE
                      `tbl_dv_escenario_x_equipamiento`.`id_escenario`=?';
        $datos = DB::select($sql, [$id]);
        return $datos;
    }

    public function ObtenerDatosTipoEscenarioID($id)
    {
        try
        {
            $escenario             = $this->Escenario($id);
            $EscenarioEquipamiento = $this->EscenarioEquipamiento($id);
            echo json_encode(['validate' => true, 'msj' => null, 'escenario' => $escenario, 'equipamiento' => $EscenarioEquipamiento]);
        } catch (Exception $e)
        {
            echo json_encode(['validate' => false, 'msj' => $e->getMessage(), 'escenario' => NULL, 'equipamiento' => NULL]);
        }
    }

    public function ObtenerTipoEscenarioID($id)
    {
        $tipoescenarios = TblDvEscenarios::select('tbl_dv_tipo_escenarios.id', 'tbl_dv_tipo_escenarios.nombre_tipo_escenario')->join('tbl_dv_tipo_escenarios', 'tbl_dv_tipo_escenarios.id', '=', 'tbl_dv_escenarios.tipoescenario_id')->where('tbl_dv_escenarios.id', '=', $id)->firstOrfail();
        return response()->json($tipoescenarios->toArray());
    }

    public function ObtenerSedes()
    {
        $sedes = Sede::select('sedes.id', 'sedes.nombre_sede', 'instituciones.nombre_institucion')
                        ->join(
                                'instituciones', 'instituciones.id', '=', 'sedes.institucion_id'
                        )->get();
        return response()->json($sedes->toArray());
    }

    private function equipamiento_escenario($id_escenario, $data_equipamiento)
    {
        for ($i = 0; $i < count($data_equipamiento['tipo']); $i++)
        {
            $tipo                     = $data_equipamiento['tipo'][$i];
            $cantidad                 = $data_equipamiento['cantidad'][$i];
            $guardar                  = new TblDvEscenarioXEquipamiento();
            $guardar->id_escenario    = $id_escenario;
            $guardar->id_equipamiento = $tipo;
            $guardar->cantidad        = $cantidad;
            $guardar->Save();
        }
    }

    public function CrearEscenario(Request $request)
    {
        $escenario                   = new TblDvEscenarios();
        $escenario->tipoescenario_id = $request->input('tipoescenario');
        $escenario->nombre_escenario = $request->input('nombre_escenario');
        $escenario->descripcion      = $request->input('descripcion');
        $escenario->id_barrio        = $request->input('id_barrio');
        $escenario->direccion        = $request->input('direccion');
        $escenario->id_corregimiento = $request->input('id_corregimiento');
        $escenario->id_vereda        = $request->input('id_vereda');
        $escenario->save();
        $id                          = $escenario->id;
        $request->id=$id;
        $this->equipamiento_escenario($id, $request->escenario);
        return response()->json($escenario->toArray());
    }

    public function ObtenerEscenario($id)
    {
        $sql       = 'SELECT 
				  `tbl_dv_escenarios`.`id`,
				  `tbl_dv_escenarios`.`tipoescenario_id`,
				  `tbl_dv_escenarios`.`id_barrio`,
				  `tbl_dv_escenarios`.`nombre_escenario`,
				  `tbl_dv_escenarios`.`descripcion`,
				  `tbl_dv_escenarios`.`created_at`,
				  `tbl_dv_escenarios`.`updated_at`,
				  `tbl_dv_escenarios`.`direccion`,
                  `barrios`.`nombre_barrio`
                FROM
                  `tbl_dv_escenarios`
                  INNER JOIN `barrios` ON (`tbl_dv_escenarios`.`id_barrio` = `barrios`.`id`)
				WHERE
				  `tbl_dv_escenarios`.`id` = ?
				LIMIT 1';
        $escenario = DB::select($sql, [$id]);
        return json_encode($escenario[0],128);
    }

    public function ObtenerSedeID($id)
    {
        $sedes = TblDvEscenarios::select('tbl_dv_sedes.id', 'tbl_dv_sedes.nombre_sede')->join('tbl_dv_sedes', 'tbl_dv_sedes.id', '=', 'tbl_dv_escenarios.sede_id')
                ->where('tbl_dv_escenarios.id', '=', $id)
                ->firstOrfail();
        return response()->json($sedes->toArray());
    }

    private function edit_quipamiento($equipamiento, $id_escenario)
    {
        $sql = 'DELETE FROM `tbl_dv_escenario_x_equipamiento` WHERE `tbl_dv_escenario_x_equipamiento`.`id_escenario` = ?';
        DB::select($sql, [$id_escenario]);
        foreach($equipamiento["tipo"] as $i => $temp)
        {
            $equipamientos                  = new TblDvEscenarioXEquipamiento();
            $equipamientos->id_equipamiento = $equipamiento["tipo"][$i];
            $equipamientos->cantidad        = $equipamiento["cantidad"][$i];
            $equipamientos->id_escenario    = $id_escenario;
            $equipamientos->save();
        }
    }
    public function editar($id)
    {
        $data=TblDvEscenarios::where('id', '=', $id)->firstOrFail();
        $veredas=(is_null($data->id_corregimiento))?[]:TblGenVeredas::where('corregimiento_id','=',$data->id_corregimiento)->orderBy('nombre')->get();
        $resultado=[
            'tipos_escenarios'=>TblDvTipoEscenarios::orderBy('nombre_tipo_escenario')->get(),
            'id_tipo_escenario'=>trim($data->tipoescenario_id),
            'nombre_escenario'=>$data->nombre_escenario,
            'corregimientos'=>TblGenCorregmientos::orderBy('descripcion')->get(),
            'id_corregimiento'=>$data->id_corregimiento,
            'veredas'=>$veredas,
            'id_veredas'=>$data->id_vereda,
            'barrios'=>Barrio::orderBy('nombre_barrio')->get(),
            'id_barrio'=>$data->id_barrio,
            'direccion'=>$data->direccion,
            'direccion_complemento'=>$data->direccion_complemento,
            'descripcion'=>$data->descripcion,
            'corregimiento'=>TblGenCorregmientos::orderBy('descripcion')->get(),
            'equipamentos'=>$this->equipamentos_escenario($id),
            'tipos_equipamentos'=>TblDvEquipamentoTipo::orderBy('descripcion')->get()
        ];
        return view('postescenarios.editar')->with($resultado);
    }
    public function equipamentos_escenario($id_escenario)
    {
        $sql='SELECT 
                  `tbl_dv_equipamento_tipo`.`descripcion`,
                  `tbl_dv_equipamento_tipo`.`id`,
                  `tbl_dv_escenario_x_equipamiento`.`cantidad`
                FROM
                  `tbl_dv_escenario_x_equipamiento`
                  INNER JOIN `tbl_dv_escenarios` ON (`tbl_dv_escenario_x_equipamiento`.`id_escenario` = `tbl_dv_escenarios`.`id`)
                  INNER JOIN `tbl_dv_equipamento_tipo` ON (`tbl_dv_escenario_x_equipamiento`.`id_equipamiento` = `tbl_dv_equipamento_tipo`.`id`)
                WHERE
                  `tbl_dv_escenarios`.`id` = ?';

        $data=DB::Select($sql,[$id_escenario]);

        return $data;
    }
    public function EditarEscenario(Request $request)
    {
        //try{
            $escenario                   = TblDvEscenarios::findOrfail($request->input('id'));
            $escenario->nombre_escenario = $request->input('nombre_escenario');
            $escenario->tipoescenario_id = $request->input('tipoescenario');
            $escenario->descripcion      = $request->input('descripcion');
            $escenario->direccion        = $request->input('direccion');
            $escenario->id_barrio        = $request->input('id_barrio');
            $escenario->id_corregimiento = $request->input('id_corregimiento');
            $escenario->id_vereda        = $request->input('id_vereda');
            $escenario->save();
            $this->edit_quipamiento($request->input('escenario'), $request->input('id'));
            echo json_encode(['validate' => true, 'msj' => 'Se ha modificado el escenario con exito']);
        //} catch (Exception $e){echo json_encode(['validate' => false, 'msj' => $e->getMessage()]);}
    }

    public function EliminarEscenario($id)
    {

        $escenario            = TblDvEscenarios::findOrfail($id);
        $escenario->activo    = 0;
        $escenario->Save();
        return response()->json($escenario->toArray()
        );
    }

}
