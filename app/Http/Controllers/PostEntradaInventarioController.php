<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\inventarioController;
use DB;
use App\Models\TblDvEntradaInventario;
use App\Models\TblDvDeatalleEntrada;
use App\Models\TblDvProveedor;
use App\Models\TblDvContratoProveedor;
use App\Models\TblDvClasificacionImplementos;
use App\Models\TblDvImplementos;

class PostEntradaInventarioController extends Controller
{

    public function create()
    {
    	return view('postentradainventario.create')->with([
        'proveedores'=> TblDvProveedor::orderBy('nombre')->get(),
        'clasificaciones' => TblDvClasificacionImplementos::orderBy('nombre')->get()
      ]);
    }

    public function index()
    {
    	return view('postentradainventario.index');
    }

    public function listarEntradas()
    {
    	$sql = 'SELECT
                  `tbl_dv_entrada_inventario`.`id` AS `id`,
                  `tbl_dv_entrada_inventario`.`fecha` AS `fecha`,
                  UCASE(`tbl_dv_proveedores`.`nombre`) AS `nombre`,
                  UCASE(COALESCE(GROUP_CONCAT(`tbl_dv_implementos`.`nombre`),"---")) as implementos,
                  `tbl_dv_deatalle_entrada`.`cantidad` AS `cantidad`
                FROM
                  `tbl_dv_entrada_inventario`
                LEFT JOIN `tbl_dv_deatalle_entrada` ON (`tbl_dv_entrada_inventario`.`id` = `tbl_dv_deatalle_entrada`.`entrada_id`)
                INNER JOIN `tbl_dv_proveedores` ON (`tbl_dv_entrada_inventario`.`proveedor_id` = `tbl_dv_proveedores`.`id`)
                INNER JOIN `tbl_dv_implementos` ON (`tbl_dv_deatalle_entrada`.`implemento_id` = `tbl_dv_implementos`.`id`)
                GROUP BY
                  `tbl_dv_entrada_inventario`.`id`
                ORDER BY
                  `tbl_dv_entrada_inventario`.`id` DESC';


        $proveedores = DB::select($sql, []);

        return response()->json(['validate' => true, 'data' => $proveedores]);
    }

    public function listarNombreImplementos($id)
    {
      $implementos = DB::select('SELECT
          `tbl_dv_implementos`.`id`,
          CONCAT_WS(\'-\', `tbl_dv_proveedores`.`nombre`, `tbl_dv_implementos`.`nombre`) AS `nombre`,
          `tbl_dv_implementos`.`clasificacion_id`,
          `tbl_dv_implementos`.`disciplina_id`,
          `tbl_dv_implementos`.`proveedor_id`,
          `tbl_dv_implementos`.`stock`,
          0 as maximo,
          `tbl_dv_implementos`.`especificacion_tecnica`
        FROM
          `tbl_dv_implementos`
          INNER JOIN `tbl_dv_proveedores` ON (`tbl_dv_implementos`.`proveedor_id` = `tbl_dv_proveedores`.`id`)
          WHERE
          `tbl_dv_implementos`.`clasificacion_id` ='. $id. '
        ORDER BY 2'
      );
      foreach($implementos as $key=>$temp)
      {
        $implementos[$key]->maximo=inventarioController::fn_implementos_cantidad($temp->id);
      }

      return $implementos;
    }

    public function save(Request $request)
    {


      try
        {

        $entrada = new TblDvEntradaInventario();
        $entrada->fecha = $request->fecha;
        $entrada->proveedor_id = $request->proveedor_id;
        if($request->observaciones){
          $entrada->observaciones = $request->observaciones;
        }

        $entrada->save();

        $elementos = $request->elementos;
        if(is_array($elementos) && count($elementos) <> 0){

            foreach ($elementos as $key => $value) {
                if($value[0] != "" && $value[1] != "" && $value[2] != "") {
                    $elemento = new TblDvDeatalleEntrada();
                    $elemento->entrada_id= $entrada->id;
                    $elemento->implemento_id = $value[1];
                    $elemento->cantidad = $value[2];
                    $elemento->save();

                    $implemento = TblDvImplementos::where('id', $value[1])->firstOrfail();
                    $implemento->cantidad_actual = (int)$implemento->cantidad_actual + (int)$value[2];
                    $implemento->save();
                }
            }
        }

         echo json_encode(['validate' => true, 'msj' => 'Guardado con exito']);
      }
        catch (Exception $e)
        {
            echo json_encode(['validate' => false, 'msj' => $e]);
        }
    }

    public function edit($id)
    {
      $entrada = TblDvEntradaInventario::find($id);

      $detalle = DB::table('tbl_dv_deatalle_entrada')
                ->join('tbl_dv_implementos','tbl_dv_deatalle_entrada.implemento_id','=','tbl_dv_implementos.id')
                ->where('tbl_dv_deatalle_entrada.entrada_id','=',$id)
                ->select('*')
                ->get();

      //$detalle = TblDvDeatalleEntrada::where('entrada_id','=',$id)->get();

      return view('postentradainventario.editar')->with([
        'entrada'=> $entrada,
        'detalle'=> $detalle,
        'proveedores'=> TblDvProveedor::orderBy('nombre')->get(),
        'clasificaciones' => TblDvClasificacionImplementos::orderBy('nombre')->get(),
        'implementos'=>TblDvImplementos::orderBy('clasificacion_id')->orderBy('proveedor_id')->orderBy('nombre')->get()
      ]);
    }


    public function update(Request $request, $id)
    {
    try
          {
            $entrada = TblDvEntradaInventario::find($id);
            $input = $request->all();
            $entrada->fill($input)->save();
            $elementos = $request->elementos;

              if(is_array($elementos) && count($elementos) <> 0){
                $detalles = TblDvDeatalleEntrada::where('entrada_id','=',$id)->get();

                foreach ($detalles as $detalle) {

                  $entrada_id = $detalle['entrada_id'];

                  DB::table('tbl_dv_deatalle_entrada')->where('entrada_id', '=', $entrada_id)->delete();

                }

                  foreach ($elementos as $key => $value) {
                    $elemento = new TblDvDeatalleEntrada();
                    $elemento->entrada_id= $id;
                    $elemento->implemento_id= $value[1];
                    $elemento->cantidad = $value[2];
                    $elemento->save();
                  }
                }

              echo json_encode(['validate' => true, 'msj' => 'Guardado con exito']);
          }
      catch (Exception $e)
          {
              echo json_encode(['validate' => false, 'msj' => $e]);
          }
    }


    public function destroy($id)
    {

      $elementos = TblDvDeatalleEntrada::where('entrada_id','=',$id)->get();

      foreach ($elementos as $elem) {
        $entrada_id = $elem['entrada_id'];

        DB::table('tbl_dv_deatalle_entrada')->where('entrada_id', '=', $entrada_id)->delete();

      }

      $entrada = TblDvEntradaInventario::find($id);

      $entrada->delete();

      echo json_encode(['validate' => true, 'msj' => 'Borrado con exito']);

    }

}
