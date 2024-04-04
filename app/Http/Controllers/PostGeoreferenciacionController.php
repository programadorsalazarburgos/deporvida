<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;
use App\Models\TblGenPersonaXGrupoPoblacional;
use App\TblGenComunas;
class PostGeoreferenciacionController extends Controller
{

    public function __construct()
    {
        
    }

    public function index()
    {
      return view("georeferenciacion.index");
    }
    public function comuna($id)
    {
      return view("georeferenciacion.comuna")->with([
        'id'=>$id,
        'escenarios'=>$this->ComunasEscenario($id),
        'disciplinas'=>$this->ComunasXDisciplinas($id),
      ]); 
    }
    private function beneficiarios($id_comuna)
    {
        $total=DB::table('tbl_dv_ficha')
          ->select(DB::raw('count(*) as total'))
          ->join('tbl_dv_grupos','tbl_dv_ficha.id_grupo','=','tbl_dv_grupos.id')
          ->where('tbl_dv_ficha.vinculado','=',1)
          ->where('tbl_dv_grupos.activo','=',1)
          ->where('tbl_dv_grupos.id_comuna_impacto','=',$id_comuna)
          ->first(); 
        return (is_null($total)?0:$total->total);
    }
    private function escenarios_cantidad($id_comuna)
    {
        $total=DB::table('tbl_dv_grupos')
          ->select(DB::raw('count(DISTINCT(`tbl_dv_grupos`.`id_escenario`)) as total'))
          ->join('tbl_dv_escenarios','tbl_dv_grupos.id_escenario','=','tbl_dv_escenarios.id')
          ->where('tbl_dv_grupos.activo','=',1)
          ->where('tbl_dv_grupos.id_comuna_impacto','=',$id_comuna)
          ->first(); 
        return (is_null($total)?0:$total->total);
    }
    private function disciplina_cantidad($id_comuna)
    {
        $total=DB::table('tbl_dv_grupos')
          ->select(DB::raw('count(DISTINCT(`tbl_dv_grupos`.`id_disciplina`)) as total'))
          ->where('tbl_dv_grupos.activo','=',1)
          ->where('tbl_dv_grupos.id_comuna_impacto','=',$id_comuna)
          ->first();
        return (is_null($total)?0:$total->total);      
    }
    private function monitores($id_comuna)
    {
        $total=DB::table('tbl_dv_grupos')
          ->select(DB::raw('count(DISTINCT(`tbl_dv_grupos`.`id_monitor`)) as total'))
          ->where('tbl_dv_grupos.activo','=',1)
          ->where('tbl_dv_grupos.id_comuna_impacto','=',$id_comuna)
          ->first();
        return (is_null($total)?0:$total->total);      
    }

    public function map()
    {
      $data=TblGenComunas::all();
      foreach($data as $temp)
      {
        $temp->monitores           = $this->monitores($temp->id);
        $temp->beneficiarios       = $this->beneficiarios($temp->id);
        $temp->escenarios_cantidad = $this->escenarios_cantidad($temp->id);
        $temp->disciplina_cantidad = $this->disciplina_cantidad($temp->id);
      }
      return response()->json(['validate'=>TRUE,'data'=>$data]);
    }
    public function ComunasEscenario($id_comuna)
    {
      $sql='SELECT 
        `tbl_dv_escenarios`.`id`,
        UPPER(`tbl_dv_escenarios`.`nombre_escenario`) AS `nombre_escenario`,
        `comunas_escenario`.`codigo_comuna` as comuna_escenario,
        (SELECT COUNT(`fic`.`id_persona_beneficiario`) AS `total` FROM `tbl_dv_ficha` `fic` INNER JOIN `tbl_dv_grupos` `gru` ON (`fic`.`id_grupo` = `gru`.`id`) WHERE `gru`.`id_escenario` = `tbl_dv_grupos`.`id_escenario` AND `fic`.`vinculado` = 1 AND `gru`.`id_comuna_impacto` = `tbl_dv_grupos`.`id_comuna_impacto` AND `gru`.`activo` = 1) AS `cantidad`
      FROM
        `tbl_dv_grupos`
        INNER JOIN `tbl_dv_escenarios` ON (`tbl_dv_grupos`.`id_escenario` = `tbl_dv_escenarios`.`id`)
        INNER JOIN `tbl_dv_ficha` ON (`tbl_dv_grupos`.`id` = `tbl_dv_ficha`.`id_grupo`)
        INNER JOIN `barrios` ON (`tbl_dv_escenarios`.`id_barrio` = `barrios`.`id`)
        INNER JOIN `comunas` `comunas_escenario` ON (`barrios`.`comuna_id` = `comunas_escenario`.`id`)
      WHERE
        `tbl_dv_grupos`.`activo` = 1 AND 
        `tbl_dv_ficha`.`vinculado` = 1 AND 
        `tbl_dv_grupos`.`id_comuna_impacto` = ?
      GROUP BY
        `tbl_dv_escenarios`.`id`
      ORDER BY
      `comunas_escenario`.`codigo_comuna`,
        `tbl_dv_escenarios`.`nombre_escenario` ASC';
      return DB::select($sql,[$id_comuna]);
    }
    public function ComunasxEscenario($id_comuna)
    {
      $sql='SELECT 
            `tbl_dv_escenarios`.id,
              `tbl_dv_escenarios`.`nombre_escenario` as name,
              (SELECT 
              COUNT(DISTINCT `fic`.`id_persona_beneficiario`) AS `total`
            FROM
              `tbl_dv_ficha` `fic`
              INNER JOIN `tbl_dv_grupos` `gru` ON (`fic`.`id_grupo` = `gru`.`id`)
            WHERE
              `gru`.`id_escenario` = `tbl_dv_grupos`.`id_escenario` 
              AND 
              `fic`.`vinculado` = 1 
              AND
              `gru`.`id_comuna_impacto`=`tbl_dv_grupos`.`id_comuna_impacto` 
              AND 
              `gru`.`activo` = 1 
              ) as y
            FROM
              `tbl_dv_grupos`
              INNER JOIN `tbl_dv_escenarios` ON (`tbl_dv_grupos`.`id_escenario` = `tbl_dv_escenarios`.`id`)
              INNER JOIN `tbl_dv_ficha` ON (`tbl_dv_grupos`.`id` = `tbl_dv_ficha`.`id_grupo`)
            WHERE
              `tbl_dv_grupos`.`activo` = 1 AND 
              `tbl_dv_ficha`.`vinculado` = 1 AND
              `tbl_dv_grupos`.`id_comuna_impacto` = ?
            GROUP BY
              `tbl_dv_escenarios`.`id`
              ORDER BY 3 DESC';
      $data=DB::select($sql,[$id_comuna]);
      $res=[];
      $id=[];
      $name=[];
      $y=[];
      foreach($data as $temp)
      {
        $id[]=$temp->id;
        $name[]=$temp->name;
        $y[]=$temp->y;
      }
      $res=[
        'id'=>$id,
        'name'=>$name,
        'title12315656'=>$name,
        'y'=>$y,
      ];
      return json_encode(['validate'=>true,'registros'=>$res],128);
    }






    public function ComunasXDisciplinas($id_comuna)
    {
      $sql='SELECT 
            `tbl_dv_disciplinas`.`id`,
            `tbl_dv_disciplinas`.`descripcion` as nombre_disciplina,
            (
            
          SELECT 
            COUNT(`fic`.`id_persona_beneficiario`) AS `total`
          FROM
            `tbl_dv_ficha` `fic`
            INNER JOIN `tbl_dv_grupos` `gru` ON (`fic`.`id_grupo` = `gru`.`id`)
          WHERE
            `gru`.`id_comuna_impacto`=`tbl_dv_grupos`.`id_comuna_impacto`
            AND
            `gru`.`id_disciplina`=`tbl_dv_disciplinas`.`id`
            AND
            `gru`.`activo`=1 
            AND
            `fic`.vinculado=1
            
            ) as cantidad
          FROM
            `tbl_dv_grupos`
            INNER JOIN `tbl_dv_disciplinas` ON (`tbl_dv_grupos`.`id_disciplina` = `tbl_dv_disciplinas`.`id`)
          WHERE
            `tbl_dv_grupos`.`id_comuna_impacto` = ? AND 
            `tbl_dv_grupos`.`activo` = 1
          GROUP BY
            `tbl_dv_disciplinas`.`descripcion`
            ORDER BY 3 DESC';
      return DB::select($sql,[$id_comuna]);
    }


    public function ComunasDisciplinas($id_comuna)
    {
      $sql='SELECT 
            `tbl_dv_disciplinas`.`id`,
            `tbl_dv_disciplinas`.`descripcion` as name,
            (
            
          SELECT 
            COUNT(`fic`.`id_persona_beneficiario`) AS `total`
          FROM
            `tbl_dv_ficha` `fic`
            INNER JOIN `tbl_dv_grupos` `gru` ON (`fic`.`id_grupo` = `gru`.`id`)
          WHERE
            `gru`.`id_comuna_impacto`=`tbl_dv_grupos`.`id_comuna_impacto`
            AND
            `gru`.`id_disciplina`=`tbl_dv_disciplinas`.`id`
            AND
            `gru`.`activo`=1 
            AND
            `fic`.vinculado=1
            
            ) as y
          FROM
            `tbl_dv_grupos`
            INNER JOIN `tbl_dv_disciplinas` ON (`tbl_dv_grupos`.`id_disciplina` = `tbl_dv_disciplinas`.`id`)
          WHERE
            `tbl_dv_grupos`.`id_comuna_impacto` = ? AND 
            `tbl_dv_grupos`.`activo` = 1
          GROUP BY
            `tbl_dv_disciplinas`.`descripcion`
            ORDER BY 3 DESC';
      $data=DB::select($sql,[$id_comuna]);
      $res=[];
      $id=[];
      $name=[];
      $y=[];
      foreach($data as $temp)
      {
        $id[]=$temp->id;
        $name[]=$temp->name;
        $y[]=$temp->y;
      }
      $res=[
        'id'=>$id,
        'name'=>$name,
        'title12315656'=>$name,
        'y'=>$y,
      ];
      return json_encode(['validate'=>true,'registros'=>$res],128);
    }

}
