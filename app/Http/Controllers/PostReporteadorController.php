<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Permission;

use Jaspersoft\Client\Client;
use Jaspersoft\Service\Criteria\RepositorySearchCriteria;
use Jaspersoft\Dto\Resource\ReportUnit;

class PostReporteadorController extends Controller
{
    //
    public function __construct()
	{
        //$this->middleware('permission:ver-roles', ['only' => 'vista']);
    }
    
    public function vista()
    {
        // dd(env('JASPER_SERVER_URL'));
        return view("postreporteador.appreporteador");
    }

    public function visor()
    {
        return view("postreporteador.appreporteador");
    }

    public function nuevoReporte(Request $request) {

        set_time_limit(0);
        ini_set('memory_limit', '-1');

        try {
            $c = new Client(env('JASPER_SERVER_URL') ,env('JASPER_USER'), env('JASPER_PASSWORD'));
            $c->setRequestTimeout(235); 
    
            // Creando el reporte en Jasper Server //
            $nuevoReporte = new ReportUnit();
            $nuevoReporte->label = $request->label;
            $nuevoReporte->description = $request->description;
            $nuevoReporte->dataSource = $request->dataSource;
            $nuevoReporte->query = $request->jquery;
            $nuevoReporte->jrxml = $request->jrxml;
            // $nuevoReporte->uri = "/Deporvida/Reportes/reporte";
            /* $nuevoReporte->inputControls = array(
                "/inputcontrols/age",
                "/inputcontrols/state",
                $city_control); */
            $reporte = $c->repositoryService()->createResource($nuevoReporte, "/Deporvida/Reportes/");

            if ($reporte) {
                // Creando el permiso para el menu //
                $permisoNuevoReporte = new Permission();
                $permisoNuevoReporte->name = "reporte-" . preg_replace('/\s+/', '_', $request->label);
                $permisoNuevoReporte->display_name = json_encode(["reporteador" => true]);
                $permisoNuevoReporte->description = $reporte->uri;
                $permisoNuevoReporte->tenantId = '312312312';
                $permisoNuevoReporte->save();
            }
    
    
            return response()->json($reporte);
            
        }
        catch (Exception $e) {
            return response()->json(
                ['Error' => $e->getMessage()]
            );
        }

    }

    public static function menuReportesReporteador () {

        $reportes = \App\Permission::where('display_name', json_encode(["reporteador" => true]))->get();

        return $reportes;

    }

    public function eliminarReporte(Request $request) {

        set_time_limit(0);
        ini_set('memory_limit', '-1');

        try {
            $c = new Client(env('JASPER_SERVER_URL') ,env('JASPER_USER'), env('JASPER_PASSWORD'));
            $c->setRequestTimeout(235); 

            // Eliminando el Reporte en Jasper Server
            $c->repositoryService()->deleteResources($request->reporte_uri);

            // Eliminando el Reporte de los Permisos y el Menu
            $permisoReporte = \App\Permission::where('description', $request->reporte_uri);
            $permisoRol = \App\PermissionRole::where('permission_id', $permisoReporte->get()->first()->id);
            $permisoRol->delete();
            $permisoReporte->delete();

        }
        catch (Exception $e) {
            return response()->json(
                ['Error' => $e->getMessage()]
            );
        }

    }

}
