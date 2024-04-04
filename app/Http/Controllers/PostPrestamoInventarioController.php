<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\User;
use App\Models\TblDvClasificacionImplementos;
use App\Models\TblDvPrestamoInventario;
use App\Models\TblDvDeatallePrestamo;
use App\Models\TblDvImplementos;

class PostPrestamoInventarioController extends Controller
{
    public static function usersinventario()
    {
        $data = DB::table('users')
            ->select
            (
                'users.id',
                'users.primer_nombre',
                'users.segundo_nombre',
                'users.primer_apellido',
                'users.segundo_apellido',
                'users.numero_documento as documentos',
                DB::raw('COALESCE((SELECT GROUP_CONCAT(DISTINCT `tbl_dv_disciplinas`.`descripcion`)
                    FROM `tbl_dv_grupos`
                    INNER JOIN `tbl_dv_disciplinas` ON (`tbl_dv_grupos`.`id_disciplina` = `tbl_dv_disciplinas`.`id`)
                    WHERE  `tbl_dv_grupos`.`id_monitor`= `users`.`id`
                    ORDER BY `tbl_dv_disciplinas`.`descripcion`),\'\') AS `disciplinas`'),
                DB::raw('  COALESCE((SELECT
                GROUP_CONCAT(DISTINCT `comunas`.`codigo_comuna`)
              FROM
                `tbl_dv_grupos`
                INNER JOIN `tbl_dv_disciplinas` ON (`tbl_dv_grupos`.`id_disciplina` = `tbl_dv_disciplinas`.`id`)
                INNER JOIN `comunas` ON (`tbl_dv_grupos`.`id_comuna_impacto` = `comunas`.`id`)
              WHERE
                `tbl_dv_grupos`.`id_monitor` = `users`.`id`
              ORDER BY
                `tbl_dv_disciplinas`.`descripcion`),\'\') as comunas')
            )
            ->where('users.tenantId','=',"312312312")
            ->orderBy('users.primer_nombre')
            ->get();
            //->toSql(); echo $data;exit;
            return $data;
    }
	  public function create()
    {
          $users=self::usersinventario();
          return view('postprestamoinventario.create')->with([
            'usuarios'=> $users,
            'clasificaciones' => TblDvClasificacionImplementos::orderBy('nombre')->get()
          ]);
    }

    public function index()
    {
    	return view('postprestamoinventario.index');
    }


    public function listarPrestamos()
    {
        $prestamos = DB::table('tbl_dv_prestamo_inventario')
            ->select
            (
                'tbl_dv_prestamo_inventario.id',
                'tbl_dv_implementos.id as implemento_id',
                'tbl_dv_prestamo_inventario.fecha as fecha',
                DB::RAW('IF(tbl_dv_prestamo_inventario.estado=0, "PENDIENTE",IF(tbl_dv_prestamo_inventario.estado=1,"ENTREGADO","CANCELADO")) as estado'),
                DB::raw('UCASE(CONCAT(users.primer_nombre," ",users.primer_apellido)) as contratista'),
                DB::RAW('UCASE(roles.name) as rol'),
                DB::RAW('UCASE(roles.name) as rol'),
                DB::raw('GROUP_CONCAT(DISTINCT comunas.codigo_comuna) as comunas'),
                DB::raw("GROUP_CONCAT(CONCAT_WS(' cantidad ',`tbl_dv_implementos`.`nombre`, `tbl_dv_deatalle_prestamo`.`cantidad`)) as implementos")
            )
            ->join('users','tbl_dv_prestamo_inventario.contratista_user_id','=','users.numero_documento')
            ->join('role_user','users.id','=','role_user.user_id')
            ->join('roles','role_user.role_id','=','roles.id')
            ->leftjoin('tbl_dv_empleado','users.id','=','tbl_dv_empleado.id_usuario')
            ->leftJoin('tbl_dv_empleado_x_comuna','tbl_dv_empleado.id','=','tbl_dv_empleado_x_comuna.id_ficha_empleado')
            ->leftJoin('comunas','tbl_dv_empleado_x_comuna.id_comuna','=','comunas.id')
            ->join('tbl_dv_deatalle_prestamo','tbl_dv_deatalle_prestamo.prestamo_id','=','tbl_dv_prestamo_inventario.id')
            ->join('tbl_dv_implementos','tbl_dv_deatalle_prestamo.implemento_id','=','tbl_dv_implementos.id')
            ->orderBy('tbl_dv_prestamo_inventario.id')
            ->groupBy('users.id')
            ->groupBy('tbl_dv_prestamo_inventario.id')
            ->get();
            //foreach($prestamos as $temp)
            //{
            //    $this->implementos($temp->implemento_id);
            //}
        return response()->json(['validate' => true, 'data' => $prestamos]);
    }
    private function implementos($id_implemento)
    {
      $prestamos = DB::table('tbl_dv_prestamo_inventario')
      ->select
      (
          DB::raw("sum(' cantidad ') as cantidad"),
          'tbl_dv_implementos.nombre'
      )
      ->join('users','tbl_dv_prestamo_inventario.contratista_user_id','=','users.numero_documento')
      ->join('role_user','users.id','=','role_user.user_id')
      ->join('roles','role_user.role_id','=','roles.id')
      ->leftjoin('tbl_dv_empleado','users.id','=','tbl_dv_empleado.id_usuario')
      ->leftJoin('tbl_dv_empleado_x_comuna','tbl_dv_empleado.id','=','tbl_dv_empleado_x_comuna.id_ficha_empleado')
      ->leftJoin('comunas','tbl_dv_empleado_x_comuna.id_comuna','=','comunas.id')
      ->join('tbl_dv_deatalle_prestamo','tbl_dv_deatalle_prestamo.prestamo_id','=','tbl_dv_prestamo_inventario.id')
      ->join('tbl_dv_implementos','tbl_dv_deatalle_prestamo.implemento_id','=','tbl_dv_implementos.id')
      ->orderBy('tbl_dv_prestamo_inventario.id')
      ->groupBy('users.id')
      //->where('tbl_dv_prestamo_inventario.contratista_user_id','=',$user)
      ->where('tbl_dv_prestamo_inventario.estado','=',1)
      ->where('tbl_dv_deatalle_prestamo.implemento_id','=',$id_implemento)
      ->get();
        return ($prestamos);
    }


    public function save(Request $request)
    {
      try
        {

        $prestamo = new TblDvPrestamoInventario();
        $prestamo->fecha = $request->fecha;
        $prestamo->contratista_user_id = $request->contratista_user_id;
        $prestamo->comuna_id = $request->comuna_id;
        $prestamo->observaciones = $request->observaciones;
        $prestamo->estado = 0;
        $prestamo->save();
        $elementos = $request->elementos;
        if(is_array($elementos) && count($elementos) <> 0){

            foreach ($elementos as $key => $value) {
                if($value[0] != "" && $value[2] != "")
                {
                    if($value[2] != "0")
                    {

                        $elemento = new TblDvDeatallePrestamo();
                        $elemento->prestamo_id= $prestamo->id;
                        $elemento->implemento_id = $value[0];
                        $elemento->cantidad = $value[2];
                        $elemento->save();

                        // $implemento = TblDvImplementos::where('id', $value[0])->firstOrfail();
                        // $implemento->cantidad_actual = (int)$implemento->cantidad_actual - (int) $value[2];
                        // $implemento->save();


                    }
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

    private function detalleClasificacion($id_clasificacion,$id)
    {
        $detalles = DB::table('tbl_dv_prestamo_inventario')
                    ->select(
                        'tbl_dv_deatalle_prestamo.prestamo_id',
                        'tbl_dv_implementos.nombre',
                        'tbl_dv_deatalle_prestamo.implemento_id',
                        'tbl_dv_deatalle_prestamo.cantidad'
                    )
                    ->join('tbl_dv_deatalle_prestamo','tbl_dv_prestamo_inventario.id','=','prestamo_id')
                    ->join('tbl_dv_implementos','tbl_dv_deatalle_prestamo.implemento_id','=','tbl_dv_implementos.id')
                    ->where('tbl_dv_prestamo_inventario.id', '=', $id)
                    ->where('tbl_dv_implementos.clasificacion_id', '=', $id_clasificacion)
                    ->get();
        return $detalles;
    }

	public function edit($id)
    {
    	$prestamo = TblDvPrestamoInventario::find($id);
        $detalles = DB::table('tbl_dv_prestamo_inventario')
                    ->select(
                        'tbl_dv_implementos.clasificacion_id'
                    )
                    ->join('tbl_dv_deatalle_prestamo','tbl_dv_prestamo_inventario.id','=','prestamo_id')
                    ->join('tbl_dv_implementos','tbl_dv_deatalle_prestamo.implemento_id','=','tbl_dv_implementos.id')
                    ->where('tbl_dv_prestamo_inventario.id', '=', $id)
                    ->groupBy('tbl_dv_implementos.clasificacion_id')
                    ->get();
        $users=self::usersinventario();
        foreach($detalles as $key=>$temp)
        {
            $detalles[$key]->detalles=$this->detalleClasificacion($temp->clasificacion_id,$id);
        }

    	return view('postprestamoinventario.editar')->with([
    		'prestamo'=> $prestamo,
    		'detalles'=> $detalles,
        	'usuarios'=> $users,
        	'clasificaciones' => TblDvClasificacionImplementos::orderBy('nombre')->get()
      ]);
    }

    public function update(Request $request, $id)
    {
        try
          {
            $prestamo = TblDvPrestamoInventario::find($id);
            $input = $request->all();
            $prestamo->fill($input)->save();
            $elementos = $request->elementos;

              if(is_array($elementos) && count($elementos) <> 0){
                $detalles = TblDvDeatallePrestamo::where('prestamo_id','=',$id)->get();

                foreach ($detalles as $detalle) {

                  $prestamo_id = $detalle['prestamo_id'];

                  DB::table('tbl_dv_deatalle_prestamo')->where('prestamo_id', '=', $prestamo_id)->delete();

                }

                  foreach ($elementos as $key => $value) {
                    $elemento = new TblDvDeatallePrestamo();
                    $elemento->prestamo_id= $id;
                    $elemento->implemento_id= $value[0];
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

    public function cancelar($id)
    {
    	$prestamo = TblDvPrestamoInventario::find($id);

    	$prestamo->estado = 2;

    	$prestamo->save();

	    echo json_encode(['validate' => true, 'msj' => 'Cancelado con exito']);

    }

    public function cambiarEstado($id,$estado)
    {

        $prestamo = TblDvPrestamoInventario::find($id);
        $prestamo->estado = $estado;
        $prestamo->save();

        $busquedaCantidad = TblDvDeatallePrestamo::where('prestamo_id', $id)->get();

        foreach ($busquedaCantidad as $value) {
          $implemento = TblDvImplementos::where('id', $value['implemento_id'])->firstOrfail();
          $implemento->cantidad_actual = (int)$implemento->cantidad_actual - (int) $value['cantidad'];
          $implemento->save();
        }
        echo json_encode(['validate' => true, 'msj' => 'Cambio de estado con exito']);

    }

    public function destroy($id)
    {

      $elementos = TblDvDeatallePrestamo::where('prestamo_id','=',$id)->get();

      foreach ($elementos as $elem) {
        $prestamo_id = $elem['prestamo_id'];

        DB::table('tbl_dv_deatalle_prestamo')->where('prestamo_id', '=', $prestamo_id)->delete();

      }

      $entrada = TblDvPrestamoInventario::find($id);

      $entrada->delete();

      echo json_encode(['validate' => true, 'msj' => 'Borrado con exito']);

    }

    public function prestamosPDF()
    {

        $prestamos = DB::table('tbl_dv_prestamo_inventario')
            ->select(
                DB::raw('UCASE(CONCAT(users.primer_nombre," ",users.primer_apellido)) as contratista'),
                DB::raw('UCASE(roles.name) as rol'),
                'tbl_dv_prestamo_inventario.fecha',
                DB::raw('UCASE(tbl_dv_disciplinas.descripcion) as disciplinas'),
                'tbl_dv_implementos.nombre as implemento',
                'tbl_dv_implementos.especificacion_tecnica',
                'tbl_dv_proveedores.nombre as proveedor',
                'tbl_dv_deatalle_prestamo.cantidad'
            )
            ->join('tbl_dv_deatalle_prestamo','tbl_dv_prestamo_inventario.id','=','prestamo_id')
            ->join('tbl_dv_implementos','tbl_dv_deatalle_prestamo.implemento_id','=','tbl_dv_implementos.id')
            ->join('users','tbl_dv_prestamo_inventario.contratista_user_id','=','users.numero_documento')
            ->join('role_user','users.id','=','role_user.user_id')
            ->join('roles','role_user.role_id','=','roles.id')
            ->join('tbl_dv_proveedores','tbl_dv_implementos.proveedor_id','=','tbl_dv_proveedores.id')
            ->join('tbl_dv_empleado','users.id','=','tbl_dv_empleado.id_usuario')
            ->leftJoin('tbl_dv_empleado_x_disciplina','tbl_dv_empleado.id','=','tbl_dv_empleado_x_disciplina.id_empleado')
            ->leftJoin('tbl_dv_disciplinas','tbl_dv_empleado_x_disciplina.id_disciplina', '=','tbl_dv_disciplinas.id')
            ->groupBy('tbl_dv_prestamo_inventario.id')
            ->get();

        if($prestamos->count()){
            $view = view('pdf.reporteprestamosPDF',['prestamos'=> $prestamos])->render();
            $pdf = \App::make('dompdf.wrapper'); //crea el pdf
            $pdf->loadHTML($view)->setPaper('Letter', 'landscape');
            $pdf->getDomPDF()->set_option("enable_php", true);
            return $pdf->stream('reporteprestamos'.".pdf");
        } else {
            return "No hay data";
        }
    }

}
