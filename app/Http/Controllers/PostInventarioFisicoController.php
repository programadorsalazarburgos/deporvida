<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\TblDvInventarioFisico;
use App\Models\TblDvImplementos;
use App\Models\TblDvProveedores;
use App\Models\TblDvClasificacionImplementos;
use App\Models\TblDvDisciplinas;
use App\Models\TblDvDetalleInventarioFisico;
use App\User;


class PostInventarioFisicoController extends Controller
{

	public function index()
  {
      return view('postinventariofisico.index');
  }

    public function listarInventario()
    {
    	$sql = 'SELECT 
                  `tbl_dv_inventario_fisico`.`id` AS `id`,
                  `tbl_dv_inventario_fisico`.`fecha` AS `fecha`,
                  `tbl_dv_inventario_fisico`.`diferencia` AS `diferencia`,
                  UCASE(`tbl_dv_inventario_fisico`.`observaciones`) AS `observaciones`,
                  UCASE(CONCAT(`users`.`primer_nombre`," " ,`users`.`primer_apellido`)) AS `usuario` 
                FROM
                  `tbl_dv_inventario_fisico`
                INNER JOIN  `users` ON (`tbl_dv_inventario_fisico`.`responsable_user_id` = `users`.`id`) 	
                GROUP BY 
                  `tbl_dv_inventario_fisico`.`responsable_user_id`'
                ;

        $inventarios = DB::select($sql, []);

        return response()->json(['validate' => true, 'data' => $inventarios]);
    }

    public function create()
    {
    	return view('postinventariofisico.create')->with([
			'clasificacion'=>TblDvClasificacionImplementos::all(),
			'proveedor'=>TblDvProveedores::all(),
			'disciplina'=>TblDvDisciplinas::orderBy('descripcion')->get(),
			'usuario'=>User::orderBy('primer_nombre')->get(),
      'implementos'=>TblDvImplementos::orderBy('clasificacion_id')->orderBy('proveedor_id')->orderBy('nombre')->get()
		]);		
    }

    public function edit($id)
    {
      $inventario = TblDvInventarioFisico::find($id);
      $detalles = TblDvDetalleInventarioFisico::where('inventario_id','=',$id)->get();

      return view('postinventariofisico.editar')->with([
            'inventario'=>$inventario,
            'detalles'=>$detalles,
            'clasificacion'=>TblDvClasificacionImplementos::all(),
            'proveedor'=>TblDvProveedores::all(),
            'disciplina'=>TblDvDisciplinas::orderBy('descripcion')->get(),
            'usuario'=>User::orderBy('primer_nombre')->get(),
            'implementos'=>TblDvImplementos::orderBy('clasificacion_id')->orderBy('nombre')->get()

        ]);
    }
    public function reporte($id)
    {
      $detalles=DB::table('tbl_dv_deatalle_inventario_fisico')
          ->select('tbl_dv_implementos.nombre as implemento',
                          'tbl_dv_proveedores.nombre as proveedor',
                          'tbl_dv_deatalle_inventario_fisico.enfisico',
                          'tbl_dv_deatalle_inventario_fisico.enbodega',
                          'tbl_dv_deatalle_inventario_fisico.diferencia',
                          'tbl_dv_clasificacion_implementos.nombre as clasificacion')
          ->join('tbl_dv_implementos','tbl_dv_deatalle_inventario_fisico.implemento_id','=','tbl_dv_implementos.id')
          ->join('tbl_dv_proveedores','tbl_dv_implementos.proveedor_id','=','tbl_dv_proveedores.id')
          ->join('tbl_dv_clasificacion_implementos','tbl_dv_implementos.clasificacion_id','=','tbl_dv_clasificacion_implementos.id')
          ->where('inventario_id','=',$id)
          ->orderBy('tbl_dv_clasificacion_implementos.nombre')
          ->orderBy('tbl_dv_implementos.nombre')
          ->get();
      $inventario=DB::table('tbl_dv_inventario_fisico')
                    ->select(
                        'tbl_dv_inventario_fisico.id',
                        'tbl_dv_inventario_fisico.fecha',
                        'tbl_dv_inventario_fisico.responsable_user_id',
                        'tbl_dv_inventario_fisico.diferencia',
                        'tbl_dv_inventario_fisico.observaciones',
                        'users.primer_nombre',
                        'users.segundo_nombre',
                        'users.primer_apellido',
                        'users.segundo_apellido',
                        'users.numero_documento'
                    )
                    ->join('users','tbl_dv_inventario_fisico.responsable_user_id','=','users.id')
                    ->where('tbl_dv_inventario_fisico.id','=',$id)
                    ->first();
      $data=
      [
            'inventario'=>$inventario,
            'detalles'=>$detalles/*,
            'clasificacion'=>TblDvClasificacionImplementos::all(),
            'proveedor'=>TblDvProveedores::all(),
            'disciplina'=>TblDvDisciplinas::orderBy('descripcion')->get(),
            'usuario'=>User::orderBy('primer_nombre')->get(),
            'implementos'=>TblDvImplementos::orderBy('clasificacion_id')->orderBy('nombre')->get()*/
      ];
      $view = view('postinventariofisico.reporte')->with($data)->render();
      //echo $view;exit;
      //echo '<pre>';var_dump(json_decode(json_encode($data),true));exit;
      $pdf = \App::make('dompdf.wrapper'); //crea el pdf
      $pdf->loadHTML($view)->setPaper('Letter', 'landscape');
      $pdf->getDomPDF()->set_option("enable_php", true);
      return $pdf->stream('reporteinventario'.".pdf");
    }


    public function save(Request $request)
    {
      try
        {

        $inventario = new TblDvInventarioFisico();
        $inventario->fecha = $request->fecha;
        $inventario->responsable_user_id = $request->responsable_user_id;
        $inventario->observaciones = $request->observaciones;
        $inventario->save();
            
        $elementos = $request->detalles;
        if(is_array($elementos) && count($elementos) <> 0){

            foreach ($elementos as $key => $value) {
              $elemento = new TblDvDetalleInventarioFisico();
              $elemento->inventario_id= $inventario->id;
              $elemento->implemento_id = $value[0];
              $elemento->enbodega = $value[4];
              if($value[5] != ""){
                $elemento->enfisico = $value[5];  
              } else {
                $elemento->enfisico = 0;
              }
              $elemento->diferencia = $value[6];
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
    
    public function update(Request $request, $id)
    {
    try
          {
            $inventario = TblDvInventarioFisico::find($id);
            $input = $request->all();
            $inventario->fill($input)->save();
            $elementos = $request->elementos;
        
              if(is_array($elementos) && count($elementos) <> 0){
                $detalles = TblDvDetalleInventarioFisico::where('inventario_id','=',$id)->get();

                foreach ($detalles as $detalle) {
                  
                  $inventario_id = $detalle['inventario_id'];

                  DB::table('tbl_dv_deatalle_inventario_fisico')->where('inventario_id', '=', $inventario_id)->delete();
                
                }

                  foreach ($elementos as $key => $value) {
                    $elemento = new TblDvDetalleInventarioFisico();
                    $elemento->inventario_id= $id;
                    $elemento->implemento_id= $value[0];
                    $elemento->enbodega = $value[4];
                    if($value[5] != ""){
                      $elemento->enfisico = $value[5];  
                    } else {
                      $elemento->enfisico = 0;
                    }
                    $elemento->diferencia = $value[6];
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

      $elementos = TblDvDetalleInventarioFisico::where('inventario_id','=',$id)->get();

      foreach ($elementos as $elem) {
        $inventario_id = $elem['inventario_id'];

        DB::table('tbl_dv_deatalle_inventario_fisico')->where('inventario_id', '=', $inventario_id)->delete();
      
      }
      
      $entrada = TblDvInventarioFisico::find($id);

      $entrada->delete();
        
      echo json_encode(['validate' => true, 'msj' => 'Borrado con exito']);
      
    }

    public function inventarioPDF()
    {
      $inventario = DB::table('tbl_dv_clasificacion_implementos')
                    ->select(
                        'tbl_dv_clasificacion_implementos.id as id_clasificacion',
                        'tbl_dv_clasificacion_implementos.nombre as clasificacion' 
                    )
                    ->join('tbl_dv_implementos','tbl_dv_clasificacion_implementos.id','=','tbl_dv_implementos.clasificacion_id')
                    ->join('tbl_dv_deatalle_inventario_fisico','tbl_dv_implementos.id','=','tbl_dv_deatalle_inventario_fisico.implemento_id')
                    ->groupBy('tbl_dv_implementos.clasificacion_id')
                    ->get();
      

      foreach ($inventario as $key => $temp) {
        $inventario[$key]->detalle = $this->detalleinventario($temp->id_clasificacion);
      }

      //return $inventario;

      if($inventario->count()){
      $view = view('pdf.reporteinventarioPDF',['inventario'=> $inventario])->render();
      $pdf = \App::make('dompdf.wrapper'); //crea el pdf
      $pdf->loadHTML($view)->setPaper('Letter', 'landscape');
      $pdf->getDomPDF()->set_option("enable_php", true);
      return $pdf->stream('reporteinventario'.".pdf");
      } 
    }

    private function detalleinventario($id_clasificacion)
    {
      $detalle = DB::table('tbl_dv_implementos')
                ->select(
                  'tbl_dv_implementos.nombre as implemento',
                  'tbl_dv_implementos.especificacion_tecnica',
                  'tbl_dv_implementos.stock',
                  DB::raw('SUM(tbl_dv_deatalle_inventario_fisico.enbodega) as enbodega')
                )
                ->join('tbl_dv_deatalle_inventario_fisico','tbl_dv_implementos.id','=','tbl_dv_deatalle_inventario_fisico.implemento_id')
                ->where('tbl_dv_implementos.clasificacion_id','=',$id_clasificacion)
                ->groupBy('tbl_dv_implementos.id')
                ->get();

      return $detalle;
    }

}
