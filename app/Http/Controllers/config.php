<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Barrio;
use App\Comuna;
use response;
use DB;

class config extends Controller
{

    public function generate()
    {
        $codigo        = \App\Models\TblDvConfig::where('name', '=', 'codigo_grupo')->firstOrFail();
        $codigo->value = $codigo->value + 1;
        $codigo->save();
        return response()->json(array('id' => $codigo->value, 'codigo' => str_pad($codigo->value, 4, '0', STR_PAD_LEFT)));
    }
    public function roles()
    {
    	$data=DB::select('',[Auth::user()->id]);	
    	var_dump(Auth::user()->id);
    }

}
