<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PostPrestamoInventarioController;
use DB;
use App\User;
use App\Models\TblDvClasificacionImplementos;
use App\Models\TblDvDevolucionInventario;
use App\Models\TblDvDeatalleDevolucion;
use App\Models\TblDvDadosDeBaja;
use App\Models\TblDvProveedores;
use App\Models\TblDvDisciplinas;
use App\Models\TblDvImplementos;
class PostDevolucionInventarioController extends Controller
{
  public static function usersinventario()
  {
    return DB::table('tbl_dv_empleado')
        ->select
        (
            'users.id',
            DB::raw('UPPER(users.primer_nombre) AS primer_nombre'),
            DB::raw('UPPER(users.segundo_nombre) AS segundo_nombre'),
            DB::raw('UPPER(users.primer_apellido) AS primer_apellido'),
            DB::raw('UPPER(users.segundo_apellido) AS segundo_apellido'),
            'users.numero_documento as documentos',
            DB::raw('GROUP_CONCAT(tbl_dv_disciplinas.descripcion) as disciplinas'),
            DB::raw('GROUP_CONCAT(DISTINCT comunas.codigo_comuna) as comunas')
        )
        ->join('users','tbl_dv_empleado.id_usuario','=','users.id')

        ->leftJoin('tbl_dv_empleado_x_disciplina','tbl_dv_empleado.id','=','tbl_dv_empleado_x_disciplina.id_empleado')
        ->leftJoin('tbl_dv_disciplinas','tbl_dv_empleado_x_disciplina.id_disciplina', '=','tbl_dv_disciplinas.id')
        ->leftJoin('tbl_dv_grupos','tbl_dv_empleado.id_usuario','=','tbl_dv_grupos.id_monitor')
        ->leftJoin('comunas','tbl_dv_grupos.id_comuna_impacto','=','comunas.id')
        ->orderBy('users.primer_apellido')
        ->orderBy('users.segundo_apellido')
        ->orderBy('users.primer_nombre')
        ->orderBy('users.segundo_nombre')
        ->groupBy('users.id')
        ->get();
  }

	public function create()
  {
    $users=PostPrestamoInventarioController::usersinventario();
    return view('postdevolucioninventario.create')->with([
      'usuarios'=> $users,
      'clasificaciones'=>TblDvClasificacionImplementos::all(),
      'proveedor'=>TblDvProveedores::all(),
      'disciplina'=>TblDvDisciplinas::orderBy('descripcion')->get(),
      'implementos'=>TblDvImplementos::orderBy('clasificacion_id')->orderBy('proveedor_id')->orderBy('nombre')->get()

    ]);
  }

    public function index()
    {
    	return view('postdevolucioninventario.index');
    }

    public function listarDevoluciones()
    {

        $devoluciones = DB::table('tbl_dv_devolucion_inventario')
            ->select
            (
                'tbl_dv_devolucion_inventario.id',
                'tbl_dv_devolucion_inventario.fecha as fecha',
                'users.numero_documento',
                DB::raw('UCASE(CONCAT(users.primer_nombre," ",users.primer_apellido)) as contratista'),
                DB::RAW('UCASE(roles.name) as rol'),
                DB::raw('GROUP_CONCAT(comunas.codigo_comuna) as comunas'),
                DB::RAW('IF(tbl_dv_devolucion_inventario.estado=0, "PENDIENTE",IF(tbl_dv_devolucion_inventario.estado=1,"ENTREGADO","CANCELADO")) as estado')
            )
            ->join('users','tbl_dv_devolucion_inventario.contratista_user_id','=','users.numero_documento')
            ->join('role_user','users.id','=','role_user.user_id')
            ->join('roles','role_user.role_id','=','roles.id')
            ->leftjoin('tbl_dv_empleado','users.id','=','tbl_dv_empleado.id_usuario')
            ->leftJoin('tbl_dv_empleado_x_comuna','tbl_dv_empleado.id','=','tbl_dv_empleado_x_comuna.id_ficha_empleado')
            ->leftJoin('comunas','tbl_dv_empleado_x_comuna.id_comuna','=','comunas.id')
            ->orderBy('users.primer_nombre')
            ->groupBy('tbl_dv_devolucion_inventario.id')
            ->where('tbl_dv_devolucion_inventario.estado','=',1)
            ->get();
        return response()->json(['validate' => true, 'data' => $devoluciones]);
    }

    public function save(Request $request)
    {
      try
        {
        $devolucion = new TblDvDevolucionInventario();
        $devolucion->fecha = $request->fecha;
        $devolucion->contratista_user_id = $request->contratista_user_id;
        $devolucion->comuna_id = $request->comuna_id;
        $devolucion->observaciones = $request->observaciones;
        $devolucion->estado = 1;
        $devolucion->save();

        $elementos = $request->elementos;
        if(is_array($elementos) && count($elementos) <> 0
        ){
          //var_dump($elementos);exit();
            foreach ($elementos as $key => $value) {
                if($value[6] != "" || $value[6] != "0")
                {
                    $elemento = new TblDvDeatalleDevolucion();
                    $elemento->devolucion_id= $devolucion->id;
                    $elemento->implemento_id = $value[0];
                    $elemento->cantidad = $value[6];
                    $elemento->id_deatalle_prestamo_devolucion_estado=1;
                    $elemento->save();

                    $implemento = TblDvImplementos::where('id', $value[0])->firstOrfail();
                    $implemento->cantidad_actual = (int)$implemento->cantidad_actual + (int) $value[6];
                    $implemento->save();


                }
                if(isset($value[7]))
                {
                if($value[7] != "0" || $value[8] != "0")
                {
                  $detalle = new TblDvDadosDeBaja();
                  $detalle->devolucion_id = $devolucion->id;
                  $detalle->implemento_id = $value[0];
                  $detalle->dano = $value[7];
                  $detalle->perdida_robo = $value[8];
                  $detalle->save();
                }
                if($value[7] != "" || $value[7] != "0")
                {
                    $elemento = new TblDvDeatalleDevolucion();
                    $elemento->devolucion_id= $devolucion->id;
                    $elemento->implemento_id = $value[0];
                    $elemento->cantidad = $value[7];
                    $elemento->id_deatalle_prestamo_devolucion_estado=3;
                    $elemento->save();
                }
                }
                if(isset($value[8]))
                {
                if($value[8] != "" || $value[8] != "0")
                {
                    $elemento = new TblDvDeatalleDevolucion();
                    $elemento->devolucion_id= $devolucion->id;
                    $elemento->implemento_id = $value[0];
                    $elemento->cantidad = $value[8];
                    $elemento->id_deatalle_prestamo_devolucion_estado=2;
                    $elemento->save();
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

  public function edit($id)
  {
    $devolucion = TblDvDevolucionInventario::find($id);

    $detalle = DB::table('tbl_dv_devolucion_inventario')
        ->select
        (
            'tbl_dv_implementos.clasificacion_id'

        )
        ->join('tbl_dv_deatalle_devolucion','tbl_dv_devolucion_inventario.id','=','tbl_dv_deatalle_devolucion.devolucion_id')
        ->join('tbl_dv_implementos','tbl_dv_deatalle_devolucion.implemento_id','=','tbl_dv_implementos.id')
        ->where('tbl_dv_devolucion_inventario.id','=',$id)
        ->groupBy('tbl_dv_implementos.clasificacion_id')
        ->get();

        foreach ($detalle as $key=>$temp)
        {
          $detalle[$key] = $this->detalle_devolucion($temp->clasificacion_id,$id);
        }
    $users=self::usersinventario();

    return view('postdevolucioninventario.editar')->with([
      'devolucion' => $devolucion,
      'detalle' => $detalle,
      'usuarios'=> $users,
      'disciplinas' => TblDvDisciplinas::all(),
      'clasificaciones'=>TblDvClasificacionImplementos::all(),
      'proveedor'=>TblDvProveedores::all(),
      'implementos'=>TblDvImplementos::orderBy('clasificacion_id')->orderBy('proveedor_id')->orderBy('nombre')->get()
    ]);
  }

  public function detalle_devolucion($clasificacion_id, $id)
  {

       $detalle = DB::select("SELECT
          `tbl_dv_clasificacion_implementos`.`nombre` AS `clasificacion`,
          `tbl_dv_implementos`.`id` AS `implemento_id`,
          `tbl_dv_implementos`.`nombre` AS `nombreImplemento`,
          `tbl_dv_proveedores`.`id` AS `proveedor_id`,
          UCASE(`tbl_dv_proveedores`.`nombre`) AS `proveedor`,
          `tbl_dv_dados_de_baja`.`dano` AS `dano`,
          `tbl_dv_dados_de_baja`.`perdida_robo` AS `perdida_robo`,
          `tbl_dv_deatalle_devolucion`.`cantidad` AS `devuelto`,
          0 AS `cantidad`,
          `tbl_dv_devolucion_inventario`.`contratista_user_id`

          FROM
          `tbl_dv_deatalle_devolucion`
          INNER JOIN `tbl_dv_devolucion_inventario` ON (`tbl_dv_deatalle_devolucion`.`devolucion_id` = `tbl_dv_devolucion_inventario`.`id`)
          INNER JOIN `tbl_dv_implementos` ON (`tbl_dv_deatalle_devolucion`.`implemento_id` = `tbl_dv_implementos`.`id`)
          INNER JOIN `tbl_dv_clasificacion_implementos` ON (`tbl_dv_implementos`.`clasificacion_id` = `tbl_dv_clasificacion_implementos`.`id`)
          INNER JOIN `tbl_dv_proveedores` ON (`tbl_dv_implementos`.`proveedor_id` = `tbl_dv_proveedores`.`id`)
          INNER JOIN `tbl_dv_prestamo_inventario` ON (`tbl_dv_devolucion_inventario`.`contratista_user_id` = `tbl_dv_prestamo_inventario`.`contratista_user_id`)
          INNER JOIN `tbl_dv_deatalle_prestamo` ON (`tbl_dv_prestamo_inventario`.`id` = `tbl_dv_deatalle_prestamo`.`prestamo_id`)
          LEFT OUTER JOIN `tbl_dv_dados_de_baja` ON (`tbl_dv_devolucion_inventario`.`id` = `tbl_dv_dados_de_baja`.`devolucion_id`)
          AND (`tbl_dv_deatalle_devolucion`.`implemento_id` = `tbl_dv_dados_de_baja`.`implemento_id`)
        WHERE
          `tbl_dv_devolucion_inventario`.`id` = ? AND
          `tbl_dv_implementos`.`clasificacion_id` = ?
        GROUP BY
          tbl_dv_implementos.id",[$id,$clasificacion_id]);
      foreach($detalle as $key=>$temp)
      {
        $detalle[$key]->cantidad=$this->cantidad($temp->implemento_id,$temp->contratista_user_id);
      }
      return $detalle;
  }

  public function update(Request $request, $id)
    {
        try
          {
            $devolucion = TblDvDevolucionInventario::find($id);
            $input = $request->all();
            $devolucion->fill($input)->save();
            $elementos = $request->elementos;
            if(is_array($elementos) && count($elementos) <> 0)
            {
                /*$bajas = TblDvDadosDeBaja::where('devolucion_id','=',$id)->get();
                foreach ($bajas as $baja)
                {
                  $devolucion_id = $baja['devolucion_id'];
                  DB::table('tbl_dv_dados_de_baja')->where('devolucion_id', '=', $devolucion_id)->delete();
                }
                $element = TblDvDeatalleDevolucion::where('devolucion_id','=',$id)->get();
                foreach ($element as $elem)
                {
                  $devolucion_id = $elem['devolucion_id'];
                  DB::table('tbl_dv_deatalle_devolucion')->where('devolucion_id', '=', $devolucion_id)->delete();
                }*/
                foreach ($elementos as $key => $value)
                {
                  if($value[6] != ""){
                    $elemento = TblDvDeatalleDevolucion::where('devolucion_id','=',$devolucion->id)
                                ->where('implemento_id',$value[0])
                                ->get();
                    if($elemento->count()){
                      DB::table('tbl_dv_deatalle_devolucion')
                        ->where('devolucion_id','=', $devolucion->id)
                        ->where('implemento_id','=',$value[0])
                        ->update(array('cantidad' => $value[6]));
                    } else {
                      $element = new TblDvDeatalleDevolucion();
                      $element->devolucion_id = $id;
                      $element->implemento_id = $value[0];
                      $element->cantidad = $value[6];
                      $element->save();
                    }
                  }

                  if($value[7] != "" || $value[8] != "")
                  {
                    $detalle = TblDvDadosDeBaja::where('devolucion_id','=',$devolucion->id)
                                ->where('implemento_id',$value[0])
                                ->get();
                    if($detalle->count()){
                      DB::table('tbl_dv_dados_de_baja')
                        ->where('devolucion_id','=', $devolucion->id)
                        ->where('implemento_id','=',$value[0])
                        ->update(array('dano' => $value[7],'perdida_robo'=>$value[8]));
                    } else {
                      $det = new TblDvDadosDeBaja();
                      $det->devolucion_id = $devolucion->id;
                      $det->implemento_id = $value[0];
                      $det->dano = $value[7];
                      $det->perdida_robo = $value[8];
                      $det->save();
                    }
                  }
                }
              }
              echo json_encode(['validate' => true, 'msj' => 'Actualizado con exito']);
          }
          catch(Exception $e)
          {
              echo json_encode(['validate' => false, 'msj' => $e]);
          }
    }


    public function destroy($id)
    {
      $bajas = TblDvDadosDeBaja::where('devolucion_id','=',$id)->get();

      foreach ($bajas as $baja) {
        $devo = $baja['devolucion_id'];
        DB::table('tbl_dv_dados_de_baja')->where('devolucion_id', '=', $devo)->delete();
      }

      $detalles = TblDvDeatalleDevolucion::where('devolucion_id','=',$id)->get();

      foreach ($detalles as $detalle) {
        $devolucion_id = $detalle['devolucion_id'];
        DB::table('tbl_dv_deatalle_devolucion')->where('devolucion_id', '=', $devolucion_id)->delete();
      }

      $devolucion = TblDvDevolucionInventario::find($id);

      $devolucion->delete();

      echo json_encode(['validate' => true, 'msj' => 'Borrado con exito']);

    }

    public function prestamos($user)
    {
       $prestamos = DB::table('tbl_dv_prestamo_inventario')
            ->select
            (
                'tbl_dv_implementos.clasificacion_id'
            )
            ->join('tbl_dv_deatalle_prestamo','tbl_dv_prestamo_inventario.id','=','tbl_dv_deatalle_prestamo.prestamo_id')
            ->join('tbl_dv_implementos','tbl_dv_deatalle_prestamo.implemento_id','=','tbl_dv_implementos.id')
            ->where('tbl_dv_prestamo_inventario.contratista_user_id','=',$user)
            ->groupBy('tbl_dv_implementos.clasificacion_id')
            ->get();
            foreach ($prestamos as $key=>$temp)
            {
                $prestamos[$key] = $this->detalle_prestamos($temp->clasificacion_id,$user);
            }

        return response()->json(['validate' => true, 'data' => $prestamos]);
    }

    private function detalle_prestamos($id_clasificacion, $user)
    {
      $prestamos = DB::select("SELECT
         `tbl_dv_clasificacion_implementos`.`nombre` AS `clasificacion`,
         `tbl_dv_deatalle_prestamo`.`implemento_id`,
         UPPER(`tbl_dv_implementos`.`nombre`) AS `nombreImplemento`,
         `tbl_dv_proveedores`.`id` AS `proveedor_id`,
         CONCAT_WS('-',COALESCE(`tbl_dv_contrato_proveedor`.`no`,'-'), UCASE(`tbl_dv_proveedores`.`nombre`)) AS `proveedor`,
         0 as cantidad,
         COALESCE((SELECT
                   SUM(`cantidad`.`cantidad`)
                   FROM
                   `tbl_dv_deatalle_devolucion` `cantidad`
                   WHERE
                  `cantidad`.`implemento_id`=`tbl_dv_deatalle_prestamo`.`implemento_id`
                   AND
                   `cantidad`.`devolucion_id`=`tbl_dv_deatalle_devolucion`.`devolucion_id`
                   AND
                   `cantidad`.`id_deatalle_prestamo_devolucion_estado` IN(1,3)),0
      ) as `devuelto`
       FROM
         `tbl_dv_deatalle_prestamo`
         INNER JOIN `tbl_dv_prestamo_inventario` ON (`tbl_dv_deatalle_prestamo`.`prestamo_id` = `tbl_dv_prestamo_inventario`.`id`)
         INNER JOIN `tbl_dv_implementos` ON (`tbl_dv_deatalle_prestamo`.`implemento_id` = `tbl_dv_implementos`.`id`)
         INNER JOIN `tbl_dv_clasificacion_implementos` ON (`tbl_dv_implementos`.`clasificacion_id` = `tbl_dv_clasificacion_implementos`.`id`)
         INNER JOIN `tbl_dv_proveedores` ON (`tbl_dv_implementos`.`proveedor_id` = `tbl_dv_proveedores`.`id`)
         LEFT OUTER JOIN `tbl_dv_devolucion_inventario` ON (`tbl_dv_prestamo_inventario`.`contratista_user_id` = `tbl_dv_devolucion_inventario`.`contratista_user_id`)
         LEFT OUTER JOIN `tbl_dv_deatalle_devolucion` ON (`tbl_dv_devolucion_inventario`.`id` = `tbl_dv_deatalle_devolucion`.`devolucion_id`)
         AND (`tbl_dv_deatalle_devolucion`.`implemento_id` = `tbl_dv_deatalle_prestamo`.`implemento_id`)
         LEFT OUTER JOIN `tbl_dv_contrato_proveedor` ON (`tbl_dv_proveedores`.`id` = `tbl_dv_contrato_proveedor`.`proveedor_id`)
         WHERE
                `tbl_dv_prestamo_inventario`.`contratista_user_id` = ? AND
                `tbl_dv_implementos`.`clasificacion_id` = ?
         GROUP BY
                `tbl_dv_implementos`.`id`
         ORDER BY
          `tbl_dv_clasificacion_implementos`.`nombre`,
          `tbl_dv_implementos`.`nombre`
                ",[$user,$id_clasificacion]);
        $prestamos = (count($prestamos)>0)?$prestamos:[];
        foreach($prestamos as $key=>$temp)
        {
          $prestamos[$key]->cantidad=$this->cantidad($temp->implemento_id,$user);
          //$data[$key]->devuelto=$this->devuelto($temp->implemento_id,$user);
        }
        return ($prestamos);
    }
    private function devuelto($id_implemto,$user)
    {

    }
    private function cantidad($id_implemto,$user)
    {
      $sql="SELECT
      COALESCE(sum(`tbl_dv_deatalle_prestamo`.`cantidad`),0) as cantidad
      FROM
        `tbl_dv_deatalle_prestamo`
        INNER JOIN `tbl_dv_prestamo_inventario` ON (`tbl_dv_deatalle_prestamo`.`prestamo_id` = `tbl_dv_prestamo_inventario`.`id`)
        INNER JOIN `tbl_dv_implementos` ON (`tbl_dv_deatalle_prestamo`.`implemento_id` = `tbl_dv_implementos`.`id`)

      WHERE
        `tbl_dv_prestamo_inventario`.`contratista_user_id` = ?
        AND
        `tbl_dv_implementos`.`id`=?";
        $prestamos = DB::select($sql,[$user,$id_implemto]);
        return (int)$prestamos[0]->cantidad;
    }

    public function prestamos_user($user)
    {


    $sql = 'SELECT
              `TBL_DV_CLASIFICACION_IMPLEMENTOS`.`NOMBRE` AS `clasificacion`,
              `TBL_DV_DEATALLE_PRESTAMO`.`IMPLEMENTO_ID` AS `implemento_id`,
              `TBL_DV_IMPLEMENTOS`.`NOMBRE` AS `implemento`,
              `TBL_DV_PROVEEDORES`.`NOMBRE` AS `proveedor`,
              `TBL_DV_DEATALLE_PRESTAMO`.`CANTIDAD` - `TBL_DV_DEATALLE_DEVOLUCION`.`CANTIDAD` AS `cantidad`,
              `TBL_DV_DEATALLE_DEVOLUCION`.`CANTIDAD` AS `cantidad_devuelta`,
              `TBL_DV_DADOS_DE_BAJA`.`DANO` AS `dano`,
              `TBL_DV_DADOS_DE_BAJA`.`PERDIDA_ROBO` AS `perdida_robo`
              FROM
              `TBL_DV_DEVOLUCION_INVENTARIO`
              INNER JOIN `TBL_DV_PRESTAMO_INVENTARIO` ON `TBL_DV_DEVOLUCION_INVENTARIO`.`CONTRATISTA_USER_ID` = `TBL_DV_PRESTAMO_INVENTARIO`.`CONTRATISTA_USER_ID`
              LEFT JOIN `TBL_DV_DEATALLE_DEVOLUCION` ON `TBL_DV_DEVOLUCION_INVENTARIO`.`ID` = `TBL_DV_DEATALLE_DEVOLUCION`.`DEVOLUCION_ID`
              INNER JOIN `TBL_DV_DEATALLE_PRESTAMO` ON `TBL_DV_PRESTAMO_INVENTARIO`.`ID` = `TBL_DV_DEATALLE_PRESTAMO`.`PRESTAMO_ID`
              AND `TBL_DV_DEATALLE_PRESTAMO`.`IMPLEMENTO_ID` = `TBL_DV_DEATALLE_DEVOLUCION`.`IMPLEMENTO_ID`
              INNER JOIN `TBL_DV_IMPLEMENTOS` ON `TBL_DV_DEATALLE_PRESTAMO`.`IMPLEMENTO_ID` = `TBL_DV_IMPLEMENTOS`.`ID`
              INNER JOIN `TBL_DV_CLASIFICACION_IMPLEMENTOS` ON `TBL_DV_IMPLEMENTOS`.`CLASIFICACION_ID` = `TBL_DV_CLASIFICACION_IMPLEMENTOS`.`ID`
              INNER JOIN `TBL_DV_PROVEEDORES` ON `TBL_DV_IMPLEMENTOS`.`PROVEEDOR_ID` = `TBL_DV_PROVEEDORES`.`ID`
              LEFT JOIN `TBL_DV_DADOS_DE_BAJA` ON `TBL_DV_IMPLEMENTOS`.`ID` = `TBL_DV_DADOS_DE_BAJA`.`IMPLEMENTO_ID`
              AND `TBL_DV_DEVOLUCION_INVENTARIO`.`ID` =  `TBL_DV_DADOS_DE_BAJA`.`DEVOLUCION_ID`
              WHERE `TBL_DV_DEVOLUCION_INVENTARIO`.`CONTRATISTA_USER_ID` = :user';

      $detalle = DB::select($sql, ['user'=>$user]);

      return $detalle;
    }

    public function devolucionesPDF()
    {
      $devoluciones = DB::table('tbl_dv_devolucion_inventario')
          ->select(
              DB::raw('UCASE(CONCAT(users.primer_nombre," ",users.primer_apellido)) as contratista'),
              DB::RAW('UCASE(roles.name) as rol'),
              'tbl_dv_devolucion_inventario.fecha',
              DB::raw('UCASE(tbl_dv_disciplinas.descripcion) as disciplinas'),
              'tbl_dv_implementos.nombre as implemento',
              'tbl_dv_implementos.especificacion_tecnica',
              'tbl_dv_proveedores.nombre as proveedor',
              'tbl_dv_deatalle_prestamo.cantidad',
              DB::raw('SUM(tbl_dv_deatalle_devolucion.cantidad) as cantidad_devuelta'),
              DB::raw('SUM(tbl_dv_dados_de_baja.dano) as dano'),
              DB::raw('SUM(tbl_dv_dados_de_baja.perdida_robo) as perdida_robo')
          )
          ->join('tbl_dv_deatalle_devolucion', 'tbl_dv_devolucion_inventario.id','=','tbl_dv_deatalle_devolucion.devolucion_id')
          ->join('tbl_dv_implementos','tbl_dv_deatalle_devolucion.implemento_id','=','tbl_dv_implementos.id')
          ->join('tbl_dv_prestamo_inventario','tbl_dv_devolucion_inventario.contratista_user_id','=','tbl_dv_prestamo_inventario.contratista_user_id')
          ->join('tbl_dv_deatalle_prestamo','tbl_dv_prestamo_inventario.id','=','tbl_dv_deatalle_prestamo.prestamo_id')
          ->join('users','tbl_dv_devolucion_inventario.contratista_user_id','=','users.numero_documento')
          ->join('role_user','users.id','=','role_user.user_id')
          ->join('roles','role_user.role_id','=','roles.id')
          ->join('tbl_dv_proveedores','tbl_dv_implementos.proveedor_id','=','tbl_dv_proveedores.id')
          ->join('tbl_dv_empleado','users.id','=','tbl_dv_empleado.id_usuario')
          ->join('tbl_dv_dados_de_baja', function($join) {
              $join->on('tbl_dv_deatalle_devolucion.devolucion_id','=','tbl_dv_dados_de_baja.devolucion_id')
                  ->on('tbl_dv_implementos.id','=','tbl_dv_dados_de_baja.implemento_id');
          })
          ->leftJoin('tbl_dv_empleado_x_disciplina','tbl_dv_empleado.id','=','tbl_dv_empleado_x_disciplina.id_empleado')
          ->leftJoin('tbl_dv_disciplinas','tbl_dv_empleado_x_disciplina.id_disciplina', '=','tbl_dv_disciplinas.id')
          ->groupBy('tbl_dv_deatalle_devolucion.devolucion_id')
          ->groupBy('tbl_dv_dados_de_baja.devolucion_id')
          ->groupBy('tbl_dv_deatalle_devolucion.implemento_id')
          ->get();
      //return $devoluciones;

      if($devoluciones->count()){
          $view = view('pdf.reportedevolucionesPDF',['devoluciones'=> $devoluciones])->render();
          $pdf = \App::make('dompdf.wrapper'); //crea el pdf
          $pdf->loadHTML($view)->setPaper('Letter', 'landscape');
          $pdf->getDomPDF()->set_option("enable_php", true);
          return $pdf->stream('reportedevoluciones'.".pdf");
      }

    }

}
