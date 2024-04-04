<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Hashids\Hashids;

class Sede extends Model
{
    

    protected $table = 'sedes';
    protected $primarykey = 'id';
    protected $fillable = ['institucion_id', 'literal', 'nombre_sede', 'direccion'];


  function getIdAttribute($value)
      {
	    
	    $hashids = new Hashids('', 10);
	   	return $hashids->encode($value);

      }



}


