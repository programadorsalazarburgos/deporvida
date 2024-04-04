<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\models\TblGenJerarquiasUsers;
use App\Role;
use response;
use DB;
	
class jerarquiasController extends Controller
{
   public function indexView()
   {
      return view('jerarquias.index');
   }
   public function CreateView()
   {
      return view('jerarquias.create')->with(['roles'=>Role::orderBy('name')->where('tenantId','=',Auth::user()->tenantId)->get()]);
   }
   public function indexData()
   {
      $data=DB::select('SELECT 
        `roles_padres`.`name` as name_user_padre,
        `roles_hijo`.`name` as name_user_hijo,
        `tbl_gen_jerarquias_users`.`id`
      FROM
        `tbl_gen_jerarquias_users`
        INNER JOIN `roles` `roles_padres` ON (`tbl_gen_jerarquias_users`.`id_roles_padre` = `roles_padres`.`id`)
        INNER JOIN `roles` `roles_hijo` ON (`tbl_gen_jerarquias_users`.`id_roles_hijo` = `roles_hijo`.`id`)
        WHERE
        `tbl_gen_jerarquias_users`.`tenantId`=?',[Auth::user()->tenantId]);
      return response()->json(['validate'=>true,'data'=>$data]);
   }
   public function CreateSave(Request $request)
   {
      if(
          $request->input('id_roles_padre')!==
          $request->input('id_roles_hijo')
        )
      {

        $data = TblGenJerarquiasUsers::where('id_roles_padre',$request->input('id_roles_padre'))
        ->where('id_roles_hijo',$request->input('id_roles_hijo'))
        ->where('tenantId',Auth::user()->tenantId)
        ->first();
        if(!isset($data->id))
        {
          $data = new TblGenJerarquiasUsers();
          $data->id_roles_padre = $request->input('id_roles_padre');     
          $data->id_roles_hijo  = $request->input('id_roles_hijo');
          $data->tenantId       = Auth::user()->tenantId;
          $data->save();

          $response=response()->json(['validate'=>true,'id'=>$data->id]);
        }
        else
        {
          $response=response()->json(['validate'=>false,'id'=>$data->id,'msj'=>'Ya se encuentra esta jerarquia registrada']); 
        }
      }
      else
      {
        $response=response()->json(['validate'=>false,'id'=>NULL,'msj'=>'Un Rol no puede tenerse a si mismo como hijo']);
      }
      return $response;
    }
}