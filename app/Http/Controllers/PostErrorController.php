<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Barrio;
use App\error;
use DB;

class PostErrorController extends Controller
{

    public function notificar(Request $request)
    {
        $data_request=$request->all();
        $data_request['user']=NULL;
        if (!is_null(Auth::user()))
        {
            $data_request['user']=Auth::user()->id;
        }
		$data = json_encode($data_request);
		$error= new error();
		$error->error=$data;
		$error->Save();
		echo $error->id;
    }
    public function listar()
    {
    	$sql='select * from tbl_gen_error order by fecha DESC';
    	$data=DB::select($sql,[]);
    	echo '<table border="1">';
    	foreach($data as $key=>$temp)
    	{
    		echo '<tr>';
            echo '<td>'.($key+1).'</td>';
    		echo '<td><a href="../../error/ver/'.$temp->id.'">'.$temp->fecha.'</a></td>';
    		echo '</tr>';
    	}
    	echo '</table>';
    }
    public function ver($id)
    {
	    	$error= error::where('id','=',$id)->firstOrFail();
			$data=(json_decode($error->error));
            if(is_null($data))
            {
                var_dump($data);
                echo 'No guardo datos';
                exit;
            }
			echo '<h1 align="center">Buscando error</h1>';
			echo '<h1>Fecha</h1>:'.$error->fecha;
			echo '<h1>Ruta:</h1><a href="'.$data->url_system.'">'.$data->url_system.'</a>';
			echo '<hr>';
			echo '<h1>Mensaje de error</h1>';
			print_r($data->responsetexto);
			echo '<h2>Data del formulario:</h2>';
			echo '<hr><pre>';
			var_dump($data->data_form);
			echo '</pre>';
    }

}
