<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use App\Models\TblDvProveedor;
use App\Models\TblDvContratoProveedor;
use Validator;


class PostProveedorController extends Controller
{
    
    public function create()
    {
    	return view('postproveedores.create');
    }

    public function index()
    {
    	return view('postproveedores.index');
    }

    public function getProveedores()
    {
    	$sql = 'SELECT 
                  `tbl_dv_proveedores`.`id`,
                  UCASE(`tbl_dv_proveedores`.`nombre`) AS `nombre`,
                  `tbl_dv_proveedores`.`telefono`,
                  UCASE(`tbl_dv_proveedores`.`correo`) AS `correo`,
                  `tbl_dv_proveedores`.`direccion`,
                  UCASE(`tbl_dv_proveedores`.`observaciones`) AS `observaciones`,
                  `tbl_dv_proveedores`.`observaciones`,
                  COALESCE(GROUP_CONCAT(`tbl_dv_contrato_proveedor`.`no`),"---") as contratto
                FROM
                  `tbl_dv_contrato_proveedor`
                  RIGHT JOIN `tbl_dv_proveedores` ON (`tbl_dv_contrato_proveedor`.`proveedor_id` = `tbl_dv_proveedores`.`id`)
                GROUP BY
                `tbl_dv_proveedores`.`id`
                ORDER BY
                  `tbl_dv_proveedores`.`id` DESC';
        $proveedores = DB::select($sql, []);

        return response()->json(['validate' => true, 'data' => $proveedores]);
    }

    public function save(Request $request)
    {
    	try
        {

    		$proveedor = new TblDvProveedor();
    		$proveedor->nombre = $request->nombre;
    		if($request->telefono){
    			$proveedor->telefono = $request->telefono;
    		}
    		if($request->correo){
    			$proveedor->correo = $request->correo;
    		}
    		if($request->direccion){
    			$proveedor->direccion = $request->direccion;
    		}
    		if($request->observaciones){
    			$proveedor->observaciones = $request->observaciones;
    		}
    		
            $proveedor->save();
            
            $contratos = $request->contratos;
            if(is_array($contratos) && count($contratos) <> 0){
                foreach ($contratos as $key => $value) {
                    if($value[0] != "" && $value[1] != "" && $value[0] != "") {
                        $contrato = new TblDvContratoProveedor();
                        $contrato->proveedor_id= $proveedor->id;
                        $contrato->no = $value[0];
                        $contrato->descripcion = $value[1];
                        $contrato->fecha = $value[2];
                        $contrato->save();
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
    	$proveedor = TblDvProveedor::find($id);

        $contratos = TblDvContratoProveedor::where('proveedor_id','=',$id)->get();

    	return view('postproveedores.editar')->with([
            'proveedor'=>$proveedor,
            'contratos'=>$contratos
        ]);
    }

    public function saveProveedor(Request $request, $id)
    {
		try
	        {

		    	$proveedor = TblDvProveedor::find($id);
        		$input = $request->all();
        		$proveedor->fill($input)->save();

                $contratos = $request->contratos;
        
                if(is_array($contratos) && count($contratos) <> 0){
                        $contratos_old = TblDvContratoProveedor::where('proveedor_id','=',$id)->get();

                        $contratos_old->each(function($contratos,$index) {
                            $contratos->delete();
                        });

                        foreach ($contratos as $key => $value) {
                            if($value[0] != "" && $value[1] != "" && $value[0] != "") {
                                $contrato = new TblDvContratoProveedor();
                                $contrato->proveedor_id= $id;
                                $contrato->no = $value[0];
                                $contrato->descripcion = $value[1];
                                $contrato->fecha = $value[2];
                                $contrato->save();
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

    public function show($id)
    {
    	$proveedor = TblDvProveedor::find($id);

        $contratos = TblDvContratoProveedor::where('proveedor_id','=',$id)->get();

        return view('postproveedores.mostrar')->with([
            'proveedor'=>$proveedor,
            'contratos'=>$contratos
        ]);
    }

    public function eliminarProveedor($id)
    {
    	$contratos = TblDvContratoProveedor::where('proveedor_id','=',$id)->get();

        $contratos->each(function($contrato,$index) {
                            $contrato->delete();
        });        

        $proveedor = TblDvProveedor::find($id);

    	$proveedor->delete();
        
        echo json_encode(['validate' => true, 'msj' => 'Borrado con exito']);
    	
    }

    protected function validator(array $data)
    {
    	return Validator::make($data,[
    		'nombre' => 'required|string',
    		'correo' => 'email'
    	]);
    }

}
