<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Grupo;
use App\HorarioGrupo;
use App\Programa;
use App\Pais;
use App\Departamento;
use App\Municipio;
use App\Barrio;
use App\Beneficiario;
use App\Institucion;
use App\Sede;
use App\PoblacionalBeneficiario;
use DB;
use response;

class PostLocalizacionController extends Controller
{


	public function __construct()
	{


//    $this->middleware('permission:ver-roles', ['only' => 'vista']);


	}

	public function vista(){

		return view("postlocalizacion.applocalizacion");
	}

	public function index($id)
	{


    $instituciones = DB::table('sedes')
    ->select('instituciones.nombre_institucion as label', DB::raw('count(sedes.`id`) as value'))
    ->join('instituciones', 'instituciones.id', '=', 'sedes.institucion_id')
    ->join('barrios', 'barrios.id', '=', 'instituciones.barrio_id')
    ->where('barrios.comuna_id', '=', $id)
    ->groupBy('instituciones.nombre_institucion')
    ->get();

    
    return response()->json(
     $instituciones);
  }

  public function instituciones($id)
  {


    $instituciones = DB::table('sedes')
    ->select('instituciones.id','instituciones.nombre_institucion as label', DB::raw('count(sedes.`id`) as value'))
    ->join('instituciones', 'instituciones.id', '=', 'sedes.institucion_id')
    ->join('barrios', 'barrios.id', '=', 'instituciones.barrio_id')
    ->where('barrios.comuna_id', '=', $id)
    ->groupBy('instituciones.nombre_institucion', 'instituciones.id')
    ->get();


    return response()->json(
      $instituciones);
  }


  public function sede($id)
  {


    $sedes = DB::table('sedes')
    ->select('sedes.id','sedes.nombre_sede as label', DB::raw('count(beneficiarios.`id`) as value'))
    ->join('instituciones', 'instituciones.id', '=', 'sedes.institucion_id')
    ->join('barrios', 'barrios.id', '=', 'instituciones.barrio_id')
    ->leftjoin('grupos', 'sedes.id', '=', 'grupos.sede_id')
    ->leftjoin('beneficiarios', 'grupos.id', '=', 'beneficiarios.grupo_id')
    ->where('sedes.institucion_id', '=', $id)
    ->groupBy('sedes.nombre_sede', 'sedes.id')
    ->get();



    
    return response()->json(
      $sedes);
  }


  public function institucion($id)
  {

    $institucion = Institucion::select('instituciones.nombre_institucion')->where('instituciones.id', '=', $id)->firstOrfail();
    return response()->json(
      $institucion->toArray()
    );


  }


  public function SedeBeneficiario($id)
  {


    $beneficiarios = Beneficiario::select('beneficiarios.id','beneficiarios.nombres_beneficiario', 'beneficiarios.apellidos_beneficiario', 'grupos.codigo_grupo', 'beneficiarios.no_documento_beneficiario', 'beneficiarios.fecha_nac_beneficiario')->join(
      'grupos',
      'grupos.id', '=', 'beneficiarios.grupo_id')->join(
        'sedes',
        'sedes.id', '=', 'grupos.sede_id')->where('sedes.id', '=', $id)->get();
      return response()->json(
        $beneficiarios->toArray()
      );


    }


  }
